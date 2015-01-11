<?
	if($_GET[eng_title] != "")
	{
		$breadcrumbs->create_breadcrumbs("news", $_GET[eng_title]);
		echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>";
		echo $news->one_new;
	}
	else
	{
		$breadcrumbs->create_breadcrumbs("news", $_GET[eng_title]);
		echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>";
		echo "<h1>Новости компании</h1>";
		echo $news->news_list;
		echo $news->str_list_new;
	}
?>