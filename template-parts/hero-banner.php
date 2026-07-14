<?php
/**
 * Hero Banner - ACF
 * Fields: hero_eyebrow, hero_title, hero_description, hero_cta_text, hero_cta_link, hero_background_image
 */
?>
<section class="hero-banner">
    <?php if (get_field('hero_background_image')) : ?>
        <picture class="hero-banner__background">
            <?php 
            $image = get_field('hero_background_image');
            echo wp_get_attachment_image($image['id'], 'hero-banner', false, [
                'loading' => 'eager',
                'fetchpriority' => 'high'
            ]);
            ?>
        </picture>
    <?php endif; ?>

    <div class="hero-banner__content">
        <?php if (get_field('hero_eyebrow')) : ?>
            <span class="hero-banner__eyebrow"><?php the_field('hero_eyebrow'); ?></span>
        <?php endif; ?>

        <?php if (get_field('hero_title')) : ?>
            <h1 class="hero-banner__title"><?php the_field('hero_title'); ?></h1>
        <?php endif; ?>

        <?php if (get_field('hero_description')) : ?>
            <p class="hero-banner__description"><?php the_field('hero_description'); ?></p>
        <?php endif; ?>

        <?php if (get_field('hero_cta_link')) : 
            $cta_link = get_field('hero_cta_link');
            $cta_text = get_field('hero_cta_text') ?: 'Saiba mais';
        ?>
            <a href="<?php echo esc_url($cta_link); ?>" class="hero-banner__cta">
                <?php echo esc_html($cta_text); ?>
                <span aria-hidden="true">››››››</span>
            </a>
        <?php endif; ?>
    </div>

    <span class="hero-banner__decorative" aria-hidden="true">››››››››</span>
</section>