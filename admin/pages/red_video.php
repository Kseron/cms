<h1>Добавить видео</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="video_list.html">Видео</a> » Добавить видео</div>

<?
	echo $video->red_result;
?>
<form action="" method="post">
<table class="form_table">
<tr><td>Название:</td> <td><input type="text" name="title" size="30" maxlength="255" value="<? if($_POST['title'] != "") { echo $_POST['title']; } else { echo $video->this_video['title']; } ?>"></td></tr>
<tr><td class="left_td">Транслит</td> <td><input type="text" name="eng_title" size="80" value="<? if($_POST["eng_title"] != "") { echo $_POST["eng_title"];} else { echo $video->this_video["eng_title"]; } ?>"></td></tr>
<tr><td>Категория:</td> <td><select name="category">
<? echo $video->select_category; ?>
</select></td></tr>
<tr><td>Код видео из Youtube:</td> <td><textarea name="text" style="width:100%; min-width:500px; height:150px;"><? if($_POST['text'] != "") { echo $_POST['text']; } else { echo $video->this_video['text']; } ?></textarea></td></tr>
<tr><td class="left_td">description:</td> <td><textarea name="description" maxlength="255"><? if($_POST['description'] != "") { echo $_POST['description']; } else { echo $video->this_video['description']; } ?></textarea></td></tr>
<tr><td class="left_td">keywords:</td> <td><input type="text" name="keywords" maxlength="255" value="<? if($_POST['keywords'] != "") { echo $_POST['keywords']; } else { echo $video->this_video['keywords']; } ?>"></td></tr>
<tr><td>Дата и время:</td> <td><input type="text" name="datetime" size="19" maxlength="19" value="<? if($_POST['datetime'] != "") { echo $_POST['datetime']; } else { echo $video->this_video['datetime']; } ?>"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Редактировать"></td></tr>
</table>
</form>