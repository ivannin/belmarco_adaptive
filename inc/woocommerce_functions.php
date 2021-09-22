<?php
/**************************/
/*Общие настройки магазина*/
/**************************/
/* Новые размеры картинок */
add_image_size( 'cust_shop_single', 450, 300); // Основное изображение в карточке товара
add_image_size( 'cust_shop_thumbnail', 150, 100); // Превью изображений в карточке товара

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
	$class=is_singular('product')?'':'col-md-9';
  echo '<main id="main" class="site-main '.$class.'" role="main">';
}

function my_theme_wrapper_end() {
  echo '</main><!-- #main -->';
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol( $currency_symbol, $currency ) {
	switch( $currency ) {
		case 'RUB': $currency_symbol = ' руб.'; 
		break;
	}
return $currency_symbol;
}

/**************************************/
/*Настраиваем страницу карточки товара*/
/**************************************/
add_action( 'wp_head', 'redirect_to_url_main_cat' );
function redirect_to_url_main_cat() {
    if ( is_product() && !isset($_GET['post_type'])) {
      global $product;
      $url_orig = get_permalink($product->get_id());
      if($_SERVER['QUERY_STRING']){
        $url_orig .= '?'.$_SERVER['QUERY_STRING'];
      }
      $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
      $url_cur = $protocol.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
      //echo '<meta name="custom" content_orig="'.$url_orig.'" content_cur="'.$url_cur.'"/>';
      if($url_orig!=$url_cur && strpos($_SERVER['REQUEST_URI'], "comment-page-") === false){
        wp_redirect( $url_orig, 301 );
        exit;
      }
    }
}
remove_action( 'woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
/*if(wp_is_mobile()){
  add_action('woocommerce_single_product_summary', 'custom_before_div_metatitle', 5);
  add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 5);
  add_action('woocommerce_single_product_summary', 'custom_after_div_metatitle', 7);
}else{
  add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 25);
}*/
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 25);
/*function custom_before_div_metatitle(){
  echo '<div class="metatitle">';
}
function custom_after_div_metatitle(){
  echo '</div>';
}*/
function belmarco_single_product_badges($html){
	ob_start();
	belmarco_product_badge_display();
	woocommerce_show_product_sale_flash();
	$badge_html=ob_get_clean();
	return $badge_html.$html;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'belmarco_add_thumb_carousel' );
function belmarco_add_thumb_carousel($col){
	return $col.' owl-carousel';
}
//Удаление аватрки комментатора
remove_action('woocommerce_review_before','woocommerce_review_display_gravatar', 10);
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_rating',10 );
add_action( 'woocommerce_before_add_to_cart_form','first_add_div_boc',1);
function first_add_div_boc(){
  echo '<div class="single_boc_addcart">';
}
add_action( 'woocommerce_after_add_to_cart_form','belmarco_buy_1_click',80);
function belmarco_buy_1_click() {
  global $product;
  echo '<p class="single_boc">'.do_shortcode('[boc_wc_single id="'.$product->get_ID().'" qty="1"]').'</p>';
}
add_action( 'woocommerce_after_add_to_cart_form','end_add_div_boc',99);
function end_add_div_boc(){
  echo '</div>';
}
//Дополнительное поле цены рассрочки
add_action( 'woocommerce_product_options_pricing', 'wc_сp_product_field' );
function wc_сp_product_field() {
woocommerce_wp_text_input( array( 'id' => 'credit_price', 'class' => 'wc_input_price short', 'label' => __( 'Купить в рассрочку за (руб./мес.)', 'woocommerce' )) );
}

add_action( 'save_post', 'wc_сp_save_product' );
function wc_сp_save_product( $product_id ) {
// Если это автосохранение, то ничего не делаем, сохраняем данные только при нажатии на кнопку Обновить
if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
return;
if ( isset( $_POST['credit_price'] )&& is_numeric( $_POST['credit_price']) || $_POST['credit_price']=="" ) {
	update_post_meta( $product_id, 'credit_price', $_POST['credit_price'] );
} else delete_post_meta( $product_id, 'credit_price' );
}

// Изменить текст кнопки «Добавить в корзину» в шаблоне карточки товара
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' );  // 2.1 +
function woo_custom_single_add_to_cart_text() {
    return __( 'В корзину', 'woocommerce' );
}

remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_meta',40 );

add_action( 'woocommerce_single_product_summary', 'belmarco_cp_show', 40 );
function belmarco_cp_show() {
global $product;
// Ничего не предпринимаем для вариативных товаров
$credit_price = get_post_meta( $product->get_id(), 'credit_price', true );
if ($credit_price) {?>
<div>
Купить в рассрочку за <a href="#contact_form_pop_1" class="fancybox-inline"><?php echo woocommerce_price( $credit_price );?>/мес.</a>
</div>
<div style="display:none" class="fancybox-hidden">
	<div id="contact_form_pop_1">
	<?php echo do_shortcode('[contact-form-7 id="161" title="Рассрочка"]'); ?>
<!--		</div>
	</div>-->
	</div>
</div>
<?php }
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );  // Удалить вкладку дополнительной информации
	
    return $tabs;
}
add_filter( 'woocommerce_product_description_heading', 'belmarco_woocommerce_product_description_heading');
function belmarco_woocommerce_product_description_heading($heading){
  $heading = '';
  return $heading;
}
/*add_action( 'woocommerce_after_single_product_summary','advantages_output', 8 );
function advantages_output() {?>
	<div class="advantages_wrap">
		<div class="advantages padTop0">	
    <?php if(get_field('advantages')) the_field('advantages');?>
		</div>
	</div>
<?php 
}*/

add_filter( 'woocommerce_output_related_products_args', 'related_products_args' );
 function related_products_args( $args ) {

$args['posts_per_page'] = 3; // количество "Похожих товаров"
 $args['columns'] = 3; // количество колонок
 return $args;
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20 );
add_filter( 'woocommerce_up_sells_columns', 3);

/*******************************/
/*Настраиваем страницу каталога*/
/*******************************/

add_filter( 'loop_shop_per_page', 'belmarco_loop_shop_per_page', 20 );
function belmarco_loop_shop_per_page($cols){
  $cols = 18;
  return $cols;
}

function woo_product_columns_frontend() {
    global $woocommerce;

    $columns = 3;

    // Product List
    if ( is_product_category() ) :
        $columns = 3;
    endif;

    //Related Products
    if ( is_product() ) :
        $columns = 3;
    endif;

    //Cross Sells
    if ( is_checkout() ) :
        $columns = 3;
    endif;

    return $columns;
}
add_filter('loop_shop_columns', 'woo_product_columns_frontend');
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 100 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_product_archive_description', 100 );

remove_action ('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count',20 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
add_action( 'woocommerce_before_shop_loop','belmarco_ordering',30);

function belmarco_ordering(){
	echo '<div class="ordering">';
	echo '<span class="before_ordering">Сортировка:</span>';	
	custom_woocommerce_catalog_ordering();
	echo '</div>';
}

function custom_woocommerce_catalog_ordering(){
  global $woocommerce;
	$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
		'menu_order' => __( 'Default sorting', 'woocommerce' ),
		'popularity' => __( 'Sort by popularity', 'woocommerce' ),
		'rating'     => __( 'Sort by average rating', 'woocommerce' ),
		'date'       => __( 'Sort by newness', 'woocommerce' ),
		'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
		'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
	) );

	$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
	$orderby         = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

	if ( wc_get_loop_prop( 'is_search' ) ) {
		$catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'woocommerce' ) ), $catalog_orderby_options );

		unset( $catalog_orderby_options['menu_order'] );
	}

	if ( ! $show_default_orderby ) {
		unset( $catalog_orderby_options['menu_order'] );
	}

	if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
		unset( $catalog_orderby_options['rating'] );
	}

	if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
		$orderby = current( array_keys( $catalog_orderby_options ) );
	}

	wc_get_template( 'loop/orderby.php', array(
		'catalog_orderby_options' => $catalog_orderby_options,
		'orderby'                 => $orderby,
		'show_default_orderby'    => $show_default_orderby,
	) );
}

