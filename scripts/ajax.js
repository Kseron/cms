$(document).ready(function() {

/*--------------------------- Поиск похожего товара ------------------------*/
$("body").on("keydown keyup click", ".related_product_type", function() {
	$url = "/ajax/?script=products";
	$type = "find_related_product_type";
	$text = $(this).val();
	$this = $(this);
	$(this).parent("div").parent("div").children(".result_related_product_type").remove();
	if($text != "")
	{
		$.post($url, { text:$text, type:$type}, function(data){
			success: {
				$("body").find(".result_related_product_type").remove();
				$this.parent("div").after(data);
			}
		});
	}
});

$("body").on("click", ".result_related_product_type_p", function(){
    var txt = $(this).text();
    $(this).parent(".result_related_product_type").parent("div").find(".related_product_type").val(txt);
	$(this).parent(".result_related_product_type").remove();
});




/*--------------------------------- КОРЗИНА ---------------------------------*/
	
	//Удалить с корзины
	$(".del_product_from_cart").on("click", function(event) {
		event.preventDefault();
		if(confirm('Удалить?'))
		{
		$url = "/ajax/?script=cart";
		$type = "delete_from_cart";
		$id = $(this).attr("cart_id");
		$this = $(this);
        $.post($url, { id:$id, type:$type}, function(data){
			success: {
				$($this).parent("td").parent("tr").hide('500');
				$($this).parent("td").parent("tr").hide('500');
				//$.cookie('cart', null, {expires:30, path: '/'});
				//$.cookie('cart', data, {expires:30, path: '/'});
				$(".cart_confirm_td").find("span").html(data);
				$(".head_cart").find(".summ").find("span").html(data);
				$count = $(".head_cart").find(".count").text();
				$count = $count - 1;
				$(".head_cart").find(".count").html($count);
            }
		});
		}
    });
	
	//Пересчитать корзину
	$(".recalculate_cart").on("click", function(event) {
		event.preventDefault();
		$url = "/ajax/?script=cart";
		$type = "recalculate_cart";
		$sum = 0;
		$(".product_count").each(function() {
			$count = $(this).val();
			$prise = $(this).parent("td").parent("tr").find(".prise").find("span").text();
			$this_sum = Number($count) * Number($prise);
			$(this).parent("td").parent("tr").find(".summ").find("span").html($this_sum);
			$sum = Number($sum) + Number($this_sum);
			
			$product_id = $(this).attr("product_id");
			$cart_id = $(this).attr("cart_id");
			$this = $(this);
			$.post($url, { product_id:$product_id, cart_id:$cart_id, type:$type, count:$count, sum:$this_sum}, function(data){
			//success: {
				//$($this).parent("td").parent("tr").children(".summ").html(data+" руб.");
				//$sum = Number($sum) + Number(data);
            //}
			});
		});
		$(".cart_confirm_td").find("span").html($sum);
		$(".head_cart").find(".summ").find("span").html($sum);
		//$(".head_cart").find(".count").html($count);
    });
	
	

/*--------------------------------- ТОВАР ---------------------------------*/
	$(".fast_del_product").bind("click", function(event) {
		event.preventDefault();
		if(confirm('Удалить?'))
		{
		$url = "/ajax/?script=products";
		$type = "delete_product";
		$id = $(this).attr("product_id");
		$this = $(this);
        $.post($url, { id:$id, type:$type}, function(data){
			success: {
				$($this).parent("td").parent("tr").hide('500');
            }
		});
		}
    });
	
	
	//быстрая правка цены товара
	$(".product_prise").on("dblclick", function() {
		$id = $(this).attr("product_id");
		$price = $(this).text();
		$(this).html("<input type='text' class='product_change_prise' product_id='"+$id+"' value='"+$price+"'> <a class='product_change_prise_a' href='#'>OK</a>");
	});
	$(".product_prise").on("click", ".product_change_prise_a", function(event) {
		event.preventDefault();
		$url = "/ajax/?script=products";
		$type = "product_change_prise";
		$id = $(this).parent("span").find(".product_change_prise").attr("product_id");
		$prise = $(this).parent("span").find(".product_change_prise").val();
		$this = $(this);
		//alert($price);
        $.post($url, { id:$id, type:$type, prise:$prise}, function(data){
			success: {
				$this.parent(".product_prise").html($prise);
            }
		});
    });

	
	

	//Удалить дополнительную картинку
	/*
	$(".del_addition_image").on("click", function() {
		if(confirm('Удалить?'))
		{
		$url = "/ajax/?script=products";
		$type = "delete_additional_image";
		$id = $(this).attr("image");
		$this = $(this);
        $.post($url, { id:$id, type:$type}, function(data){
			success: {
				$($this).parent("div").hide('500');
            }
		});
		}
    });
	*/

/*--------------------------------- ОТЗЫВЫ ---------------------------------*/
/*
	$(".review").find(".review_del").on("click", function(event) {
		if(confirm('Удалить?'))
		{
		$url = "/ajax/?script=reviews";
		$type = "delete_review";
		$id = $(this).attr("id_review");
		$this = $(this);
        $.post($url, { id:$id, type:$type}, function(data){
			success: {
				$($this).parent("p").parent(".review").hide('500');
            }
		});
		}
    });
*/
	
/*--------------------------------- ОБЩИЕ ---------------------------------*/
	//Показывать и скрывать дополнительные елементы
	$(".show-hide-elements").find(".show-button").find("a").on("click", function(event) {
		event.preventDefault();
		$(".show-hide-elements").find(".show-button").toggle();
		$(".show-hide-elements").find(".show-object").toggle();
    });
	
	

/*--------------------------------- СПИСОК ЗАКАЗОВ  (А) ---------------------------------*/
	
	//Статус
	/*
	$(".admin_orders").find(".status").on("dbclick", function(event) {
		//event.preventDefault();
		$id = $(this).attr("ord");
		$type = "change_status";
		$this = $(this);
		$url = "/ajax/?script=cart";
        $.post($url, { id:$id, type:$type}, function(data){
			success: {
				$($this).parent("p").parent("td").parent("tr").find(".status").html(data);
				$this_text = $($this).text();
				if($this_text == "Оплачено")
				{
					$($this).html("Предзаказ");
				}
				elseif($this_text == "Предзаказ")
				{
					$($this).html("Оплачено");
				}
            }
		});
    });
	*/
	
	//оплачен-неоплачен
	/*
	$(".matherial_table").find(".payment_ok").on("click", function(event) {
		event.preventDefault();
		$id = $(this).attr("id_order");
		$type = "pay_order";
		$this = $(this);
		$url = "/ajax/?script=cart";
        $.post($url, { id:$id, type:$type}, function(data){
			success: {
				$($this).parent("p").parent("td").parent("tr").find(".status").html(data);
				$this_text = $($this).text();
				if($this_text == "Оплачено")
				{
					$($this).html("Предзаказ");
				}
				elseif($this_text == "Предзаказ")
				{
					$($this).html("Оплачено");
				}
            }
		});
    });
	
	
	$(".matherial_table").find(".delete_order").on("click", function(event) {
		event.preventDefault();
		$id = $(this).attr("id_order");
		$type = "delete_order";
		$this = $(this);
		$url = "/ajax/?script=cart";
        $.post($url, { id:$id, type:$type}, function(data){
			success: {
				$($this).parent("p").parent("td").parent("tr").hide();
            }
		});
    });
	*/
	

	
/*--------------------------- ФИЛЬТРЫ ------------------------*/
/* Добавление елемента в фильтр */
$(".add_filter_category").click(function(event) {
	event.preventDefault();
	$type = "get_select_category";
	$this = $(this);
	$url = "/ajax/?script=catalog";
    $.post($url, { type:$type}, function(data){
		success: {
			$($this).before("<p> <select name='category[]'>"+data+"</select></p>");
       }
	});
	
});


/* Удаление фильтра */

	$(".fast_del_filter_product").bind("click", function(event) {
		event.preventDefault();
		if(confirm('Удалить?'))
		{
		$url = "/ajax/?script=filters";
		$type = "delete_filter_product";
		$id = $(this).attr("filter_product_id");
		$this = $(this);
        $.post($url, { id:$id, type:$type}, function(data){
			success: {
				$($this).parent("p").hide('500');
            }
		});
		}
    });
	
});