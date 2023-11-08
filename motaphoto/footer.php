<footer>
    <?php
    get_template_part('template-parts/contact');
    get_template_part('template-parts/lightbox');
    ?>
    <nav role="navigation" class="nav_footer" aria-label="<?php _e('Menu footer', 'motaphoto'); ?>">
        <?php
        wp_nav_menu([
            'theme_location' => 'footer-menu',
            'container' => false,
            'menu_class' => 'menu footer'
        ])
        ?>
        <p>Tous droits réservés</p>
    </nav>
</footer>
<?php wp_footer() ?>

</body>

</html>