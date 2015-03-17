<?php
/**
 * WP Foundation Theme functions and definitions
 *
 * @package WP Foundation Theme
 */

define( 'FOUNDATION_VERSION', '0.1.0' );
define( 'FOUNDATION_URL', get_template_directory_uri() );
define( 'FOUNDATION_PATH', get_template_directory() );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
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
		'primary' => 'Primary Menu',
        //'secondary' => 'Secondary Menu'
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
function foundation_register_scripts() {

    wp_register_script( 'foundation', FOUNDATION_URL . '/assets/js/foundation.min.js', array( 'jquery' ), FOUNDATION_VERSION, true );

    wp_register_script( 'modernizr', FOUNDATION_URL . '/assets/js/modernizr.js', array(), FOUNDATION_VERSION, true );

    wp_register_script( 'datatables', FOUNDATION_URL . '/assets/js/jquery.dataTables.min.js', array(), '1.10.2', true );

    wp_register_script( 'jquery-timeago', FOUNDATION_URL . '/assets/js/jquery.timeago.js', array( 'jquery' ), FOUNDATION_VERSION, true );

    wp_register_script( 'dignity-customizer', FOUNDATION_URL . '/assets/js/customizer.js', array( 'customize-preview' ), FOUNDATION_VERSION, true );

    wp_register_script( 'dignity-skip-link-focus-fix', FOUNDATION_URL . '/assets/js/skip-link-focus-fix.js', array(), FOUNDATION_VERSION, true );

    wp_register_script( 'dignity-navigation', FOUNDATION_URL . '/assets/js/navigation.js', array(), FOUNDATION_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'foundation_register_scripts' );

/**
 * Enqueue scripts and styles.
 */
function foundation_enqueue_scripts() {

    if ( ! is_admin() ) {

        wp_enqueue_style( 'foundation-style', get_stylesheet_uri() );

        wp_enqueue_script( 'modernizr' );

        wp_enqueue_script( 'foundation' );

        wp_enqueue_script( 'datatables' );

        wp_enqueue_script( 'jquery-timeago' );

        //wp_enqueue_script( 'foundation-navigation' );

        //wp_enqueue_script( 'foundation-customizer' );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

            wp_enqueue_script( 'comment-reply' );

        }

    } else {



    }

}
add_action( 'wp_enqueue_scripts', 'foundation_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'foundation_enqueue_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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

/**
 * Custom menu walkers for this theme.
 */
require get_template_directory() . '/inc/menu-walkers.php';

/**
 * Initialize the Foundation script on every page.
 */
function foundation_foundation_init() {

    ?>
    <script type="text/javascript">
        jQuery( document ).ready(function( $ ) {
            $(document).foundation();
        });
    </script>
    <?php

}
add_action( 'wp_footer', 'foundation_foundation_init', 20 );


/**
 * Customize the Login Page Link
 */
function foundation_login_url() {

    return home_url();

}
add_filter( 'login_headerurl', 'foundation_login_url' );

/**
 * Customize the Login Page Title
 */
function foundation_login_title() {

    return get_option( 'blogname' );

}
add_filter( 'login_headertitle', 'foundation_login_title' );

/**
 * Redirect Logouts to Home Page
 */
function foundation_logout_redirect( $logouturl, $redir ) {

    $redir = get_bloginfo('url');
    return $logouturl . '&redirect_to=' . urlencode( $redir );

}
add_filter( 'logout_url', 'foundation_logout_redirect', 10, 2 );

/**
 * Remove the default Admin Bar offset, custom CSS manually adds this.
 */
function foundation_default_admin_bar_fix() {

    if( ! is_admin() && is_admin_bar_showing() ) {

        remove_action( 'wp_head', '_admin_bar_bump_cb' );

    }

}
add_action( 'wp_head', 'foundation_default_admin_bar_fix', 5 );