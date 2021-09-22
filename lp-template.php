<?php
/*
 Template Name: Посадочная страница
*/
?>
<?php get_header(); ?>
<div class="infoblock">
    <span></span>
    <div class="close-info">&times;</div>
</div><!--.infoblock-->
<?php if( have_rows('lp_content') ):
  while ( have_rows('lp_content') ) : the_row();?>
    <?php if( get_row_layout() == 'single_video' ):/*Одиночное видео*/?>   
      <div class="block-3">
        <div class="wrap">
          <h2><?php the_sub_field('title_video');?></h2>
            <iframe src="<?php the_sub_field('url_video');?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen width="1000px" height="562px" class="center-block"></iframe>      
        </div>
      </div><!--/.block-3-->
    <?php elseif( get_row_layout() == 'advantages_block' ):/*Преимущества*/?>
      <div class="block-2">
        <div class="wrap">
          <h2><?php the_sub_field('title');?></h2>
          <?php $last = count(get_sub_field('advantages'));
            $count=1;?>
          <?php if( have_rows('advantages') ):?>
          <div class="block2-content">            
            <?php while ( have_rows('advantages') ): the_row();
            $image = get_sub_field('image');?>
            <div class="plus-block">
                  <a href="<?php echo $image['url'];?>" class="image-popup">
                    <img src="<?php echo $image['sizes']['medium'];?>" alt="<?php echo $image['alt'];?>">
                  </a>  
                  <div class="plus-text">
                      <h3><?php the_sub_field('name');?></h3>
                      <p><?php the_sub_field('desc');?></p>
                  </div>
            </div>
            <?php if($count<$last) echo '<hr/>'; ?>
            <?php $count++; endwhile;?>
          </div>
          <?php endif;?>
        </div>
      </div>
    <?php elseif( get_row_layout() == 'image_block' ):/*Изображение*/?>
      <?php $image_single = get_sub_field('image');?>
      <div class="full-image">
        <?php if(get_sub_field('title')):?>
        <h2><?php the_sub_field('title');?></h2>
        <?php endif;?>
        <img src="<?php echo $image_single['url'];?>" alt="<?php echo $image_single['alt'];?>"/>  
      </div>
    <?php elseif( get_row_layout() == 'slider_images_block' ):/*Слайдер изображений*/?>
    <div class="block-slider">
      <div class="wrap">
        <?php if(get_sub_field('title')):?>
        <h2 class="hear-h"><?php the_sub_field('title');?></h2>
        <?php endif;?>
        <?php $images = get_sub_field('sliders');
          if( $images ): ?>
          <div class="slider-image slider">
            <?php foreach( $images as $image ): ?>
            <div class="slide">
              <a href="<?php echo $image['url']; ?>" class="image-popup">
                <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
              </a>
            </div><!--/.slide-->
          <?php endforeach; ?>						
          </div><!--/.slider-->
        <?php endif; ?>
      </div>
    </div>
    <?php elseif( get_row_layout() == 'lid_form_block' ):/*Лид форма*/?>
      <div class="block-4 form-block">
        <div class="wrap">
          <div class="dots"></div>
            <h2><?php the_sub_field('title');?></h2>
            <?php echo do_shortcode('[contact-form-7 id="11608" title="Подписка LP"]'); ?>
          <div class="dots"></div>
        </div>
        <?php if(get_sub_field('btn_text')):?>
        <script type="text/javascript">
          var _form = jQuery('.block-4 form input[type="submit"]').val('<?php the_sub_field('btn_text');?>');          
        </script>
        <?php endif;?>
      </div>
    <?php elseif( get_row_layout() == 'products_block' ):/*Блок товаров*/?>
      <div class="block-5 clearfix">
        <div class="wrap">
          <h2 class="hear-h"><?php the_sub_field('title');?></h2>
          <?php if( have_rows('main_models_carousel') ): ?>
            <?php while( have_rows('main_models_carousel') ): the_row(); ?>
            <div class="type main_models">
              <h3>
                <a href="#popup-type" class="open-popup-type" data-text='<h2><?php the_sub_field('title_2'); ?></h2><?php the_sub_field('text'); ?><div class="price"><span class="sum summa"> </span><span class="rub">руб.</span></div>' data-cost="<?php the_sub_field('price'); ?>">
                  <?php the_sub_field('title_main'); ?>
                </a>
              </h3>
              <?php if(get_sub_field('url_catalog')):?>
              <a href="<?php the_sub_field('url_catalog');?>" class="btn-dotted" target="_blank">Посмотреть в каталоге</a>
              <?php endif;?>
              <div class="price"><span class="sum"><?php the_sub_field('price'); ?></span> <span class="rub">руб.</span></div>
              <?php $images = get_sub_field('gallery');
              if( $images ): ?>
                <div class="slider1 slider">
                  <?php foreach( $images as $image ): ?>
                    <div class="slide">
                      <a href="<?php echo $image['url']; ?>" class="image-popup">
                        <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
                      </a>
                    </div><!--/.slide-->
                  <?php endforeach; ?>						
                </div><!--/.slider-->
              <?php endif; ?>
            </div><!--/.type-->
            <?php endwhile; ?>     
          <?php endif; ?>
        </div><!--/.wrap-->
      </div><!--/.block-5-->
    <?php elseif( get_row_layout() == 'btn_block' ):/*Кнопка*/?>
     <div class="block-6">
          <div class="wrap clearfix">
              <h2><?php the_sub_field('title'); ?></h2>
              <a class="link" href="<?php the_sub_field('url_btn');?>" target="_blank">
                  <button class="bg-padding big-btn"><span><?php the_sub_field('name_btn'); ?></span></button>
              </a>
              <?php /*<div class="dots"></div>*/?>
          </div>
      </div><!--/.block-6-->
    <?php elseif( get_row_layout() == 'dop_options_block' ):/*Дополнительные опции*/?>
      <div class="block-7">
        <div class="wrap clearfix">
          <h2><?php the_sub_field('title'); ?></h2>
          <?php if( have_rows('elements') ): ?>          
          <div class="tabs-block">
            <div class="tabs-list">
              <a href="#popup-type" id="tab-link" style="display:none;" class="open-popup-type"></a>
            <?php while( have_rows('elements') ): the_row(); ?>
            <?php $dop_image = get_sub_field('image');?>
              <?php $url_btn = '';
              if(get_sub_field('url_page')){
                $text_btn = 'Каталог';
                if(get_sub_field('btn_text')){
                  $text_btn = get_sub_field('btn_text');
                }
                $url_btn = '<p class="text-center"><a class="btn-link" href="'.get_sub_field('url_page').'" target="_blank">'.$text_btn.'</a></p>';
              }
              ?>
              <div class="tab"
                  data-text='<h2><?php the_sub_field('name');?></h2><p><?php the_sub_field('desc');?></p><?php echo $url_btn;?>'
                  data-cost="<?php the_sub_field('price');?>" data-image="<?php echo $dop_image['url']?>">
                <div class="image-block"><img src="<?php echo $dop_image['sizes']['thumbnail']?>" alt="" class="img-responsive"></div>
                <h3><?php the_sub_field('name');?></h3>
              </div><!--/.tab-->
              <?php endwhile;?>
              </div>
              <div class="tabs-info clearfix">
                  <div class="image-block">
                      <div class="price"><span class="sum"> </span> <span class="rub"> руб.</span></div>
                      <img src="" alt="">
                  </div>
                  <div class="text-block"></div>
              </div>
          </div>
          <?php endif;?>
        </div>
      </div>
    <?php elseif( get_row_layout() == 'reviews_block' ):/*Отзывы*/?>
      <div class="block-9">
        <div class="wrap">
          <h2><?php the_sub_field('title');?></h2>
          <?php if( have_rows('review') ): ?>
          <div class="slider6 slider">
            <?php while( have_rows('review') ): the_row();?>
            <?php $review = get_sub_field('image');?>
            <div class="slide">
              <div class="image-block">
                <a href="<?php echo $review['url']; ?>" class="image-popup"><img src="<?php echo $review['sizes']['thumbnail']; ?>" alt=""></a>
              </div>
              <div class="text-block">
                <h3><?php the_sub_field('title');?></h3>
                <p class="review"><?php the_sub_field('desc');?></p>
              </div>
              <?php /*<a class="read" href="<?php the_sub_field('url');?>" target="_blank"><span>прочитать отзыв</span></a>*/?>
            </div>
            <?php endwhile;?>
          </div>
          <?php endif;?>
        </div>
      </div><!--/.block-9-->
    <?php elseif( get_row_layout() == 'video_reviews_block' ):/*Видео отзывы*/?>
      <div class="block-10">
        <div class="wrap">
          <h2><?php the_sub_field('title');?></h2>
          <?php if( have_rows('video') ): ?>
          <div class="slider7 slider">
            <?php while( have_rows('video') ): the_row();?>
            <?php $video_review_data = get_preview_and_video_to_url(get_sub_field('url'));?>
            <div class="slide">
              <a href="<?php the_sub_field('url');?>" class="popup-youtube" rel="nofollow">
                <img src="<?php echo $video_review_data['image'];?>" alt=""/>
              </a>
              <?php if(get_sub_field('title_video')):?>
              <p class="title_video">
                <?php the_sub_field('title_video');?>
              </p>
              <?php endif;?>
            </div>
            <?php endwhile;?>
          </div>
          <?php endif;?>
        </div><!--/.wrap-->
      </div><!--/.block-10-->  
    <?php elseif( get_row_layout() == 'widgets_block' ):/*Блок с виджетами*/?>
      <div class="block-10">
        <div class="wrap">
          <div class="vk-block">
            <div class="subscription-text">
              <p><?php the_sub_field('desc');?></p>
              <img src="<?php echo get_template_directory_uri() . '/img-lp/strela.svg'; ?>" alt="">
            </div>
            <div id="vk_groups"> </div>
            <script type="text/javascript">VK.Widgets.Group("vk_groups", {mode: 3, no_cover: 1, width: "300"}, 73325540);</script>
            <?php /*<div class="insta-block">
              <?php the_widget("Wpzoom_Instagram_Widget", 
                array("title" => "Instagram", 
                      "image-limit" => 7,
                      "images-per-row" => 7,
                      "image-width" => 40,
                      "image-spacing" => 10,
                      "button_text" => "Подписаться"
                     )
               );?>
              </div>*/?>
          </div>
        </div>
      </div>
    <?php elseif( get_row_layout() == 'products_plus_block' ):/*Блок с товарами +*/?>
      <div class="block-11">
        <div class="wrap">
          <?php if(get_sub_field('title')):?>
          <h2 class="hear-h"><?php the_sub_field('title');?></h2>
          <?php endif;?>
          <?php if( have_rows('products_plus') ): ?>
            <div class="slider-image slider">
              <?php while( have_rows('products_plus') ): the_row(); ?>
              <?php $img_pp = get_sub_field('img');?>
              <div class="slide text-center">
                <p class="title"><?php the_sub_field('name');?></p>
                <a href="<?php echo $img_pp['url']; ?>" class="image-popup">
                  <img src="<?php echo $img_pp['sizes']['large']; ?>" alt="<?php echo $img_pp['alt']; ?>">
                </a>
                <a class="btn-link" href="<?php the_sub_field('url');?>">Перейти</a>
              </div><!--/.slide-->
            <?php endwhile; ?>						
            </div><!--/.slider-->
          <?php endif; ?>
        </div>
      </div>
    <?php endif;?>
