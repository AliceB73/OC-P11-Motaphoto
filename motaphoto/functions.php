<?php

//Chargement des scripts CSS et JavaScript

function motaphoto_enqueue_styles()
{
    wp_enqueue_style('style', get_stylesheet_uri(), array());
    wp_enqueue_script('js', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), false, true);
    wp_localize_script('js', 'load_more_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
    ));
    wp_enqueue_script('font-awesone-icons', 'https://kit.fontawesome.com/6e49e8fbfb.js');
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

add_theme_support('post-thumbnails');


//Requête Ajax pour le bouton load more


add_action('wp_ajax_load_more_function', 'load_more_function');
add_action('wp_ajax_nopriv_load_more_function', 'load_more_function');

function load_more_function()
{
    $offset = $_POST['offset']; // Obtenez l'offset des données envoyées à AJAX.
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'offset' => $offset, // Utilisez l'offset dans votre requête.
    );

    $more_posts = new WP_Query($args);

    if ($more_posts->have_posts()) {
        while ($more_posts->have_posts()) {
            $more_posts->the_post();
            $image = get_field('photo');
            if (!empty($image)) {
                echo '<img class="photo-catalogue" id="photo-catalogue-mobile" src="' . $image['url'] . '">';
            }
        }
    }

    wp_die(); // Cela est requis pour terminer immédiatement après avoir renvoyé une réponse.
}
