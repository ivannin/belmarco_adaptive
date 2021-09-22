<?php
/**
 * Template Name: Доставка и оплата (таблица)
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      <?php while(have_posts()):the_post();?>
        <header class="entry-header">
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
        <div class="entry-content">
          <?php the_content();?>
        </div>
        <?php if(have_rows('payment')):?>
        <div class="payment">
          <div class="table row">
            <?php while(have_rows('payment')):the_row();?>
            <?php 
              $before = '';
              $btn = ''; 
              $after = '';
              if(get_sub_field('desc')){
                $before = '<a href="#payment-'.get_row_index().'" class="fancybox-inline">';
                $after = '</a>';
                $btn_name = (get_sub_field('text_btn')) ? get_sub_field('text_btn') : 'подробнее';
                $btn = ' (<a class="link fancybox-inline" href="#payment-'.get_row_index().'">'.$btn_name.'</a>)';
              }
            ?>
            <div class="col-md-6 col-xs-12 mb-20">
              <div class="elem">             
                <div class="row content">             
                  <div class="img col-xs-3">
                    <?php 
                      $img = get_sub_field('img');
                    ?>
                    <?php echo $before;?><img src="<?php echo $img['sizes']['thumbnail'];?>" alt="<?php the_sub_field('name'); ?>"/><?php echo $after;?>
                  </div>
                  <div class="name col-xs-9">
                    <p><?php the_sub_field('name'); ?><?php echo $btn;?></p>
                  </div>
                </div>
              </div>
              <?php if(get_sub_field('desc')):?>
              <div class="hidden">
                <div class="modal_content" id="payment-<?php echo get_row_index();?>">
                  <?php the_sub_field('desc');?>
                </div>                
              </div>
              <?php endif;?>
            </div>
            <?php endwhile;?>
          </div>          
        </div>
				<?php endif;?>
        <?php if(get_field('desc_shipping_before')):?>
        <div class="entry-content">
          <?php the_field('desc_shipping_before');?>  
        </div>
        <?php endif;?>
        <?php if(have_rows('shipping')):?>
        <div class="shipping">
          <div class="table row">
          <?php while(have_rows('shipping')):the_row();?>
            <?php 
              $before = '';
              $btn = ''; 
              $after = '';
              if(get_sub_field('desc')){
                $before = '<a href="#shipping-'.get_row_index().'" class="fancybox-inline">';
                $after = '</a>';
                $btn_name = (get_sub_field('text_btn')) ? get_sub_field('text_btn') : 'подробнее';
                $btn = ' (<a class="link fancybox-inline" href="#shipping-'.get_row_index().'">'.$btn_name.'</a>)';
              }
            ?>
            <div class="col-md-6 col-xs-12 mb-20">
              <div class="elem">
                <div class="row content">             
                  <div class="img col-xs-3">
                    <?php 
                      $img = get_sub_field('img');
                    ?>
                    <?php echo $before;?><img src="<?php echo $img['sizes']['thumbnail'];?>" alt="<?php the_sub_field('name'); ?>"/><?php echo $after;?>
                  </div>
                  <div class="name col-xs-9">
                    <p><?php the_sub_field('name'); ?><?php echo $btn;?></p>
                  </div>
                </div>
              </div>
              <?php if(get_sub_field('desc')):?>
              <div class="hidden">
                <div class="modal_content" id="shipping-<?php echo get_row_index();?>">
                  <?php the_sub_field('desc');?>
                </div>                
              </div>
              <?php endif;?>
            </div>
            <?php endwhile;?>
          </div>
        </div>
        <?php endif;?>
			
      <?php endwhile;?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
