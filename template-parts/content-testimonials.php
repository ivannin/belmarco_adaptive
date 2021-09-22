<?php
/**
 * Template part for displaying testimonials.
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
<?php 
$args = array(
'post_id'=>get_the_id(),
'number'=>'',
'status'=>'approve',
);
$comments_query = new WP_Comment_Query; 
$comments = $comments_query->query( $args);
$comments_per_page=27;
//$max_pages=get_comment_pages_count($comments, $comments_per_page);
$max_pages=ceil(count($comments)/$comments_per_page);

$args = array(
'post_id'=>get_the_ID(),
'number'=>$comments_per_page,
'status'=>'approve',
);
$comments = get_comments( $args );

?>	
		<div class="wrap_content">
    	<div class="rev_list row">
			<?php foreach( $comments as $comment ):?>
				<div class="rev_item col-md-4 col-sm-6 col-xs-12">
					<div class="thumbnail">
						<div class="clearfix">
							<div class="img-responsive pull-left">
							<?php 
							$attachmentId = get_comment_meta($comment->comment_ID, 'attachmentId', TRUE);
							if(is_numeric($attachmentId) && !empty($attachmentId)){
								echo wp_get_attachment_image($attachmentId,'thumbnail');
							}else {
								echo wp_get_attachment_image(9884,'thumbnail');/*Картинка-заглушка*/
							} 
							?>
							</div>
							<div class="rev_txt">
								<p><?php $args = array( 
									'maxchar' => 100, 
									'text' => $comment->comment_content,
									'save_format' => false,
									'more_text' => '...',
									'echo' => false, 
								);
								echo text_excerpt( $args);?></p>
							</div>
						</div>
						<div class="rev_meta clear">
							<div class="row">
							<?php $author_url = $comment->comment_author_url; ?>
								<div class="col-xs-12">
									<b><?php echo $comment->comment_author; ?></b>
									<a href="<?php echo $author_url; ?>" class="vk" title="Мы в Вконтакте" target="_blank"></a>
								</div>
								<div class="col-xs-12 text-right">
									<a href="<?php echo '#comment-'.$comment->comment_ID;//echo $author_url ? $author_url:get_comment_link($comment); ?>" class="more fancybox-inline" <?php echo $author_url?'target="_blank"':''; ?>>Подробнее</a>
								</div>
							</div><!--/.row-->
						</div><!--/.rev_meta-->
					</div><!--/.thumbnails-->
					<div class="fancybox-hidden">
						<div id="<?php echo 'comment-'.$comment->comment_ID;?>" class="modal-comment">
							<div class="full-comment"><?php echo $comment->comment_content;?></div>
						</div>
					</div>
				</div>
			<?php endforeach;?>
			<?php
			//if (  get_comment_pages_count($comments, $comments_per_page) > 1 ) : ?>
				<script>
					var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
					<?php //echo (get_query_var('cpage')) ? get_query_var('cpage') : 1; ?>
					var current_page = 1;
					var max_pages = '<?php echo $max_pages; ?>';
					var comments_per_page=<?php echo $comments_per_page; ?>;
					var post_id='<?php echo the_ID(); ?>';
				</script>
			<?php //endif; ?>			
			</div><!--/.rev_list row-->
		</div>
			<?php if ($max_pages>1) { ?>
			<div id="comments_loadmore" class="clearfix">Показать еще отзывы</div>
			<?php } ?>
			<div class="with_btn">  
	        	<div class="btn-reply_wrap text-center">
					<a href="#contact_form_pop_2" class="fancybox-inline">Оставить отзыв</a>
        			<div style="display:none" class="fancybox-hidden">
						<div id="contact_form_pop_2">                
							<div id="dialog-review" class="review ui-dialog-content ui-widget-content" style="width: auto; min-height: 90px; max-height: none; height: auto;">
							<?php comment_form(); ?>
							</div>
						</div>
					</div>
	        	</div>
            </div>
	</div><!--/.entry-content-->
</article><!--/#post-##-->
<?php /*<a id="discount_form_a" href="#contact_form_discount" class="fancybox-inline"></a>
<div style="display:none" class="fancybox-hidden">
	<div id="contact_form_discount">
<?php echo do_shortcode('[contact-form-7 id="1040" title="Скидка"]'); ?>
	</div>*/?>
</div>
