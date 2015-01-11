<?
	if($_GET[eng_title] != "")
	{
		$breadcrumbs->create_breadcrumbs("articles", $_GET[eng_title]);
		echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>";
	}
	else
	{
		$breadcrumbs->create_breadcrumbs("articles", "");
		echo "<div class='breadcrumbs'>".$breadcrumbs->breadcrumbs."</div>";
	}
?>

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
</aside>


<div class="left_colum">
<?
	if($_GET[eng_title] != "")
	{
		echo $articles->one_article;
	}
	else
	{
		echo "<h1>Статьи</h1>
		<p><img src='/design/img/stst.jpg'></p>
		<div>Статьи о работе с гипсокартоном</div>";
		echo $articles->articles_list;
	}
?>
</div>