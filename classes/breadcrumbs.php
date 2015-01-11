<?
class Breadcrumbs {
var $breadcrumbs = "<a href='/'>Главная</a>";
function __construct()
{

}
function create_breadcrumbs($section = "product", $object = "")
{
	/*
	if($section == "catalog" AND $object != "")
	{
		if($type == "eng_title")
		{
			$array = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE eng_title='$object'"));
		}
		else
		{
			$array = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE id='$object'"));
		}
		
		if($array[id] != "")
		{
			$array2 = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE id='$array[parent]'"));
			if($array2[id] != "")
			{
				$this->breadcrumbs .= " » <a href='/catalog/$array2[id]/$array2[eng_title]'>$array2[title]</a>";
			}
			$this->breadcrumbs .= " » <a href='/catalog/$array[id]/$array[eng_title]'>$array[title]</a>";
		}
	}
	*/
	if($section == "page" AND  $object != "")
	{
		$this->breadcrumbs .= " » $object";
	}
	elseif($section == "scheme")
	{
		if($object == "")
		{
			$this->breadcrumbs .= " » Схемы";
		}
		else
		{
			$array = mysql_fetch_array(mysql_query("SELECT title FROM scheme WHERE id='$object'"));
			$this->breadcrumbs .= " » <a href='/shemcat.html'>Схемы</a> » $array[title]";
		}
	}
	elseif($section == "articles")
	{
		if($object == "")
		{
			$this->breadcrumbs .= " » Статьи";
		}
		else
		{
			$array = mysql_fetch_array(mysql_query("SELECT title FROM articles WHERE eng_title='$object'"));
			$this->breadcrumbs .= " » <a href='/stati.html'>Статьи</a> » $array[title]";
		}
	}
	elseif($section == "news")
	{
		if($object == "")
		{
			$this->breadcrumbs .= " » Новости";
		}
		else
		{
			$array = mysql_fetch_array(mysql_query("SELECT title FROM news WHERE eng_title='$object'"));
			$this->breadcrumbs .= " » <a href='/novosti.html'>Новости</a> » $array[title]";
		}
	}
	elseif($section == "porfolio")
	{
		if($object == "")
		{
			$this->breadcrumbs .= " » Наши работы";
		}
		else
		{
			$array = mysql_fetch_array(mysql_query("SELECT title FROM portfolio_alboms WHERE eng_title='$object'"));
			$this->breadcrumbs .= " » <a href='/gallery.html'>Наши работы</a> » $array[title]";
		}
	}
	elseif($section == "video")
	{
		if($object == "")
		{
			$this->breadcrumbs .= " » Фото и видео";
		}
		else
		{
			$array = mysql_fetch_array(mysql_query("SELECT title FROM video WHERE eng_title='$object'"));
			$this->breadcrumbs .= " » <a href='/video.html'>Фото и видео</a> » $array[title]";
		}
	}
	elseif($section == "catalog")
	{
		if($_GET[id] == "")
		{
			$this->breadcrumbs .= " » Наши товары";
		}
		else
		{
			$array = mysql_fetch_array(mysql_query("SELECT title, parent FROM category WHERE id='$_GET[id]'"));
			if($array['title'] != "")
			{
			$this->breadcrumbs .= " » <a href='/catalog.html'>Наши товары</a>";
			if($array['parent'] != 0)
			{
				$parent = mysql_fetch_array(mysql_query("SELECT id, title, eng_title FROM category WHERE id='".$array['parent']."'"));
				$this->breadcrumbs .= " » <a href='/catalog/$parent[id]/$parent[eng_title].html'>$parent[title]</a>";
			}
			$this->breadcrumbs .= " » $array[title]";
			}
		}
	}
	elseif($section == "product" AND $object != "")
	{
		$array = mysql_fetch_array(mysql_query("SELECT title, category FROM product_types WHERE id='$object'"));
		$category = mysql_fetch_array(mysql_query("SELECT id, title, eng_title FROM category WHERE id='$array[category]'"));
		$this->breadcrumbs .= " » <a href='/catalog.html'>Наши товары</a> » <a href='/catalog/$category[id]/$category[eng_title].html'>$category[title]</a> » $array[title]";
	}
	/*
	elseif($section == "account" AND $object != "")
	{
		$array = mysql_fetch_array(mysql_query("SELECT title, category FROM product_types WHERE id='$object'"));
		$category = mysql_fetch_array(mysql_query("SELECT id, title, eng_title FROM category WHERE id='$array[category]'"));
		$this->breadcrumbs .= " » <a href='/catalog.html'>Наши товары</a> » <a href='/catalog/$category[id]/$category[eng_title].html'>$category[title]</a> » $array[title]";
	}
	*/

}


}