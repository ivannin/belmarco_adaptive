<?php
/*
Template Name: Оформление заказа
*/
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
          <div class="row row-flex">
            <div class="col-xs-12 col-sm-8">
              <?php the_content(); ?>
            </div>
            <div class="col-sm-4 hidden-xs">
              <?php promo_generate_my_order_block();?>
            </div>
          </div>          
        </div><!-- .entry-content -->
      </article><!-- #post-## -->

			<?php endwhile; ?>
      </main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();