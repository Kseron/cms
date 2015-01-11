<?
if($_GET[id] != "" AND $catalog->this_category['parent'] != 0)
{
?>
<aside class='right-col'>
	<div class='filters'>
	<div class='title'>
	Подбор по параметрам
	</div>
	<div class='content'>
	<noindex>
	<form action='' method='get'>
<?
echo $products->filter_list;
?>
	<div style='text-align:center;'>
	<!--<input type='submit' name='filters_submit' class='blue_button' value='Найти'>-->
	</div>
	</form>
	</noindex>
	</div>
	</div>
	
	</aside>
<div style='margin-right:215px;'>
<?
}
else
{
?>
<div>
<?
}
	$breadcrumbs->create_breadcrumbs("catalog");
	echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>";

echo $products->list_products;

//echo $products->str_list_products;

if($_GET[id] == "")
{
	echo $functions->create_content("catalog_index");
}

?>
</div>
