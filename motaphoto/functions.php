<?php

function motaphoto_enqueue_styles()
{
    wp_enqueue_style('style', get_stylesheet_uri(), array());
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');
