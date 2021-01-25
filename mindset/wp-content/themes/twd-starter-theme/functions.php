<?php
/**
 * TWD Starter Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TWD_Starter_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.2.1' );
}

if ( ! function_exists( 'twd_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twd_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on TWD Starter Theme, use a find and replace
		 * to change 'twd' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twd', get_template_directory() . '/languages' );

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

		// Portrait Blog Size - 200px width, 250px height, hard crop
		add_image_size( 'portrait-blog', 200, 250, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header' => esc_html__( 'Header Menu Location', 'twd' ),
				'footer' => esc_html__( 'Footer Menu Location', 'twd' ),
				'social_navigation' => esc_html__( 'Social Media Menu Location', 'twd' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets'
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'twd_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		// note: custom-logo-link dimensions are managed in style.css
		add_theme_support(
			'custom-logo',
			array(
				'height'      			=> 50,
				'width'       			=> 50,
				'flex-width'  			=> false,
				'flex-height' 			=> false,
				//'unlink-homepage-logo' 	=> true,
			)
		);

		/**
		 * Add support for Block Editor features.
		 *
		 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
		 */
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'custom-line-height' );
		add_theme_support( 'custom-units' );
		//add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'twd_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twd_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twd_content_width', 960 );
}
add_action( 'after_setup_theme', 'twd_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twd_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'twd' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'twd' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function twd_scripts() {
	// Chivo Light
	wp_enqueue_style( 
			'twd-googlefonts', 
			'https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i',
			array(),
			null
		);
	wp_enqueue_style( 'twd-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'twd-style', 'rtl', 'replace' );

	wp_enqueue_script( 'twd-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	// Scroll to Top Button
	// https://codepen.io/jtleathers/pen/yLYejVG

	// Scroll to Top Button - JS file
	wp_enqueue_script( 
			'scroll-top', 
			get_template_directory_uri().'/js/scroll-top.js', 
			array('jquery'), 
			_S_VERSION, 
			true 
		);
	// Scroll to Top Button - CSS file
	wp_enqueue_style( 
			'scroll-top', 
			get_template_directory_uri() . '/css/scroll-top.css' 
		);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load Slick slider only on the Home page
	if ( is_front_page( ) ) {

		// JS files
		wp_enqueue_script( 
			'twd-slickslider', 
			get_template_directory_uri().'/js/slick.min.js', 
			array('jquery'), 
			_S_VERSION, 
			true 
		);
		wp_enqueue_script( 
			'twd-slickslider-settings', 
			get_template_directory_uri().'/js/slick-settings.js', 
			array('jquery', 'twd-slickslider'), 
			_S_VERSION, 
			true 
		);

		// CSS files
		wp_enqueue_style( 
			'twd-slicktheme', 
			get_template_directory_uri() . '/css/slick-theme.css' 
		);
		wp_enqueue_style( 
			'twd-slick', 
			get_template_directory_uri() . '/css/slick.css' 
		);

	}

}
add_action( 'wp_enqueue_scripts', 'twd_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * +
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Post Types & Taxonomies
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

// Add Theme Color Meta Tag
function ms_theme_color() {
	echo '<meta name="theme-color" content="$FFF200">';
}
add_action( 'wp_head', 'ms_theme_color' );

// Change the_excerpt length
function ms_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'ms_excerpt_length', 999 );

// Change the_excerpt more text
function ms_excerpt_more( $more ) {
	return '... <a class="read-more" href="' . get_permalink() . '"><br>Continue Reading "' . get_the_title() . '"</a>';
}
add_filter( 'excerpt_more', 'ms_excerpt_more' );

// Remove Editor from Homepage
function ms_post_filter( $use_block_editor, $post ) {
	if ( 5 === $post->ID ) {
		return false;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'ms_post_filter', 10, 2 );