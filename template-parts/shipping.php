<?php
/**
 * Template part for displaying Доставка и оплата.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package belmarco
 */

?>

<article id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();
		?>
    <div class="container">
    <div id="breadcrumbs"><span><span typeof="v:Breadcrumb"><a href="http://new.belmarco.ru/" rel="v:url" property="v:title">Бельмарко</a> → <span class="breadcrumb_last">Кровати</span></span></span></div>
	<h2 class="fs30 text-uppercase">Доставка</h2>
       <div class="row">
       	<div class="col-md-7 col-lg-6 hidden-sm hidden-xs">
        	<img src="img/shipping-1.png" class="img-responsive center-block hidden-md">
        	<img src="img/shipping-2.png" class="img-responsive center-block hidden-lg">
        </div>
       
       	<div class="col-md-5 col-lg-6 column_2">
            <div class="section_1"><p>Мы находимся в г. Ульяновске, доставку осуществляем с помощью <b>транспортных компаний</b> по всей России. Работаем с любыми транспортными компаниями DPD, СДЭК, ПЭК, КИТ, Деловые линии и др.</p>
            <ul class="delivery_comp">
                <li><img src="img/dpd.png"></li>
                <li><img src="img/cdek.png"></li>
                <li><img src="img/mak.png"></li>
                <li><img src="img/kit.png"></li>
                <li><img src="img/dl.png"></li>
            </ul>
            <p>Выбор компании происходит на основании удобства для клиента. При оформлении заказа, менеджер рассчитает Вам <b>наиболее удобный способ доставки</b> и озвучит название транспортной компании. Если у Вас есть какие-то предпочтения, Вы можете выбрать конкретную ТК.</p>
            </div><!--/.section_1-->
            
            <div class="section_2"><p><b>Срок доставки</b> зависит от удаленности Вашего города. При оформлении заказа менеджер назовет Вам примерное количество дней.</p></div><!--/.section_2-->
            
            <div class="section_3"><p>Доставку можно оформить <b>до подъезда</b></p></div><!--/.section_3-->
            
            <div class="section_4"><p> или <b>до терминала транспортной компании</b> (если такой имеется в вашем городе). 
  Вы сможете забрать кроватку на легковой машине, т.к. при опущенных задних сидениях кроватка в разобранном виде легко помещается в машине. Это позволяет существенно сэкономить на доставке.</p></div><!--/.section_4-->
			</div>
		</div><!--/.row-->
  		<div class="section_5">
            <div class="row">
       			<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
           		<div><b>При получении груза необходимо руководствоваться следующей инструкцией:</b></div>       
                <ol>
                    <li>Внимательно проверить количество мест</li>
                    <li>Внимательно проверить коробку на наличие повреждений</li>
                </ol>
            	</div>
        	</div><!--/.row-->
		</div>
        
        <!-- Оплата -->
        <h2 class="fs30 text-uppercase">Оплата</h2>
        <h3 class="h3 var"><span class="fs20">Варианты оплаты</span></h3>
        <div class="row">
        	<div class="col-sm-6 col-md-5">
            	<h3 class="h3 var_1"><span class="fs20">Наложенный платёж</span></h3>
            <div class="section_6"><p>При оформлении заказа наш менеджер проконсультирует Вас и скажет, есть ли услуга наложенного платежа в Вашем городе. В этом случае оформляется доставка и сумму за сам заказ и доставку Вы <b>оплачиваете уже при получении</b>.</p></div>
            </div>
            <div class="col-md-2"></div>
        	<div class="col-sm-6 col-md-5">
            	<h3 class="h3 var_2"><span class="fs20">Предоплата</span></h3>
                <div class="section_7"><p>В случае, если оплата наложенным платежом в Вашем населенном пункте не осуществляется, то мы выставляем Вам <b>официальный счет-договор</b> с условиями доставки и оплаты, с нашими реквизитами, подписью и синей печатью.</p></div>
                
                <div class="section_8"><p>Вы можете оплатить данный счет-договор либо через <b>кассу любого банка</b>, либо через <b>электронную кассу</b> нашей организации.</p>
                <p>Электронная касса расположена на сайте, в разделе оплата. Там присутствуют подробные инструкции по совершению платежа.</p></div>
                <div class="section_9"><p>После поступления денежных средств происходит <b>отгрузка заказа</b>.</p></div>
                <div class="section_10"><p>Вне зависимости от способа совершения платежа, денежные средства поступают на наш расчетный счет, что позволяет гарантировать их <b>безопасность</b>. Безопасность платежей через электронную кассу поддерживает компания Яндекс.</p></div>          
            </div>
        
        </div><!--/.row-->
        <div class="section_11">
            <div class="row">
       			<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
           			<p><b>Доставка оплачивается отдельно при получении представителю транспортной компании.</b></p>
            	</div>
        	</div><!--/.row-->
		</div>
        
        <!--Рассрочка-->
        	<h2 class="fs30 text-uppercase">Рассрочка</h2>
        	<div class="row">
        		<div class="col-xs-8 col-sm-6 col-sm-offset-2 pay_0"><p>Наша компания сотрудничает с сервисом доверительной оплаты <b>PayLate</b></p></div>
        		<div class="col-xs-4 col-sm-4 pay_0"><img src="img/pay.png" class="pay_sys center-block"></div>  
        	</div><!--/.row-->
        	<div class="row">                
            	<div class="col-sm-8 col-sm-offset-2">
                	<div class="marTop40"><p><b>Это технологичный и удобный сервис онлайн-оплаты товаров и услуг в рассрочку, позволяющий Вам совершать покупки в сети интернет, находясь дома или на работе, без поручителей и первоначального взноса, при этом не посещая торговые и финансовые организации. Рассрочку представляют на 4 месяца.</b></p></div>
                </div>     
        	</div><!--/.row-->
        	<div class="row">                
            	<div class="col-sm-8 col-sm-offset-2">
            		<h3 class="h3 fs20">Схема работы:</h3>
            		<div class="pay_1"><div><p>Мы формируем ваш заказ на сайте <b>PayLate</b></p></div></div>
            		<div class="pay_2"><div><p>Вам приходит смс со ссылкой на сайт, на котором Вы проходите <b>регистрацию</b>, заполняете анкету</p></div></div>
            		<div class="pay_3"><div><p>Если одобрено, то Вы <b>подтверждаете займ</b> с помощью СМС</p></div></div>
            		<div class="pay_4"><div><p>И мы делаем <b>отправку</b> вашего груза</p></div></div>
            		<div class="pay_5"><div><p>Сумма заказа при оформлении рассрочки на сайте делится на <b>12 месяцев</b>. Если вы оплачиваете в течение 4-х месяцев свой заказ, то <b>% не взимается</b>.</p></div></div>
                    </div>
            </div><!--/.row-->
            
            <div class="row">
            	<div class="col-sm-8 col-sm-offset-2 text-center marTop50"><p>При положительном решении на почту приходит информация по займу, где будет указана сумма займа, срок льготного периода и график ежемесячных платежей. </p></div>
            </div><!--/.row-->
        
    	</div><!-- /.container -->
	</div><!--/.entry-content-->
</article><!--/#post-##-->
