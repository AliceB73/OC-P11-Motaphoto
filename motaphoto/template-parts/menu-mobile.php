<a href="#" id="openBtn">
    <span class="menu_mobile_icon">
        <span></span>
        <span></span>
        <span></span>
    </span>
</a>
<div class="menu_mobile">
    <nav role="navigation" class="nav_header_mobile" aria-label="<?php _e('Menu header', 'motaphoto'); ?>">
        <?php
        wp_nav_menu([
            'theme_location' => 'header-menu',
            'container' => false,
            'menu_class' => 'menu header',
            'menu_id' => 'nav_menu_mobile'
        ]);
        ?>
    </nav>
</div>