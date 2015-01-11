<h1>Добавить категорию видеокаталога</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> > Добавить категорию видеокаталога</div>

<?
	echo $video->add_result;
?>
<form action="" method="post">
<table class="form_table">
<tr><td class="left_td">Название:</td> <td><input type="text" name="title" size="30"></td></tr>
<tr><td class="left_td">description:</td> <td><textarea name="description"><? echo $_POST['description']; ?></textarea></td></tr>
<tr><td class="left_td">keywords:</td> <td><input type="text" name="keywords" size="50" value="<? echo $_POST['keywords']; ?>"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Добавить"></td></tr>
</table>
</form>