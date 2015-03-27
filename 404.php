<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package WP Foundation Theme
 */

get_header(); ?>

    <div class="content-area">

        <div id="content" class="site-content row">

            <div id="primary" class="small-12 medium-12 large-12 columns">

                <main id="main" class="site-main" role="main">

                    <section class="error-404 not-found">

                        <header class="page-header">
                            <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'foundation' ); ?></h1>
                        </header><!-- .page-header -->

                        <div class="page-content">

                            <p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'foundation' ); ?></p>

                            <?php get_search_form(); ?>

                            <div class="row">

                                <div class="small-12 medium-6 large-6 columns">

                                    <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

                                    <?php if ( foundation_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
                                        <div class="widget widget_categories">
                                            <h2 class="widget-title"><?php _e( 'Most Used Categories', 'foundation' ); ?></h2>
                                            <ul>
                                                <?php
                                                wp_list_categories( array(
                                                    'orderby'    => 'count',
                                                    'order'      => 'DESC',
                                                    'show_count' => 1,
                                                    'title_li'   => '',
                                                    'number'     => 10,
                                                ) );
                                                ?>
                                            </ul>
                                        </div><!-- .widget -->
                                    <?php endif; ?>

                                </div>

                                <div class="small-12 medium-6 large-6 columns">

                                    <?php
                                    /* translators: %1$s: smiley */
                                    $archive_content = '<p>' . __( 'Try looking in the monthly archives:', 'foundation' ) . '</p>';
                                    the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
                                    ?>

                                    <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

                                </div>

                            </div>

                        </div><!-- .page-content -->

                    </section><!-- .error-404 -->

                </main><!-- #main -->

            </div><!-- #primary -->

        </div><!-- #content .site-content .row -->

    </div><!-- .content-area -->

<?php get_footer(); ?>
