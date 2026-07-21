<?php
/**
 * Template Name: Página Inicial
 * Description: Homepage com ACF fields e HTML semântico
 */

get_header(); ?>

<main class="front-page" role="main">
    
    <?php
        $sections = [
            'template-parts/hero-banner',
            'template-parts/section-differences',
            'template-parts/section-services',
            'template-parts/section-product-catalog',
            'template-parts/section-post-blog',
            'template-parts/section-differences-two',
            'template-parts/section-address',
        ];

        foreach ( $sections as $section ) {
            get_template_part( $section );
        }
    ?>

</main>

<?php get_footer(); ?>
