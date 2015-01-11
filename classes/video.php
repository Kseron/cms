<?
class Video {
var $video_list;
var $one_video;
var $error_confirm;
var $delete_result;
var $add_result;
var $this_video;

var $select_category;
var $index_video;

function __construct() 
{
//@	$this->create_select_category();
	if($_GET[page] == "index" OR $_GET[page] == "")
	{
@		$this->create_index_video();
	}
	if($_GET[page] == "add_video" AND $_POST[submit] != "")
	{
@		$this->create_select_category($_POST[category]);
		$this->add_video();
	}
	elseif($_GET[page] == "add_video")
	{
@		$this->create_select_category();
	}
	elseif($_GET[page] == "add_category_video" AND $_POST[submit] != "")
	{
		$this->add_category_video();
	}
	elseif($_GET[page] == "video" AND $_GET[eng_title] != "")
	{
		$this->create_one_video($_GET[eng_title]);
	}
	elseif($_GET[page] == "video")
	{
		$this->create_video_list();
	}
	elseif($_GET[page] == "video_list")
	{
		$this->create_admin_video_list();
	}
	elseif($_GET[page] == "red_video" AND $_GET[id] != "")
	{
		if($_POST[submit] != "")
		{
			$this->red_video($_GET[id]);
		}
		$this->this_video = mysql_fetch_array(mysql_query("SELECT * FROM video WHERE id='$_GET[id]'"));
		$this->create_select_category($this->this_video[category]);
	}
}

function add_category_video()
{
	if($_POST[title] != "")
	{
		$eng_title = Functions::transliterate($_POST['title']);
		$query = mysql_query("INSERT into video_category SET title='$_POST[title]', eng_title='$eng_title', description='$_POST[description]', keywords='$_POST[keywords]'");
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


function add_video()
{
	if($_POST[title] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели название видео</div>";
	}
	elseif($_POST[text] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели код и текст видео</div>";
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
		
		$check = mysql_query("SELECT id FROM video WHERE eng_title='$eng_title'");
		$query = mysql_query("INSERT into video SET title='$_POST[title]', eng_title='$eng_title', category='$_POST[category]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', datetime='$datetime'");
		$last_id = mysql_insert_id();
		if($query)
		{
			if(mysql_num_rows($check) > 0)
			{
				$eng_title = $eng_title."-".$last_id;
				mysql_query("UPDATE video SET eng_title='$eng_title' WHERE id='$last_id'");
			}
			$this->add_result = "<div class='good_msg'>Видео добавлено</div>";
			$_POST[title] = "";
			$_POST[text] = "";
			$_POST[datetime] = "";
		}
	}
}

function red_video($id)
{
	if($id != "")
	{
		if($_POST[title] == "")
		{
			$this->red_result = "<div class='error_msg'>Вы не ввели название видео</div>";
		}
		elseif($_POST[text] == "")
		{
			$this->red_result = "<div class='error_msg'>Вы не ввели код и текст видео</div>";
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
			
			$query = mysql_query("UPDATE video SET title='$_POST[title]', eng_title='$eng_title', category='$_POST[category]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', datetime='$datetime' WHERE id='$id'");
			$last_id = mysql_insert_id();
			if($query)
			{
				//if(mysql_num_rows($check) > 0)
				//{
				//	$eng_title = $eng_title."-".$last_id;
				//	mysql_query("UPDATE video SET eng_title='$eng_title' WHERE id='$last_id'");
				//}
				$this->red_result = "<div class='good_msg'>Видео отредактировано</div>";
				$_POST[title] = "";
				$_POST[text] = "";
				$_POST[datetime] = "";
			}
		}
	}
}

function create_select_category($cat = "")
{
	$query = mysql_query("SELECT * FROM video_category");
	while($array = mysql_fetch_array($query))
	{
		$this->select_category .= "
		<option value='$array[id]'";
		if($cat == $array[id]) { $this->select_category .= " selected"; }
		$this->select_category .= ">$array[title]</option>";
	}
}

function create_video_list()
{
	$query_cat = mysql_query("SELECT * FROM video_category");
	while($array_cat = mysql_fetch_array($query_cat))
	{
		if($array_cat[id] != "")
		{
			$this->video_list .= "
			<div class='video_category'>
			<p><h3>$array_cat[title]</h3></p>";
			$query = mysql_query("SELECT * FROM video WHERE category='$array_cat[id]' ORDER by id desc");
			if(mysql_num_rows($query) > 0)
			{
				$this->video_list .= "
				<ul class='video_list'>";
				while($array = mysql_fetch_array($query))
				{
					$this->video_list .= "
					<li><a href='/video-$array[eng_title].html'>$array[title]</a></li>";
				}
				$this->video_list .= "</ul>";
			}
		}
	}
}

function create_admin_video_list()
{
	$query_cat = mysql_query("SELECT * FROM video_category");
	while($array_cat = mysql_fetch_array($query_cat))
	{
		if($array_cat[id] != "")
		{
			$this->video_list .= "
			<div class='categories'>
			<h3>$array_cat[title]</h3>";
			$query = mysql_query("SELECT * FROM video WHERE category='$array_cat[id]' ORDER by id desc");
			if(mysql_num_rows($query) > 0)
			{
				$this->video_list .= "
				<ul class='material_list'>";
				while($array = mysql_fetch_array($query))
				{
					$this->video_list .= "
					<li><a href='/video-$array[eng_title].html'>$array[title]</a>
					<div class='tools'>
					<a href='/admin/red_video/$array[id].html' class='config' title='Редактировать'></a>
					<a href='/admin/del_video/$array[id].html' class='remove' matherial_id='$array[id]' title='Удалить'></a>
					</div>
					</li>";
				}
				$this->video_list .= "</ul>";
			}
			$this->video_list .= "
			</div>";
		}
	}
}

function create_one_video($eng_title = "")
{
@	$array = mysql_fetch_array(mysql_query("SELECT * FROM video WHERE eng_title='$eng_title'"));
	if($array != "")
	{
		$this->one_video = "<h1>$array[title]</h1>
		<div>
		$array[text]
		</div>";
	}
	else
	{
		Pages::$page = "pages/error.php";
		Pages::get_error("404");
	}
}

function create_index_video()
{
	$this->index_video .= "<ul>";
	$query = mysql_query("SELECT * FROM video ORDER by datetime desc LIMIT 5");
	while($array = mysql_fetch_array($query))
	{
		$this->index_video .= "
		<li><a href='/video-$array[eng_title].html'>$array[title]</a></li>";
	}
	$this->index_video .= "</ul>";
}


}
?>