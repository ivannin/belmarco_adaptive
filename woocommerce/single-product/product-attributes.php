<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
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
 * @version     3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="shop_attributes tab_table">
	<?php if(!get_field('display_none_dimensions','options')):?>
		<?php if ( $display_dimensions && $product->has_weight() ) : ?>
			<div class="item">
				<div class="name"><?php _e( 'Weight', 'woocommerce' ) ?>:</div>
				<div class="product_weight"><?php echo esc_html( wc_format_weight( $product->get_weight() ) ); ?></div>
			</div>
		<?php endif; ?>

		<?php if ( $display_dimensions && $product->has_dimensions() ) : ?>
			<div class="item">
				<div class="name"><?php _e( 'Dimensions', 'woocommerce' ) ?>:</div>
				<div class="product_dimensions"><?php echo esc_html( wc_format_dimensions( $product->get_dimensions( false ) ) ); ?></div>
			</div>
		<?php endif; ?>
	<?php endif;?>

	<?php foreach ( $attributes as $attribute ) : ?>
		<div class="item">
			<div class="name"><?php echo wc_attribute_label( $attribute->get_name() ); ?>:</div>
			<div><?php
				$values = array();

				if ( $attribute->is_taxonomy() ) {
					$attribute_taxonomy = $attribute->get_taxonomy_object();
          $attribute_taxonomy->attribute_public = false;
					$attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

					foreach ( $attribute_values as $attribute_value ) {
						$value_name = esc_html( $attribute_value->name );

						if ( $attribute_taxonomy->attribute_public ) {
							$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
						} else {
							$values[] = $value_name;
						}
					}
				} else {
					$values = $attribute->get_options();

					foreach ( $values as &$value ) {
						$value = make_clickable( esc_html( $value ) );
					}
				}

				echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
			?></div>
		</div>
	<?php endforeach; ?>
</div>