function belmarco_woocommerce_result_count() {
	echo '<div class="clearfix"></div>';
	woocommerce_result_count();
}
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5 );
add_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_product_link_close',15 );

remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10 );

add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +
function woo_archive_custom_cart_button_text() {
        return __( 'В корзину', 'woocommerce' );
}

remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
add_action( 'woocommerce_after_shop_loop', 'belmarco_pagination', 10);
function belmarco_pagination() {
        wp_pagenavi(); ?>
		<div class="pagination"></div>	
<?php }
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );
add_action( 'woocommerce_before_main_content', 'woocommerce_get_sidebar',5 );

function get_cur_product_id(){
	global $product;
	$html='<a href="'.$product->get_permalink().'">'.$product->get_title().'</a>';
	return $html;
}
add_shortcode('cur_product','get_cur_product_id');

/**************************************/
/*Настройка страницы оформления заказа*/
/**************************************/

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 10 );
/**
 * Get shipping methods.
 *
 * @access public
 */
function wc_checkout_totals_shipping_html() {
	$packages = WC()->shipping->get_packages();

	foreach ( $packages as $i => $package ) {
		$chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
		$product_names = array();

		if ( sizeof( $packages ) > 1 ) {
			foreach ( $package['contents'] as $item_id => $values ) {
				$product_names[] = $values['data']->get_title() . ' &times;' . $values['quantity'];
			}
		}

		wc_get_template( 'checkout/checkout-shipping.php', array(
			'package'              => $package,
			'available_methods'    => $package['rates'],
			'show_package_details' => sizeof( $packages ) > 1,
			'package_details'      => implode( ', ', $product_names ),
			'package_name'         => apply_filters( 'woocommerce_shipping_package_name', sprintf( _n( 'Shipping', 'Shipping %d', ( $i + 1 ), 'woocommerce' ), ( $i + 1 ) ), $i, $package ),
			'index'                => $i,
			'chosen_method'        => $chosen_method
		) );
	}
}
/*
*	cross sells
*/
function pan_woocommerce_modal_cross_sell(){
	?>
		<div style="display:none;" id="crossSellFancybox">
			<div id="modalCrossSell" class="woocommerce">
				<?php woocommerce_cross_sell_display( 8,4 ); ?>
			</div>
			<div class="woocommerce">
				<div class="wc-proceed-to-checkout">
					<a href="/checkout/" class="checkout-button button alt wc-forward">Перейти к оформлению</a>
				</div>
			</div>
		</div>
		<script>
			jQuery(document).ready(function(){
				jQuery('#crossSellFancybox').find('li').addClass('product');
				jQuery('.cart_totals .wc-proceed-to-checkout .checkout-button').click(function(e){
					var content = jQuery('#crossSellFancybox').html();
					var test = jQuery('#modalCrossSell').find('li');
					if(test.length > 0){
						jQuery.fancybox({
				            'content' : content
				        });
						e.preventDefault();
					}	
				})
			});
		</script>
	<?php
}

remove_action("woocommerce_cart_collaterals", "woocommerce_cross_sell_display");

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
	unset($fields["shipping"]["shipping_country"]);
return $fields;
}

function pan_checkout_tooltip(){
?>
<div style="display:none;">
	<div id="kassa" style="max-width:400px">
		<p style="max-width:400px">
			В случае, если оплата наложенным платежом в Вашем населенном пункте не осуществляется, то мы выставляем Вам <span style="font-weight:bold;">официальный счет-договор</span> с условиями доставки и оплаты, с нашими реквизитами, подписью и синей печатью.
		</p>
		<p style="max-width:400px">
			Вы можете оплатить данный счет-договор либо <span style="font-weight:bold;">через кассу любого банка</span>, либо через <span style="font-weight:bold;">электронную кассу</span> нашей организации.
		</p>
		<p style="max-width:400px">
			Электронная касса расположена на сайте, в разделе оплата. Там присутствуют подробные инструкции по совершению платежа.
		</p>
		<p style="max-width:400px">
			После поступления денежных средств происходит <span style="font-weight:bold;">отгрузка заказа.</span>
		</p>
		<p style="max-width:400px">
			Вне зависимости от способа совершения платежа, денежные средства поступают на наш расчетный счет, что позволяет гарантировать их <span style="font-weight:bold;">безопасность.</span> Безопасность платежей через электронную кассу поддерживает компания Яндекс.
		</p>
	</div>
	<div id="cod" style="max-width:400px">
		<p style="max-width:400px">
			При оформлении заказа наш менеджер проконсультирует Вас и скажет, есть ли услуга наложенного платежа в Вашем городе. В этом случае оформляется доставка и сумму за сам заказ и доставку Вы оплачиваете уже при получении.
		</p>
	</div>
	<div id="alg_custom_gateway_1">
		<p style="max-width:400px">
			Мы формируем ваш заказ на сайте <span style="font-weight:bold;">PayLate</span>
		</p>
		<p style="max-width:400px">
			Вам приходит СМС со ссылкой на сайт, на котором Вы проходите <span style="font-weight:bold;">регистрацию</span>, заполняете анкету
		</p>
		<p style="max-width:400px">
			Если одобрено, то Вы <span style="font-weight:bold;">подтверждаете займ</span> с помощью СМС
		</p>
		<p style="max-width:400px">
			И мы делаем <span style="font-weight:bold;">отправку</span> вашего груза
		</p>
		<p style="max-width:400px">
			Сумма заказа при оформлении рассрочки на сайте делится на <span style="font-weight:bold;">12 месяцев.</span> Если вы оплачиваете в течение 4-х месяцев свой заказ, то % <span style="font-weight:bold;">не взимается.</span>
		</p>
		<p style="text-align:center; max-width:400px">
			При положительном решении на почту приходит информация по займу, где будет указана сумма займа, срок льготного периода и график ежемесячных платежей.
		</p>
	</div>
</div>
<?php
}
add_action("woocommerce_checkout_order_review", "pan_checkout_tooltip");

function belmarco_in_stock(){
  global $product;
	?>
	<p class="title-in-stock">В наличии</p>
  <?php /*<p class="title-in-sku"><?php echo '<span>Артикул:</span> '.$product->sku;?></p>*/?>
	<?php
}

add_action("woocommerce_single_product_summary","belmarco_in_stock",26);

function belmarco_print_hits(){
	$is_hits = get_field('is_hits');
	if($is_hits):?>
		<img src="<?php echo get_bloginfo('template_url')?>/img/hits-stiker.png" class="hits-label" alt="">
	<?php endif;

}
add_action("woocommerce_after_shop_loop_item", "belmarco_print_hits", 99);
/*Удаление блоков из checkout*/
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
add_filter('woocommerce_order_button_text','custom_order_button_text',1);
function custom_order_button_text($order_button_text) {
	
	$order_button_text = 'Оформить заказ';
	
	return $order_button_text;
}
/*Прописывание целей Яндекс.Метрики согласно рекомендациям разработчиков CF7*/
add_action( 'wp_footer', 'mycustom_wp_footer' );
 
