<?php
/**
 * Section Services
 */

$services = sigma_edge_get_services_data();
?>
<section class="section-services">
    <?php if ($services['title']) : ?>
        <h2 class="section-services__title"><?php echo esc_html($services['title']); ?></h2>
    <?php endif; ?>

    <?php if ($services['categories']) : ?>
        <nav class="section-services__tabs" role="tablist">
            <ul>
                <?php foreach ($services['categories'] as $category) : ?>
                    <li role="presentation">
                        <button
                            role="tab"
                            aria-selected="<?php echo $category['index'] === 0 ? 'true' : 'false'; ?>"
                            aria-controls="tab-panel-<?php echo esc_attr($category['index']); ?>"
                            id="tab-<?php echo esc_attr($category['index']); ?>"
                            data-tab="<?php echo esc_attr($category['index']); ?>">
                            <?php echo esc_html($category['name']); ?>
                        </button>
                    </li>
                <?php endforeach; ?>
                <li role="presentation">
                    <button
                        role="tab"
                        aria-selected="false"
                        aria-controls="tab-panel-all"
                        id="tab-all"
                        data-tab="all">
                        Ver tudo
                    </button>
                </li>
            </ul>
        </nav>

        <?php foreach ($services['categories'] as $category) : ?>
            <div
                class="section-services__grid"
                role="tabpanel"
                id="tab-panel-<?php echo esc_attr($category['index']); ?>"
                aria-labelledby="tab-<?php echo esc_attr($category['index']); ?>"
                <?php echo $category['index'] > 0 ? 'hidden' : ''; ?>>

                <?php foreach ($category['services'] as $service) : ?>
                    <article class="service-card">
                        <header class="service-card__header">
                            <?php if ($service['thumbnail_id']) : ?>
                                <figure class="service-card__image">
                                    <?php echo wp_get_attachment_image($service['thumbnail_id'], 'service-thumbnail', false, ['loading' => 'lazy', 'alt' => '']); ?>
                                </figure>
                            <?php endif; ?>
                            <h3 class="service-card__title">
                                <a href="<?php echo esc_url($service['permalink']); ?>"><?php echo esc_html($service['title']); ?></a>
                            </h3>
                        </header>
                        <footer class="service-card__footer">
                            <p><?php echo esc_html($service['excerpt']); ?></p>
                            <a href="<?php echo esc_url($service['permalink']); ?>" class="service-card__link">
                                Cotar agora
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"/>
                                </svg>
                            </a>
                        </footer>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <div class="section-services__grid" role="tabpanel" id="tab-panel-all" aria-labelledby="tab-all" hidden>
            <?php foreach ($services['categories'] as $category) : foreach ($category['services'] as $service) : ?>
                <article class="service-card">
                    <header class="service-card__header">
                        <?php if ($service['thumbnail_id']) : ?>
                            <figure class="service-card__image">
                                <?php echo wp_get_attachment_image($service['thumbnail_id'], 'service-thumbnail', false, ['loading' => 'lazy', 'alt' => '']); ?>
                            </figure>
                        <?php endif; ?>
                        <h3 class="service-card__title">
                            <a href="<?php echo esc_url($service['permalink']); ?>"><?php echo esc_html($service['title']); ?></a>
                        </h3>
                    </header>
                    <footer class="service-card__footer">
                        <p><?php echo esc_html($service['excerpt']); ?></p>
                        <a href="<?php echo esc_url($service['permalink']); ?>" class="service-card__link">
                            Cotar agora
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"/>
                            </svg>
                        </a>
                    </footer>
                </article>
            <?php endforeach; endforeach; ?>
        </div>
    <?php endif; ?>
</section>
