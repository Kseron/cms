<?
class Catalog {
var $select_category;
var $select_category_for_product;
var $add_result;
var $red_result;

var $index_category;
var $this_category;
var $list_category;
var $left_menu_category;

function __construct() 
{
@	$this->create_select_category();
	if($_GET['page'] == "add_category" AND isset($_POST['submit']))
	{
		$this->add_cathegory();
	}
	elseif($_GET['page'] == "category_list")
	{
		$this->show_cathegory();
	}
	elseif($_GET['page'] == "red_category" AND $_GET['id'] != "")
	{
		if(isset($_POST['submit']))
		{
			$this->red_cathegory();
		}
		
		$array = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE id='$_GET[id]'"));
		if($array[id] != "")
		{
			$this->this_category = $array;
			$this->create_select_category($this->this_category['parent']);
		}
	}
	elseif($_GET['page'] == "del_category" AND $_GET['id'] != "")
	{
		$query = mysql_query("DELETE FROM category WHERE id='$_GET[id]'");
	   	header('Location: '.$_SERVER[HTTP_REFERER]);
	}
	elseif($_GET['page'] == "catalog" AND $_GET[id] != "")
	{
		$this->this_category = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE id='$_GET[id]'"));
	}
	elseif($_GET['page'] == "index" OR $_GET['page'] == "")
	{
		$this->get_index_category();
	}

	
	$this->create_left_menu_category();
	
	
}

function create_select_category($selected)
{
	$this->select_category = "
	<option value='0'> </option>
	";
	$query = mysql_query("SELECT * FROM category WHERE parent='0'");
	while($array = mysql_fetch_array($query))
	{
		$this->select_category .= "
		<option value='$array[id]'";
		if($this->this_category['parent'] == $array[id] AND $selected == "") { $this->select_category .= " selected"; }
		elseif($selected == $array[id]) { $this->select_category .= " selected"; }
		$this->select_category .= ">$array[title]</option>";
		$query2 = mysql_query("SELECT * FROM category WHERE parent='$array[id]'");
		while($array2 = mysql_fetch_array($query2))
		{
			$this->select_category .= "
			<option value='$array2[id]' style='padding-left:20px;'";
			if($this->this_category['parent'] == $array2[id] AND $selected == "") { $this->select_category .= " selected"; }
			elseif($selected == $array2[id]) { $this->select_category .= " selected"; }
			$this->select_category .= "> $array2[title]</option>";
			$query3 = mysql_query("SELECT * FROM category WHERE parent='$array2[id]'");
			while($array3 = mysql_fetch_array($query3))
			{
				$this->select_category .= "
				<option value='$array3[id]' style='padding-left:40px;'";
				if($this->this_category['parent'] == $array3[id] AND $selected == "") { $this->select_category .= " selected"; }
				elseif($selected == $array3[id]) { $this->select_category .= " selected"; }
				$this->select_category .= "> $array3[title]</option>";
			}
		}
	}
}

function create_select_category_for_product($selected)
{
	$this->select_category_for_product = "
	<option value='0'> </option>
	";
	$query = mysql_query("SELECT * FROM category WHERE parent='0'");
	while($array = mysql_fetch_array($query))
	{
		$this->select_category_for_product .= "
		<optgroup label='$array[title]'>";
		$query2 = mysql_query("SELECT * FROM category WHERE parent='$array[id]'");
		while($array2 = mysql_fetch_array($query2))
		{
			$this->select_category_for_product .= "
			<option value='$array2[id]' style='padding-left:20px;'";
			if($this->this_category['parent'] == $array2[id] AND $selected == "") { $this->select_category_for_product .= " selected"; }
			elseif($selected == $array2[id]) { $this->select_category_for_product .= " selected"; }
			$this->select_category_for_product .= "> $array2[title]</option>";
			$query3 = mysql_query("SELECT * FROM category WHERE parent='$array2[id]'");
			while($array3 = mysql_fetch_array($query3))
			{
				$this->select_category_for_product .= "
				<option value='$array3[id]' style='padding-left:40px;'";
				if($this->this_category['parent'] == $array3[id] AND $selected == "") { $this->select_category_for_product .= " selected"; }
				elseif($selected == $array3[id]) { $this->select_category_for_product .= " selected"; }
				$this->select_category_for_product .= "> $array3[title]</option>";
			}
		}
		$this->select_category_for_product .= "
		</optgroup>";
	}
}


function add_cathegory()
{
	if($_SESSION[access] == 3)
	{
	
	if($_POST['title'] == "")
	{
		$this->add_result = "<script>alert('Вы не ввели название категории');</script>";
	}
	/*
	elseif($_POST['eng_title'] == "")
	{
		$this->add_result = "<script>alert('Вы не ввели анлийский вариант названия категории');</script>";
	}
	*/
	else
	{
		$eng_title = Functions::transliterate($_POST['title']);
		$query = mysql_query("INSERT into category SET title='$_POST[title]', eng_title='$eng_title', description='$_POST[text]', mini_descr='$_POST[mini_descr]', keywords='$_POST[keywords]', parent='$_POST[category]', vision='$_POST[vision]'");
		$this_id = mysql_insert_id();
		if($query)
		{
			$image_file = $_FILES[image][tmp_name];
			
			if($image_file != "")
			{
				$good_name = str_replace(" ", "_", $eng_title);
				Graphics::save_image($_FILES["image"]["tmp_name"], "../images/catalog/$this_id", "135", "$good_name-135x135.jpg", "80");
				Graphics::save_image($_FILES["image"]["tmp_name"], "../images/catalog/$this_id", "350", "$good_name-350x350.jpg", "80");
			}
			$this->add_result = "<script>alert('Категория добавлена');</script>";
			$_POST[title] = "";
			$_POST[mini_descr] = "";
			$_POST[keywords] = "";
			$_POST[vision] = "";
		}
	}
	
	}
}

function red_cathegory()
{
	if($_SESSION[access] == 3)
	{
	
	if($_POST['title'] == "")
	{
		$this->red_result = "<script>alert('Вы не ввели название категории');</script>";
	}
	/*
	elseif($_POST['eng_title'] == "")
	{
		$this->red_result = "<script>alert('Вы не ввели анлийский вариант названия категории');</script>";
	}
	*/
	elseif($_GET[id] != "")
	{
		$eng_title = Functions::transliterate($_POST['title']);
		$query = mysql_query("UPDATE category SET title='$_POST[title]', eng_title='$eng_title', description='$_POST[text]', mini_descr='$_POST[mini_descr]', keywords='$_POST[keywords]', parent='$_POST[category]', vision='$_POST[vision]' WHERE id='$_GET[id]'");
		$this_id = $_GET[id];
		if($query)
		{
			$image_file = $_FILES[image][tmp_name];
			
			if($image_file != "")
			{
				$good_name = str_replace(" ", "_", $eng_title);
				Graphics::save_image($_FILES["image"]["tmp_name"], "../images/catalog/$this_id", "135", "$good_name-135x135.jpg", "80");
				Graphics::save_image($_FILES["image"]["tmp_name"], "../images/catalog/$this_id", "350", "$good_name-350x350.jpg", "80");
			}
			$this->red_result = "<script>alert('Категория отредактирована');</script>";
			$_POST[title] = "";
			$_POST[mini_descr] = "";
			$_POST[keywords] = "";
			$_POST[vision] = "";
		}
	}
	else
	{
		$this->red_result = "<script>alert('В адресе страницы отсутствует id категории');</script>";
	}
	
	}
}

function show_cathegory()
{
	$query = mysql_query("SELECT * FROM category WHERE parent='0'");
	while($array = mysql_fetch_array($query))
	{
		$this->list_category .= "<div class='green_block category_list'>
		<div class='title'><a href='/catalog/$array[id]/$array[eng_title].html'>$array[title]</a>
		<div class='tools'>
			<!--<a href='red_category/$array[id].html' class='config' title='Редактировать'></a>
			<a href='del_category/$array[id].html' class='remove' matherial_id='$array[id]'></a>-->
			<a href='red_category/$array[id].html' title='Редактировать'><i class='fa fa-wrench'></i></a>
			<a href='del_category/$array[id].html' matherial_id='$array[id]' title='Удалить'><i class='fa fa-times'></i></a>
		</div>
		</div>
		<div class='сontent'>";
		$query2 = mysql_query("SELECT * FROM category WHERE parent='$array[id]'");
		if(mysql_num_rows($query2) > 0)
		{
			$this->list_category .= "
			<ul class='material_list'>";
			while($array2 = mysql_fetch_array($query2))
			{
				$this->list_category .= "
				<li><a href='/catalog/$array2[id]/$array2[eng_title].html'>$array2[title]</a>
				<div class='tools'>
					<a href='red_category/$array2[id].html' class='config' title='Редактировать'></a>
					<a href='del_category/$array2[id].html' class='remove' matherial_id='6' title='Удалить'></a>
				</div>";
				$query3 = mysql_query("SELECT * FROM category WHERE parent='$array2[id]'");
				if(mysql_num_rows($query3) > 0)
				{
					$this->list_category .= "
					<ul class='material_list'>";
					while($array3 = mysql_fetch_array($query3))
					{
						$this->list_category .= "
						<li><a href='/catalog/$array3[id]/$array3[eng_title].html'>$array3[title]</a>
						<div class='tools'>
							<a href='red_category/$array3[id].html' class='config' title='Редактировать'></a>
							<a href='del_category/$array3[id].html' class='remove' matherial_id='6' title='Удалить'></a>
						</div>";
					}
				}
				$this->list_category .= "</li>";

			}
			$this->list_category .= "</ul>";
		}
		$this->list_category .= "
		</div>
		</div>";
	}
}

function get_index_category()
{
	$query = mysql_query("SELECT * FROM category WHERE parent='0'");
	while($array = mysql_fetch_array($query))
	{
		$this->index_category .= "<div class='mini_cat'>
			<div class='mini_cat_title'><a href='/catalog/$array[id]/$array[eng_title].html'>$array[title]</a></div>
			<div class='mini_cat_image' style='background-image:url(/images/catalog/$array[id]/$array[eng_title]-135x135.jpg);'>
				<a class='big_a' href='/catalog/$array[id]/$array[eng_title].html' rel='nofollow'></a>
			</div>
		</div>";
	}
}

function create_left_menu_category()
{
	$this->left_menu_category .= "<ul>";
	$query = mysql_query("SELECT * FROM category WHERE parent='0' AND vision='1'");
	while($array = mysql_fetch_array($query))
	{
		$this->left_menu_category .= "
		<li><a href='/catalog/$array[id]/$array[eng_title].html'>$array[title]</a>";
		$query2 = mysql_query("SELECT * FROM category WHERE parent='$array[id]'");
		if(mysql_num_rows($query2) > 0)
		{
			$this->left_menu_category .= "
			<ul>";
			while($array2 = mysql_fetch_array($query2))
			{
				$this->left_menu_category .= "
				<li><a href='/catalog/$array[id]/$array2[eng_title].html'>$array2[title]</a>";
				/*
				$query3 = mysql_query("SELECT * FROM category WHERE parent='$array2[id]'");
				if(mysql_num_rows($query3) > 0)
				{
					$this->left_menu_category .= "<ul>";
					while($array3 = mysql_fetch_array($query3))
					{
						$this->left_menu_category .= "<li><a href='/catalog/$array[id]/$array3[eng_title]'>$array3[title]</a></li>";
					}
					$this->left_menu_category .= "</ul>";
				}
				*/
				$this->left_menu_category .= "</li>";
			}
			$this->left_menu_category .= "
			</ul>";
		}
		$this->left_menu_category .= "</li>";
	}
	$this->left_menu_category .= "</ul>";
}


}