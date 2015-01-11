<?
class Callback {

var $add_result;
var $callback_list;
var $str_callback_list;
var $callbacks_on_str = 30;
var $send_letter;

function __construct() 
{
	if($_POST[callback_send] != "")
	{
		$this->add_callback();
	}
	
	if($_GET[page] == "callback_list")
	{
		$this->create_callback_list();
	}
	elseif($_GET[page] == "kontakty" AND $_POST[name] != "" AND $_POST[email] != "" AND $_POST[theme] != "" AND $_POST[contact_message] != "")
	{
		$this->add_letter();
	}
	elseif($_GET[page] == "remove_callback")
	{
		$this->remove_callback($_GET[id]);
	}
	elseif($_GET[page] == "replied_callback")
	{
		$this->replied_callback($_GET[id]);
	}
	elseif($_GET[page] == "unreplied_callback")
	{
		$this->unreplied_callback($_GET[id]);
	}
}


function add_callback()
{
	if($_POST[name] != "" AND $_POST[phone] != "")
	{
		//Защита от ботов
		if( Defence::antibot($_POST[text], 0, 4) == TRUE AND Defence::antibot($_POST[name], 0, 4) == TRUE AND Defence::antibot($_POST[phone], 0, 4) == TRUE )
		{
		
		if($_POST[text] == "" AND $_POST[campaign] != "")
		{
			$text = addslashes("Заявка создана по акции <a href='campaign/".$_POST[campaign].".html'>".$_POST[campaign_title]."</a>");
		}
		else
		{
			$text = $_POST[text];
		}
		
		$query = mysql_query("INSERT into callbacks SET name='$_POST[name]', phone='$_POST[phone]', text='".$text."', datetime='".Date_time::get_date("datetime")."', status='new'");
		if($query)
		{
			$this->add_result = "<script>alert('Ваша заявка принята. Скоро с Вами свяжется наш оператор');</script>";
			
			if($_POST[product_id] != "")
			{
			$admin_email = mysql_fetch_array(mysql_query("SELECT * FROM settings WHERE eng_title='admin_email'"));
			$product = mysql_fetch_array(mysql_query("SELECT title, eng_title FROM product_types WHERE id='".$_POST[product_id]."'"));
			if($_SESSION[user] != "" AND $_SESSION[login] != "")
			{
				$user = "Пользователь $_SESSION[login]";
			}
			else
			{
				$user = "Анонимный пользователь";
			}
			$message = "Добрый день.\n
			$user подал быстрый заказ продукта ".$product['title']." - http://www.gipsa.ru/product/".$_POST['product_id']."/".$product['eng_title'].".html.\n\n
			ДЕТАЛИ:\n
			Имя: ".$_POST[name]."\n
			Телефон: ".$_POST[phone]."\n
			Комментарий: ".$text."\n\n		
			Просмотреть подробности быстрого заказа можно в среде системы администрации:\n
			http://www.gipsa.ru/admin/callback_list.html\n
			\n";
			mail($admin_email[value], "Новый заказ", $message,
			"From: noreply@gipsa.ru\n"
			."X-Mailer: PHP/" . phpversion()."\r\n"."Content-Type: text/plain; charset=UTF-8 \r\n");
			}
		}
		else
		{
			$this->add_result = "<script>alert('Ваша заявка не принята. Может быть вы не полностью заполнили форму?');</script>";
		}
		
		}
		else
		{
			$this->add_result = "<script>alert('Ваша заявка не принята. Не стоит использовать html-теги и BB-коды. Может вы робот?');</script>";
		}
	}
	else
	{
		$this->add_result = "<script>alert('Ваша заявка не принята. Может быть вы не полностью заполнили форму?');</script>";
	}
}

function create_callback_list()
{
	if($_SESSION[access] == 3)
	{
	
	if($_GET[status] == "new")
	{
		$stipulation .= " AND status='new'";
	}
	elseif($_GET[status] == "replied")
	{
		$stipulation .= " AND status='replied'";
	}
	
	$query = mysql_query("SELECT id FROM callbacks WHERE (1=1)".$stipulation);
	@$num_rows_str = mysql_num_rows($query);	
	if($num_rows_str > 0)
	{
		//Сторінки
		$str = $_GET[str];
		$total = ceil($num_rows_str / $this->callbacks_on_str);
		if(empty($str) or $str < 0) { $str = 1; }
		if($str > $total) { $str = $total; }
		$str_start = $str * $this->callbacks_on_str - $this->callbacks_on_str;
	
		$storinka = "/admin/callback_list.html";
		if($total > 1)
		{
		
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
		
		$this->str_callback_list = "<div class='pages'> $pervstr";
		if($str == $total) $this->str_callback_list .= "$str6left $str5left $str4left";
		if($str == $total-1) $this->str_callback_list .= "$str5left $str4left";
		if($str == $total-2) $this->str_callback_list .= "$str4left";
		$this->str_callback_list .= " ".$str3left." ".$str2left." ".$str1left." <span>".$str."</span> ".$str1right." ".$str2right." ".$str3right." ";
		if($str == 1) $this->str_callback_list .= " $str4right $str5right $str6right";
		if($str == 2) $this->str_callback_list .= " $str4right $str5right";
		if($str == 3) $this->str_callback_list .= " $str4right";
		$this->str_callback_list .= " ".$nextstr."</div>";
		
		}
		
		
	$query = mysql_query("SELECT * FROM callbacks WHERE (1=1)".$stipulation." ORDER by datetime desc");
	while($array = mysql_fetch_array($query))
	{
		$status = $this->translate_status($array[status]);
		if($array[status] == "new")
		{
		$this->callback_list .="
		<div class='blue_block callback_block block' matherial_id='$array[id]'>";
		}
		else
		{
			$this->callback_list .="
			<div class='green_block callback_block block' matherial_id='$array[id]'>";
		}
		$this->callback_list .="
		<div class='title'>$array[name] ($array[datetime]) - <b>$status</b>
			<div class='tools'>";
			if($array[status] == "new")
			{
				$this->callback_list .="<a href='/replied_callback.html?id=$array[id]' class='collapse' title='Отметить как обработаный запрос'></a>";
			}
			elseif($array[status] == "replied")
			{
				$this->callback_list .="<a href='/unreplied_callback.html?id=$array[id]' class='reload' title='Отметить как новый запрос'></a>";
			}
			$this->callback_list .="<!--<a href='javascript:;' class='config'></a>-->
			<a href='/remove_callback.html?id=$array[id]' class='remove' matherial_id='$array[id]'></a>
			</div>
		</div>
		<div class='content'><b>$array[phone]</b><br />
		$array[text]</div>
		</div>
		";
	}
	}
	
	}
}

function add_letter()
{
	$query = mysql_query("INSERT into letters SET name='$_POST[name]', email='$_POST[email]', theme='$_POST[theme]', text='$_POST[contact_message]', datetime='".Date_time::get_date("datetime")."', status='Непрочитано'");
	$this->send_letter = "<div class='good_msg'>Ваше сообщение отправлено администрации сайта</div>";
}

function remove_callback($id)
{
	if($id != "" AND $_SESSION[access] == 3)
	{
		$query = mysql_query("DELETE from callbacks WHERE id='$id'");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']); 
}

function replied_callback($id)
{
	if($id != "" AND $_SESSION[access] == 3)
	{
		$query = mysql_query("UPDATE callbacks SET status='replied' WHERE id='$id'");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']); 
}
function unreplied_callback($id)
{
	if($id != "" AND $_SESSION[access] == 3)
	{
		$query = mysql_query("UPDATE callbacks SET status='new' WHERE id='$id'");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']); 
}

function translate_status($status)
{
	if($status == "new")
	{
		$new_status = "Новый";
	}
	elseif($status == "replied")
	{
		$new_status = "Отвечен";
	}
	return $new_status;
}


}
?>