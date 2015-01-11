<noindex><center>
<?
if($_GET[type] == "login")
{
?>
<div class="login_form">
	<div class="modal_title">Вход</div>
	<div class="modal_title">Вход</div>
	<p>Логин и пароль для входа</p>
    <center>
    <form action='' method='post'>
	<p><input type='text' name='login' placeholder="Ваш логин"></p>
	<p><input type='password' name='password' placeholder="Ваш пароль"></td></p>
	<p><input type='submit' name='login_submit' value='Войти'></p>
    </form>
    <br />
    <a class='fancybox' href='/pages/login.php?modal_type=register'>Регистрация</a> | <a href='/login/remind'>Напомнить пароль</a>
    </center>
	</div>
<?
}
elseif($_GET[type] == "register")
{
?>
<div style="width:600px;">
	<h1>Регистрация</h1>
    <center>
	<?
		echo $users->register_result;
		if(preg_match("/error_msg/i", $users->register_result))
		{
	?>
	<div align="left" style="width:400px;">
	</div>
    <form action='' method='post'>
	<table class="form_table">
	<tr><td class="left_td">Эл. почта*: </td> <td><input type='text' name='mail' value='<? echo $_POST[mail]; ?>'></td></tr>
	<tr><td class="left_td">Ник*: </td> <td><input type='text' name='login' value='<? echo $_POST[login]; ?>'></td></tr>
    <tr><td class="left_td">Пароль*: </td> <td> <input type='password' name='password' value='<? echo $_POST[password]; ?>'></td></tr>
    <tr><td class="left_td">Пароль повторно*: </td> <td> <input type='password' name='repassword' value='<? echo $_POST[repassword]; ?>'></td></tr>
    <tr><td class="left_td">Имя: </td> <td> <input type='text' name='name' value='<? echo $_POST[name]; ?>'></td></tr>
    <tr><td class="left_td">Фамилия: </td> <td> <input type='text' name='surname' value='<? echo $_POST[surname]; ?>'></td></tr>
    <tr><td class="left_td">Телефон: </td> <td> (<input type='text' name='phone1' size="3" maxlength="3" value='<? echo $_POST[phone1]; ?>'>)<input type='text' name='phone2' size="3" maxlength="3" value='<? echo $_POST[phone2]; ?>'>-<input type='text' name='phone3' size="2" maxlength="2" value='<? echo $_POST[phone3]; ?>'>-<input type='text' name='phone4' size="2" maxlength="2" value='<? echo $_POST[phone4]; ?>'></td></tr>
    <tr><td class="left_td">Получать рассылки: </td> <td> <input type='checkbox' name='distribution' value="1" <? if($_POST[distribution] == "1") { echo " checked"; } ?>></td></tr>
    <tr><td class="left_td"><img id='capcha' src='core/capcha.php?rand=123' style='border: 1px #6699CC solid; cursor:pointer;' onclick="document.getElementById('capcha').src='/core/capcha.php?rand='+Math.random()"></td> <td><span style='display:none;'><input type='text' name='kapcha' value="<? echo rand(10000,99999); ?>" size="5" maxlength="5"  placeholder="Впишите сюда цифры слева" ></span>
	<input type="text" name="duck" value="" size="5" maxlength="5"></td></tr>
	<tr><td colspan="2" style="text-align:right;">Впишите сюда цифры слева</td></tr>
	<tr><td colspan="2" style="text-align:center;"><input type='submit' name='register_submit' value='Регистрация'></td></tr>
	</table>
    </form>
    <br />
    <a class='fancybox' href='/pages/login.php?modal_type=login'>Вход</a> | <a href='/login/remind'>Напомнить пароль</a>
    </center>
	</div>
<?
	}
}
elseif($_GET[type] == "check")
{
	echo $users->check_result;
}
elseif($_GET[type] == "recheck")
{
	echo $users->recheck_text;
}
?>
</center></noindex>