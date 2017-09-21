<?php
/**
 * developercanvas Theme Customizer
 * @package developercanvas
 */

function developercanvas_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'developercanvas_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'developercanvas_customize_partial_blogdescription',
		) );
	}


	// Socials Section
	$wp_customize->add_section( 'socials_section', array(
	  'title' 			=> __( 'Socials Section', 'developercanvas' ),
	  'description' => __( 'Add Socials link here', 'developercanvas' ),
	  'priority' 		=> 130,
	  'panel' 			=> '',
	) );

	// Socials URL
  	$wp_customize->add_setting( 'socials_url_facebook', array(
	  'default' 						=> '',
  	'transport' 					=> 'refresh',
	  'priority' 						=> 10,
	  'sanitize_callback'   => 'esc_url_raw',
	) );
  	$wp_customize->add_control( 'socials_url_facebook', array(
	  'label' 	=> __( 'Facebook URL', 'developercanvas' ),
  	'type' 		=> 'text',
	  'section' => 'socials_section',
	) );

	$wp_customize->add_setting( 'socials_url_twitter', array(
	  'default' 						=> '',
  	'transport' 					=> 'refresh',
	  'priority' 						=> 10,
	  'sanitize_callback'   => 'esc_url_raw',
	) );
  	$wp_customize->add_control( 'socials_url_twitter', array(
	  'label' 	=> __( 'Twitter URL', 'developercanvas' ),
  	'type' 		=> 'text',
	  'section' => 'socials_section',
	) );

	$wp_customize->add_setting( 'socials_url_youtube', array(
	  'default' 						=> '',
  	'transport' 					=> 'refresh',
	  'priority' 						=> 10,
	  'sanitize_callback'   => 'esc_url_raw',
	) );
  	$wp_customize->add_control( 'socials_url_youtube', array(
	  'label' 	=> __( 'Youtube URL', 'developercanvas' ),
  	'type' 		=> 'text',
	  'section' => 'socials_section',
	) );

	$wp_customize->add_setting( 'socials_url_linkedin', array(
	  'default' 						=> '',
  	'transport' 					=> 'refresh',
	  'priority' 						=> 10,
	  'sanitize_callback'   => 'esc_url_raw',
	) );
  	$wp_customize->add_control( 'socials_url_linkedin', array(
	  'label' 	=> __( 'LinkedIn URL', 'developercanvas' ),
  	'type' 		=> 'text',
	  'section' => 'socials_section',
	) );

	$wp_customize->add_setting( 'socials_url_github', array(
	  'default' 						=> '',
  	'transport' 					=> 'refresh',
	  'priority' 						=> 10,
	  'sanitize_callback'   => 'esc_url_raw',
	) );
  	$wp_customize->add_control( 'socials_url_github', array(
	  'label' 	=> __( 'Github URL', 'developercanvas' ),
  	'type' 		=> 'text',
	  'section' => 'socials_section',
	) );

}
add_action( 'customize_register', 'developercanvas_customize_register' );




/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function developercanvas_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function developercanvas_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function developercanvas_customize_preview_js() {
	wp_enqueue_script( 'developercanvas-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'developercanvas_customize_preview_js' );
