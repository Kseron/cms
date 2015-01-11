<h1>Добавить товар</h1>

<div class='breadcrumbs'><a href="/admin/">Главная</a> > <a href="/admin/product_list.html">Товары</a> > Добавить товар</div>

<?
	echo $products->add_result;
?>

<div class="section">
	<ul class="tabs">
		<li class="current">Основное</li>
		<li>Товары</li>
		<li>Похожие товары</li>
		<li>Фильтры</li>
	</ul>
<form action='' method='post' enctype='multipart/form-data'>
<div class="box visible">
	<h2>Тип товара</h2>
	<table class="form_table">
	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50' value='<? echo $_POST["title"]; ?>'></td></tr>
	<tr><td class='left_td'>Категория</td> <td><select name='category'><? echo $catalog->select_category; ?></select></td></tr>
	<tr><td class='left_td'>Мини-описание</td> <td><textarea name="mini_description" style="width:100%; height:100px;"><? echo $_POST["mini_description"]; ?></textarea>
	<tr><td class='left_td'>Описание</td> <td><textarea id="description" name="description"><? echo $_POST["description"]; ?></textarea>
	<script type="text/javascript">
		CKEDITOR.replace( 'description', {toolbar:'Normal'} );
	</script>
	</td></tr>
	<tr><td class='left_td'>Харатекристики<br />
	(Название:значение)</td> <td><textarea name="stats" style="width:100%; height:150px;"><? echo $_POST["stats"]; ?></textarea>	
	<tr><td class='left_td'>Время добавления</td> <td><input type='text' name='datetime' size='20' value="<? echo Date_time::get_date("datetime"); ?>"></td></tr>
	<tr><td class='left_td'>Изображение</td> <td><input type='file' name='image'></td></tr>
	<tr><td class='left_td'>Статус</td> <td><select name='vision'>
	<option value='1'>Видим</option>
	<option value='0'>невидим</option>
	</select>
	</td></tr>
	</table>
</div>

<div class="box">
	<h2>Прикрепить товары</h2>
	<table class="form_table" style="width:auto;">
	<?
	for($i=0; $i<=count($_POST["product_code"]); $i++)
	{
		if($_POST["product_code"][$i] != "")
		{
		?>
		<tr><td>Код: <input type='text' name='product_code[]' size='7' value='<? echo $_POST["product_code"][$i]; ?>'></td>
		<td>Название: <input type='text' name='product_title[]' size='100' value='<? echo $_POST["product_title"][$i]; ?>'></td>
		<td>Цена: <input type='text' name='product_prise[]' size='7' value='<? echo $_POST["product_prise"][$i]; ?>'></td>
		<?
		}
	}
	?>
	<tr><td>Код: <input type='text' name='product_code[]' size='7' value='<? echo $_POST["product_code"][$i]; ?>'></td>
		<td>Название: <input type='text' name='product_title[]' size='100' value='<? echo $_POST["product_title"][$i]; ?>'></td>
		<td>Цена: <input type='text' name='product_prise[]' size='7' value='<? echo $_POST["product_prise"][$i]; ?>'></td>
	</tr>
	<tr><td colspan="3"><a class="add_new_product blue_pseudobutton" href='#'>+ Добавить еще</a></td>
	</table>
</div>

<div class="box">
	<h2>Похожие товары</h2>
	<?
	if($_POST["related_product_type"] != "")
	{
		for($i=0; $i<=count($_POST["related_product_type"]); $i++)
		{
			if($_POST["related_product_type"][$i] != "")
			{
			?>
			<div class="related_product_div">
			<div>Товар: <input type='text' class='related_product_type' name='related_product_type[]' value='<? echo $_POST["related_product_type"][$i]; ?>' autocomplete='off'></div>
			</div>
			<?
			}
		}
	}
	else
	{
		$query = mysql_query("SELECT * FROM related_products WHERE product_type1='".$products->this_product[id]."'");
		while($array = mysql_fetch_array($query))
		{
			$product = mysql_fetch_array(mysql_query("SELECT title FROM products WHERE id='".$array["product_type2"]."'"));
			?>
			<div class="related_product_div">
			<div>Товар: <input type='text' class='related_product_type' name='related_product_type[]' value='<? echo $array["product_type2"]." > ".$product[title]; ?>' autocomplete='off'></div>
			</div>
			<?
		}
	}
	?>
	<div class="related_product_div">
	<div>Товар: <input type='text' class='related_product_type' name='related_product_type[]' value='' autocomplete='off'></div>
	</div>
	<div class="add_new_button"><a class="add_new_related_product_type blue_pseudobutton" href='#'>+ Добавить еще</a></div>
</div>

<div class="box">
	<h2>Фильтры</h2>
	<div>
	<?
	if($_POST["filter_product_type"] != "")
	{
		for($i=0; $i<=count($_POST["filter_product_type"]); $i++)
		{
			if($_POST["filter_product_type"][$i] != "")
			{
			?>
			<div>
			<p>Фильтр: <input type='text' class='filter_product_type' name='filter_product_type[]' value='<? echo $_POST["filter_product_type"][$i]; ?>' autocomplete='off'> значение: <input type='text' class='filter_element_product_type' name='filter_element_product_type[]' value='<? echo $_POST["filter_element_product_type"][$i]; ?>' autocomplete='off'></p>
			</div>
			<?
			}
		}
	}
	?>
	<div>
	<p>Фильтр: <input type='text' class='filter_product_type' name='filter_product_type[]' value='' autocomplete='off'> значение: <input type='text' class='filter_element_product_type' name='filter_element_product_type[]' value='' autocomplete='off'>
	<br />
	<select name='filter_product_type[]'>
	<?
		echo $products->filter_select;
	?>
	</select>
	<select name='filter_element_product_type[]'>
	<? echo $products->filter_elements_select; ?>
	</select>
	</p>
	</div>
	<div class="add_new_button"><a class="add_filter_product_type blue_pseudobutton" href='#'>+ Добавить еще</a></div>
	</div>
</div>

<input type='submit' name='submit' value='Добавить'>
</form>

</div>