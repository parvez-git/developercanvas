<?php
/**
 * developercanvas functions and definitions
 * @package developercanvas
 */

if ( ! function_exists( 'developercanvas_setup' ) ) :

	function developercanvas_setup() {

		load_theme_textdomain( 'developercanvas', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'developercanvas' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'developercanvas_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'developercanvas_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function developercanvas_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'developercanvas_content_width', 640 );
}
add_action( 'after_setup_theme', 'developercanvas_content_width', 0 );

/**
 * Register widget area.
 */
function developercanvas_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'developercanvas' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'developercanvas' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Projects Sidebar', 'developercanvas' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add projects widgets here.', 'developercanvas' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'developercanvas_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function developercanvas_scripts() {

	wp_enqueue_style( 'developercanvas-fonts', 'https://fonts.googleapis.com/css?family=Josefin+Sans:400|Raleway:300', array(), '', 'all' );
	wp_enqueue_style( 'developercanvas-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7', 'all' );
	wp_enqueue_style( 'developercanvas-fontello', get_template_directory_uri() . '/css/fontello.css', array(), '13879070', 'all' );
	wp_enqueue_style( 'developercanvas-fresco', get_template_directory_uri() . '/css/fresco/fresco.css', array(), '2.2.3', 'all' );
	wp_enqueue_style( 'developercanvas-style', get_stylesheet_uri() );

	wp_enqueue_script( 'developercanvas-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
	wp_enqueue_script( 'developercanvas-fresco', get_template_directory_uri() . '/js/fresco.js', array('jquery'), '2.2.3', true );
	wp_enqueue_script( 'developercanvas-masonry.pkgd', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), '4.2.0', true );

  if ( is_front_page() ) {
  	wp_enqueue_script( 'developercanvas-theater', get_template_directory_uri('jquery') . '/js/theater.min.js', array(), '3.1.0', true );
  	wp_enqueue_script( 'developercanvas-theater-scripts', get_template_directory_uri() . '/js/theater-scripts.js', array('jquery'), '1.0.0', true );
  }

	wp_enqueue_script( 'developercanvas-smooth-scroll', get_template_directory_uri() . '/js/jquery.smooth-scroll.js', array('jquery'), '2.1.2', true );
	wp_enqueue_script( 'developercanvas-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'developercanvas-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'developercanvas_scripts' );

/**
 * Include Files
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/devcan-custom-post.php';
require get_template_directory() . '/inc/devcan-widget.php';


/** ---------------------------------------------------------------
 * Custom Excerpt.
 * --------------------------------------------------------------- */
 function devcan_excerpt_more( $more ) {
     return ' . . .';
 }
 add_filter('excerpt_more', 'devcan_excerpt_more');

/**
 * Image Editor.
 */
function change_graphic_lib($array) {
  return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}
add_filter( 'wp_image_editors', 'change_graphic_lib' );

/**
 * Custom post type Archive.
 */
add_action( 'pre_get_posts', function ( $query )
{
  if ( !is_admin() && $query->is_main_query() && $query->is_archive() )
     $query->set( 'post_type', array( 'post', 'devcan_projects' ) );
});
