<?php
/**
 * Template Name: Página Inicial
 * Description: Homepage com ACF fields e HTML semântico
 */

get_header(); ?>

<main class="front-page" role="main">
    
    <?php 
    // Hero Banner
    get_template_part('template-parts/hero-banner'); 
    ?>

    <?php 
    // Diferenciais Cards
    get_template_part('template-parts/section-differences'); 
    ?>

    <?php 
    // Serviços
    get_template_part('template-parts/section-services'); 
    ?>

    <?php 
    // Catálogo de Produtos
    get_template_part('template-parts/section-product-catalog'); 
    ?>

    <?php 
    // Blog Posts
    get_template_part('template-parts/section-post-blog'); 
    ?>

    <?php 
    // Diferenciais Two
    get_template_part('template-parts/section-differences-two'); 
    ?>

    <?php 
    // Endereço e Contato
    get_template_part('template-parts/section-address'); 
    ?>

    <?php 
    // WhatsApp Button
    get_template_part('template-parts/button-whatsapp'); 
    ?>

</main>

<?php get_footer(); ?>
