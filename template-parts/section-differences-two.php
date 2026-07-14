<?php
/**
 * Section Differences Two - Com imagem lateral
 * ACF Fields: differences_two_background_image, differences_two_items (repeater: icon, title, description)
 */
?>
<section class="section-differences-two">
    <?php if (get_field('differences_two_background_image')) : ?>
        <picture class="section-differences-two__background">
            <?php 
            $bg_image = get_field('differences_two_background_image');
            echo wp_get_attachment_image($bg_image['id'], 'large', false, [
                'loading' => 'lazy'
            ]);
            ?>
        </picture>
    <?php endif; ?>

    <div class="section-differences-two__content">
        <?php if (have_rows('differences_two_items')) : ?>
            <?php while (have_rows('differences_two_items')) : the_row(); ?>
                <article class="difference-item">
                    <?php 
                    $icon = get_sub_field('icon');
                    if ($icon) : 
                    ?>
                        <figure class="difference-item__icon" aria-hidden="true">
                            <?php echo wp_get_attachment_image($icon['id'], 'thumbnail'); ?>
                        </figure>
                    <?php else : ?>
                        <figure class="difference-item__icon" aria-hidden="true">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z" fill="currentColor"/>
                            </svg>
                        </figure>
                    <?php endif; ?>

                    <div class="difference-item__content">
                        <?php if (get_sub_field('title')) : ?>
                            <h3 class="difference-item__title"><?php the_sub_field('title'); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (get_sub_field('description')) : ?>
                            <p class="difference-item__description"><?php the_sub_field('description'); ?></p>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>