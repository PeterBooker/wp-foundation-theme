<?php
/**
 * Customise the Gallery Output
 * Uses default code where possible
 */

function foundation_gallery_output( $output, $attr ) {

    global $post;

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) )
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract( shortcode_atts( array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        //'itemtag' => 'dl',
        //'icontag' => 'dt',
        //'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => '',
        'link' => ''
    ), $attr ) );

    $id = intval( $id );
    if ( 'RAND' == $order ) $orderby = 'none';

    if ( ! empty( $include ) ) {
        $_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( ! empty( $exclude ) ) {
        $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
    } else {
        $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
    }

    if ( empty( $attachments ) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
        return $output;
    }

    $columns = intval( $columns );

    $selector = "gallery-{$instance}";

    $output = "<div id='$selector' class='gallery galleryid-{$id}'>\n";

    $output .= "<ul class='small-block-grid-2 medium-block-grid-4 large-block-grid-6 clearing-thumbs' data-clearing>\n";

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {

        $i++;

        // Fetch all data related to attachment
        $img = wp_prepare_attachment_for_js( $id );

        $url_small = isset( $img['sizes']['thumbnail']['url'] ) ? $img['sizes']['thumbnail']['url'] : $img['sizes']['full']['url'];
        $url_large = isset( $img['sizes']['large']['url'] ) ? $img['sizes']['large']['url'] : ( isset( $img['sizes']['medium']['url'] ) ? $img['sizes']['medium']['url'] : $img['sizes']['full']['url'] );

        $alt = $img['alt'];
        $caption = $img['caption'];

        $output .= "<li class=\"gallery-item item-{$i}\">\n";
        $output .= "<a class=\"th\" href=\"{$url_large}\">\n";
        $output .= "<img src=\"{$url_small}\" alt=\"{$alt}\" data-caption=\"{$caption}\">\n";
        $output .= "</a>\n";

    }

    $output .= "</ul>\n";

    $output .= "</div>\n";

    return $output;

}
add_filter( 'post_gallery', 'foundation_gallery_output', 10, 2 );