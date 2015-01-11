<?
	if($_GET[page] == "") { $_GET[page] = "index"; }
?>

<!DOCTYPE html>
<html lang="ru">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="<? echo $titles->description; ?>">
<meta name="keywords" content="<? echo $titles->keywords; ?>">
<meta name="robots" content="index,follow">
<base href='/admin/'>
<title><? echo $titles->title; ?></title>
<script type="text/javascript" src="/scripts/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/scripts/jquery.cookie.js"></script>
<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
<script type="text/javascript" src="/scripts/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/scripts/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="/scripts/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript" src="/scripts/modals.js"></script>
<script type="text/javascript" src="/scripts/ckeditor/ckeditor.js"></script>
<!--<script type="text/javascript" src="/scripts/inputs.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">-->
<link rel="stylesheet" type="text/css" href="/design/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="/design/fonts/font.css" />
<link rel="stylesheet" type="text/css" href="/admin/design/style.css" />
<link rel="stylesheet" type="text/css" href="/scripts/fancybox/jquery.fancybox.css" />
<link rel="stylesheet" type="text/css" href="/scripts/fancybox/helpers/jquery.fancybox-thumbs.css?v=2.0.4" />
<link rel="stylesheet" type="text/css" href="/design/tabs.css" />

<script type="text/javascript" src="/admin/scripts/functions.js"></script>
<script type="text/javascript" src="/scripts/ajax.js"></script>
</head>

<body>
<div class="all">

	<header>
	<? include("design/head.php"); ?>
	</header>
	
	<div class="general_content">
		<div class="admin_left_colum">
		<?
			include("design/left.php");
		?>
		</div>
		<div class="admin_right_colum">
		<?
			//echo $_GET['page'];
			//include(Pages::$page);
			include("pages/".$_GET['page'].".php");
		?>
		</div>
	</div>

	<footer>

	</footer>

</div>

</body>

</html>