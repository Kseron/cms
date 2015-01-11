<h1>Редактировать настройку</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="settings/<? echo $settings->this_setting[type]; ?>.html">Настройки</a> » Редактировать настройку</div>

<?
	echo $settings->red_result;
?>

<form action="" method="post">
<table class="form_table">
	<tr><td>Название:</td> <td><? echo $settings->this_setting[title]; ?></td></tr>
	<tr><td>Значение:</td> <td><input type="text" name="value" size="80" maxlength="255" value="<? if($_POST[value] != "") { echo $_POST[value]; } else { echo $settings->this_setting[value]; } ?>"></td></tr>
	<tr><td>Описание:</td> <td><textarea name="description"><? if($_POST[description] != "") { echo $_POST[description]; } else { echo $settings->this_setting[description]; } ?></textarea></td></tr>
	<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
</table>
</form>