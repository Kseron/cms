<div class='breadcrumbs'><a href="/">Главная</a> > Корзина</div>
<?
if($_POST[order_submit] != "")
{
	echo $cart->error_confirm;
	echo $cart->order_confirm_result;
}
?>
<form action="" method="post">
<div style="text-align:center;">
<?
	echo $cart->cart_list;
?>
</div>

<?
if(!preg_match("/необходимо авторизироваться/i", $cart->cart_list))
{
?>
<div class="add_order">
<h1>Оформление заказа</h1>

	<div class="block">
		<span class="number">1</span> *Покупатель: <input type="radio" name="buyer" value="private"<? if($_POST[buyer] == "private") { echo " checked"; } ?> required>частное лицо <input type="radio" name="buyer" value="organization"<? if($_POST[buyer] == "organization") { echo " checked"; } ?> required>организация
	</div>
	<div class="block">
		<span class="number">2</span> *Способ получения товара: <input type="radio" name="get" value="shipping"<? if($_POST[get] == "shipping") { echo " checked"; } ?> required>доставка <input type="radio" name="get" value="pickup"<? if($_POST[get] == "pickup") { echo " checked"; } ?> required>самовывоз
	</div>
	<div class="block">
		<span class="number">3</span> Желательное время доставки: <input type="text" name="day" size="4" maxlength="2" placeholder="День" value="<? echo $_POST[day];?>"> <input type="text" name="mounth" size="5" maxlength="2" placeholder="Месяц" value="<? echo $_POST[mounth];?>">
		<select name="year">
		<? echo $datetime->select_next_years; ?>
		</select>
		&nbsp;&nbsp;&nbsp;с <select name="from_time">
			<? echo $datetime->select_hours2; ?>
		</select>
		до <select name="to_time">
			<? echo $datetime->select_hours2; ?>
		</select>
	</div>
	<div class="block">
		<p><span class="number">4</span> *Адрес доставки:</p>
		<table>
		<tr><td>*Город:</td> <td colspan="2"><input type="text" name="city" value="<? echo $_POST[city];?>" required></td><td></td></tr>
		<tr><td>*Улица:</td> <td colspan="3"><input type="text" name="street" size="30" value="<? echo $_POST[street];?>" required></td></tr>
		<tr><td>*Дом:</td> <td><input type="text" name="house" size="6" maxlength="4" value="<? echo $_POST[house];?>" required></td> <td>Корпус: <input type="text" name="building" size="6" maxlength="4" value="<? echo $_POST['building'];?>"></td> <td>Строение: <input type="text" name="structure" size="6" maxlength="4" value="<? echo $_POST[structure];?>"></td></tr>
		<tr><td>Квартира:</td> <td><input type="text" name="flat" size="6" maxlength="4" value="<? echo $_POST[flat];?>"></td> <td>Подъезд: <input type="text" name="entrance" size="6" maxlength="4" value="<? echo $_POST[entrance];?>"></td> <td>Этаж: <input type="text" name="storey" size="6" maxlength="4" value="<? echo $_POST['storey'];?>"></td></tr>
		</table>
	</div>
	<div class="block">
		<span class="number">5</span> Контактная информация:
		<table>
		<tr><td>*Имя:</td> <td><input type="text" name="name" <? if($users->login_info[id] != "") { echo "value='".$users->login_info[name]." ".$users->login_info[surname]."'"; } ?> required></td></tr>
		<tr><td>e-mail:</td> <td><input type="text" name="email"<? if($users->login_info[id] != "") { echo "value='".$users->login_info[mail]."'"; } ?>></td></tr>
		<tr><td>*Мобильный:</td> <td>+7(<input type="text" name="mobile_operator" size="3" maxlength="3">)-<input type="text" name="mobile_phone" required></td></tr>
		<tr><td>Дополнительный:</td> <td>+7(<input type="text" name="additional_operator" size="3" maxlength="3">)-<input type="text" name="additional_phone"></td></tr>
		</table>
	</div>
	<div class="block">
		<span class="number">6</span> Дополнительная информация:
		<br />
		<textarea name="additional_info"><? echo $_POST[additional_info];?></textarea>
	</div>
	<input type="submit" name="order_submit" class="blue_button" value="Оформить заказ">
</form>
</div>
<?
}