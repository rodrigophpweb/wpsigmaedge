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
                <?php if ($item['icon_id']) : ?>
                    <figure class="difference-item__icon" aria-hidden="true">
                        <?php echo wp_get_attachment_image($item['icon_id'], 'thumbnail', false, ['alt' => '']); ?>
                    </figure>
                <?php else : ?>
                    <figure class="difference-item__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z" fill="currentColor"/>
                        </svg>
                    </figure>
                <?php endif; ?>

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
