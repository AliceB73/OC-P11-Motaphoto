<?php
$args = array(
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
endif;
