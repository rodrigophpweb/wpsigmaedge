<?php
/**
 * Hero Banner
 */

$hero = sigma_edge_get_hero_data();
?>
<section class="hero-banner">
    <?php if ($hero['background']) : ?>
        <picture class="hero-banner__background">
            <?php
            echo wp_get_attachment_image($hero['background'], 'hero-banner', false, [
                'loading' => 'eager',
                'fetchpriority' => 'high',
                'alt' => '',
            ]);
            ?>
        </picture>
    <?php endif; ?>

    <div class="hero-banner__content">
        <?php if ($hero['eyebrow']) : ?>
            <span class="hero-banner__eyebrow"><?php echo esc_html($hero['eyebrow']); ?></span>
        <?php endif; ?>

        <?php if ($hero['title']) : ?>
            <h1 class="hero-banner__title"><?php echo esc_html($hero['title']); ?></h1>
        <?php endif; ?>

        <?php if ($hero['description']) : ?>
            <p class="hero-banner__description"><?php echo esc_html($hero['description']); ?></p>
        <?php endif; ?>

        <span class="hero-banner__chevrons" aria-hidden="true">››››››››</span>

        <?php if ($hero['cta_link']) : ?>
            <a href="<?php echo esc_url($hero['cta_link']); ?>" class="hero-banner__cta">
                <?php echo esc_html($hero['cta_text']); ?>
            </a>
        <?php endif; ?>
    </div>

    <span class="hero-banner__decorative" aria-hidden="true">››››››››</span>
</section>
