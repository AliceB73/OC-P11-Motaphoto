<?php

//Chargement des scripts CSS et JavaScript

function motaphoto_enqueue_styles()
{
    wp_enqueue_style('style', get_stylesheet_uri(), array());
    wp_enqueue_script('js', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');

//Ajout des menus pour le header et le footer

function motaphoto_register_menu()
{
    register_nav_menu('header-menu', __('Menu header', 'motaphoto'));
    register_nav_menu('footer-menu', __('Menu footer', 'motaphoto'));
}
add_action('after_setup_theme', 'motaphoto_register_menu');

//Remplir dynamiquement le champ réf.photo

function ajouter_ref_photo()
{
    if (is_singular('photo')) {
        global $post;
        $ref_photo = get_post_meta($post->ID, 'reference', true);

        echo '<script type="text/javascript">';
        echo 'let refPhoto = "' . $ref_photo . '";';
        echo '</script>';
    }
}
add_action('wp_footer', 'ajouter_ref_photo');

/*function test_image()
{
    if (is_singular('photo')) {
        global $post;
        $prev_post = get_previous_post();
        $next_post = get_next_post();

        $prev_photo_field = $prev_post ? get_field('photo', $prev_post->ID) : null;
        $next_photo_field = $next_post ? get_field('photo', $next_post->ID) : null;

        $prev_thumbnail_url = is_array($prev_photo_field) ? $prev_photo_field['url'] : '';
        $next_thumbnail_url = is_array($next_photo_field) ? $next_photo_field['url'] : '';

        echo '<script type="text/javascript">';
        echo 'let prev_photo_field = "' . $prev_photo_field . '";';
        echo 'let next_photo_field = "' . $next_photo_field . '";';
        echo '</script>';
    }
}
add_action('wp_footer', 'test_image'); */
