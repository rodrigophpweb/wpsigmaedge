<?php
/**
 * Hero Banner
 */

$hero = sigma_edge_get_hero_data();
?>
<section class="hero-banner">

    

    <div class="hero-banner__container">
        <svg class="hero-banner__shape"
         xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 387.65701 160.21011"
         preserveAspectRatio="none"
         aria-hidden="true"
         focusable="false">
            <defs>
                <linearGradient id="hero-gradient" x1="0" y1="0" x2="1" y2="0">
                    <stop offset="0%" stop-color="#001e64"/>
                    <stop offset="100%" stop-color="#0066a6"/>
                </linearGradient>
            </defs>
            <path fill="url(#hero-gradient)"
                d="M 4.2305302,0.203009
                    c -1.929939,0.000136 -4.036297,1.709005 -4.036544,3.702185
                    L 0.1763885,146.003458
                    c -0.000205,1.65595 0.848146,4.08796 3.640006,4.08742
                    l 246.40642,-0.0475 15.47996,8.79161
                    c 1.80007,1.02233 4.01497,1.20424 6.19204,1.19861
                    l 71.78815,-0.18578
                    c 7.17706,-0.0186 16.96178,-9.96976 21.84384,-9.91821
                    l 17.2301,0.18192
                    c 1.90556,0.0201 4.71825,-2.0044 4.71833,-4.21588
                    l 0.005,-141.321639
                    c 0.000008,-2.290638 -2.53898,-4.397793 -5.00163,-4.39762 z"/>
        </svg>    


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
            <svg width="987.799" height="444.049" viewBox="0 0 261.355 117.488" xmlns="http://www.w3.org/2000/svg"><path d="M9.784.176C4.424.174.158 5.69.176 11.791l.296 95.957c.015 4.903 5.486 9.565 8.965 9.564l173-.061 78.737-58.446.005-49.197c0-3.608-5.138-9.337-9.04-9.338z" fill="none" stroke="#1b78b2" stroke-width=".353"/></svg>
            <div class="data_container">
                <?php if ($hero['eyebrow']) : ?>
                    <span class="hero-banner__eyebrow"><?php echo esc_html($hero['eyebrow']); ?></span>
                <?php endif; ?>

                <?php if ($hero['title']) : ?>
                    <h1 class="hero-banner__title"><?php echo esc_html($hero['title']); ?></h1>
                <?php endif; ?>

                <?php if ($hero['description']) : ?>
                    <p class="hero-banner__description"><?php echo esc_html($hero['description']); ?></p>
                <?php endif; ?>


                <?php if ($hero['cta_link']) : ?>
                    <a href="<?php echo esc_url($hero['cta_link']); ?>" class="hero-banner__cta">
                        <?php echo esc_html($hero['cta_text']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        
    </div>

</section>
