<?php
/**
 * Template part for displaying Single New.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package belmarco
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		$post_thumb=get_the_post_thumbnail(get_the_ID(),'full');
		if ($post_thumb){ ?>
		<div class="entry-image">
		<?php echo $post_thumb; ?>
		</div>
		<?php } ?>
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}?>
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php belmarco_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'belmarco' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php belmarco_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->