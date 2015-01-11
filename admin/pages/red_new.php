<h1>Редактировать новость</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="news.html">Новости</a> » Редактировать новость</div>

<?
	echo $news->red_result;
?>
<form action="" method="post">
<table class="form_table">
<tr><td class="left_td">Название</td> <td><input type="text" name="title" size="80" maxlength="255" value="<? if($_POST["title"] != "") { echo $_POST["title"]; } else { echo $news->this_new["title"]; } ?>"></td></tr>
<tr><td class="left_td">Транслит</td> <td><input type="text" name="eng_title" size="80" value="<? if($_POST["eng_title"] != "") { echo $_POST["eng_title"];} else { echo $news->this_new["eng_title"]; } ?>"></td></tr>
<tr><td class="left_td">Краткий текст</td> <td><textarea name="short_text"><? if($_POST["short_text"] != "") { echo $_POST["short_text"]; } else { echo $news->this_new["short_text"]; } ?></textarea>
<script type='text/javascript'>//<![CDATA[
CKEDITOR.replace('short_text', {toolbar:'Normal'});
//]]></script>
</td></tr>
<tr><td class="left_td">Текст</td> <td><textarea name="text"><? if($_POST["text"] != "") { echo $_POST["text"]; } else { echo $news->this_new["text"]; } ?></textarea>
<script type='text/javascript'>//<![CDATA[
CKEDITOR.replace('text', {toolbar:'Normal'});
//]]></script>
</td></tr>
<tr><td class='left_td'>description</td> <td><textarea name="description"><? if($_POST["description"] != "") { echo $_POST["description"]; } else { echo $news->this_new["description"]; } ?></textarea></td></tr>
<tr><td class='left_td'>keywords</td> <td><input type="text" name="keywords" size="50" value="<? if($_POST["keywords"] != "") { echo $_POST["keywords"]; } else { echo $news->this_new["keywords"]; } ?>"></td></tr>
<tr><td class="left_td">Время</td> <td><input type="text" name="datetime" size="19" maxlength="19" value="<? if($_POST["datetime"] != "") { echo $_POST["datetime"]; } else { echo $news->this_new["datetime"]; } ?>"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
</table>
</form>