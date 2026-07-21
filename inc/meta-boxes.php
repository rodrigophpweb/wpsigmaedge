<?php
/**
 * ACF Field Groups Registration
 * 
 * Registra todos os grupos de campos ACF via código
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ACF Field Groups
 */
function sigma_edge_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // ========================================
    // HERO BANNER FIELDS
    // ========================================
    acf_add_local_field_group([
        'key' => 'group_hero_banner',
        'title' => 'Hero Banner',
        'fields' => [
            [
                'key' => 'field_hero_eyebrow',
                'label' => 'Eyebrow (Texto pequeno acima do título)',
                'name' => 'hero_eyebrow',
                'type' => 'text',
                'instructions' => 'Texto pequeno acima do título principal',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
            [
                'key' => 'field_hero_title',
                'label' => 'Título Principal',
                'name' => 'hero_title',
                'type' => 'text',
                'instructions' => 'Título principal do hero banner',
                'required' => 1,
                'wrapper' => ['width' => '100'],
            ],
            [
                'key' => 'field_hero_description',
                'label' => 'Descrição',
                'name' => 'hero_description',
                'type' => 'textarea',
                'instructions' => 'Descrição do hero banner',
                'required' => 0,
                'rows' => 3,
            ],
            [
                'key' => 'field_hero_cta_text',
                'label' => 'Texto do Botão CTA',
                'name' => 'hero_cta_text',
                'type' => 'text',
                'instructions' => 'Texto do botão de chamada para ação',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
            [
                'key' => 'field_hero_cta_link',
                'label' => 'Link do Botão CTA',
                'name' => 'hero_cta_link',
                'type' => 'url',
                'instructions' => 'URL do botão CTA',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
            [
                'key' => 'field_hero_background_image',
                'label' => 'Imagem de Fundo',
                'name' => 'hero_background_image',
                'type' => 'image',
                'instructions' => 'Imagem de fundo do hero banner (recomendado: 1920x1080px)',
                'required' => 0,
                'return_format' => 'id',
                'preview_size' => 'medium',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
        ],
    ]);

    // ========================================
    // SERVICES SECTION FIELDS
    // ========================================
    acf_add_local_field_group([
        'key' => 'group_services_section',
        'title' => 'Seção de Serviços',
        'fields' => [
            [
                'key' => 'field_services_title',
                'label' => 'Título da Seção',
                'name' => 'services_title',
                'type' => 'text',
                'instructions' => 'Título da seção de serviços',
                'required' => 0,
                'default_value' => 'Nossos Serviços',
            ],
            [
                'key' => 'field_services_categories',
                'label' => 'Categorias de Serviços',
                'name' => 'services_categories',
                'type' => 'repeater',
                'instructions' => 'Adicione as categorias de serviços com seus respectivos serviços',
                'required' => 0,
                'layout' => 'block',
                'button_label' => 'Adicionar Categoria',
                'sub_fields' => [
                    [
                        'key' => 'field_category_name',
                        'label' => 'Nome da Categoria',
                        'name' => 'category_name',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'key' => 'field_category_services',
                        'label' => 'Serviços',
                        'name' => 'category_services',
                        'type' => 'relationship',
                        'instructions' => 'Selecione os serviços desta categoria',
                        'required' => 0,
                        'post_type' => ['service'],
                        'filters' => ['search'],
                        'return_format' => 'object',
                        'wrapper' => ['width' => '100'],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
        ],
    ]);

    // ========================================
    // PRODUCT CATALOG SECTION FIELDS
    // ========================================
    acf_add_local_field_group([
        'key' => 'group_product_catalog',
        'title' => 'Catálogo de Produtos',
        'fields' => [
            [
                'key' => 'field_catalog_title',
                'label' => 'Título da Seção',
                'name' => 'catalog_title',
                'type' => 'text',
                'instructions' => 'Título da seção de produtos',
                'required' => 0,
                'default_value' => 'Catálogo de Produtos',
            ],
            [
                'key' => 'field_catalog_products',
                'label' => 'Produtos',
                'name' => 'catalog_products',
                'type' => 'relationship',
                'instructions' => 'Selecione os produtos para exibir no carrossel',
                'required' => 0,
                'post_type' => ['product'],
                'filters' => ['search', 'taxonomy'],
                'return_format' => 'object',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
        ],
    ]);

    // ========================================
    // DIFFERENCES SECTION FIELDS
    // ========================================
    acf_add_local_field_group([
        'key' => 'group_differences_section',
        'title' => 'Seção de Diferenciais',
        'fields' => [
            [
                'key' => 'field_differences_items',
                'label' => 'Diferenciais',
                'name' => 'differences_items',
                'type' => 'repeater',
                'instructions' => 'Adicione os diferenciais da empresa',
                'required' => 0,
                'layout' => 'block',
                'button_label' => 'Adicionar Diferencial',
                'sub_fields' => [
                    [
                        'key'          => 'field_difference_icon_class',
                        'label'        => 'Ícone (Font Awesome)',
                        'name'         => 'icon_class',
                        'type'         => 'text',
                        'instructions' => 'Classe Font Awesome do ícone. Ex: <code>fa-solid fa-star</code>, <code>fa-solid fa-bolt</code>, <code>fa-regular fa-circle-check</code>. Veja todos em <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com/icons</a>',
                        'required'     => 0,
                        'placeholder'  => 'fa-solid fa-star',
                        'wrapper'      => ['width' => '30'],
                    ],
                    [
                        'key' => 'field_difference_title',
                        'label' => 'Título',
                        'name' => 'title',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '70'],
                    ],
                    [
                        'key' => 'field_difference_description',
                        'label' => 'Descrição',
                        'name' => 'description',
                        'type' => 'textarea',
                        'required' => 0,
                        'rows' => 3,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
        ],
    ]);

    // ========================================
    // BLOG SECTION FIELDS
    // ========================================
    acf_add_local_field_group([
        'key' => 'group_blog_section',
        'title' => 'Seção de Blog',
        'fields' => [
            [
                'key' => 'field_blog_title',
                'label' => 'Título da Seção',
                'name' => 'blog_title',
                'type' => 'text',
                'instructions' => 'Título da seção de blog',
                'required' => 0,
                'default_value' => 'Blog',
            ],
            [
                'key' => 'field_blog_posts_count',
                'label' => 'Número de Posts',
                'name' => 'blog_posts_count',
                'type' => 'number',
                'instructions' => 'Quantos posts exibir',
                'required' => 0,
                'default_value' => 3,
                'min' => 1,
                'max' => 12,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
        ],
    ]);

    // ========================================
    // DIFFERENCES TWO SECTION FIELDS
    // ========================================
    acf_add_local_field_group([
        'key' => 'group_differences_two',
        'title' => 'Seção de Diferenciais 2',
        'fields' => [
            [
                'key' => 'field_differences_two_background_image',
                'label' => 'Imagem de Fundo',
                'name' => 'differences_two_background_image',
                'type' => 'image',
                'instructions' => 'Imagem de fundo da seção',
                'required' => 0,
                'return_format' => 'id',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_differences_two_items',
                'label' => 'Itens',
                'name' => 'differences_two_items',
                'type' => 'repeater',
                'instructions' => 'Lista de diferenciais',
                'required' => 0,
                'layout' => 'block',
                'button_label' => 'Adicionar Item',
                'sub_fields' => [
                    [
                        'key'          => 'field_diff_two_icon_class',
                        'label'        => 'Ícone (Font Awesome)',
                        'name'         => 'icon_class',
                        'type'         => 'text',
                        'instructions' => 'Classe Font Awesome do ícone. Ex: <code>fa-solid fa-star</code>, <code>fa-solid fa-bolt</code>, <code>fa-regular fa-circle-check</code>. Veja todos em <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com/icons</a>',
                        'required'     => 0,
                        'placeholder'  => 'fa-solid fa-star',
                        'wrapper'      => ['width' => '30'],
                    ],
                    [
                        'key' => 'field_diff_two_title',
                        'label' => 'Título',
                        'name' => 'title',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '70'],
                    ],
                    [
                        'key' => 'field_diff_two_description',
                        'label' => 'Descrição',
                        'name' => 'description',
                        'type' => 'textarea',
                        'required' => 0,
                        'rows' => 2,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
        ],
    ]);

    // ========================================
    // ADDRESS SECTION FIELDS
    // ========================================
    acf_add_local_field_group([
        'key' => 'group_address_section',
        'title' => 'Seção de Endereço/Contato',
        'fields' => [
            [
                'key' => 'field_address_map_embed',
                'label' => 'Google Maps Embed',
                'name' => 'address_map_embed',
                'type' => 'oembed',
                'instructions' => 'Cole a URL do Google Maps aqui',
                'required' => 0,
            ],
            [
                'key' => 'field_address_title',
                'label' => 'Título',
                'name' => 'address_title',
                'type' => 'text',
                'instructions' => 'Título da seção',
                'required' => 0,
                'default_value' => 'Sigma Edge | Matriz São Bernardo',
                'wrapper' => ['width' => '70'],
            ],
            [
                'key' => 'field_address_subtitle',
                'label' => 'Subtítulo',
                'name' => 'address_subtitle',
                'type' => 'text',
                'instructions' => 'Subtítulo opcional',
                'required' => 0,
                'wrapper' => ['width' => '30'],
            ],
            [
                'key' => 'field_address_description',
                'label' => 'Descrição',
                'name' => 'address_description',
                'type' => 'textarea',
                'instructions' => 'Texto de introdução do formulário de contato',
                'required' => 0,
                'rows' => 3,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
        ],
    ]);

    // ========================================
    // PRODUCT CUSTOM FIELDS
    // ========================================
    acf_add_local_field_group([
        'key' => 'group_product_fields',
        'title' => 'Informações do Produto',
        'fields' => [
            [
                'key' => 'field_product_availability',
                'label' => 'Disponibilidade',
                'name' => 'product_availability',
                'type' => 'select',
                'instructions' => 'Status de disponibilidade do produto',
                'required' => 1,
                'choices' => [
                    'available' => 'Disponível',
                    'unavailable' => 'Indisponível',
                    'pre_order' => 'Pré-venda',
                ],
                'default_value' => 'available',
            ],
            [
                'key' => 'field_product_technical_sheet',
                'label' => 'Ficha Técnica',
                'name' => 'product_technical_sheet',
                'type' => 'file',
                'instructions' => 'PDF da ficha técnica',
                'required' => 0,
                'return_format' => 'array',
                'mime_types' => 'pdf',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                ],
            ],
        ],
    ]);

    // ========================================
    // FOOTER OPTIONS FIELDS
    // ========================================
    acf_add_local_field_group([
        'key' => 'group_footer_options',
        'title' => 'Configurações do Footer',
        'fields' => [
            [
                'key' => 'field_footer_logo',
                'label' => 'Logo do Footer',
                'name' => 'footer_logo',
                'type' => 'image',
                'instructions' => 'Logo a ser exibido no footer',
                'required' => 0,
                'return_format' => 'id',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_footer_description',
                'label' => 'Descrição',
                'name' => 'footer_description',
                'type' => 'textarea',
                'instructions' => 'Texto descritivo no footer',
                'required' => 0,
                'rows' => 3,
            ],
            [
                'key' => 'field_footer_social_media',
                'label' => 'Redes Sociais',
                'name' => 'footer_social_media',
                'type' => 'repeater',
                'instructions' => 'Links das redes sociais',
                'required' => 0,
                'layout' => 'table',
                'button_label' => 'Adicionar Rede Social',
                'sub_fields' => [
                    [
                        'key' => 'field_social_name',
                        'label' => 'Nome',
                        'name' => 'social_name',
                        'type' => 'text',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_social_url',
                        'label' => 'URL',
                        'name' => 'social_url',
                        'type' => 'url',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_social_icon',
                        'label' => 'Ícone',
                        'name' => 'social_icon',
                        'type' => 'image',
                        'required' => 0,
                        'return_format' => 'id',
                        'preview_size' => 'thumbnail',
                    ],
                ],
            ],
            [
                'key' => 'field_footer_menu_1_title',
                'label' => 'Título do Menu 1',
                'name' => 'footer_menu_1_title',
                'type' => 'text',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
            [
                'key' => 'field_footer_menu_2_title',
                'label' => 'Título do Menu 2',
                'name' => 'footer_menu_2_title',
                'type' => 'text',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
            [
                'key' => 'field_footer_newsletter_title',
                'label' => 'Título da Newsletter',
                'name' => 'footer_newsletter_title',
                'type' => 'text',
                'required' => 0,
                'default_value' => 'Newsletter',
            ],
            [
                'key' => 'field_footer_newsletter_description',
                'label' => 'Descrição da Newsletter',
                'name' => 'footer_newsletter_description',
                'type' => 'textarea',
                'required' => 0,
                'rows' => 2,
            ],
            [
                'key' => 'field_footer_copyright',
                'label' => 'Copyright',
                'name' => 'footer_copyright',
                'type' => 'text',
                'instructions' => 'Texto de copyright (deixe vazio para usar o padrão)',
                'required' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-general-settings',
                ],
            ],
        ],
    ]);

    // ========================================
    // SERVICE CPT FIELDS
    // ========================================
    acf_add_local_field_group([
        'key'    => 'group_service_fields',
        'title'  => 'Informações do Serviço',
        'fields' => [
            [
                'key'          => 'field_service_icon_class',
                'label'        => 'Ícone (Font Awesome)',
                'name'         => 'service_icon_class',
                'type'         => 'text',
                'instructions' => 'Classe FA do ícone. Ex: <code>fa-solid fa-gears</code>. <a href="https://fontawesome.com/icons" target="_blank">Ver ícones</a>',
                'required'     => 0,
                'placeholder'  => 'fa-solid fa-gears',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'service',
                ],
            ],
        ],
    ]);
}
add_action('acf/init', 'sigma_edge_register_acf_fields');
