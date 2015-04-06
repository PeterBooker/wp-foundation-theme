<?php
/**
 * Custom Login Page
 */

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
 * Customize the Login Page Styling
 */
function foundation_login_style() {

    // Add our custom styles.
    wp_enqueue_style( 'foundation-login', FOUNDATION_URL . '/assets/css/login.css', array(), FOUNDATION_VERSION );

}
add_action( 'login_enqueue_scripts', 'foundation_login_style', 50 );

/**
 * Redirect Logouts to Home Page
 */
function foundation_logout_redirect( $logouturl, $redir ) {

    $redir = get_bloginfo('url');
    return $logouturl . '&redirect_to=' . urlencode( $redir );

}
add_filter( 'logout_url', 'foundation_logout_redirect', 10, 2 );