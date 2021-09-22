<?php
function phone_clean($phone){
	$phone= str_replace([' ', '(', ')', '-'], '', $phone);
	return $phone;
}
function phone_clean_bitrix($phone){
	$phone= str_replace([' ', '(', ')', '-', '+'], '', $phone);
	return $phone;
}
add_action('wp_ajax_load_more_comments', 'load_more_comments');
add_action('wp_ajax_nopriv_load_more_comments', 'load_more_comments');
function load_more_comments(){
	$args = array(
		'post_id'=>$_POST['post_id'],
		'number'=>$_POST['comments_per_page'],
    'meta_key'=>$_POST['meta_key'],
    'meta_value'=>$_POST['meta_value'],
		'offset'=>$_POST['page']*$_POST['comments_per_page']
	);
$comments = get_comments( $args );	
if ($comments) { ?>
	<div class="rev_list row">
<?php foreach( $comments as $comment ){?>
	<div class="rev_item col-xs-12">
        <div class="thumbnail">
            <div class="clearfix">
				<div class="img-responsive pull-left">
			<?php 
			  $attachmentId = get_comment_meta($comment->comment_ID, 'attachmentId', TRUE);
			  if(is_numeric($attachmentId) && !empty($attachmentId)){
          $url_img = wp_get_attachment_image_url($attachmentId, 'full');
				  echo '<a href="'.$url_img.'" class="fancybox">'.wp_get_attachment_image($attachmentId,'medium').'</a>';
				}else {
				  echo wp_get_attachment_image(5948,'thumbnail');/*Картинка-заглушка*/
				} 
			?>
			</div>
            <div class="rev_txt">
                <p><?php echo $comment->comment_content;?>
            </div>
        </div>
        <div class="rev_meta clear">
					<div class="row">
						<?php $author_url = $comment->comment_author_url; ?>
						<div class="col-xs-12">
							<b><?php echo $comment->comment_author; ?></b>									
						</div>						
					</div><!--/.row-->
				</div><!--/.rev_meta-->
    </div><!--/.thumbnails-->
</div>
<?php } ?>
</div>
<?php } ?>
<div class="clearfix"></div>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery('.img-responsive .fancybox').fancybox({});
  });
</script>
<?php wp_die();
}
function text_excerpt( $args = '' )
{
	$default = array( 'maxchar' => 100, 'text' => '', 'save_format' => false, 'more_text' => '', 'echo' => true, );
	//parse_str( $args, $_args );
	$args = array_merge( $default, $args );
	extract( $args );	
		
	if( ! $text ){
			return;
	}
	else {
			$text = strip_tags( $text, $save_format );
	}	
	
	// Обрезаем
	if ( mb_strlen( $text ) > $maxchar ){
		$text = mb_substr( $text, 0, $maxchar );
		$text = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ', $text ); // убираем последнее слово, оно 99% неполное
		$text = str_replace( "\n", '<br />', $text );
	}
	
	// Сохраняем переносы строк. Упрощенный аналог wpautop()
	if( $save_format ){
		$text = str_replace("\r", '', $text );
		$text = preg_replace("~\n\n+~", "</p><p>", $text );
		$text = str_replace ("\n", "<br />", trim( $text ) );
	}
	$text.=$more_text;
	if( $echo ) return print $text;
	return $text;
}
function wpcf7ev_skip_sending($components) {
	print_r($components);
    $components['send'] = false;

    return $components;
}

function belmarco_row ($atts, $shortcode_content = null){
	extract(shortcode_atts( array(
		'class' => '',
		'bg_img'=>'',
		'border'=>'',
	), $atts ));
	if ($bg_img){
		$style=' style="background:url('.$bg_img.') no-repeat;background-size:cover;padding:10px 52px 30px;"';
	}
	else {
		$style='';
	}
	if ($border=='yes') {
		$class=$class.' wt-border';
	}
	return '<div class="row '.$class.'"'.$style.'>'.do_shortcode($shortcode_content).'</div>';
}
add_shortcode('row','belmarco_row');
add_shortcode('inner-row','belmarco_row');
function belmarco_col($atts, $shortcode_content = null){
	extract(shortcode_atts( array(
		'class' => ''
	), $atts ));
	return '<div class="'.$class.'">'.do_shortcode($shortcode_content).'</div>';
}
add_shortcode('col','belmarco_col');
add_shortcode('inner-row','belmarco_row');

function belmarco_info_box($atts, $shortcode_content = null){
	extract(shortcode_atts( array(
		'class' => '',
		'img'	=> '',
		'title' => '',
	), $atts )); 
	ob_start();?>
	<img src="<?php echo $img; ?>" class="center-block img-responsive <?php echo $class; ?>">
	<?php if ($title != '') {?>
    <div class="title_box"><?php echo $title; ?></div>
	<?php } ?>	
    <div class="descr_box text-center"><?php echo do_shortcode($shortcode_content); ?></div>
	<?php $html=ob_get_clean();
	return $html;
}
add_shortcode('info-box','belmarco_info_box');

/* Thumbnails */
function belmarco_thumbnails_box($atts, $shortcode_content = null){
	extract(shortcode_atts( array(
		'class' => '',
		'title' => '',
		'sub_title' => '',
	), $atts )); 
	ob_start();?>
	<div class="thumbnail result text-center">
    <div class="c_7ca224 title"><span><?php echo $title; ?></span><b><?php echo $sub_title; ?></b></div>
    <div class="result-txt"><?php echo do_shortcode($shortcode_content); ?></div>
	</div>
	<?php $html=ob_get_clean();
	return $html;
}
add_shortcode('thumbnails-box','belmarco_thumbnails_box');

function belmarco_section_header($atts, $shortcode_content = null){
	extract(shortcode_atts( array(
		'class' => '',
		'sub_title' => '',
	), $atts ));
	return '<div class="'.$class.'">'.do_shortcode($shortcode_content, $ignore_html = false).'<div class="sub_title">'.$sub_title.'</div></div>';
}
add_shortcode('section_header','belmarco_section_header');