<?php endwhile; 
  endif;?>
    <?php /*<div class="block-11">
		<div class="wrap">
			<div class="dots"></div>
			<h2>Наши сертификаты и награды</h2>
				<div class="sert-block">
					<a href="<?php echo get_template_directory_uri() . '/sert/iso-min.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/img-1-min.png'; ?>" alt=""></a>
					<a href="<?php echo get_template_directory_uri() . '/sert/eco-min.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/img-2-min.png'; ?>" alt=""></a>
					<a href="<?php echo get_template_directory_uri() . '/sert/EAC-min.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/img-3-min.png'; ?>" alt=""></a>
					<a href="<?php echo get_template_directory_uri() . '/sert/gost-min.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/img-4-min.png'; ?>" alt=""></a>
					<a href="<?php echo get_template_directory_uri() . '/sert/Brend_goda-min.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/img-5-min.png'; ?>" alt=""></a>
				</div>
				<div class="dots"></div>
		</div><!--/.wrap-->	
        
		
    </div><!--/.block-11-->

    <div class="block-12 form-block">
        <div class="wrap">
            <div class="dots"></div>
			<?php echo do_shortcode('[contact-form-7 id="3274" title="Остались вопросы?" html_id="questions_remained"]');?>
            <div class="dots"></div>
        </div>
    </div>*/?>

    
    <div id="popup-type" class="popup mfp-hide">
        <div class="text-block"></div>        
        <!--<div class="price"><span class="sum summa"></span> <span class="rub">руб.</span></div>-->
    </div>
    <a href="#popup-thks" class="open-popup-type" id="thks" style="display:none;"></a>
    <div id="popup-thks" class="popup mfp-hide">
        <p>Спасибо за заявку! Мы свяжемся с Вами.</p>
    </div>

    <div id="call" class="popup mfp-hide">
        <a href="https://belmarco.ru/product-category/car-beds/" target="_blank">
            <button type="submit" name="submit" class="bg-padding2 big-btn2">
                <span>В каталог</span>
            </button>
        </a>
		<?php echo do_shortcode('[contact-form-7 id="3245" title="Заказать звонок" html_id="callme"]'); ?>
    </div>
<?php
get_footer();
