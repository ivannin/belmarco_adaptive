<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package belmarco
 */

get_header(); ?>
	<div class="row">
		<main id="main" class="site-main col-md-9" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'news' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; ?>
			
		<?php 
		$args=array(
			'post_type'=>'post',
			'posts_per_page'=>3,
			'category_name'=>'news',
		);
		$news=new WP_query( $args );
		if ( $news->have_posts() ) {?>
		<div class="related_news_list">
			<h2>Похожие новости</h2>
			<div class="row">
			<?php while ( $news->have_posts() ) : $news->the_post(); ?>
				<div class="col-sm-4">
					<div class="related_news">
					<?php $post_thumb=get_the_post_thumbnail(get_the_ID(),'medium');?>
					<?php if ($post_thumb){ ?>
						<div class="preview-image">
							<a href="<?php the_permalink(); ?>"><?php echo $post_thumb; ?></a>
						</div>
					<?php } ?>
						<div class="preview-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>
						<div class="preview-date_date">
							<?php echo get_the_date(); ?>
						</div>
					</div>
				</div>
			<?php endwhile; // end of the loop. ?>
			<?php wp_reset_postdata(); ?>	
			</div><!--/.row-->
		</div>	
		<?php }
		?>
			
		<?php endwhile; // End of the loop.
		?>

		</main><!-- #main -->

<?php get_sidebar(); ?>
</div><!--/.row-->
<?php get_footer(); ?>
