<?
if($_GET[type] == "edit_portfolio_photo" AND $_GET[id] != "")
{
	echo $portfolio->red_result;
	
	echo "
	<form action='' method='post'>
	<p>Название: <input type='text' name='alt' size='100' maxlength='255' value='".$portfolio->this_portfolio_photo['alt']."'></p>
	<p><input type='submit' name='submit' value='Отправить'></p>
	</form>
	";

}


?>