<h1>Добавить товар</h1>

<?
	echo $products->add_result;
?>

<form action='' method='post' enctype='multipart/form-data'>
	<table class="form_table">
	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50' value='<? echo $_POST["title"]; ?>'></td></tr>
	<!--<tr><td class='left_td'>Трансліт</td> <td><input type='text' name='eng_title' size='50' value='<? echo $_POST["eng_title"]; ?>'></td></tr>-->
	<tr><td class='left_td'>Категория</td> <td><select name='category'><? echo $catalog->select_category; ?></select></td></tr>
	<tr><td class='left_td'>Категория 2</td> <td><select name='category2'><? echo $catalog->select_category; ?></select></td></tr>
	<tr><td class='left_td'>Категория 3</td> <td><select name='category3'><? echo $catalog->select_category; ?></select></td></tr>
	<tr><td class='left_td'>Описание</td> <td><textarea name="description"><? echo $_POST["description"]; ?></textarea>
	<script type='text/javascript'>//<![CDATA[
    CKEDITOR.replace('description', {toolbar:'Normal'});
    //]]></script>
	</td></tr>
	<!--
	<tr><td class='left_td'>Характеристики</td> <td><textarea name="features"><? echo $_POST["features"]; ?></textarea>
	<script type='text/javascript'>//<![CDATA[
    CKEDITOR.replace('features');
    //]]></script>
	</td></tr>	
	<tr><td class='left_td'>Meta title</td> <td><input type='text' name='meta_title' style="width:100%;" maxlength="255" value='<? echo $_POST["meta_title"]; ?>'></td></tr>
	<tr><td class='left_td'>Mini description</td> <td><textarea name='mini_descr' style="width:100%;"><? echo $_POST["mini_descr"]; ?></textarea></td></tr>
	<tr><td class='left_td'>Ключевые слова</td> <td><input type='text' name='keywords' size='100' value='<? echo $_POST["keywords"]; ?>'></td></tr>
	<tr><td class='left_td'>Старая цена</td> <td><input type='text' name='old_prise' size='10' value='<? echo $_POST["old_prise"]; ?>'></td></tr>
	-->
	<tr><td class='left_td'>Цена</td> <td><input type='text' name='new_prise' size='10' value='<? echo $_POST["new_prise"]; ?>'></td></tr>
	<tr><td class='left_td'>Время додавания</td> <td><input type='text' name='datetime' size='20' value="<? echo Date_time::get_date("datetime"); ?>"></td></tr>
	<tr><td class='left_td'>Изображение</td> <td><input type='file' name='image'></td></tr>
	<!--<tr><td class='left_td'>Рекомендуем!</td> <td>&nbsp;<input type='checkbox' name='recommend' value='1'></td></tr>
	<tr><td class='left_td'>В наличии</td> <td><select name='have'>
	<option value='Есть в наличии'>Есть</option>
	<option value='Нет в наличии'>Нет</option>
	</select>
	</td></tr>
	-->
	<tr><td class='left_td'>Статус</td> <td><select name='vision'>
	<option value='1'>Видим</option>
	<option value='0'>невидим</option>
	</select>
	</td></tr>
	<tr><td class='left_td'></td> <td><input type='submit' name='submit' value='Добавить'></td></tr>
	</table>
</form>