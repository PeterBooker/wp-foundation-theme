<?php
/**
 * The template for displaying search results pages.
 *
 * @package WP Foundation Theme
 */

get_header(); ?>

    <div class="content-area">

        <div id="content" class="site-content row">

            <div id="primary" class="content-area small-12 medium-8 large-8 columns">

                <main id="main" class="site-main" role="main">

                <?php if ( have_posts() ) : ?>

                    <header class="page-header">
                        <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'foundation' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                    </header><!-- .page-header -->

                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php
                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'content', 'search' );
                        ?>

                    <?php endwhile; ?>

                    <?php foundation_paging_nav(); ?>

                <?php else : ?>

                    <?php get_template_part( 'content', 'none' ); ?>

                <?php endif; ?>

                </main><!-- #main -->

            </div><!-- #primary -->

            <?php get_sidebar(); ?>

        </div><!-- #content .site-content .row -->

    </div><!-- .content-area -->

<?php get_footer(); ?>