function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
  /*Формы основного сайта*/	
  if ( '161' == event.detail.contactFormId ) {	
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "rassrochka" });/*В наст. время нет такой цели у этого счетчика. Форма не исп-ся.*/	
  }
	if ( '173' == event.detail.contactFormId ) {	
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "rezerv" });
  }
  if ( '1123' == event.detail.contactFormId ) {	
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "rezerv" });/*Форма не исп-ся.*/	
  }	
	if ( '1140' == event.detail.contactFormId ) {	
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "otzyvy" });
  }	
  if ( '1266' == event.detail.contactFormId ) {	
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "zakaz_skidka" });
		var name_tov = 'Скидка - '+$('div.summary>h1').text(); var nomtel = $('input[name=\"tel-4\"]').val(); R7K12.push({type: 'Form', title: '',  comment: name_tov, name: '', phone: nomtel, email: '', create_new_lead: 1, fields: {lead: {orderType: '', orderMethod: 'website'}}});		
  }
	if ( '1637' == event.detail.contactFormId ) {
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "diler_cena" });
  }	
	if ( '1999' == event.detail.contactFormId ) {	
  /*Скидка 3000 руб. (Каталог)*/			
    var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "skidka" });/*Непонятно, где используется форма*/
  }	
  if ( '2712' == event.detail.contactFormId ) {	
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "zvonok" });	
  }	
	if ( '2849' == event.detail.contactFormId ) {
  /*Узнайте больше о нашей компании*/			
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "2904126", type: "reachGoal", goal: "info_campany" });
  }	
	if ( '4457' == event.detail.contactFormId ) {
  /*Скидка 3000 руб. (кровати для мальчиков)*/		
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "otzyvy" });/*Непонятно, где используется форма*/
  }	
  if ( '4524' == event.detail.contactFormId ) {
  /*Скидка 3000 руб. (Скидка.Страница каталог)*/			
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "skidka" });
  }	
	if ( '4528' == event.detail.contactFormId ) {	
  /*Скидка 3000 руб. (розыгрыш кровати)*/			
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "otzyvy" });/*Непонятно, где используется форма*/
  }		
	
  /*LP Кроватимашины*/	
	if ( '1204' == event.detail.contactFormId ) {
  /*Получить коммерческое предложение*/		
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "kp" });
  }
	if ( '2275' == event.detail.contactFormId ) {
  /*Хочу узнать о вакансиях*/			
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "vacancii" });
  }
	if ( '2338' == event.detail.contactFormId ) {
  /*Хочу узнать больше*/			
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "vacancii" });
  }		
	if ( '3272' == event.detail.contactFormId ) {
  /*Задать вопрос LP*/		
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "voprosy_km" });
  }
	if ( '3273' == event.detail.contactFormId ) {
  /*Подбор варианта доставки LP*/
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "dostavka_km" });
  }	
	if ( '3274' == event.detail.contactFormId ) {
  /*Остались вопросы?*/			
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "ostvoprosy_km" });
  }	
	if ( '4538' == event.detail.contactFormId ) {
  /*Скидка 3000 руб. (Баннер лендинг кроватки)*/
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "30789032", type: "reachGoal", goal: "skidka_km" });
  }
	if ( '5398' == event.detail.contactFormId ) {
  /*Форма для LP в товарах серия ДРИМ*/			
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "2904126", type: "reachGoal", goal: "dop_km" });
  }	

  /*LP Стул*/
	if ( '3245' == event.detail.contactFormId ) {
  /*Заказать звонок LP*/			
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "2904126", type: "reachGoal", goal: "podbor_km" });/*Непонятно, где используется форма*/
  }
	if ( '3408' == event.detail.contactFormId ) {
  /*Получить промо-код LP*/			
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "2904126", type: "reachGoal", goal: "skidka_km" });/*Непонятно, где используется форма*/
  }
	if ( '3822' == event.detail.contactFormId ) {
  /*Форма для LP всплывающее окно*/			
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "2904126", type: "reachGoal", goal: "bond_km" });
  }	
	if ( '3823' == event.detail.contactFormId ) {
  /*Форма для LP в товарах*/			
	  console.log($('.mfp-wrap')); 
	  var groop = $('#popup-type>div>h2').text();
	  if($('.mfp-wrap').length==0) groop='Подобрать доп.опции';
	  var nomtel = $('input[name=\"tel-670\"]').val();
	  R7K12.push({type: 'Form', title: '',  comment: groop, name: '', phone: nomtel, email: '', create_new_lead: 1, fields: {lead: {orderType: '', orderMethod: 'lp-mashinki'}}}); console.log(groop);
  }
	if ( '4254' == event.detail.contactFormId ) {
  /*Форма lp-stul на баннере*/			
    var _tmr = window._tmr || (window._tmr = []); 
    _tmr.push({ id: "30789032", type: "reachGoal", goal: "skidka_km" });
  }
	if ( '4260' == event.detail.contactFormId ) {
  /*Форма для лендинга "СТУЛ", задать вопрос.*/			
    var _tmr = window._tmr || (window._tmr = []); 
    _tmr.push({ id: "2904126", type: "reachGoal", goal: "zakaz_zvonok_lp" });
    var _tmr = window._tmr || (window._tmr = []); 
    _tmr.push({ id: "2904126", type: "reachGoal", goal: "form_lpstul_vopros" });
  }	
	if ( '4594' == event.detail.contactFormId ) {
  /*Заказать звонок LP-stul*/			
		var _tmr = window._tmr || (window._tmr = []); 
		_tmr.push({ id: "2904126", type: "reachGoal", goal: "podbor_km" });/*Непонятно, где используется форма*/
  }	
}, false );	
</script>
<?php
}

/*Динамический ретаргетинг VK*/
function generate_script_vk_targeting(){
	$id_list = 973;
	$vk_js = '<script type="text/javascript">';
	if(is_front_page()){
		$vk_js .= 'VK.Retargeting.ProductEvent('.$id_list.', "view_home");';
	}
	if(is_shop()){
		$vk_js .= 'jQuery(document).on("click", "ul.products li.product a.add_to_cart_button", function() {';
			$vk_js .= 'var prod_id = jQuery(this).attr("data-product_id");';
			$vk_js .= 'var eventParams_catalog = {"products":[{"id":prod_id}]};';
			$vk_js .= 'VK.Retargeting.ProductEvent('.$id_list.', "add_to_cart", eventParams_catalog);';
			$vk_js .= 'console.log("VK_addToCart");';
		$vk_js .= '});';
	}
	if(is_product_category()){
		$vk_js .= 'VK.Retargeting.ProductEvent('.$id_list.', "view_category");';
		$vk_js .= 'jQuery(document).on("click", "ul.products li.product a.add_to_cart_button", function() {';
			$vk_js .= 'var prod_id = jQuery(this).attr("data-product_id");';
			$vk_js .= 'var eventParams_cat = {"products":[{"id":prod_id}]};';
			$vk_js .= 'VK.Retargeting.ProductEvent('.$id_list.', "add_to_cart", eventParams_cat);';
			$vk_js .= 'console.log("VK_addToCart");';
		$vk_js .= '});';
	}
	if(is_product()){
		global $product;
		$id_product = $product->get_id();
		$price = $product->get_price();
		$price_regular = $product->get_regular_price();
		$vk_js .= 'var eventParams = {"products":[{"id":'.$id_product.', "price":'.$price.', "price_old":'.$price_regular.'}]};';
		$vk_js .= 'VK.Retargeting.ProductEvent('.$id_list.', "view_product", eventParams);';
		$vk_js .= 'jQuery("form.cart button").on("click", function() {';
			$vk_js .= 'VK.Retargeting.ProductEvent('.$id_list.', "add_to_cart", eventParams);';
			$vk_js .= 'console.log("VK_addToCart");';
		$vk_js .= '});';
	}
	if(is_checkout()){
		$vk_js .= 'VK.Retargeting.ProductEvent('.$id_list.', "init_checkout");';
	}
	if(is_cart()){
		$vk_js .= 'jQuery(document).on("click", "form.woocommerce-cart-form .product-remove a.remove", function() {';
			$vk_js .= 'var prod_id = jQuery(this).attr("data-product_id");';
			$vk_js .= 'var eventParams_remove = {"products":[{"id":prod_id}]};';
			$vk_js .= 'VK.Retargeting.ProductEvent('.$id_list.', "remove_from_cart", eventParams_remove);';
			$vk_js .= 'console.log("VK_remove");';
		$vk_js .= '});';
	}
	$vk_js .= '</script>';
	echo $vk_js;
}
add_action("wp_footer", "generate_script_vk_targeting");

