<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();
$attributes = array();
$attributes['title'] = $props['title'];
$attributes['alt'] = $props['alt'];
//custom field image
$field_custom_img = get_field('image_preview_single_product');
if($field_custom_img){
  $full_size_image_custom = wp_get_attachment_image_src( $field_custom_img, 'full' );			
  $attributes['srcset'] = wp_get_attachment_image_srcset($field_custom_img);
  $attributes['src'] = $full_size_image_custom[0];
  $attributes['data-src'] = $full_size_image_custom[0];
  $attributes['data-large_image'] = $full_size_image_custom[0];
  $attributes['data-large_image_width'] = $full_size_image_custom[1];
  $attributes['data-large_image_height'] = $full_size_image_custom[2];
}
$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), $attributes );
			
if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
	<div class="thumbnails <?php echo 'columns-' . $columns; ?>"><?php
    echo $image;
		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			if ( $loop === 0 || $loop % $columns === 0 ) {
				$classes[] = 'first';
			}

			if ( ( $loop + 1 ) % $columns === 0 ) {
				$classes[] = 'last';
			}

			$image_class = implode( ' ', $classes );
			$props       = wc_get_product_attachment_props( $attachment_id, $post );
      $props['class'] = 'thumb';
			if ( ! $props['url'] ) {
				continue;
			}

			echo wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $props );
				/*sprintf(
					'<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>',
					esc_url( $props['url'] ),
					esc_attr( $image_class ),
					esc_attr( $props['caption'] ),
					wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $props )
				);*/
			$loop++;
		}

	?></div>
	<?php
}
