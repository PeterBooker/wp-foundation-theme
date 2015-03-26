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
function foundation_register_files() {

    wp_register_script( 'zurb-foundation', FOUNDATION_URL . '/assets/js/src/foundation.min.js', array( 'jquery' ), FOUNDATION_VERSION, true );

    wp_register_script( 'modernizr', FOUNDATION_URL . '/assets/js/src/modernizr.js', array(), FOUNDATION_VERSION, true );

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

        wp_enqueue_script( 'zurb-foundation' );

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
//require get_template_directory() . '/inc/customizer.php';

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
function foundation_foundationjs_init() {

    ?>
    <script type="text/javascript">
        jQuery( document ).ready(function( $ ) {
            $(document).foundation();
        });
    </script>
    <?php

}
add_action( 'wp_footer', 'foundation_foundationjs_init', 20 );


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

/**
 * Remove injected CSS from recent comments widget
 */

function foundation_remove_wp_widget_recent_comments_style() {

    if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {

        remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );

    }

}
add_filter( 'wp_head', 'foundation_remove_wp_widget_recent_comments_style', 1 );

function foundation_remove_recent_comments_style() {

    global $wp_widget_factory;

    if ( isset( $wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ] ) ) {

        remove_action( 'wp_head', array( $wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ], 'recent_comments_style' ) );

    }
}
add_action( 'wp_head', 'foundation_remove_recent_comments_style', 1 );

/**
 * Replace .sticky class with .wp-sticky to avoid Foundation conflicts.
 * Foundation Compatibility
 */
function foundation_remove_sticky_class( $classes ) {

    $classes = array_diff( $classes, array( 'sticky' ) );
    $classes[] = 'wp-sticky';

    return $classes;

}
add_filter( 'post_class', 'foundation_remove_sticky_class' );

/**
 * Customize the Post Password Form
 */
function foundation_custom_password_form( $content ) {

    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $password_text = __( 'Password:' );

    $output = "<form action='" . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . "' class='post-password-form' method='post'>";
    $output .= "<label for='" . $label . "'>$password_text<span class='screen-reader-text'>" . $password_text . "</span></label>";
    $output .= "<div class='row collapse'>";
    $output .= "<div class='small-8 medium-8 large-8 columns'>";
    $output .= "<input name='post_password' id='" . $label . "' type='password'>";
    $output .= "</div>";
    $output .= "<div class='small-4 medium-4 large-4 columns'>";
    $output .= "<input type='submit' class='button postfix' name='Submit' value='" . esc_attr__( 'Submit' ) . "' />";
    $output .= "</div>";
    $output .= "</div>";
    $output .= "</form>";

    return $output;

}
add_filter( 'the_password_form', 'foundation_custom_password_form' );