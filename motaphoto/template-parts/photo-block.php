<?php

$image = $args['image'];
$category = $args['category'];
$title = $args['title'];
$permalink = $args['permalink'];
?>

<div class="photo-block">
    <img class="photo-catalogue" id="photo-catalogue-mobile" src="<?php echo $image['url'] ?>">
    <div class="photo-overlay">
        <div class="photo-info">
            <p class="photo-category"><?php echo $category[0]->cat_name; ?></p>
            <p class="photo-title"><?php echo $title; ?></p>
            <a href="<?php echo $permalink; ?>" class="photo-link">
                <img class="eye-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/eye.svg" alt="">
            </a>
            <a href="<?php echo $image['url']; ?>" class="photo-fullscreen">
                <img class="eye-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/fullscreen-icon.svg" alt="">
            </a>
        </div>
    </div>
</div>