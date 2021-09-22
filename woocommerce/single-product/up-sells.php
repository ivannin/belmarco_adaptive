<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

global $product;
$assoc_products = get_field('associated_product', $product->id);
if(get_field('alt_associated_product', $product->id)){
  $temp = get_field('alt_associated_product', $product->id);
  $assoc_products = explode(',', $temp);
}
$recom_products = get_field('recommend_product', $product->id);
if(get_field('alt_recommend_product', $product->id)){
  $temp = get_field('alt_recommend_product', $product->id);
  $recom_products = explode(',', $temp);
}
$upsells_ids = $product->get_upsells();
if(get_field('alt_upsells', $product->id)){
  $temp = get_field('alt_upsells', $product->id);
  $upsells_ids = explode(',', $temp);
}
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}?>
	<section class="up-sells upsells products">
		<div class="woocommerce-tabs wc-tabs-second-wrapper">
			<ul class="tabs wc-tabs" role="tablistSecond">
        <?php if($assoc_products && count($assoc_products) > 0):?>
				<li class="like-product-tab" id="tab-title-like-product" role="tab" aria-controls="tab-like-product">
					<a href="#tab-like-product">
						C этим товаром покупают
					</a>
				</li>
				<?php endif;?>
        <?php if ( $recom_products && count($recom_products) > 0 ):?>
				<li class="recom-product-tab" id="tab-title-recom-product" role="tab" aria-controls="tab-recom-product">
					<a href="#tab-recom-product">
						Рекомендуемые товары
					</a>
				</li>
				<?php endif;?>
				<?php if ( $upsells_ids ):?>
				<li class="up-sells-tab" id="tab-title-up-sells" role="tab" aria-controls="tab-up-sells">
					<a href="#tab-up-sells">
						Похожие товары
					</a>
				</li>
				<?php endif;?>        	
			</ul>			
			<?php if($assoc_products && count($assoc_products) > 0):?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--like-product panel entry-content wc-tab" id="tab-like-product" role="tablistSecond" aria-labelledby="tab-title-like-product">
				<ul class="owl-carousel products">
				<?php 
					foreach($assoc_products as $item_id){
					 	$post_object = get_post( $item_id );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' );
						
						wp_reset_postdata();
					};
				?>
        </ul>
			</div>
			<?php endif;?>
      <?php if($recom_products && count($recom_products) > 0):?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--recom-product panel entry-content wc-tab" id="tab-recom-product" role="tablistSecond" aria-labelledby="tab-title-recom-product">
				<ul class="owl-carousel products">
				<?php 
					foreach($recom_products as $item_id){
					 	$post_object = get_post( $item_id );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' );
						
						wp_reset_postdata();
					};
				?>
        </ul>
			</div>
			<?php endif;?>
      <?php if ( $upsells_ids ):?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--up-sells panel entry-content wc-tab" id="tab-up-sells" role="tablistSecond" aria-labelledby="tab-title-up-sells">
        <ul class="owl-carousel products">
				<?php foreach ( $upsells_ids as $upsell ) : ?>
					<?php
					 	$post_object = get_post( $upsell );
						setup_postdata( $GLOBALS['post'] =& $post_object );
						wc_get_template_part( 'content', 'product' ); 
					?>					
					<?php wp_reset_postdata();?>
				<?php endforeach; ?>
        </ul>
			</div>
			<?php endif;?>
		</div>

	</section>