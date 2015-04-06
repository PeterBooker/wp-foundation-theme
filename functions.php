<?php
/**
 * WP Foundation Theme functions and definitions
 *
 * @package WP Foundation Theme
 */

$theme = wp_get_theme();

define( 'FOUNDATION_VERSION', $theme->get( 'Version' ) );
define( 'FOUNDATION_URL', get_template_directory_uri() );
define( 'FOUNDATION_PATH', get_template_directory() );

unset( $theme );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1024; /* pixels */
}

if ( ! function_exists( 'foundation_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function foundation_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WP dignity, use a find and replace
	 * to change 'foundation' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'foundation', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

    //set_post_thumbnail_size( 260, 130, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'topbar-left' => 'Top Bar Menu - Left',
        'topbar-right' => 'Top Bar Menu - Right',
        'footer-menu' => 'Footer Menu'
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	//add_theme_support( 'post-formats', array(
		//'aside', 'image', 'video', 'quote', 'link'
	//) );

	// Setup the WordPress core custom background feature.
	//add_theme_support( 'custom-background', apply_filters( 'dignity_custom_background_args', array(
		//'default-color' => 'ffffff',
		//'default-image' => '',
	//) ) );

    /**
     * Implement the Custom Header feature.
     */
    //require get_template_directory() . '/inc/custom-header.php';

    /**
     * Custom template tags for this theme.
     */
    require FOUNDATION_PATH . '/inc/template-tags.php';

    /**
     * Custom functions that act independently of the theme templates.
     */
    require FOUNDATION_PATH . '/inc/extras.php';

    /**
     * Overwrite the Gallery Output - Foundation Clearing
     */
    require FOUNDATION_PATH . '/inc/gallery.php';

    /**
     * Custom Foundation Walkers.
     */
    require FOUNDATION_PATH . '/inc/menu-walkers.php';

    /**
     * Custom Foundation Specific Changes.
     */
    require FOUNDATION_PATH . '/inc/foundation.php';

    /**
     * Custom Login Page.
     */
    require FOUNDATION_PATH . '/inc/custom-login.php';

    /**
     * Customizer additions.
     */
    //require FOUNDATION_PATH . '/inc/customizer.php';

    /**
     * Load Jetpack compatibility file.
     */
    //require FOUNDATION_PATH . '/inc/jetpack.php';

}
endif; // foundation_setup
add_action( 'after_setup_theme', 'foundation_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function foundation_widgets_init() {

	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'foundation_widgets_init' );

/**
 * Register scripts and styles.
 */
function foundation_register_files() {

    wp_register_script( 'zurb-foundation', FOUNDATION_URL . '/assets/js/src/foundation.min.js', array( 'jquery' ), FOUNDATION_VERSION, true );

    wp_register_script( 'modernizr', FOUNDATION_URL . '/assets/js/src/modernizr.js', array(), FOUNDATION_VERSION, false );

    wp_register_script( 'foundation-customizer', FOUNDATION_URL . '/assets/js/src/customizer.js', array( 'customize-preview' ), FOUNDATION_VERSION, true );

    wp_register_script( 'foundation-skip-link-focus-fix', FOUNDATION_URL . '/assets/js/src/skip-link-focus-fix.js', array(), FOUNDATION_VERSION, true );

    wp_register_script( 'foundation-navigation', FOUNDATION_URL . '/assets/js/src/navigation.js', array(), FOUNDATION_VERSION, true );

    wp_register_script( 'foundation-combined', FOUNDATION_URL . '/assets/js/scripts.min.js', array(), FOUNDATION_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'foundation_register_files' );

/**
 * Enqueue scripts and styles.
 */
function foundation_enqueue_files() {

    if ( ! is_admin() ) {

        wp_enqueue_style( 'foundation-style', get_stylesheet_uri(), array(), FOUNDATION_VERSION );

        wp_enqueue_script( 'modernizr' );

        wp_enqueue_script( 'kebo-combined' );

        //wp_enqueue_script( 'zurb-foundation' );

        //wp_enqueue_script( 'foundation-navigation' );

        //wp_enqueue_script( 'foundation-customizer' );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

            wp_enqueue_script( 'comment-reply' );

        }

    } else {



    }

}
add_action( 'wp_enqueue_scripts', 'foundation_enqueue_files' );
add_action( 'admin_enqueue_scripts', 'foundation_enqueue_files' );

/**
 * Cleanup the WP Head.
 */
function foundation_head_cleanup() {

    // Category Feeds
    // remove_action( 'wp_head', 'feed_links_extra', 3 );

    // Post and Comment Feeds
    // remove_action( 'wp_head', 'feed_links', 2 );

    // EditURI Link
    remove_action( 'wp_head', 'rsd_link' );

    // Windows Live Writer
    remove_action( 'wp_head', 'wlwmanifest_link' );

    // previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

    // start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

    // Next post links
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

    // WP Version
    remove_action( 'wp_head', 'wp_generator' );

}
add_action( 'init', 'foundation_head_cleanup' );

/**
 * Customize the Editor Styling
 */
function foundation_add_editor_styles() {

	add_editor_style( FOUNDATION_URL . '/assets/css/editor.css?v=' . FOUNDATION_VERSION );

}
add_action( 'admin_init', 'foundation_add_editor_styles' );

/*
 * Prevent Automatic Compression of JPEG Images
 */
function foundation_jpeg_quality_filter() {
    return 100;
}
//add_filter( 'jpeg_quality', 'foundation_jpeg_quality_filter' );