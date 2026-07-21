<?php
/**
 * Section Services
 * Navegação por abas com HTMX — conteúdo carregado via admin-ajax.php.
 * "Ver tudo" redireciona para /servicos/.
 * "Cotar agora" abre WhatsApp com mensagem pré-preenchida.
 */

$services  = sigma_edge_get_services_data();
$ajax_url  = admin_url('admin-ajax.php');
$page_id   = get_the_ID();
$first_cat = $services['categories'][0] ?? null;
?>
<section class="section-services">
    <?php if ($services['title']) : ?>
        <h2 class="section-services__title"><?php echo esc_html($services['title']); ?></h2>
    <?php endif; ?>

    <?php if ($services['categories']) : ?>
        <nav class="section-services__tabs" aria-label="Filtrar serviços por categoria">
            <ul role="tablist">
                <?php foreach ($services['categories'] as $category) : ?>
                    <li role="presentation">
                        <button
                            role="tab"
                            aria-selected="<?php echo $category['index'] === 0 ? 'true' : 'false'; ?>"
                            id="tab-<?php echo esc_attr($category['index']); ?>"
                            data-tab="<?php echo esc_attr($category['index']); ?>"
                            hx-get="<?php echo esc_url(add_query_arg(['action' => 'sigma_services_tab', 'category' => $category['index'], 'page_id' => $page_id], $ajax_url)); ?>"
                            hx-target="#services-grid"
                            hx-swap="innerHTML"
                            hx-indicator="#services-loading">
                            <?php echo esc_html($category['name']); ?>
                        </button>
                    </li>
                <?php endforeach; ?>
                <li>
                    <a href="<?php echo esc_url(home_url('/servicos/')); ?>" class="section-services__tab-all">
                        Ver tudo
                    </a>
                </li>
            </ul>
        </nav>

        <div
            id="services-grid"
            class="section-services__grid"
            role="tabpanel"
            aria-labelledby="tab-0"
            aria-live="polite">

            <?php if ($first_cat) : ?>
                <?php foreach ($first_cat['services'] as $service) : ?>
                    <?php sigma_edge_render_service_card($service); ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div id="services-loading" class="section-services__loading htmx-indicator" aria-hidden="true">
            <span class="screen-reader-text">Carregando serviços…</span>
        </div>

    <?php endif; ?>
</section>
