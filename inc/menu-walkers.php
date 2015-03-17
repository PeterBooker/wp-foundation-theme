<?php
/**
 * Custom Menu Walkers
 *
 * @package WP Foundation Theme
 */

class WP_Foundation_TopBar extends Walker_Nav_Menu {

    /*
     * Add Top Bar specific CSS classes to menu items
     */
    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

        $element->has_children = ! empty( $children_elements[ $element->ID ] );

        if ( ! empty( $element->classes ) ) {

            $element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';
            $element->classes[] = ( $element->has_children ) ? 'has-dropdown' : '';

        }

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

    }

    /*
     * The start of the menu
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {

        $indent = str_repeat("\t", $depth);
        $output .= "\n" . $indent . "<ul class=\"sub-menu dropdown\">\n";

    }

    /*
     * The end of the menu
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) {

        $indent = str_repeat( "\t", $depth );
        $output .= $indent . "</ul>\n";

    }

    /*
     * The start of each menu item
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $item_output = '';
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $output .= ( $depth == 0 ) ? '<li class="divider"></li>' : '';

        $classes = empty( $item->classes ) ? array() : ( array )$item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';
        $output .= $indent . '<li id="menu-item-' . $item->ID . '" ' . $class_names . '>';

        if ( empty( $item->title ) && empty( $item->url ) ) {

            $item->url = get_permalink( $item->ID );
            $item->title = $item->post_title;
            $attributes = $this->build_attributes( $item );
            $item_output .= '<a' . $attributes . '>';
            $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= '</a>';

        } else {

            $attributes = $this->build_attributes( $item );
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

        }

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );

    }

    /*
     * The end of each menu item
     */
    function end_el( &$output, $item, $depth = 0, $args = array() ) {

        $output .= "</li>\n";

    }

    private function build_attributes( $item ) {

        $attributes = '';
        $attributes .= ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

        return $attributes;

    }

}

/**
 * Helper Functions to support Compatibility
 */

/*
 * If using Top Bar at the top of the page, this ensures that it sits under the WordPress Admin Bar when it is active.
 */
if ( ! function_exists( 'wp_foundation_admin_bar_fix' ) ) {

    function wp_foundation_admin_bar_offset() {

        if ( ! is_admin() && is_admin_bar_showing() ) {

            remove_action( 'wp_head', '_admin_bar_bump_cb' );

            $output = '<style type="text/css">' . "\n\t";
            $output .= 'body.admin-bar { padding-top: 46px; }' . "\n\t";
            $output .= '@media ( min-width: 780px ) { body.admin-bar { padding-top: 32px; } }' . "\n";
            $output .= '</style>' . "\n";

            echo $output;

        }

    }
    //add_action( 'wp_head', 'wp_foundation_admin_bar_offset' );
    // Disabled as this is added to the main CSS file manually, left in for reference.
    // The remove action is added alone via the functions.php

}