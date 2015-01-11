<?
include("../core/config.php");

//Інклуд класів
include("../classes/functions.php");
include("../classes/graphics.php");
include("../classes/pages.php");
include("../classes/datetime.php");
include("../classes/users.php");
include("../classes/catalog.php");
include("../classes/menu.php");
include("../classes/products.php");
include("../classes/cart.php");
include("../classes/callback.php");
include("../classes/video.php");
include("../classes/news.php");
include("../classes/articles.php");
include("../classes/photos.php");
include("../classes/portfolio.php");
include("../classes/my_pages.php");
include("../classes/scheme.php");
include("../classes/breadcrumbs.php");
include("../classes/admin.php");
//include("../classes/filters.php");
//include("../classes/titles.php");
//include("../classes/reviews.php");

//Підключення елементів, їх налаштування
include("../core/before.php");

//include("html.php");

if($_GET['script'] == "kaka")
{
?>

<!DOCTYPE html>
<html lang="ru">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<base href='/'>

<script type="text/javascript" src="/scripts/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="/scripts/functions.js"></script>
<script type="text/javascript" src="/scripts/ajax.js"></script>

<link rel="stylesheet" type="text/css" href="/design/style.css" />
</head>

<body>

<?
}

include($_GET['script'].".php");

if($_GET['script'] == "kaka")
{
?>

</body>

</html>
<?
}