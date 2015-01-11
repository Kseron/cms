$(function(){

// Переменные
    var Strategy = '';
    var strategyNum = '';
    var Switcher = '';


// Form close
   $('.closer').click(function(){ 
        $('.hidden,#popup').hide();
       // $('#popup').hide();
        })
    
// QuickFlip CARDS
     $('.cardBox').quickFlip({closeSpeed:100,openSpeed:100}).mouseenter(function(ev){ $(this).quickFlipper()});

// FLIPPER_PEOPLE_QUESTION
    var qq = 500;
    $('#q_arrow').click(function(){ 
        $('#QUESTION_Block').fadeIn(qq);
        $('#realPback').fadeOut(qq);
    })
    $('#RealPeople').click(function(){ 
        $('#QUESTION_Block').fadeOut(qq);
        $('#realPback').fadeIn(qq);
    })
    
// Zakaz_key
    $('.zakaz_key').click(function(){
        $('.PC').each(function(){
            var h = parseInt($(this).css('background-position'));
            $(this).css('background-position',h+'px -76px');
        })
        var rel = $(this).attr('rel');
        var target = $('#cP'+rel);
        var p_target = parseInt(target.css('background-position'));
        target.css('background-position',p_target+'px 0');
        $('#backYellow').fadeTo(10, .0).animate({'top': '0px', 'opacity': '1.0'}, 500, 'easeOutCirc');
        });
    
// Close ZAKAZ_Form
    $('#yellowform_closer').click(function(){ $('#backYellow').animate({'top': '-530px', 'opacity': '0.7'}, 500, 'easeInQuad'); })

// Animated block 1-5
    var flag = 'AB_1';
    $('.block1-5').mouseenter(function(){ 
        if (this.id != flag){
            $(this).stop().delay(100).animate({'width': '465px'},300,'easeInOutQuad');
            $('#'+flag).stop().delay(98).animate({'width': '95px'},300,'easeInOutQuad');
            flag = this.id;
       }
    })

//Upper info-cloud
    $('#logo_click').click(function(){
        $('#uppercloud').fadeTo(200,1).click(function(){ $(this).hide()});
    })

// Open 1-4 window
    $('.pic_block_key, .picsChoice').click(function(){
        strategyNum = $(this).attr('rel');
        num = strategyNum*530;
        $('#blocks1_4').animate({'top':(-num)+'px' },700,'easeInOutSine');
        $('#info').html(strategyNum);//000000000000000000000000
    })

//----------------СЛУЖЕБНОЕ ОКНО-------------------------------------------------

/*
      $('*').mouseenter(function() {
        e_id = $(this).attr('id');
        e_class = $(this).attr('class');
        e_rel = $(this).attr('rel');
        $("#info").html('#'+e_id+'<br />.'+e_class+'<br />rel= '+e_rel);
      });
 */
//-----------------------------------------------------------------
// Smile Testing
    function SmileTest(){
     $('.smileSSS').each(function(){
        var x = parseInt($(this).css('background-position'));
        if($(this).attr('rel'))
        {$(this).css('background-position', x+'px'+' -75px')
        }else{
        $(this).css('background-position', x+'px'+' 0px');
        }
	   })
    }

// From Form 
   
    Smile ='';
    function Mood(s){
    $('#'+s).attr('rel','OPA');
    SmileTest();
    }
    
	$('.smileSSS').click(function(){
	   $('.smileSSS').removeAttr('rel');
       $(this).attr('rel','OPA');
       var Smile = $(this).attr('id');
       $('#info').html(Smile);//---------------------------------------------
       Mood(Smile);
    });
    
 //Form loading !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $('#blackScreen').css('opacity', '0.7');
    
    $('.uc').click(function(){
        if($(this).attr('alt')=='write'){ 
            Smile ='thanks';
            Mood(Smile);
            }
        Switcher = 'none';
        $('.ErrWindow').hide();
        $('.hidden').hide();
        $('#blackScreen').show();
        var page_ID = $(this).attr("alt");
        $('#popup').fadeTo(200,1);
        $('#'+page_ID).delay(205).fadeTo(500,1);
    }) 

    $('.fLink').click(function(){
        Switcher = 'Yes';
        $('.smileSSS').removeAttr('rel');
        Smile = $(this).attr('smile');
        Mood(Smile);
        $('#info').html(Smile);//---------------------------------------------
        $('.ErrWindow').hide();
        $('.hidden').hide();
        $('#blackScreen').show();
        var page_ID = $(this).attr("alt");
        $('#popup').fadeTo(200,1);
        $('#'+page_ID).delay(205).fadeTo(500,1);
    }) 

// Centerblock
    function CenterBlock(id){
    var H = 530;
    var top = Math.round(( $(window).height() - H)/2);
    $(id).css({ top: top+'px' });
}

// ADD Form info-window
   $('form').prepend('<div class="ErrWindow"></div>');
   
// FORMs validate ------------!!!!!!!!!!!!!!!!    
  
    function isValidEmail(email){
	   return( (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email));
    }
    function isValidName(name){
        return  (/^[а-яА-ЯёЁ \/s-]+$/).test(name);
    }
    function isValidPhoneNumber(number){
        return  (/^[0-9+()-]+$/).test(number);
    }
    function empty(string){ if ((!string) || (string='')){ return true }else{ return false } }
    var ALL_ERROR = '';
    var errW_
   	var err_NoName = 'Вы забыли представиться.<br />';
    var err_WrongName = 'Очень странное имя...<br />';
    var err_NoPhone = 'Вы не указали номер телефона.<br />';
    var err_WrongPhone = 'Странные символы в номере телефона.<br />';
    var err_NoEmail = 'Укажите E-mail, иначе как мы с вами свяжемся?<br />';
    var err_IncorrectEmail = 'Вы ошиблись в написании E-mail.<br />';
    var err_NoMessage = 'Вы не оставили сообщения.<br />';
    var err_NoCompany = 'Вы не указали название своей Компании.<br />';
        
    function Validate(FormName,formData){
        var ERROR = '';
        switch(FormName){
            case 'Name':
                if(empty(formData)){ ERROR += err_NoName }else if(!isValidName(formData)) ERROR += err_WrongName; 
            break;
            case 'Email':
                if(empty(formData)){
                    ERROR += err_NoEmail;
                    }else if(!isValidEmail(formData)) ERROR += err_IncorrectEmail;
            break;   
            case 'PhoneNumber':
                if(empty(formData)){
                    ERROR += err_NoPhone;
                    }else{ if (!isValidPhoneNumber(formData)){ ERROR += err_WrongPhone;}}
            break;
            case 'Message':
                if(empty(formData)){ ERROR += err_NoMessage }            
            break;
            case 'Company':
                if(empty(formData)){ ERROR += err_NoCompany }
            break;
        }
        return ERROR;
    } 
// Form autoComplete

    $('input, textarea').change(function(){
        form_ID = $(this).closest('form').attr('id');
        form_Name = $(this).attr('name');
        form_Data = $(this).val();
        ERROR = Validate(form_Name,form_Data);
        if (ERROR==''){
            $('input[name='+form_Name+']').val(form_Data);// ОШИБКА однако...
        }else{
            $('#'+form_ID+' .ErrWindow').stop().fadeTo(200,1).html(ERROR).delay(3000).fadeTo(500,0);// Всё гуд :)
        }
    })
    
// TEST FORM -------------------------------------------------

$('.ErrWindow').click(function(){ $(this).stop().fadeTo(500,0); })// Закрытие окна ОШИБКА по нажатию

function TestForm(id){  
    
    ALL_ERROR = '';
    $('#'+id+' :input').each(function(){
        var name = $(this).attr('name');
        var value = $(this).val();
        ERROR = Validate(name,value);
        ALL_ERROR += ERROR;
    })
    if (ALL_ERROR==''){ return true }else{
        $('#'+id+' .ErrWindow').stop().fadeTo(500,1).html(ALL_ERROR);//окно с ошибками
        return false
    }
        
}
    $('.SUBMIT').click(function(){
        
        if(strategyNum == 1) Strategy = 'Наблюдатель';
        if(strategyNum == 2) Strategy = 'Переговорщик';
        if(strategyNum == 3) Strategy = 'Завоеватель';
        if(strategyNum == 4) Strategy = 'Защитник бренда';
        
        $('.ErrWindow').hide();
        var idForm = $(this).closest('form').attr('id');
        flag = TestForm(idForm);
        if (!flag){ 
            //$('#'+idForm+' .ErrWindow').stop().fadeTo(500,1).html('<b>ФОРМА НЕ ЗАПОЛНЕНА</b>');// ОШИБОЧКА НАХ!!!!
        }else{
            send_arr = $('#'+idForm).serialize();
            //Switcher=='Yes' ? NewidForm = Smile : NewidForm = idForm;
            send_arr += '&Form='+idForm+'&Strategy='+Strategy+'&Smile='+Smile;
            $.ajax({ url: "/ajax/callback.php", type: "POST", data: send_arr, success: function(result){
                 $('#'+idForm).html(result);
                 } 
            });
        }
    })

    
})// End of $(function){}
