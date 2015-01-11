<?
	echo $filters->add_result;
/*	
	if(isset($_POST[submit]))
	{
		//echo var_dump($_POST[element_title]);
		//echo var_dump($_POST[eng_element_title]);
		for($i = 0; $i < count($_POST[element_title]); $i++)
		{
			if($_POST[element_title][$i] != "" AND $_POST[eng_element_title][$i] != "")
			{
				echo "<p>".$_POST[element_title][$i]." - ".$_POST[eng_element_title][$i]."</p>";
			}
		}
		
		for($i = 0; $i < count($_POST[category]); $i++)
		{
			if($_POST[category][$i] != "")
			{
				echo "<p>".$_POST[category][$i]."</p>";
			}
		}
	}
*/
?>

<h1>Добавить фильтр</h1>
<form action='' method='post' enctype='multipart/form-data' class="add_filter">
	<table class="form_table">
	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50' value='<? echo $_POST[title]; ?>'></td></tr>
	<tr><td class='left_td'>Транскрипция</td> <td><input type='text' name='eng_title' size='50' value='<? echo $_POST[eng_title]; ?>'></td></tr>
	<tr><td class='left_td'>Статус</td> <td><select name='vision'>
	<option value='1'>Видим</option>
	<option value='0'>Невидим</option>
	</select>
	</td></tr>
	<tr><td class='left_td' valign="top"><b>Значения</b></td>
		<td><p> Значение:<input type="text" name="element_title[]"> Транскрипция:<input type="text" name="eng_element_title[]"></p>
		<?
			for($i = 0; $i < count($_POST[element_title]); $i++)
			{
				echo '<p> Значение:<input type="text" name="element_title[]" value='.$_POST[element_title][$i].'> Транскрипция:<input type="text" name="eng_element_title[]" value='.$_POST[eng_element_title][$i].'></p>';
			}
		?>
		<a href="#" class="add_filter_element">+ значение</a>
	</td></tr>
	
	<tr><td class='left_td' valign="top"><b>Категории к которым принадлежит</b></td>
		<td><p> <select name='category[]'><? echo $catalog->select_category; ?></select></p>
		<a href="#" class="add_filter_category">+ значение</a>
	</td></tr>
	
	<tr><td class='left_td'></td> <td><input type='submit' name='submit' value='Добавить'></td></tr>
</table>
</form>

