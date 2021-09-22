<?php
/**
 * код отслеживания заказа и передачи транзации в Google Analytics
 */
 
//add_action( 'woocommerce_thankyou', 'belmarco_checkout_analytics' );
function belmarco_checkout_analytics( $order_id ) 
{
	//$order_id = 4643;
	
	// Формирование кода JS
	$outputJS = "<script>/* !!! DEBUG MODE !!!  ga = console.log; */" . PHP_EOL . 
		"ga('require', 'ecommerce');" . PHP_EOL;
	
	// Данные о заказе
	$outputJS .= "ga('Order ID:', {$order_id} );";
	$order = new WC_Order( $order_id );
	$total = $order->get_total();
	$shipping = $order->get_total_shipping();	
	
	$outputJS .= "ga('ecommerce:addTransaction', {
		'id': '{$order_id}',
		'revenue': {$total},
		'shipping': {$shipping}
	})" . PHP_EOL;

	// Элементы заказа
	$items = $order->get_items();
	foreach( $items as $item_id => $item ) 
	{

		$product_name = $item['name'];											// Get the product name
		$item_quantity = wc_get_order_item_meta($item_id, '_qty', true);			// Get the item quantity
		$item_total = wc_get_order_item_meta($item_id, '_line_total', true);		// Get the item line total
		
		// Check if product has variation
		$product_variation_id = $item['variation_id'];
		if ( $product_variation_id ) 
		{
		  $product = new WC_Product($item['variation_id']);
		} 
		else 
		{
		  $product = new WC_Product($item['product_id']);
		}

		// Get SKU
		$sku = $product->get_sku();
		if ( empty ( $sku ) ) $sku = $product_name;
		
		// Price
		$price = $product->get_price();
		
		// Category
		$cats = $product->get_category_ids();
		$category = '';
		if ( count( $cats ) > 0 )
		{
			$cat = get_term( $cats[0] );
			$category = $cat->name;
		}
		
		$outputJS .= "ga('ecommerce:addItem', {
			'id': '{$order_id}',
			'name': '{$product_name}',
			'category': '{$category}',
			'sku': '{$sku}',
			'price': {$price},
			'quantity': {$item_quantity}
		});" . PHP_EOL;		
	}

	$outputJS .= "ga('ecommerce:send');" . PHP_EOL . "</script>" . PHP_EOL;
	echo $outputJS;
}


