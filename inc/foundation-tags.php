<?php
/**
 * Custom Foundation template tags for this theme.
 *
 * http://foundation.zurb.com/docs/
 *
 * @package WP Foundation Theme
 */

/*
 * Generates a Foundation Button
 */
function zf_button( $url = '#', $text = 'Button', $classes = array( 'button' ), $element = 'a', $target = '' ) {

    // Prepare Classes
    if ( ! is_array( $classes ) ) {
        $classes = array( 'button' );
    }
    if ( ! in_array( 'button', $classes ) ) {
        $classes[] = 'button';
    }

    // Prepare Attributes
    $attributes = ! empty( $url ) ? ' href="' . esc_attr( $url ) . '"' : '';
    $attributes .= ! empty( $target ) ? ' target="' . esc_attr( $target ) . '"' : '';

    $output = '<' . $element . $attributes . ' class="' . esc_attr( implode( ' ', $classes ) ) . '">' . $text . '</' . $element . '>';

    // Output HTML
    return $output;

}

/*
 * Generates a Foundation Button Group
 */
function zf_button_group( $classes = array( 'button-group' ), $buttons ) {

    // Return false if no buttons are set.
    if ( ! is_array( $buttons ) ) {
        return false;
    }

    // Prepare Classes
    if ( ! is_array( $classes ) ) {
        $classes = array( 'button-group' );
    }
    if ( ! in_array( 'button-group', $classes ) ) {
        $classes[] = 'button-group';
    }

    $output = '<ul class="' . esc_attr( implode( ' ', $classes ) ) . '">' . PHP_EOL;

    foreach ( $buttons as $button ) {

        $output .=
            '<li>' . zf_button(
                ( isset( $button['url'] ) ) ? $button['url'] : '#',
                ( isset( $button['text'] ) ) ? $button['text'] : 'Button',
                ( isset( $button['classes'] ) && is_array( $button['classes'] ) ) ? $button['classes'] : array( 'button' ),
                ( isset( $button['element'] ) ) ? $button['element'] : 'a',
                ( isset( $button['target'] ) ) ? $button['target'] : ''
            ) . '</li>' . PHP_EOL;

    }

    $output .= '</ul>' . PHP_EOL;

    return $output;

}