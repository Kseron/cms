<div class="contacterGM">
    <div class="chentryak lepota">
        <div class="gdeCho">
			<p style="font-size:24px">Гипсокартон - наш материал! <br /> Контактная информация:</p>
			<p>Якийсь новий текст</p>
			<p style="color:#FFFFFF;">Все контактные данные, переданные нам,<br/> останутся строго конфиденциальными.</p>
		</div>
        <div id="form">  
        <form method="POST" action="#" enctype="multipart/form-data" name="addcom" id="addcom" class="formula" onSubmit="return false">
            <p style="font-size:24px">Форма для связи:</p>
            <div class="field">
                <div class="zdesi">
                    Имя:  <div class="tuttext">
                     
                   <input  name="name" id="name" type="text" title="Введите имя" class="inputText inputGMtext required" >
                    </div>
                </div>
            </div>
             <div class="field">
                <div class="zdesi">
                    Телефон:  <div class="tuttext">
                     <input  name="phone" id="phone" title="Введите e-mail" type="text" class="inputText inputGMtext required email">
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="zdesi">
                  Е-MAIL:  <div class="tuttext">
                        <input  name="email" id="email" title="Введите e-mail" type="text" class="inputText inputGMtext required email">
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="zdesi">
                 Сообщение:   <div class="tuttext">
                       <textarea id="msg" name='comtext' class="inputGMtext"></textarea>
                    </div>
                </div>
            </div>
            <div class="buttons">
                 <button type="button" name="button" value="Submit" onclick="doLoad(document.getElementById('addcom'))" >
                    <span class="buttuss buttuss_1">
                        <span class="vernyak">Отправить</span>
                    </span>
                </button>
            </div>
        </form>
        <div align='center' id='cerror'></div>

		Ще якийсь новий текст
        <!--<div class="feedGM">
        </div>
		-->
	</div>
    </div>
</div>


<? 
if($_SESSION['login'] != "")
{
	echo "<div>Привет, <b>".$_SESSION['login']."</b> <a href='/logout.html'>Выход</a></div>";
}
?>

<header>

<div class="shlypatut">
	<?
	if($pages->page_from_base["special_design"] == 1 AND file_exists("images/backgrounds/".$pages->page_from_base[id].".jpg"))
	{
		echo  "<div class='shlyapaNuzna' style='background:url(\"images/backgrounds/".$pages->page_from_base[id].".jpg\") 0 0 no-repeat;'></div>
		";
	}
	else
	{
		echo  "<div class='shlyapaNuzna'></div>
		";
	}
	?>
	<div class="chentryak">
        <a href="/"><img class="logomain" src="img/logo.png" alt="ГипсМонтаж.ru"/></a>
		<div class="telGmTop">
            <img class="call" src="img/tel.gif" alt="Телефон ГипсМонтаж"/> <span class="phone">8(495)542·66·88</span> <a class="moreLinkContacterGM muhasransk" href="#">Обратная связь</a>
		</div>
    </div>
    <div class="topGmMenu">
         <ul>
         <div class="menu-main-navigation-menu-container">
             <ul id="menu-main-navigation-menu" class="menu">
                    <li id="menu-glim" class="zdes-glim"><a href="/">Главная</a></li>         
                    <li id="menu-glim"><a href="stoimosti/"><span class="red">Стоимость работ</span></a></li>
                    <li id="menu-glim"><a href="gipsocarton_kak.html">Как мы работаем</a></li>
                    <li id="menu-glim"><a href="materialy.html">Материалы</a></li>
                    <li id="menu-glim"><a href="foto.html">Фотографии работ</a></li>
                    <li id="menu-glim"><a href="video/">Видео</a></li>
                    
             </ul>
         </div>	 <li class="right shlyaPa"><a href="zapros/">Контакты</a></li>	  
            
       </ul>
    </div>

</div>

</header>

