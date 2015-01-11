<h1>Добавить категорию каталога статтей</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="/admin/article_category.html">Статьи: категории</a> » редактировать категорию статтей</div>

<?
	echo $articles->red_result;
?>
<form action="" method="post">
<table class="form_table">
<tr><td>Название:</td> <td><input type="text" name="title" size="30" value="<? if($_POST[title] != "") { echo $_POST[title]; } else { echo $articles->this_article_category[title]; } ?>"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Редактировать"></td></tr>
</table>
</form>