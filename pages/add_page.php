<h1>Добавить страницу</h1>

<?
	echo $my_pages->add_result;
?>

<form action='' method='post' enctype='multipart/form-data'>
	<table class="form_table" style="width:100%;">
	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50' value='<? echo $_POST["title"]; ?>'></td></tr>
	<tr><td class='left_td'>URL</td> <td><!--<span class='gray_text'>/index/</span>--><input type='text' name='url' size='50' value='<? echo $_POST["url"]; ?>'></td></tr>
	<tr><td class='left_td'>Текст</td> <td><textarea name="text"><? echo $_POST["text"]; ?></textarea>
	<script type='text/javascript'>//<![CDATA[
    CKEDITOR.replace('text');
    //]]></script>
	</td></tr>
	<tr><td class='left_td'>mini_decsription</td> <td><textarea name="mini_descr" style="width:100%;"><? echo $_POST['mini_descr']; ?></textarea></td></tr>
	<tr><td class='left_td'>keywords</td> <td><input type="text" name="keywords" style="width:100%;" value="<? echo $_POST['keywords']; ?>"></td></tr>
	<tr><td class='left_td'>Статус</td> <td><select name='vision'>
	<option value='1'>Видима</option>
	<option value='0'>Невидима</option>
	</select>
	</td></tr>
	<tr><td class='left_td'></td> <td><input type='submit' name='submit' value='Добавить'></td></tr>
	</table>
</form>