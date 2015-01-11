<?
$breadcrumbs->create_breadcrumbs("product", $_GET[id]);
echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>";

echo $reviews->add_result;
?>

<div class='good'>
<?
echo $products->one_product;