<?
if($_GET[type] == "edit_photo" AND $_GET[id] != "")
{
	echo $photos->red_result;
	
	echo "
	<form action='' method='post'>
	<p>Название: <input type='text' name='title' size='100' maxlength='255' value='".$photos->this_photo['title']."'></p>
	<p><input type='submit' name='submit' value='Отправить'></p>
	</form>
	";

}


?>