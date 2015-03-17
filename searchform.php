<?php
/**
* The template for displaying search form.
*
* @package WP Dignity Theme
*/
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

    <div class="row collapse">

        <div class="small-8 medium-8 large-8 columns">

            <label>
                <span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'kebo' ); ?></span>
                <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'dignity' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
            </label>

        </div>

        <div class="small-4 medium-4 large-4 columns">

            <input type="submit" class="search-submit button postfix" value="<?php echo esc_attr_x( 'Search', 'submit button', 'dignity' ); ?>">

        </div>

    </div>

</form>