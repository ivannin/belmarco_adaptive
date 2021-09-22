<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */


if ( ! defined( 'YITH_WACP' ) ) {
exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$loop = 0;
$args = apply_filters( 'yith_wacp_related_products_args', array(
	'post_type'            	=> array( 'product', 'product_variation' ),
	'post_status'    		=> 'publish',
	'ignore_sticky_posts'  	=> 1,
	'no_found_rows'       	=> 1,
	'posts_per_page'       	=> $posts_per_page,
	'post__in'             	=> $items,
	'post__not_in'        	=> array( $current_product_id ),
	'orderby'             	=> 'rand'
) );

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>

<div class="woocommmerce yith-wacp-related">

	<h3><?php echo $title ?></h3>

	<ul class="products columns-<?php echo $columns ?>">

	<?php

    // Extra post classes
    $classes = array( 'yith-wacp-related-product' );
    // set column
    $woocommerce_loop['loop'] = 0;
    $woocommerce_loop['columns'] = $columns;

	while ( $products->have_posts() ) :
		$products->the_post(); ?>

		<li <?php post_class( $classes ); ?>>

			<?php do_action( 'yith_wacp_before_related_item' ) ?>

			<a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">

				<div class="product_image_block">
					<?php
					wc_get_template( 'loop/sale-flash.php' );
					$image_size = apply_filters('yith_wacp_suggested_product_image_size','shop_catalog');
					echo woocommerce_get_product_thumbnail( $image_size );
					?>
				</div>
				<div class="h2 woocommerce-loop-product__title"><?php the_title() ?></div>
      </a> 
		  <div class="product_price_button_block df">
				<a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
          <?php wc_get_template( 'loop/price.php' ); ?>
        </a>
        <?php if( $show_add_to_cart ) {
				echo do_shortcode( '[add_to_cart id="' . get_the_ID() . '" style="" show_price="false"]');
			  } ?>
			</div>

			<?php do_action( 'yith_wacp_after_related_item' ) ?>

		</li>

	<?php endwhile; // end of the loop. ?>

	</ul>

</div>

<?php endif;

wp_reset_postdata();