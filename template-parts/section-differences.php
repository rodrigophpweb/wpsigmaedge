<?php
/**
 * Section Differences - Cards de Diferenciais
 * ACF Fields: differences_items (repeater: icon, title, description)
 */
?>
<section class="section-differences">
    <?php if (have_rows('differences_items')) : ?>
        <?php while (have_rows('differences_items')) : the_row(); ?>
            <article class="difference-card">
                <?php 
                $icon = get_sub_field('icon');
                if ($icon) : 
                ?>
                    <figure class="difference-card__icon" aria-hidden="true">
                        <?php echo wp_get_attachment_image($icon['id'], 'thumbnail'); ?>
                    </figure>
                <?php else : ?>
                    <figure class="difference-card__icon" aria-hidden="true">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" fill="currentColor"/>
                        </svg>
                    </figure>
                <?php endif; ?>

                <?php if (get_sub_field('title') || get_sub_field('description')) : ?>
                    <div class="difference-card__content">
                        <?php if (get_sub_field('title')) : ?>
                            <h3 class="difference-card__title"><?php the_sub_field('title'); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (get_sub_field('description')) : ?>
                            <p class="difference-card__description"><?php the_sub_field('description'); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</section>