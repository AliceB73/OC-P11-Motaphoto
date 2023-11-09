<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $image = get_field('photo');
        $format = get_field('format');
        $type = get_field('type');
        $reference = get_field('reference');
        $terms = get_the_terms(get_the_ID(), 'category');
        $term_name = $terms[0]->name;
        $year = get_the_date('Y');
?>
        <div id="single-photo-bloc" class="post-single-photo">
            <div class="info-and-photo">
                <div class="info-content">
                    <h2><?php the_title(); ?></h2>
                    <p>Référence : <?php echo $reference; ?></p>
                    <p>Catégorie : <?php echo $term_name; ?></p>
                    <p>Format : <?php echo $format; ?></p>
                    <p>Type : <?php echo $type; ?></p>
                    <p>Année : <?php echo $year; ?></p>
                </div>
                <div class="main-photo-bloc">
                    <img id="main-photo" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                </div>
            </div>
            <div class="cta-and-pagination">
                <div class="single-photo-cta">
                    <p>Cette photo vous intéresse ?</p>
                    <button id="cta-single-photo" class="grey-button">Contact</button>
                </div>
                <div class="single-photo-pagination">
                    <div id="preview">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();

                        $prev_photo_field = $prev_post ? get_field('photo', $prev_post->ID) : null;
                        $next_photo_field = $next_post ? get_field('photo', $next_post->ID) : null;

                        $prev_thumbnail_url = is_array($prev_photo_field) ? $prev_photo_field['url'] : '';
                        $next_thumbnail_url = is_array($next_photo_field) ? $next_photo_field['url'] : '';

                        ?>

                    </div>

                    <?php
                    the_post_navigation(
                        array(
                            'next_text' => '<p class="meta-nav" data-thumbnail="' . $next_thumbnail_url . '">' . $motaphoto_next_label . $motaphoto_next . '</p><p class="post-title"><img src="' . get_template_directory_uri() . '/assets/images/right-arrow.svg" alt="Photo suivante"></p>',
                            'prev_text' => '<p class="meta-nav" data-thumbnail="' . $prev_thumbnail_url . '">' . $motaphoto_prev . $motaphoto_previous_label . '</p><p class="post-title"><img src="' . get_template_directory_uri() . '/assets/images/left-arrow.svg" alt="Photo précédente"></p>',
                        )
                    ); ?>
                </div>
            </div>
        </div>
        <div class="related-photos">
            <?php
            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 2,
                'category_name' => $term_name,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand',
            );
            $related_posts = new WP_Query($args);
            if ($related_posts->have_posts()) :
                echo '<h3>Vous aimerez aussi</h3>'; // Déplacez le titre ici
            endif;
            ?>
            <div class="two-photos">
                <?php
                if ($related_posts->have_posts()) :
                    while ($related_posts->have_posts()) : $related_posts->the_post();
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
                    endwhile;
                endif;

                wp_reset_postdata();
                ?>
            </div>
            <a href="<?php echo get_home_url() ?>" class="grey-button" id="see-all-btn">Toutes les photos</a>
        </div>
<?php


    endwhile;
else :
    echo '<p>Aucun post trouvé</p>';
endif;

get_footer();
?>