<div class="wrapper">
  <?php /*
	<div class="row marTop40 kassa-logo">
		<div class="col-col-xs-6 col-sm-4 col-md-2">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-kassa-6.png" alt="">      
		</div>
    <div class="col-col-xs-6 col-sm-4 col-md-2">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-kassa-5.png" alt="">
		</div>
		<div class="col-col-xs-6 col-sm-4 col-md-2">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-kassa-mir.png" alt="">
		</div>		
		<div class="col-col-xs-6 col-sm-4 col-md-2">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-kassa-3.png" alt="">
		</div>
		<div class="col-col-xs-6 col-sm-4 col-md-2">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-kassa-2.png" alt="">
		</div>
		<div class="col-col-xs-6 col-sm-4 col-md-2">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-kassa-1.png" alt="">
		</div>
	</div>*/?>
	<div class="row marTop40">
    <div class="col-xs-12 col-sm-6 col-md-6">
			<ol>
				<li>В поле "Сумма" заполните сумму, указанную в Cчете на оплату, который Вам прислал ответственный менеджер.</li>
				<li>В поле "Номер Счета на оплату" обязательно укажите номер Счета на оплату, который Вам прислал отвественный менеджер. </li>
				<li>Нажмите кнопку "Оплатить", после этого Вы перейдете на защищенную страницу, с подробными инструкциями по совершению платежа.</li>
			</ol>
    </div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<form name="ShopForm" method="POST" action="https://belmarco.server.paykeeper.ru/create" class="kassa-forma">
				<div class="sposoboplat">
					<div class="title-faq">Способ оплаты:</div>
					<label>
						<input name="paymentType" value="AC" type="radio" checked /> Оплата банковской картой
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/accept-payment.png" alt="" style="max-height:20px;" />
					</label>
				</div>
        <input type="hidden" name="service_name" value="Электронная касса"/>
				<p><input type="text" name="sum" placeholder="Сумма" required class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control"></p>
				<p><input type="text" name="orderid" placeholder="Номер Счета на оплату" pattern=".{1,6}" required class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control"></p>
				<input value="Оплатить" class="wpcf7-form-control wpcf7-submit button" type="submit">
			</form>
    </div>
	</div>
</div><!--/.advantages_wrap-->


	