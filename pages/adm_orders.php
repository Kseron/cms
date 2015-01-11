
<?
if($_SESSION['user_type'] == 3)
{
	echo "<h1>Активные заказы</h2>";

	echo $cart->str_orders;
	echo $cart->orders_list;
	echo $cart->str_orders;
}
