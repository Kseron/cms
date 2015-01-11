<?
if($pages->page_from_base != "")
{
	$breadcrumbs->create_breadcrumbs("page", $pages->page_from_base[title]);
	echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>";
?>
	<aside class='right_colum'>
		<div class='mini_block'>
		<div class='title'>
		Наши услуги
		</div>
		<div class='content'>
			<?
			echo $functions->create_content("right_services");
			?>
		</div>
		</div>
	
		<div class="mini_block">
		<div class="title">Каталог продукции</div>
		<div class="content">
			<ul>
				<?
					$query = mysql_query("SELECT id FROM category WHERE parent='0'");
					while($array = mysql_fetch_array($query))
					{
						$child_query = mysql_query("SELECT * FROM category WHERE parent='$array[id]'");
						while($child = mysql_fetch_array($child_query))
						{
							//echo "<li><a href='/catalog/$child[id]/$child[eng_title].html'>$child[title]</a></li>";
							echo "<a href='/catalog/$child[id]/$child[eng_title].html'><li><span>$child[title]</span></li></a>";
						}
					}
				?>
			</ul>
		</div>	
		</div>
	
	<div class="right_rab_callback">
		<div class="title">Хочу задать<br /> вопрос мастеру!</div>
		<div class="form">
			<form action="" method="post">
			<input type="text" name="name" placeholder="Ваше имя" /><br />
			<input type="text" name="phone" placeholder="Ваш телефон" />
			<br />
			<div class="mini_popup" id="popup_callback">Вся информация переданная вами не коем образом не попадет в руки третьим лицам</div>
			<a href="#" class="show_mini_popup" popup="popup_callback">Политика конфиденциальности</a>
			<div class="send"><input type="submit" name="callback_send" value="Отправить" /></div>
			</form>
		</div>
	</div>
	
	</aside>
	
	
	<?
	echo "<div class='left_colum page_content'>";
	if($_SESSION['user_type'] == 3)
	{
		echo "<div class='edit_block'><a href='/ajax/index.php?script=pages&type=edit&id=".$pages->page_from_base['id'].".html' class='fancybox' data-fancybox-type='iframe'><span class='fa fa-pencil-square-o'></span></a></div>";
	}
	echo $pages->page_from_base[text];
	echo "</div>";
	/*
	if($pages->page_from_base[special_design] != 1)
	{
	include("design/special_footer.php");
	}
	*/
	
}
else
{
	echo "<div style='margin:0 auto;'><h1>Ошибка 404. Страница не найдена</h1></div>		<div style='margin:0 auto;'>Этой страницы или вообще не существовало, или же она была недавно удалена. Попробуйте поискать что-то другое</div>";
}
?>