<?php
/**
 * Theme Customizer - Opções do Tema
 * 
 * Cria página de opções do tema via ACF Options Page
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Habilitar upload de SVG (logo do tema)
 *
 * O WordPress bloqueia SVG por padrão (mime type não permitido) e, mesmo quando
 * permitido, o wp_check_filetype_and_ext() ainda rejeita o arquivo porque o
 * detector de mime real não reconhece XML como image/svg+xml — daí o erro
 * "Este arquivo não pode ser processado pelo servidor web". As duas funções
 * abaixo resolvem isso. Restrito a quem pode gerenciar o site (administradores),
 * já que SVG pode conter <script> e é um vetor de XSS se qualquer usuário puder subir.
 */
function sigma_edge_enable_svg_upload($mimes) {
    if (current_user_can('manage_options')) {
        $mimes['svg'] = 'image/svg+xml';
    }

    return $mimes;
}
add_filter('upload_mimes', 'sigma_edge_enable_svg_upload');

function sigma_edge_fix_svg_mime_type($data, $file, $filename, $mimes) {
    if (!$data['type']) {
        $filetype = wp_check_filetype($filename, $mimes);

        if ($filetype['ext'] === 'svg') {
            $data['ext']             = 'svg';
            $data['type']            = 'image/svg+xml';
            $data['proper_filename'] = $filename;
        }
    }

    return $data;
}
add_filter('wp_check_filetype_and_ext', 'sigma_edge_fix_svg_mime_type', 10, 4);

/**
 * Exibir o SVG corretamente na grade da Biblioteca de Mídia
 * (sem isso, o WordPress não sabe gerar miniatura e mostra um ícone quebrado)
 */
function sigma_edge_svg_media_grid_style() {
    echo '<style>
        .attachment-266x266.type-image img[src$=".svg"],
        .media-icon img[src$=".svg"] {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
}
add_action('admin_head', 'sigma_edge_svg_media_grid_style');

/**
 * Register ACF Options Pages
 */
function sigma_edge_register_options_pages() {
    if (function_exists('acf_add_options_page')) {
        
        // Main Options Page
        acf_add_options_page([
            'page_title'    => __('Opções do Tema', 'wpsigmaedge'),
            'menu_title'    => __('Opções do Tema', 'wpsigmaedge'),
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
            'icon_url'      => 'dashicons-admin-settings',
            'position'      => 2,
            'redirect'      => false
        ]);

        // Footer Settings Sub-page
        acf_add_options_sub_page([
            'page_title'    => __('Configurações do Footer', 'wpsigmaedge'),
            'menu_title'    => __('Footer', 'wpsigmaedge'),
            'parent_slug'   => 'theme-general-settings',
        ]);

        // Contact Settings Sub-page
        acf_add_options_sub_page([
            'page_title'    => __('Configurações de Contato', 'wpsigmaedge'),
            'menu_title'    => __('Contato', 'wpsigmaedge'),
            'parent_slug'   => 'theme-general-settings',
        ]);

        // Social Media Settings Sub-page
        acf_add_options_sub_page([
            'page_title'    => __('Redes Sociais', 'wpsigmaedge'),
            'menu_title'    => __('Redes Sociais', 'wpsigmaedge'),
            'parent_slug'   => 'theme-general-settings',
        ]);
    }
}
add_action('acf/init', 'sigma_edge_register_options_pages');

/**
 * Register Navigation Menus
 */
function sigma_edge_register_nav_menus() {
    register_nav_menus([
        'primary'       => __('Menu Principal', 'wpsigmaedge'),
        'footer-menu-1' => __('Footer - Menu 1', 'wpsigmaedge'),
        'footer-menu-2' => __('Footer - Menu 2', 'wpsigmaedge'),
        'footer-legal'  => __('Footer - Menu Legal', 'wpsigmaedge'),
    ]);
}
add_action('after_setup_theme', 'sigma_edge_register_nav_menus');

/**
 * Add Theme Support
 */
function sigma_edge_theme_support() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Logo customizável (Aparência > Personalizar > Identidade do site)
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // Set post thumbnail size
    set_post_thumbnail_size(1200, 675, true);

    // Add custom image sizes
    add_image_size('hero-banner', 1920, 1080, true);
    add_image_size('product-card', 600, 450, true);
    add_image_size('service-card', 800, 600, true);
    add_image_size('blog-card', 800, 450, true);

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for editor styles
    add_theme_support('editor-styles');
}
add_action('after_setup_theme', 'sigma_edge_theme_support');

/**
 * Enqueue Styles and Scripts
 */
