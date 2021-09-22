<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package belmarco
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
	<?php $post_thumb=get_the_post_thumbnail(get_the_ID(),'large');
	if ($post_thumb){ ?>
		<div class="preview-image">
			<a href="<?php the_permalink();?>"><?php echo $post_thumb; ?></a>
		</div>
	<?php } ?>
	<div class="wrap_descr_news">
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
		</header><!-- .entry-header -->
		<?php if ( 'post' === get_post_type() ) { ?>
		<div class="meta">
			<?php belmarco_posted_on(); ?>
			<?php if ( get_comments_number() ){
				$icon_name=(get_comments_number()>1)? 'fa-comments-o':'fa-comment-o';
				echo '<span class="'.$icon_name.'" aria-hidden="true"></span>';
				printf( // WPCS: XSS OK.
				esc_html( _nx( 'One thought', '%1$s thoughts', get_comments_number(), 'comments title', 'belmarco' ).' '),
				number_format_i18n( get_comments_number() ));
			}?>
		</div>
		<?php } ?>
		<div class="entry-content">
		<?php
			the_excerpt();
		?>
			<a href="<?php the_permalink();?>" class="a_button more">Подробнее</a>
		</div><!-- .entry-content -->
	</div><!--/.wrap_descr_news-->
</article><!-- #post-## -->