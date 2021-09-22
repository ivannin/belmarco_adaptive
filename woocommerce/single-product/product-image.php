<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 3.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$thumbnail_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'shop_thumbnail' );
$shop_single       = wp_get_attachment_image_src( $post_thumbnail_id, 'shop_single' );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images', 
) );

$src_full = $full_size_image[0];
$attributes = array(
	'title'                   => $image_title,
  'data-src'                => $full_size_image[0],
  'data-thumnail'           => $thumbnail_image[0],
  'data-medium'             => $shop_single[0],
  'data-large_image'        => $full_size_image[0],
	'data-large_image_width'  => $full_size_image[1],
	'data-large_image_height' => $full_size_image[2],
  'data-id'                 => 0,
);
		//custom field image
$field_custom_img = get_field('image_preview_single_product');
if($field_custom_img){
  $post_thumbnail_id = $field_custom_img;
	$full_size_image_custom = wp_get_attachment_image_src( $field_custom_img, 'full' );
  $thumbnail_image_custom = wp_get_attachment_image_src( $field_custom_img, 'shop_thumbnail' );
  $shop_single_custom = wp_get_attachment_image_src( $field_custom_img, 'cust_shop_single' );
  $src_full = $full_size_image_custom[0];
	$attributes['srcset'] = wp_get_attachment_image_srcset($field_custom_img);
	$attributes['src'] = $shop_single_custom[0];
  $attributes['data-src'] = $shop_single_custom[0];
	$attributes['data-thumnail'] = $thumbnail_image_custom[0];
  $attributes['data-medium'] = $shop_single_custom[0];
	$attributes['data-large_image'] = $full_size_image_custom[0];
	$attributes['data-large_image_width'] = $full_size_image_custom[1];
	$attributes['data-large_image_height'] = $full_size_image_custom[2]; 
  $attributes['width'] = 450;
  $attributes['height'] = 300;
}
$main_img_thumb = '';
if ( has_post_thumbnail() ) {
  $html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image" id="general-product-image">';
  $html .= '<a href="'.esc_url( $src_full ).'" class="wcps" data-gallery_id="owl-products-images">';
  $html .= get_the_post_thumbnail( $post->ID, 'cust_shop_single', $attributes );
  $html .= '</a>';
  $html .= '</div>';
        
  //Mobile
  $attributes_mob = $attributes;
  unset($attributes_mob['width']);
  unset($attributes_mob['height']);
  $html_m  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image" id="general-product-image">';
  $html_m .= get_the_post_thumbnail( $post->ID, 'cust_shop_thumbnail', $attributes_mob );
  $html_m .= '</div>';
        
  if($product->get_gallery_image_ids()){
    unset($attributes['src']);    
    $main_img_thumb .= '<div data-thumb="'.esc_url($attributes['data-thumnail']).'" class="woocommerce-product-gallery__image">';
    $main_img_thumb .= wp_get_attachment_image( $post_thumbnail_id, 'cust_shop_thumbnail', false, $attributes );
 		$main_img_thumb .= '</div>';
  }        
} else {
  $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
  $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
  $html .= '</div>';
}  
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper mobile_view">
	  <div id="owl-products-images-mob">
      <div class="owl-carousel all mob">
        <?php echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html_m, get_post_thumbnail_id( $post->ID ) );?>
        <?php do_action( 'woocommerce_product_thumbnails' );?>
      </div>
    </div>  
	</figure>
  <figure class="woocommerce-product-gallery__wrapper">
	  <?php echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );?>
    <div id="owl-products-images">
      <div class="owl-carousel all full">
        <?php echo $main_img_thumb;?>
        <?php do_action( 'woocommerce_product_thumbnails' );?>
      </div>
    </div>
	</figure>
  <?php do_action('promo_after_single_product');?>
</div>
