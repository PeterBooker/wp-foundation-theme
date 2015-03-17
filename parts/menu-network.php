<?php
/**
 * Foundation 5 Top Bar
 */
?>
<nav class="top-bar" data-topbar data-options="mobile_show_parent_link: true" role="navigation">

    <ul class="title-area">
        <li class="name">
            <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?> Network</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
            <?php if ( is_user_logged_in() ) : ?>
                <li><a href="<?php echo wp_logout_url( site_url( '/' ) ); ?>">Logout</a></li>
                <li><a href="#">My Account</a></li>
            <?php else : ?>
                <li><a href="<?php echo wp_login_url( site_url( '/' ) ); ?>">Login</a></li>
                <li><a href="<?php echo wp_registration_url(); ?>">Register</a></li>
            <?php endif; ?>
        </ul>

        <!-- Left Nav Section -->
        <ul class="left">
            <li class="has-dropdown">
                <a href="#">Games</a>
                <ul class="dropdown">
                    <li><a href="http://wow.duplexgaming.co.uk">World of Warcraft</a></li>
                    <li><a href="http://lol.duplexgaming.co.uk">League of Legends</a></li>
                    <li><a href="http://mc.duplexgaming.co.uk">Minecraft</a></li>
                </ul>
            </li>
        </ul>
    </section>

</nav>