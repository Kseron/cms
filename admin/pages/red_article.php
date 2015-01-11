<h1>Редактировать статью</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="article_list.html">Статьи</a> » Редактировать статью</div>

<?
	echo $articles->red_result;
?>
<form action="" method="post">
<table class="form_table">
<tr><td class="left_td">Название</td> <td><input type="text" name="title" size="80" maxlength="255" value='<? if($_POST["title"] != "") { echo $_POST["title"]; } else { echo $articles->this_article["title"]; } ?>'></td></tr>
<tr><td class='left_td'>Транслит</td> <td><input type='text' name='eng_title' size='50' value='<? if($_POST["eng_title"] != "") { echo $_POST["eng_title"];} else { echo $articles->this_article["eng_title"]; } ?>'></td></tr>
<tr><td class="left_td">Категория</td> <td><select name="category">
<? echo $articles->select_category; ?>
</select></td></tr>
<tr><td class="left_td">Текст</td> <td><textarea name="text"><? if($_POST["text"] != "") { echo $_POST["text"]; } else { echo $articles->this_article["text"]; } ?></textarea>
<script type='text/javascript'>//<![CDATA[
CKEDITOR.replace('text', {toolbar:'Normal'});
//]]></script>
</td></tr>
<tr><td class="left_td">description</td> <td><textarea name="description"><? if($_POST["description"] != "") { echo $_POST["description"]; } else { echo $articles->this_article["description"]; } ?></textarea></td></tr>
<tr><td class="left_td">keywords</td> <td><input type="text" name="keywords" size="50" value="<? if($_POST["keywords"] != "") { echo $_POST["keywords"]; } else { echo $articles->this_article["keywords"]; } ?>"></td></tr>
<tr><td class="left_td">Дата и время</td> <td><input type="text" name="datetime" size="19" maxlength="19" value="<? if($_POST["datetime"] != "") { echo $_POST["datetime"]; } else { echo $articles->this_article["datetime"]; } ?>"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
</table>
</form>