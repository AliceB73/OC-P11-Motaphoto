<?php
get_header(); // Inclure l'en-tête

if (have_posts()) : // Vérifier s'il y a des posts
    while (have_posts()) : the_post(); // Boucle à travers les posts
        $image = get_field('photo'); // Récupérer le champ personnalisé 'image'
        $format = get_field('format');
        $type = get_field('type');
        $reference = get_field('reference');
        $terms = get_the_terms(get_the_ID(), 'category'); // Récupérer les termes de la taxonomie 'category'
        $term_name = $terms[0]->name; // Récupérer le nom du premier terme
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

                <img id="main-photo" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
            </div>
            <div class="cta-and-pagination">
                <div class="single-photo-cta">
                    <p>Cette photo vous intéresse ?</p>
                    <button>Contact</button>
                </div>
                <div class="single-photo-pagination">
                    <?php
                    the_post_navigation(
                        array(
                            'next_text' => '<p class="meta-nav">' . $motaphoto_next_label . $motaphoto_next . '</p><p class="post-title"><img src="' . get_template_directory_uri() . '/assets/images/line-7.svg" alt="Photo suivante"></p>',
                            'prev_text' => '<p class="meta-nav">' . $motaphoto_prev . $motaphoto_previous_label . '</p><p class="post-title"><img src="' . get_template_directory_uri() . '/assets/images/line-6.svg" alt="Photo précédente"></p>',
                        )
                    ); ?>
                </div>
            </div>
        </div>
<?php


    endwhile;
else :
    echo '<p>Aucun post trouvé</p>'; // Message si aucun post n'est trouvé
endif;

get_footer(); // Inclure le pied de page
?>