$(document).ready(function() {
	var submitURL = '/ajax/?script=callback';

	// Кэшируем объект feedback:	
	var feedback = $('#feedback');

	$('#feedback').on('click', 'a.submit', function(event){
		var area = $('#feedback').find(".prible");
		var input = feedback.find('input');
		var section = $('#feedback').find(".section");
		event.preventDefault();
		if(area.hasClass('working') || input.val().length < 5){
			return false;
		}

		// Запираем форму и изменяем стиль кнопки:
		area.addClass('working');
		
		$.ajax({
			url		: submitURL,
			type	: 'post',
			data	: { message : input.val()},
			complete	: function(xhr)
			{
				var text = xhr.responseText;
				if(xhr.status == 404){
					text = 'Путь к скрипту submit.php не верный.';
				}
				area.fadeOut();
				section.fadeOut(function(){
					var span = $('<span>',{
						className	: 'response',
						html		: text
					})
					.hide()
					.appendTo(feedback.find('.section'))
					.show();
					section.fadeIn();
				});
			}
		});
		
		return false;
	});
	
	
	$(".contact_form").on("click", "input.send", function(event){
		var area = $('.contact_form').find(".prible");
		var input = feedback.find('input');
		var section = $('#feedback').find(".section");
		event.preventDefault();
		if(area.hasClass('working') || input.val().length < 5){
			return false;
		}

		// Запираем форму и изменяем стиль кнопки:
		area.addClass('working');
		
		$.ajax({
			url		: submitURL,
			type	: 'post',
			data	: { message : input.val()},
			complete	: function(xhr)
			{
				var text = xhr.responseText;
				if(xhr.status == 404){
					text = 'Путь к скрипту submit.php не верный.';
				}
				area.fadeOut();
				section.fadeOut(function(){
					var span = $('<span>',{
						className	: 'response',
						html		: text
					})
					.hide()
					.appendTo(feedback.find('.section'))
					.show();
					section.fadeIn();
				});
			}
		});
		
		return false;
	});
	

	
	
var Form = {
        name: 'contactForm',
        cssClass: {'warning' : 'warning','error' : 'error', 'success' : 'success'},
        id: {'error' : 'error', 'success': 'success'},
        errorPrefix: 'Error',
        action: function(){return $('#' + this.name).attr('action')},
        data: function(){
            return $('#' + this.name).serialize();
        },
        hideBox: function(el){
            $(el).slideUp('slow');
        },
        showBox: function(el){
            $(el).slideDown('slow');
        },
        invalids: null,
        setInvalids: function(invalid){
            this.invalids = invalid
        }
    }
    // Boxes to hide
    var cssBoxes = '.' + Form.cssClass['warning'] + ',.' + Form.cssClass['error'] + ',.' + Form.cssClass['success'];
	
	//Додавання комента
	$('#contactForm').ajaxForm(function(data) {
		Form.hideBox(cssBoxes);
		var $return = eval('(' + data + ')');
        if($return === true){
            Form.showBox('#' + Form.id['success']);
            $('#contact_form form input[type="text"]').attr('value', '');
            $('#contact_form form textarea[name="message"]').attr('value', '');
            $('#contact_form img').attr('src', 'assets/img/contact/ajax-loader.gif');
            $('#contact_form img').attr('src', 'assets/php/security/1/sec.php?'+Math.random());
        }else if($return === false){
            Form.showBox('#' + Form.id['error']);
        }
        else{
        for(var i in $return){
            Form.showBox('#' + $return[i] + Form.errorPrefix);
         }
        }
		//}
		//$(".over_download").hide();
    });
	

	
	
// init sliders
function initSliders(){
	var duration = 500;
	var holders = jQuery('.portfolio-area');
	var sliders = holders.find('.slideBlockHolder');
	var classItemOpen = 'item-active';
	var classBlockOpen = 'block-active';
	var body = jQuery.browser.opera ? jQuery('html') : jQuery('html, body');
	holders.each(function() {
		var holder = jQuery(this);
		var items = holder.find('.item');
		var links = items.find('.img-box a:not(.follow-link)');
		var slider = holder.find('.slideBlockHolder').hide();
		
		links.each(function(n) {
			var link = jQuery(this);
			if (link.hasClass('do-nothing')) return;
			
			link.click(function() {
				if(holder.hasClass(classBlockOpen)) {
					if(items.eq(n).hasClass(classItemOpen)) {
						slider.slideUp({duration: duration})
						holder.removeClass(classBlockOpen);
						items.removeClass(classItemOpen);
					}
					else {
						items.removeClass(classItemOpen);
						items.eq(n).addClass(classItemOpen);
					}
				}
				else {
					var activeHolder = holders.filter('.' + classBlockOpen);
					holder.addClass(classBlockOpen);
					items.eq(n).addClass(classItemOpen);
					function slideBlock() {
						var posTop = link.parents('.item').offset().top;
						body.animate({scrollTop:posTop - 10},{
							duration:duration,
							complete: function() {
								slider.slideDown({duration: duration})
							}
						});
					}
					if(activeHolder.length) {
						activeHolder.find('.item').removeClass(classItemOpen);
						activeHolder.removeClass(classBlockOpen);
						activeHolder.find('.slideBlockHolder').slideUp({
							duration: duration,
							complete: function() {
								slideBlock();
							}
						})
					}
					else {
						slideBlock();
					}
				}
				return false;
			})
		});
	})
	
});
