<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package belmarco
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<link rel="shortcut icon" href="<?php echo get_site_icon_url(); ?>" type="image/png">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
<meta name="google-site-verification" content="As0DBLr0ghaN-DLY0ZDE8TqoYinhDBsK1i2zgGHjXjg" />
<meta name="p:domain_verify" content="f35e365e8658bf6e196ef6b4c01ff0e4"/>
<meta name="yandex-verification" content="61f9f74b291a990a" />
</head>
<body <?php body_class(); ?>><?php
/**
 * Подключение кода Google Tag Manager через плагин
 * Google Tag Manager for WordPress options
 * Пожалуйста, не удаляйте этот код!
 */
if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); }
?>

<div id="page" class="site">
  <header class="header">
    <div class="header__container container">
      <button type="button" id="btn_mob_menu" class="navbar-toggle hamb">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="title-menu_button">Меню</span>
      </button>
      <div class="header__item">
        <?php if ( function_exists('custom_logo_block')) { custom_logo_block(); }?>
      </div>
      <div class="header__item tel">
        <a href="tel:<?php echo phone_clean(get_theme_mod('phone_tall',''));?>" class="header__phone"><?php echo get_theme_mod('phone_tall',''); ?></a>
      </div>
      <div class="header__item">
        <a id="callback_form_a" href="#contact_form_callback" class="fancybox-inline">Перезвоните мне</a>
        <div style="display:none" class="fancybox-hidden">
          <div id="contact_form_callback" class="content-modal">
            <?php echo do_shortcode('[contact-form-7 id="2712" title="Перезвоните мне" html_id="callback"]'); ?>
          </div>
        </div>
      </div>
      <a id="callback_form_a" href="#contact_form_callback" class="fancybox-inline callback_phone"></a>
      <a href="tel:88005007982" class="phone_mob"></a>
      <div class="minicart__mob cart-show yith-wacp_trigger">
        <div id="mini_cart_mob" class="cart__count"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
      </div>
    </div>
  </header>
  <nav id="mob_menu" class="menu-mob mob_menu menutabs">
    <div class="header_mob_menu">
      <div class="add-info">
        <div class="mob-block">
          <div class="tabs">
            <div class="item_tab menutab_catalog" id="menutab-title-catalog" role="tab" aria-controls="menutab-catalog">
              <a href="#menutab-catalog">Каталог</a>
            </div>
            <div class="item_tab menutab_info" id="menutab-title-info" role="tab" aria-controls="menutab-info">
              <a href="#menutab-info">Информация</a>
            </div>
          </div>
        </div>
        <div class="close"></div>
      </div>
    </div>
    <div class="menutab-content" id="menutab-catalog" role="tabpanel" aria-labelledby="menutab-title-catalog">
      <?php wp_nav_menu(array(
       'theme_location' => 'mob_primary',
       'menu_id' => 'mob-menu',
       'menu_class' => 'menu',
       'container' => '',
      ));?>
    </div>
    <div class="menutab-content" id="menutab-info" role="tabpanel" aria-labelledby="menutab-title-info">
      <?php wp_nav_menu(array(
       'theme_location' => 'bottom_mob_menu',
       'menu_id' => 'bottom_mobmenu',
       'menu_class' => 'menu',
       'container' => '',
      ));?>
    </div>
  </nav>
  <nav class="top-menu container">
    <?php wp_nav_menu(array(
      'theme_location' => 'primary',
      'menu_id' => 'primary-menu',
      'menu_class' => 'menu__list',
      'container' => ''
    ));?>
    <div class="minicart cart-show yith-wacp_trigger">
      <div id="mini_cart">
        <div class="cart__quantity"><?php echo WC()->cart->get_cart_contents_count(); ?> ед.</div>
        <div class="cart__amount"><?php echo WC()->cart->get_cart_total(); ?></div>
      </div>
    </div>
  </nav>
  <div class="container">
    <?php if(!is_product()):?>
    <div class="frisbuy-stories-widget"></div>
    <?php endif;?>
    <?php if ( function_exists('custom_top_banner_block')) { custom_top_banner_block(); }?>
    <?php if ( function_exists('yoast_breadcrumb') && !is_front_page()){ yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
    <?php if ( function_exists('yoast_breadcrumb_mobile') && !is_front_page()){ yoast_breadcrumb_mobile('<div id="breadcrumbs-mob" class="mobile_view">','</div>'); } ?>
    <?php $productws = array();?>
    <?php if(is_tax( 'product_cat' )){
      $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
      $args = array('posts_per_page' => -1, 'product_cat' => $term->name, 'post_type' => 'product');
      $loop = new WP_Query( $args );
      while ( $loop ->have_posts() ) : $loop ->the_post();
        $do_not_duplicate = $post->ID;
        $productws[] = $do_not_duplicate;
      endwhile;
      wp_reset_query();
      session_start();
      $_SESSION['productws'] = $productws;
      $_SESSION['term_cat'] = $term;
    }?>
    <div id="content" class="site-content clearfix">
