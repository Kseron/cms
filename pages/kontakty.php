<div class="contacts">
<h1>Наши контакты</h1>

<?
	echo $callback->send_letter;
?>
<div class="left">
	<div class="phone"><? echo $settings->shop_phone_for_header[0]; ?><span><? echo $settings->shop_phone_for_header[1]; ?></span></div>
	<div class="mail"><b>info</b>@gipsa.ru</div>
</div>

<div class="right">
	<form action="" method="post" class="contact_form">
		<fieldset>
			<legend>Отправить сообщение. Все поля, отмеченные звездочкой, являются обязательными.</legend>
			<div class="control-group">
				<div><label for="name" title="">Имя<span class="star">&nbsp;*</span></label></div>
				<div><input required="required" aria-required="true" name="name" id="name" value=""type="text"></div>
			</div>
			<div class="control-group">
				<div><label for="email" title="">E-mail<span class="star">&nbsp;*</span></label></div>
				<div><input required="required" aria-required="true" name="email" id="email" value="" type="email"></div>
			</div>
			<div class="control-group">
				<div ><label for="theme" title="">Тема<span class="star">&nbsp;*</span></label></div>
				<div><input required="required" aria-required="true" name="theme" id="theme" value="" type="text"></div>
			</div>
			<div class="control-group">
				<div><label for="contact_message" title="">Сообщение<span class="star">&nbsp;*</span></label></div>
				<div><textarea required="required" aria-required="true" name="contact_message" id="contact_message" cols="50" rows="10" class="required"></textarea></div>
			</div>
			<div><input class="contact_submit" type="submit" value="Отправить сообщение" /></div>
		</fieldset>
	</form>
</div>

</div>