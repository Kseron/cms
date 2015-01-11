<h1>Добавить фото</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> > Добавить фото</div>

<?
	echo $photos->add_result;
?>
<form action="" method="post" enctype="multipart/form-data">
<table class="form_table">
<tr><td>Название:</td> <td><input type="text" name="title" maxlength="255" value='<? echo $_POST["title"]; ?>'></td></tr>
<tr><td>Категория:</td> <td><select name="category">
<? echo $photos->select_category; ?>
</select></td></tr>
<tr><td>Время:</td> <td><input type="text" name="datetime" size="19" maxlength="19" value="<? echo Date_time::get_date("datetime"); ?>"></td></tr>
<tr><td>Файл:</td> <td><input type="file" name="photo" ></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
</table>
</form>