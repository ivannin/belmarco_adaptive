<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package belmarco
 */

if ( is_cart() || is_checkout() || is_singular('product')) {
	return;
}
?>
<aside id="secondary" class="widget-area col-md-3" role="complementary">
  <div class="close mobile_view"></div>
	<?php 
	if ( is_woocommerce()&&is_active_sidebar( 'woo_sidebar' )) dynamic_sidebar( 'woo_sidebar' );
	if (is_category('news')||is_singular('post')) dynamic_sidebar( 'sidebar-1' );
	?>
</aside><!-- #secondary -->