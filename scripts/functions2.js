$(document).ready(function() {

/*--------------------------- Связь с администрацией над шапкой ------------------------*/
$('.moreLinkContacterGM').bind('click', function() {
	event.preventDefault();
	$('.contacterGM').slideToggle();
});




/*--------------------------- Табы ------------------------*/
$('ul.tabs').delegate('li:not(.current)', 'click', function() {
    $(this).addClass('current').siblings().removeClass('current')
    .parents('div.section').find('div.box').hide().eq($(this).index()).fadeIn(600);
});

/*--------------------------- Спойлер ------------------------*/
$('.spoiler').find('.spoilerheader').click(function () {
	$(this).parent('.spoiler').find('.spoilertext').slideToggle();
	//$(this).parent('.spoiler').toggleClass("open");
});

/*--------------------------- Счетчик ------------------------*/
$('.counter').counter({});


/*--------------------------- Добавить товар ------------------------*/
$('table').find('.add_new_product').bind('click', function(event) {
	event.preventDefault();
	data = "<tr><td class='left_td'>Код: <input type='text' name='product_code[]' size='7' value=''></td><td class='left_td'>Название: <input type='text' name='product_title[]' size='50' value=''></td><td class='left_td'>Цена: <input type='text' name='product_prise[]' size='7' value=''></td></tr>";
    $(this).parent('td').parent('tr').before(data);
});

/*--------------------------- Добавить похожий товар ------------------------*/
$('.add_new_related_product_type').bind('click', function(event) {
	event.preventDefault();
	data = "<div><div>Товар: <input type='text' class='related_product_type' name='related_product_type[]' value='' autocomplete='off'></div></div>";
    $(this).parent('div').before(data);
});

/*--------------------------- Добавить фильтр к товару ------------------------*/
$('.add_filter_product_type').bind('click', function(event) {
	event.preventDefault();
	data = "<div><p>Фильтр: <input type='text' class='filter_product_type' name='filter_product_type[]' value='' autocomplete='off'> значение: <input type='text' class='filter_element_product_type' name='filter_element_product_type[]' value='' autocomplete='off'></p></div>";
    $(this).before(data);
});

/* Переход на страницу фильтра */
$('.filters').find("input[type=checkbox]").bind('click', function(event) {
	event.preventDefault();
	window.location.href = $(this).attr("href");
});
$('.filters').find("input[name=filters_submit]").bind('click', function(event) {
	event.preventDefault();
	$prise_from = $('.filters').find("input[name=prise_from]").val();
	$prise_to = $('.filters').find("input[name=prise_to]").val();
	$.cookie("prise_from", $prise_from, {expires:30, path: '/'});
	$.cookie("prise_to", $prise_to, {expires:30, path: '/'});
	location.reload();
});

$('.product_sort').find(".product_count").bind('click', function(event) {
	event.preventDefault();
	$product_count = $(this).text();
	$.cookie("product_count", $product_count, {expires:30, path: '/'});
	location.reload();
});

$('.product_sort').find(".product_order_by").bind('click', function(event) {
	event.preventDefault();
	$product_order_by = $(this).attr("value");
	$.cookie("product_order_by", $product_order_by, {expires:30, path: '/'});
	location.reload();
});


/*--------------------------- Фокус у введенні номера телефону ------------------------*/
$("input[name=phone1]").bind("keypress", function() {
	$length = $(this).val().length;
	if($length >= 2)
	{
		$("input[name=phone2]").focus();
	}
});

$("input[name=phone2]").bind("keypress", function() {
	$length = $(this).val().length;
	if($length >= 2)
	{
		$("input[name=phone3]").focus();
	}
});

$("input[name=phone3]").bind("keypress", function() {
	$length = $(this).val().length;
	if($length >= 1)
	{
		$("input[name=phone4]").focus();
	}
});

/*--------------------------- popups ------------------------*/
$(".show_mini_popup").bind("mouseover", function() {
	$popup = $(this).attr("popup");
	$("#"+$popup).show(100);
});
$(".show_mini_popup").bind("mouseout", function() {
	$popup = $(this).attr("popup");
	$("#"+$popup).hide(100);
});



/*--------------------------- ФИЛЬТРЫ ------------------------*/
/* Добавление елемента в фильтр */
$(".add_filter_element").click(function(event) {
	event.preventDefault();
	$(".add_filter_element").before("<p> Значение:<input type='text' name='element_title[]'> Транскрипция:<input type='text' name='eng_element_title[]'></p>");
});


/* Карусель */
/*
$(function() {
    $('.jcarousel').jcarousel();
});
*/
$(function() {
        var jcarousel = $('.jcarousel');

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var width = jcarousel.innerWidth();

                if (width >= 600) {
                    width = width / 4;
                } else if (width >= 350) {
                    width = width / 3;
                }

                jcarousel.jcarousel('items').css('width', width + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            });

        $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+=1'
            });

        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .on('click', function(e) {
                e.preventDefault();
            })
            .jcarouselPagination({
                perPage: 1,
                item: function(page) {
                    return '<a href="#' + page + '">' + page + '</a>';
                }
            });
    });
	
$('.fast-comment-link').bind('click', function(event) {
	event.preventDefault();
	$(this).parent().find('.fast-comment').slideToggle();
});


//------------------- Прилипание меню -------------//
        $(window).scroll(function(){ //во время прокрутки страницы
//проверяем прошли ли мы хедер-высоту менюшки
            if ($(window).scrollTop()>$(".head").height()-$("nav").height()+70){
                $("nav").addClass("stickly");//назначаем класс
            }
            else
            {
//если не достигли указанной высоты или когда проскролили вверх страницы удаляем класс
                $("nav").removeClass("stickly");
            }
			$(".special_menu").find("nav").removeClass("stickly");
        });

		
//------------------- Подтверждение удаления -------------//
/*
$(".delete").on("click", function(e) {
    var link = this;
    e.preventDefault();
    $("<div>Вы уверены, что хотите удалить это?</div>").dialog({
        buttons: {
            "Да": function() {
                window.location = link.href;
            },
            "Отмена": function() {
                $(this).dialog("close");
            }
        }
    });
});
*/
		
});