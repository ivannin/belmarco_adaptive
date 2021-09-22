<?php
/**
 * belmarco Theme Customizer.
 *
 * @package belmarco
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function belmarco_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->add_section(
		'section_one', array(
			'title' => 'Настройки сайта',
			'description' => '',
			'priority' => 11,
		)
	);
	$wp_customize->add_setting('logo'); 
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
		'label'    => 'Логотип',
		'section'  => 'section_one',
		'settings' => 'logo',
	)));
	$wp_customize->add_setting('logo_lp'); 
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_lp', array(
		'label'    => 'Логотип для лендинга "кровати-машины"',
		'section'  => 'section_one',
		'settings' => 'logo_lp',
	)));
	$wp_customize->add_setting('phone_tall', 
		array('default' => '')
	);
	
	$wp_customize->add_control('phone_tall', array(
			'label' => 'Телефон для звонков по России',
			'section' => 'section_one',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting('phone_local', 
		array('default' => '')
	);
	$wp_customize->add_control('phone_local', array(
			'label' => 'Телефон для местных звонков',
			'section' => 'section_one',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting('footer_email', 
		array('default' => '')
	);
	$wp_customize->add_control('footer_email', array(
			'label' => 'email в футере',
			'section' => 'section_one',
			'type' => 'text',
		)
	);	
	$wp_customize->add_section(
		'section_two', array(
			'title' => 'Мы в соцсетях',
			'description' => '',
			'priority' => 22,
		)
	);
	$wp_customize->add_setting('vk', 
		array('default' => '')
	);
	$wp_customize->add_control('vk', array(
			'label' => 'ВКонтакте',
			'section' => 'section_two',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting('fb', 
		array('default' => '')
	);
	$wp_customize->add_control('fb', array(
			'label' => 'Facebook',
			'section' => 'section_two',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting('ok', 
		array('default' => '')
	);
	$wp_customize->add_control('ok', array(
			'label' => 'Одноклассники',
			'section' => 'section_two',
			'type' => 'text',
		)
	);
	$wp_customize->add_setting('in', 
		array('default' => '')
	);
	$wp_customize->add_control('in', array(
			'label' => 'Instagram',
			'section' => 'section_two',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting('youtube', 
		array('default' => '')
	);	
	$wp_customize->add_control('youtube', array(
			'label' => 'Youtube',
			'section' => 'section_two',
			'type' => 'text',
		)
	);	
	
}
add_action( 'customize_register', 'belmarco_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function belmarco_customize_preview_js() {
	wp_enqueue_script( 'belmarco_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'belmarco_customize_preview_js' );
