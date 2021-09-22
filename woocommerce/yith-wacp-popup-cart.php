<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
/**
 * Popup cart template
 *
 * @version 1.4.0
 */

if( ! defined( 'YITH_WACP' ) ) {
    exit;
}

?>
<div class="cart-header">
  <h3 class="cart-list-title"><?php echo apply_filters( 'yith_wacp_cart_popup_title', __( 'Your Cart', 'yith-woocommerce-added-to-cart-popup' ) ); ?></h3>
  <a href="#" class="yith-wacp-close"></a>
</div>
<div id="promo_wacp_list" class="cart-list">
	<?php foreach( WC()->cart->get_cart() as $item_key => $item ) :
		$_product   = apply_filters( 'woocommerce_cart_item_product', $item['data'], $item, $item_key );

		if ( $_product && $_product->exists() && $item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $item, $item_key ) ) :
			$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $item ) : '', $item, $item_key );
			?>
      <div class="item">
        <div class="row std">
          <?php if( $thumb ) : ?>
          <div class="col-xs-4 col-sm-2">
            <div class="item-thumb">
              <?php
              $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $item, $item_key );

              if ( ! $product_permalink ) {
                echo $thumbnail;
              } else {
                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
              }
              ?>
            </div>
          </div>					
          <?php endif; ?>

          <div class="col-xs-8 col-sm-10">
            <div class="row std">
              <div class="col-xs-12 col-sm-5">
                <div class="item-info">
                  <?php
                  // print the name
                  $_product_name = is_callable( array( $_product, 'get_name' ) ) ? $_product->get_name() : $_product->get_title();
                  if ( $_product->is_visible() ) {
                    $_product_name_html = '<a class="item-name" href="' . esc_url( $_product->get_permalink() ) . '">' . $_product_name . '</a>';
                  }
                  else {
                    $_product_name_html = '<span class="item-name">' . $_product_name . '</span>';
                  }
                  echo apply_filters( 'woocommerce_cart_item_name', $_product_name_html, $item, $item_key );
                  // Meta data
                  echo yith_wacp_get_formatted_cart_item_data( $item );

                  ?>
                </div>                
              </div>

              <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                <div class="item-price">
                  <?php echo $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $item, $item_key ); ?>
                </div>                
              </div>

              <div class="col-xs-12 col-sm-7 block-bottom">
                <div class="item-quantity">
                  <?php
                  if ( $_product->is_sold_individually() ) {
                    $product_quantity = '1';
                  }
                  else {
                    $product_quantity = woocommerce_quantity_input( array(
                    'input_name'    => "[{$item_key}][qty]",
                    'input_value'   => $item['quantity'],
                    'max_value'     => $_product->get_max_purchase_quantity(),
                    'min_value'     => '0',
                    'product_name'  => $_product->get_name(),
                    ), $_product, false );
                  }

                  echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $item_key, $item );
                  ?>
                </div>                 
                <div class="item-price hidden-xs">
                  <?php echo $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $item, $item_key ); ?>
                </div> 
                <div class="item-remove">
                  <?php
                  echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                    '<a href="%s" class="remove yith-wacp-remove-cart remove-item" aria-label="%s" data-item_key="%s"></a>',
                    esc_url( yith_wacp_get_cart_remove_url( $item_key ) ),
                    __( 'Remove item', 'yith-woocommerce-added-to-cart-popup' ),
                    $item_key
                  ), $item_key );
                  ?>
                </div>
              </div>              
            </div>          
          </div>				
        </div>
      </div>
		<?php endif;	
	endforeach; ?>
</div>

<?php do_action( 'yith_wacp_add_cart_info' );