/*При совершение покупки*/
function generate_script_vk_targeting_purchase(){
	$id_list = 973;
	$vk_js = '<script type="text/javascript">';
		$vk_js .= 'VK.Retargeting.ProductEvent('.$id_list.', "purchase");';
	$vk_js .= '</script>';
	echo $vk_js;
}
add_action( "woocommerce_thankyou", "generate_script_vk_targeting_purchase" );

/*Динамический ретаргетинг FB*/
function generate_script_fb_targeting(){
	$fb_js = '<script type="text/javascript">';
  if(is_shop()){
		$fb_js .= 'jQuery(document).on("click", "ul.products li.product a.add_to_cart_button", function() {';
			$fb_js .= 'var prod_id = jQuery(this).attr("data-product_id");';
			$fb_js .= 'var eventParams = {content_type: "product",  content_ids: ["prod_id"]};';
			$fb_js .= 'fbq("track", "AddToCart", eventParams);';
      $fb_js .= 'fbq("track", "InitiateCheckout", eventParams);';
		$fb_js .= '});';
	}
	if(is_product_category()){
		$fb_js .= 'jQuery(document).on("click", "ul.products li.product a.add_to_cart_button", function() {';
			$fb_js .= 'var prod_id = jQuery(this).attr("data-product_id");';
			$fb_js .= 'var eventParams = {content_type: "product",  content_ids: ["prod_id"]};';
			$fb_js .= 'fbq("track", "AddToCart", eventParams);';
      $fb_js .= 'fbq("track", "InitiateCheckout", eventParams);';
		$fb_js .= '});';
	}
	if(is_product()){
		global $product;
		$id_product = $product->get_id();
		$name_product = $product->get_title();
    $price_product = $product->get_price();
		$fb_js .= 'var eventParams = {content_type: "product",  content_ids: ["'.$id_product.'"], content_name: "'.htmlspecialchars($name_product).'", value: '.$price_product.', currency: "RUB"};';
		$fb_js .= 'fbq("track", "ViewContent", eventParams);';
		$fb_js .= 'jQuery("form.cart button").on("click", function() {';
			$fb_js .= 'fbq("track", "AddToCart", eventParams);';
      $fb_js .= 'fbq("track", "InitiateCheckout", eventParams);';
		$fb_js .= '});';
	}
	$fb_js .= '</script>';
	echo $fb_js;
}
add_action("wp_footer", "generate_script_fb_targeting");
/*При совершение покупки FB*/
function generate_script_fb_targeting_purchase($order_id){
  $order = wc_get_order( $order_id );
  $items = $order->get_items();
  $id_items = array();
  foreach ( $items as $item ) {
    $id_items[] = $item->get_product_id();
  }
  $str_ids = implode(",", $id_items);
	$fb_js = '<script type="text/javascript">';
    $fb_js .= 'var eventParams = {content_type: "product",  content_ids: ['.$str_ids.']};';
		$fb_js .= 'fbq("track", "Purchase", eventParams);';
	$fb_js .= '</script>';
	echo $fb_js;
}
add_action( "woocommerce_thankyou", "generate_script_fb_targeting_purchase" );

function advantages_top_output() { 
    $check = '/wp-content/uploads/2016/11/i_26.png';
    if (get_field('advantages_top') && strpos(get_field('advantages_top'), $check)==false):?>
    <div class='clearfix'></div>
    <div class="advantages_wrap">
      <div class="advantages">	
        <?php the_field('advantages_top');?>
      </div>
    </div>
  <?php endif;
}
add_action( 'woocommerce_single_product_summary','advantages_top_output',90);

function payment_shipping_output() {?>
	<div class="payment_shipping_wrap">
		<div class="payment_shipping">	
    <?php if(get_field('payment_shipping', 'option')) the_field('payment_shipping', 'option');?>
		</div>
	</div>
<?php 
}
add_action( 'woocommerce_single_product_summary','payment_shipping_output', 90 );
/*Характеристики*/
function pan_add_tab_characteristics( $tabs = array() ) {
	global $product, $post;

	$tabs['characteristics'] = array(
		'title'    => __( 'Информация о товаре', 'woocommerce' ),
		'priority' => 1,
		'callback' => 'pad_content_tab_characteristics',
	);	return $tabs;
}
function pad_content_tab_characteristics(){
  global $product;
  echo $product->list_attributes();?>
  <?php 
}
add_filter( 'woocommerce_product_tabs', 'pan_add_tab_characteristics', 10 );

/*Преимущества*/
function pan_add_tab_advantages( $tabs = array() ) {
	global $product, $post;
  if(have_rows('tab_advantages', $product->get_id())):  
    $count = count(get_field('tab_advantages'));
    $tabs['advantages'] = array(
      'title'    => __( 'Преимущества', 'woocommerce' ).' ('.$count.')',
      'priority' => 25,
      'callback' => 'pad_content_tab_advantages',
    );	
  endif;
  return $tabs;
}
function pad_content_tab_advantages(){
  global $product;
  if(have_rows('tab_advantages', $product->get_id())):?>
    <div class="tab_table">
    <?php while(have_rows('tab_advantages', $product->get_id()) ) : the_row();?>
       <div class="item">
        <div class="name"><?php the_sub_field('attrubute');?>:</div>
        <div><?php the_sub_field('value');?></div> 
       </div>
    <?php endwhile;?>
    </div>
  <?php endif;
}
add_filter( 'woocommerce_product_tabs', 'pan_add_tab_advantages', 10 );

/*Видеоотзывы*/
function pan_add_tab_videos( $tabs = array() ) {
	global $product, $post;
  if(have_rows('tab_videos', $product->get_id())):  
    $count = count(get_field('tab_videos'));
    $tabs['videos'] = array(
      'title'    => __( 'Видеоотзывы', 'woocommerce' ).' ('.$count.')',
      'priority' => 40,
      'callback' => 'pad_content_tab_videos',
    );	
  endif;
  return $tabs;
}
function pad_content_tab_videos(){
  global $product;
  if(have_rows('tab_videos', $product->get_id())):?>
    <div class="videos row">
    <?php while ( have_rows('tab_videos', $product->get_id()) ) : the_row();?>
       <div class="item-video col-xs-12 col-sm-6">
         <div class="youtube" id="tab-video_<?php echo get_row_index();?>" data-id="<?php the_sub_field('url_video');?>" style="width: 100%;height: 100%;"><div class="play"></div></div>
      </div>
    <?php endwhile;?>
    </div>
    <script>
      jQuery(function() {
        jQuery(".youtube").each(function() {
            var _this = jQuery(this);
            _this.css('background-image', 'url(https://i.ytimg.com/vi/' + _this.attr('data-id') + '/hqdefault.jpg)');
            //_this.attr('data-bg', 'url(https://i.ytimg.com/vi/' + _this.attr('data-id') + '/hqdefault.jpg)');
          });
         jQuery(document).on('click', '.item-video .play', function() {
            var _this = jQuery(this).parent();
            var iframe_url = "https://www.youtube.com/embed/" + _this.attr('data-id') + "?autoplay=1&autohide=1&rel=0";
           var iframe = '<iframe src="'+iframe_url+'" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>';
           jQuery('.item-video #'+_this.attr('id')).html(iframe);
         });
        /*
        jQuery('#tab-videos .videos.owl-carousel').owlCarousel({
          loop:false, nav:true, dots: false, margin:25, slideBy:1, responsiveClass:true,
            responsive:{ 0:{ items:1, nav:true, }, 480: { items:2, nav:true, }, 768:{ items:3, nav:true, },
            }
        });*/
    });
    </script>
  <?php endif;
}
add_filter( 'woocommerce_product_tabs', 'pan_add_tab_videos', 10 );

