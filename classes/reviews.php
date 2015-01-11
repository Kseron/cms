<?
class Reviews {

var $add_result;
var $del_result;
var $check_form;
var $review_list;

function __construct()
{
	if($_POST[review_submit] != "" AND $_GET[page] == "product" AND $_GET[title] != "")
	{
		$this->add_comment();
	}
	if($_GET[page] == "product" AND $_GET[title] != "")
	{
		$this->get_review_list($_GET[title]);
	}
}


function add_comment()
{
	$this->check_form();
	if($this->check_form != "error" AND $_SESSION[user] != "")
	{
		$product_title = str_replace("_", " ", $_GET[title]);
		$product_id = mysql_fetch_array(mysql_query("SELECT id FROM goods WHERE eng_title='$product_title'"));
		mysql_query("INSERT into reviews SET product='$product_id[id]', user='$_SESSION[user]', text='$_POST[text]', dignity='$_POST[dignity]', shortcomings='$_POST[shortcomings]', datetime='".Date_time::get_date("datetime")."'");
		$this->add_result .= "<p class='good_msg'>Ваш отзыв добавлен. Благодарим Вас.</p>";
	}
}

function check_form()
{
	if($_POST[name] == "")
	{
		$this->add_result .= "<p class='error_msg'>Ви не ввели свой никнейм</p>";
		$error = 1;
	}
	if($_POST[email] == "")
	{
		$this->add_result .= "<p class='error_msg'>Ви не ввели свой email</p>";
		$error = 1;
	}
	if($_POST[text] == "")
	{
		$this->add_result .= "<p class='error_msg'>Ви не ввели текст сообщения/p>";
		$error = 1;
	}
	if($error == 1)
	{
		$this->check_form = "error";
	}
}

function get_review_list($title)
{
	$eng_title = str_replace("_", " ", $title);
	$good =  mysql_fetch_array(mysql_query("SELECT id FROM goods WHERE eng_title='$eng_title'"));
	$query = mysql_query("SELECT * FROM reviews WHERE product='$good[id]'");
	while($array = mysql_fetch_array($query))
	{
		$user = mysql_fetch_array(mysql_query("SELECT login FROM users WHERE id='$array[user]'"));
		$this->review_list .= "<div class='review'>
		<p><b>$user[login]</b>, ".Date_time::our_datetime_format_mounth_nosec($array[datetime]);
		if($_SESSION['user_type'])
		{
		$this->review_list .= " <span class='review_del link' id_review='$array[id]'>X</span>";
		}
		$this->review_list .= "</p>
		<p>$array[text]</p>";
		if($array[dignity] != "" AND $array[shortcomings] != "")
		{
			$this->review_list .= "<div style='overflow:hidden;'>
			<p class='dignity_shortcomings'>+</p> <p>$array[dignity]</p>
			</div>
			<div style='overflow:hidden;'>
			<p class='dignity_shortcomings'>-</p> <p>$array[shortcomings]</p>
			</div>";
		}
		$this->review_list .= "</div>";
	}
}

function del_review($id)
{
	$check = mysql_fetch_array(mysql_query("SELECT id FROM reviews WHERE id='$id'"));
	if($check[id] != "")
	{
		mysql_query("DELETE FROM reviews WHERE review='$id'");
		$query = mysql_query("DELETE FROM reviews WHERE id='$id'");
		if($query)
		{
			$this->del_result = "<p class='good_msg'>Отзыв удален</p>";
		}
		else
		{
			$this->del_result = "<p class='good_msg'>Отзыв не удален по неизвестной причине</p>";
		}
	}
	else
	{
		$this->del_result = "<p class='good_msg'>Отзыв не найден в базе данных</p>";
	}
}

}