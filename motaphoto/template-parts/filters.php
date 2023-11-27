<section class="filters scrollable">
    <div class="left-align">
        <div class="dropdown">
            <button class="dropbtn">Catégorie <i class="fa-solid fa-chevron-down"></i></button>
            <div class="dropdown-content">
                <button class="blank"></button>
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                ));

                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $category) {
                        if ($category->slug != 'non-classe') {
                            echo '<button>' . $category->name . '</button>';
                        }
                    }
                }
                ?>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Formats <i class="fa-solid fa-chevron-down"></i></button>
            <div class="dropdown-content">
                <button class="blank"></button>
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
                            echo '<button>' . $format . '</button>';
                            $present_formats[] = $format;
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="right-align">
        <div class="dropdown swiper-slide">
            <button class="dropbtn">Trier par <i class="fa-solid fa-chevron-down"></i></button>
            <div class="dropdown-content">
                <button>Des plus récentes aux plus anciennes</button>
                <button>Des plus anciennes aux plus récentes</button>
            </div>
        </div>
    </div>
</section>