<?php
/**
 * Asset Caching functions.
 */

if ( false === ( $asset_cache = get_option( 'dignity_wow_asset_cache_' . get_current_blog_id() ) ) ) {

    add_option( 'dignity_wow_asset_cache_' . get_current_blog_id(), '', '', true );

}

update_option( 'dignity_wow_asset_cache_' . get_current_blog_id(), $asset_cache );