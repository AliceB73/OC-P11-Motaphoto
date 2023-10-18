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
        <img class="logo" alt="Nathalie Mota" src="<?php echo get_template_directory_uri() . '/assets/images/logo.png'; ?>">
        <?php
        wp_nav_menu([
            'theme_location' => 'header-menu',
            'container' => false,
            'menu_class' => 'menu header',
            'menu_id' => 'nav_menu'
        ])
        ?>
    </nav>