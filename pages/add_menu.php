﻿<?	echo $menu->add_result;?><h1>Добавить пункт меню</h1><form action='' method='post'>	<table class="form_table">	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50'></td></tr>	<tr><td class='left_td'>URL</td> <td><input type='text' name='url' size='50'></td></tr>	<tr><td class='left_td'>Родительский пункт</td> <td><? echo $menu->select_menu; ?></td></tr>	<tr><td class='left_td'>Позиция</td> <td><input type='text' name='position' size='50'></td></tr>	<tr><td class='left_td'>Статус</td> <td><select name='vision'>	<option value='1'>Видим</option>	<option value='0'>Невидим</option>	</select>	</td></tr>	<tr><td class='left_td'></td> <td><input type='submit' name='submit' value='Добавить'></td></tr></table></form><?	echo Pages::$page;?>