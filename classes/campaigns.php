<?
class Campaigns {
var $campaigns_list;
var $admin_campaigns_list;
var $this_campaign;
var $time_left;
var $error_confirm;

var $add_result;
var $red_result;
var $delete_result;

function __construct() 
{
	if($_GET[page] == "add_campaign" AND $_POST[submit] != "")
	{
		$this->add_campaign();
	}
	elseif($_GET[page] == "gallery" OR $_GET[page] == "skidki")
	{
@		$this->this_campaign = mysql_fetch_array(mysql_query("SELECT * FROM campaigns WHERE date_start<NOW() AND date_end>NOW() LIMIT 1"));
		if($this->this_campaign[date_end] != "")
		{
			$this->get_time_left($this->this_campaign[date_end]);
		}
	}
	elseif($_GET[page] == "campaigns_list")
	{
		$this->create_admin_campaigns_list();
	}
	elseif($_GET[page] == "campaign" AND $_GET[id] != "")
	{
		$this->create_one_campaign($_GET[id]);
		$this->this_campaign = mysql_fetch_array(mysql_query("SELECT * FROM campaigns WHERE id='$_GET[id]'"));
	}
	elseif($_GET[page] == "red_campaign" AND $_GET[id] != "")
	{
		if($_POST[submit] != "")
		{
@			$this->red_campaign($_GET[id]);
		}
		$this->this_campaign = mysql_fetch_array(mysql_query("SELECT * FROM campaigns WHERE id='$_GET[id]'"));
	}
	elseif($_GET[page] == "del_campaign" AND $_GET[id] != "")
	{
		$this->delete_article($_GET[id]);
	}
	else
	{
		$query = mysql_query("SELECT * FROM pages WHERE url='$_GET[page]' AND special_design='1'");
		if(mysql_num_rows($query) > 0)
		{
	@		$this->this_campaign = mysql_fetch_array(mysql_query("SELECT * FROM campaigns WHERE date_start<NOW() AND date_end>NOW() LIMIT 1"));
			if($this->this_campaign[date_end] != "")
			{
				$this->get_time_left($this->this_campaign[date_end]);
			}
		}
	}
}

function add_campaign()
{
	if($_SESSION[access] == 3)
	{
	
	if($_POST[title] != "" AND $_POST[text] != "" AND $_POST[date_start] != "" AND $_POST[date_end] != "")
	{
		$query = mysql_query("INSERT into campaigns SET title='$_POST[title]', text='$_POST[text]', date_start='$_POST[date_start]', date_end='$_POST[date_end]'");
		if($query)
		{
			$this->add_result = "<div class='good_msg'>Акция добавлена</div>";
		}
	}
	else
	{
		$this->add_result = "<div class='error_msg'>Не все поля заполнены</div>";
	}
	
	}
}

function red_campaign()
{
	if($_SESSION[access] == 3)
	{
	
	if($_GET[id] != "" AND $_POST[submit] != "" AND $_POST[title] != "" AND $_POST[text] != "" AND $_POST[date_start] != "" AND $_POST[date_end] != "")
	{
		$query = mysql_query("UPDATE campaigns SET title='$_POST[title]', text='$_POST[text]', date_start='$_POST[date_start]', date_end='$_POST[date_end]' WHERE id='$_GET[id]'");
		if($query)
		{
			$this->red_result = "<div class='good_msg'>Акция отредактирована</div>";
		}
		else
		{
			$this->red_result = "<div class='error_msg'>Сбой в запросе к базе данных. Акция не отредактирована</div>";
		}
	}
	else
	{
		$this->red_result = "<div class='error_msg'>Не все обязательные поля заполнены</div>";
	}
	
	}
}


function delete_campaign($id)
{
	if($_SESSION[access] == 3)
	{
	
	$id = eregi_replace("/[^0-9]/", "", $id);
	$query = mysql_query("DELETE FROM campaigns WHERE id='$id'");
	if($query)
	{
		$this->delete_result = "<p class='good_msg'>Акция удалена</p>";
	}
	else
	{
		$this->delete_result = "<p class='error_msg'>Акцию удалить не удалось</p>";
	}
	
	
	}
	header("location:".$_SERVER[HTTP_REFERER]); 
}



function create_admin_campaigns_list()
{
	if($_SESSION[access] == 3)
	{
			$query = mysql_query("SELECT * FROM campaigns ORDER by date_end desc");
			if(mysql_num_rows($query) > 0)
			{
				$this->admin_campaigns_list .= "
				<ul class='material_list'>";
				while($array = mysql_fetch_array($query))
				{
					$this->admin_campaigns_list .= "
					<li><b><a href='campaign/$array[id].html'>$array[title]</a></b> (".Date_time::our_date_format($array[date_start])." - ".Date_time::our_date_format($array[date_end]).")
					<div class='tools'>
					<a href='red_campaign/$array[id].html' class='config' title='Редактировать'></a>
					<a href='del_campaign/$array[id].html' class='remove' matherial_id='$array[id]' title='Удалить'></a>
					</div>
					</li>";
				}
				$this->admin_campaigns_list .= "</ul>";
			}
	}
}

function create_one_campaign($id)
{
	if($_SESSION[access] == 3)
	{
	
@	$array = mysql_fetch_array(mysql_query("SELECT * FROM campaigns WHERE id='$id'"));
	if($array[id] != "")
	{
		$this->one_campaign .= "<div style='width:100%; overflow:hidden; margin-bottom:10px;'>
		<div class='green_block block'>
		<div class='title'>Акция «".$array[title]."» <div class='tools'><a href='red_campaign/$id.html'><span class='fa fa-pencil-square-o'></span></a></div></div>
		<div class='content'>
			<div><p class='left'>Акция №:</p> <p class='right'>".$array[id]."</p></div>
			<div><p class='left'>Начало:</p> <p class='right'>".Date_time::our_date_format($array[date_start])."</p></div>
			<div><p class='left'>Конец:</p> <p class='right'>".Date_time::our_date_format($array[date_end])."</p></div>
			<div><p class='left'>Текст:</p> <p class='right'>$array[text]</p></div>
		</div>
		</div>";
	}
	else
	{
		$this->one_campaign = "<h2>Заданой акции не найдено</h2>";
	}
	
	}
}

function get_time_left($date_end)
{
	$met = $date_end." 00:00:00";
	$metTS = strtotime($met);
	//echo "Вы ввели время - " . strftime("%d-%m-%Y %H:%M", $metTS) . "<br />";
	//echo "Текущее время - " . strftime("%d-%m-%Y %H:%M") . "<br />";
	 
	$sub = $metTS - time();
	/*
	if ($sub < 0) {
		echo "\nУстановленная дата прошла<br />\n";
	} elseif ($sub > 0) {
		echo "\nУстановленная дата впереди<br />\n";
	} else {
		exit("\nУстановленно текущее время.<br />\n");
	}
	*/
		if ($sub > 0) {
		$sub = abs($sub);
		$this->time_left[days] = (int)($sub / (24*60*60));
		$this->time_left[hours] = (int)(($sub - $this->time_left[days] * 24 * 60 * 60) / (60*60));
		$this->time_left[min] = (int)(($sub - $this->time_left[days] * 24 * 60 *60 - $this->time_left[hours] * 60 * 60) / 60);
		$this->time_left[sec] = $sub - $this->time_left[days] * 24 * 60 *60 - $this->time_left[hours] * 60 * 60 - $this->time_left[min] * 60;
		/*
		echo "суток - $days<br />\n";
		echo "часов - $hours<br />\n";
		echo "минут - $min<br />\n";
		echo "секунд - $sec<br />\n";
		*/
	}
}

}
?>