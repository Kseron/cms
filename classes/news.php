<?
class News {
var $news_list;
var $one_new;
var $this_new;
var $str_list_new;
var $news_on_str = 10;
var $error_confirm;
var $delete_result;
var $add_result;

var $select_category;
var $admin_news_list;

function __construct() 
{
//@	$this->create_select_category();
	if($_GET[page] == "add_new" AND $_POST[submit] != "")
	{
		$this->add_new();
	}
	elseif($_GET[page] == "novosti" AND $_GET[eng_title] != "")
	{
		$this->create_one_new($_GET[eng_title]);
	}
	elseif($_GET[page] == "novosti")
	{
		$this->create_new_list();
		//$this->create_str_news_list();
	}
	elseif($_GET[page] == "news")
	{
		$this->create_admin_news_list();
	}
	elseif($_GET[page] == "red_new" AND $_GET[id] != "")
	{
		if($_POST[submit] != "")
		{
@			$this->red_new($_GET[id]);
		}
		$this->this_new = mysql_fetch_array(mysql_query("SELECT * FROM news WHERE id='$_GET[id]'"));
	}
	elseif($_GET[page] == "del_new" AND $_GET[id] != "")
	{
		$this->delete_new($_GET[id]);
	}
}

function add_new()
{
	if($_POST[title] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели название новости</div>";
	}
	elseif($_POST[text] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели текст новости</div>";
	}
	else
	{
		if(strlen($_POST[datetime]) < 19)
		{
			$datetime = Date_time::get_date("datetime");
		}
		else
		{
			$datetime = $_POST[datetime];
		}
		
		if($_POST[eng_title] != "")
		{
			$eng_title = $_POST[eng_title];
		}
		else
		{
			$eng_title = Functions::transliterate($_POST['title']);
		}
		$check = mysql_query("SELECT id FROM news WHERE eng_title='$eng_title'");
		$query = mysql_query("INSERT into news SET title='$_POST[title]', eng_title='$eng_title', short_text='$_POST[short_text]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', datetime='$datetime'");
		$last_id = mysql_insert_id();
		if($query)
		{
			if(mysql_num_rows($check) > 0)
			{
				$eng_title = $eng_title."-".$last_id;
				mysql_query("UPDATE news SET eng_title='$eng_title' WHERE id='$last_id'");
			}
			$this->add_result = "<div class='good_msg'>Новость добавлена</div>";
			$_POST[title] = "";
			$_POST[short_text] = "";
			$_POST[text] = "";
			$_POST[datetime] = "";
		}
	}
}


function create_new_list()
{
	//$query = mysql_query("SELECT id FROM news WHERE (1=1)".$stipulation);
	$query = mysql_query("SELECT id FROM news");
	@$num_rows_str = mysql_num_rows($query);	
	if($num_rows_str > 0)
	{
		//Сторінки
		$str = $_GET[str];
		$total = ceil($num_rows_str / $this->news_on_str);
		if(empty($str) or $str < 0) { $str = 1; }
		if($str > $total) { $str = $total; }
		$str_start = $str * $this->news_on_str - $this->news_on_str;
		
		$storinka = "/catalog/$_GET[id]/$_GET[category].html";
		if($total < 3 )
		{
			$pervstr = ""; $nextstr = "";
		}
		else
		{
			// Проверяем нужны ли стрелки назад 
			if ($str > 4) $pervstr = "<a href='".$storinka."'>1</a> ...";
			// Проверяем нужны ли стрелки вперед 
			if ( $str >= $total - 5) $nextstr = "";
			elseif ($str != $total) $nextstr = "... <a href='".$storinka."/".$total."'>".$total."</a>"; 
		}
		// Находим дві ближайшие станицы с обоих краев, если они есть
		if($str - 6 > 0) $str6left = '<a href='.$storinka.'/'. ($str - 6) .'>'. ($str - 6) .'</a>'; 
		if($str - 5 > 0) $str5left = '<a href='.$storinka.'/'. ($str - 5) .'>'. ($str - 5) .'</a>'; 
		if($str - 4 > 0) $str4left = '<a href='.$storinka.'/'. ($str - 4) .'>'. ($str - 4) .'</a>'; 
		if($str - 3 > 0) $str3left = '<a href='.$storinka.'/'. ($str - 3) .'>'. ($str - 3) .'</a>'; 
		if($str - 2 > 0) $str2left = '<a href='.$storinka.'/'. ($str - 2) .'>'. ($str - 2) .'</a>'; 
		if($str - 1 > 0 AND $str - 1 > 1) { $str1left = '<a href='.$storinka.'/'. ($str - 1) .'>'. ($str - 1) .'</a>'; }
		elseif($str - 1 > 0) { $str1left = '<a href='.$storinka.'>'. ($str - 1) .'</a>'; }
		if($str + 1 <= $total) $str1right = '<a href='.$storinka.'/'. ($str + 1) .'>'. ($str + 1) .'</a>';
		if($str + 2 <= $total) $str2right = '<a href='.$storinka.'/'. ($str + 2) .'>'. ($str + 2) .'</a>';
		if($str + 3 <= $total) $str3right = '<a href='.$storinka.'/'. ($str + 3) .'>'. ($str + 3) .'</a>';
		if($str + 4 <= $total) $str4right = '<a href='.$storinka.'/'. ($str + 4) .'>'. ($str + 4) .'</a>';
		if($str + 5 <= $total) $str5right = '<a href='.$storinka.'/'. ($str + 5) .'>'. ($str + 5) .'</a>';
		if($str + 6 <= $total) $str6right = '<a href='.$storinka.'/'. ($str + 6) .'>'. ($str + 6) .'</a>';
		
		$this->str_list_new = "<div class='pages'> $pervstr";
		if($str == $total) $this->str_list_new .= "$str6left $str5left $str4left";
		if($str == $total-1) $this->str_list_new .= "$str5left $str4left";
		if($str == $total-2) $this->str_list_new .= "$str4left";
		$this->str_list_new .= " ".$str3left." ".$str2left." ".$str1left." <span>".$str."</span> ".$str1right." ".$str2right." ".$str3right." ";
		if($str == 1) $this->str_list_new .= " $str4right $str5right $str6right";
		if($str == 2) $this->str_list_new .= " $str4right $str5right";
		if($str == 3) $this->str_list_new .= " $str4right";
		$this->str_list_new .= " ".$nextstr."</div>";
	}
	
	$query = mysql_query("SELECT * FROM news ORDER by datetime desc LIMIT $str_start, $this->news_on_str");
	while($array = mysql_fetch_array($query))
	{
		if($array[id] != "")
		{
			$this->news_list .= "
			<div class='new'>
			<div class='title'><a href='/novosti/$array[eng_title].html'>$array[title]</a></div>
			<div class='datetime'><span>".Date_time::our_datetime_format_mounth_nosec($array[datetime])."</span></div>
			<div class='content'>
			$array[short_text]
			</div>
			</div>";
		}
	}
}

function create_one_new($eng_title = "")
{
@	$array = mysql_fetch_array(mysql_query("SELECT * FROM news WHERE eng_title='$eng_title'"));
	if($array != "")
	{
		$this->one_new = "<div class='new'>
		<h1>$array[title]</h1>
		<div class='datetime'><span>".Date_time::our_datetime_format($array[datetime])."</span></div>
		<div class='content'>
		$array[text]
		</div>
		</div>";
	}
	else
	{
		Pages::$page = "pages/error.php";
		Pages::get_error("404");
	}
}

function red_new($id)
{
	$id = eregi_replace("/[^0-9]/", "", $id);
	$query = mysql_query("SELECT id FROM news WHERE id='$id'");
	if(mysql_num_rows($query) > 0)
	{
	if($_POST[title] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели название</div>";
	}
	elseif($_POST[text] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели текст</div>";
	}
	elseif($_POST[short_text] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели краткий текст</div>";
	}
	else
	{
		if(strlen($_POST[datetime]) < 19)
		{
			$datetime = Date_time::get_date("datetime");
		}
		else
		{
			$datetime = $_POST[datetime];
		}
		
		if($_POST[eng_title] != "")
		{
			$eng_title = $_POST[eng_title];
		}
		else
		{
			$eng_title = Functions::transliterate($_POST['title']);
		}
		
		$query = mysql_query("UPDATE news SET title='$_POST[title]', eng_title='$_POST[eng_title]', short_text='$_POST[short_text]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', datetime='$datetime' WHERE id='$id'");
		$last_id = mysql_insert_id();
		if($query)
		{

			$this->red_result = "<div class='good_msg'>Новость отредактирована</div>";
			$_POST[title] = "";
			$_POST[short_text] = "";
			$_POST[text] = "";
			$_POST[description] = "";
			$_POST[keywords] = "";
			$_POST[datetime] = "";
		}
	}
	}
}
function delete_new($id)
{
	$id = eregi_replace("/[^0-9]/", "", $id);
	$query = mysql_query("DELETE FROM news WHERE id='$id'");
	if($query)
	{
		$this->delete_result = "<p class='good_msg'>Новость удалена</p>";
	}
	else
	{
		$this->delete_result = "<p class='error_msg'>Новость удалить не удалось</p>";
	}
	header("location:".$_SERVER[HTTP_REFERER]); 
}

function create_admin_news_list()
{
	$query = mysql_query("SELECT * FROM news ORDER by datetime desc");
	if(mysql_num_rows($query) > 0)
	{
		$this->admin_news_list .= "
		<ul class='material_list'>";
		while($array = mysql_fetch_array($query))
		{
			$this->admin_news_list .= "
			<li><a href='/novosti/$array[eng_title].html'>$array[title]</a>
			<div class='tools'>
			<a href='/admin/red_new/$array[id].html' class='config' title='Редактировать'></a>
			<a href='/admin/del_new/$array[id].html' class='remove' matherial_id='6' title='Удалить'></a>
			</div>
			</li>";
		}
		$this->admin_news_list .= "</ul>";
	}
}


}
?>