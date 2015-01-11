$(document).ready(function() {

/*--------------------------- Админ меню ------------------------*/
$(".admin_menu").children("ul").children("li").children("a").click(function(event) {
	if($(this).parent("li").children("ul").length>0)
	{
		event.preventDefault();
		if($(this).parent("li").children("ul").is(":hidden"))
		{
			$(".admin_menu").children("ul").children("li").children("ul").slideUp();
			$(this).parent("li").children("ul").slideDown();
		}
		else
		{
			$(this).parent("li").children("ul").slideUp();
		}
	}
});

/*--------------------------- Табы ------------------------*/
$('ul.tabs').delegate('li:not(.current)', 'click', function() {
    $(this).addClass('current').siblings().removeClass('current')
    .parents('div.section').find('div.box').hide().eq($(this).index()).fadeIn(150);
});


/*--------------------------- Добавить товар ------------------------*/
$('table').find('.add_new_product').bind('click', function(event) {
	event.preventDefault();
	data = "<tr><td>Код: <input type='text' name='product_code[]' size='7' value=''></td><td>Название: <input type='text' name='product_title[]' size='100' value=''></td><td>Цена: <input type='text' name='product_prise[]' size='7' value=''></td></tr>";
    $(this).parent('td').parent('tr').before(data);
});

/*--------------------------- Добавить похожий товар ------------------------*/
$('.add_new_related_product_type').bind('click', function(event) {
	event.preventDefault();
	data = "<div class='related_product_div'><div>Товар: <input type='text' class='related_product_type' name='related_product_type[]' value='' autocomplete='off'></div></div>";
    $(this).parent("div").before(data);
});

/*--------------------------- Добавить фильтр к товару ------------------------*/
$('.add_filter_product_type').bind('click', function(event) {
	event.preventDefault();
	data = "<div><p>Фильтр: <input type='text' class='filter_product_type' name='filter_product_type[]' value='' autocomplete='off'> значение: <input type='text' class='filter_element_product_type' name='filter_element_product_type[]' value='' autocomplete='off'></p></div>";
    $(this).before(data);
});

$('.filters').find("input[type=checkbox]").bind('click', function(event) {
	event.preventDefault();
	window.location.href = $(this).attr("href");
});




/*--------------------------- Спойлер ------------------------*/
$('.spoiler').find('.spoilerheader').click(function () {
	$(this).parent('.spoiler').find('.spoilertext').slideToggle();
	//$(this).parent('.spoiler').toggleClass("open");
});


/*--------------------------- Callback ------------------------*/
$(".callback_block").find(".remove").bind('click', function(event) {
	//if(!confirm('Удалить?'))
	//{
	//	event.preventDefault();
	//}
	//event.preventDefault();
	//alert('1');
	//$type = "remove";
	//$id = (this).attr("matherial_id");
});



$("body").find(".remove").bind('click', function(event) {
	if(!confirm('Удалить?'))
	{
		event.preventDefault();
	}
});

});