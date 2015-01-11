<?
	$breadcrumbs->create_breadcrumbs("catalog");
	echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>";
?>

<div style="margin-bottom:10px;">
<form action="" method="post">
<input type="text" name="product_articul" value="<? echo $_POST[product_articul]; ?>" placeholder="Артикул товара для поиска"> <input type="submit" name="product_articul_search" value="Найти">
</form>
</div>

<?

echo $products->list_products;

echo $products->str_list_products;

?>
