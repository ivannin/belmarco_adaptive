<?php
/**
 * belmarco functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package belmarco
 */

if ( ! function_exists( 'belmarco_setup' ) ) :
  function belmarco_setup() {
    load_theme_textdomain( 'belmarco', get_template_directory() . '/languages' );
    load_plugin_textdomain( 'comment-attachment', false, '/belmarco-localization' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
      'primary' => esc_html__( 'Primary', 'belmarco' ),
      'mob_primary' => esc_html__( 'Mobile Primary', 'belmarco' ),
      'bottom_mob_menu' => esc_html__( 'Bottom Mobile Menu', 'belmarco' ),
    ) );
    add_theme_support( 'html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ) );
    add_theme_support( 'custom-background', apply_filters( 'belmarco_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
    ) ) );
  }
endif;
add_action( 'after_setup_theme', 'belmarco_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function belmarco_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Shop-Sidebar', 'belmarco' ),
		'id'            => 'woo_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'belmarco' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="h2 widget-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'belmarco' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'belmarco' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-Column-1', 'belmarco' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'belmarco' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="h4">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-Column-2', 'belmarco' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'belmarco' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="h4">',
		'after_title'   => '</div>',
	) );
		register_sidebar( array(
		'name'          => esc_html__( 'Footer-Column-3', 'belmarco' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'belmarco' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="h4">',
		'after_title'   => '</div>',
	) );	
}
add_action( 'widgets_init', 'belmarco_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function belmarco_scripts() {
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');	
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), null, true );

	wp_enqueue_style( 'belmarco-style', get_stylesheet_uri() );
	wp_enqueue_style( 'custom-style', get_template_directory_uri().'/css/custom.css' );
  wp_enqueue_style( 'custom-media-style', get_template_directory_uri().'/css/custom.media.css' );
	wp_enqueue_style( 'woo-belmarco-style', get_template_directory_uri().'/css/woocommerce.css' );
  //wp_enqueue_style( 'style-new-style', get_template_directory_uri().'/css/style.css' );
	//wp_enqueue_script( 'belmarco-navigation', get_template_directory_uri() . '/js/navigation.js', array(), null, true );

	wp_enqueue_script( 'belmarco-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), null, true );	
	wp_enqueue_script( 'ie-emulation-modes-warning', get_template_directory_uri() . '/js/ie-emulation-modes-warning.js', array(), null, false );	
	wp_enqueue_script( 'ie10-viewport-bug-workaround', get_template_directory_uri() . '/js/ie10-viewport-bug-workaround.js', array(), null, true );
	wp_enqueue_script('vk-openapi', 'https://vk.com/js/api/openapi.js?146', array(), false, false );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel/assets/owl.carousel.min.css');
	wp_enqueue_style( 'owl-default', get_template_directory_uri() . '/js/owl.carousel/assets/owl.theme.default.min.css');
	
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel/owl.carousel.min.js', array('jquery'), null, false );
	wp_enqueue_style( 'belmarco-carousel', get_template_directory_uri() . '/css/belmarco.carousel.css');	
	wp_localize_script( 'belmarco', 'MyAjax', array( 'my_ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script('maskedinput', get_template_directory_uri() . '/js/jquery.maskedinput.min.js', array('jquery'), false, false );
	//wp_enqueue_script('maskedinput', get_template_directory_uri() . '/js/jquery.mask.min.js', array('jquery'), false, false );
	//wp_enqueue_script( 'lazyload-scripts', get_template_directory_uri() . '/js/lazyload.min.js', array('jquery'), null, true );
  wp_enqueue_script( 'belmarco', get_template_directory_uri() . '/js/belmarco.js', array('jquery','owl-carousel'), null, false);
  
  if (is_page('reviews')){
		wp_enqueue_script( 'contact-form-discount', get_template_directory_uri() . '/js/contact-form-discount.js', array('jquery','jquery-fancybox','jquery-easing'), null, true);
	}
	wp_enqueue_script( 'regiontitle', get_template_directory_uri() . '/js/regiontitle.js', array('jquery'), null, true);
	wp_enqueue_script( 'geolocation', get_template_directory_uri() . '/js/geolocation.js', array('jquery'), null, true);
	wp_enqueue_script( 'zoom-image', get_template_directory_uri() . '/js/zoomsl-3.0.min.js', array('jquery'), null, true);
	//LP
	if (is_page('lp-krovatimashinki')){
		wp_enqueue_script( 'magnific-popup-js', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', array('jquery'), null, false );
		wp_enqueue_script( 'slick-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js', array('jquery'), null, false );
		//wp_enqueue_script( 'jquery.form', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.0/jquery.form.min.js', array('jquery'), null, false );
		//wp_enqueue_script( 'vk-api', 'https://vk.com/js/api/openapi.js?142' );
		wp_enqueue_script( 'lp-scripts', get_template_directory_uri() . '/js/lp-scripts.js', array('jquery'), null, false );
		wp_enqueue_style( 'slick-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.css');
		wp_enqueue_style( 'magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css');
		wp_enqueue_style( 'belmarco-lp', get_template_directory_uri() . '/css/lp.css');		
	}
	if (is_page('lp-stul')){
		wp_enqueue_style( 'belmarco-lp', get_template_directory_uri() . '/css/lp-stul.css');
		wp_enqueue_style( 'slick-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.css');
		wp_enqueue_style( 'magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css');

		wp_enqueue_script( 'magnific-popup-js', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', array('jquery'), null, false );
		wp_enqueue_script( 'slick-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js', array('jquery'), null, false );
		wp_enqueue_script( 'lp-scripts', get_template_directory_uri() . '/js/lp-stul-scripts.js', array('jquery'), null, false );
	}
	if (is_page_template('lp-template.php')){
		wp_enqueue_script( 'magnific-popup-js', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', array('jquery'), null, false );
		wp_enqueue_script( 'slick-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js', array('jquery'), null, false );
		wp_enqueue_style( 'slick-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.css');
		wp_enqueue_style( 'magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css');
		wp_enqueue_script( 'lp-scripts', get_template_directory_uri() . '/js/lp-template.js', array('jquery'), null, false );		
		wp_enqueue_style( 'belmarco-lp', get_template_directory_uri() . '/css/lp-template.css');		
	}
  if(is_product()){
    wp_enqueue_script( 'product-scripts', get_template_directory_uri() . '/js/product.js', array('jquery'), null, true );		
  }
  /*if(is_checkout()){
    wp_enqueue_script( 'checkout-scripts', get_template_directory_uri() . '/js/checkout.js', array('jquery'), null, true );		
  }*/
}
add_action( 'wp_enqueue_scripts', 'belmarco_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';
require get_template_directory(). '/inc/belmarco_functions.php';
require get_template_directory(). '/inc/woocommerce_functions.php';
//require get_template_directory(). '/inc/criteo_onetag.php';
add_theme_support( 'woocommerce' );

/*Вывод отзыва (комментария)*/
function belmarco_testimonial($comment, $args, $depth){
   $GLOBALS['comment'] = $comment; ?>
   <div <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>">
	<?php if ($comment->comment_approved == '0') : ?>
		<em>Ваш комментарий ожидает проверки.</em>
		<br />
	<?php endif; ?>

	<div class="comment-meta commentmetadata">
		<?php echo get_avatar( $comment->comment_ID, 33 ); ?>
		<p class="comment-author-name <?php echo $comment->user_id;?>"><?php echo get_comment_author($comment->comment_ID); ?></p>
		<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( '%1$s в %2$s', get_comment_date(),  get_comment_time()) ?></a>
		<?php edit_comment_link('(Редактировать)', '  ', '') ?>
	</div>

	<?php comment_text(); ?>

	<div class="reply">
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
	</div>
	</div>
<?php }
add_filter('widget_tag_cloud_args','set_tag_cloud_args');
function set_tag_cloud_args( $args ) {
	$args['number'] = 4;
	$args['largest'] = 16;
	$args['smallest'] = 11;
	$args['unit'] = 'px';
	return $args;
}


/**
 * код отслеживания заказа и передачи транзации в Google Analytics
 */
//include( get_stylesheet_directory() . '/woocommerce/ga-track-trans.php' );


function wdm_get_tags($products_array){
    $temp = array();
    foreach($products_array as $single_product)
    {
				if(get_the_term_list($single_product, 'product_tag', '', ',' ) !=""){
					if(!(in_array(get_the_term_list($single_product, 'product_tag', '', ',' ), $temp))){
						echo get_the_term_list($single_product, 'product_tag', '', ',' );
						echo ' ';
						$temp[] = get_the_term_list($single_product, 'product_tag', '', ',' );
					}				
				}      
    }

}

function woocommerce_subcategory_list($category) {
	/*if(get_ancestors( $category->term_id, 'product_cat' ) != Array()){*/
    $product_categories = get_categories( apply_filters( 'woocommerce_product_subcategories_args', array(
        'child_of'       => $category->term_id ,
        'menu_order'   => 'ASC',
        'hide_empty'   => 0,
        'hierarchical' => 1,
        'taxonomy'     => 'product_cat',
        'pad_counts'   => 1
    ) ) );

    if(count($product_categories)){
      echo '<div class="tags">';
    }
    foreach($product_categories as $product) {
				$link_cat = get_category_link($product->cat_ID);
        //echo "<a>$product->cat_ID</p>";
			echo "<a href='$link_cat'>$product->name</a>";
    }
    if(count($product_categories)){
      echo '</div>';
    }
	/*}*/
}

add_filter('gettext', 'translate_text');
add_filter('ngettext', 'translate_text');
function translate_text($translated) {
    $translated = str_ireplace('I&rsquo;ve read and accept the', 'Согласен на обработку моих', $translated);
    $translated = str_ireplace('<a href="%s" target="_blank" class="woocommerce-terms-and-conditions-link">terms &amp; conditions</a>', '<a href="%s" target="_blank">персональных данных</a>', $translated);
    return $translated;
}
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Настройки темы',
		'menu_title'	=> 'Настройки темы',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));	
}