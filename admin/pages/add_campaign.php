<h1>Добавить акцию</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="campaigns_list.html">Акции</a> » Добавить акцию</div>

<?
	echo $campaigns->add_result;
?>
<form action="" method="post">
<table class="form_table">
<tr><td class="left_td">Название*</td> <td><input type="text" name="title" size="80" maxlength="255" value='<? echo $_POST["title"]; ?>'></td></tr>
<tr><td class="left_td">Текст*</td> <td><textarea name="text"><? echo $_POST["text"]; ?></textarea>
<script type='text/javascript'>//<![CDATA[
CKEDITOR.replace('notext', {toolbar:'Normal'});
//]]></script>
</td></tr>
<tr><td class="left_td">Начало акции*</td> <td><input type="text" name="date_start" size="10" maxlength="10" value="<? echo Date_time::get_date("today"); ?>"></td></tr>
<tr><td class="left_td">Конец акции*</td> <td><input type="text" name="date_end" size="10" maxlength="10" value="<? echo $_POST["date_end"]; ?>"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
</table>
</form>