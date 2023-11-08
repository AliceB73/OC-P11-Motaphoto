<?php
/*$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 2,
    'category_name' => $term_name,
    'post__not_in' => array(get_the_ID()),
);
$related_posts = new WP_Query($args);
if ($related_posts->have_posts()) :
    while ($related_posts->have_posts()) : $related_posts->the_post();
        $related_image = get_field('photo');
        if (!empty($related_image)) : ?>
            <img src="<?php echo $related_image['url']; ?>" alt="<?php echo $related_image['alt']; ?>">
<?php endif;
    endwhile;
endif;*/

$image = $args['image'];
$category = $args['category'];
$reference = $args['reference'];
$permalink = $args['permalink'];
?>

<div class="photo-block">
    <img class="photo-catalogue" id="photo-catalogue-mobile" src="<?php echo $image['url'] ?>">
    <div class="photo-overlay">
        <div class="photo-info">
            <p class="photo-category"><?php echo $category[0]->cat_name; ?></p>
            <p class="photo-reference"><?php echo $reference; ?></p>
            <a href="<?php echo $permalink; ?>" class="photo-link">
                <i class="fa-regular fa-eye"></i>
            </a>
            <a href="<?php echo $image['url']; ?>" class="photo-fullscreen">
                <i class="fas fa-expand"></i>
            </a>
        </div>
    </div>
</div>