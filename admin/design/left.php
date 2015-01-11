<div class="admin_menu">
	<ul>
	
	<li <? echo $admin->admin_menu["products"]; ?>><a href='/admin/'><i class="fa fa-home"></i> Главная</a></li>

	<li <? echo $admin->admin_menu["products"]; ?>><a href='/products.html'><i class="fa fa-cube"></i> Товар</a>
		<ul>
			<li><a href='/admin/add_product.html'>Добавить товар</a></li>
			<li><a href='/admin/product_list.html'>Список товара</a></li>
			<li><a href='/admin/add_category.html'>Добавить категорию товара</a></li>
			<li><a href='/admin/category_list.html'>Список категорий</a></li>
		</ul>
	</li>
	<li <? echo $admin->admin_menu["orders"]; ?>><a href='/admin/orders.html'><i class="fa fa-shopping-cart"></i> Заказы</a>
		<ul>
			<li><a href='/admin/orders.html'>Список заказов</a></li>
		</ul>
	</li>
	<li <? echo $admin->admin_menu["callback"]; ?>><a href='/admin/callback_list.html'><i class="fa fa-phone"></i> Звонки</a>
		<ul>
			<li><a href='/admin/callback_list.html'>Список запросов</a></li>
		</ul>
	</li>
	<li <? echo $admin->admin_menu["articles"]; ?>><a href='/admin/articles.html'><i class="fa fa-briefcase"></i> Статьи</a>
		<ul>
			<li><a href='/admin/add_article.html'>Добавить статью</a></li>
			<li><a href='/admin/article_list.html'>Список статтей</a></li>
			<li><a href='/admin/add_category_articles.html'>Добавить категорию</a></li>
			<li><a href='/admin/article_category.html'>Категории</a></li>
		</ul>
	</li>
	
	<li <? echo $admin->admin_menu["news"]; ?>><a href='/admin/news.html'><i class="fa fa-bullhorn"></i> Новости</a>
		<ul>
			<li><a href='/admin/add_new.html'>Добавить новость</a></li>
			<li><a href='/admin/news.html'>Список новостей</a></li>
		</ul>
	</li>
	
	<li <? echo $admin->admin_menu["scheme"]; ?>><a href='/admin/scheme.html'><i class="fa fa-share-alt"></i> Схемы</a>
		<ul>
			<li><a href='/admin/add_scheme.html'>Добавить схему</a></li>
			<li><a href='/admin/scheme.html'>Список схем</a></li>
		</ul>
	</li>
	
	<li <? echo $admin->admin_menu["photos"]; ?>><a href='/admin/photos.html'><i class="fa fa-camera"></i> Фото</a>
		<ul>
			<li><a href='/admin/add_photo.html'>Добавить фото</a></li>
			<li><a href='photo_list.html'>Фото</a></li>
		</ul>
	</li>
	
	<li <? echo $admin->admin_menu["video"]; ?>><a href='/admin/video.html'><i class="fa fa-film"></i> Видео</a>
		<ul>
			<li><a href='/admin/add_video.html'>Добавить видео</a></li>
			<li><a href='/admin/video_list.html'>Видео</a></li>
			<li><a href='/admin/add_category_video.html'>Добавить категорию видео</a></li>
			<!--<li><a href='/admin/category_video_list.html'>Список категорий</a></li>-->
		</ul>
	</li>
	
	<li <? echo $admin->admin_menu["portfolio"]; ?>><a href='/portfolio.html'><i class="fa fa-star"></i> Наши работы</a>
		<ul>
			<li><a href='/admin/add_albom.html'>Добавить альбом</a></li>
			<li><a href='/admin/portfolio_list.html'>Альбомы</a></li>
		</ul>
	</li>
	
	<li <? echo $admin->admin_menu["campaigns"]; ?>><a href='campaigns_list.html'><i class="fa fa-exclamation-triangle"></i> Акции</a>
		<ul>
			<li><a href='add_campaign.html'>Добавить акцию</a></li>
			<li><a href='campaigns_list.html'>Список акций</a></li>
		</ul>
	</li>
	
	<li <? echo $admin->admin_menu["pages"]; ?>><a href='pages.html'><i class="fa fa-file-word-o"></i> Страницы</a>
		<ul>
			<li><a href='add_page.html'>Добавить страницу</a></li>
			<li><a href='pages_list.html'>Список страниц</a></li>
		</ul>
	</li>
	
	<li <? echo $admin->admin_menu["users"]; ?>><a href='users_list.html'><i class="fa fa-male"></i> Пользователи</a>
		<ul>
			<li><a href='users_list.html'>Список пользователей</a></li>
		</ul>
	</li>
	
	<li <? echo $admin->admin_menu["blocks"]; ?>><a href='content_blocks.html'><i class="fa fa-empire"></i> Блоки</a>
		<ul>
			<li><a href='content_blocks.html'>Список блоков</a></li>
		</ul>
	</li>
	
	<li <? echo $admin->admin_menu["settings"]; ?>><a href='/admin/settings.html'><i class="fa fa-cog"></i> Settings</a>
		<ul>
			<li><a href='settings/contacts.html'>Контакты</a></li>
		</ul>
	</li>

	</ul>
</div>