<?
class Photos {
var $photo_list;
var $admin_photo_list;
var $error_confirm;
var $delete_result;
var $add_result;
var $red_result;
var $this_photo;

var $select_category;

function __construct() 
{
	if($_GET[page] == "add_photo" AND $_POST[submit] != "")
	{
@		$this->create_select_category($_POST[category]);
		$this->add_photo();
	}
	elseif($_GET[page] == "add_photo")
	{
@		$this->create_select_category();
	}
	elseif($_GET[page] == "del_photo" AND $_GET[id] != "" /*AND $_SESSION[security] == "good"*/)
	{
		$this->delete_photo($_GET[id]);
	}
	elseif($_GET[page] == "photo_list")
	{
		$this->create_admin_photo_list();
	}
	elseif($_GET[page] == "video")
	{
		$this->create_photo_list();
	}
	if($_GET[script] == "photos" AND $_GET[type] == "edit_photo" AND $_GET[id] != "")
	{
		if($_POST[submit] != "")
		{
			$this->red_photo($_GET[id]);
		}
		$this->this_photo = mysql_fetch_array(mysql_query("SELECT * FROM photos WHERE id='$_GET[id]'"));
	}
	
}



function add_photo()
{
	if($_POST[title] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели название фото</div>";
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
		$eng_title = Functions::transliterate($_POST['title']);
			
		$query = mysql_query("INSERT into photos SET title='$_POST[title]', eng_title='$eng_title', category='$_POST[category]', datetime='$datetime'");
		$last_id = mysql_insert_id();
		if($query)
		{
			$image_file = $_FILES["photo"]["tmp_name"];
			if($image_file != "")
			{
				Graphics::save_image($_FILES["photo"]["tmp_name"], "../images/photos", "800", "$eng_title-$last_id.jpg", "80");
				Graphics::save_image($_FILES["photo"]["tmp_name"], "../images/photos", "250", "$eng_title-$last_id-250x250.jpg", "90");
			}

			$this->add_result = "<div class='good_msg'>Фото добавлено</div>";
			$_POST[title] = "";
			$_POST[datetime] = "";
		}
	}
}

function red_photo($id)
{
	if($id != "")
	{
		$query = mysql_query("UPDATE photos SET title='$_POST[title]' WHERE id='$id'");
		if($query)
		{
			$this->red_result = "<div class='good_msg'>Картинку успешно отредактировано</div>";
		}
		else
		{
			$this->red_result = "<div class='error_msg'>Картинку не удалось отредактировать</div>";
		}
	}
}

function delete_photo($id)
{
	$array = mysql_fetch_array(mysql_query("SELECT * FROM photos WHERE id='$id'"));
	if($array[id] != "")
	{
		unlink("../images/photos/$array[eng_title]-$array[id].jpg");
		unlink("../images/photos/$array[eng_title]-$array[id]-250x250.jpg");
		mysql_query("DELETE FROM photos WHERE id='$id'");
	}
	header("location:".$_SERVER[HTTP_REFERER]); 
}


function create_select_category($cat = "")
{
	$query = mysql_query("SELECT * FROM photos_category");
	while($array = mysql_fetch_array($query))
	{
		$this->select_category .= "
		<option value='$array[id]'";
		if($cat == $array[id]) { $this->select_category .= " selected"; }
		$this->select_category .= ">$array[title]</option>";
	}
}

function create_photo_list()
{
	$this->photo_list .= "<div class='section'>
	<div class='nav_container'>
	<ul class='tabs index_style'>
		<li class='current'>Перегородки фото</li>
		<li>Стены фотографии</li>
		<li>Потолки из гипсокартона фото</li>
	</ul>
	</div>
	<br />";
	
	$query_cat = mysql_query("SELECT * FROM photos_category LIMIT 3");
	while($array_cat = mysql_fetch_array($query_cat))
	{
		if($array_cat[id] != "")
		{
			if($array_cat[id] == 1)
			{
				$this->photo_list .= "
				<div class='box visible'>";
			}
			else
			{
				$this->photo_list .= "
				<div class='box'>";
			}
			$this->photo_list .= "
			<div class='photo_list'>";
			$query = mysql_query("SELECT * FROM photos WHERE category='$array_cat[id]'");
			while($array = mysql_fetch_array($query))
			{
				$this->photo_list .= "
				<div><a class='fancybox-thumbs' rel='photo-$array_cat[id]' href='/images/photos/$array[eng_title]-$array[id].jpg'><img src='/images/photos/$array[eng_title]-$array[id]-250x250.jpg' alt='$array[title]' title='$array[title]'></a></div>";
			}
			$this->photo_list .= "
			</div>
			</div>";
		}
	}
	
	$this->photo_list .= "
	</div>
	<br /><br />
	<h2>Фото - подборка гипсокартонных потолков в процессе изготовления</h2>
	<div class='photo_list'>";
	$query = mysql_query("SELECT * FROM photos WHERE category='4'");
	while($array = mysql_fetch_array($query))
	{
		$this->photo_list .= "
		<div><a class='fancybox-thumbs' rel='photo-4' href='/images/photos/$array[eng_title]-$array[id].jpg'><img src='/images/photos/$array[eng_title]-$array[id]-250x250.jpg' alt='$array[title]' title='$array[title]'></a></div>";
	}
	$this->photo_list .= "
	</div>";
}


function create_admin_photo_list()
{
	$query_cat = mysql_query("SELECT * FROM photos_category");
	while($array_cat = mysql_fetch_array($query_cat))
	{
		$this->admin_photo_list .= "
		<div class='categories'>
		<h3>$array_cat[title]</h3>";
		$query = mysql_query("SELECT * FROM photos WHERE category='$array_cat[id]'");
		if(mysql_num_rows($query) > 0)
		{
			$this->admin_photo_list .= "
			<div class='photo_list'>";
			while($array = mysql_fetch_array($query))
			{
				$this->admin_photo_list .= "
				<div class='photo'>
				<div class='tools'>
				<a href='/ajax/index.php?script=photos&type=edit_photo&id=$array[id]' class='fancybox' data-fancybox-type='iframe' title='Редактировать'><i class='fa fa-wrench'></i></a>
				<a href='del_photo/$array[id].html' title='Удалить'><i class='fa fa-times'></i></a></div>
				<a class='fancybox-thumbs' rel='photo-$array_cat[id]' href='/images/photos/$array[eng_title]-$array[id].jpg'><img src='/images/photos/$array[eng_title]-$array[id]-250x250.jpg' alt='$array[title]' title='$array[title]'></a>
				</div>";
				
			}
			$this->admin_photo_list .= "</div>";
		}
		$this->admin_photo_list .= "
		</div>";
	}
	$this->photo_list .= "<div class='section'>
	<div class='nav_container'>
	<ul class='tabs index_style'>
		<li class='current'>Перегородки фото</li>
		<li>Стены фотографии</li>
		<li>Потолки из гипсокартона фото</li>
	</ul>
	</div>
	<br />";
	
	$query_cat = mysql_query("SELECT * FROM photos_category LIMIT 3");
	while($array_cat = mysql_fetch_array($query_cat))
	{
		if($array_cat[id] != "")
		{
			if($array_cat[id] == 1)
			{
				$this->photo_list .= "
				<div class='box visible'>";
			}
			else
			{
				$this->photo_list .= "
				<div class='box'>";
			}
			$this->photo_list .= "
			<div class='photo_list'>";
			$query = mysql_query("SELECT * FROM photos WHERE category='$array_cat[id]'");
			while($array = mysql_fetch_array($query))
			{
				$this->photo_list .= "
				<div><a class='fancybox-thumbs' rel='photo-$array_cat[id]' href='/images/photos/$array[eng_title]-$array[id].jpg'><img src='/images/photos/$array[eng_title]-$array[id]-250x250.jpg' alt='$array[title]' title='$array[title]'></a></div>";
			}
			$this->photo_list .= "
			</div>
			</div>";
		}
	}
	$this->photo_list .= "
	</div>
	<br /><br />
	<h2>Фото - подборка гипсокартонных потолков в процессе изготовления</h2>
	<div class='photo_list'>";
	$query = mysql_query("SELECT * FROM photos WHERE category='4'");
	while($array = mysql_fetch_array($query))
	{
		$this->photo_list .= "
		<div><a class='fancybox-thumbs' rel='photo-4' href='/images/photos/$array[eng_title]-$array[id].jpg'><img src='/images/photos/$array[eng_title]-$array[id]-250x250.jpg' alt='$array[title]' title='$array[title]'></a></div>";
	}
	$this->photo_list .= "
	</div>";
}

}
?>