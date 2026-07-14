<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header" role="banner">
        <nav class="site-header__nav" role="navigation" aria-label="Menu principal">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__logo">
                    <svg class="site-header__logo-mark" width="44" height="44" viewBox="0 0 44 44" fill="none" aria-hidden="true">
                        <circle cx="21" cy="22" r="18.5" stroke="currentColor" stroke-width="2.5"/>
                        <path d="M16 13L25 22L16 31" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M22 13L31 22L22 31" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.4"/>
                        <path d="M35 10L40 5M40 5H35.5M40 5V9.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="site-header__logo-text">
                        <span class="site-header__logo-wordmark">
                            <span class="site-header__logo-sigma">SIGMA</span>
                            <span class="site-header__logo-edge">EDGE</span>
                        </span>
                        <span class="site-header__logo-tagline">Calibração de Instrumentos</span>
                    </span>
                </a>
            <?php endif; ?>

            <div class="site-header__actions">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'site-header__menu',
                    'fallback_cb' => '__return_false'
                ]);
                ?>

                <div class="site-header__search-inline">
                    <?php get_search_form(); ?>
                </div>

                <button class="site-header__search-toggle" type="button" aria-label="Abrir busca">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"/>
                    </svg>
                </button>

                <a href="#contato" class="site-header__cta">
                    Solicite um orçamento
                </a>

                <div class="site-header__lang">
                    <button class="site-header__lang-toggle" type="button" aria-haspopup="true" aria-expanded="false" aria-label="Selecionar idioma">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/>
                            <path d="M3 12h18M12 3c2.5 2.5 3.8 5.5 3.8 9s-1.3 6.5-3.8 9c-2.5-2.5-3.8-5.5-3.8-9S9.5 5.5 12 3Z" stroke="currentColor" stroke-width="1.6"/>
                        </svg>
                    </button>
                    <ul class="site-header__lang-menu" hidden>
                        <li><button type="button" lang="pt-BR" aria-current="true">Português</button></li>
                        <li><button type="button" lang="en">English</button></li>
                    </ul>
                </div>

                <button class="site-header__toggle" type="button" aria-label="Abrir menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <aside class="site-header__search-overlay" aria-hidden="true">
                <?php get_search_form(); ?>
                <button class="site-header__search-close" type="button" aria-label="Fechar busca">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" fill="currentColor"/>
                    </svg>
                </button>
            </aside>
        </nav>

        <p class="site-header__ticker">novidades da Sigma Edge</p>
    </header>
