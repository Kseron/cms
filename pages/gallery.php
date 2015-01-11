<?
	if($_GET[eng_title] != "")
	{
		$breadcrumbs->create_breadcrumbs("porfolio", $_GET[eng_title]);
		echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>
		
	<div  style='float:right; width:230px;'>
	<div class='right_rab_callback'>
		<div class='title'>Хочу задать<br /> вопрос мастеру!</div>
		<div class='form'>
			<form action='' method='post'>
			<input type='text' name='name' placeholder='Ваше имя' /><br />
			<input type='text' name='phone' placeholder='Ваш телефон' />
			<br />
			<div class='mini_popup' id='popup_callback'>Вся информация переданная вами не коем образом не попадет в руки третьим лицам</div>
			<a href='#' class='show_mini_popup' popup='popup_callback'>Политика конфиденциальности</a>
			<div class='send'><input type='submit' name='callback_send' value='Отправить' /></div>
			</form>
		</div>
	</div>";
	echo $functions->create_content("right_special_design");
	echo "</div>";
	

		
		echo $portfolio->one_portfolio;
		?>
		
		<div class="all_catalog">
		<div class="katalog">
		<a href="/gallery.html">Весь каталог наших работ</a>
		<h2>Материал для работ</h2>
		</div>
		</div>
		
		<?
		echo $portfolio->product_carousel;
	}
	else
	{
		$breadcrumbs->create_breadcrumbs("porfolio", "");
		echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>";
		
		echo "<h1>Проекты выполненые нашей компанией</h1>";
		
		echo $portfolio->portfolio_list;
	}
?>