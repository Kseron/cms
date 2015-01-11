<h1>Редактировать товар</h1>
<div><a href="/product/<? echo $products->this_product[id]."/".$products->this_product[eng_title]; ?>.html"><? echo $products->this_product[title]; ?></a></div>

<?
	echo $products->red_result;
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
	<table class="form_table" style="width:100%;">
	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50' value='<? if($_POST["title"] != "") { echo $_POST["title"];} else { echo $products->this_product["title"]; } ?>'></td></tr>
	<tr><td class='left_td'>Категория</td> <td><select name='category'>
	<? if($_POST["category"] != "") { $selected = $_POST["category"]; } else { $selected = $products->this_product["category"]; } 
	$catalog->create_select_category($selected); echo $catalog->select_category; ?>
	</select></td></tr>
	<tr><td class='left_td'>Мини-описание</td> <td><textarea name="mini_description" style="width:100%; height:100px;"><? if($_POST["mini_description"] != "") { echo $_POST["mini_description"];} else { echo $products->this_product["mini_description"]; } ?></textarea>
	<tr><td class='left_td'>Описание</td> <td><textarea id="description" name="description"><? if($_POST["description"] != "") { echo $_POST["description"];} else { echo $products->this_product["description"]; } ?></textarea>
	<script type="text/javascript">
		CKEDITOR.replace( 'description', {toolbar:'Normal'} );
	</script>
	</td></tr>
	<tr><td class='left_td'>Харатекристики<br />
	(Название:значение)</td> <td><textarea name="stats" style="width:100%; height:150px;"><? if($_POST["stats"] != "") { echo $_POST["stats"];} else { echo $products->this_product["stats"]; } ?></textarea>
	<tr><td class='left_td'>Время добавления</td> <td><input type='text' name='datetime' size='20' value="<? if($_POST["datetime"] != "") { echo $_POST["datetime"];} else { echo $products->this_product["datetime"]; } ?>"></td></tr>
	<tr><td class='left_td'>Изображение</td> <td><input type='file' name='image'> <input type="checkbox" name="delete_image" value="1"> удалить</td></tr>
	<tr><td class='left_td'>Статус</td> <td><select name='vision'>
	<option value='1' <? if($products->this_product['vision'] == "1") {echo " selected";}?>>Видим</option>
	<option value='0' <? if($products->this_product['vision'] == "0") {echo " selected";}?>>Невидим</option>
	</select>
	</td></tr>
	</table>
</div>

<div class="box">
	<h2>Прикрепленные товары</h2>
	<table class="form_table">
	<?
	if($_POST["product_code"] != "")
	{
		for($i=0; $i<=count($_POST["product_code"]); $i++)
		{
			if($_POST["product_code"][$i] != "")
			{
			?>
			<tr><td class='left_td'>Код: <input type='text' name='product_code[]' size='7' value='<? echo $_POST["product_code"][$i]; ?>'></td>
			<td class='left_td'>Название: <input type='text' name='product_title[]' size='50' value='<? echo $_POST["product_title"][$i]; ?>'></td>
			<td class='left_td'>Цена: <input type='text' name='product_prise[]' size='7' value='<? echo $_POST["product_prise"][$i]; ?>'> <input type='hidden' name='product_id[]' value='<? echo $_POST["product_id"][$i]; ?>'></td>
			<?
			}
		}
	}
	else
	{
		$query = mysql_query("SELECT * FROM products WHERE product_type='".$products->this_product[id]."'");
		while($array = mysql_fetch_array($query))
		{
			?>
			<tr><td class='left_td'>Код: <input type='text' name='product_code[]' size='7' value='<? echo $array["code"]; ?>'></td>
			<td class='left_td'>Название: <input type='text' name='product_title[]' size='50' value='<? echo $array["title"]; ?>'></td>
			<td class='left_td'>Цена: <input type='text' name='product_prise[]' size='7' value='<? echo $array["prise"]; ?>'> <input type='hidden' name='product_id[]' value='<? echo $array["id"]; ?>'></td>
			<?
		}
	}
	?>
	<tr><td class='left_td'>Код: <input type='text' name='product_code[]' size='7'></td>
		<td class='left_td'>Название: <input type='text' name='product_title[]' size='50'></td>
		<td class='left_td'>Цена: <input type='text' name='product_prise[]' size='7'></td>
	</tr>
	<tr><td colspan="3"><a class="add_new_product blue_pseudobutton" href='#'>+ Добавить еще</a></td>
	</table>
</div>

<div class="box">
	<h2>Похожие товары</h2>
	<div>
	<?
	if($_POST["related_product_type"] != "")
	{
		for($i=0; $i<=count($_POST["related_product_type"]); $i++)
		{
			if($_POST["related_product_type"][$i] != "")
			{
			?>
			<div>
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
			<div>
			<div>Товар: <input type='text' class='related_product_type' name='related_product_type[]' value='<? echo $array["product_type2"]." > ".$product[title]; ?>' autocomplete='off'></div>
			</div>
			<?
		}
	}
	?>
	<div>
	<div>Товар: <input type='text' class='related_product_type' name='related_product_type[]' value='' autocomplete='off'></div>
	</div>
	<div><td colspan="3"><a class="add_new_related_product_type blue_pseudobutton" href='#'>+ Добавить еще</a></div>
	</div>
</div>

<div class="box">
	<h2>Фильтры</h2>
	<div>
	<?
	/*
	if($_POST["filter_product_type"] != "")
	{
		for($i=0; $i<=count($_POST["filter_product_type"]); $i++)
		{
			if($_POST["filter_product_type"][$i] != "")
			{
			?>
			<div>
			<p>Товар: <input type='text' class='filter_product_type' name='filter_product_type[]' value='<? echo $_POST["filter_product_type"][$i]; ?>' autocomplete='off'></p>
			</div>
			<?
			}
		}
	}
	*/
		$query = mysql_query("SELECT * FROM filter_products WHERE product_type='".$products->this_product[id]."'");
		while($array = mysql_fetch_array($query))
		{
			$element = mysql_fetch_array(mysql_query("SELECT * FROM filter_elements WHERE id='".$array["element"]."'"));
			$filter = mysql_fetch_array(mysql_query("SELECT * FROM filter WHERE id='".$array["filter"]."'"));
			?>
			<div>
			<p>Фильтр: <input type='text' class='filter_product_type' name='filter_product_type[]' value='<? echo $filter["title"]; ?>' autocomplete='off' disabled> значение: <input type='text' class='filter_element_product_type' name='filter_element_product_type[]' value='<? echo $element[title]; ?>' autocomplete='off' disabled> <a href="#" class="fast_del_filter_product fast_delete" style="float:right;" filter_product_id="<? echo $array[id]; ?>" title="Удалить"></a></p>
			</div>
			<?
		}

	?>
	<div>
	<p>Фильтр: <input type='text' class='filter_product_type' name='filter_product_type[]' value='' autocomplete='off'> <select name='filter_product_type_select[]'><? echo $products->filter_select; ?></select> значение: <input type='text' class='filter_element_product_type' name='filter_element_product_type[]' value='' autocomplete='off'> <select name='filter_element_product_type_select[]'><? echo $products->filter_element_select; ?></select></p>
	</div>
	<p><td colspan="3"><a class="add_filter_product_type blue_pseudobutton" href='#'>+ Добавить еще</a></p>
	</div>
</div>
<br />
<input type='submit' name='submit' class="blue_button" value='Редактировать'>
</form>

</div>