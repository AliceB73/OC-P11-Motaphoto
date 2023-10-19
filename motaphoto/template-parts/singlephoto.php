<div class="post-single-photo">
    <h2><?php the_title(); ?></h2>
    <p>Référence : <?php echo $reference; ?></p>
    <p>Catégorie : <?php echo $term_name; ?></p>
    <p>Format : <?php echo $format; ?></p>
    <p>Type : <?php echo $type; ?></p>
    <p>Année : <?php echo $year; ?></p>

    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /> <!-- Afficher l'image -->

</div>