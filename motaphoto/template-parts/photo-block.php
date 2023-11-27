<?php

$image = $args['image'];
$category = $args['category'];
$title = $args['title'];
$permalink = $args['permalink'];
$reference = get_field('reference');
?>

<div class="photo-block">
    <img class="photo-catalogue" id="photo-catalogue-mobile" src="<?php echo wp_get_attachment_image_url($image['ID'], 'large') ?>">
    <div class="photo-overlay">
        <div class="photo-info">
            <p class="photo-category"><?php echo $category[0]->cat_name; ?></p>
            <p class="photo-title"><?php echo $title; ?></p>
            <a href="<?php echo $permalink; ?>" class="photo-link">
                <img class="overlay-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/eye.svg" alt="">
            </a>
            <a href="<?php echo $image['url']; ?>" class="photo-fullscreen" data-reference="<?php echo $reference; ?>" data-category="<?php echo $category[0]->cat_name; ?>">
                <img class="overlay-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/fullscreen-icon.svg" alt="">
            </a>
        </div>
    </div>
</div>