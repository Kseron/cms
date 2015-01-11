<?
if($_POST[type] == "delete_review" AND $_POST[id] != "" AND $_SESSION['user_type'] == 3)
{
	$reviews->del_review($_POST[id]);
	echo $reviews->del_result;
}