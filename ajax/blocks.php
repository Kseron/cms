<?
if($_GET[type] == "edit" AND $_GET[id] != "" AND $_SESSION['user_type'] == 3)
{
	$array = mysql_fetch_array(mysql_query("SELECT * FROM content_blocks WHERE id='$_GET[id]'"));
	echo "	
	<h1>Редактировать блок</h1>
	
	$functions->red_result
	";
?>
	<form action="" method='post' enctype='multipart/form-data'>
	<table class='form_table' style="width:100%;">
	<tr><td class='left_td' style="width:10%;">Название:</td> <td><input type='text' name='title' maxlength='255' style="width:100%;" value='<? if($_POST['title'] != '') { echo $_POST['title']; } else { echo $functions->this_block['title']; } ?>'></td></tr>
	<tr><td class='left_td'>Текст:</td> <td><textarea name='text' rows='30' style="width:100%;"><? if($_POST['text'] != '') { echo $_POST['text']; } else { echo $functions->this_block['text']; } ?></textarea>
	</td></tr>
	<tr><td></td> <td><input type='submit' name='submit' value='Отправить'> <a href="<? echo $_GET['parent']; ?>" class="blue_pseudobutton" style="padding:7px; margin-left:20px;" target="_parent">Закрыть</a></td></tr>
	</table>
	</form>
	
<?
}