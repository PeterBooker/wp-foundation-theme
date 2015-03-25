<?php
/**
 * The template for displaying all single posts.
 *
 * @package WP Foundation Theme
 */

get_header(); ?>

    <div class="content-area">

        <div id="content" class="site-content row">

            <div id="primary" class="content-area small-12 medium-8 large-8 columns">

                <main id="main" class="site-main" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', 'single' ); ?>

                    <?php foundation_post_nav(); ?>

                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>

                <?php endwhile; // end of the loop. ?>

                </main><!-- #main -->

            </div><!-- #primary -->

            <?php get_sidebar(); ?>

        </div><!-- #content .site-content .row -->

    </div><!-- .content-area -->

<?php get_footer(); ?>