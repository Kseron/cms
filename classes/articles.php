<?
class Articles {
var $articles_list;
var $admin_articles_list;
var $article_category_list;
var $this_article_category;
var $one_article;
var $this_article;
var $error_confirm;

var $add_result;
var $red_result;
var $delete_result;

var $select_category;
var $index_articles;

function __construct() 
{
	if($_GET[page] == "index" OR $_GET[page] == "")
	{
@		$this->create_index_articles();
	}
	if($_GET[page] == "add_article" AND $_POST[submit] != "")
	{
@		$this->create_select_category($_POST[category]);
		$this->add_article();
	}
	elseif($_GET[page] == "add_article")
	{
@		$this->create_select_category();
	}
	elseif($_GET[page] == "add_category_articles" AND $_POST[submit] != "")
	{
		$this->add_category_articles();
	}
	elseif($_GET[page] == "stati" AND $_GET[eng_title] != "")
	{
		$this->create_one_article($_GET[eng_title]);
	}
	elseif($_GET[page] == "stati")
	{
		$this->create_articles_list();
	}
	elseif($_GET[page] == "article_list")
	{
		$this->create_admin_articles_list();
	}
	elseif(($_GET[page] == "red_article" AND $_GET[id] != "") OR ($_GET[script] == "articles" AND $_GET[type] == "edit" AND $_GET[id] != ""))
	{
		if($_POST[submit] != "")
		{
@			$this->red_article($_GET[id]);
		}
		$this->this_article = mysql_fetch_array(mysql_query("SELECT * FROM articles WHERE id='$_GET[id]'"));
		$this->create_select_category($this->this_article[category]);
	}
	elseif($_GET[page] == "del_article" AND $_GET[id] != "")
	{
		$this->delete_article($_GET[id]);
	}
	elseif($_GET[page] == "article_category")
	{
		$this->create_article_category_list();
	}
	elseif($_GET[page] == "red_article_category" AND $_GET[id] != "")
	{
		if($_POST[submit] != "")
		{
			$this->red_article_category();
		}
		$this->this_article_category = mysql_fetch_array(mysql_query("SELECT * FROM articles_category WHERE id='$_GET[id]'"));
	}
	elseif($_GET[page] == "del_article_category" AND $_GET[id] != "")
	{
		$this->delete_article_category();
	}
}

function add_category_articles()
{
	if($_SESSION[access] == 3)
	{
	
	if($_POST[title] != "")
	{
		$eng_title = Functions::transliterate($_POST['title']);
		$query = mysql_query("INSERT into articles_category SET title='$_POST[title]', eng_title='$eng_title'");
		if($query)
		{
			$this->add_result = "<div class='good_msg'>Категория добавлена</div>";
		}
	}
	else
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели название категории</div>";
	}
	
	}
}

function red_article_category()
{
	if($_SESSION[access] == 3)
	{
	
	if($_GET[id] != "" AND $_POST[submit] != "" AND $_POST[title] != "")
	{
		$eng_title = Functions::transliterate($_POST['title']);
		$query = mysql_query("UPDATE articles_category SET title='$_POST[title]', eng_title='$eng_title' WHERE id='$_GET[id]'");
		if($query)
		{
			$this->red_result = "<div class='good_msg'>Категория отредактирована</div>";
		}
		else
		{
			$this->red_result = "<div class='error_msg'>Сбой в запросе к базе данных. Категория не отредактирована</div>";
		}
	}
	else
	{
		$this->red_result = "<div class='error_msg'>Вы не ввели название категории</div>";
	}
	
	}
}

function delete_article_category()
{
	if($_SESSION[access] == 3)
	{
	
	if($_GET[id] != "")
	{
		$query = mysql_query("DELETE FROM articles_category WHERE id='$_GET[id]'");
		if($query)
		{
			mysql_query("UPDATE articles SET category='0' WHERE category='$_GET[id]'");
			$this->del_result = "<div class='good_msg'>Категория удалена</div>";
		}
		else
		{
			$this->del_result = "<div class='error_msg'>Сбой в запросе к базе данных. Категория не удалена</div>";
		}
	}
	
	}
	header("location:".$_SERVER[HTTP_REFERER]); 
}

function add_article()
{
	if($_SESSION[access] == 3)
	{
	
	if($_POST[title] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели название статьи</div>";
	}
	elseif($_POST[text] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели текст статьи</div>";
	}
	elseif($_POST[category] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не указали категорию</div>";
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
		$check = mysql_query("SELECT id FROM articles WHERE eng_title='$eng_title'");
		$query = mysql_query("INSERT into articles SET title='$_POST[title]', eng_title='$eng_title', category='$_POST[category]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', datetime='$datetime'");
		$last_id = mysql_insert_id();
		if($query)
		{
			if(mysql_num_rows($check) > 0)
			{
				$eng_title = $eng_title."-".$last_id;
				mysql_query("UPDATE articles SET eng_title='$eng_title' WHERE id='$last_id'");
			}
			$this->add_result = "<div class='good_msg'>Статья добавлена</div>";
			$_POST[title] = "";
			$_POST[text] = "";
			$_POST[description] = "";
			$_POST[keywords] = "";
			$_POST[datetime] = "";
		}
	}
	
	}
}

