<?

if($_POST[type] == "delete_filter_product" AND $_POST[id] != "")
{
	$array = mysql_fetch_array(mysql_query("SELECT * FROM filter_products WHERE id='$_POST[id]'"));
	$query = mysql_query("DELETE FROM filter_products WHERE id='$_POST[id]'");
	if($query)
	{
		echo "Удалено";
		/* Проверяем есть ли неприкаяные записи относящиеся к этому фильтру и удаляем если таковы есть */
		
		$check = mysql_query("SELECT id FROM filter_products WHERE filter='$array[filter]' AND element='$array[element]'");
		if(mysql_num_rows($check) < 1)
		{
			mysql_query("DELETE FROM filter_elements WHERE id='$array[element]'");
		}
		$check = mysql_query("SELECT id FROM filter_products WHERE filter='$array[filter]'");
		if(mysql_num_rows($check) < 1)
		{
			mysql_query("DELETE FROM filter_cats WHERE filter='$array[filter]'");
			mysql_query("DELETE FROM filter_elements WHERE filter='$array[filter]'");
			mysql_query("DELETE FROM filter WHERE id='$array[filter]'");
		}
		
	}
}