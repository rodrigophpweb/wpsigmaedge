<?php
/**
 * Sigma Edge Theme Functions
 * Industrial Precision Design System
 */

// ============================================
// INCLUDE CUSTOM FILES
// ============================================

// Custom Post Types
require_once get_template_directory() . '/inc/custom-post-type.php';

// Customizer
require_once get_template_directory() . '/inc/customize.php';

// Meta Boxes
require_once get_template_directory() . '/inc/meta-boxes.php';

// Font Awesome Icons (picker do admin)
require_once get_template_directory() . '/inc/fa-icons.php';

// Template Data Helpers (arquitetura limpa: ACF/WP_Query fora dos template-parts)
require_once get_template_directory() . '/inc/template-data.php';

// ============================================
// CUSTOM SEARCH FORM
// ============================================

function sigma_edge_search_form($form) {
    $form = '
    <form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">
        <div class="search-form__wrapper">
            <input type="search" 
                   class="search-form__input" 
                   placeholder="Como podemos te ajudar?"
                   value="' . get_search_query() . '" 
                   name="s" 
                   required />
            <button type="submit" class="search-form__submit">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"/>
                </svg>
                <span class="screen-reader-text">Buscar</span>
            </button>
        </div>
    </form>';
    
    return $form;
}
add_filter('get_search_form', 'sigma_edge_search_form');

// ============================================
// EXCERPT LENGTH & MORE
// ============================================

function sigma_edge_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'sigma_edge_excerpt_length');

function sigma_edge_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'sigma_edge_excerpt_more');

// ============================================
// PAGINATION
// ============================================

function sigma_edge_pagination() {
    global $wp_query;

    if ($wp_query->max_num_pages <= 1) return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max   = intval($wp_query->max_num_pages);

    if ($paged >= 1) $links[] = $paged;
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="pagination">';

    if (get_previous_posts_link())
        printf('<div class="pagination__prev">%s</div>', get_previous_posts_link('« Anterior'));

    echo '<ul class="pagination__list">';

    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>', $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links)) echo '<li>…</li>';
    }

    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>', $class, esc_url(get_pagenum_link($link)), $link);
    }

    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links)) echo '<li>…</li>';
        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>', $class, esc_url(get_pagenum_link($max)), $max);
    }

    echo '</ul>';

    if (get_next_posts_link())
        printf('<div class="pagination__next">%s</div>', get_next_posts_link('Próximo »'));

    echo '</nav>';
}

// ============================================
// BREADCRUMBS
// ============================================

function sigma_edge_breadcrumbs() {
    if (is_front_page()) return;

    echo '<nav class="breadcrumb">';
    echo '<a href="' . home_url('/') . '">Início</a>';

    if (is_category() || is_single()) {
        echo '<span class="breadcrumb__separator">›</span>';
        the_category(', ');
        if (is_single()) {
            echo '<span class="breadcrumb__separator">›</span>';
            the_title();
        }
    } elseif (is_page()) {
        if ($post->post_parent) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo '<span class="breadcrumb__separator">›</span>' . $crumb;
            }
        }
        echo '<span class="breadcrumb__separator">›</span>';
        the_title();
    } elseif (is_search()) {
        echo '<span class="breadcrumb__separator">›</span>Resultados da busca';
    } elseif (is_404()) {
        echo '<span class="breadcrumb__separator">›</span>Página não encontrada';
    }

    echo '</nav>';
}

// ============================================
// CUSTOM BODY CLASSES
// ============================================

function sigma_edge_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    
    if (wp_is_mobile()) {
        $classes[] = 'is-mobile';
    }
    
    return $classes;
}
add_filter('body_class', 'sigma_edge_body_classes');

// ============================================
// REMOVE WORDPRESS VERSION
// ============================================

function sigma_edge_remove_version() {
    return '';
}
add_filter('the_generator', 'sigma_edge_remove_version');

// ============================================
// DISABLE EMOJIS (Performance)
// ============================================

function sigma_edge_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'sigma_edge_disable_emojis');

// ============================================
// CUSTOM EXCERPT BY ID
// ============================================

function sigma_edge_get_excerpt_by_id($post_id, $length = 20) {
    $the_post = get_post($post_id);
    $the_excerpt = $the_post->post_excerpt ? $the_post->post_excerpt : $the_post->post_content;
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt));
    $words = explode(' ', $the_excerpt, $length + 1);
    
    if (count($words) > $length) {
        array_pop($words);
        $the_excerpt = implode(' ', $words) . '...';
    } else {
        $the_excerpt = implode(' ', $words);
    }
    
    return $the_excerpt;
}

// ============================================
// SECURITY ENHANCEMENTS
// ============================================

// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');

// Remove WordPress version from RSS
add_filter('the_generator', '__return_empty_string');

// Hide login errors
function sigma_edge_login_errors() {
    return 'Erro ao fazer login.';
}
add_filter('login_errors', 'sigma_edge_login_errors');

// ============================================
// FONT AWESOME
// ============================================

function sigma_edge_enqueue_fontawesome() {
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        [],
        '6.5.2'
    );
}
add_action('wp_enqueue_scripts', 'sigma_edge_enqueue_fontawesome');

function sigma_edge_enqueue_admin_fontawesome() {
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        [],
        '6.5.2'
    );
    wp_enqueue_script(
        'sigma-edge-fa-picker',
        get_template_directory_uri() . '/assets/js/admin-fa-picker.js',
        ['jquery', 'acf-input'],
        '1.0.0',
        true
    );
    wp_localize_script(
        'sigma-edge-fa-picker',
        'sigmaFaPickerData',
        ['icons' => sigma_edge_get_fa_icons()]
    );
}
add_action('acf/input/admin_enqueue_scripts', 'sigma_edge_enqueue_admin_fontawesome');