/* Блок с фоновой картинкой, рамкой */
function belmarco_box_bg($atts, $shortcode_content = null){
	extract(shortcode_atts( array(
		'img'	 => '',
		'border' => '',
		'class'  => '',
	), $atts ));
	ob_start(); ?>
	<div style="background:url('<?php echo $img; ?>') no-repeat; background-size:cover;" class="<?php echo $class; ?> block_bg">
	<?php if ($border == 'yes') {?>
		<div class="brd_inn">
		<?php echo do_shortcode($shortcode_content); ?>
		</div><!--/.brd_inn-->
	<?php } else { echo do_shortcode($shortcode_content); }?>

	</div><!--/.block_bg-->
	<?php $html=ob_get_clean();
	return $html;		
}
add_shortcode('section','belmarco_box_bg');

/* Блок с рамкой без фона */
function belmarco_box_brd($atts, $shortcode_content = null){
	extract(shortcode_atts( array(
		'img'	 => '',
	), $atts ));
	ob_start(); ?>
	<div class="block_style_1 clearfix">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-img hidden-xxs"><img class="img-responsive mrg10 aligncenter wp-image-2306 size-full" src="<?php echo $img; ?>" alt=""></div>
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xxs">
			<?php echo do_shortcode($shortcode_content); ?>
			</div>
		</div><!--/.row-->
    </div><!--/.block_style_1-->
	<?php $html=ob_get_clean();
	return $html;		
}
add_shortcode('section_2','belmarco_box_brd');

/* Кнопка-ссылка */
function belmarco_button($atts, $shortcode_content = null){
	extract(shortcode_atts( array(
		'title' => '',
		'url' => ''
	), $atts ));
	ob_start(); ?>
	<div class="info_catalog">
	<div class="title"><?php echo $title; ?></div>
	<?php echo '<a href="'.$url.'" class="a_button">'.do_shortcode($shortcode_content, $ignore_html = false).'</a>';?></div><!--/.info-catalog-->
	<?php $html=ob_get_clean();
	return $html;
}
add_shortcode('button','belmarco_button');


function belmarco_hits($atts, $shortcode_content = null){
		$args=array(
			'post_type'=>'product',
			'posts_per_page'=>6,
			'product_tag'=>'hit',
		);
		$products=new WP_Query( $args );
		$class[]='owl-carousel';
		$class[]='products';
		$class[]='full-layout';
		?>
		<?php if ( $products->have_posts() ) { 
		ob_start();
		?>
		<div id="bestsellers" class="woocommerce">
		<div class="hp">Хиты продаж</div>
		
		<?php woocommerce_product_loop_start(); ?>
		<div class="<?php echo esc_attr( implode(' ', $class) );?>">
					
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>
						
							<?php wc_get_template_part( 'content', 'product' ); ?>
						
						<?php endwhile; // end of the loop. ?>
						<?php wp_reset_postdata(); ?>	
		</div>
		<?php woocommerce_product_loop_end(); ?>
		</div>
		<?php 
		$html=ob_get_clean();
		return $html;
		} 
}
add_shortcode('section_hits','belmarco_hits');
function belmarco_testimonials($atts){
		$args = array(
		'status' =>'approve',
		'number'=>'10',
		'order_by'=>'comment_date',
		);

		$comments = get_comments( $args );
		?>
		<?php if ($comments) { 
		ob_start();
		?>
		
		<div class="owl-carousel comments">
						<?php foreach( $comments as $comment ){ ?>
                	<div class="left-block rev-item">
						<div class="thumbnail">
							<?php 
							$attachmentId = get_comment_meta($comment->comment_ID, 'attachmentId', TRUE);
							if(is_numeric($attachmentId) && !empty($attachmentId)){
								echo wp_get_attachment_image($attachmentId,'medium');
							}else {
								echo wp_get_attachment_image(191,'thumbnail');
							} /*Надо заменить картинкой-заглушкой*/
							?>
						</div>
					</div><!--/.thumbnails-->
					<div class="right-block">
							<div class="rev_txt">
                        		<p><?php 
								$args = array( 
									'maxchar' => 100, 
									'text' => $comment->comment_content,
									'save_format' => false,
									'more_text' => '',
									'echo' => false, 
								);
								echo text_excerpt( $args).'...';?>
								</p>
                        	</div>
                        	<div class="rev_meta clear">
                        		<div class="row">
                                
                                	<div class="col-xs-12"><b><?php echo $comment->comment_author; ?></b><a href="<?php echo $comment->comment_author_url; ?>" class="vk" title="Мы в Вконтакте" target="_blank"></a></div>
                                    <div class="col-xs-12 text-right"></div>
                                </div><!--/.row-->
                        	</div><!--/.rev_meta-->
                    </div>
						
							<?php //wc_get_template_part( 'content', 'testim_item' ); ?>
						
						<?php } ?>
		</div>
		<?php 
		$html=ob_get_clean();
		return $html;
		}

}
add_shortcode('testimonials_carousel','belmarco_testimonials');

function dateToRussian($date) {
    $month = array("january"=>"января", "february"=>"февраля", "march"=>"марта", "april"=>"апреля", "may"=>"мая", "june"=>"июня", "july"=>"июля", "august"=>"августа", "september"=>"сентября", "october"=>"октября", "november"=>"ноября", "december"=>"декабря");
    $days = array("monday"=>"Понедельник", "tuesday"=>"Вторник", "wednesday"=>"Среда", "thursday"=>"Четверг", "friday"=>"Пятница", "saturday"=>"Суббота", "sunday"=>"Воскресенье");
    return str_replace(array_merge(array_keys($month), array_keys($days)), array_merge($month, $days), strtolower($date));
}
function belmarco_today(){
	return dateToRussian(current_time('j F'));
}
add_shortcode('today','belmarco_today');

add_filter( 'wpcf7_form_elements', 'do_shortcode' );

