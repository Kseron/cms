<?
echo $menu->add_result;
?>
<h1>Редактировать пункт меню</h1>
<form action='' method='post'>
<table class="form_table">
	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50' value='<? if($_POST["title"] != "") { echo $_POST["title"];} else { echo $menu->this_menu["title"]; } ?>'></td></tr>	<tr><td class='left_td'>URL</td> <td><input type='text' name='url' size='50' value='<? if($_POST["url"] != "") { echo $_POST["url"];} else { echo $menu->this_menu["url"]; } ?>'></td></tr>
	<tr><td class='left_td'>Родительский пункт</td> <td><? echo $menu->select_menu; ?></td></tr>
	<tr><td class='left_td'>Позиция</td> <td><input type='text' name='position' size='50' value='<? if($_POST["position"] != "") { echo $_POST["position"];} else { echo $menu->this_menu["position"]; } ?>'></td></tr>
	<tr><td class='left_td'>Статус</td> <td>
	<select name='vision'>
		<option value='1' <? if($menu->this_menu['vision'] == "1") {echo " selected";}?>>Видим</option>
		<option value='0' <? if($menu->this_menu['vision'] == "0") {echo " selected";}?>>Невидим</option>
	</select>
	</td></tr>
	<tr><td class='left_td'></td> <td><input type='submit' name='submit' value='Редактировать'></td></tr>
</table>
</form>