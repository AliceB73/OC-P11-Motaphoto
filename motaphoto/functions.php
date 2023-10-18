<?php

//Chargement des scripts CSS et JavaScript

function motaphoto_enqueue_styles()
{
    wp_enqueue_style('style', get_stylesheet_uri(), array());
    wp_enqueue_script('js', get_stylesheet_directory_uri() . '/js/scripts.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');

//Ajout des menus pour le header et le footer

function motaphoto_register_menu()
{
    register_nav_menu('header-menu', __('Menu header', 'motaphoto'));
    register_nav_menu('footer-menu', __('Menu footer', 'motaphoto'));
}
add_action('after_setup_theme', 'motaphoto_register_menu');
