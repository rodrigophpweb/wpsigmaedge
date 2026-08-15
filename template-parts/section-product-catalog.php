<?php
/**
 * Section Product Catalog
 */

$catalog = sigma_edge_get_catalog_data();
?>
<section class="section-product-catalog">
    <?php if ($catalog['title']) : ?>
        <h2 class="section-product-catalog__title"><?php echo esc_html($catalog['title']); ?></h2>
    <?php endif; ?>

    <div class="product-carousel" role="region" aria-label="Catálogo de produtos">
        <button
            class="product-carousel__control product-carousel__control--prev"
            aria-label="Produto anterior">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
        </button>

        <div class="product-carousel__track">
            <?php
            $whatsapp_base = sigma_edge_get_whatsapp_url();
            foreach ($catalog['products'] as $product) :
                $cta_message = 'Olá! Gostaria de cotar o produto: ' . $product['title'];
                $cta_href = $whatsapp_base
                    ? add_query_arg('text', $cta_message, $whatsapp_base)
                    : $product['permalink'];
            ?>
                <article class="product-card">
                    <header class="product-card__header">
                        <figure class="product-card__image">
                            <?php if ($product['thumbnail_id']) : ?>
                                <?php echo wp_get_attachment_image($product['thumbnail_id'], 'product-card', false, ['loading' => 'lazy', 'alt' => '']); ?>
                            <?php else : ?>
                                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" fill="currentColor"/>
                                </svg>
                            <?php endif; ?>
                            <figcaption class="product-card__badge" aria-label="Ferramenta">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.6C.4 7 .9 10 2.9 12c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z" fill="currentColor"/>
                                </svg>
                            </figcaption>
                        </figure>
                    </header>

                    <footer class="product-card__footer">
                        <?php if ($product['availability']) : ?>
                            <span class="product-card__status"><?php echo esc_html($product['availability']); ?></span>
                        <?php endif; ?>
                        <h3 class="product-card__title">
                            <a href="<?php echo esc_url($product['permalink']); ?>"><?php echo esc_html($product['title']); ?></a>
                        </h3>
                        <p class="product-card__description"><?php echo esc_html($product['excerpt']); ?></p>
                        <hr class="product-card__divider">
                        <a href="<?php echo esc_url($cta_href); ?>"
                           class="product-card__cta"
                           <?php if ($whatsapp_base) : ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>>
                            Cotar
                        </a>
                    </footer>
                </article>
            <?php endforeach; ?>
        </div>

        <button
            class="product-carousel__control product-carousel__control--next"
            aria-label="Próximo produto">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </button>
    </div>

    <?php
    $cards_per_page = 4;
    $page_count = max(1, (int) ceil(count($catalog['products']) / $cards_per_page));
    ?>
    <div class="product-carousel__indicators" role="tablist" aria-label="Indicadores de navegação">
        <?php for ($i = 1; $i <= $page_count; $i++) : ?>
            <button
                role="tab"
                aria-label="Página <?php echo $i; ?> de <?php echo $page_count; ?>"
                aria-selected="<?php echo $i === 1 ? 'true' : 'false'; ?>">
            </button>
        <?php endfor; ?>
    </div>
</section>
