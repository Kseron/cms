<?
class Functions {
public static $ip;
var $content_blocks_list;
var $red_result;
var $this_block;

function __construct()
{
	Functions::GetIp();
	
	if($_GET[page] == "content_blocks")
	{
		$this->create_content_blocks_list();
	}
	elseif($_GET[page] == "red_content_block" OR ($_GET[script] == "blocks" AND $_GET[type] == "edit"))
	{
		if($_POST[submit] != "")
		{
			$this->red_content_block($_GET[id]);
		}
		$this->this_block = mysql_fetch_array(mysql_query("SELECT * FROM content_blocks WHERE id='$_GET[id]'"));
	}
}

//генерация пароля
static function randomise($umova, $length)
{
  $chars = "";
  if(preg_match("/k/", $umova)) { $chars .="абвдеєжзіклмнопрстухшюя"; }
  if(preg_match("/K/", $umova)) { $chars .="АБВДЕЄЖЗІКЛМНОПРСТУХШЮЯ"; }
  if(preg_match("/l/", $umova)) { $chars .="abdefhiknrstyz"; }
  if(preg_match("/L/", $umova)) { $chars .="ABDEFGHKNQRSTYZ"; }
  if(preg_match("/n/", $umova)) { $chars .="1234567890"; }

  $numChars = strlen($chars);
  $string = "";
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
  return $string;
}

//Транслитация (рус, укр)
static function transliterate($st = "")
{
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
		'ї'=>"yi",    'і'=>"i",    'є'=>"e",
		'ґ'=>"g",
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
		'Ї'=>"YI",    'І'=>"I",    'Є'=>"E",
		'Ґ'=>"G",
    );
	$st = strtr($st, $converter);
	// в нижний регистр
	$st = strtolower($st);

	// заменям все ненужное нам на "-"
	$st = preg_replace('~[^-a-z0-9_]+~u', '-', $st);

	// удаляем начальные и конечные '-'
	$st = trim($st, "-");
  return $st;
}


//Получаем IP
function GetIp()
{
 if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
 {
   Functions::$ip = $_SERVER['HTTP_CLIENT_IP'];
 }
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
 {
  Functions::$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 else
 {
   Functions::$ip = $_SERVER['REMOTE_ADDR'];
 }
 return $ip;
}

//Удаляем папку со всем что внутри
static function removeDirectory($dir) {
    if ($objs = glob($dir."/*")) {
       foreach($objs as $obj) {
         is_dir($obj) ? removeDirectory($obj) : unlink($obj);
       }
    }
    rmdir($dir);
}




function create_content($title)
{
	$array = mysql_fetch_array(mysql_query("SELECT * FROM content_blocks WHERE eng_title='$title'"));
	if($_SESSION['user_type'] == 3)
	{
		$output = "<div class='edit_block'><a href='/ajax/index.php?script=blocks&type=edit&id=$array[id]&parent=".$_SERVER['REQUEST_URI']."' class='fancybox' data-fancybox-type='iframe'><span class='fa fa-pencil-square-o'></span></a></div>";
	}
	$output .= $array[text];
	return $output;
}


function create_content_blocks_list()
{
	if($_SESSION[access] == 3)
	{
		$query = mysql_query("SELECT * FROM content_blocks");
		if(mysql_num_rows($query))
		{
			$this->content_blocks_list .= "
			<ul class='material_list'>";
			while($array = mysql_fetch_array($query))
			{
				$this->content_blocks_list .= "
				<li>$array[title]
				<div class='tools'>
				<a href='/admin/red_content_block/$array[id].html' class='config' title='Редактировать'></a>
				</div>
				</li>";
			}
			$this->content_blocks_list .= "</ul>";
		}
	}
}

function red_content_block($id)
{
	if(($_SESSION["access"] == 3 OR $_SESSION["user_type"] == 3) AND $id != "")
	{
		if($_POST[title] != "" AND $_POST[text] != "")
		{
			$query = mysql_query("UPDATE content_blocks SET title='".$_POST[title]."', text='".$_POST[text]."' WHERE id='$id'");
			if($query)
			{
				$this->red_result = "<div class='good_msg'>Блок отредактирован</div>";
			}
		}
		else
		{
			$this->red_result = "<div class='error_msg'>Не все поля заполнены</div>";
		}
	}
}

}