add_action('wp_ajax_sms_sending', 'sms_sending');
add_action('wp_ajax_nopriv_sms_sending', 'sms_sending');
function sms_sending(){
	if (isset($_POST['phone'])&&isset($_POST['otp_code'])){
		$number = $_POST['phone'];
		$otp_code=$_POST['otp_code'];
		$number = substr(phone_clean($number),1);//удаляем "+" перед номером

		$sms = "Ваш код: ".$otp_code.". Оформите заказ в течение 5 дней. Спасибо.";

		$body = file_get_contents("http://sms.ru/sms/send?api_id=6d4ca4a2-f7fb-c544-c1f5-ba312c880ce7&to=".$number."&text=".urlencode(iconv('utf-8','windows-1251',$sms)));
	}
	echo "Ответ sms-сервиса: ".$body;
	wp_die();
}
function cf7_send2Bitrix24($wpcf7)
{
	// При обработке хуков CF7 ОБЯЗАТЕЛЬНО делаем все в блоке try catch, иначе ломаются все формы!
	try
	{
		$submission = WPCF7_Submission::get_instance();
		$posted_data = $submission->get_posted_data();
		if ($wpcf7->id=='2338'){
			$mail = $wpcf7->prop( 'mail' );
			$mail['subject'] = 'Заявка на вакансию '.$wpcf7->title;
			$wpcf7->set_properties( array( 'mail' => $mail ) ); 		
		}
		/*GET PHONE*/
		//$tel = $posted_data["tel-75"];
		$tel = "";
		$list_fields = "tel-75;tel-670;tel-990;tel-210;tel-274;tel-954;tel-87;tel-160;tel-133";
		foreach ($posted_data as $key => $value)
		{
		  if ( strpos( $list_fields, $key ) !== false )
		  {
		      $tel = $value;
		      break;                   
		  }
		}
		/***********/
		/*GET COMMENT*/
		if(isset($_POST["textarea-685"]))
			$comment = $_POST["textarea-685"];
		if(isset($_POST["text-111"]))
			$comment = $_POST["text-111"];
		if(isset($_POST["text-859"]))
			$comment = $_POST["text-859"];
		/*GET TITLE LID*/
		$title_lid = urlencode('new.belmarco.ru');
		if(isset($_POST["title_lid"]))
			$title_lid = $_POST["title_lid"];
		/*************/
		//$props = $form->get_properties();
		$param=array();
		$param['login'] = 'belmarcodir@yandex.ru';
		$param['password'] = 'goodweb';
		$param['title'] = $title_lid;
		$param['name'] 	= urlencode($posted_data['name']);
		$param['phone'] = $tel;
		date_default_timezone_set('Etc/GMT-4');
		$param['time'] = urlencode(date('H:i:s', time()));
		$param['product-title'] = urlencode($posted_data['dynamichidden-426']).urlencode($posted_data['dynamichidden-698']).urlencode($posted_data['dynamichidden-256']);
		if(preg_match("/^[-0-9a-z\._]+\@[-0-9a-z\.]+\.[a-z]{2,8}$/i", $posted_data['email'])) {
			$param['email'] = urlencode($posted_data['email']);
		} else {
			$param['email'] = false;
		}
		if ($posted_data['dealers-radio']) {
			$src=urlencode('Клиент написал о себе: "' . $posted_data['dealers-radio'] . '"');
		} else {
			$src='';
		}
		if ($posted_data['message']) {
			$msg=urlencode('Текст сообщения: "' . $posted_data['message'] . '"' );
		} else {
			$msg='';
		}
		
		// Google Analytics CID
		$cid= '';
		if ( isset($_COOKIE["_ga"]) ) 
		{
			$cid1='';
			$cid2='';
			//list($version,$domainDepth, $cid1, $cid2) = split('[\.]', $_COOKIE["_ga"],4);
			//$cid = $cid1.".".$cid2;	
			$cid= $_COOKIE["_ga"];
		}

		$param['source'] = urlencode($wpcf7->title) . $src . $msg;
		
		// UTM
		// Вообще это неправильно! Их надо читать НА ПЕРВОЙ СТРАНИЦЕ СЕССИИ и сохранять в сессию.
		$utm_str = parse_url($_SERVER["HTTP_REFERER"], PHP_URL_QUERY);
		parse_str($utm_str, $utm_test);

		$utm_source 	= $utm_test['utm_source'];
		$utm_medium 	= $utm_test['utm_medium'];
		$utm_campaign 	= $utm_test['utm_campaign'];
		$utm_term 		= $utm_test['utm_term'];
		$utm_content 	= $utm_test['utm_content'];
		//$utm_region 	= $utm_test['region_name'];
		$utm_region = $_REQUEST['utm_region'];
		/*
			?utm_source=yandex
			&utm_medium=cpc
			&utm_campaign=cid|27451085|search
			&utm_content=gid|2677259110|aid|4214914227|9790480025_
			&utm_term=растущий%20стул%20купить
			&pm_source=none
			&pm_block=premium
			&pm_position=1
			&region=195
			&region_name=Ульяновск
			&yclid=3407204390828247590
		*/

		$source_description = $param['source'].' '.$param['product-title'];
		if(isset($_REQUEST['source_description'])){
			$source_description = $_REQUEST['source_description'];
		}

		$url_params_bitrix = 'https://belmarko.bitrix24.ru/crm/configs/import/lead.php?LOGIN='.$param['login']
			.'&PASSWORD='.$param['password']
			.'&TITLE='.$param['title']
			.'&NAME='.$param['name']
			.'&PHONE_MOBILE='.$param['phone']
			.'&SOURCE_DESCRIPTION='.$source_description
			.'&UF_CRM_1421648024='.$param['time']
			.($param['email'] ? '&EMAIL_WORK='.$param['email'] : '')
			.'&UF_CRM_1459178064='.$_REQUEST['UF_CRM_1459178064']
			.'&UF_CRM_1442411317='.$utm_source
			.'&UF_CRM_1442411342='.$utm_medium
			.'&UF_CRM_1442411352='.$utm_campaign
			.'&UF_CRM_1442411363='.$utm_content
			.'&UF_CRM_1442411413='.$utm_term
			.'&UF_CRM_1452845894='.$cid
			.'&UF_CRM_1490857782=false'
			.'&UF_CRM_1490857935=0'
			.'&UF_CRM_1490857988=false'
			.'&UF_CRM_1458737464='.$utm_region
			.'&COMMENTS='.$comment
			/*.'&UF_CRM_1442411317='.$_SESSION['utm_source']
			.'&UF_CRM_1442411342='.$_SESSION['utm_medium']
			.'&UF_CRM_1442411352='.$_SESSION['utm_campaign']
			.'&UF_CRM_1442411363='.$_SESSION['utm_content']
			.'&UF_CRM_1442411413='.$_SESSION['utm_term']*/		
		;	
		
		// Пишем лог
		file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/../logs/cf7_send2Bitrix24-send.log', $url_params_bitrix . PHP_EOL . PHP_EOL, FILE_APPEND );		
		
		// По-хорошему бы использовать функцию wp_remote_get()
		$r = file_get_contents( $url_params_bitrix );	
	}
	catch ( Exception $e )
	{
		// Была ошибка!
		file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/../logs/cf7_send2Bitrix24-error.log', $e->getMessage() . PHP_EOL . PHP_EOL, FILE_APPEND );
	}
	return true;
}
add_action('wpcf7_before_send_mail', 'cf7_send2Bitrix24');
function woo_send2Bitrix24($order_id){
	try
	{
	$param=array();
	$param['login'] = 'belmarcodir@yandex.ru';
	$param['password'] = 'goodweb';
	$param['title'] = urlencode('new.belmarco.ru - Новый заказ');
	
	
	$order = wc_get_order( $order_id );
	$items = $order->get_items();
	$param['product-title']='Товары:';
	$comment = 'Количества товаров: ';
	foreach ( $items as $item ) {
		$current_item = $item->get_data();
		$param['product-title'] = ' '.$param['product-title'].$current_item['name'].', ';
		$comment .= $current_item['name'].':'.$current_item['quantity'].' ШТ,';
	}
	$param['name'] 	= $order->billing_first_name.' '.$order->billing_last_name;
	$param['phone'] = phone_clean_bitrix($order->billing_phone);
	date_default_timezone_set('Etc/GMT-4');
	$param['time'] = urlencode(date('H:i:s', time()));
	$param['email'] = $order->billing_email;
	$param['city'] = $order->billing_city;
	$param['payment_method']= $order->get_payment_method();
	$param['payment_method_title']=$order->get_payment_method_title();
	if ($param['payment_method_']=='kassa'&&$order->is_paid()) {
		$param['paid'] = ' Заказ оплачен.';
	} else {
		$param['paid'] = ' Заказ неоплачен.';
	}
	$param['source'] = 'Заказ №'.$order_id.' от '.$order->get_formatted_billing_address();
	$r = file_get_contents('https://belmarko.bitrix24.ru/crm/configs/import/lead.php?LOGIN='.$param['login']
		.'&PASSWORD='.$param['password']
		.'&TITLE='.$param['title']
		.'&NAME='.$param['name']
		.'&PHONE_WORK='.$param['phone']
		.'&SOURCE_DESCRIPTION='.$param['source'].$param['product-title']
		.'&UF_CRM_1421648024='.$param['time']
		.'&UF_CRM_1453122762='.$param['city']
		.($param['email'] ? '&EMAIL_WORK='.$param['email'] : '')
		.'&UF_CRM_1459178064='.$_REQUEST['UF_CRM_1459178064']
		.'&UF_CRM_1496924824='.$param['payment_method_title']
		.'&UF_CRM_1496924848='.$param['paid']
		.'&UF_CRM_1490857782=false'
		.'&UF_CRM_1490857935=0'
		.'&UF_CRM_1490857988=false'
		.'&COMMENTS='.$comment
	);
	}
	catch ( Exception $e )
	{
		// Была ошибка!
		file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/../logs/cf7_send2Bitrix24-error.log', $e->getMessage() . PHP_EOL . PHP_EOL, FILE_APPEND );
	}
	return true;	
}
function woo_pan_test($order_id){
	$order = wc_get_order( $order_id );
	$items = $order->get_items();

	echo "<pre>";
	foreach ($items as $value) {
		$curent_item = $value->get_data();
		print_r($value->get_data());
		echo $curent_item["name"].": ".$curent_item["quantity"];
	}
	echo"</pre>";
}
add_action( 'woocommerce_thankyou', 'woo_send2Bitrix24',15 );

