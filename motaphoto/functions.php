<?php

//Chargement des scripts (CSS, JS, Ajax, icônes)

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


//Requête ajax pour les filtres

add_action('wp_ajax_filter_posts_function', 'filter_posts_function');
add_action('wp_ajax_nopriv_filter_posts_function', 'filter_posts_function');

function filter_posts_function()
{
    $filter = $_POST['filter']; // On obtient le filtre des données envoyées à AJAX


    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1,
    );

    $format_filter = new WP_Query($args);
    $present_formats = array();

    if ($format_filter->have_posts()) {
        while ($format_filter->have_posts()) {
            $format_filter->the_post();
            $format = get_field('format');

            if (!in_array($format, $present_formats)) {
                $present_formats[] = $format;
            }
        }
    }

    // On récupère toutes les catégories
    $categories = get_terms(array(
        'taxonomy' => 'category',
        'hide_empty' => false,
    ));

    //On crée un tableau pour stocker les noms des catégories
    $category_names = array();
    if (!empty($categories) && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            if ($category->slug != 'non-classe') {
                $category_names[] = $category->name;
            }
        }
    }

    // Selon le filtre sélectionné, on ajuste nos arguments
    if ($filter == 'Des plus récentes aux plus anciennes') {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => 'DESC',
        );
    } elseif ($filter == 'Des plus anciennes aux plus récentes') {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => 'ASC',
        );
    } elseif (in_array($filter, $category_names)) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'category_name' => $filter,
        );
    } elseif (in_array($filter, $present_formats)) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'meta_key' => 'format',
            'meta_value' => $filter,
        );
    }

    $filtered_posts = new WP_Query($args);

    if ($filtered_posts->have_posts()) {
        while ($filtered_posts->have_posts()) {
            $filtered_posts->the_post();
            $image = get_field('photo');
            if (!empty($image)) {
                echo '<img class="photo-catalogue" id="photo-catalogue-mobile" src="' . $image['url'] . '">';
            }
        }
    }

    wp_die(); // On met fin à l'exécution de la fonction
}


//Requête Ajax pour le bouton load more


add_action('wp_ajax_load_more_function', 'load_more_function');
add_action('wp_ajax_nopriv_load_more_function', 'load_more_function');

function load_more_function()
{
    $offset = $_POST['offset'];
    $filter = $_POST['filter'];

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1,
    );

    $format_filter = new WP_Query($args);
    $present_formats = array();

    if ($format_filter->have_posts()) {
        while ($format_filter->have_posts()) {
            $format_filter->the_post();
            $format = get_field('format');

            if (!in_array($format, $present_formats)) {
                $present_formats[] = $format;
            }
        }
    }

    $categories = get_terms(array(
        'taxonomy' => 'category',
        'hide_empty' => false,
    ));

    $category_names = array();
    if (!empty($categories) && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            if ($category->slug != 'non-classe') {
                $category_names[] = $category->name;
            }
        }
    }

    // Arguments par défaut, si aucun filtre n'est sélectionné
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'offset' => $offset,
    );

    if ($filter == 'Des plus récentes aux plus anciennes') {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => 'DESC',
            'offset' => $offset,
        );
    } elseif ($filter == 'Des plus anciennes aux plus récentes') {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => 'ASC',
            'offset' => $offset,
        );
    } elseif (in_array($filter, $category_names)) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'category_name' => $filter,
            'offset' => $offset,
        );
    } elseif (in_array($filter, $present_formats)) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'meta_key' => 'format',
            'meta_value' => $filter,
            'offset' => $offset,
        );
    } else {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'offset' => $offset,
        );
    }

    $more_posts = new WP_Query($args);

    if ($more_posts->have_posts()) {
        while ($more_posts->have_posts()) {
            $more_posts->the_post();
            $image = get_field('photo');
            if (!empty($image)) {
                echo '<img class="photo-catalogue" id="photo-catalogue-mobile" src="' . $image['url'] . '">';
            }
        }
    } else {
        echo '<div><p class="error-msg">Aucun post n\'a été trouvé</p></div>';
    }

    wp_die(); // On termine l'exécution de la fonction
}
