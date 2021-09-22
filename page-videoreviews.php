<?php
/**
 * Template Name: Видеоотзывы
 */
get_header(); ?>
<?php
  $meta_args = array(
    'meta_key' => '',
    'meta_value' => ''
  );
  if(isset($_GET['tags'])){
    $meta_args['meta_key'] = 'tag';
    $meta_args['meta_value'] = $_GET['tags'];
  }
  $args = array(
    'post_type'   => 'videoreviews',
    'posts_per_page' => '-1',
    'post_status' => 'publish',
  );
  $args['meta_query'] = $meta_args['meta_key'];
  $args['meta_value'] = $meta_args['meta_value'];
  $videos = new WP_Query($args);
  $count = $videos->post_count;
  $posts_per_page = 10;
  $max_pages=ceil($count/$posts_per_page);
  $arr_tags = array();
  $args['meta_query'] = '';
  $args['meta_value'] = '';
  $temp_videos = new WP_Query($args);
  if($temp_videos->have_posts()){
    while($temp_videos->have_posts()){
      $temp_videos->the_post();
      $tag = get_field('tag');
      if($tag && !in_array($tag, $arr_tags)){
        $arr_tags[] = $tag;
      }    
    } 
  }
  $args['meta_query'] = $meta_args['meta_key'];
  $args['meta_value'] = $meta_args['meta_value'];
  $args['posts_per_page'] = $posts_per_page;
  $video_posts = new WP_Query($args);
?>	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      <?php while(have_posts()):the_post();?>
        <header class="entry-header">
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
        <?php show_tags_page_select($arr_tags);?>
        <?php if(get_the_content()):?>
        <div class="entry-content">
          <?php the_content();?>
        </div>
        <?php endif;?>
        <?php if($video_posts->have_posts()):?>
        <div class="video-reviews">
          <div class="row">         
          <?php while($video_posts->have_posts()): $video_posts->the_post();?>
            <div class="col-md-6 col-xs-12 mb-20">
              <div class="item-video">
                <div class="youtube" id="video-review_<?php the_ID();?>" data-id="<?php the_field('url_video');?>" style="width: 100%;height: 100%;"><div class="play"></div></div>
              </div>
            </div>
          <?php endwhile;?>
          </div>
        </div>
        <?php if ($max_pages>1) { ?>
			    <div id="videoreviews_loadmore" class="clearfix">Показать еще видеоотзывы</div>
			  <?php } ?>
        <script>
          jQuery(function() {
            jQuery(".youtube").each(function() {
                var _this = jQuery(this);
                _this.css('background-image', 'url(http://i.ytimg.com/vi/' + _this.attr('data-id') + '/hqdefault.jpg)');
             });
             jQuery(document).on('click', '.item-video .play', function() {
                var _this = jQuery(this).parent();
                var iframe_url = "https://www.youtube.com/embed/" + _this.attr('data-id') + "?autoplay=1&autohide=1&rel=0";
               var iframe = '<iframe src="'+iframe_url+'" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>';
               jQuery('.item-video #'+_this.attr('id')).html(iframe);
             });
          });
        </script>
        <?php endif;?>
      <?php endwhile;?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<script>
	  var ajaxurl = '<?php echo site_url(); ?>/wp-admin/admin-ajax.php';
    var current_page = 1;
    var max_pages = '<?php echo $max_pages; ?>';
    var posts_per_page = <?php echo $posts_per_page; ?>;
    var meta_key = '<?php echo $meta_args['meta_key']; ?>';
    var meta_value = '<?php echo $meta_args['meta_value']; ?>';
  </script>	
<?php
get_footer();
