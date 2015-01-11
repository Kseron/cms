<h1>Добавить категорию каталога статтей</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> » <a href="/admin/article_category.html">Статьи: категории</a> » Добавить категорию статтей</div>

<?
	echo $articles->add_result;
?>
<form action="" method="post">
<table class="form_table">
<tr><td>Название:</td> <td><input type="text" name="title" size="30"></td></tr>
<tr><td></td> <td><input type="submit" name="submit" value="Добавить"></td></tr>
</table>
</form>