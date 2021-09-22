<div class="item_product">
  <a class="img_block" href="<?php the_permalink();?>">
    <?php /*$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); ?>
    <?php <img class="lazyload" data-src="<?php echo $image_url[0]; ?>" />*/?>
    <?php echo get_the_post_thumbnail( $post->ID, 'medium'); ?>
  </a>
  <a class="title_block" href="<?php the_permalink();?>">
    <p class="title_product"><?php the_title();?></p>
    <p class="price">
      <?php $_product = wc_get_product(get_the_ID());
      echo $_product->get_price_html();?>
    </p>
  </a>
</div>
