<h1>Редактировать блок</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="content_blocks.html">Блоки</a> » Редактировать блок</div>

<?
	echo $functions->red_result;
?>
<form action="" method="post" enctype="multipart/form-data">
<table class="form_table">
<tr><td class="left_td">Название:</td> <td><input type="text" name="title" maxlength="255" value='<? if($_POST["title"] != "") { echo $_POST["title"]; } else { echo $functions->this_block["title"]; } ?>'></td></tr>
<tr><td class='left_td'>Текст:</td> <td><textarea name="text" rows="30"><? if($_POST["text"] != "") { echo $_POST["text"]; } else { echo $functions->this_block["text"]; } ?></textarea>
</td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
</table>
</form>