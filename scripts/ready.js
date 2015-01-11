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
    $('button, .buttuss').mousedown(function(e){
$(this).addClass('clicked');
}).bind('mouseup mouseleave', function(){
$(this).removeClass('clicked');
});
*/

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
