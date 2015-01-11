<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name='title' content='труляля' />
<meta name='description' content='Траляля' />
<meta name='keywords' content='Ключевые слова' />
<meta name="robots" content="noindex,nofollow">
<base href='/'>

<title>Труляля</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="/design/style.css" />
<link rel="stylesheet" type="text/css" href="/design/photo.css" />
<link rel="stylesheet" type="text/css" href="/scripts/fancybox/jquery.fancybox.css" />
<link rel="stylesheet" type="text/css" href="/scripts/fancybox/helpers/jquery.fancybox-buttons.css" />
<!--<link rel="stylesheet" type="text/css" href="/design/hellobar-solo/hellobar.css" />-->
<link rel="stylesheet" type="text/css" href="/design/sm.css" />
<link rel="stylesheet" type="text/css" media="screen, print" href="/design/flexslider.css" />
<link rel="stylesheet" type="text/css" href="/design/font-awesome/css/font-awesome.min.css" />
<!--<link rel="stylesheet" type="text/css" media="screen, print" href="/design/reset.min.css" /> -->

<script type="text/javascript" src="/scripts/jquery.1.10.2.js"></script>
<script type="text/javascript" src="/scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="/scripts/jquery.form.js"></script>
<script type="text/javascript" src="/scripts/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/scripts/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="/scripts/fancybox/helpers/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="/scripts/modals.js"></script>
<script type="text/javascript" src="/scripts/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/scripts/functions.js"></script>
<!--<script type="text/javascript" src="/scripts/ajax.js"></script>-->

	<script type="text/javascript" src="/scripts/jquery.flexslider-min.js"></script>
	<?
	if($_GET[page] == "foto")
	{
	?>
	<script type="text/javascript" src="/scripts/jquery.quicksand.js"></script>
	<script type="text/javascript" src="/scripts/jquery.quicksand_initialise.js"></script>
	<?
	}
	?>
    <!--<script type="text/javascript" src="/scripts/pokaz.js"></script>-->
    <!--<script type="text/javascript" src="/scripts/crutilka.js"></script>-->
    <!--<script type="text/javascript" src="/scripts/jquery.quickflip.min.js"></script>-->
	<!--<script type="text/javascript" src="/scripts/sm.js"></script>-->
    <!--<script type="text/javascript" src="/design/hellobar-solo/hellobar.js"></script>
	<script type="text/javascript" src="/design/hellobar-solo/hellobar-init.js"></script>-->
    <!--<script type="text/javascript" src="/scripts/comm.js"></script>-->
	<!--<script type="text/javascript" src="/scripts/JsHttpRequest.js"></script>-->
	
    <script type="text/javascript" src="/scripts/script.js"></script> <!-- Быстрый запрос на перезвон -->
	<script type="text/javascript" src="/scripts/ready.js"></script> <!-- слайдер на главной -->
	
	<!--Обратная связь-->
	<!--<script type="text/javascript" src="/scripts/sk.js"></script>
	<script type="text/javascript" src="/scripts/zapros.js"></script>-->
    <script src="//yandex.st/share/cnt.share.js"></script>
</head>

<body>
<div class="all">
<?
include("design/head.php");
?>

<?
	echo $menu->menu;
?>

<div class="general_content">
<?
	echo $users->login_result;
	echo $cart->add_result;
	include(Pages::$page);
?>
</div>





<noindex><div style="display: none;">
	<div id="login" class="login_form">
	<div class="modal_title">Вход</div>
    <div class="content">
	<p>Логин и пароль для входа</p>
    <form action='' method='post'>
	<p><input type='text' name='login' placeholder="Ваш логин"></p>
	<p><input type='password' name='password' placeholder="Ваш пароль"></td></p>
	<p><input type='submit' name='login_submit' value='Войти'></p>
    </form>
    <br />
    <a class='fancybox' href='#register'>Регистрация</a> | <a href='/login/remind'>Напомнить пароль</a>
    </div>
	</div>
	
	<div id="register" class="register_form">
	<div class="modal_title">Регистрация</div>
    <div class="content">
	<div>
	<?
		echo $users->register_result;
	?>
	</div>
    <form action='/login/register.html' method='post'>
	<table class="form_table">
	<tr><td class="left_td">Эл. почта*: </td> <td><input type='text' name='mail' value='<? echo $_POST[mail]; ?>'></td></tr>
	<tr><td class="left_td">Ник*: </td> <td><input type='text' name='login' value='<? echo $_POST[login]; ?>'></td></tr>
    <tr><td class="left_td">Пароль*: </td> <td> <input type='password' name='password' value='<? echo $_POST[password]; ?>'></td></tr>
    <tr><td class="left_td">Пароль повторно*: </td> <td> <input type='password' name='repassword' value='<? echo $_POST[repassword]; ?>'></td></tr>
    <tr><td class="left_td">Имя: </td> <td> <input type='text' name='name' value='<? echo $_POST[name]; ?>'></td></tr>
    <tr><td class="left_td">Фамилия: </td> <td> <input type='text' name='surname' value='<? echo $_POST[surname]; ?>'></td></tr>
    <tr><td class="left_td">Телефон: </td> <td> (<input type='text' name='phone1' size="3" maxlength="3" value='<? echo $_POST[phone1]; ?>'>)<input type='text' name='phone2' size="3" maxlength="3" value='<? echo $_POST[phone2]; ?>'>-<input type='text' name='phone3' size="2" maxlength="2" value='<? echo $_POST[phone3]; ?>'>-<input type='text' name='phone4' size="2" maxlength="2" value='<? echo $_POST[phone4]; ?>'></td></tr>
    <tr><td class="left_td">Получать рассылки: </td> <td> <input type='checkbox' name='distribution' value="1" <? if($_POST[distribution] == "1") echo "checked"; ?>></td></tr>
    <tr><td class="left_td"><img id='capcha' src='core/capcha.php?rand=123' style='border: 1px #6699CC solid; cursor:pointer;' onClick="document.getElementById('capcha').src='/core/capcha.php?rand='+Math.random()"></td> <td><span style='display:none;'><input type='text' name='kapcha' value="<? echo rand(10000,99999); ?>" size="5" maxlength="5"  placeholder="Впишите сюда цифры слева" ></span>
	<input type='text' name='duck' value="" size="5" maxlength="5"></td></tr>
	<tr><td colspan="2" style="text-align:right;">Впишите сюда цифры слева</td></tr>
    <tr><td colspan="2" style="text-align:center;"><input type='submit' name='register_submit' value='Регистрация'></td></tr>
	</table>
    </form>
    <br />
    <a class='fancybox' href='#login'>Вход</a> | <a href='/login/remind'>Напомнить пароль</a>
    </div>
	</div>
	
	<div id="recall" class="login_form">
	<div class="modal_title">Перезвонить Вам?</div>
    <div class="content">
	<form action="" method="post">
	<p><input type="text" name="name" placeholder="Ваше имя" /></p>
	<p><input type="text" name="phone" placeholder="Ваш телефон" /></p>
	<p>Вся информация переданная вами не коем образом не попадет в руки третьим лицам</p>
	<div class="send"><input type="submit" name="callback_send" value="Отправить" /></div>
	</form>
    </div>
	</div>
</div></noindex>

</div>


</body>

</html>