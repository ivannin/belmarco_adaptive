<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package belmarco
 */

get_header(); ?>
		<?php if(!get_field('main_slider_off')){
      putRevSlider('main_slider');
    }?>
    <?php if( have_rows('main_product_categories') ):?>
      <div class="main_block sub_menu">
        <div class="main_title">
          <div class="row">
             <div class="col-md-4 hidden-xs hidden-sm"><p class="line"></p></div>
             <div class="col-md-4 title">Популярные категории</div>
             <div class="col-md-4 hidden-xs hidden-sm"><p class="line"></p></div>
          </div>
        </div>
        <div class="row">
          <?php while(have_rows('main_product_categories')):the_row();
          $term = get_sub_field('product_cat');
          $link_term = get_category_link($term->term_id);
          $category_thumbnail = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
          ?>
          <div class="col-sm-3 col-xs-6">
            <a class="item_cat lazyload" href="<?php echo $link_term;?>">
              <?php echo wp_get_attachment_image($category_thumbnail, 'medium'); ?>
              <p class="content_name">
                <span class="name"><?php echo $term->name;?></span>
              </p>
            </a>
          </div>
          <?php endwhile;?>
        </div>
  		</div><!--/.sub_menu-->
    <?php endif;?>
    <?php $main_action_products = get_field('main_action_products');
    if($main_action_products): ?>
    <div id="main_action_products" class="main_block woocommerce">
      <div class="main_title">
        <div class="row">
           <div class="col-md-4"><p class="line"></p></div>
           <div class="col-md-4 title">Новинки</div>
           <div class="col-md-4 hidden-xs hidden-sm"><p class="line"></p></div>
        </div>
      </div>
      <ul class="products owl-carousel">
        <?php foreach($main_action_products as $post):
          setup_postdata($post);
          //get_template_part( 'template-parts/products', 'on-main' );
          wc_get_template_part( 'content', 'product' );
          wp_reset_postdata();
        endforeach;?>
      </ul>
    </div>
    <?php endif;?>
    <?php $main_hit_products = get_field('main_hit_products');
    if($main_hit_products):?>
    <div id="main_hit_products" class="main_block woocommerce">
      <div class="main_title">
        <div class="row">
           <div class="col-md-4"><p class="line"></p></div>
           <div class="col-md-4 title">Хиты продаж</div>
           <div class="col-md-4 hidden-xs hidden-sm"><p class="line"></p></div>
        </div>
      </div>
      <ul class="products owl-carousel">
        <?php foreach($main_hit_products as $post):
          setup_postdata($post);
          //get_template_part( 'template-parts/products', 'on-main' );
          wc_get_template_part( 'content', 'product' );
          wp_reset_postdata();
        endforeach;?>
      </ul>
    </div>
    <?php endif;?>
		<?php get_template_part( 'template-parts/content', 'advantages_new' ); ?>
    <?php if(have_rows('main_reviews')):?>
    <div id="main_reviews" class="main_block">
      <div class="main_title">
        <div class="row">
           <div class="col-md-4"><p class="line"></p></div>
           <div class="col-md-4 title">Отзывы родителей</div>
           <div class="col-md-4 hidden-xs hidden-sm"><p class="line"></p></div>
        </div>
      </div>
      <div class="owl-carousel">
        <?php while ( have_rows('main_reviews') ) : the_row();?>
          <div class="item_review">
            <a href="#review_<?php echo get_row_index(); ?>" class="fancybox-inline">
              <?php $img_review = get_sub_field('img');
              if($img_review):
                $attachment_id = $img_review['id'];
                $url = $img_review['sizes']['woocommerce_thumbnail'];
                $srcset = wp_get_attachment_image_srcset( $attachment_id, 'woocommerce_thumbnail' );
                $sizes = wp_get_attachment_image_sizes( $attachment_id, 'woocommerce_thumbnail' );
              ?>
                <img class="review_photo" src="<?php echo $url;?>" srcset="<?php echo $srcset;?>" sizes="<?php echo $sizes;?>" alt="review_photo" />
              <?php else:?>
                <img class="review_photo" src="<?php the_sub_field('url_img');?>" alt="review_photo" rel="noindex nofollow"/>
              <?php endif;?>
            </a>
            <div class="hidden">
              <div id="review_<?php echo get_row_index(); ?>" class="content_review">
                <div class="text_review">
                  <?php the_sub_field('desc');?>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile;?>
      </div>
      <div class="button_all">
        <a class="button" href="/reviews/">Все отзывы</a>
      </div>
    </div>
    <?php endif;?>
    <?php if(have_rows('main_video_reviews')):?>
    <div id="main_video_reviews" class="main_block">
      <div class="main_title">
        <div class="row">
           <div class="col-md-4"><p class="line"></p></div>
           <div class="col-md-4 title">Видео-отзывы родителей</div>
           <div class="col-md-4 hidden-xs hidden-sm"><p class="line"></p></div>
        </div>
      </div>
      <div class="owl-carousel">
        <?php while ( have_rows('main_video_reviews') ) : the_row();?>
          <?php $srcset = ''; 
            if(get_sub_field('custom_mode')){
              $video_review_data['video'] = get_sub_field('url_video');
              $video_review_data['image'] = get_sub_field('url_preview');              
            }else{
              $video_review_data = get_preview_and_video_to_url(get_sub_field('url'));
              if($video_review_data['srcset'] != ''){
                $srcset = 'srcset="'.$video_review_data['srcset'].'" sizes="(max-width: 320px) 100vw, 320px"';
              }              
            }
          ?>
          <div id="video_review_<?php echo get_row_index(); ?>" class="item_review" data-video="<?php echo $video_review_data['video'];?>">
            <div class="play"></div>
            <img class="preview_video" src="<?php echo $video_review_data['image'];?>" <?php echo $srcset;?> alt="video_review"/>
          </div>
        <?php endwhile;?>
      </div>
      <div class="button_all">
        <a class="button" href="/reviews/">Все отзывы</a>
      </div>
    </div>
    <?php endif;?>
    <?php if(have_posts()):
    query_posts('cat=85&posts_per_page=2');?>
    <div id="main_news" class="main_block">
      <div class="main_title">
        <div class="row">
           <div class="col-md-4"><p class="line"></p></div>
           <div class="col-md-4 title">Новости</div>
           <div class="col-md-4 hidden-xs hidden-sm"><p class="line"></p></div>
        </div>
      </div>
      <div class="row">
        <?php while(have_posts()):the_post();?>
          <div class="col-md-6">
            <div class="block_title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></div>
            <div class="news_block">
              <div class="date"><?php echo get_the_date('d/m/y');?></div>
              <a href="<?php the_permalink(); ?>">
              <?php if(has_post_thumbnail()){
                echo get_the_post_thumbnail( get_the_ID(), 'cust_shop_single');
              }else{?>
                <img class="lazyload" data-src="<?php echo get_bloginfo('template_directory');?>/img/not_image.png" alt=""/>
              <?php }?>
              </a>
              <div class="desc"><?php the_excerpt();?></div>
            </div>
          </div>
        <?php endwhile;?>
      </div>
      <div class="button_all">
        <a class="button" href="/news/">Все новости</a>
      </div>
    </div>
    <?php endif;wp_reset_query();?>
<?php
get_footer();
