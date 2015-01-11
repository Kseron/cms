/*
function ContactBlock(){
    var $contactBlock = $('.contacterGM');
    var $contactLink = $('.moreLinkContacterGM');
    var contactHeight = $contactBlock.innerHeight();

    $contactBlock.css({'margin-top' : -contactHeight + 'px'});

    $contactLink.toggle(function(e){
        $contactBlock.show().animate({'margin-top' : 0});

        return false;

    }, function(e){
        var contactHeight = $contactBlock.innerHeight();
        $contactBlock.animate({'margin-top' : -contactHeight + 'px'}, function(){
            $contactBlock.hide();
        });

        return false;
    });
}
*/

function ContentSlider(){
    var $sliderBox = $('.textSliderGM');
    var $menuSliderGM = $('.textermenuSliderGM');

    function showglim(id){
        var $prevTextGM = $('.activeTextGM', $sliderBox).addClass('prevTextGM').removeClass('activeTextGM');
        var $nextTextGM = $(id).addClass('nextTextGM');
        $prevTextGM.animate({'left':'-100%'}, function(){
            $prevTextGM.removeClass('prevTextGM').removeAttr('style');
        });
        $nextTextGM.animate({'left':0}, function(){
            $nextTextGM.removeClass('nextTextGM').addClass('activeTextGM');
        })
    }

    //  events

    $('a', $menuSliderGM).click(function(e){
        if ($(this).parents('li').hasClass('active')){
            return false;
        }
        var id = $(this).attr('href');
        $(this).parents('li').addClass('active').siblings('li').removeClass('active');
        showglim(id);
        return false;
    });

    return {
        showglim : showglim
    }
}
/*
function LanguageSelect(){
    var $selectBlock = $('.langSelectGM');
    var $selectLink = $('a', $selectBlock);

    function showSelect(){
        $selectBlock.addClass('expand');
    }

    function hideSelect(){
        $selectBlock.removeClass('expand');
    }

    $selectLink.click(function(e){
        e.stopPropagation();
        if ($selectBlock.hasClass('expand')){
            $(this).parents('li').addClass('active').siblings('li').removeClass('active');
            hideSelect();
        } else {
            showSelect();
            $('body').one('click', function(e){
                hideSelect();
            });
            return false;
        }
    });

    return {
        show : showSelect(),
        hide : hideSelect()
    }
}

(function($) {
    $.fn.tooltip = function() {
        var $tooltip = $('.toolsGM');
        var $toolsTextGM = $('.toolsTextGM', $tooltip);

        return this.each(function() {
            var $glim = $(this);
            var glimData = $glim.next('.toolsTextusGM');

            //  events
            var timeout;
            $glim.hover(function() {
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    var glimCenterLeft = $glim.offset().left + $glim.width() / 2;
                    $tooltip.hide();
                    $toolsTextGM.html(glimData);
                    var tooltipTop = $glim.offset().top - $tooltip.height() - 5;
                    $tooltip.css({
                        'left' : glimCenterLeft,
                        'top' : tooltipTop
                    });

                    if ($.browser.msie){
                        $tooltip.show();
                    } else {
                        $tooltip.fadeIn();
                    }
                    
                }, 400);
            }, function() {
                clearTimeout(timeout);
                $tooltip.fadeOut();
            })

        })
    }
})(jQuery);

(function($) {
    $.fn.homus = function() {
        var $homus = $('.septGM');
        var $textSeptGM = $('.textSeptGM', $homus);

        return this.each(function() {
            var $glim = $(this);
            var glimData = $glim.attr('title');
            $glim.removeAttr('title');

            //  events
            var timeout;
            $glim.mouseenter(function(e) {
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    var glimLeft = $glim.offset().left;
                    $homus.hide();
                    $textSeptGM.html(glimData);
                    var tooltipTop = $glim.offset().top;
                    $homus.css({
                        'left' : glimLeft,
                        'top' : tooltipTop
                    }).fadeIn('fast');
                }, 300);

                return false;
            });

            $homus.mouseleave(function() {
                clearTimeout(timeout);
                $homus.fadeOut('fast');
            });

        })
    }
})(jQuery);

(function($) {
    $.fn.paginator = function() {
        return this.each(function() {
            var $paginator = $(this);
            var $activePage = $('.pageLinks .active', $paginator);
            var $nextLink = $activePage.next('a');
            var $prevLink = $activePage.prev('a');
            $(document).keydown(function(e) {
                if (e.ctrlKey) {
                    if (e.keyCode == 39) {
                        $nextLink.length ? document.location.href = $nextLink.attr('href') : false;
                    } else if (e.keyCode == 37) {
                        $prevLink.length ? document.location.href = $prevLink.attr('href') : false;
                    }
                }
            });
        });
    };
})(jQuery);

$(function() {
    $('.slideGmVid').bind('click',function(event){
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1000,'easeInOutExpo');
        event.preventDefault();
    });
});
*/

$(document).ready(function() {

    TelFunc = {};

    //TelFunc.contactBlock = new ContactBlock();
    //TelFunc.languageSelect = new LanguageSelect();

    if ($('.textSliderGM').length && $('.textermenuSliderGM').length){
        TelFunc.contentSlider = new ContentSlider();
    }

    $('.inputGMtext').focus (
            function(e) {
                $(this).prev('label').hide();
            }).focusout(
            function(e) {
                if (!$(this).val().length) {
                    $(this).prev('label').show();
                }
            }).each(function() {
        if ($(this).val().length) {
            $(this).prev('label').hide();
        }
    }).prev('label').click(function(){
        $(this).next('.inputGMtext').focus();
    });

    /*
	$('.zakSliderGM .sliderGmTeles').carousel({
        'pagination' : false,
        'insertPrevAction' : function(){
            this.addClass('arrowLeft arrow').appendTo('.zakSliderGM').empty();
        },
        'insertNextAction' : function(){
            this.addClass('arrowRight arrow').appendTo('.zakSliderGM').empty();
        }
    });

    $('.feedGM .sliderGmTeles').carousel({
        'pagination' : false,
        'insertPrevAction' : function(){
            this.addClass('arrowLeft arrow').appendTo('.feedGM h2').empty();
        },
        'insertNextAction' : function(){
            this.addClass('arrowRight arrow').appendTo('.feedGM h2').empty();
        }
    });
	*/
	
    $('button, .buttuss').mousedown(function(e){
$(this).addClass('clicked');
}).bind('mouseup mouseleave', function(){
$(this).removeClass('clicked');
});


    $('.zakSliderGM .sliderglim img').tooltip();
    $('.dayPyat').homus();
    $('#paginator').paginator();

    $('.linkGmGus').click(function(){
        var id = $(this).attr('href');
        $(id).slideToggle();
        return false;
    });

    $('.vidusGmGus a').click(function(e){
        if ($(this).hasClass('active')){
            return false;
        }

        $(this).addClass('active').siblings('a').removeClass('active');

        if ($(this).hasClass('pakaz')){
            $('#zadat tbody tr:not%28.siuda%29.htm').hide();
        }

        if ($(this).hasClass('showAll')){
            $('#zadat tbody tr:not%28.siuda%29.htm').show();
        }

        return false;
    });

});
