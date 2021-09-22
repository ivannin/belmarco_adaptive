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
		'offset'=>$_POST['page']*$_POST['comments_per_page']
	);
$comments = get_comments( $args );	
if ($comments) { ?>
	<div class="rev_list row">
<?php foreach( $comments as $comment ){?>
	<div class="rev_item col-md-4">
        <div class="thumbnail">
            <div class="clearfix">
				<div class="img-responsive pull-left">
			<?php 
			$attachmentId = get_comment_meta($comment->comment_ID, 'attachmentId', TRUE);
			if(is_numeric($attachmentId) && !empty($attachmentId)){
				echo wp_get_attachment_image($attachmentId,'thumbnail');
			}
			?>
			</div>
            <div class="rev_txt">
                <p><?php 
					$args = array( 
						'maxchar' => 100, 
						'text' => $comment->comment_content,
						'save_format' => false,
						'more_text' => '',
						'echo' => false, 
					);
					echo text_excerpt( $args);?>
            </div>
        </div>
        <div class="rev_meta clear">
            <div class="row">
                <?php $author_url=$comment->comment_author_url; ?>
                <div class="col-xs-12"><b><?php echo $comment->comment_author; ?></b><a href="<?php echo $author_url; ?>" class="vk" title="Мы в Вконтакте" target="_blank"></a></div>
                <div class="col-xs-12 text-right"><a href="<?php echo $author_url?$author_url:get_comment_link($comment); ?>" class="more" <?php echo $author_url?'target="_blank"':''; ?>>Подробнее</a></div>
            </div><!--/.row-->
        </div><!--/.rev_meta-->
    </div><!--/.thumbnails-->
</div>
<?php } ?>
</div>
<?php } ?>
<div class="clearfix"></div>
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
		//$props = $form->get_properties();
		$param=array();
		$param['login'] = 'belmarcodir@yandex.ru';
		$param['password'] = 'goodweb';
		$param['title'] = urlencode('new.belmarco.ru');
		$param['name'] 	= urlencode($posted_data['name']);
		$param['phone'] = phone_clean_bitrix(urlencode($posted_data['tel']));
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
		$utm_source 	= (isset($_GET['utm_source'])) 	? $_GET['utm_source'] 	: '';
		$utm_medium 	= (isset($_GET['utm_medium'])) 	? $_GET['utm_medium'] 	: '';
		$utm_campaign 	= (isset($_GET['utm_campaign']))? $_GET['utm_campaign'] : '';
		$utm_term 		= (isset($_GET['utm_term'])) 	? $_GET['utm_term'] 	: '';
		$utm_content 	= (isset($_GET['utm_content'])) ? $_GET['utm_content'] 	: '';

		$url_params_bitrix = 'https://belmarko.bitrix24.ru/crm/configs/import/lead.php?LOGIN='.$param['login']
			.'&PASSWORD='.$param['password']
			.'&TITLE='.$param['title']
			.'&NAME='.$param['name']
			.'&PHONE_WORK='.$param['phone']
			.'&SOURCE_DESCRIPTION='.$param['source'].' '.$param['product-title']
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
	$param['title'] = urlencode('new.belmarco.ru');
	
	
	$order = wc_get_order( $order_id );
	$items = $order->get_items();
	$param['product-title']='Товары: ';
	foreach ( $items as $item ) {
		$param['product-title'] = $param['product-title'].$item['name'].', ';	
	}
	$param['name'] 	= $order->billing_first_name.' '.$order->billing_last_name;
	$param['phone'] = phone_clean_bitrix($order->billing_phone);
	date_default_timezone_set('Etc/GMT-4');
	$param['time'] = urlencode(date('H:i:s', time()));
	$param['email'] = $order->billing_email;
	$param['city'] = $order->billing_city;
	$param['source'] = 'Оформлен заказ №'.$order_id.' на покупку через корзину от '.$order->get_formatted_billing_address();
	$r = file_get_contents('https://belmarko.bitrix24.ru/crm/configs/import/lead.php?LOGIN='.$param['login']
		.'&PASSWORD='.$param['password']
		.'&TITLE='.$param['title']
		.'&NAME='.$param['name']
		.'&PHONE_WORK='.$param['phone']
		.'&SOURCE_DESCRIPTION='.$param['source'].'. '.$param['product-title']
		.'&UF_CRM_1421648024='.$param['time']
		.'&UF_CRM_1453122762='.$param['city']
		.($param['email'] ? '&EMAIL_WORK='.$param['email'] : '')
		.'&UF_CRM_1459178064='.$_REQUEST['UF_CRM_1459178064']
		.'&UF_CRM_1490857782=false'
		.'&UF_CRM_1490857935=0'
		.'&UF_CRM_1490857988=false'
	);
	}
	catch ( Exception $e )
	{
		// Была ошибка!
		file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/../logs/cf7_send2Bitrix24-error.log', $e->getMessage() . PHP_EOL . PHP_EOL, FILE_APPEND );
	}
	return true;	
}
add_action( 'woocommerce_thankyou', 'woo_send2Bitrix24',15 );

