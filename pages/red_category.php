<?
	echo $catalog->red_result;
?>

<h1>Редаектирование категории «<? echo $catalog->this_category['title']; ?>»</h1>
<form action='' method='post' enctype='multipart/form-data'>
	<table>
	<tr><td class='left_td'>Название</td> <td><input type='text' name='title' size='50' value='<? if($_POST['title'] != "") { echo $_POST['title']; } else { echo $catalog->this_category['title']; } ?>'></td></tr>
	<!--<tr><td class='left_td'>Трансліт</td> <td><input type='text' name='eng_title' size='50' value='<? if($_POST['eng_title'] != "") { echo $_POST['eng_title']; } else { echo $catalog->this_category['eng_title']; } ?>'></td></tr>-->
	<tr><td class='left_td'>Mini_description</td> <td><input type='text' name='mini_descr' size='50' value='<? if($_POST['mini_descr'] != "") { echo $_POST['mini_descr']; } else { echo $catalog->this_category['mini_descr']; } ?>'></td></tr>
	<tr><td class='left_td'>Ключевые слова</td> <td><input type='text' name='keywords' size='50' value='<? if($_POST['keywords'] != "") { echo $_POST['keywords']; } else { echo $catalog->this_category['keywords']; } ?>'></td></tr>
	<tr><td class='left_td'>Родительская категория</td> <td><select name="category"><? echo $catalog->select_category; ?></select></td></tr>
	<tr><td class='left_td'>Картинка (135х110)</td> <td><input type='file' name='image'></td></tr>
	<tr><td class='left_td'>Статус</td> <td><select name='vision'>
	<option value='1' <? if($catalog->this_category['vision'] == "1") { echo "selected"; } ?>>Видима</option>
	<option value='0' <? if($catalog->this_category['vision'] == "0") { echo "selected"; } ?>>Невидима</option> 
	</select>
	</td></tr>
	<tr><td class='left_td'></td> <td><input type='submit' name='submit' value='Редактировать'></td></tr>
</table>
