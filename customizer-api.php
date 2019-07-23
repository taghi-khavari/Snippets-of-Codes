<?php
add_action('customize_register','wt_customize_register');
function wt_customize_register( $wp_customize ) {
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'storefront_footer' );

	
    $wp_customize->add_panel( 
		'wt_settings', 
		array(
			'priority'		=> 9,
			'capability'	=> 'manage_options',
			'title'         => __( 'تنظیمات قالب نورپارس' ),		
			'description'   => '<p>در این بخش می توانید برخی از تنظیمات مربوط به قالب نورپارس را تغییر دهید</p>'
		) 
	);

	$wp_customize->add_section( 
		'wt_home_settings' , 
		array(
			'title' => 'تنظیمات برگه اصلی',	
			'capability' => 'manage_options',
			'priority'   => 100,
			'panel' => 'wt_settings',
		) 
	);
	
	$wp_customize->add_setting( 
		'wt_options[home_image]', 
		array(
			'type' => 'option',
			'capability' => 'manage_options',
			'transport' => 'refresh'
		)
	);


	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'home_image_control', array(
	'label' => __( 'تصویر صفحه اصلی', 'theme_textdomain' ),
	'section' => 'wt_home_settings',
	'settings'	=> 'wt_options[home_image]',
	'mime_type' => 'image',
	) ) );



    $wp_customize->add_setting( 'wt_options[home_logo]', array(
    'type' => 'option',
	'capability' => 'manage_options',
	'section' 	=> 'wt_home_settings',
    'transport' => 'refresh'
    ) );

    
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'home_logo_control', array(
    'label' => __( 'تصویر لوگو صفحه اصلی', 'theme_textdomain' ),
	'section' => 'wt_home_settings',
	'settings'	=> 'wt_options[home_logo]',
    'mime_type' => 'image',
    ) ) );

    $wp_customize->add_section( 'wt_header_image' , array(
    'title' => 'تصویر هدر پیشفرض',
    'panel' => 'wt_settings',
    'capability' => 'manage_options',
    ) );
    
    $wp_customize->add_setting( 'wt_options[header_image]', array(
    'type' => 'option',
    'capability' => 'manage_options',
    'sanitize_callback' => '',
	'transport' => 'refresh',
	'section'	=> 'wt_header_image'
	) );
	
	$wp_customize->add_control(new WP_Customize_Media_Control( $wp_customize , 'wt_header_image' , array(
		'label'	=> 'تصویر هدر پیشفرض برای صفحات',
		'section'	=> 'wt_header_image',
		'settings'	=> 'wt_options[header_image]',
		'mime_type'	=> 'image',
	)));
}
