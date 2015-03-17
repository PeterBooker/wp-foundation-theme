<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WP Dignity Theme
 */
?>

        </div><!-- #content .site-content .row -->

    </div><!-- .content-area -->

    <div class="footer-area">

        <footer id="colophon" class="site-footer row" role="contentinfo">

            <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4 text-center">

                <li>
                    <h2>About</h2>
                    <p>Dignity Gaming was founded in 1682 by Munchson and Sandriani as a World of Warcraft guild. Since then it has evolved into a multi-gaming community.</p>
                </li>

                <li>
                    <h2>Links</h2>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/news/">News</a></li>
                        <li><a href="/roster/">Roster</a></li>
                        <li><a href="/forums/">Forum</a></li>
                        <li><a href="/recruitment/">Recruitment</a></li>
                    </ul>
                </li>

                <li>
                    <h2>This Week</h2>
                    <ul>
                        <li>Consumed 53 cups of Tea.</li>
                        <li>Ganked 13 low levels in Stranglethorn Vale.</li>
                        <li>Made 17 hours worth of noise on Team Speak.</li>
                    </ul>
                </li>

                <li>
                    <h2>Other Games</h2>
                    <ul>
                        <li><a href="#">World of Warcraft</a></li>
                        <li><a href="#">League of Legends</a></li>
                        <li><a href="#">Minecraft</a></li>
                        <li><a href="#">Heroes of the Storm</a></li>
                        <li><a href="#">Diablo 3</a></li>
                    </ul>
                </li>

            </ul>

        </footer><!-- #colophon -->

    </div><!-- .footer-area -->

    <div class="info-area">

        <div class="site-info row">

            <div class="small-12 columns">

                <p class="text-center">Copyright &copy; Dignity Gaming 2013-<?php echo date( 'Y' ); ?>. All Rights Reserved.</p>

            </div>

        </div><!-- .site-info -->

    </div>

</div><!-- #page .site -->

<?php get_template_part( 'parts/offcanvas', 'bottom' ); ?>

<?php wp_footer(); ?>

</body>
</html>
