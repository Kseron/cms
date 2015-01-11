<?
class Defence {


function __construct() 
{

}


//Значения фильтра ссылок ($links): 0 - не задействовать фильтр, 1- не пропускать html-ссылки, 2 - не пропускать bb-ссылки, 3 - не пропускать тектовые ссылки, 4 - ничего не пропускать
//Значения фильтра коды ($code): 0 - не задействовать фильтр, 1- не пропускать html-теги, 2 - не пропускать bb-кода, 3 - , 4 - ничего не пропускать
static function antibot($text = "", $links = 0, $code = 0)
{
	$output = TRUE;
	
	if($links == 1)
	{
		if(preg_match("/<a(.*)</a>/i", $text))
		{
			$output = FALSE;
		}
	}
	elseif($links == 2)
	{
		if(preg_match("/[link(.*)[/link]/i", $text))
		{
			$output = FALSE;
		}
	}
	
	if($code == 1)
	{
		$text = strip_tags($_POST[text]);
		if($text != $_POST[text])
		{
			$output = FALSE;
		}
	}
	elseif($code == 2)
	{
		if(preg_match("#\[(.+?)\](.+?)\[\/(.+?)\]#is", $text))
		{
			$output = FALSE;
		}
	}
	elseif($code == 4)
	{
		$text = strip_tags($_POST[text]);
		if($text != $_POST[text])
		{
			$output = FALSE;
		}
		if(preg_match("#\[(.+?)\](.+?)\[\/(.+?)\]#is", $text))
		{
			$output = FALSE;
		}
	}
	
	
	return $output;
}


}
?>