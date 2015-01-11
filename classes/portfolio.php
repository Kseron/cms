<?
class Portfolio {
var $portfolio_list;
var $portfolio_list_mini;
var $admin_portfolio_list;
var $error_confirm;
var $this_albom;
var $this_portfolio_photo;
var $index_last_works;

var $delete_result;
var $add_result;
var $red_result;
var $add_portfolio_image;
var $one_portfolio;
var $product_carousel;

var $select_category;

function __construct() 
{
	if($_GET[page] == "add_albom" AND $_POST[submit] != "")
	{
@		$this->create_select_category($_POST[category]);
		$this->add_albom();
	}
	elseif($_GET[page] == "add_albom")
	{
@		$this->create_select_category();
	}
	elseif($_GET[page] == "gallery" AND $_GET[eng_title] != "")
	{
		$this->create_one_portfolio($_GET[eng_title]);
	}
	elseif($_GET[page] == "gallery")
	{
		$this->create_portfolio_list();
	}
	elseif($_GET[page] == "portfolio_list")
	{
		$this->create_admin_portfolio_list();
	}
	elseif($_GET[page] == "red_albom" AND $_GET[id] != "")
	{
		$this->red_albom($_GET[id]);
		$this->this_albom = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_alboms WHERE id='$_GET[id]'"));
		$this->create_select_category($this->this_albom[category]);
		$this->create_admin_one_portfolio($_GET[id]);
	}
	elseif($_GET[page] == "add_portfolio_image" AND $_GET[id] != "")
	{
		$this->add_image($_GET[id]);
	}
	elseif($_GET[page] == "del_albom" AND $_GET[id] != "")
	{
		$this->delete_albom($_GET[id]);
	}
	elseif($_GET[page] == "del_portfolio_photo")
	{
		$this->del_portfolio_photo($_GET[id]);
	}
	elseif($_GET[page] == "index" OR $_GET[page] == "")
	{
		$this->make_index_last_works();
	}
	elseif($_GET[page] == "skidki")
	{
		$this->create_portfolio_list_mini();
	}
	elseif($_GET[page] == "albom" AND $_GET[id] != "")
	{
		$this->create_admin_one_portfolio($_GET[id]);
		$this->this_albom = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_alboms WHERE id='$_GET[id]'"));
	}
	
	if($_GET[script] == "portfolio" AND $_GET[type] == "edit_portfolio_photo" AND $_GET[id] != "")
	{
		if($_POST[submit] != "")
		{
			$this->red_portfolio_photo($_GET[id]);
		}
		$this->this_portfolio_photo = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_images WHERE id='$_GET[id]'"));
	}
}

function add_image($id)
{
	$id = eregi_replace("/[^0-9]/", "", $id);
	$query = mysql_query("SELECT id, eng_title FROM portfolio_alboms WHERE id='$id'");
	if($query)
	{
		$array = mysql_fetch_array($query);
		foreach($_FILES as $file)
		{
			for ($i=0; $i<=count($file['name']); $i++)
			{
			$datetime = Date_time::get_date("datetime");
			$image_file = $file['tmp_name'][$i];
			$image_file_name = $file['name'][$i];
			if($image_file != "")
			{
				$query2 = mysql_query("INSERT into portfolio_images SET title='$array[eng_title]', albom='$id', datetime='$datetime'");
				$image_id = mysql_insert_id();
				Graphics::save_image($image_file, "../images/portfolio/$id", "800", "$array[eng_title]-$image_id.jpg", "80");
				Graphics::save_image($image_file, "../images/portfolio/$id", "250", "$array[eng_title]-$image_id-250x250.jpg", "90");
				$this->add_portfolio_image .= "<p>Добавлен файл <b>".$image_file_name."</b></p>";
			}
			}
		}
		header("location:".$_SERVER[HTTP_REFERER]); 
	}
	else
	{
		$this->delete_result = "<p class='error_msg'>Альбом не найден</p>";
	}
}

function add_albom()
{
	if($_POST[title] == "")
	{
		$this->add_result = "<div class='error_msg'>Вы не ввели название альбома</div>";
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
		
		$check = mysql_query("SELECT id FROM portfolio_alboms WHERE eng_title='$eng_title'");
			
		$query = mysql_query("INSERT into portfolio_alboms SET title='$_POST[title]', eng_title='$eng_title', category='$_POST[category]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', datetime='$datetime'");
		$last_id = mysql_insert_id();
		if($query)
		{
			foreach($_FILES as $file)
			{
				for ($i=0; $i<=count($file['name']); $i++)
				{
					$image_file = $file['tmp_name'][$i];
					$image_file_name = $file['name'][$i];
					if($image_file != "")
					{
						$query2 = mysql_query("INSERT into portfolio_images SET title='$eng_title', albom='$last_id', datetime='$datetime'");
						$image_id = mysql_insert_id();
						Graphics::save_image($image_file, "../images/portfolio/$last_id", "800", "$eng_title-$image_id.jpg", "80");
						Graphics::save_image($image_file, "../images/portfolio/$last_id", "250", "$eng_title-$image_id-250x250.jpg", "90");
						$this->add_result .= "<p>".$image_file_name."</p>";
					}
				}
			}
			if(mysql_num_rows($check) > 0)
			{
				$eng_title = $eng_title."-".$last_id;
				mysql_query("UPDATE portfolio_alboms SET eng_title='$eng_title' WHERE id='$last_id'");
			}
			
			$this->add_result = "<div class='good_msg'>Альбом добавлен</div>";
			$_POST[title] = "";
			$_POST[text] = "";
			$_POST[description] = "";
			$_POST[keywords] = "";
			$_POST[datetime] = "";
		}
	}
}

function red_albom($id)
{
	$id = eregi_replace("/[^0-9]/", "", $id);
	$query = mysql_query("SELECT * FROM portfolio_alboms WHERE id='$id'");
	if($query)
	{
		if($_POST[submit] != "")
		{
			if($_POST[title] == "")
			{
				$this->add_result = "<div class='error_msg'>Вы не ввели название альбома</div>";
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
				
				
				$matherial = mysql_fetch_array(mysql_query("SELECT eng_title FROM portfolio_alboms WHERE id='$_GET[id]'"));
				if($_POST[eng_title] != $matherial['eng_title'])
				{
					$eng_title = $_POST[eng_title];
					$check = mysql_query("SELECT id FROM portfolio_alboms WHERE eng_title='$eng_title'");
					if(mysql_num_rows($check) > 0)
					{
						$eng_title = $eng_title."-".$last_id;
					}
				}
				else
				{
					//$eng_title = Functions::transliterate($_POST['title']);
					$eng_title = $matherial['eng_title'];
				}
				$query = mysql_query("UPDATE portfolio_alboms SET title='$_POST[title]', eng_title='$eng_title', category='$_POST[category]', text='$_POST[text]', description='$_POST[description]', keywords='$_POST[keywords]', datetime='$datetime' WHERE id='$id'");
				//$query_images = mysql_query("UPDATE portfolio_images SET title='$eng_title' WHERE albom='$id'");
			}
			$this->this_albom = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_alboms WHERE id='$id'"));
		}
	}
	else
	{
		$this->delete_result = "<p class='error_msg'>Альбом не найден</p>";
	}
	
}

function delete_albom($id)
{
	$id = eregi_replace("/[^0-9]/", "", $id);
	$albom = mysql_fetch_array(mysql_query("SELECT id FROM portfolio_alboms WHERE id='$id'"));
	if($albom[id] != "")
	{
		$query = mysql_query("DELETE FROM portfolio_images WHERE albom='$albom[id]'");
		if($query)
		{
			Functions::removeDirectory("../images/portfolio/$albom[id]");
		}
		mysql_query("DELETE FROM portfolio_alboms WHERE id='$albom[id]'");
	}
}

function red_portfolio_photo($id)
{
	if($id != "")
	{
		$query = mysql_query("UPDATE portfolio_images SET alt='$_POST[alt]' WHERE id='$id'");
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


function create_select_category($cat = "")
{
	$query = mysql_query("SELECT * FROM portfolio_category");
	while($array = mysql_fetch_array($query))
	{
		$this->select_category .= "
		<option value='$array[id]'";
		if($cat == $array[id]) { $this->select_category .= " selected"; }
		$this->select_category .= ">$array[title]</option>";
	}
}

function create_portfolio_list()
{
	$this->portfolio_list .= "<div class='section'>
	<ul class='tabs lite_style'>
		<li class='current'>Все работы</li> 
		<li>Квартиры</li>
		<li>Коттеджи</li>
		<li>Помещения</li>
	</ul>
	
	<div class='box visible'>
	<div class='portfolio_list'>";
	$query = mysql_query("SELECT * FROM portfolio_alboms");
	while($array = mysql_fetch_array($query))
	{
		$image = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_images WHERE albom='$array[id]' ORDER by rand() LIMIT 1"));
		$this->portfolio_list .= "
		<div class='porfolio_albom'><a href='/gallery/$array[eng_title].html'><img src='/images/portfolio/$array[id]/$image[title]-$image[id]-250x250.jpg' alt='$array[title]'>
		<div class='porfolio_albom_title'>$array[title]</div>
		</a></div>";
	}
	$this->portfolio_list .= "
	</div>
	</div>";
			
	$query_cat = mysql_query("SELECT * FROM portfolio_category LIMIT 3");
	while($array_cat = mysql_fetch_array($query_cat))
	{
		if($array_cat[id] != "")
		{
			$this->portfolio_list .= "
			<div class='box'>";
			$this->portfolio_list .= "
			<div class='portfolio_list'>";
			$query = mysql_query("SELECT * FROM portfolio_alboms WHERE category='$array_cat[id]'");
			while($array = mysql_fetch_array($query))
			{
			$image = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_images WHERE albom='$array[id]' ORDER by rand() LIMIT 1"));
			$this->portfolio_list .= "
			<div class='porfolio_albom'><a href='/gallery/$array[eng_title].html'><img src='/images/portfolio/$array[id]/$image[title]-$image[id]-250x250.jpg' alt='$array[title]'>
			<div class='porfolio_albom_title'>$array[title]</div>
			</a></div>";
			}
			$this->portfolio_list .= "
			</div>
			</div>";
		}
	}
	$this->portfolio_list .= "
	</div>
	<div>
	<h2>Здесь Вы найдёте <strong>фото потолков из гипсокартона.</h2>
	<p>&nbsp;</p>
	<p> Мы делаем не только <strong>гипсокартонные потолки</strong>, но и любые конструкции из гипсокартона для Вашего интерьера.<br></p>
	<p> Для нас, нет таких гипсокартонных работ, которых мы бы не смогли бы выполнить! </p>
	<p> Мы делаем: </p>
	<ul>
	<li>Гипсокартонные потолки.</li>
	<li>Офисные и межкомнатные перегородки из гипсокартона.<br></li>
	<li>Ремонт квартир под ключ.</li>
	<li>Внутренняя отделка коттеджей.<br></li>
	<li>Облицовка гипсокартоном стен и потолков мансардных этажей.</li><li>Обшивка деревянных коттеджей гипсокартоном.</li>
	</ul>
	</div>";
}

function create_admin_portfolio_list()
{
	$query_cat = mysql_query("SELECT * FROM portfolio_category");
	while($array_cat = mysql_fetch_array($query_cat))
	{
		if($array_cat[id] != "")
		{
			$this->admin_portfolio_list .= "
			<div class='categories'>
			<h3>$array_cat[title]</h3>";
			$query = mysql_query("SELECT * FROM portfolio_alboms WHERE category='$array_cat[id]'");
			if(mysql_num_rows($query) > 0)
			{
				$this->admin_portfolio_list .= "
				<ul class='material_list'>";
				while($array = mysql_fetch_array($query))
				{
					$this->admin_portfolio_list .= "
					<li><strong><a href='albom/$array[id].html'>$array[title]</a></strong> (<a href='/gallery/$array[eng_title].html'>на сайте</a>)
					<div class='tools'>
					<a href='/admin/red_albom/$array[id].html' class='config' title='Редактировать'></a>
					<a href='/admin/del_albom/$array[id].html' class='remove' matherial_id='6' title='Удалить'></a>
					</div>
					<form action='/admin/add_portfolio_image/$array[id].html' method='post' enctype='multipart/form-data'>
					<div class='bonus_functions'>Добавить фото: <input type='file' name='images[]' multiple> <input type='submit' name='submit' value='Отправить'></div>
					</form>
					</li>";
				}
				$this->admin_portfolio_list .= "</ul>";
			}
			$this->admin_portfolio_list .= "
			</div>";
		}
	}
}


function create_one_portfolio($eng_title = "")
{
@	$albom = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_alboms WHERE eng_title='$eng_title'"));
	if($albom[id] != "")
	{
		$this->one_portfolio .= "<h1>$albom[title]</h1>
		<div>$albom[text]</div>
		<div class='photo_list' style='margin-right:240px;'>
		<h2>Процесс выполнения работ:</h2>";
		$query = mysql_query("SELECT * FROM portfolio_images WHERE albom='$albom[id]'");
		while($array = mysql_fetch_array($query))
		{
			$this->one_portfolio .= "
			<div><a class='fancybox-thumbs' rel='portfolio_image' href='/images/portfolio/$albom[id]/$array[title]-$array[id].jpg'>";
			if($array[alt] != "")
			{
				$this->one_portfolio .= "<img src='/images/portfolio/$albom[id]/$array[title]-$array[id]-250x250.jpg' alt='$array[alt]'>";
			}
			else
			{
				$this->one_portfolio .= "<img src='/images/portfolio/$albom[id]/$array[title]-$array[id]-250x250.jpg' alt='$albom[title]'>";
			}
			$this->one_portfolio .= "</a></div>";
			
		}
		$this->one_portfolio .= "
		</div>";
		
		$query_other_alboms = mysql_query("SELECT * FROM portfolio_alboms WHERE category='$albom[category]' AND id !='$albom[id]'");
		if(mysql_num_rows($query_other_alboms) > 0)
		{
			$this->one_portfolio .="<div style='margin-top:15px;'>
			<div style='text-align:center;'><h2>Выбор объекта для просмотра</h2></div>
			<a href='#' class='jcarousel-control-prev'>&lsaquo;</a>
			<a href='#' class='jcarousel-control-next'>&rsaquo;</a>
			<div class='jcarousel-wrapper'>
			<div class='jcarousel carousel_alboms'>
			<ul>";
			while($array_other_alboms = mysql_fetch_array($query_other_alboms))
			{
				$image = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_images WHERE albom='$array_other_alboms[id]' ORDER by rand() LIMIT 1"));
				$this->one_portfolio .="<li><a href='/gallery/$array_other_alboms[eng_title].html'><img src='/images/portfolio/$array_other_alboms[id]/$image[title]-$image[id]-250x250.jpg' title='$array_other_alboms[title]' alt='$array_other_alboms[title]'></a>
				</li>";
			}
			$this->one_portfolio .="</ul>
			</div>
			</div>
			</div>";
		}
		
		
		$products_query = mysql_query("SELECT * FROM product_types ORDER by RAND() LIMIT 10");

			if(mysql_num_rows($products_query) > 0)
			{
				$this->product_carousel .="<div style='margin-top:15px;'>
				<a href='#' class='jcarousel-control-prev'>&lsaquo;</a>
				<a href='#' class='jcarousel-control-next'>&rsaquo;</a>
				<div class='jcarousel-wrapper'>
				<div class='jcarousel'>
				<ul>";
				while($products_array = mysql_fetch_array($products_query))
				{
					$prise = mysql_fetch_array(mysql_query("SELECT prise FROM products WHERE product_type='$products_array[id]' ORDER by prise LIMIT 1"));
					$this->product_carousel .="<li><a href='/product/$products_array[id]/$products_array[eng_title].html' rel='nofollow'><img src='/images/products/$products_array[id]/general-115x115.jpg'></a>
					<br /><a href='/product/$products_array[id]/$products_array[eng_title].html'><b>$products_array[title]</b></a>
					<br /><span style='color:blue;'>от <b>$prise[prise]</b> руб.</span></li>";
				}
				$this->product_carousel .="</ul>
				</div>
				</div>
				</div>";
			}
	}
}

function del_portfolio_photo($id)
{
	if($_SESSION[access] == 3)
	{
	
	if($id != "")
	{
		$array = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_images WHERE id='$id'"));
		if($array[id] != "")
		{
			$albom = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_alboms WHERE id='$array[albom]'"));
			unlink("../images/portfolio/$albom[id]/$albom[eng_title]-$array[id].jpg");
			unlink("../images/portfolio/$albom[id]/$albom[eng_title]-$array[id]-250x250.jpg");
			mysql_query("DELETE FROM portfolio_images WHERE id='$id'");
		}
	}
	
	}
	header("location:".$_SERVER[HTTP_REFERER]);
}

function create_admin_one_portfolio($id = "")
{
@	$albom = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_alboms WHERE id='$id'"));
	if($albom[id] != "")
	{
		$this->one_portfolio .= "<h1>$albom[title]</h1>
		<div>$albom[text]</div>
		<div class='photo_list'>";
		$query = mysql_query("SELECT * FROM portfolio_images WHERE albom='$albom[id]'");
		while($array = mysql_fetch_array($query))
		{
			$this->one_portfolio .= "
			<div class='photo'>
			<div class='tools'>
			<a href='/ajax/index.php?script=portfolio&type=edit_portfolio_photo&id=$array[id]' class='fancybox' data-fancybox-type='iframe' title='Редактировать'><i class='fa fa-wrench'></i></a>
			<a href='del_portfolio_photo/$array[id].html' title='Удалить'><i class='fa fa-times'></i></a>
			</div>
			<a class='fancybox-thumbs' rel='portfolio_image' href='/images/portfolio/$albom[id]/$array[title]-$array[id].jpg'><img src='/images/portfolio/$albom[id]/$array[title]-$array[id]-250x250.jpg' alt='$array[title]' title='$array[title]'></a>
			</div>";
		}
		$this->one_portfolio .= "
		</div>";
	}
}


function make_index_last_works()
{
	$this->index_last_works .="<div class='portfolio_list' style='width:100%;'>";
	$query = mysql_query("SELECT * FROM portfolio_alboms ORDER by datetime desc LIMIT 3");
	while($array = mysql_fetch_array($query))
	{
		$image = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_images WHERE albom='$array[id]' ORDER by rand() LIMIT 1"));
		$this->index_last_works .= "
		<div class='porfolio_albom' style='width:31%;'><a href='/gallery/$array[eng_title].html'><img src='/images/portfolio/$array[id]/$array[eng_title]-$image[id]-250x250.jpg'>
		</a></div>";
	}
	$this->index_last_works .= "
	</div>";
}

function create_portfolio_list_mini()
{
	$this->portfolio_list_mini .="<div class='portfolio_list' style='width:100%;'>";
	$query = mysql_query("SELECT * FROM portfolio_alboms ORDER by datetime desc LIMIT 6");
	while($array = mysql_fetch_array($query))
	{
		$image = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_images WHERE albom='$array[id]' ORDER by rand() LIMIT 1"));
		$this->portfolio_list_mini .= "
		<div class='porfolio_albom' style='width:31%;'><a href='/gallery/$array[eng_title].html'><img src='/images/portfolio/$array[id]/$array[eng_title]-$image[id]-250x250.jpg'>
		</a></div>";
	}
	$this->portfolio_list_mini .= "
	</div>";
}


}
?>