function sigma_edge_enqueue_assets() {
    $theme_version = wp_get_theme()->get('Version');

    // Google Fonts - Hanken Grotesk
    wp_enqueue_style(
        'sigma-edge-fonts',
        'https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&display=swap',
        [],
        null
    );

    // Main Stylesheet
    wp_enqueue_style(
        'sigma-edge-style',
        get_stylesheet_uri(),
        [],
        $theme_version
    );

    // Component Styles
    $components = [
        'header',
        'footer',
        'hero-banner',
        'breadcrumb',
        'button-whatsapp',
        'searchform',
        'sidebar',
        'section-services',
        'section-product-catalog',
        'section-differences',
        'section-post-blog',
        'section-differences-two',
        'section-address',
    ];

    foreach ($components as $component) {
        wp_enqueue_style(
            "sigma-edge-{$component}",
            get_template_directory_uri() . "/assets/css/components/{$component}.css",
            [],
            $theme_version
        );
    }

    // Page Styles
    if (is_front_page()) {
        wp_enqueue_style(
            'sigma-edge-front-page',
            get_template_directory_uri() . '/assets/css/pages/front-page.css',
            [],
            $theme_version
        );
    } elseif (is_page()) {
        wp_enqueue_style(
            'sigma-edge-page',
            get_template_directory_uri() . '/assets/css/pages/page.css',
            [],
            $theme_version
        );
    } elseif (is_single()) {
        wp_enqueue_style(
            'sigma-edge-single',
            get_template_directory_uri() . '/assets/css/pages/single.css',
            [],
            $theme_version
        );
    } elseif (is_search() || is_archive()) {
        wp_enqueue_style(
            'sigma-edge-index',
            get_template_directory_uri() . '/assets/css/pages/index.css',
            [],
            $theme_version
        );
    }

    // Main JavaScript
    wp_enqueue_script(
        'sigma-edge-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $theme_version,
        true
    );

    // Localize script for AJAX
    wp_localize_script('sigma-edge-main', 'sigmaEdgeAjax', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('sigma_edge_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'sigma_edge_enqueue_assets');

/**
 * Handle Newsletter Form Submission
 */
function sigma_edge_handle_newsletter_submit() {
    // Verify nonce
    if (!isset($_POST['newsletter_nonce']) || !wp_verify_nonce($_POST['newsletter_nonce'], 'newsletter_subscribe')) {
        wp_die(__('Erro de segurança. Por favor, tente novamente.', 'wpsigmaedge'));
    }

    // Sanitize email
    $email = sanitize_email($_POST['newsletter_email'] ?? '');

    if (!is_email($email)) {
        wp_redirect(add_query_arg('newsletter', 'error', wp_get_referer()));
        exit;
    }

    // Here you can add your newsletter service integration
    // Example: save to database, send to Mailchimp, etc.
    
    // For now, just redirect with success
    wp_redirect(add_query_arg('newsletter', 'success', wp_get_referer()));
    exit;
}
add_action('admin_post_nopriv_newsletter_subscribe', 'sigma_edge_handle_newsletter_submit');
add_action('admin_post_newsletter_subscribe', 'sigma_edge_handle_newsletter_submit');

/**
 * Handle Contact Form Submission
 */
function sigma_edge_handle_contact_submit() {
    // Verify nonce
    if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form')) {
        wp_die(__('Erro de segurança. Por favor, tente novamente.', 'wpsigmaedge'));
    }

    // Sanitize inputs
    $name    = sanitize_text_field($_POST['contact_name'] ?? '');
    $subject_field = sanitize_text_field($_POST['contact_subject'] ?? '');
    $phone   = sanitize_text_field($_POST['contact_phone'] ?? '');
    $message = sanitize_textarea_field($_POST['contact_message'] ?? '');

    if (empty($name) || empty($phone) || empty($message)) {
        wp_redirect(add_query_arg('contact', 'error', wp_get_referer()));
        exit;
    }

    // Send email to admin
    $to      = get_option('admin_email');
    $subject = sprintf(__('[%s] Nova mensagem de contato', 'wpsigmaedge'), get_bloginfo('name'));
    $body    = sprintf(
        __("Nome: %s\nAssunto: %s\nTelefone: %s\n\nMensagem:\n%s", 'wpsigmaedge'),
        $name,
        $subject_field ?: '-',
        $phone,
        $message
    );
    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    wp_mail($to, $subject, $body, $headers);

    wp_redirect(add_query_arg('contact', 'success', wp_get_referer()));
    exit;
}
add_action('admin_post_nopriv_contact_form_submit', 'sigma_edge_handle_contact_submit');
add_action('admin_post_contact_form_submit', 'sigma_edge_handle_contact_submit');
