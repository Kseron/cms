<h1>Добавить страницу</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> > Добавить страницу</div>

<?
	echo $my_pages->add_result;
?>

<form action='' method='post' enctype='multipart/form-data'>
	<table class="form_table">
	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50' value='<? echo $_POST["title"]; ?>'></td></tr>
	<tr><td class='left_td'>URL</td> <td><input type='text' name='url' size='50' value='<? echo $_POST["url"]; ?>'></td></tr>
	<tr><td class='left_td'>Текст</td> <td><textarea name="text"><? echo $_POST["text"]; ?></textarea>
	<script type='text/javascript'>//<![CDATA[
    CKEDITOR.replace('text', {toolbar:('Normal')});
    //]]></script>
	</td></tr>
	<tr><td class='left_td'>description</td> <td><textarea name="description"><? echo $_POST['description']; ?></textarea></td></tr>
	<tr><td class='left_td'>keywords</td> <td><input type="text" name="keywords" size="50" value="<? echo $_POST['keywords']; ?>"></td></tr>
	<tr><td class='left_td'>Специальный дизайн</td> <td><input type='checkbox' name='special_design' value='1'></td></tr>
	<tr><td class='left_td'>Изображение фона</td> <td><input type='file' name='image'></td></tr>
	<tr><td class='left_td'>Статус</td> <td><select name='vision'>
	<option value='1'>Видима</option>
	<option value='0'>Невидима</option>
	</select>
	</td></tr>
	<tr><td class='left_td'></td> <td><input type='submit' name='submit' value='Добавить'></td></tr>
	</table>
</form>