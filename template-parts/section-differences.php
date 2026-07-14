<?php
/**
 * Section Differences - Cards de Diferenciais
 */

$items = sigma_edge_get_difference_items('differences_items');
?>
<section class="section-differences">
    <?php foreach ($items as $item) : ?>
        <article class="difference-card">
            <?php if ($item['icon_id']) : ?>
                <figure class="difference-card__icon" aria-hidden="true">
                    <?php echo wp_get_attachment_image($item['icon_id'], 'thumbnail', false, ['alt' => '']); ?>
                </figure>
            <?php else : ?>
                <figure class="difference-card__icon" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" fill="currentColor"/>
                    </svg>
                </figure>
            <?php endif; ?>

            <?php if ($item['title'] || $item['description']) : ?>
                <div class="difference-card__content">
                    <?php if ($item['title']) : ?>
                        <h3 class="difference-card__title"><?php echo esc_html($item['title']); ?></h3>
                    <?php endif; ?>

                    <?php if ($item['description']) : ?>
                        <p class="difference-card__description"><?php echo esc_html($item['description']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </article>
    <?php endforeach; ?>
</section>
