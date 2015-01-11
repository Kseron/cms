<?
	if($pages->error_text != "")
	{
		echo $pages->error_text;
	}
	else
	{
		echo "<div style='margin:0 auto;'><h1>Ошибка 404. Страница не найдена</h1></div>
		<div style='margin:0 auto;'>Этой страницы или вообще не существовало, или же она была недавно удалена. Попробуйте поискать что-то другое</div>";
	}
?>