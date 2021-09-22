<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $product;
//the_title( '<h1 class="product_title entry-title">', '</h1>' );
$sku = '';
if($product->sku){
  $sku = ' <span class="sku">('.$product->sku.')</span>';
}
?>
<h1 class="product_title entry-title"><?php the_title();?><?php echo $sku;?></h1>
<?php if(get_field('text_single_product','options')){
	echo '<div class="info_product">'.get_field('text_single_product','options').'</div>';
}?>