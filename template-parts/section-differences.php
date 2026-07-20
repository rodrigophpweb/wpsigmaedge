<?php
/**
 * Section Differences - Cards de Diferenciais
 */

$items = sigma_edge_get_difference_items('differences_items');
?>
<section class="section-differences">
    <div class="section-differences__container">
        <?php foreach ($items as $item) : ?>
            <article class="difference-card">
                <figure class="difference-card__icon" aria-hidden="true">
                    <?php if ($item['icon_class']) : ?>
                        <i class="<?php echo esc_attr($item['icon_class']); ?>"></i>
                    <?php else : ?>
                        <i class="fa-solid fa-circle-dot"></i>
                    <?php endif; ?>
                </figure>

                <?php if ($item['title'] || $item['description']) : ?>
                    <header class="difference-card__content">
                        <?php if ($item['title']) : ?>
                            <h3 class="difference-card__title"><?php echo esc_html($item['title']); ?></h3>
                        <?php endif; ?>

                        <?php if ($item['description']) : ?>
                            <p class="difference-card__description"><?php echo esc_html($item['description']); ?></p>
                        <?php endif; ?>
                    </header>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    </div>
</section>