/*Видеообзоры*/
function pan_add_tab_videoviews( $tabs = array() ) {
	global $product, $post;
  $field = get_field('tab_videoviews', $product->get_id());
  if ($field):
      $tabs['videoviews'] = array(
          'title'    => __( 'Видеообзоры', 'woocommerce' ),
          'priority' => 45,
          'callback' => 'pad_content_tab_videoviews',
        );	
  endif;
  return $tabs;
}
function pad_content_tab_videoviews(){
  global $product;
   $field = get_field('tab_videoviews', $product->get_id());
    if ($field):
      the_field('tab_videoviews', $product->get_id());
  endif;
}
add_filter( 'woocommerce_product_tabs', 'pan_add_tab_videoviews', 10 );

/*Аксессуары*/
function pan_add_tab_accessories( $tabs = array() ) {
	global $product, $post;
  $post_objects = get_field('tab_accessories_full', $product->get_id());
	if ( $post_objects ) :
  $count = count($post_objects);
  $tabs['accessories'] = array(
      'title'    => __( 'Аксессуары', 'woocommerce' ).' ('.$count.')',
      'priority' => 50,
      'callback' => 'pad_content_tab_accessories',
    );	
  endif;
  return $tabs;
}
function pad_content_tab_accessories(){
  global $product;
  echo do_shortcode('[wc_tab_accessories]');
}
add_filter( 'woocommerce_product_tabs', 'pan_add_tab_accessories', 10 );

/*Оплата и доставка*/
function pan_add_tab_payment_deliver( $tabs = array() ) {
	global $product, $post;
  $field1 = get_field('tab_payment_deliver', 'option');
  if ($field1):
    $tabs['payment_delivers'] = array(
      'title'    => __( 'Оплата и доставка', 'woocommerce' ),
      'priority' => 60,
      'callback' => 'pad_content_tab_payment_deliver',
    );    
  endif;
  return $tabs;
}
function pad_content_tab_payment_deliver(){
  global $product;
   $field = get_field('tab_payment_deliver', 'option');
    if ($field):
      the_field('tab_payment_deliver', 'option');
  endif;
}
add_filter( 'woocommerce_product_tabs', 'pan_add_tab_payment_deliver', 10 );

/*Гарантия возврата*/
function pan_add_tab_garant_return( $tabs = array() ) {
	global $product, $post;
  if(get_field('tab_garant_return', 'option')):
      $tabs['garant_return'] = array(
          'title'    => __( 'Гарантия возврата', 'woocommerce' ),
          'priority' => 70,
          'callback' => 'pad_content_tab_garant_return',
        );	
  endif;
  return $tabs;
}
function pad_content_tab_garant_return(){
  global $product;
  $field = get_field('tab_garant_return','option');
  if ($field):
   the_field('tab_garant_return','option');
  endif;
}
add_filter( 'woocommerce_product_tabs', 'pan_add_tab_garant_return', 10 );

/*Упаковка*/
function pan_add_tab_packaging( $tabs = array() ) {
	global $product, $post;
  $field = get_field('tab_packaging');
  if ($field):
      $tabs['packaging'] = array(
          'title'    => __( 'Упаковка', 'woocommerce' ),
          'priority' => 80,
          'callback' => 'pad_content_tab_packaging',
        );	
  endif;
  return $tabs;
}
function pad_content_tab_packaging(){
  global $product;
   $field = get_field('tab_packaging');
    if ($field):
      the_field('tab_packaging');
  endif;
}
add_filter( 'woocommerce_product_tabs', 'pan_add_tab_packaging', 10 );

/*Вопросы*/
function pan_add_tab_faq( $tabs = array() ) {
	global $product, $post;
  if(have_rows('tab_faq', $product->get_id())):  
    $count = count(get_field('tab_faq'));
    $tabs['faq'] = array(
      'title'    => __( 'Вопросы-ответы', 'woocommerce' ).' ('.$count.')',
      'priority' => 90,
      'callback' => 'pad_content_tab_faq',
    );	
  endif;
  return $tabs;
}
function pad_content_tab_faq(){
  global $product;
  if(have_rows('tab_faq', $product->get_id())):?>
    <div class="faq tab_table">
    <?php while(have_rows('tab_faq', $product->get_id()) ) : the_row();?>
       <div class="item">
        <div class="name"><?php the_sub_field('question');?></div>
        <div><?php the_sub_field('answer');?></div> 
       </div>
    <?php endwhile;?>
    </div>
  <?php endif;
}
add_filter( 'woocommerce_product_tabs', 'pan_add_tab_faq', 10 );

/*Габариты и упаковка */
function pan_add_tab_dimensions_packing( $tabs = array() ) {
	global $product, $post;
  $field = get_field('tab_dimensions_packing', $product->get_id());
  if ($field):
      $tabs['dimensions_packing'] = array(
          'title'    => __( 'Габариты и упаковка', 'woocommerce' ),
          'priority' => 95,
          'callback' => 'pad_content_tab_dimensions_packing',
        );	
  endif;
  return $tabs;
}
function pad_content_tab_dimensions_packing(){
  global $product;
   $field = get_field('tab_dimensions_packing', $product->get_id());
    if ($field):
      the_field('tab_dimensions_packing', $product->get_id());
  endif;
}
add_filter( 'woocommerce_product_tabs', 'pan_add_tab_dimensions_packing', 10 );

/*Удаление сопуток из карточки товара*/
remove_action("woocommerce_after_single_product_summary","single_related_product");

function footer_single_product(){?>
  <div class="info_single_product">
    <div class="title_info_single_product">
      <div class="info">
        <p>Вы не получили полную информацию о товаре?</p>
        <p>Оставьте свой вопрос или позвоните нам <a href="tel:88005007982">8 800 500 79 82</a></p>
      </div>      
      <input class="btn_add_info" onclick="jQuery.fancybox({href:'#add_info_single_product'});" type="button" value="Задать вопрос"/>
    </div>
    <div class="fancybox-hidden">
      <div id="add_info_single_product" class="form_info_single_product">
        <?php echo do_shortcode('[contact-form-7 id="9252" title="Получить информацию о товаре"]');?>
      </div>
    </div>    
  </div>
<?php
}
add_action('woocommerce_after_single_product','footer_single_product');

add_filter( 'woocommerce_product_add_to_cart_text', 'custom_promo_add_to_cart_text' );  // 2.1 +
  
function custom_promo_add_to_cart_text($default) {
  return '';
}
/*Image Block*/
function custom_promo_add_div_start(){
  echo '<div class="product_image_block">';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'custom_promo_add_div_start', 1 );
function custom_promo_add_div_end(){
  echo '</div>';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'custom_promo_add_div_end', 99 );

/*Change tag h2 to div*/
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'abChangeProductsTitle', 10 );
function abChangeProductsTitle() {
    echo '<div class="h2 woocommerce-loop-product__title">' . get_the_title() . '</div>';
}
remove_action( 'woocommerce_shop_loop_subcategory_title','woocommerce_template_loop_category_title', 10 );
add_action('woocommerce_shop_loop_subcategory_title', 'abChangeCategoryTitle', 10 );
function abChangeCategoryTitle($category) {
   ?>
		<div class="h2 woocommerce-loop-category__title">
			<?php
			echo esc_html( $category->name );

			if ( $category->count > 0 ) {
				echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html( $category->count ) . ')</mark>', $category ); // WPCS: XSS ok.
			}
			?>
		</div>
		<?php
}

