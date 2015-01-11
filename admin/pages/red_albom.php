<h1>Редактировать альбом</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="portfolio_list.html">Портфолио</a> » Редактировать альбом</div>

<?
	echo $portfolio->add_result;
?>
<form action="" method="post" enctype="multipart/form-data">
<table class="form_table">
<tr><td class="left_td">Название:</td> <td><input type="text" name="title" maxlength="255" value='<? if($_POST["title"] != "") { echo $_POST["title"]; } else { echo $portfolio->this_albom["title"]; } ?>'></td></tr>
<tr><td class="left_td">Транслит</td> <td><input type="text" name="eng_title" size="80" value="<? if($_POST["eng_title"] != "") { echo $_POST["eng_title"];} else { echo $portfolio->this_albom["eng_title"]; } ?>"></td></tr>
<tr><td class="left_td">Категория:</td> <td><select name="category">
<? echo $portfolio->select_category; ?>
</select></td></tr>
<tr><td class='left_td'>Текст:</td> <td><textarea name="text"><? if($_POST["text"] != "") { echo $_POST["text"]; } else { echo $portfolio->this_albom["text"]; } ?></textarea>
<script type='text/javascript'>//<![CDATA[
CKEDITOR.replace('text', {toolbar:'Normal'});
//]]></script>
</td></tr>
<tr><td class="left_td">description:</td> <td><textarea name="description" maxlength="255"><? if($_POST["description"] != "") { echo $_POST["description"]; } else { echo $portfolio->this_albom["description"]; } ?></textarea></td></tr>
<tr><td class="left_td">keywords:</td> <td><input type="text" name="keywords" maxlength="255" value="<? if($_POST["keywords"] != "") { echo $_POST["keywords"]; } else { echo $portfolio->this_albom["keywords"]; } ?>"></td></tr>
<tr><td class="left_td">Время:</td> <td><input type="text" name="datetime" size="19" maxlength="19" value="<? if($_POST["datetime"] != "") { echo $_POST["datetime"]; } else { echo $portfolio->this_albom["datetime"]; } ?>"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Отправить"></td></tr>
</table>
</form>

<?
echo $portfolio->one_portfolio;
?>