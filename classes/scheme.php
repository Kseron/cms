<?
class Scheme {
var $scheme_list;
var $one_scheme;
var $error_confirm;
var $delete_result;
var $add_result;
var $red_result;
var $this_scheme;

var $select_category;

function __construct() 
{
	if($_GET[page] == "add_scheme" AND $_POST[submit] != "")
	{
		$this->add_scheme();
	}
	elseif($_GET[page] == "shemcat" AND $_GET[id] != "")
	{
		$this->create_one_scheme($_GET[id]);
	}
	elseif($_GET[page] == "shemcat")
	{
		$this->create_scheme_list();
	}
	elseif($_GET[page] == "scheme")
	{
		$this->create_admin_scheme_list();
	}
	elseif($_GET[page] == "red_scheme" AND $_GET[id] != "")
	{
		if($_POST[submit] != "")
		{
@			$this->red_scheme($_GET[id]);
		}
		$this->this_scheme = mysql_fetch_array(mysql_query("SELECT * FROM scheme WHERE id='$_GET[id]'"));
	}
	elseif($_GET[page] == "del_scheme" AND $_GET[id] != "")
	{
		$this->delete_scheme($_GET[id]);
	}
}

function add_scheme()
{
	if($_POST[title] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели название</div>";
	}
	elseif($_POST[text] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели текст</div>";
	}
	else
	{
		if($_POST['eng_title'] != "")
		{
			$eng_title = $_POST['eng_title'];
		}
		else
		{
			$eng_title = Functions::transliterate($_POST['title']);
		}
		if(strlen($_POST[datetime]) < 19)
		{
			$datetime = Date_time::get_date("datetime");
		}
		else
		{
			$datetime = $_POST[datetime];
		}
		$query = mysql_query("INSERT into scheme SET title='$_POST[title]', eng_title='$eng_title', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', datetime='$datetime'");
		if($query)
		{
			$this->add_result = "<div class='good_msg'>Схема добавлена</div>";
			$_POST[title] = "";
			$_POST[text] = "";
			$_POST[description] = "";
			$_POST[keywords] = "";
			$_POST[datetime] = "";
		}
	}
}


function create_scheme_list()
{
	$this->scheme_list .= "<ul>";
	$query = mysql_query("SELECT * FROM scheme ORDER by id desc");
	while($array = mysql_fetch_array($query))
	{
		$this->scheme_list .= "
		<li><a href='/scheme-$array[id].html'>$array[title]</a></li>";
	}
	$this->scheme_list .= "</ul>";
}

function create_one_scheme($id = "")
{
@	$array = mysql_fetch_array(mysql_query("SELECT * FROM scheme WHERE id='$id'"));
	if($array != "")
	{
		$this->one_scheme = "<div class='full_new'>
		<h1>$array[title]</h1>
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

function red_scheme($id)
{
	if($_SESSION[access] == 3)
	{
	$id = eregi_replace("/[^0-9]/", "", $id);
	$query = mysql_query("SELECT id FROM scheme WHERE id='$id'");
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
		/*
		$eng_title = Functions::transliterate($_POST['title']);
		$check = mysql_query("SELECT id FROM articles WHERE eng_title='$eng_title' AND id != '$ids'");
		if(mysql_num_rows($check) > 0)
		{
			$eng_title = $eng_title."-".$id;
		}
		$query = mysql_query("UPDATE articles SET title='$_POST[title]', eng_title='$eng_title', category='$_POST[category]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', datetime='$datetime' WHERE id='$id'");
		*/
		$query = mysql_query("UPDATE scheme SET title='$_POST[title]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', datetime='$datetime' WHERE id='$id'");
		$last_id = mysql_insert_id();
		if($query)
		{
			$this->red_result = "<div class='good_msg'>Схема отредактирована</div>";
			$_POST[title] = "";
			$_POST[text] = "";
			$_POST[description] = "";
			$_POST[keywords] = "";
			$_POST[datetime] = "";
		}
	}
	}
	}
}
function delete_scheme($id)
{
	if($_SESSION[access] == 3)
	{
	$id = eregi_replace("/[^0-9]/", "", $id);
	$query = mysql_query("DELETE FROM scheme WHERE id='$id'");
	if($query)
	{
		$this->delete_result = "<p class='good_msg'>Схема удалена</p>";
	}
	else
	{
		$this->delete_result = "<p class='error_msg'>Схему удалить не удалось</p>";
	}
	}
	header("location:".$_SERVER[HTTP_REFERER]); 
}

function create_admin_scheme_list()
{
	$query = mysql_query("SELECT * FROM scheme ORDER by datetime desc");
	if(mysql_num_rows($query) > 0)
	{
		$this->admin_scheme_list .= "
		<ul class='material_list'>";
		while($array = mysql_fetch_array($query))
		{
			$this->admin_scheme_list .= "
			<li><a href='/scheme-$array[id].html'>$array[title]</a>
			<div class='tools'>
			<a href='/admin/red_scheme/$array[id].html' class='config' title='Редактировать'></a>
			<a href='/admin/del_scheme/$array[id].html' class='remove' matherial_id='6' title='Удалить'></a>
			</div>
			</li>";
		}
		$this->admin_scheme_list .= "</ul>";
	}
}

}
?>