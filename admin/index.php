<?
include("../core/config.php");

//Інклуд класів
include("../classes/functions.php");
include("../classes/graphics.php");
include("../classes/pages.php");
include("../classes/datetime.php");
include("../classes/settings.php");
include("../classes/defence.php");
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
include("../classes/campaigns.php");
include("../classes/breadcrumbs.php");
include("../classes/admin.php");
include("../classes/titles.php");

//Підключення елементів, їх налаштування
include("../core/before.php");

$admin = new Admin;

if($_SESSION[access] == 3)
{
	include("html.php");
}
else
{
	include("protect.php");
}