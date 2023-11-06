<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motaphoto</title>
    <?php wp_head() ?>
</head>

<body>
    <nav role="navigation" class="nav_header" aria-label="<?php _e('Menu header', 'motaphoto'); ?>">
        <a href="<?php echo get_site_url() ?>"><img class="logo" alt="Nathalie Mota" src="<?php echo get_template_directory_uri() . '/assets/images/logo.png'; ?>"></a>
        <?php
        wp_nav_menu([
            'theme_location' => 'header-menu',
            'container' => false,
            'menu_class' => 'menu header',
            'menu_id' => 'nav_menu'
        ]);
        ?>
        <a href="#" id="openBtn">
            <span class="menu_mobile_icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>
    </nav>

    <?php
    get_template_part('template-parts/menu-mobile');
    ?>