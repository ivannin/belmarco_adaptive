<?php 
/*function criteo_main_js(){
  wp_enqueue_script( 'criteo-js', '//static.criteo.net/js/ld/ld.js', array(''), null, false );
}
add_action( 'wp_enqueue_scripts', 'criteo_main_js' );*/

function criteo_getIdProduct($slug){
  $arr_ids = array();
  $products = new WP_Query(array(
    'posts_per_page' => 10,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'post_type' => 'product',
    'product_cat' => $slug,
  ));
  if($products->have_posts()){
    while($products->have_posts()){ $products->the_post();
      $arr_ids[] = get_the_ID();
    }
  }
  return $arr_ids;
}

function criteo_template($event){
  $js = '<!-- Start Criteo OneTag -->';
  $js .= '<script type="text/javascript" src="//static.criteo.net/js/ld/ld.js" async="true"></script>'.PHP_EOL;
  $js .= '<script type="text/javascript">'.PHP_EOL;
    $js .= 'window.criteo_q = window.criteo_q || [];'.PHP_EOL;
    $js .= 'var deviceType = /iPad/.test(navigator.userAgent) ? "t" : /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Silk/.test(navigator.userAgent) ? "m" : "d";'.PHP_EOL;
    $js .= 'window.criteo_q.push('.PHP_EOL;
      $js .= '{ event: "setAccount", account: 57667}, '.PHP_EOL;
      $js .= '{ event: "setEmail", email: "" }, '.PHP_EOL;          
      $js .= '{ event: "setSiteType", type: deviceType},'.PHP_EOL;
      $js .= $event;
    $js .= ');</script>'.PHP_EOL;
  $js .= '<!-- End Criteo OneTag -->';
  return $js;
}
function criteo_js(){
  $result = '';
  if(is_front_page()){// *** Главная страница ***
    $js = '{ event: "viewHome"}'.PHP_EOL;
    $result = criteo_template($js);
  }elseif(is_product_category()){ // *** Страница категории товаров ***
    $category = get_queried_object();
    $slug = $category->slug;
    $ids_product = criteo_getIdProduct($slug);
    $str_ids = implode(", ", $ids_product);
    $js = '{ event: "viewList", item: ['.$str_ids.'] }';
    $result = criteo_template($js);
  }elseif(is_product()){ // *** Страница товара ***
    global $product;
		$id_product = $product->get_id();
    $js = '{ event: "viewItem", item: "'.$id_product.'" }';
    $result = criteo_template($js);
  }elseif(is_cart()){ // *** Страница корзины ***
    global $woocommerce;
    $items = $woocommerce->cart->get_cart();
    $js = '{ event: "viewBasket", item: [';
    foreach($items as $item => $values) {
      $price = get_post_meta($values['product_id'] , '_price', true);
      $js .= '{id: "'.$values['data']->get_id().'", price: '.$price.', quantity: '.$values['quantity'].' },';
    }
    $js .= ']}';
    $result = criteo_template($js);
  }  
  echo $result;
}
add_action("wp_footer", "criteo_js");

/*При совершение покупки*/
function criteo_thankyou_js($order_id){
  $order = wc_get_order($order_id);
	$js = '{ event: "trackTransaction", id: '.$order_id.', item: [';
  foreach( $order->get_items() as $item_id => $item) {
    $quantity = wc_get_order_item_meta($item_id, '_qty', true);
    //$item_total = wc_get_order_item_meta($item_id, '_line_total', true);
    $product_variation_id = $item['variation_id'];
    $product = '';
	  if ( $product_variation_id ){
			$product = new WC_Product($item['variation_id']);
		}else{
			$product = new WC_Product($item['product_id']);
		}
    $price = $product->get_price();
    $js .= '{id: "'.$item->get_product_id().'", price: '.$price.', quantity: '.$quantity.' },';
  }
  $js .= ']}';
	$result = criteo_template($js);
	echo $result;
}
add_action( "woocommerce_thankyou", "criteo_thankyou_js" );
add_action( 'boc_wc_success_footer', 'criteo_thankyou_js', 10);
?>