/*Price and Button*/
function custom_promo_add_div_price_start(){
  global $product;
  $css = ' df';
  if($product->get_sale_price()){
    $css = '';
  }
  echo '<div class="product_price_button_block'.$css.'">';
}
add_action( 'woocommerce_shop_loop_item_title', 'custom_promo_add_div_price_start', 98 );

function custom_promo_add_div_price_end(){
  echo '</div>';
}
add_action( 'woocommerce_after_shop_loop_item', 'custom_promo_add_div_price_end', 98 );

function custom_hidden_product_cat($terms, $taxonomies, $args){
  $new_terms = array();
  // если находится в товарной категории и на странице магазина
  if(in_array( 'product_cat', $taxonomies) && !is_admin() && (is_product_category() || is_shop()) && empty($_GET['orderby'])):
    $arr_id = get_field('hidden_product_cat','option');
    if($arr_id){      
      foreach($terms as $key => $term){
        if(!in_array($term->term_id, $arr_id)){
          $new_terms[] = $term;
        }
      }
      $terms = $new_terms;
    }    
  endif;
  return $terms;
}
add_filter( 'get_terms', 'custom_hidden_product_cat', 10, 3 );

function get_preview_and_video_to_url($url){
  $parse_url = parse_url($url);
  $param_video = '';
  $param_preview = '';
  $result = array();
  $host = $parse_url['host'];
  if($host == 'www.instagram.com' || $host == 'instagram.com'){
    //$site_html =  file_get_contents($url);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $site_html = curl_exec($ch);
    curl_close($ch);
    $matches = null;
    preg_match_all('~<\s*meta\s+property="(og:[^"]+)"\s+content="([^"]*)~i', $site_html, $matches);
    $ogtags = array();
    for($i = 0; $i < count($matches[1]); $i++)
    {
        $ogtags[$matches[1][$i]]=$matches[2][$i];
    }
    $result['image'] = $ogtags['og:image'];
    $result['video'] = $ogtags['og:video'];
    $result['srcset'] = '';
  }elseif($host == 'www.youtube.com' || $host == 'youtube.com'){
    parse_str($parse_url['query'], $query);
    $id_video = $query['v'];
    $result['image'] = 'https://i.ytimg.com/vi/'.$id_video.'/hqdefault.jpg';
    $result['video'] = 'https://www.youtube.com/embed/'.$id_video.'?autoplay=1&autohide=1&rel=0';
    $result['srcset'] = 'https://i.ytimg.com/vi/'.$id_video.'/default.jpg 120w, 
      https://i.ytimg.com/vi/'.$id_video.'/mqdefault.jpg 320w, 
      https://i.ytimg.com/vi/'.$id_video.'/hqdefault.jpg 480w, 
      https://i.ytimg.com/vi/'.$id_video.'/sddefault.jpg 680w';
  }else{
    $result['image'] = 'none';
    $result['video'] = 'none';
    $result['srcset'] = '';
  }
  return $result;
}
add_filter( 'wc_product_post_type_link_product_cat', function( $term, $terms, $post ) {
    $primary_cat_id = get_post_meta( $post->ID, '_yoast_wpseo_primary_product_cat', true );
    if ( $primary_cat_id && $term->term_id != $primary_cat_id ) {
        foreach ( $terms as $term_key => $term_object ) {
            if ( $term_object->term_id == $primary_cat_id ) {
                $term = $terms[ $term_key ];
                break;
            }
        }
    }
    return $term;
}, 10, 3 );
function WC_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Mobile-Sidebar-Shop', 'belmarco' ),
		'id'            => 'woo_mob_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'belmarco' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
}
add_action( 'widgets_init', 'WC_widgets_init' );

  add_action( 'woocommerce_before_shop_loop','btn_mob_filter',20);
  function btn_mob_filter(){
    echo '<div class="btn_filter_content mobile_view">';
      echo '<button type="button" id="btn_mob_filter" class="">';
        echo '<span class="title-filter_btn">Фильтры</span>';
      echo '</button>';
    echo '</div>';
  }
/*  
  add_action( 'woocommerce_before_shop_loop','content_mob_filter',10);
  function content_mob_filter(){
    echo '<div id="content_mob_filter" class="content_mob_filter">';
    echo '<div class="header_mob_menu"><div class="close">&#9746;</div></div>';
      belmarco_ordering();
      echo '<aside id="secondary" class="widget-area">';
        if (is_woocommerce() && is_active_sidebar( 'woo_mob_sidebar' )) dynamic_sidebar( 'woo_mob_sidebar' );
      echo '</aside>';
    echo '</div>';
  }
*/
function link_anchor_wc_comment(){
  if ( is_product() ) {
    $html = '<script type="text/javascript">';
      $html .= 'jQuery(window).load(function() {var s = window.location.hash; jQuery(\'a[href="\'+s+\'"]\').click();});';
    $html .= '</script>';
    echo $html; 
  }
}
add_action("wp_footer", "link_anchor_wc_comment", 99);

/* MINI CART */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
  ob_start();?>
  <div id="mini_cart">
    <div class="cart__quantity"><?php echo WC()->cart->get_cart_contents_count(); ?> ед.</div>
    <div class="cart__amount"><?php echo WC()->cart->get_cart_total(); ?></div>
  </div>
  <?php $fragments['#mini_cart'] = ob_get_clean();
	return $fragments;
}
/* MINI CART Mobile */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_mob_fragment' );
function woocommerce_header_add_to_cart_mob_fragment( $fragments ) {
	global $woocommerce;
  ob_start();?>
  <div id="mini_cart_mob" class="cart__count"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
  <?php $fragments['#mini_cart_mob'] = ob_get_clean();
	return $fragments;
}

add_filter( 'woocommerce_billing_fields' , 'woocommerce_billing_fields_custom' );
// Эта операция выполняется в файле
// woocommerce/checkout/form-billing.php
function woocommerce_billing_fields_custom( $fields ) {

	//Order Billing fields
	$fields['billing_email']['priority'] = 1;
	$fields['billing_phone']['priority'] = 2;
  
  $fields['billing_email']['required'] = false;
	$fields['billing_first_name']['required'] = false;
  $fields['billing_address_1']['required'] = false;
  $fields['billing_city']['required'] = false;

	return $fields;
}

// Принудительный сброс E-mail как обязательное поле
add_filter( 'woocommerce_checkout_fields' , function( $fields ) {
  $fields['billing']['billing_email']['required'] = false;
  return $fields;
}, 9999, 1 );

function wc_get_really_curr_tax(){
  $really_curr_tax = isset( $_GET['really_curr_tax'] ) ? sanitize_text_field( wp_unslash( $_GET['really_curr_tax'] ) ) : '';
  if ( $really_curr_tax ) {
	  $really_curr_tax = explode( '-', $really_curr_tax, 2 );

		if ( count( $really_curr_tax ) < 2 ) {
			return false;
		}

		$term = get_term( $really_curr_tax[0], $really_curr_tax[1] );

		if ( ! is_wp_error( $term ) ) {
			return $term;
		}
	}
  return '';
}

function wc_tags_cat($id_cat){
  $term_tags = get_field('tags_cat', $id_cat);  
  $tags_html = '<div class="owl-tags owl-carousel tags">';
  foreach( $term_tags as $term ){
    $term_id = $term->taxonomy . '_' . $term->term_id;
    $title_tag = (get_field('title_tag', $term_id)) ? get_field('title_tag', $term_id) : $term->name;     
    //$tags_html .= '<a href="'.get_term_link( $term ).'"><span>'.$title_tag.'</span><span class="sep">→</span><span class="count">'.$term->count.'</span></a>';  
    $tags_html .= '<a href="'.get_term_link( $term ).'"><span>'.$title_tag.'</span></a>';    
  }
  if(have_rows('custom_tags_cat', $id_cat)){
    while(have_rows('custom_tags_cat', $id_cat)){ the_row();
      $tags_html .= '<a href="'.get_sub_field('url').'"><span>'.get_sub_field('name').'</span></a>';
    }
  }
  $tags_html .= '</div>';
  echo $tags_html;
}

