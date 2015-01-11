<?
if($_GET[modal_type] == "login")
{
?>
<div id="login" style="width:400px; overflow:auto;">
    <center>
	<b>Вход на сайт</b>
    <form action='' method='post'>
	<table class="form_table">
	<tr><td class="left_td">Ник: </td> <td><input type='text' name='login'></td></tr>
    <tr><td class="left_td">Пароль: </td> <td> <input type='password' name='password'></td></tr>
    <tr><td colspan="2"><input type='checkbox' name='login_memory' value="1" checked> запомнить</td></tr>
    <tr><td colspan="2" style="text-align:center;"><input type='submit' name='login_submit' value='Войти'></td></tr>
	</table>
    </form>
    <br />
    <a class='fancybox' href='/ajax/index.php?script=login&modal_type=register'>Регистрация</a> | <a href='/login/remind'>Напомнить пароль</a>
    </center>
	</div>
<?
}
elseif($_GET[modal_type] == "register")
{
?>
	<div id="register" style="width:400px; overflow:auto;">
    <center>
	<b>Регистрация</b>
	<div align="left">
	<?
		echo $users->register_result;
	?>
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
    <tr><td class="left_td">Получать рассылки: </td> <td> <input type='checkbox' name='distribution' value="1" value='<? if($_POST[distribution] == "1") echo "checked"; ?>'></td></tr>
    <tr><td colspan="2" style="text-align:center;"><input type='submit' name='register_submit' value='Регистрация'></td></tr>
	</table>
    </form>
    <br />
    <a class='fancybox' href='/ajax/index.php?script=login&modal_type=login'>Вход</a> | <a href='/login/remind'>Напомнить пароль</a>
    </center>
	</div>
<?
}