<h1>Редактировать страницу</h1>

<?
	echo $my_pages->red_result;
?>


<form action='' method='post' enctype='multipart/form-data'>
	<table class="form_table">
	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50' value='<? if($_POST["title"] != "") { echo $_POST["title"];} else { echo $my_pages->this_page["title"]; } ?>'></td></tr>
	<tr><td class='left_td'>URL</td> <td><!--<span class='gray_text'>/index/</span>--><input type='text' name='url' size='50' value='<? if($_POST["url"] != "") { echo $_POST["url"];} else { echo $my_pages->this_page["url"]; } ?>'></td></tr>
	<tr><td class='left_td'>Текст</td> <td><textarea name="text"><? if($_POST["text"] != "") { echo $_POST["text"];} else { echo $my_pages->this_page["text"]; } ?></textarea>
	<script type='text/javascript'>//<![CDATA[
    CKEDITOR.replace('text');
    //]]></script>
	</td></tr>
	<tr><td class='left_td'>mini_decsription</td> <td><textarea name="mini_descr"><? if($_POST["mini_descr"] != "") { echo $_POST["mini_descr"];} else { echo $my_pages->this_page['mini_descr'];} ?></textarea></td></tr>
	<tr><td class='left_td'>keywords</td> <td><input type="text" name="keywords" size="50" value='<? if($_POST["keywords"] != "") { echo $_POST["keywords"];} else { echo $my_pages->this_page["keywords"]; } ?>'></td></tr>
	<tr><td class='left_td'>Статус</td> <td><select name='vision'>
	<option value='1'<? if($my_pages->this_page['vision'] == "1") {echo " selected";}?>>Видима</option>
	<option value='0'<? if($my_pages->this_page['vision'] == "0") {echo " selected";}?>>Невидима</option>
	</select>
	</td></tr>
	<tr><td class='left_td'></td> <td><input type='submit' name='submit' value='Редактировать'></td></tr>
	</table>
</form>