function remove_woocommerce_catalog_orderby( $orderby ) {
  unset($orderby["rating"]); // по рейтингу
  unset($orderby["date"]); //по новизне или по дате
  return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "remove_woocommerce_catalog_orderby", 20 );

/* Скрипт при совершении покупки */
add_action( "wp_head", "gtm_thankyou_header_script", 20 );
function gtm_thankyou_header_script() { 
	if(function_exists('is_order_received_page') && is_order_received_page() && $_GET['key']){
    // https://docs.woocommerce.com/wc-apidocs/class-WC_Order.html 
    $id = wc_get_order_id_by_order_key($_GET['key']);
    $order = new WC_Order($id);
    $order_total = $order->get_total();			
  ?>        
  <script>
    gtag('event', 'conversion', {
          'send_to': 'AW-807979509/sOQJCIWhhZQBEPWTo4ED',
          'value': <?php echo $order_total;?>,
          'currency': 'RUB',
          'transaction_id': '<?php echo $id;?>'
    });
  </script>
  <?php
	}
}

/*
if(wp_is_mobile()){
  remove_action('woocommerce_single_product_summary','woocommerce_template_single_title', 5);
  add_action('woocommerce_before_single_product_summary','woocommerce_template_single_title', 5);
}*/

function yoast_breadcrumb_mobile( $before = '', $after = '', $display = true ) {
  if ( function_exists( 'yoast_breadcrumb' ) ) {
    $breadcrumbs_enabled = current_theme_supports( 'yoast-seo-breadcrumbs' );	
    if ( ! $breadcrumbs_enabled ) {			
	  $breadcrumbs_enabled = WPSEO_Options::get( 'breadcrumbs-enable', false );
	}
    if ( $breadcrumbs_enabled ) {
      $links = yoast_breadcrumb_getLinks();
	  if($links[0]['href'] == home_url('/') ){
        unset($links[0]); //Удаление ссылки на Главную
	  }
      $breadcrumbs = '';
      $sep = apply_filters( 'wpseo_breadcrumb_separator', WPSEO_Options::get( 'breadcrumbs-sep' ) );
      foreach($links as $key => $link){
        $breadcrumbs .= '<span>';
        $breadcrumbs .= '<a href="'.$link['href'].'">'.$link['text'].'</a>';
        //if($link != end($links)){
          $breadcrumbs .= ' '.$sep.' ';
        //}
        $breadcrumbs .= '</span>';
      }      
      if($display){
        echo $before.$breadcrumbs.$after;
      }else{
        return $before.$breadcrumbs.$after;
      }
    }
  }
}

function yoast_breadcrumb_getLinks(){
  $crumb = array(); 
  $dom = new DOMDocument();
  $dom->loadHTML(yoast_breadcrumb('', '', false));
  $items = $dom->getElementsByTagName('a'); 
  foreach ($items as $tag){
    $crumb[] =  array('text' => utf8_decode($tag->nodeValue), 'href' => $tag->getAttribute('href'));
  }
  //Get the current page text and href 
  /*$items = new DOMXpath($dom);
  $dom = $items->query('//*[contains(@class, "breadcrumb_last")]');
  $crumb[] = array('text' => utf8_decode($dom->item(0)->nodeValue), 'href' => trailingslashit(home_url($wp->request)));*/
  return $crumb;  
}

// Ленивая загрузка для превью товаров
/*remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
function woocommerce_template_loop_product_thumbnail() {
  $lazyload_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'shop_catalog');
  echo '<img data-src="' . $lazyload_image_src[0] . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazyload" />';
}  */
add_action('woocommerce_single_product_summary', 'promo_div_price_block_start', 20);
function promo_div_price_block_start(){
  echo '<div class="block_price">';
}
add_action('woocommerce_single_product_summary', 'promo_div_price_block_end', 35);
function promo_div_price_block_end(){
  echo '</div>';
}
add_action('woocommerce_single_product_summary', 'promo_div_price_text_block_start', 24);
function promo_div_price_text_block_start(){
  echo '<div class="block_text_price">';
}
add_action('woocommerce_single_product_summary', 'promo_div_price_text_block_end', 27);
function promo_div_price_text_block_end(){
  echo '</div>';
}

add_filter( 'the_title', 'promo_the_title_product', 10, 2 );
function promo_the_title_product($title, $id){  
  if(get_field('short_title', $id)){
    $title = get_field('short_title', $id);
    return $title;
  }else{
    return $title;
  }
} 

function main_urls_product() {
  $html = '<div class="product-apps"><div class="row">';  
  if(get_field('url_video')){
    $html .= '<div class="icon col-xs-4">';
      $html .= '<a href="https://www.youtube.com/watch?v='.get_field('url_video').'" class="video fancybox-youtube"><span>Смотреть видео</span></a>';
    $html .= '</div>';
  }
  if(get_field('url_3d')){
    $html .= '<div class="icon col-xs-4">';
      $html .= '<a href="#url_3d" class="url_3d fancybox-inline"><span>3D обзор</span></a>';
    $html .= '</div>';
  }
  if (get_field('url_ar')){
    $html .= '<div class="icon col-xs-4">';
      $html .= '<a href="#url_ar" class="url_ar fancybox-inline"><span>Примерка</span></a>';
    $html .= '</div>';
  }
  $html .= '</div></div>';
  echo $html;
}
add_action( 'promo_after_single_product','main_urls_product', 10);

function product_instruction_ar(){
  $html = '';
  if(get_field('url_3d') || get_field('url_ar')){
    $html .= '<div class="fancybox-hidden">';
    if(get_field('url_3d')){
      $html .= '<div id="url_3d" class="product-apps-content"><div class="content">';
        $html .= '<div class="row">';
          $html .= '<div class="col-xs-12"><a href="'.get_field('url_3d').'" class="btn" rel="nofollow">Открыть</a></div>';
          $html .= '<div class="col-xs-6"><div class="icon icon_zoom"></div><div class="name">Приближайте</div></div>';
          $html .= '<div class="col-xs-6"><div class="icon icon_pinch"></div><div class="name">Отдаляйте</div></div>';
          $html .= '<div class="col-xs-6"><div class="icon icon_rotate"></div><div class="name">Крутите 360&deg;</div></div>';
          $html .= '<div class="col-xs-6"><div class="icon icon_press_drag"></div><div class="name">Перемещайте</div></div>';
        $html .= '</div>';
      $html .= '</div></div>';      
    }
    if(get_field('url_ar')){
      $html .= '<div id="url_ar" class="product-apps-content"><div class="content">';
        $html .= '<div class="row">';
          $html .= '<div class="col-xs-12"><a href="'.get_field('url_ar').'" class="btn" rel="nofollow">Примерить в комнате</a></div>';
          $html .= '<div class="col-xs-6"><div class="icon icon_zoom"></div><div class="name">Приближайте</div></div>';
          $html .= '<div class="col-xs-6"><div class="icon icon_pinch"></div><div class="name">Отдаляйте</div></div>';
          $html .= '<div class="col-xs-6"><div class="icon icon_rotate_2"></div><div class="name">Крутите 360&deg;</div></div>';
          $html .= '<div class="col-xs-6"><div class="icon icon_press_drag_2"></div><div class="name">Перемещайте</div></div>';
          $html .= '<div class="col-xs-12"><div class="info">Работает на iPhone (начиная с 6s) или на Android-устройствах, поддерживающих технологию ARCore.</div></div>';
        $html .= '</div>';
      $html .= '</div></div>';      
    }
    $html .= '</div>';
  }
  echo $html;
}
add_action('woocommerce_after_single_product', 'product_instruction_ar', 99);

