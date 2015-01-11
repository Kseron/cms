<?
session_start();
$r=rand(10000,99999);
for($i=0;$i < 5;$i++)//разбиваем секретный код на массив чисел
  $arr[$i]=substr($r,$i,1);

$im=imagecreate(130,40);//создаем картинку
imagecolorallocate($im,255,255,255);

$a=22;
$color_w=imagecolorallocate($im,255,255,255);
$color_g=imagecolorallocate($im,50,50,200);
$color = array(imagecolorallocate($im,60,60,60), imagecolorallocate($im,50,100,150), imagecolorallocate($im,255,0,0), imagecolorallocate($im,85,85,85), imagecolorallocate($im,85,205,205));

for($i=1;$i <=20;$i++)//ставим 10 захисних ліній
 imageLine($im, rand(1,130), rand(1,40), rand(1,130), rand(1,40), $color[2]);
for($i=1;$i <=250;$i++)//ставим 150 захисних точок
 imagesetpixel($im,rand(1,129),rand(1,39),$color_g);
for($i=1;$i <=250;$i++)//ставим 150 захисних точок
 imagesetpixel($im,rand(1,129),rand(1,39),$color[4]);
for($i=1;$i <=250;$i++)//ставим 150 захисних точок
 imagesetpixel($im,rand(1,129),rand(1,39),$color[3]);

for($i=0;$i < 5;$i++)//наносим код на картинку
{
  $arr_=imagettftext($im, 42, rand(0,0), $a, rand(40,45),$color[$i],"../design/fonts/impact.TTF",$arr[$i]);
  $a+=16;
}

header("Content-type: image/png");
imagepng($im); //выводим капчу
imagedestroy($im);

//session_register("secret_code");
$code1 = preg_split('//', $r, -1, PREG_SPLIT_NO_EMPTY);
//$code = "".rand(1,9).$code1[0].rand(1,9).rand(1,9).$code1[1].rand(1,9).$code1[2].$code1[3].rand(1,9).rand(1,9).rand(1,9).$code1[4];
$code = $code1[0].$code1[1].$code1[2].$code1[3].$code1[4];
$_SESSION["secret_code"] = md5($code);

?>