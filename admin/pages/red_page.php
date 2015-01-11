<h1>Редактировать страницу</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> > <a href="/admin/pages_list.html">Страницы</a> > Редактировать страницу</div>

<?
	echo $my_pages->red_result;
?>
<form action='' method='post' enctype='multipart/form-data'>
	<table class="form_table" style="100%">
	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50' value='<? if($_POST["title"] != "") { echo $_POST["title"];} else { echo $my_pages->this_page["title"]; } ?>'></td></tr>
	<tr><td class='left_td'>URL</td> <td><input type='text' name='url' size='50' value='<? if($_POST["url"] != "") { echo $_POST["url"];} else { echo $my_pages->this_page["url"]; } ?>'></td></tr>
	<tr><td class='left_td'>Текст</td> <td><textarea name="text"><? if($_POST["text"] != "") { echo $_POST["text"];} else { echo $my_pages->this_page["text"]; } ?></textarea>
	<script type='text/javascript'>//<![CDATA[
    CKEDITOR.replace('text', {toolbar:('Normal')});
    //]]></script>
	</td></tr>
	<tr><td class='left_td'>mini_decsription</td> <td><textarea name="description" style="width:100%;"><? if($_POST["description"] != "") { echo $_POST["description"];} else { echo $my_pages->this_page['description']; } ?></textarea></td></tr>
	<tr><td class='left_td'>keywords</td> <td><input type="text" name="keywords" style="width:100%;" value='<? if($_POST["keywords"] != "") { echo $_POST["keywords"];} else { echo $my_pages->this_page["keywords"]; } ?>'></td></tr>
	<tr><td class='left_td'>Специальный дизайн</td> <td><input type='checkbox' name='special_design' value='1'<? if($_POST["special_design"] == 1 OR $my_pages->this_page["special_design"] == 1) { echo " checked"; } ?>></td></tr>
	<tr><td class='left_td'>Изображение фона</td> <td><input type='file' name='image'></td></tr>
	<tr><td class='left_td'>Статус</td> <td><select name='vision'>
	<option value='1'<? if($my_pages->this_page['vision'] == "1") {echo " selected";}?>>Видима</option>
	<option value='0'<? if($my_pages->this_page['vision'] == "0") {echo " selected";}?>>Невидима</option>
	</select>
	</td></tr>
	<tr><td class='left_td'></td> <td><input type='submit' name='submit' value='Редактировать'></td></tr>
	</table>
</form>