add_action( 'woocommerce_order_status_changed', 'paid_notification',10,3);
function paid_notification($order_id, $from, $to) {
		//if ($param['payment_method']='cod') return; - С этим кодом функция никогда не будет выполняться!
		try
		{
		// Google Analytics CID
		$cid= '';
		if ( isset($_COOKIE["_ga"]) ) 
		{
			$cid1='';
			$cid2='';
			//list($version,$domainDepth, $cid1, $cid2) = split('[\.]', $_COOKIE["_ga"],4);
			//$cid = $cid1.".".$cid2;	
			$cid= $_COOKIE["_ga"];
		}

		$param=array();
		$param['login'] = 'belmarcodir@yandex.ru';
		$param['password'] = 'goodweb';
		$param['title'] = urlencode('new.belmarco.ru - Изменение статуса заказа');
		
		
		$order = wc_get_order( $order_id );
		$items = $order->get_items();
		$param['product-title']='Товары:';
		foreach ( $items as $item ) {
			$param['product-title'] = ' '.$param['product-title'].$item['name'].', ';	
		}
		$param['name'] 	= $order->billing_first_name.' '.$order->billing_last_name;
		$param['phone'] = phone_clean_bitrix($order->billing_phone);
		date_default_timezone_set('Etc/GMT-4');
		$param['time'] = urlencode(date('H:i:s', time()));
		$param['email'] = $order->billing_email;
		$param['city'] = $order->billing_city;
		$param['payment_method']= $order->get_payment_method();
		$param['payment_method_title']=$order->get_payment_method_title();
		if ($to!="processing") {
			$param['paid'] = ' Заказ неоплачен.';
		} else {
			$param['paid'] = ' Заказ оплачен.';
		}
		$param['source'] = 'Заказа №'.$order_id.' от '.$order->get_formatted_billing_address();
		$r = file_get_contents('https://belmarko.bitrix24.ru/crm/configs/import/lead.php?LOGIN='.$param['login']
			.'&PASSWORD='.$param['password']
			.'&TITLE='.$param['title']
			.'&NAME='.$param['name']
			.'&PHONE_WORK='.$param['phone']
			.'&SOURCE_DESCRIPTION='.$param['source'].$param['product-title']
			.'&UF_CRM_1421648024='.$param['time']
			.'&UF_CRM_1453122762='.$param['city']
			.($param['email'] ? '&EMAIL_WORK='.$param['email'] : '')
			.'&UF_CRM_1459178064='.$_REQUEST['UF_CRM_1459178064']
			.'&UF_CRM_1496924824='.$param['payment_method_title']
			.'&UF_CRM_1496924848='.$param['paid']
			.'&UF_CRM_1490857782=false'
			.'&UF_CRM_1490857935=0'
			.'&UF_CRM_1490857988=false'
			.'&cid='.$cid
		);
		}
		catch ( Exception $e )
		{
			// Была ошибка!
			file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/../logs/cf7_send2Bitrix24-error.log', $e->getMessage() . PHP_EOL . PHP_EOL, FILE_APPEND );
		}
}
/*MODERN XOO_QV*/
remove_action( 'xoo-qv-summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'xoo-qv-summary', 'woocommerce_template_single_add_to_cart', 25 );
remove_action( 'xoo-qv-summary', 'woocommerce_template_single_meta', 30 );
remove_action( 'xoo-qv-images', 'woocommerce_show_product_sale_flash', 10);
remove_action( 'xoo-qv-images', 'xoo_qv_product_image', 20);
remove_action( 'xoo_qv_after_product_image', 'xoo_qv_product_thumbnails', 5);

function quick_view_image_product(){
  wc_get_template_part( 'xoo-qv-templates/product', 'image' );
}
add_action("xoo-qv-images", "quick_view_image_product");
function quick_view_thumbnails_product(){
  wc_get_template_part( 'xoo-qv-templates/product', 'thumbnails' );
}
add_action("xoo_qv_after_product_image", "quick_view_thumbnails_product");

function xoo_qv_add_script(){
  ?>
<script>
  jQuery('.xoo-qv-images .thumbnails.owl-carousel').owlCarousel({
	  loop:false,
    nav:true,
	  dots: false,
	  autoHeight: false,
    autoHeightClass: 'owl-height',
	  margin:10,
	  slideBy:1,
	  responsiveClass:true,
    responsive:{
        0:{
          items:1,
          nav:false,
          dots:true,
        },
        480: {
          items:2,
          nav:false,
          dots:true,
        },
        768:{
          items:3,
          nav:true,
        },
      }
  });
  jQuery('.xoo-qv-images .thumbnails img').on('click', function(){
    var link = jQuery('.xoo-qv-images .images a');
    var main_img = link.children('img');
    var src = jQuery(this).attr('src');
    var full_src = jQuery(this).attr('full_src');
    var srcset = jQuery(this).attr('srcset');
    link.attr('href', full_src);
    main_img.attr('src', src);
    main_img.attr('srcset', srcset);
  });
  jQuery('.xoo-qv-images .images a').fancybox();
  </script>
<?php
}
add_action("xoo-qv-images", "xoo_qv_add_script", 99);

function xoo_qv_div_btn_start(){
  echo '<div class="xoo-qv-btn">';
}
add_action( 'xoo-qv-summary', 'xoo_qv_div_btn_start', 24 );

add_action( 'xoo-qv-summary', 'woocommerce_template_loop_add_to_cart', 25 );
function pan_boc_wc_product(){
  global $product;
  echo '<div>'.do_shortcode('[boc_wc_single id="'.$product->get_ID().'" qty="1"]').'</div>';
}
add_action("xoo-qv-summary", "pan_boc_wc_product", 26);

function xoo_qv_div_btn_end(){
  echo '</div>';
}
add_action( 'xoo-qv-summary', 'xoo_qv_div_btn_end', 27 );

function pan_view_dimensions_product(){
	global $product;
  $default_arr = array('bed-size', 'razmery-sm', 'sleeping-place-size', 'pokrytie', 'material');
  if(get_field('attributes_xoo_qv', $product->get_id())){
    $attribute_array = get_field('attributes_xoo_qv', $product->get_id());
  }else{
    $attribute_array = $default_arr;
  }    
  echo '<p><b>В наличии</b></p>';
  foreach($attribute_array as $attr){
    $val = $product->get_attribute($attr);
    if($val){
      $name = wc_attribute_label('pa_'.$attr, $product);
      echo '<p><b>'.$name.':</b> '.$val.'</p>';
    }
  }
}
add_action("xoo-qv-summary", "pan_view_dimensions_product", 21);

/*function pan_view_attr_turbo_product(){
	echo "<p>Турбо отгрузка за 2 дня: <span style='font-weight:bold;' class='regionDelivery'></span></p>";
	?>
	<script>
		jQuery('.regionDelivery').text(regionDelivery);
	</script>
	<?php	
}
add_action("xoo-qv-summary", "pan_view_attr_turbo_product", 22);*/

function pan_add_tab_sertif( $tabs = array() ) {
	global $product, $post;
	/*
	$tabs['sertificates'] = array(
		'title'    => __( 'Гарантия качества', 'woocommerce' ),
		'priority' => 10,
		'callback' => 'pad_content_tab_sertif',
	);*/	return $tabs;
}
function pad_content_tab_sertif(){
	?>
	<div class="row">
		<div class="col-xs-12" style="margin-bottom:20px; margin-top: 20px;">
			<p style="line-height:30px; padding-left:30px;">Наша продукция соответствует всем отечественным и европейским стандартам качества в области экологии и охраны здоровья. Предлагаем Вам ознакомиться с нашими сертификатами:</p>
		</div>
		<div class="col-sm-2 col-sm-offset-1">
			<a href="https://belmarco.ru/wp-content/uploads/2017/04/Ekologicheskoe-sootvetstvie.jpg" class="sertif-fancybox"><img src="<?php bloginfo("template_url")?>/img/sertif-icon-1.png" alt="" class="img-responsive"></a>
		</div>
		<div class="col-sm-2">
			<a href="https://belmarco.ru/wp-content/uploads/2017/05/ISO.jpg" class="sertif-fancybox"><img src="<?php bloginfo("template_url")?>/img/sertif-icon-2.png" alt="" class="img-responsive"></a>
		</div>
		<div class="col-sm-2">
			<a href="https://belmarco.ru/wp-content/uploads/2017/05/EAC-1.jpg" class="sertif-fancybox"><img src="<?php bloginfo("template_url")?>/img/sertif-icon-3.png" alt="" class="img-responsive"></a>
		</div>
		<div class="col-sm-2">
			<a href="https://belmarco.ru/wp-content/uploads/2017/05/Gost-1.jpg" class="sertif-fancybox"><img src="<?php bloginfo("template_url")?>/img/sertif-icon-4.png" alt="" class="img-responsive"></a>
		</div>
		<div class="col-sm-2">
			<a href="https://belmarco.ru/wp-content/uploads/2017/05/diplom-1.jpg" class="sertif-fancybox"><img src="<?php bloginfo("template_url")?>/img/sertif-icon-5.png" alt="" class="img-responsive"></a>
		</div>
		<div class="col-xs-12" style="margin-bottom:20px; margin-top: 40px;">
			<p><span style="font-weight:bold;">Гарантия  1 год. </span>Распространяется на случаи заводского брака при правильной эксплуатации мебели.</p>
		</div>
	</div>
	<script>
		jQuery(document).ready(function(){
			jQuery('.sertif-fancybox').fancybox();
		});
	</script>
	<?php
}
add_filter( 'woocommerce_product_tabs', 'pan_add_tab_sertif', 100 );
function belmarco_remove_comment_fields($fields) {
if (is_singular()) {
	unset($fields['url']);
}
return $fields;
}
add_filter('comment_form_default_fields', 'belmarco_remove_comment_fields');
add_filter('excerpt_more', function($more) {
	return '...';
});
add_filter( 'the_content', 'belmarco_script_content', 20 );
function belmarco_script_content($content){
	if(is_page('checkout')){
		$content = $content.'<script>
			var lidObj = {
				title_lid: "Брошенная корзина",
				phone: ""
			}
			jQuery("a[href=\"#panel2\"]").click(function(){
				lidObj.title_lid = "Брошенная корзина - способ доставки";
			});
			jQuery(window).unload(function(){
				var targetHref = document.activeElement.href;
				lidObj.phone = jQuery("#billing_phone").val();
				if(lidObj.phone != ""){
					if(targetHref && targetHref.indexOf("belmarco.ru") != -1){
						lidObj.save_session = true;
					}
					jQuery.ajax({
				        type: "POST",
				        url: "'.get_bloginfo('template_url').'/inc/bitrix-ajax-controller.php",
				        async:false,
				        data: lidObj
				    });
				}
			    
			});
		</script>';
	}
	else{
		$content = $content.'<script>
			jQuery(window).unload(function(){
				var targetHref = document.activeElement.href;
				if(!targetHref || targetHref.indexOf("belmarco.ru") == -1){
					var lidObj = {send_session: true}
					jQuery.ajax({
				        type: "POST",
				        url: "'.get_bloginfo('template_url').'/inc/bitrix-ajax-controller.php",
				        async:false,
				        data: lidObj
				    });
				}
			});
		</script>';
	}
	return $content;
}
function belmarco_send_lids_filed_orders($order_id){
    $param=array();
    $param['login'] = 'belmarcodir@yandex.ru';
    $param['password'] = 'goodweb';
    $param['title'] = urlencode('Брошенная корзина - выбор способа оплаты');
    $order = wc_get_order( $order_id );
    $items = $order->get_items();
    $param['product-title']='Товары:';
    $comment = 'Количества товаров: ';
    foreach ( $items as $item ) {
        $current_item = $item->get_data();
        $param['product-title'] = ' '.$param['product-title'].$current_item['name'].', ';
        $comment .= $current_item['name'].':'.$current_item['quantity'].' ШТ,';
    }
    $param['name'] 	= $order->billing_first_name.' '.$order->billing_last_name;
    $param['phone'] = phone_clean_bitrix($order->billing_phone);
    date_default_timezone_set('Etc/GMT-4');
    $param['time'] = urlencode(date('H:i:s', time()));
    $param['email'] = $order->billing_email;
    $param['city'] = $order->billing_city;
    $cid= '';
    if ( isset($_COOKIE["_ga"]) )
    {
        $cid= $_COOKIE["_ga"];
    }
    $r = file_get_contents('https://belmarko.bitrix24.ru/crm/configs/import/lead.php?LOGIN='.$param['login']
        .'&PASSWORD='.$param['password']
        .'&TITLE='.$param['title']
        .'&NAME='.$param['name']
        .'&PHONE_WORK='.$param['phone']
        .'&SOURCE_DESCRIPTION='.$param['source'].$param['product-title']
        .'&UF_CRM_1421648024='.$param['time']
        .'&UF_CRM_1453122762='.$param['city']
        .($param['email'] ? '&EMAIL_WORK='.$param['email'] : '')
        .'&UF_CRM_1459178064='.$_REQUEST['UF_CRM_1459178064']
        .'&UF_CRM_1496924824='.$param['payment_method_title']
        .'&UF_CRM_1496924848='.$param['paid']
        .'&UF_CRM_1490857782=false'
        .'&UF_CRM_1490857935=0'
        .'&UF_CRM_1452845894='.$cid
        .'&UF_CRM_1490857988=false'
        .'&COMMENTS='.$comment
    );
}
add_action('woocommerce_order_status_cancelled', 'belmarco_send_lids_filed_orders');

/* Tags function */
function show_tags_page($arr_tags){
  if($arr_tags){
    echo '<div class="tags">';
    if(isset($_GET['tags'])){
      $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
      echo '<a href="'.$uri_parts[0].'">Все</a>'; 
    }
    foreach($arr_tags as $tag){
      $css = '';
      if(isset($_GET['tags']) && $_GET['tags'] == $tag){
        $css = 'select';
      }    
      echo '<a href="?tags='.$tag.'" class="'.$css.'">'.$tag.'</a>';
    }
    echo '</div>';
  } 
}
function show_tags_page_select($arr_tags){
  if($arr_tags){
    echo '<div class="tags">';
    if(isset($_GET['tags'])){
      $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
      echo '<a href="'.$uri_parts[0].'">Все</a>'; 
    }
    foreach($arr_tags as $tag){
      $css = '';
      if(isset($_GET['tags']) && $_GET['tags'] == $tag['value']){
        $css = 'select';
      }    
      echo '<a href="?tags='.$tag['value'].'" class="'.$css.'">'.$tag['label'].'</a>';
    }
    echo '</div>';
  } 
}
/* Видеоотзывы */
// Creating a Deals Custom Post Type
function videoreviews_custom_post_type() {
	$labels = array(
		'name'                => 'Видеоотзывы',
		'singular_name'       => 'Видеоотзыв',
		'menu_name'           => 'Видеоотзывы',
		'parent_item_colon'   => 'Родительский Видеоотзыв',
		'all_items'           => 'Все Видеоотзывы',
		'view_item'           => 'Посмотреть Видеоотзыв',
		'add_new_item'        => 'Добавить новый Видеоотзыв',
		'add_new'             => 'Добавить новый',
		'edit_item'           => 'Редактировать Видеоотзыв',
		'update_item'         => 'Обновить Видеоотзыв',
		'search_items'        => 'Поиск Видеоотзыва',
		'not_found'           => 'Не найдено',
		'not_found_in_trash'  => 'Не найдено в корзине'
	);
	$args = array(
		'label'               => 'Видеоотзывы',
		'description'         => 'Видеоотзывы покупателей',
		'labels'              => $labels,
		//'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields'),
    'supports'            => array( 'title', 'revisions'),
		'public'              => true,
		'hierarchical'        => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
    //'menu_position'       => 7,
    'menu_icon'           => 'dashicons-format-video',
		'has_archive'         => true,
		'can_export'          => true,
		'exclude_from_search' => false,
	  'yarpp_support'       => true,
		//'taxonomies' 	      => array('post_tag'),
		'publicly_queryable'  => true,
		'capability_type'     => 'page'
);
	register_post_type( 'videoreviews', $args );
}
add_action( 'init', 'videoreviews_custom_post_type', 0 );

add_action('wp_ajax_load_more_videoreviews', 'load_more_videoreviews');
add_action('wp_ajax_nopriv_load_more_videoreviews', 'load_more_videoreviews');
function load_more_videoreviews(){
	$args = array(
		'post_type' => 'videoreviews',
		'posts_per_page' => $_POST['posts_per_page'],
    'meta_key' => $_POST['meta_key'],
    'meta_value' => $_POST['meta_value'],
		'offset' => $_POST['page']*$_POST['posts_per_page']
	);
$video_posts = new WP_Query($args);
if($video_posts->have_posts()):?>
<div class="row">       
  <?php while($video_posts->have_posts()): $video_posts->the_post();?>
  <div class="col-md-6 col-xs-12 mb-20">
    <div class="item-video">
      <div class="youtube" id="video-review_<?php the_ID();?>" data-id="<?php the_field('url_video');?>" style="width: 100%;height: 100%;"><div class="play"></div></div>
    </div>
  </div>
  <?php endwhile;?>
</div>
<script>
  jQuery(function() {
    jQuery(".youtube").each(function() {
      var _this = jQuery(this);
      _this.css('background-image', 'url(http://i.ytimg.com/vi/' + _this.attr('data-id') + '/hqdefault.jpg)');
    });
  });
</script>
<?php endif; ?>
<div class="clearfix"></div>
<?php wp_die();
}

function custom_vk_widget($width){
  $html = '<div class="vk_widget">';
    $html .= '<div class="vkw_header">';
      $html .= '<div class="row">';
        $html .= '<div class="col-"<a href="https://vk.com/belmarco" target="_blank" rel="nofollow"><img src="https://sun7-2.userapi.com/c834203/v834203320/479c7/dTP0VXGprzU.jpg?ava=1" alt="Belmarco"/></a>';
        $html .= '<div class="vkw_name"><a href="https://vk.com/belmarco" target="_blank" rel="nofollow">БЕЛЬМАРКО ● ДЕТСКАЯ МЕБЕЛЬ</a></div>';
        $html .= '<div class="vkw_desc"><img class="emoji" src="https://vk.com/emoji/e/f09f8e81.png" alt="🎁">Каждый месяц розыгрыши сладких призов<img class="emoji" src="https://vk.com/emoji/e/f09f8e89.png" alt="🎉"> Вступай и участвуй!<img class="emoji" src="https://vk.com/emoji/e/f09f9889.png" alt="😉"></div>';
    $html .= '</div>';
  $html .= '</div>';
  return $html;
}
add_filter( 'me_param_name', 'custom_me_param_name', 10, 1);
function custom_me_param_name($name){
  $all_labels = wc_get_attribute_taxonomy_labels();
  $name = isset( $all_labels[ $name ] ) ? $all_labels[ $name ] : $name;
  return $name;
}

add_filter('me_param_unit', 'custom_me_param_unit', 10,	2);
function custom_me_param_unit( $status, $param_name){
  $cm_params = array('dlina', 'dlina-spalnogo-mesta', 'shirina', 'shirina-spalnogo-mesta', 'razmery-sm');
  if ( in_array($param_name, $cm_params) ) {
		$status = 'unit="см"';
	}  
	return $status;
}


/*13 11 19*/
/*
 * Вывод логотипа
 */
function custom_logo_block(){
  $html = '';
  if (is_front_page()) { 
    $html = '<img src="'.get_theme_mod('logo', '').'" class="header__logo">';
  } else { 
    if (is_tax( 'product_cat' )) {
      $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
      $alt_logo_img = get_field('alt_logo_img', 'product_cat_'.$term->term_id);
    }
    if (is_product()) {
      global $post;
      $id = $post->ID;
      $alt_logo_img = get_field('alt_logo_product', $id);
    }
    if ($alt_logo_img) { 
      $html = '<a class="header__logo" href="/" title="На Главную"><img src="'.$alt_logo_img.'" ></a>';
    } else {
      $html = '<a class="header__logo" href="/" title="На Главную"><img src="'.get_theme_mod('logo', '').'"></a>';
    } 
  }
  $under_logo_text = get_field('under_logo_text');
  if ($under_logo_text) { $html .= '<span class="logo-text">'.$under_logo_text.'</span>'; }
  echo $html;
}

/*
 * Вывод баннеров
 */
function custom_top_banner_block(){
  global $post;
  $banner_block = '';
  $thumb = '';
  $url_banner = '';
  $type = 'banner';
  $id = '';
  if (is_front_page()) {
    /*$main_img_banner = get_field('main_image_banner');
    $url_banner = get_field('main_url_banner');
    $banner_block = '';
    if( !empty($main_img_banner) ){ $thumb = $main_img_banner['url']; }
    $banner_cat = true;
    */
    $type = 'slider';
    $id = $post->ID;
    $slider = 'main_slider';
    
  }
  if (is_page() && !is_front_page()) {
    $banner_block = get_field('banner_block');
    $thumb = get_the_post_thumbnail_url();
		$lp = true;
  }
  if (is_shop()) {
    $type = 'slider';
    $slider = 'page_banner';
    $id = 24;
    if(!have_rows($slider, $id)){
      $type = 'banner';
      $slider = get_field('shortcode_slider','option');
      if($slider){
        $banner_block = do_shortcode($slider);
      }else{
        $banner_block=get_field('banner_block',24);
        $thumb=get_the_post_thumbnail_url(24);
      }
      $banner_catalog = true;
    }
  }
  if (is_product()) {
    $id = $post->ID;
    $banner_block = get_field('banner_block',$id);
    $thumb = get_field('image_for_banner',$id);
  }
  if (is_tax( 'product_cat' )) {
    /*$slider = get_field('shortcode_slider','option');
    if($slider){
      $banner_block = do_shortcode($slider);
    }else{
      $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
      $banner_block=get_field('banner_block','product_cat_'.$term->term_id);
      $cat_img_banner = get_field('cat_image_banner','product_cat_'.$term->term_id);
      $url_banner = get_field('cat_url_banner','product_cat_'.$term->term_id);
      if( !empty($cat_img_banner) ){ $thumb = $cat_img_banner['url']; }
      $banner_cat = true;
    }*/
    $type = 'slider';
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $id = 'product_cat_'.$term->term_id;
    $slider = 'cat_slider';
    
    /*временно*/
    if(!have_rows($slider, $id)){
      $type = 'banner';
      $slider = get_field('shortcode_slider','option');
      if($slider){
        $banner_block = do_shortcode($slider);
      }else{
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        $banner_block=get_field('banner_block','product_cat_'.$term->term_id);
        $cat_img_banner = get_field('cat_image_banner','product_cat_'.$term->term_id);
        $url_banner = get_field('cat_url_banner','product_cat_'.$term->term_id);
        if( !empty($cat_img_banner) ){ $thumb = $cat_img_banner['url']; }
        $banner_cat = true;
      }
    }
  }
  if($type == 'slider'){
    if(have_rows($slider, $id)){ ?>
      <div class="slider-head owl-carousel">
        <?php while ( have_rows($slider, $id) ) : the_row(); 
        $img = get_sub_field('img');?>
        <div class="slide-content">
          <?php if(get_sub_field('url')){ echo '<a href="'.get_sub_field('url').'">';}?>
          <img data-src="<?php echo $img['url'];?>" class="owl-lazy" alt="" />
          <?php if(get_sub_field('url')){ echo '</a>';}?>
        </div>
        <?php endwhile; ?>
      </div>
    <?php }
  }else{
    if ($banner_block||$thumb) {
      if($url_banner){ echo '<a href="'.$url_banner.'">'; } ?>
        <div class="banner_block<?php echo ($thumb)?" padd_every":""; echo ($banner_cat)?" banner_cat":""; echo ($banner_catalog)?" banner_catalog":""; echo ($lp)?" lp":"";?> clearfix" style="<?php echo ($thumb) ? "background-image: url('".$thumb."')":""; ?>">
          <?php echo $banner_block;?>
        </div>
        <?php if($url_banner){echo '</a>';}
    }
  }
    
}

add_filter ( 'nav_menu_css_class', 'custom_new_menu_css_class', 10, 4 );
function custom_new_menu_css_class ( $classes, $item, $args, $depth ){
  $classes[] = 'menu__item';
  return $classes;
}

if(!function_exists('get_primary_yoast_taxonomy_term')){
  function get_primary_yoast_taxonomy_term( $post = 0, $taxonomy = 'category' ) {
    if ( ! $post ) {
      $post = get_the_ID();
    }
    $terms = get_the_terms( $post, $taxonomy );
    $primary_term = array();

    if ( $terms ) {
      $term_display = '';
      $term_slug    = '';
      $term_link    = '';
      $term_id      = 0;
      if ( class_exists( 'WPSEO_Primary_Term' ) ) {
        $wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post );
        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
        $term               = get_term( $wpseo_primary_term );
        if ( is_wp_error( $term ) ) {
          $term_display = $terms[0]->name;
          $term_slug    = $terms[0]->slug;
          $term_id      = $terms[0]->term_id;
          $term_link    = get_term_link( $terms[0]->term_id );
        } else {
          $term_display = $term->name;
          $term_slug    = $term->slug;
          $term_id      = $terms[0]->term_id;
          $term_link    = get_term_link( $term->term_id );
        }
      } else {
        $term_display = $terms[0]->name;
        $term_slug    = $terms[0]->slug;
        $term_id      = $terms[0]->term_id;
        $term_link    = get_term_link( $terms[0]->term_id );
      }
      $primary_term['url']   = $term_link;
      $primary_term['slug']  = $term_slug;
      $primary_term['title'] = $term_display;
      $primary_term['id'] = $term_id;
    }
    return $primary_term;
  }
}
