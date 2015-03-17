<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package WP Foundation Theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area small-12 medium-4 large-3 columns small-only-text-center" role="complementary">

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

</div><!-- #secondary -->
