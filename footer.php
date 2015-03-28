<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WP Foundation Theme
 */
?>

    <div class="footer-area">

        <footer id="colophon" class="site-footer row" role="contentinfo">

            <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4 text-center">

                <li>
                    <h2>Title #1</h2>
                    <p>This is the WP Foundation Starter Theme, based on Underscores (_s) and the Foundation Framework (by Zurb).</p>
                </li>

                <li>
                    <h2>Title #2</h2>
                    <ul class="side-nav">
                        <li><a href="#">Link #1</a></li>
                        <li><a href="#">Link #2</a></li>
                        <li><a href="#">Link #3</a></li>
                        <li><a href="#">Link #4</a></li>
                    </ul>
                </li>

                <li>
                    <h2>Title #3</h2>
                    <?php
                    wp_nav_menu( array(
                        'container' => false,
                        'menu_class' => 'side-nav',
                        'theme_location' => 'footer-menu',
                    ) );
                    ?>
                </li>

                <li>
                    <h2>Title #4</h2>
                    <ul class="side-nav">
                        <li><a href="#">Link #1</a></li>
                        <li><a href="#">Link #2</a></li>
                        <li><a href="#">Link #3</a></li>
                        <li><a href="#">Link #4</a></li>
                    </ul>
                </li>

            </ul>

        </footer><!-- #colophon -->

    </div><!-- .footer-area -->

    <div class="info-area">

        <div class="site-info row">

            <div class="small-12 columns">

                <p class="text-center">Copyright &copy; WP Foundation Theme 2014-<?php echo date( 'Y' ); ?>. All Rights Reserved.</p>

            </div>

        </div><!-- .site-info -->

    </div>

</div><!-- #page .site -->

<?php wp_footer(); ?>

</body>
</html>
