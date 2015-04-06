<?php
/**
 * Custom Foundation Framework Changes
 */

/**
 * Initialize the Foundation script on every page.
 */
function foundation_foundation_js_init() {

    ?>
    <script type="text/javascript">
        jQuery( document ).ready(function( $ ) {
            $(document).foundation();
        });
    </script>
    <?php

}
add_action( 'wp_footer', 'foundation_foundation_js_init', 20 );

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

/*
 * Remove inline size attributes from images
 * Allows them to be responsive
 */
function foundation_remove_size_attributes( $html ) {

    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
    return $html;

}
add_filter( 'post_thumbnail_html', 'foundation_remove_size_attributes', 10 );
add_filter( 'image_send_to_editor', 'foundation_remove_size_attributes', 10 );