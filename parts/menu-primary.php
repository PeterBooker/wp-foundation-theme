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
        <?php
        wp_nav_menu( array(
            'menu_class' => 'right',
            'theme_location' => 'primary',
            'walker' => new WP_Foundation_TopBar(),
        ) );
        ?>

        <!-- Left Nav Section -->
        <ul class="left">

        </ul>
    </section>

</nav>