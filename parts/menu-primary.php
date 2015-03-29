<?php
/**
 * Foundation 5 Top Bar
 */
?>
<nav class="top-bar" data-topbar data-options="mobile_show_parent_link: true" role="navigation">

    <ul class="title-area">
        <li class="name">
            <h1><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <?php
        wp_nav_menu( array(
            'menu_class' => 'right',
            'theme_location' => 'topbar-right',
            'walker' => new WP_TopBar_Walker(),
        ) );
        ?>

        <!-- Left Nav Section -->
        <?php
        wp_nav_menu( array(
            'menu_class' => 'left',
            'theme_location' => 'topbar-left',
            'walker' => new WP_TopBar_Walker(),
        ) );
        ?>
    </section>

</nav>