add_filter( 'me_offer_url_params', 'promo_utm_tags_ym', 10, 2);
function promo_utm_tags_ym($url_params_item, $offer_id){ 
  $url_params_item = 'utm_medium=cpc&utm_source=market&utm_term='.$offer_id;
  return $url_params_item;
}

function promo_product_urls_cat(){
  $html = '';
  if(get_field('cat_urls')){
    $arr = explode(';', get_field('cat_urls'));
    $arr = array_diff($arr, array(''));
    $links = array();
    foreach($arr as $key => $val){
      $links[$key]['name'] = stristr($val, '#', true);
      $links[$key]['url'] = str_replace('#', '', stristr($val, '#'));
    }
    $html .= '<div class="product-cat-urls">';
    $html .= '<div class="tab-title">Смотреть еще категории</div>';
    foreach($links as $link){
      $html .= '<a href="'.$link['url'].'">'.$link['name'].'</a>';
    }
    $html .= '</div>';
  }
  echo $html;
}
add_action('woocommerce_after_single_product_summary', 'promo_product_urls_cat', 10);

add_filter( 'woocommerce_cart_item_quantity', 'promo_wc_cart_item_quantity', 10, 3 );
function promo_wc_cart_item_quantity( $product_quantity, $cart_item_key, $cart_item ){
  $min = (isset($cart_item['min']) && $cart_item['min'] > 0) ? $cart_item['min'] : 1;
  $css_min = ' disabled';
  if($cart_item['quantity'] > $min){
    $css_min = '';
  }
  $product_quantity = '<div class="quantity qty-block">';
    $product_quantity .= '<button class="btn minus'.$css_min.'" type="button">-</button>';
      $product_quantity .= '<input type="number" name="cart['.$cart_item_key.'][qty]" step="1" min="'.$min.'" max="'.$cart_item['max'].'" value="'.$cart_item['quantity'].'" class="input-text qty text" title="Кол-во" inputmode="numeric" />';
    $product_quantity .= '<button class="btn plus" type="button">+</button>';
  $product_quantity .= '</div>';
  return $product_quantity;
}

function promo_chosen_shipping_method(){
  global $woocommerce;
  $res = array(
    'name' => '',
    'price' => ''
  );
  foreach( $woocommerce->session->get('shipping_for_package_0')['rates'] as $method_id => $rate ){
    if( $woocommerce->session->get('chosen_shipping_methods')[0] == $method_id ){
      /*$rate_label = $rate->label; // The shipping method label name
      $rate_cost_excl_tax = floatval($rate->cost); // The cost excluding tax
      // The taxes cost
      $rate_taxes = 0;
      foreach ($rate->taxes as $rate_tax){
        $rate_taxes += floatval($rate_tax);
      }        
      // The cost including tax
      $rate_cost_incl_tax = $rate_cost_excl_tax + $rate_taxes;
      $res['name'] = $rate_label;
      $res['price'] = $rate->cost;*/
      $res['name'] = $rate;
      break;
    }
  }
}

function promo_get_shipping_name_by_id( $shipping_id ) {
  global $woocommerce;
  $packages = $woocommerce->shipping->get_packages();
  foreach ( $packages as $i => $package ) {
    if ( isset( $package['rates'] ) && isset( $package['rates'][ $shipping_id ] ) ) {
      $rate = $package['rates'][ $shipping_id ];
      //return apply_filters('woocommerce_cart_shipping_method_full_label', $rate->get_label(), $rate);
      $res = array();
      /* @var $rate WC_Shipping_Rate */
      preg_match('/(.*) \((.*)\) \(([\d]+.*)\): (.*)/', $rate->get_label(), $matches);
      if($matches){
        $res['name'] = $matches[1];
        $res['city'] = $matches[2];
        $res['day'] = $matches[3];
        $res['price'] = $matches[4];
      }else{
        return $rate->get_label();
      }
      return $res;
    }
  }
  return '';
}
function promo_generate_my_order_block($id = 'promo-my-order-block'){
  global $woocommerce; 
  $html = '';
  if($woocommerce->cart->get_cart()){
    $count = $woocommerce->cart->get_cart_contents_count();
    $count_text = 'товар';
    if($count > 1 && $count_text < 5){
      $count_text = 'товара';
    }elseif($count >= 5){
      $count_text = 'товаров';
    }
    $subtotal = $woocommerce->cart->get_cart_subtotal();
    $shipping = promo_get_shipping_name_by_id($woocommerce->session->get('chosen_shipping_methods')[0]);
    if(is_array($shipping)){
      $price = $shipping['price'];
    }else{
      $price = $shipping;
    }
    $total = $woocommerce->cart->get_cart_total();
    $html .= '<div id="'.$id.'" class="promo-my-order-block">';
      $html .= '<div class="title">Мой заказ</div>';
      $html .= '<div class="content">';
        $html .= '<div class="count"><div>'.$count.' '.$count_text.'</div><div>'.$subtotal.'</div></div>';
        $html .= '<div class="delivery"><div>Доставка</div><div>'.$price.'</div></div>';        
      $html .= '</div>';
    //$html .= '<div class="total"><span>Итого</span><span class="total-price">'.$total.'</span></div>';
    $html .= '</div>';
  }
  echo $html;
}

function promo_add_shortcode_geolink(){
  echo do_shortcode('[wc_geo_promo_getLink]');
}
add_action('wc_duplicate_before_shipping', 'promo_add_shortcode_geolink', 10);

function promo_woocommerce_cart_shipping_method_full_label($label, $method){  
  preg_match('/(.*) \((.*)\) \(([\d]+.*)\): (.*)/', $label, $matches);
  if($matches){
    $options = get_option( 'woocommerce_'.$method->method_id.'_'.$method->instance_id.'_settings', true );
    $css_price = '';
    if($options && isset($options['free_shipping_text']) && $options['free_shipping_text'] == $matches[4]){
      $css_price = 'free_method';
    }
    $label = '<span class="ship-name">'.$matches[1].'</span> <span class="ship-day">'.$matches[3].'</span> &mdash; <span class="ship-price '.$css_price.'">'.$matches[4].'</span>';
  }
  return $label;
}
add_filter('woocommerce_cart_shipping_method_full_label', 'promo_woocommerce_cart_shipping_method_full_label', 10, 2);

function promo_ajax_qty_yith_wcap_cart() {
  $cart_item_key = $_POST['hash'];
  $count = intval($_POST['quantity']);
  $product_values = WC()->cart->get_cart_item( $cart_item_key );
  $product_quantity = apply_filters( 'woocommerce_stock_amount_cart_item', apply_filters( 'woocommerce_stock_amount', $count ), $cart_item_key );
  $passed_validation  = apply_filters( 'woocommerce_update_cart_validation', true, $cart_item_key, $product_values, $product_quantity );

  if ( $passed_validation ) {
    WC()->cart->set_quantity( $cart_item_key, $product_quantity, true );
    echo 'success';
  }    
  wp_die();
}

add_action('wp_ajax_promo_qty_yith_wcap_cart', 'promo_ajax_qty_yith_wcap_cart');
add_action('wp_ajax_nopriv_promo_qty_yith_wcap_cart', 'promo_ajax_qty_yith_wcap_cart');

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_popup_yith_fragment' );
function woocommerce_popup_yith_fragment( $fragments ) {
	global $woocommerce;
  ob_start();?>
  <div id="promo_wcap_cart_totals" class="cart-totals">
    <?php echo __( 'Cart Total', 'yith-woocommerce-added-to-cart-popup' ) . ':' ?>
    <span class="cart-cost">
      <?php echo WC()->cart->get_cart_total(); ?>
    </span>
  </div>
  <?php $fragments['#promo_wcap_cart_totals'] = ob_get_clean();
	return $fragments;
}
