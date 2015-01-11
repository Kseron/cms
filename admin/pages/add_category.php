<h1>Добавить категорию товара</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> > Добавить категорию товара</div>

<?
	echo $catalog->add_result;
?>
<form action='' method='post' enctype='multipart/form-data'>
	<table class="form_table">
	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50' value='<? echo $_POST[title]; ?>'></td></tr>
	<!--<tr><td class='left_td'>Транскрипция</td> <td><input type='text' name='eng_title' size='50' value='<? echo $_POST[eng_title]; ?>'></td></tr>-->
	<tr><td class='left_td'>Описание</td> <td><textarea name='text'><? echo $_POST['description']; ?></textarea>
	<script type='text/javascript'>//<![CDATA[
    CKEDITOR.replace('text', {toolbar:'Normal'});
    //]]></script>
	</td></tr>
	<tr><td class='left_td'>Mini_description</td> <td><input type='text' name='mini_descr' size='50' value='<? echo $_POST['mini_descr']; ?>'></td></tr>
	<tr><td class='left_td'>Ключевые слова</td> <td><input type='text' name='keywords' size='50' value='<? echo $_POST['keywords']; ?>'></td></tr>
	<tr><td class='left_td'>Родительская категория</td> <td><select name="category"><? echo $catalog->select_category; ?></select></td></tr>
	<tr><td class='left_td'>Картинка</td> <td><input type='file' name='image'></td></tr>
	<tr><td class='left_td'>Статус</td> <td><select name='vision'>
	<option value='1'>Видим</option>
	<option value='0'>Невидим</option>
	</select>
	</td></tr>
	<tr><td class='left_td'></td> <td><input type='submit' name='submit' value='Добавить'></td></tr>
</table>
</form>