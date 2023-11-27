<?php get_header(); ?>

<section class="hero-header" style="width: 100%;
<?php
$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'orderby' => 'rand'
);

$random_hero_header = new WP_Query($args);

if ($random_hero_header->have_posts()) {
    while ($random_hero_header->have_posts()) {
        $random_hero_header->the_post();
        $image = get_field('photo');
        if (!empty($image)) {
            echo 'background-image: url(' . wp_get_attachment_image_url($image['ID'], 'full') . ');';
        }
    }
}

wp_reset_postdata();
?>
">

    <h1>Photographe Event</h1>
</section>

<?php
get_template_part("template-parts/filters");
?>

<section class="catalogue">
    <?php
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
    );

    $first_twelve_photos = new WP_Query($args);

    if ($first_twelve_photos->have_posts()) {
        while ($first_twelve_photos->have_posts()) {
            $first_twelve_photos->the_post();
            $image = get_field('photo');
            $category = get_the_category();
            $title = get_the_title();
            $permalink = get_permalink();
            if (!empty($image)) {
                get_template_part('template-parts/photo-block', null, array(
                    'image' => $image,
                    'category' => $category,
                    'title' => $title,
                    'permalink' => $permalink
                ));
            }
        }
    }
    ?>
</section>
<div class="loadmore-btn">
    <button class="grey-button" id="load-more">Charger plus</button>
</div>

<?php get_footer(); ?>