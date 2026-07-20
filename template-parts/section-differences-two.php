<?php
/**
 * Section Differences Two - Com imagem lateral
 */

$data = sigma_edge_get_differences_two_data();
?>
<section class="section-differences-two">
    <?php if ($data['background_id']) : ?>
        <picture class="section-differences-two__background">
            <?php echo wp_get_attachment_image($data['background_id'], 'large', false, ['loading' => 'lazy', 'alt' => '']); ?>
        </picture>
    <?php endif; ?>

    <div class="section-differences-two__content">
        <?php foreach ($data['items'] as $item) : ?>
            <article class="difference-item">
                <figure class="difference-item__icon" aria-hidden="true">
                    <?php if ($item['icon_class']) : ?>
                        <i class="<?php echo esc_attr($item['icon_class']); ?>"></i>
                    <?php else : ?>
                        <i class="fa-solid fa-circle-dot"></i>
                    <?php endif; ?>
                </figure>

                <div class="difference-item__content">
                    <?php if ($item['title']) : ?>
                        <h3 class="difference-item__title"><?php echo esc_html($item['title']); ?></h3>
                    <?php endif; ?>

                    <?php if ($item['description']) : ?>
                        <p class="difference-item__description"><?php echo esc_html($item['description']); ?></p>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>
