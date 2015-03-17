<?php
/**
 * Foundation 5 Top Bar
 */
?>
<nav class="top-bar" data-topbar data-options="mobile_show_parent_link: true" role="navigation">

    <ul class="title-area">
        <li class="name">
            <h1><a href="<?php echo esc_url( home_url() ); ?>">Dignity Gaming<?php //bloginfo( 'description' ); ?></a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
        <?php
        wp_nav_menu( array(
            'container' => false,
            'menu_class' => 'right',
            'theme_location' => 'primary',
            'walker' => new F5_TOP_BAR_WALKER(),
        ) );
        ?>

        <!-- Left Nav Section -->
        <ul class="left">
            <li class="menu-item">
                <a class="left-off-canvas-toggle" href="#"><i class="fa fa-lg fa-gamepad"></i><span class="hide-for-medium-up">Our Games</span></a>
            </li>
        </ul>
    </section>

</nav>