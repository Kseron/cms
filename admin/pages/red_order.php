<div class="breadcrumbs"><a href="/admin/">Главная</a> » <a href="orders.html">Заказы</a> » <a href="order/<? echo $cart->this_order[id]; ?>.html">Заказ №<? echo $cart->this_order[id]; ?></a></div>
<?
if($_POST[edith_order_submit] != "")
{
	echo $cart->error_confirm;
	echo $cart->order_confirm_result;
}
?>
<form action="" method="post">
<div style="text-align:center;">
<?
	//echo $cart->cart_list;
?>
</div>

<div class="add_order">
<h1>Редактирование заказа</h1>

	<div class="block">
		<span class="number">1</span> *Покупатель: <input type="radio" name="buyer" value="private"<? if($_POST[buyer] == "private" OR $cart->this_order[buyer] == "private") { echo " checked"; } ?>>частное лицо <input type="radio" name="buyer" value="organization"<? if($_POST[buyer] == "organization" OR $cart->this_order[buyer] == "organization") { echo " checked"; } ?>>организация
	</div>
	<div class="block">
		<span class="number">2</span> *Способ получения товара: <input type="radio" name="get" value="shipping"<? if($_POST[get] == "shipping" OR $cart->this_order[get] == "shipping") { echo " checked"; } ?>>доставка <input type="radio" name="get" value="pickup"<? if($_POST[get] == "pickup" OR $cart->this_order[get] == "pickup") { echo " checked"; } ?>>самовывоз
	</div>
	<div class="block">
		<span class="number">3</span> Желательное время доставки: <input type="text" name="shipping_from" size="19" maxlength="19" placeholder="Начало доставки" value="<? if($_POST[shipping_from] != "") { echo $_POST[shipping_from]; } else { echo $cart->this_order["shipping_from"]; }?>">
		<input type="text" name="shipping_to" size="19" maxlength="19" placeholder="Конец доставки" value="<? if($_POST[shipping_to] != "") { echo $_POST[shipping_to]; } else { echo $cart->this_order["shipping_to"]; }?>">
	</div>
	<div class="block">
		<p><span class="number">4</span> *Адрес доставки:</p>
		<table>
		<tr><td>*Город:</td> <td colspan="2"><input type="text" name="city" value="<? if($_POST[city] != "") { echo $_POST[city]; } else { echo $cart->this_order["city"]; }?>"></td><td></td></tr>
		<tr><td>*Улица:</td> <td colspan="3"><input type="text" name="street" size="30" value="<? if($_POST[street] != "") { echo $_POST[street]; } else { echo $cart->this_order["street"]; }?>"></td></tr>
		<tr><td>*Дом:</td> <td><input type="text" name="house" size="6" maxlength="4" value="<? if($_POST[house] != "") { echo $_POST[house]; } else { echo $cart->this_order["house"]; }?>"></td> <td>Корпус: <input type="text" name="building" size="6" maxlength="4" value="<? if($_POST[building] != "") { echo $_POST[building]; } else { echo $cart->this_order["building"]; }?>"></td> <td>Строение: <input type="text" name="structure" size="6" maxlength="4" value="<? if($_POST[structure] != "") { echo $_POST[structure]; } else { echo $cart->this_order["structure"]; }?>"></td></tr>
		<tr><td>Квартира:</td> <td><input type="text" name="flat" size="6" maxlength="4" value="<? if($_POST[flat] != "") { echo $_POST[flat]; } else { echo $cart->this_order["flat"]; }?>"></td> <td>Подъезд: <input type="text" name="entrance" size="6" maxlength="4" value="<? if($_POST[entrance] != "") { echo $_POST[entrance]; } else { echo $cart->this_order["entrance"]; }?>"></td> <td>Этаж: <input type="text" name="storey" size="6" maxlength="4" value="<? if($_POST[storey] != "") { echo $_POST[storey]; } else { echo $cart->this_order["storey"]; }?>"></td></tr>
		</table>
	</div>
	<div class="block">
		<span class="number">5</span> Контактная информация:
		<table>
		<tr><td>*Имя:</td> <td><input type="text" name="name" value='<? if($_POST[name] != "") { echo $_POST[name]; } else { echo $cart->this_order["name"]; }?>'></td></tr>
		<tr><td>e-mail:</td> <td><input type="text" name="email" value<? if($_POST[email] != "") { echo $_POST[email]; } else { echo $cart->this_order["email"]; }?>td></tr>
		<tr><td>*Мобильный:</td> <td>+7<input type="text" name="mobile_phone" value="<? if($_POST[mobile_phone] != "") { echo $_POST[mobile_phone]; } else { echo $cart->this_order["mobile_phone"]; }?>"></td></tr>
		<tr><td>Дополнительный:</td> <td>+7<input type="text" name="additional_phone" value="<? if($_POST[additional_phone] != "") { echo $_POST[additional_phone]; } else { echo $cart->this_order["additional_phone"]; }?>"></td></tr>
		</table>
	</div>
	<div class="block">
		<span class="number">6</span> Дополнительная информация:
		<br />
		<textarea name="additional_info"><? if($_POST[additional_info] != "") { echo $_POST[additional_info]; } else { echo $cart->this_order["additional_info"]; }?></textarea>
	</div>
	<input type="submit" name="edith_order_submit" class="blue_button" value="Редактировать">
</form>
</div>