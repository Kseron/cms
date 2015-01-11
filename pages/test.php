<?

//$prise_query = mysql_query("SELECT product_type FROM products WHERE prise > ".$_COOKIE['prise_from']." AND prise < ".$_COOKIE['prise_to']."");
//$query = mysql_query("SELECT product_types.*, products.* FROM product_types AS product_types, products AS products 
//WHERE products.prise > '200' AND products.prise < '300' AND product_types.id = products.product_type");
$query = mysql_query("SELECT p1.id, p1.title, p2.prise FROM product_types AS p1, products AS p2 WHERE p1.category = '5' AND p2.prise < '400'");
while($array = mysql_fetch_array($query))
{
	echo "<p>$array[id] - ".$array['title']." - ".$array['prise']."</p>";
	print_r($array);
	echo "<br /><br />";
}
?>