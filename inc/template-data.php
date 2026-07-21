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
                    $card              = sigma_edge_map_post_card($service_post, 15);
                    $card['icon_class'] = get_field('service_icon_class', $service_post->ID) ?: 'fa-solid fa-gears';
                    $services[]        = $card;
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

/**
 * Monta URL do WhatsApp para cotação de um serviço específico.
 */
function sigma_edge_get_whatsapp_cotacao_url($service_title) {
    $base_url = sigma_edge_get_whatsapp_url();

    if (!$base_url) {
        return '#';
    }

    $phone = '';

    if (preg_match('#wa\.me/(\d+)#', $base_url, $m)) {
        $phone = $m[1];
    } elseif (preg_match('#[?&]phone=(\d+)#', $base_url, $m)) {
        $phone = $m[1];
    }

    $message = sprintf(
        'Olá! Gostaria de solicitar uma cotação para o serviço: *%s*. Poderia me enviar mais informações?',
        $service_title
    );

    if ($phone) {
        return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
    }

    $sep = strpos($base_url, '?') !== false ? '&' : '?';
    return $base_url . $sep . 'text=' . rawurlencode($message);
}

/**
 * Renderiza o HTML de um card de serviço.
 * Usada tanto no template-part quanto no handler HTMX.
 */
function sigma_edge_render_service_card($service) {
    $whatsapp_url = sigma_edge_get_whatsapp_cotacao_url($service['title']);
    $icon_class   = $service['icon_class'] ?? 'fa-solid fa-gears';
    ?>
    <article class="service-card">
        <header class="service-card__header">
            <figure class="service-card__image">
                <?php if (!empty($service['thumbnail_id'])) : ?>
                    <?php echo wp_get_attachment_image($service['thumbnail_id'], 'service-thumbnail', false, ['loading' => 'lazy', 'alt' => '']); ?>
                <?php endif; ?>
                <span class="service-card__icon-badge" aria-hidden="true">
                    <i class="<?php echo esc_attr($icon_class); ?>"></i>
                </span>
            </figure>
        </header>
        <h3 class="service-card__title">
            <a href="<?php echo esc_url($service['permalink']); ?>">
                <?php echo esc_html($service['title']); ?>
            </a>
        </h3>
        <div class="degrade">
            
            <?php if (!empty($service['excerpt'])) : ?>
                <p><?php echo esc_html($service['excerpt']); ?></p>
            <?php endif; ?>
            <footer class="service-card__footer">
                
                <a
                    href="<?php echo esc_url($whatsapp_url); ?>"
                    class="service-card__link"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?php echo esc_attr(sprintf('Cotar %s via WhatsApp', $service['title'])); ?>">
                    Cotar agora
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                        <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"/>
                    </svg>
                </a>
            </footer>
        </div>
    </article>
    <?php
}

/**
 * Retorna os serviços de uma categoria específica a partir de um page_id.
 * Usada pelo handler HTMX (contexto AJAX, sem $post global).
 */
function sigma_edge_get_services_for_tab($page_id, $category_index) {
    $services = [];
    $idx      = 0;

    if (!have_rows('services_categories', $page_id)) {
        return $services;
    }

    while (have_rows('services_categories', $page_id)) {
        the_row();
        if ($idx === $category_index) {
            $category_services = get_sub_field('category_services');
            if ($category_services) {
                foreach ($category_services as $service_post) {
                    $card              = sigma_edge_map_post_card($service_post, 15);
                    $card['icon_class'] = get_field('service_icon_class', $service_post->ID) ?: 'fa-solid fa-gears';
                    $services[]        = $card;
                }
            }
            break;
        }
        $idx++;
    }

    return $services;
}

/**
 * Handler HTMX: retorna os cards de uma categoria como HTML puro.
 */
function sigma_edge_ajax_services_tab() {
    $category = absint($_GET['category'] ?? 0);
    $page_id  = absint($_GET['page_id']  ?? 0);

    if (!$page_id || get_post_status($page_id) !== 'publish') {
        status_header(400);
        wp_die();
    }

    $services = sigma_edge_get_services_for_tab($page_id, $category);

    foreach ($services as $service) {
        sigma_edge_render_service_card($service);
    }

    wp_die();
}
add_action('wp_ajax_sigma_services_tab',        'sigma_edge_ajax_services_tab');
add_action('wp_ajax_nopriv_sigma_services_tab', 'sigma_edge_ajax_services_tab');

function sigma_edge_get_address_data() {
    return [
        'map_embed'   => get_field('address_map_embed'),
        'title'       => get_field('address_title') ?: 'Sigma Edge | Matriz São Bernardo',
        'subtitle'    => get_field('address_subtitle'),
        'description' => get_field('address_description') ?: 'Preencha o formulário abaixo e nossa equipe entrará em contato com você o mais breve possível.',
    ];
}
