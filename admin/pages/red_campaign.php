<h1>Редактировать акцию</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="campaigns_list.html">Акции</a> » Редактировать акцию</div>

<?
	echo $campaigns->red_result;
?>
<form action="" method="post">
<table class="form_table">
<tr><td class="left_td">Название</td> <td><input type="text" name="title" size="80" maxlength="255" value='<? if($_POST["title"] != "") { echo $_POST["title"]; } else { echo $campaigns->this_campaign["title"]; } ?>'></td></tr>
<tr><td class="left_td">Текст</td> <td><textarea name="text"><? if($_POST["text"] != "") { echo $_POST["text"]; } else { echo $campaigns->this_campaign["text"]; } ?></textarea>
<script type='text/javascript'>//<![CDATA[
CKEDITOR.replace('notext', {toolbar:'Normal'});
//]]></script>
</td></tr>
<tr><td class="left_td">Начало акции*</td> <td><input type="text" name="date_start" size="10" maxlength="10" value="<? if($_POST["date_start"] != "") { echo $_POST["date_start"]; } else { echo $campaigns->this_campaign["date_start"]; } ?>"></td></tr>
<tr><td class="left_td">Конец акции*</td> <td><input type="text" name="date_end" size="10" maxlength="10" value="<? if($_POST["date_end"] != "") { echo $_POST["date_end"]; } else { echo $campaigns->this_campaign["date_end"]; } ?>"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
</table>
</form>