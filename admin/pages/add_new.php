<h1>Добавить новость</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> > Добавить новость</div>

<?
	echo $news->add_result;
?>
<form action="" method="post">
<table class="form_table">
<tr><td>Название:</td> <td><input type="text" name="title" size="80" maxlength="255"></td></tr>
<tr><td class="left_td">Транслит</td> <td><input type="text" name="eng_title" size="80" value="<? echo $_POST["eng_title"]; ?>"></td></tr>
<tr><td class="left_td">Краткий текст</td> <td><textarea name="short_text"><? echo $_POST["short_text"]; ?></textarea>
<script type='text/javascript'>//<![CDATA[
CKEDITOR.replace('short_text', {toolbar:'Normal'});
//]]></script>
</td></tr>
<tr><td class="left_td">Текст</td> <td><textarea name="text"><? echo $_POST["text"]; ?></textarea>
<script type='text/javascript'>//<![CDATA[
CKEDITOR.replace('text', {toolbar:'Normal'});
//]]></script>
</td></tr>
<tr><td class='left_td'>description:</td> <td><textarea name="description"><? echo $_POST['description']; ?></textarea></td></tr>
<tr><td class='left_td'>keywords:</td> <td><input type="text" name="keywords" size="50" value="<? echo $_POST['keywords']; ?>"></td></tr>
<tr><td class="left_td">Время:</td> <td><input type="text" name="datetime" size="19" maxlength="19" value="<? echo Date_time::get_date("datetime"); ?>"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
</table>
</form>