<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>	
	  <div class="cart-list">
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
          <div class="item">
            <div class="row std">
              <div class="col-xs-4 col-sm-2">
                 <div class="item-thumb">
                  <?php
                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                    if ( ! $product_permalink ) {
                      echo $thumbnail;
                    } else {
                      printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                    }
                  ?>
						    </div>
              </div>
						  <div class="col-xs-8 col-sm-10">
                <div class="row std">
                  <div class="col-xs-12 col-sm-5">
                    <div class="item-info" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                <?php
                  if ( ! $product_permalink ) {
                    echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
                  } else {
                    echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="item-name">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
                  }

                  // Meta data
                  echo WC()->cart->get_item_data( $cart_item );

                  // Backorder notification
                  if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                    echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
                  }
                ?>
              </div>
                  </div>
                  <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
						        <div class="item-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                      <?php
                        echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                      ?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-7 block-bottom">
                    <div class="item-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                  <?php
                    if ( $_product->is_sold_individually() ) {
                      $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                    } else {
                      $product_quantity = woocommerce_quantity_input( array(
                        'input_name'  => "cart[{$cart_item_key}][qty]",
                        'input_value' => $cart_item['quantity'],
                        'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                        'min_value'   => '0',
                      ), $_product, false );
                    }

                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                  ?>
                </div>
                    <div class="item-price hidden-xs" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                      <?php
                        echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                      ?>
                    </div>
                    <div class="item-remove">
                      <?php
                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                          '<a href="%s" class="remove remove-item" aria-label="%s" data-product_id="%s" data-product_sku="%s"></a>',
                          esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                          __( 'Remove this item', 'woocommerce' ),
                          esc_attr( $product_id ),
                          esc_attr( $_product->get_sku() )
                        ), $cart_item_key );
                      ?>
                    </div>
                  </div>
                
					    </div>
            </div>
          </div>
          </div>
					<?php
				}
			}
			?>	
    </div>
		<div class="button-info">
			<?php do_action( 'woocommerce_cart_contents' ); ?>
      <div class="buttons">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>" />
          </div>
          <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
            <div class="total_cart total_m">
              ??????????: <?php echo WC()->cart->get_cart_total(); ?>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <?php echo do_shortcode('[boc_wc_cart]');?>
          </div>
        </div>
      </div>
      <div class="total_cart hidden-xs">
			  ??????????: <?php echo WC()->cart->get_cart_total(); ?>
		  </div>	
      <?php do_action( 'woocommerce_cart_actions' ); ?>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</div>
  <?php wp_nonce_field( 'woocommerce-cart' ); ?>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>
<div class="cart-collaterals">
	<?php do_action( 'woocommerce_cart_collaterals' ); ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
