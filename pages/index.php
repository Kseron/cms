<div class="index_page">
<div class="top_box">
	<?
		echo $functions->create_content("index_top");
	?>
</div>

<div class="silver_line">
	<?
		echo $functions->create_content("index_silver_line");
	?>
	
</div>

<?
	echo $functions->create_content("index_service");
?>

<div>

<aside class="right_colum">
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
	NHEKZKZ
	<div class="mini_block">
	<div class="title">Стройматериалы</div>
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
</aside>

<div class="left_colum">
<?
	echo $functions->create_content("index_text");
?>


<h3 class="module-title">Нужные материалы для работы</h3>
<?
	echo $products->index_list_product;
?>

<div class="section">
	<div class="nav_container">
	<ul class="tabs index_style">
		<li class="current">Видео и статьи</li>
		<li>Техническая характеристика конструкций</li>
	</ul>
	</div>
	
	<div class="box visible" style="overflow:hidden;">
		<div class="video_materials">
			<h3>Видео материалы</h3>
			<? echo $video->index_video; ?>
		</div>

		<div class="articles">
			<h3>Статьи по теме ремонта</h3>
			<? echo $articles->index_articles; ?>
		</div>
	<?
		echo $functions->create_content("index_video_and_articles");
	?>
	</div>
	<div class="box">
	<?
		echo $functions->create_content("this_must_read");
	?>
	</div>
</div>

</div>
</div>


<div class="index_last_works">
	<h3 class="module-title">Наши последние работы</h3>
	<? echo "kabaka";
		echo $portfolio->index_last_works;
	?>
</div>

<div class="index_all_works">
	<div class="text">	
	В каталоге множество выполненных объектов и заказов. Мы поможет сделать качественный ремонт квартиры или коттеджа. Монтажные работы по ГКЛ выполняем на высоком профессиональном уровне и даже поможем подобрать тот или иной дизайн будущих потолков.
	</div>
	<div class="yellow_button">
		<a href="/gallery.html">Весь каталог наших работ</a>
	</div>
</div>