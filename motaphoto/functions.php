<?php

add_theme_support('post-thumbnails');

//Chargement des scripts (CSS, JS, Ajax, icônes)

function motaphoto_enqueue_styles()
{
    wp_enqueue_style('style', get_stylesheet_uri(), array());
    wp_enqueue_style('swiper-style', 'https://unpkg.com/swiper/swiper-bundle.min.css');

    wp_enqueue_script('font-awesone-icons', 'https://kit.fontawesome.com/6e49e8fbfb.js');
    wp_enqueue_script('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), false, true);
    wp_enqueue_script('js', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery', 'swiper'), false, true);
    wp_localize_script('js', 'load_more_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
    ));
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
    global $post;
    $ref_photo = '';

    if (is_singular('photo')) {
        $ref_photo = get_post_meta($post->ID, 'reference', true);
    }

    echo '<script type="text/javascript">';
    echo 'let refPhoto = "' . $ref_photo . '";';
    echo '</script>';
}

add_action('wp_footer', 'ajouter_ref_photo');


//Requête ajax pour les filtres

add_action('wp_ajax_filter_posts_function', 'filter_posts_function');
add_action('wp_ajax_nopriv_filter_posts_function', 'filter_posts_function');

function filter_posts_function()
{
    $filters = $_POST['filters']; // On obtient les filtres des données envoyées à AJAX

    error_log(print_r($filters, true)); // Affiche les filtres reçus

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
    );

    if (isset($filters['Catégorie'])) {
        $args['category_name'] = $filters['Catégorie'];
    }

    if (isset($filters['Formats'])) {
        $args['meta_key'] = 'format';
        $args['meta_value'] = $filters['Formats'];
    }

    if (isset($filters['Trier par'])) {
        if ($filters['Trier par'] == 'Des plus récentes aux plus anciennes') {
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
        } elseif ($filters['Trier par'] == 'Des plus anciennes aux plus récentes') {
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
        }
    }

    $filtered_posts = new WP_Query($args);

    if ($filtered_posts->have_posts()) {
        while ($filtered_posts->have_posts()) {
            $filtered_posts->the_post();
            $image = get_field('photo');
            $category = get_the_category();
            $title = get_the_title();
            $permalink = get_permalink();
            if (!empty($image)) {
                ob_start(); // Commence la capture de la sortie
                get_template_part('template-parts/photo-block', null, array(
                    'image' => $image,
                    'category' => $category,
                    'title' => $title,
                    'permalink' => $permalink
                ));
                $output = ob_get_clean(); // Récupère la sortie et arrête la capture
                echo $output;
            }
        }
    } else {
        echo '<div class="errormsg-div"><p class="error-msg">Aucun post n\'a été trouvé.</p></div>';
    }

    wp_die(); // On met fin à l'exécution de la fonction
}


//Requête Ajax pour le bouton load more


add_action('wp_ajax_load_more_function', 'load_more_function');
add_action('wp_ajax_nopriv_load_more_function', 'load_more_function');


function load_more_function()
{
    $filters = $_POST['filters']; // On obtient les filtres des données envoyées à AJAX
    $offset = $_POST['offset']; // On obtient l'offset des données envoyées à AJAX

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'offset' => $offset, // Ajoutez l'offset à vos arguments de requête
    );

    if (isset($filters['Catégorie'])) {
        $args['category_name'] = $filters['Catégorie'];
    }

    if (isset($filters['Formats'])) {
        $args['meta_key'] = 'format';
        $args['meta_value'] = $filters['Formats'];
    }

    if (isset($filters['Trier par'])) {
        if ($filters['Trier par'] == 'Des plus récentes aux plus anciennes') {
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
        } elseif ($filters['Trier par'] == 'Des plus anciennes aux plus récentes') {
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
        }
    }

    $more_posts = new WP_Query($args);

    if ($more_posts->have_posts()) {
        while ($more_posts->have_posts()) {
            $more_posts->the_post();
            $image = get_field('photo');
            $category = get_the_category();
            $title = get_the_title();
            $permalink = get_permalink();
            if (!empty($image)) {
                ob_start(); // Commence la capture de la sortie
                get_template_part('template-parts/photo-block', null, array(
                    'image' => $image,
                    'category' => $category,
                    'title' => $title,
                    'permalink' => $permalink
                ));
                $output = ob_get_clean(); // Récupère la sortie et arrête la capture
                echo $output;
            }
        }
    } else {
        echo '<div class="errormsg-div"><p class="error-msg">Aucun post n\'a été trouvé.</p></div>';
    }

    wp_die(); // On termine l'exécution de la fonction
}
