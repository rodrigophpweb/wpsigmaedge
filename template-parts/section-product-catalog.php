<?php
/**
 * Section Product Catalog - ACF
 * Fields: catalog_title, catalog_products (relationship)
 */
?>
<section class="section-product-catalog">
    <?php if (get_field('catalog_title')) : ?>
        <h2 class="section-product-catalog__title"><?php the_field('catalog_title'); ?></h2>
    <?php endif; ?>

    <div class="product-carousel" role="region" aria-label="Catálogo de produtos">
        <button 
            class="product-carousel__control product-carousel__control--prev" 
            aria-label="Produto anterior">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z" fill="currentColor"/>
            </svg>
        </button>

        <div class="product-carousel__track">
            <?php 
            $products = get_field('catalog_products');
            if ($products) : foreach ($products as $post) : setup_postdata($post);
                $availability = get_field('product_availability');
            ?>
                <article class="product-card">
                    <header class="product-card__header">
                        <figure class="product-card__image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('product-card', [
                                    'loading' => 'lazy'
                                ]); ?>
                            <?php else : ?>
                                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" fill="currentColor"/>
                                </svg>
                            <?php endif; ?>
                            <figcaption class="product-card__badge" aria-label="Produto certificado">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3z" fill="currentColor"/>
                                </svg>
                            </figcaption>
                        </figure>
                    </header>

                    <footer class="product-card__footer">
                        <?php if ($availability) : ?>
                            <mark class="product-card__status"><?php echo esc_html($availability); ?></mark>
                        <?php endif; ?>
                        <h3 class="product-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="product-card__description"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>
                        <a href="<?php the_permalink(); ?>" class="product-card__link">
                            Ver mais
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"/>
                            </svg>
                        </a>
                    </footer>
                </article>
            <?php endforeach; wp_reset_postdata(); endif; ?>
        </div>

        <button 
            class="product-carousel__control product-carousel__control--next" 
            aria-label="Próximo produto">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"/>
            </svg>
        </button>
    </div>

    <div class="product-carousel__indicators" role="tablist" aria-label="Indicadores de navegação">
        <button role="tab" aria-label="Slide 1" aria-selected="true"></button>
        <button role="tab" aria-label="Slide 2" aria-selected="false"></button>
        <button role="tab" aria-label="Slide 3" aria-selected="false"></button>
    </div>
</section>