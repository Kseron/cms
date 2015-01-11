<h1>Редактировать пользователя</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="users_list.html">Пользователи</a> » Редактировать пользователя</div>

<?
	echo $users->red_result;
?>

<form action="" method="post">
<table class="form_table">
	<tr><td>Логин:</td> <td><b><? echo $users->this_user[login]; ?></b></td></tr>
	<tr><td>Последний вход:</td> <td><? echo $users->this_user[last_enter]; ?></td></tr>
	<tr><td>Последний ip:</td> <td><? echo $users->this_user[last_ip]; ?></td></tr>
	<tr><td>Новый пароль:</td> <td><input type="text" name="password" size="80" maxlength="255" value=""></td></tr>
	<tr><td>Повтор пароля:</td> <td><input type="text" name="repassword" size="80" maxlength="255" value=""></td></tr>
	<tr><td>Почта:</td> <td><input type="text" name="mail" size="80" maxlength="255" value="<? if($_POST[mail] != "") { echo $_POST[mail]; } else { echo $users->this_user[mail]; } ?>"></td></tr>
	<tr><td>Имя:</td> <td><input type="text" name="name" size="80" maxlength="255" value="<? if($_POST[name] != "") { echo $_POST[name]; } else { echo $users->this_user[name]; } ?>"></td></tr>
	<tr><td>Фамилия:</td> <td><input type="text" name="surname" size="80" maxlength="255" value="<? if($_POST[surname] != "") { echo $_POST[surname]; } else { echo $users->this_user[surname]; } ?>"></td></tr>
	<tr><td>Телефон:</td> <td><input type="text" name="phone" size="80" maxlength="255" value="<? if($_POST[phone] != "") { echo $_POST[phone]; } else { echo $users->this_user[phone]; } ?>"></td></tr>
	<tr><td>Дата регистрации:</td> <td><input type="text" name="date_register" size="10" maxlength="10" value="<? if($_POST[date_register] != "") { echo $_POST[date_register]; } else { echo $users->this_user[date_register]; } ?>"></td></tr>
	<tr><td>Тип:</td> <td><select name="type">
	<? $users->create_select_user_type($_GET[id]);
	echo $users->select_user_type;  ?>
	</select></td></tr>
	<tr><td>Разсылка:</td> <td><input type="checkbox" name="distribution" value="1" <? if($_POST[distribution] == "1" OR $users->this_user[distribution] == "1") { echo "checked='checked'"; } ?>"></td></tr>
	<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
</table>
</form>