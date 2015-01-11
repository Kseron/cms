<h1>Редактировать схему</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> > Редактировать схему</div>

<?
	echo $scheme->red_result;
?>
<form action="" method="post">
<table class="form_table">
<tr><td>Название:</td> <td><input type="text" name="title" size="80" maxlength="255" value="<? if($_POST["title"] != "") { echo $_POST["title"]; } else { echo $scheme->this_scheme["title"]; } ?>"></td></tr>
<tr><td class='left_td'>Текст</td> <td><textarea name="text"><? if($_POST["text"] != "") { echo $_POST["text"]; } else { echo $scheme->this_scheme["text"]; } ?></textarea>
<script type='text/javascript'>//<![CDATA[
CKEDITOR.replace('text', {toolbar:'Normal'});
//]]></script>
</td></tr>
<tr><td class='left_td'>description:</td> <td><textarea name="description"><? if($_POST["description"] != "") { echo $_POST["description"]; } else { echo $scheme->this_scheme["description"]; } ?></textarea></td></tr>
<tr><td class='left_td'>keywords:</td> <td><input type="text" name="keywords" size="50" value="<? if($_POST["keywords"] != "") { echo $_POST["keywords"]; } else { echo $scheme->this_scheme["keywords"]; } ?>"></td></tr>
<tr><td>Время:</td> <td><input type="text" name="datetime" size="19" maxlength="19" value="<? if($_POST["datetime"] != "") { echo $_POST["datetime"]; } else { echo $scheme->this_scheme["datetime"]; } ?>"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
</table>
</form>