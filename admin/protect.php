<?
	if($_GET[page] == "") { $_GET[page] = "index"; }
?>

<!DOCTYPE html>
<html lang="ru">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="robots" content="noindex,nofollow">
<base href='/admin/'>
<title>Защищенная зона</title>
<link rel="stylesheet" type="text/css" href="/design/fonts/font.css" />
<link rel="stylesheet" type="text/css" href="/admin/design/style.css" />
</head>

<body>
<div class="all">

<div class="protect_panel">
	<form class="enter_form" action="" method="post">
		<p><input type="text" name="admin_login" placeholder="Логин"></p>
		<p><input type="password" name="admin_password" placeholder="Ваш пароль"></td></p>
		<p><img id="capcha" src="/core/capcha.php?rand=123" style="border: 1px #6699CC solid; cursor:pointer; float:left; " onclick="document.getElementById('capcha').src='/core/capcha.php?rand='+Math.random()"> 
		<input type="text" name="duck" value="" size="7" maxlength="5" style="width:auto; margin-left:10px; font-size:1.4em; ">
		<span style='display:none;'><input type='text' name='kapcha' value="<? echo rand(10000,99999); ?>" size="5" maxlength="5"  placeholder="Впишите сюда цифры слева" ></span></p>
		<p><input type='submit' name='login_submit' value='Войти'></p>
	</form>

</div>

</div>

<?
	echo $admin->error_text;
?>

</body>

</html>