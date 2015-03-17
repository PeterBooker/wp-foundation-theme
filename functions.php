<?php
/**
 * WP Foundation Theme functions and definitions
 *
 * @package WP Foundation Theme
 */

define( 'DIGNITY_VERSION', '0.1.0' );
define( 'DIGNITY_URL', get_template_directory_uri() );
define( 'DIGNITY_PATH', get_template_directory() );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

if ( ! function_exists( 'dignity_setup' ) ) :
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
        'secondary' => 'Secondary Menu'
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
add_action( 'after_setup_theme', 'dignity_setup' );

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

    register_sidebar( array(
        'name'          => 'Sidebar - Forums',
        'id'            => 'sidebar-2',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'dignity_widgets_init' );

/**
 * Register scripts and styles.
 */
function foundation_register_scripts() {

    wp_register_script( 'foundation', DIGNITY_URL . '/assets/js/foundation.min.js', array( 'jquery' ), DIGNITY_VERSION, true );

    wp_register_script( 'modernizr', DIGNITY_URL . '/assets/js/modernizr.js', array(), DIGNITY_VERSION, true );

    wp_register_script( 'datatables', DIGNITY_URL . '/assets/js/jquery.dataTables.min.js', array(), '1.10.2', true );

    wp_register_script( 'jquery-timeago', DIGNITY_URL . '/assets/js/jquery.timeago.js', array( 'jquery' ), DIGNITY_VERSION, true );

    wp_register_script( 'dignity-customizer', DIGNITY_URL . '/assets/js/customizer.js', array( 'customize-preview' ), DIGNITY_VERSION, true );

    wp_register_script( 'dignity-skip-link-focus-fix', DIGNITY_URL . '/assets/js/skip-link-focus-fix.js', array(), DIGNITY_VERSION, true );

    wp_register_script( 'dignity-navigation', DIGNITY_URL . '/assets/js/navigation.js', array(), DIGNITY_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'dignity_register_scripts' );

/**
 * Enqueue scripts and styles.
 */
function foundation_enqueue_scripts() {

    if ( ! is_admin() ) {

        wp_enqueue_style( 'dignity-style', get_stylesheet_uri() );

        wp_enqueue_script( 'modernizr' );

        wp_enqueue_script( 'foundation' );

        wp_enqueue_script( 'datatables' );

        wp_enqueue_script( 'jquery-timeago' );

        //wp_enqueue_script( 'dignity-navigation' );

        //wp_enqueue_script( 'dignity-customizer' );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

            wp_enqueue_script( 'comment-reply' );

        }

    } else {



    }

}
add_action( 'wp_enqueue_scripts', 'dignity_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'dignity_enqueue_scripts' );

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
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom menu walkers for this theme.
 */
require get_template_directory() . '/inc/menu-walkers.php';

/**
 * Asset Caching file.
 */
require get_template_directory() . '/inc/asset-caching.php';

/**
 * Initialize the Foundation script on every page.
 */
function foundation_foundation_init() {

    ?>
    <script type="text/javascript">
        jQuery( document ).ready(function( $ ) {
            $(document).foundation();
        });
        jQuery( document ).ready(function( $ ) {
            $('#roster').dataTable({
                "paging":   false,
                "ordering": true,
                "info":     true,
                "searching": true,
                "order": [[ 5, "desc" ]],
                "pagingType": "full",
                "dom": '<"row"<"small-6 columns"l><"small-6 columns"f>>rt<"row"<"small-12 columns"i>><"row"<"small-12 columns"p>>'
            });
        } );
        jQuery( document ).ready(function( $ ) {
            $.timeago.settings.strings = {
                seconds: "1 min",
                minute: "1 min",
                minutes: "%d mins",
                hour: "1 hour",
                hours: "%d hours",
                day: "1 day",
                days: "%d days",
                month: "1 month",
                months: "%d months",
                suffixAgo: ""
            };
            $("time.timeago").timeago();
        });
    </script>
    <?php

}
add_action( 'wp_footer', 'dignity_foundation_init', 20 );

/**
 * Customize the Login Page Styling
 */
function foundation_login_css() {

    //wp_enqueue_style( 'dignity-login', get_template_directory_uri() . '/library/css/login.css', false );

}
//add_action( 'login_enqueue_scripts', 'dignity_login_css', 10 );

/**
 * Customize the Login Page Link
 */
function foundation_login_url() {

    return home_url();

}
add_filter( 'login_headerurl', 'dignity_login_url' );

/**
 * Customize the Login Page Title
 */
function foundation_login_title() {

    return get_option( 'blogname' );

}
add_filter( 'login_headertitle', 'dignity_login_title' );

/**
 * Initialize the Wowhead Tooltips script on every page.
 */
function foundation_wowhead_tooltips_init() {

    $color = 'false';
    $iconize = 'false';
    $rename = 'false';

    ?>
    <script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>
    <script>var wowhead_tooltips = { "colorlinks": <?php echo esc_attr( $color ); ?>, "iconizelinks": <?php echo esc_attr( $iconize ); ?>, "renamelinks": <?php echo esc_attr( $rename ); ?> }</script>
    <?php

}
add_action( 'wp_footer', 'dignity_wowhead_tooltips_init' );

/*
 * Enable SMTP Email Support
 */
function foundation_configure_smtp( PHPMailer $phpmailer ) {

    $phpmailer->isSMTP(); //switch to smtp
    $phpmailer->Host = 'smtp.googlemail.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 465;
    $phpmailer->Username = EMAIL_USERNAME;
    $phpmailer->Password = EMAIL_PASSWORD;
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->From = 'admin@duplexgaming.co.uk';
    $phpmailer->FromName = 'Dignity Gaming';

}
add_action( 'phpmailer_init', 'dignity_configure_smtp' );

/**
 * Remove bbPress Stylesheets
 */
function foundation_deregister_bbpress_styles() {
    wp_deregister_style( 'bbp-default' );
}
//add_action( 'wp_print_styles', 'dignity_deregister_bbpress_styles', 15 );


/**
 * Return Blank for Single Forum/Topic Data (numbers after sub forums).
 */
function foundation_bbpress_return_blank() {

    return '';

}
add_filter( 'bbp_get_single_forum_description', 'dignity_bbpress_return_blank' );
add_filter( 'bbp_get_single_topic_description', 'dignity_bbpress_return_blank' );

/**
 * Reomve the bbPress Topic and Reply Counts
 * and Make the bbPress Sub Form List Vertical
 */
function foundation_bbpress_edit_sub_forums() {

    $args['separator'] = '<br>';
    $args['show_topic_count'] = false;
    $args['show_reply_count'] = false;
    $args['count_sep'] = '';
    return $args;

}
add_filter( 'bbp_before_list_forums_parse_args', 'dignity_bbpress_edit_sub_forums' );

/**
 * Redirect Logouts to Home Page
 */
function foundation_logout_redirect( $logouturl, $redir ) {

    $redir = get_bloginfo('url');
    return $logouturl . '&redirect_to=' . urlencode( $redir );

}
add_filter( 'logout_url', 'dignity_logout_redirect', 10, 2 );