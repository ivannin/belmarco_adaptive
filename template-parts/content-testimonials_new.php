<?php
/**
 * Template part for displaying testimonials.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package belmarco
 */

?>
<?php
  //$meta_args = array();
  $meta_args = array(
    'meta_key' => '',
    'meta_value' => ''
  );
  if(isset($_GET['tags'])){
    /*$meta_args = array(
      array(
        'key' => 'tag',
        'value' =>  $_GET['tags'],
        'compare' => '='
      )
    );*/
    $meta_args['meta_key'] = 'tag';
    $meta_args['meta_value'] = $_GET['tags'];
  }
  $args = array(
    'post_id'=>get_the_id(),
    'number'=>'',
    'status'=>'approve',
  );
  //$args['meta_query'] = $meta_args;
  $args['meta_query'] = $meta_args['meta_key'];
  $args['meta_value'] = $meta_args['meta_value'];
  $comments_query = new WP_Comment_Query; 
  $comments = $comments_query->query($args);
  $comments_per_page=27;
  //$max_pages=get_comment_pages_count($comments, $comments_per_page);
  $max_pages=ceil(count($comments)/$comments_per_page);
    
  $arr_tags = array();
  //$args['meta_query'] = array();
  $args['meta_query'] = '';
  $args['meta_value'] = '';
  $temp_comments = get_comments($args);
  foreach($temp_comments as $temp_comment){
    $id = 'comment_'.$temp_comment->comment_ID;
    if(get_field('tag', $id)){
      $tag = get_field('tag', $id);
      if(!in_array($tag, $arr_tags)){
        $arr_tags[] = $tag;
      }
    }
  }
  $args = array(
    'post_id'=>get_the_ID(),
    'number'=>$comments_per_page,
    'status'=>'approve',
  );
  //$args['meta_query'] = $meta_args;
  $args['meta_query'] = $meta_args['meta_key'];
  $args['meta_value'] = $meta_args['meta_value'];
  $comments = get_comments( $args );
?>	
<article id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
  <?php show_tags_page_select($arr_tags);?>
	<div class="entry-content">
		<?php the_content(); ?>    
		<div class="wrap_content">
    	<div class="rev_list row">
			<?php foreach( $comments as $comment ):?>
				<div class="rev_item col-xs-12">
					<div class="thumbnail">
						<div class="clearfix">
							<div class="img-responsive pull-left">
							<?php 
							$attachmentId = get_comment_meta($comment->comment_ID, 'attachmentId', TRUE);
							if(is_numeric($attachmentId) && !empty($attachmentId)){
                $url_img = wp_get_attachment_image_url($attachmentId, 'full');
								echo '<a href="'.$url_img.'" class="fancybox">'.wp_get_attachment_image($attachmentId,'medium').'</a>';
							}else {
								echo wp_get_attachment_image(5948,'thumbnail');/*Картинка-заглушка*/
							} 
							?>
							</div>
							<div class="rev_txt">
								<p><?php echo $comment->comment_content;?></p>
							</div>
						</div>
						<div class="rev_meta clear">
							<div class="row">
							<?php $author_url = $comment->comment_author_url; ?>
								<div class="col-xs-12">
									<b><?php echo $comment->comment_author; ?></b>									
								</div>								
							</div><!--/.row-->
						</div><!--/.rev_meta-->
					</div><!--/.thumbnails-->
        </div>
			<?php endforeach;?>
			<?php
			//if (  get_comment_pages_count($comments, $comments_per_page) > 1 ) : ?>
				<script>
					var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
					<?php //echo (get_query_var('cpage')) ? get_query_var('cpage') : 1; ?>
					var current_page = 1;
					var max_pages = '<?php echo $max_pages; ?>';
					var comments_per_page = <?php echo $comments_per_page; ?>;
					var post_id = '<?php echo the_ID(); ?>';
          var meta_key = '<?php echo $meta_args['meta_key']; ?>';
          var meta_value = '<?php echo $meta_args['meta_value']; ?>';
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
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery('.img-responsive .fancybox').fancybox({});
  });
</script>