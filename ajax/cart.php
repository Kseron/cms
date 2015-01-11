<?
if($_POST[type] == "delete_from_cart" AND $_POST[id] != "")
{
	$cart->delete_from_cart($_POST[id]);
	echo $cart->delete_result;
}
elseif($_POST[type] == "recalculate_cart" AND $_POST["cart_id"] != ""  AND $_POST["product_id"] != "" AND $_POST["count"] != "")
{
	$array = mysql_fetch_array(mysql_query("SELECT prise FROM products WHERE id='".$_POST["product_id"]."'"));
	$sum = $array[prise] * $_POST["count"];
	mysql_query("UPDATE cart SET count='".$_POST["count"]."', sum='$sum' WHERE id='".$_POST["cart_id"]."'");
	echo $sum;
}

/*
if($_POST[type] == "add_to_cart" AND $_POST[id] != "")
{
	//$goods->add_to_cart($_POST['id']);
	echo $products->add_to_cart_result;
}
elseif($_POST[type] == "delete_from_cart" AND $_POST[id] != "")
{
	$cart->delete_from_cart($_POST[id]);
	echo $cart->delete_result;
}
elseif($_POST[type] == "change_count" AND $_POST[id] != "" AND $_POST['count'] != "")
{
	$array = mysql_fetch_array(mysql_query("SELECT id, good from cart WHERE id='$_POST[id]'"));
	if($array[id] != "")
	{
		$good = mysql_fetch_array(mysql_query("SELECT new_prise FROM goods WHERE id='$array[good]'"));
		$sum = $_POST['count'] * $good[new_prise];
		mysql_query("UPDATE cart SET count='$_POST[count]', sum='$sum' WHERE id='$array[id]'");
		echo $sum;
	}
}




elseif($_POST[type] == "pay_order" AND $_POST[id] != "" AND $_SESSION['user_type'] == 3)
{
	$status = $cart->paying_order($_POST[id]);
	echo "<b>$status</b>";
}
elseif($_POST[type] == "delete_order" AND $_POST[id] != "" AND $_SESSION['user_type'] == 3)
{
	$status = $cart->delete_order($_POST[id]);
	echo "Удалено";
}
*/