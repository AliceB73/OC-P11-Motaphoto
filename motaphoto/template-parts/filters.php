<div class="left-align">
    <div class="dropdown">
        <button class="dropbtn">Catégorie <i class="fa-solid fa-chevron-down"></i></button>
        <div class="dropdown-content">
            <a href="#"></a>
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'category',
                'hide_empty' => false,
            ));

            if (!empty($categories) && !is_wp_error($categories)) {
                foreach ($categories as $category) {
                    if ($category->slug != 'non-classe') {
                        echo '<a href="#">' . $category->name . '</a>';
                    }
                }
            }
            ?>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn">Formats <i class="fa-solid fa-chevron-down"></i></button>
        <div class="dropdown-content">
            <a href="#"></a>
            <?php
            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => -1,
            );

            $format_filter = new WP_Query($args);
            $present_formats = array();

            if ($format_filter->have_posts()) {
                while ($format_filter->have_posts()) {
                    $format_filter->the_post();
                    $format = get_field('format');

                    if (!in_array($format, $present_formats)) {
                        echo '<a href="#">' . $format . '</a>';
                        $present_formats[] = $format;
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<div class="right-align">
    <div class="dropdown">
        <button class="dropbtn">Trier par <i class="fa-solid fa-chevron-down"></i></button>
        <div class="dropdown-content">
            <a href="#">Des plus récentes aux plus anciennes</a>
            <a href="#">Des plus anciennes aux plus récentes</a>
        </div>
    </div>
</div>