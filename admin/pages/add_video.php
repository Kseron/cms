<h1>Добавить видео</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="video_list.html">Видео</a> » Добавить видео</div>

<?
	echo $video->add_result;
?>
<form action="" method="post">
<table class="form_table">
<tr><td>Название:</td> <td><input type="text" name="title" size="30" maxlength="255"></td></tr>
<tr><td class="left_td">Транслит</td> <td><input type="text" name="eng_title" size="80" value="<? echo $_POST["eng_title"]; ?>"></td></tr>
<tr><td>Категория:</td> <td><select name="category">
<? echo $video->select_category; ?>
</select></td></tr>
<tr><td>Код видео из Youtube:</td> <td><textarea name="text" style="width:100%; min-width:500px; height:150px;"></textarea></td></tr>
<tr><td class="left_td">description:</td> <td><textarea name="description" maxlength="255"><? echo $_POST['description']; ?></textarea></td></tr>
<tr><td class="left_td">keywords:</td> <td><input type="text" name="keywords" maxlength="255" value="<? echo $_POST['keywords']; ?>"></td></tr>
<tr><td>Дата и время:</td> <td><input type="text" name="datetime" size="19" maxlength="19" value="<? echo Date_time::get_date("datetime"); ?>"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Добавить"></td></tr>
</table>
</form>