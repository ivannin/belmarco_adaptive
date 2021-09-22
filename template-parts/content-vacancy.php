<?php
/**
 * Template part for displaying vacancy.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package belmarco
 */

?>

<article id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();
		?>
	</div><!--/.entry-content-->
</article><!--/#post-##-->
<a id="discount_form_a" href="#contact_form_discount" class="fancybox-inline">Откликнуться</a>
<div style="display:none" class="fancybox-hidden">
	<div id="contact_form_discount">
<?php echo do_shortcode('[contact-form-7 id="2275" title="Менеджер по продажам"]'); ?>
	</div>
</div>
