<?php
/**
 * Template Data Helpers
 *
 * Toda leitura de ACF/WP_Query da home fica centralizada aqui.
 * Os template-parts apenas recebem os dados já prontos e renderizam HTML.
 */

if (!defined('ABSPATH')) {
    exit;
}

function sigma_edge_get_hero_data() {
    $background = get_field('hero_background_image');

    return [
        'eyebrow'     => get_field('hero_eyebrow'),
        'title'       => get_field('hero_title'),
        'description' => get_field('hero_description'),
        'cta_text'    => get_field('hero_cta_text') ?: 'Saiba mais',
        'cta_link'    => get_field('hero_cta_link'),
        'background'  => $background['id'] ?? null,
    ];
}

/**
 * @param string $field_name 'differences_items' ou 'differences_two_items'
 */
function sigma_edge_get_difference_items($field_name) {
    $items = [];

    if (have_rows($field_name)) {
        while (have_rows($field_name)) {
            the_row();
            $items[] = [
                'icon_class'  => sanitize_text_field(get_sub_field('icon_class') ?? ''),
                'title'       => get_sub_field('title'),
                'description' => get_sub_field('description'),
            ];
        }
    }

    return $items;
}

function sigma_edge_get_differences_two_data() {
    $background = get_field('differences_two_background_image');

    return [
        'background_id' => $background['id'] ?? null,
        'items'          => sigma_edge_get_difference_items('differences_two_items'),
    ];
}

function sigma_edge_map_post_card($post, $excerpt_words = 15) {
    return [
        'id'           => $post->ID,
        'title'        => get_the_title($post),
        'permalink'    => get_permalink($post),
        'thumbnail_id' => get_post_thumbnail_id($post),
        'excerpt'      => wp_trim_words(get_the_excerpt($post), $excerpt_words),
    ];
}

function sigma_edge_get_services_data() {
    $categories = [];
    $index = 0;

    if (have_rows('services_categories')) {
        while (have_rows('services_categories')) {
            the_row();

            $services = [];
            $category_services = get_sub_field('category_services');

            if ($category_services) {
                foreach ($category_services as $service_post) {
                    $services[] = sigma_edge_map_post_card($service_post, 15);
                }
            }

            $categories[] = [
                'index'    => $index,
                'name'     => get_sub_field('category_name'),
                'services' => $services,
            ];
            $index++;
        }
    }

    return [
        'title'      => get_field('services_title'),
        'categories' => $categories,
    ];
}

function sigma_edge_get_catalog_data() {
    $products = get_field('catalog_products');
    $items = [];

    if ($products) {
        foreach ($products as $product_post) {
            $item = sigma_edge_map_post_card($product_post, 12);
            $item['availability'] = get_field('product_availability', $product_post->ID);
            $items[] = $item;
        }
    }

    return [
        'title'    => get_field('catalog_title'),
        'products' => $items,
    ];
}

function sigma_edge_get_blog_data() {
    $count = get_field('blog_posts_count') ?: 4;

    $query = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'no_found_rows'  => true,
    ]);

    $posts = [];

    foreach ($query->posts as $post) {
        $categories = get_the_category($post->ID);
        $card = sigma_edge_map_post_card($post, 20);
        $card['category_name'] = $categories[0]->name ?? '';
        $posts[] = $card;
    }

    return [
        'title' => get_field('blog_title') ?: 'Últimas postagens do Blog',
        'posts' => $posts,
    ];
}

function sigma_edge_get_whatsapp_url() {
    $social_links = get_field('footer_social_media', 'option');

    if (!$social_links) {
        return '';
    }

    foreach ($social_links as $social) {
        if (isset($social['social_name']) && stripos($social['social_name'], 'whatsapp') !== false) {
            return $social['social_url'];
        }
    }

    return '';
}

function sigma_edge_get_address_data() {
    return [
        'map_embed'   => get_field('address_map_embed'),
        'title'       => get_field('address_title') ?: 'Sigma Edge | Matriz São Bernardo',
        'subtitle'    => get_field('address_subtitle'),
        'description' => get_field('address_description') ?: 'Preencha o formulário abaixo e nossa equipe entrará em contato com você o mais breve possível.',
    ];
}
