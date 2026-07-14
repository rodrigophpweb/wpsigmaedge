<?php
/**
 * Custom Post Types
 * 
 * Registra os CPTs: Produtos, Serviços
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Product CPT
 */
function register_product_post_type() {
    $labels = [
        'name'                  => _x('Produtos', 'Post Type General Name', 'wpsigmaedge'),
        'singular_name'         => _x('Produto', 'Post Type Singular Name', 'wpsigmaedge'),
        'menu_name'             => __('Produtos', 'wpsigmaedge'),
        'name_admin_bar'        => __('Produto', 'wpsigmaedge'),
        'archives'              => __('Arquivo de Produtos', 'wpsigmaedge'),
        'attributes'            => __('Atributos do Produto', 'wpsigmaedge'),
        'parent_item_colon'     => __('Produto Pai:', 'wpsigmaedge'),
        'all_items'             => __('Todos os Produtos', 'wpsigmaedge'),
        'add_new_item'          => __('Adicionar Novo Produto', 'wpsigmaedge'),
        'add_new'               => __('Adicionar Novo', 'wpsigmaedge'),
        'new_item'              => __('Novo Produto', 'wpsigmaedge'),
        'edit_item'             => __('Editar Produto', 'wpsigmaedge'),
        'update_item'           => __('Atualizar Produto', 'wpsigmaedge'),
        'view_item'             => __('Ver Produto', 'wpsigmaedge'),
        'view_items'            => __('Ver Produtos', 'wpsigmaedge'),
        'search_items'          => __('Buscar Produto', 'wpsigmaedge'),
        'not_found'             => __('Não encontrado', 'wpsigmaedge'),
        'not_found_in_trash'    => __('Não encontrado na lixeira', 'wpsigmaedge'),
    ];

    $args = [
        'label'                 => __('Produto', 'wpsigmaedge'),
        'description'           => __('Produtos da Sigma Edge', 'wpsigmaedge'),
        'labels'                => $labels,
        'supports'              => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-products',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => ['slug' => 'produtos', 'with_front' => false],
    ];

    register_post_type('product', $args);
}
add_action('init', 'register_product_post_type', 0);

/**
 * Register Product Category Taxonomy
 */
function register_product_category_taxonomy() {
    $labels = [
        'name'                       => _x('Categorias de Produto', 'Taxonomy General Name', 'wpsigmaedge'),
        'singular_name'              => _x('Categoria de Produto', 'Taxonomy Singular Name', 'wpsigmaedge'),
        'menu_name'                  => __('Categorias', 'wpsigmaedge'),
        'all_items'                  => __('Todas as Categorias', 'wpsigmaedge'),
        'parent_item'                => __('Categoria Pai', 'wpsigmaedge'),
        'parent_item_colon'          => __('Categoria Pai:', 'wpsigmaedge'),
        'new_item_name'              => __('Nova Categoria', 'wpsigmaedge'),
        'add_new_item'               => __('Adicionar Nova Categoria', 'wpsigmaedge'),
        'edit_item'                  => __('Editar Categoria', 'wpsigmaedge'),
        'update_item'                => __('Atualizar Categoria', 'wpsigmaedge'),
        'view_item'                  => __('Ver Categoria', 'wpsigmaedge'),
        'separate_items_with_commas' => __('Separe categorias com vírgulas', 'wpsigmaedge'),
        'add_or_remove_items'        => __('Adicionar ou remover categorias', 'wpsigmaedge'),
        'choose_from_most_used'      => __('Escolher das mais usadas', 'wpsigmaedge'),
        'popular_items'              => __('Categorias Populares', 'wpsigmaedge'),
        'search_items'               => __('Buscar Categorias', 'wpsigmaedge'),
        'not_found'                  => __('Não Encontrado', 'wpsigmaedge'),
    ];

    $args = [
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => ['slug' => 'categoria-produto', 'with_front' => false],
    ];

    register_taxonomy('product_category', ['product'], $args);
}
add_action('init', 'register_product_category_taxonomy', 0);

