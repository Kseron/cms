<?
class Settings {

var $admin_email;
var $shop_email;
var $shop_phone;
var $shop_phone_for_header;

var $settings_list;
var $this_setting;
var $red_result;

function __construct() 
{
	$this->admin_email = $this->get_setting("email администрации");
	$this->shop_email = $this->get_setting("email магазина");
	$this->shop_phone = $this->get_setting("Телефон магазина");
	$this->shop_phone_for_header = explode(")", $this->get_setting("Телефон магазина"));
	$this->shop_phone_for_header[0] .= ")";
	
	if($_GET[page] == "settings")
	{
		$this->create_settings_list($_GET[type]);
	}
	elseif($_GET[page] == "red_setting")
	{
		$this->red_setting($_GET[id]);
		$this->this_setting = mysql_fetch_array(mysql_query("SELECT * FROM settings WHERE id='$_GET[id]'"));
	}
}

function get_setting($title)
{
	$array = mysql_fetch_array(mysql_query("SELECT * FROM settings where title='$title'"));
	return $array["value"];
}


function create_settings_list($type)
{
	if($_SESSION[access] == 3)
	{
		$query = mysql_query("SELECT * FROM settings WHERE type='$type'");
		if(mysql_num_rows($query))
		{
			$this->settings_list .= "
			<ul class='material_list'>";
			while($array = mysql_fetch_array($query))
			{
				$this->settings_list .= "
				<li><b>$array[title]</b>: $array[value] ( $array[description] )
				<div class='tools'>
				<a href='/admin/red_setting/$array[id].html' class='config' title='Редактировать'></a>
				</div>
				</li>";
			}
			$this->settings_list .= "</ul>";
		}
	}
}

function red_setting($id)
{
	if($_SESSION[access] == 3 AND $id != "")
	{
		if($_POST[submit] != "")
		{
			if($_POST[value] != "")
			{
				mysql_query("UPDATE settings SET value='$_POST[value]', description='$_POST[description]' WHERE id='$id'");
				$this->red_result = "<div class='good_msg'>Настройка отредактирована</div>";
			}
			else
			{
				$this->red_result = "<div class='error_msg'>Не введено значение</div>";
			}
		}
	}
}

}