<?
class My_pages {
var $page;
var $file_exist;
var $this_page;

var $add_result;
var $red_result;

function __construct() 
{
	if($_GET['page'] == "add_page" AND isset($_POST['submit']))
	{
		$this->add_my_page();
	}
	elseif($_GET['page'] == "pages_list")
	{
		$this->create_my_pages();
	}
	elseif(($_GET['page'] == "red_page" AND $_GET['id'] != "") OR ($_GET[script] == "pages" AND $_GET[type] == "edit" AND $_GET['id'] != "" AND $_SESSION['user_type'] == 3))
	{
		if(isset($_POST['submit']))
		{
			$this->red_my_page();
		}
		$array = mysql_fetch_array(mysql_query("SELECT * FROM pages WHERE id='$_GET[id]'"));
		if($array[id] != "")
		{
			$this->this_page = $array;
		}
	}
	elseif($_GET['page'] == "del_page" AND $_GET['id'] != "")
	{
		$query = mysql_query("DELETE FROM pages WHERE id='$_GET[id]'");
	   	header('Location: '.$_SERVER[HTTP_REFERER]);
	}
}

function add_my_page()
{
	if($_SESSION[access] == 3)
	{
	
	if($_POST[url] == "")
	{
		$_POST[url] = Functions::transliterate($_POST[title]);
	}
	$check = mysql_query("SELECT id FROM pages WHERE url='$_POST[url]'");
	
	$this->check_form();
	if($this->form_status == TRUE)
	{
		//$check_name_page = mysql_num_rows(mysql_query(""));
		if($_POST[url] == "add_menu" OR $_POST[url] == "menu_list" 
		OR $_POST[url] == "add_category" OR $_POST[url] == "category_list"
		OR $_POST[url] == "add_good" OR $_POST[url] == "catalog"
		OR $_POST[url] == "add_page" OR $_POST[url] == "pages_list")
		{
			$this->add_result .= "<div class='error_msg'>Страница с таким URL недопустима</div>";
		}
		else
		{
			$query = mysql_query("INSERT into pages SET title='$_POST[title]', url='$_POST[url]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', special_design='$_POST[special_design]', vision='$_POST[vision]'");
			$last_id = mysql_insert_id();
			if($query)
			{
				if(mysql_num_rows($check) > 0)
				{
					$url = $_POST[url]."-".$last_id;
					mysql_query("UPDATE pages SET url='$url' WHERE id='$last_id'");
				}
				if($_FILES["image"]["tmp_name"] != "")
				{
					Graphics::save_image($_FILES["image"]["tmp_name"], "../images/backgrounds", "1920", "$last_id.jpg", "80");
				}
				$this->add_result .= "<div class='good_msg'>Страница успешно добавлена</div>";
				$_POST[title] = "";
				$_POST[url] = "";
				$_POST[text] = "";
				$_POST[description] = "";
				$_POST[keywords] = "";
				$_POST[special_design] = "";
			}
		}
	}
	
	}
}

function red_my_page()
{
	if($_SESSION[access] == 3 OR $_SESSION['user_type'] == 3)
	{
	
	$query = mysql_query("SELECT id FROM pages WHERE url='$_POST[url]' AND id !='$_GET[id]'");
	if(mysql_num_rows($query) > 0)
	{
		$url = $_POST[url]."-".$_GET[id];
		mysql_query("UPDATE pages SET url='$url' WHERE id='$_GET[id]'");
	}
	
	$this->check_form();
	if($this->form_status == TRUE)
	{
		if($_POST[url] == "")
		{
			$_POST[url] = Functions::transliterate($_POST[title]);
		}
		$query = mysql_query("UPDATE pages SET title='$_POST[title]', url='$_POST[url]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', special_design='$_POST[special_design]', vision='$_POST[vision]' WHERE id='$_GET[id]'");
		if($query)
		{
			$this->red_result .= "<div class='good_msg'>Страница успешно отредактирована</div>";
			if($_FILES["image"]["tmp_name"] != "")
			{
				unlink("../images/backgrounds/$_GET[id].jpg");
				Graphics::save_image($_FILES["image"]["tmp_name"], "../images/backgrounds", "1920", "$_GET[id].jpg", "80");
			}
		}
	}
	
	}
}

function check_form()
{
	if($_POST[title] == "")
	{
		$this->add_result .= "<div class='error_msg'>Вы не ввели название страницы</div>";
		$this->form_status = FALSE;
	}
	elseif($_POST[text] == "")
	{
		$this->add_result .= "<div class='error_msg'>Вы не ввели текст страницы</div>";
		$this->form_status = FALSE;
	}
	else
	{
		$this->form_status = TRUE;
	}
}

function create_my_pages()
{
	if($_SESSION[access] == 3)
	{
	
	$this->list_pages .= "
	<ul class='material_list'>";
	$query = mysql_query("SELECT * FROM pages ORDER by title");
	while($array = mysql_fetch_array($query))
	{
		$this->list_pages .= "
		<li><a href='/$array[url].html'>$array[title]</a>
		<div class='tools'>
		<a href='/admin/red_page/$array[id].html' class='config' title='Редактировать'></a>
		<a href='/admin/del_page/$array[id].html' class='remove' matherial_id='$array[id]' title='Удалить'></a>
		</div>
		</li>";
	}
	$this->list_pages .= "</ul>";
	}
}

}

?>