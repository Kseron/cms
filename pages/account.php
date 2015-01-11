<div class='breadcrumbs'><a href="/">Главная</a> » Личный кабинет</div>
<div class="content cabinet">
<?
	if($_SESSION[user] != "")
	{
?>
<div class="left">
<p><i class="fa fa-cog"></i> <a href="/account.html">Мои настройки</a></p>
<p><i class="fa fa-shopping-cart"></i> <a href="/account/orders.html">Мои заказы</a></p>
<p><i class="fa fa-sign-out"></i> <a href="/logout.html">Выйти с аккаунта</a></p>
</div>

<div class="right">
<?
	if($_GET[type] == "edit")
	{
		echo $users->red_result;
		?>
		<form action="" method="post">
		<table class="form_table">
			<tr><td>Логин:</td> <td><b><? echo $users->this_user[login]; ?></b></td></tr>
			<tr><td>Последний вход:</td> <td><? echo $users->this_user[last_enter]; ?></td></tr>
			<tr><td>Почта:</td> <td><? echo $users->this_user[mail]; ?></td></tr>
			<tr><td>Новый пароль:</td> <td><input type="text" name="password" size="80" maxlength="255" value=""></td></tr>
			<tr><td>Повтор пароля:</td> <td><input type="text" name="repassword" size="80" maxlength="255" value=""></td></tr>
			<tr><td>Имя:</td> <td><input type="text" name="name" size="80" maxlength="255" value="<? if($_POST[name] != "") { echo $_POST[name]; } else { echo $users->this_user[name]; } ?>"></td></tr>
			<tr><td>Фамилия:</td> <td><input type="text" name="surname" size="80" maxlength="255" value="<? if($_POST[surname] != "") { echo $_POST[surname]; } else { echo $users->this_user[surname]; } ?>"></td></tr>
			<tr><td>Телефон:</td> <td><input type="text" name="phone" size="80" maxlength="255" value="<? if($_POST[phone] != "") { echo $_POST[phone]; } else { echo $users->this_user[phone]; } ?>"></td></tr>
			<tr><td>Дата регистрации:</td> <td><input type="text" name="date_register" size="10" maxlength="10" value="<? if($_POST[date_register] != "") { echo $_POST[date_register]; } else { echo $users->this_user[date_register]; } ?>"></td></tr>
			<tr><td>Разсылка:</td> <td><input type="checkbox" name="distribution" value="1" <? if($_POST[distribution] == "1" OR $users->this_user[distribution] == "1") { echo "checked='checked'"; } ?>"></td></tr>
			<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
		</table>
		</form>
		<?
	}
	elseif($_GET[type] == "orders")
	{
		echo $cart->user_orders;
	}
	else
	{
		echo $users->this_account;
	}
?>
</div>
<?
	}
	else
	{
		echo "<h2>У вас не создан аккаунт. Доступ к странице запрещен</h2>";
	}
?>
</div>