//add_action("woocommerce_order_status_changed", "paid_notification",5,3);
function paid_notification($order_id, $form, $to) {
    global $woocommerce;
	$order = wc_get_order( $order_id );
	if (($form=="wc-pending")&&($to==="wc-processing")){
		try
		{
			$param=array();
			$param['login'] = 'belmarcodir@yandex.ru';
			$param['password'] = 'goodweb';
			$param['title'] = urlencode('new.belmarco.ru');
			$param['name'] 	= $order->billing_first_name.' '.$order->billing_last_name;
			$param['phone'] = $order->billing_phone;
			date_default_timezone_set('Etc/GMT-4');
			$param['time'] = urlencode(date('H:i:s', time()));
			$param['email'] = $order->billing_email;
			$param['city'] = $order->billing_city;
			$param['source'] = 'Оплачен заказ №'.$order_id.' от '.$order->get_formatted_billing_address();
			$r = file_get_contents('https://belmarko.bitrix24.ru/crm/configs/import/lead.php?LOGIN='.$param['login']
			.'&PASSWORD='.$param['password']
			.'&TITLE='.$param['title']
			.'&NAME='.$param['name']
			.'&PHONE_WORK='.$param['phone']
			.'&SOURCE_DESCRIPTION='.$param['source']
			.'&UF_CRM_1421648024='.$param['time']
			.'&UF_CRM_1453122762='.$param['city']
			.($param['email'] ? '&EMAIL_WORK='.$param['email'] : '')
			.'&UF_CRM_1459178064='.$_REQUEST['UF_CRM_1459178064']
			.'&UF_CRM_1490857782=false'
			.'&UF_CRM_1490857935=0'
			.'&UF_CRM_1490857988=false'
			);
		}
		catch ( Exception $e )
		{
			// Была ошибка!
			file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/../logs/cf7_send2Bitrix24-error.log', $e->getMessage() . PHP_EOL . PHP_EOL, FILE_APPEND );
		}
		
    }
}
function quick_view_images_product(){
	global $product;
	$image_first = get_field('quick_view_image_first', $product->id);
	$image_second = get_field('quick_view_image_second', $product->id);
	?>
	<?php if($image_first):?>
		<a href="<?php echo $image_first; ?>" class="quick-fancybox"><img src="<?php echo $image_first; ?>" alt="" style="margin-bottom:10px;"></a>
	<?php endif;
		if($image_second):?>
		<a href="<?php echo $image_second; ?>" class="quick-fancybox"><img src="<?php echo $image_second; ?>" alt="" class="hidden-xs"></a>
	<?php endif;?>
	<script>
		jQuery(document).ready(function(){
			jQuery('.quick-fancybox').fancybox();
		});
	</script>
	<?php
}

remove_action("xoo-qv-images", "woocommerce_show_product_sale_flash", 10);
remove_action("xoo-qv-images", "xoo_qv_product_image", 20);
add_action("xoo-qv-images", "quick_view_images_product");

function pan_view_dimensions_product(){
	global $product;
	$bed_size = $product->get_attribute("bed-size");
	$razmery_sm = $product->get_attribute("razmery-sm");
	$sleeping_place_size = $product->get_attribute("sleeping-place-size");
	echo "<p style='font-weight:bold;'>В наличии</p>";
	if($bed_size)
		echo "<p>Размер кровати: "."<span style='font-weight:bold;'>".$bed_size."</span></p>";
	if($razmery_sm)
		echo "<p>Размер: "."<span style='font-weight:bold;'>".$razmery_sm."</span></p>";
	if($sleeping_place_size)
		echo "<p>Размер спального места: "."<span style='font-weight:bold;'>".$sleeping_place_size."</span></p>";
}
add_action("xoo-qv-summary", "pan_view_dimensions_product", 21);

function pan_view_attr_turbo_product(){
	echo "<p>Турбо отгрузка за 2 дня: <span style='font-weight:bold;' class='regionDelivery'></span></p>";
	?>
	<script>
		jQuery('.regionDelivery').text(regionDelivery);
	</script>
	<?php	
}
add_action("xoo-qv-summary", "pan_view_attr_turbo_product", 22);

function pan_add_tab_sertif( $tabs = array() ) {
	global $product, $post;

	$tabs['sertificates'] = array(
		'title'    => __( 'Гарантия качества', 'woocommerce' ),
		'priority' => 10,
		'callback' => 'pad_content_tab_sertif',
	);	return $tabs;
}
function pad_content_tab_sertif(){
	?>
	<div class="row">
		<div class="col-xs-12" style="margin-bottom:20px; margin-top: 20px;">
			<p style="line-height:30px;">Наша продукция соответствует всем отечественным и европейским стандартам качества в области экологии и охраны здоровья. Предлагаем Вам ознакомиться с нашими сертификатами:</p>
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
		<div class="col-xs-12" style="margin-bottom:20px; margin-top: 20px;">
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