function red_article($id)
{
	if($_SESSION[access] == 3 OR $_SESSION['user_type'] == 3)
	{
	
	$id = eregi_replace("/[^0-9]/", "", $id);
	$query = mysql_query("SELECT id FROM articles WHERE id='$id'");
	if(mysql_num_rows($query) > 0)
	{
	if($_POST[title] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели название статьи</div>";
	}
	elseif($_POST[text] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели текст статьи</div>";
	}
	elseif($_POST[category] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не указали категорию</div>";
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
		
		$query = mysql_query("UPDATE articles SET title='$_POST[title]', eng_title='$eng_title', category='$_POST[category]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', datetime='$datetime' WHERE id='$id'");
		$last_id = mysql_insert_id();
		if($query)
		{

			$this->red_result = "<div class='good_msg'>Статья отредактирована</div>";
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

function delete_article($id)
{
	if($_SESSION[access] == 3)
	{
	
	$id = eregi_replace("/[^0-9]/", "", $id);
	$query = mysql_query("DELETE FROM articles WHERE id='$id'");
	if($query)
	{
		$this->delete_result = "<p class='good_msg'>Статья удалена</p>";
	}
	else
	{
		$this->delete_result = "<p class='error_msg'>Статью удалить не удалось</p>";
	}
	
	
	}
	header("location:".$_SERVER[HTTP_REFERER]); 
}


function create_select_category($cat = "")
{
	$query = mysql_query("SELECT * FROM articles_category");
	while($array = mysql_fetch_array($query))
	{
		$this->select_category .= "
		<option value='$array[id]'";
		if($cat == $array[id]) { $this->select_category .= " selected"; }
		$this->select_category .= ">$array[title]</option>";
	}
}

function create_articles_list()
{
	$query_cat = mysql_query("SELECT * FROM articles_category");
	while($array_cat = mysql_fetch_array($query_cat))
	{
		if($array_cat[id] != "")
		{
			$this->articles_list .= "
			<div class='video_category'>
			<h3>$array_cat[title]</h3>";
			$query = mysql_query("SELECT * FROM articles WHERE category='$array_cat[id]'");
			if(mysql_num_rows($query) > 0)
			{
				$this->articles_list .= "
				<ul class='video_list'>";
				while($array = mysql_fetch_array($query))
				{
					$this->articles_list .= "
					<li><a href='/statia-$array[eng_title].html'>$array[title]</a></li>";
				}
				$this->articles_list .= "</ul>";
			}
			$this->articles_list .= "
			</div>";
		}
	}
	
	$query = mysql_query("SELECT * FROM articles WHERE category='0'");
	if(mysql_num_rows($query) > 0)
	{
		$this->articles_list .= "
		<div class='video_category'>
		<h3>Без категории</h3>
		<ul class='video_list'>";
		while($array = mysql_fetch_array($query))
		{
			$this->articles_list .= "
			<li><a href='/statia-$array[eng_title].html'>$array[title]</a></li>";
		}
		$this->articles_list .= "</ul>";
	}
	$this->articles_list .= "
	</div>";	
}

function create_admin_articles_list()
{
	if($_SESSION[access] == 3)
	{
	
	$query_cat = mysql_query("SELECT * FROM articles_category");
	while($array_cat = mysql_fetch_array($query_cat))
	{
		if($array_cat[id] != "")
		{
			$this->admin_articles_list .= "
			<div class='categories'>
			<h3>$array_cat[title]</h3>";
			$query = mysql_query("SELECT * FROM articles WHERE category='$array_cat[id]'");
			if(mysql_num_rows($query) > 0)
			{
				$this->admin_articles_list .= "
				<ul class='material_list'>";
				while($array = mysql_fetch_array($query))
				{
					$this->admin_articles_list .= "
					<li><a href='/statia-$array[eng_title].html'>$array[title]</a>
					<div class='tools'>
					<!--<a href='/admin/red_article/$array[id].html' class='collapse' title='Отметить как обработаный запрос'></a>-->
					<a href='/admin/red_article/$array[id].html' class='config' title='Редактировать'></a>
					<a href='/admin/del_article/$array[id].html' class='remove' matherial_id='6' title='Удалить'></a>
					</div>
					</li>";
				}
				$this->admin_articles_list .= "</ul>";
			}
			$this->admin_articles_list .= "
			</div>";
		}
	}
	
	}
}

function create_article_category_list()
{
	if($_SESSION[access] == 3)
	{
	
	$query = mysql_query("SELECT * FROM articles_category ORDER by title");
	if(mysql_num_rows($query) > 0)
	{
		$this->article_category_list .= "<ul class='material_list'>";
		while($array = mysql_fetch_array($query))
		{
			$this->article_category_list .= "<li>$array[title]
			<div class='tools'>
			<a href='red_article_category/$array[id].html' class='config'></a>
			<a href='del_article_category/$array[id].html' class='remove'></a>
			</div>
			</li>";
		}
		$this->article_category_list .= "</ul>";
	}
	
	}
}

function create_one_article($eng_title = "")
{
@	$array = mysql_fetch_array(mysql_query("SELECT * FROM articles WHERE eng_title='$eng_title'"));
	if($array != "")
	{
		$this->one_article = "<div class='full_new'>
		<h1>$array[title]</h1>
		<div class='datetime'>".Date_time::our_datetime_format($array[datetime])."</div>";
	if($_SESSION['user_type'] == 3)
	{
		$this->one_article .= "<div class='edit_block'><a href='/ajax/index.php?script=articles&type=edit&id=".$array['id'].".html' class='fancybox' data-fancybox-type='iframe'><span class='fa fa-pencil-square-o'></span></a></div>";
	}
		$this->one_article .= "<div class='content'>
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

function create_index_articles()
{
	$this->index_articles .= "<ul>";
	$query = mysql_query("SELECT * FROM articles ORDER by datetime desc LIMIT 5");
	while($array = mysql_fetch_array($query))
	{
		$this->index_articles .= "
		<li><a href='/statia-$array[eng_title].html'>$array[title]</a></li>";
	}
	$this->index_articles .= "</ul>";
}


}
?>