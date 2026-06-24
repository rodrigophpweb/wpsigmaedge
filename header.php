<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php open_body(); ?>
    
    <header>
        <nav>
            <figure>
                <!-- Inserir o logotipo via customizer -->
            </figure>

            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            <?php get_search_form();?>
            <a href="">Solicite um orçamento</a>
        </nav>
    </header>