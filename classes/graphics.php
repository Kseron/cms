<?
class Graphics {


static function save_image($source_src, $resource_src, $image_size, $image_file_name, $quality)
{
	$file_src = $resource_src."/".$image_file_name;
  $params = getimagesize($source_src);
  switch ( $params[2] ) {
    case 1: $source = imagecreatefromgif($source_src); break;
    case 2: $source = imagecreatefromjpeg($source_src); break;
    case 3: $source = imagecreatefrompng($source_src); break;
  }
  if ( $params[0]>$image_size OR $params[1]>$image_size )
  {
		if( $params[0]>$params[1])
		{
			$size = $params[0]; # ширина
		}
		else
		{
			$size = $params[1]; #высота
		}
    $resource_width = floor($params[0] * $image_size / $size);
    $resource_height = floor($params[1] * $image_size / $size);
    $resource = imagecreatetruecolor($resource_width, $resource_height);
	
	if (!file_exists($resource_src)) {
	   mkdir($resource_src, 0777, true);
	   chmod($resource_src, 0777);
	}
	
    imagecopyresampled($resource, $source, 0, 0, 0, 0,$resource_width, $resource_height, $params[0], $params[1]);
    imageJpeg($resource, $file_src, $quality);
    chmod($file_src, 0777);
  }
  else
  {
    $resource = imagecreatetruecolor($params[0], $params[1]);
	if (!file_exists($resource_src)) {
	   mkdir($resource_src, 0777, true);
	   chmod($resource_src, 0777);
	}	
    imagecopyresampled($resource, $source, 0, 0, 0, 0,$params[0], $params[1], $params[0], $params[1]);
    imageJpeg($resource, $file_src, $quality);
    chmod($file_src, 0777);
  }
}

static function get_watermark($source_src, $resource_src, $source_watermark, $quality)
{
	// Загрузка картинки
	$image = imagecreatefromstring(file_get_contents($source_src));
	$w = imagesx($image);
	$h = imagesy($image);
	
	// Загрузка файла watermark
	$watermark = imagecreatefrompng($source_watermark);
	$ww = imagesx($watermark);
	$wh = imagesy($watermark);
	
	// Установка watermark (внизу справа)
	if( ($w > 300) & ($h > 300) ) 
	{ 
		imagecopyresampled($image, $watermark, $w-$ww-40, $h-$wh-10, 0, 0, $ww, $wh, $ww, $wh); 
	}
	imageJpeg($image, $resource_src, $quality);
}

static function dirDel($dir)
{ 
	$d=opendir($dir); 
	while(($entry=readdir($d))!==false)
	{
		if ($entry != "." && $entry != "..")
		{
			if (is_dir($dir."/".$entry))
			{ 
				dirDel($dir."/".$entry); 
			}
			else
			{ 
				unlink($dir."/".$entry); 
			}
		}
	}
	closedir($d); 
	rmdir($dir);
} 

}
?>