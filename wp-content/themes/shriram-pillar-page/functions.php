<?php
/**
 * Medicord functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package xseed
 */

if ( ! function_exists( 'xseed_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function xseed_setup() {

	

		

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'xseed' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'xseed_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'xseed_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function xseed_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'xseed' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'xseed' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'xseed_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function xseed_scripts() {	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper.min.css', array(), '3.4.2' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0' );
	wp_enqueue_style( 'padd', get_template_directory_uri().'/css/padd.css', array(), '1.0' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri().'/css/magnific-popup.css', array(), '1.1.0' );
	wp_enqueue_style( 'animate', get_template_directory_uri().'/css/animate.css', array(), '3.5.1' );
	wp_enqueue_style( 'xseed-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'jquery-min', get_template_directory_uri().'/js/jquery.min.js', array(), '3.1.1' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array(), '3.3.7', true );
	wp_enqueue_script( 'swiper', get_template_directory_uri().'/js/swiper.min.js', array(), '3.4.2', true );
	wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.min.js', array(), '1.1.3', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), '1.1.0', true );
	wp_enqueue_script( 'custom', get_template_directory_uri().'/js/custom.js', array(), '1.0', true );
	$urlarrays = array( 'site_url' => get_site_url(),'template_url' => get_template_directory_uri() );
	wp_localize_script( 'custom','siteurls',$urlarrays );
}
add_action( 'wp_enqueue_scripts', 'xseed_scripts' );

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}
