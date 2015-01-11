<?
class Admin {
var $admin_menu;
var $login = "master";
var $password = "terminator";
var $error_text;


function __construct() 
{
	$this->create_active_menu($_GET['page']);
	
	if($_POST[admin_login] != "" AND $_POST[admin_password] != "")
	{
		$this->incoming();
	}
	if($_GET[page] == "admin_logout")
	{
		$_SESSION[access] = "";
		header("location:/admin/"); 
	}
}


function create_active_menu($page = "index")
{
	if($page == "products" OR $page == "add_product" OR $page == "list_product" OR $page == "add_category" OR $page == "category_list" OR $page == "red_category"
	OR $page == "product_list" OR $page == "product" OR $page == "red_product")
	{
		$this->admin_menu["products"] = " class='active'";
	}
	elseif($page == "orders" OR $page == "order" OR $page == "red_order")
	{
		$this->admin_menu["orders"] = " class='active'";
	}
	elseif($page == "callback_list")
	{
		$this->admin_menu["callback"] = " class='active'";
	}
	elseif($page == "articles" OR $page == "add_article" OR $page == "red_article" OR $page == "article_list" OR $page == "add_category_articles" OR $page == "article_category" OR $page == "red_article_category")
	{
		$this->admin_menu["articles"] = " class='active'";
	}
	elseif($page == "news" OR $page == "add_new" OR $page == "news_list" OR $page == "red_new")
	{
		$this->admin_menu["news"] = " class='active'";
	}
	elseif($page == "scheme" OR $page == "add_scheme" OR $page == "scheme_list" OR $page == "red_scheme")
	{
		$this->admin_menu["scheme"] = " class='active'";
	}
	elseif($page == "photos" OR $page == "add_photo" OR $page == "photo_list")
	{
		$this->admin_menu["photos"] = " class='active'";
	}
	elseif($page == "video" OR $page == "add_video" OR $page == "red_video" OR $page == "video_list" OR $page == "add_category_video" OR $page == "category_video_list")
	{
		$this->admin_menu["video"] = " class='active'";
	}
	elseif($page == "portfolio" OR $page == "add_albom" OR $page == "albom" OR $page == "portfolio_list" OR $page == "add_image" OR $page == "red_albom" OR $page == "del_albom"  )
	{
		$this->admin_menu["portfolio"] = " class='active'";
	}
	elseif($page == "add_campaign" OR $page == "campaigns_list" OR $page == "add_image" OR $page == "red_campaign" )
	{
		$this->admin_menu["campaigns"] = " class='active'";
	}
	elseif($page == "pages" OR $page == "add_page" OR $page == "pages_list" OR $page == "red_page")
	{
		$this->admin_menu["pages"] = " class='active'";
	}
	elseif($page == "users_list" OR $page == "user" OR $page == "del_user" OR $page == "red_user")
	{
		$this->admin_menu["users"] = " class='active'";
	}
	elseif($page == "content_blocks" OR $page == "red_content_block")
	{
		$this->admin_menu["blocks"] = " class='active'";
	}
	elseif($page == "settings" OR $page == "red_setting")
	{
		$this->admin_menu["settings"] = " class='active'";
	}
}

function incoming()
{
	if(md5($_POST[duck]) != $_SESSION["secret_code"])
	{
		$this->error_text = "<script>alert('Неправильно введена защитная строка (Капча)')</script>";
	}
	elseif($_POST[admin_login] == $this->login AND md5($_POST[admin_password]) == md5($this->password))
	{
		$_SESSION[access] = 3;
		$_SESSION["secret_code"] = "";
	}
	else
	{
		$this->error_text = "<script>alert('Неправильно введен логин или пароль!')</script>";
	}
}


}
?>