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
            echo 'background-image: url(' . $image['url'] . ');';
        }
    }
}

wp_reset_postdata();
?>
">

    <h1>Photographe Event</h1>
</section>

<section class="filters">
    <?php
    get_template_part("template-parts/filters");
    ?>
</section>

<section class="catalogue">
    <?php
    $args = array(
        'post_type' => 'photo',
        'post_per_page' => -1,
    );

    $first_twelve_photos = new WP_Query($args);

    if ($first_twelve_photos->have_posts()) {
        while ($first_twelve_photos->have_posts()) {
            $first_twelve_photos->the_post();
            $image = get_field('photo');
            if (!empty($image)) {
    ?> <img class="photo-catalogue" id="photo-catalogue-mobile" src="<?php echo $image['url'] ?>">
    <?php
            }
        }
    }
    ?>

    <a href="" class="grey-button">Charger plus</a>
</section>

<?php get_footer(); ?>