/**
 * Register Service CPT
 */
function register_service_post_type() {
    $labels = [
        'name'                  => _x('Serviços', 'Post Type General Name', 'wpsigmaedge'),
        'singular_name'         => _x('Serviço', 'Post Type Singular Name', 'wpsigmaedge'),
        'menu_name'             => __('Serviços', 'wpsigmaedge'),
        'name_admin_bar'        => __('Serviço', 'wpsigmaedge'),
        'archives'              => __('Arquivo de Serviços', 'wpsigmaedge'),
        'attributes'            => __('Atributos do Serviço', 'wpsigmaedge'),
        'parent_item_colon'     => __('Serviço Pai:', 'wpsigmaedge'),
        'all_items'             => __('Todos os Serviços', 'wpsigmaedge'),
        'add_new_item'          => __('Adicionar Novo Serviço', 'wpsigmaedge'),
        'add_new'               => __('Adicionar Novo', 'wpsigmaedge'),
        'new_item'              => __('Novo Serviço', 'wpsigmaedge'),
        'edit_item'             => __('Editar Serviço', 'wpsigmaedge'),
        'update_item'           => __('Atualizar Serviço', 'wpsigmaedge'),
        'view_item'             => __('Ver Serviço', 'wpsigmaedge'),
        'view_items'            => __('Ver Serviços', 'wpsigmaedge'),
        'search_items'          => __('Buscar Serviço', 'wpsigmaedge'),
        'not_found'             => __('Não encontrado', 'wpsigmaedge'),
        'not_found_in_trash'    => __('Não encontrado na lixeira', 'wpsigmaedge'),
    ];

    $args = [
        'label'                 => __('Serviço', 'wpsigmaedge'),
        'description'           => __('Serviços da Sigma Edge', 'wpsigmaedge'),
        'labels'                => $labels,
        'supports'              => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-admin-tools',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => ['slug' => 'servicos', 'with_front' => false],
    ];

    register_post_type('service', $args);
}
add_action('init', 'register_service_post_type', 0);

/**
 * Register Service Category Taxonomy
 */
function register_service_category_taxonomy() {
    $labels = [
        'name'                       => _x('Categorias de Serviço', 'Taxonomy General Name', 'wpsigmaedge'),
        'singular_name'              => _x('Categoria de Serviço', 'Taxonomy Singular Name', 'wpsigmaedge'),
        'menu_name'                  => __('Categorias', 'wpsigmaedge'),
        'all_items'                  => __('Todas as Categorias', 'wpsigmaedge'),
        'parent_item'                => __('Categoria Pai', 'wpsigmaedge'),
        'parent_item_colon'          => __('Categoria Pai:', 'wpsigmaedge'),
        'new_item_name'              => __('Nova Categoria', 'wpsigmaedge'),
        'add_new_item'               => __('Adicionar Nova Categoria', 'wpsigmaedge'),
        'edit_item'                  => __('Editar Categoria', 'wpsigmaedge'),
        'update_item'                => __('Atualizar Categoria', 'wpsigmaedge'),
        'view_item'                  => __('Ver Categoria', 'wpsigmaedge'),
        'separate_items_with_commas' => __('Separe categorias com vírgulas', 'wpsigmaedge'),
        'add_or_remove_items'        => __('Adicionar ou remover categorias', 'wpsigmaedge'),
        'choose_from_most_used'      => __('Escolher das mais usadas', 'wpsigmaedge'),
        'popular_items'              => __('Categorias Populares', 'wpsigmaedge'),
        'search_items'               => __('Buscar Categorias', 'wpsigmaedge'),
        'not_found'                  => __('Não Encontrado', 'wpsigmaedge'),
    ];

    $args = [
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => ['slug' => 'categoria-servico', 'with_front' => false],
    ];

    register_taxonomy('service_category', ['service'], $args);
}
add_action('init', 'register_service_category_taxonomy', 0);
