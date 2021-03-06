<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
?>
<div class="images">
	<?php
		if ( has_post_thumbnail() ) {
			$attachment_count = count( $product->get_gallery_attachment_ids() );
			$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
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
			$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), $attributes );
			echo sprintf(
					'<a href="%s" itemprop="image" class="main_xoo_qv_img" title="%s">%s</a>',
					esc_url( $props['url'] ),
					esc_attr( $props['caption'] ),
					$image
				);
		} else {
			echo sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) );
		}

		do_action('xoo_qv_after_product_image');
	?>
</div>
