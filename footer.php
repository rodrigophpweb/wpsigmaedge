<footer class="site-footer" role="contentinfo">
    <div class="site-footer__container">
        
        <header class="site-footer__brand">
            <?php if (get_field('footer_logo', 'option')) : ?>
                <figure class="site-footer__logo">
                    <?php 
                    $logo = get_field('footer_logo', 'option');
                    echo wp_get_attachment_image($logo, 'medium', false, [
                        'alt' => get_bloginfo('name'),
                        'loading' => 'lazy'
                    ]);
                    ?>
                </figure>
            <?php else : ?>
                <figure class="site-footer__logo">
                    <svg width="180" height="40" viewBox="0 0 180 40" aria-label="<?php bloginfo('name'); ?>">
                        <text x="0" y="30" font-size="24" font-weight="700" fill="currentColor">
                            <?php bloginfo('name'); ?>
                        </text>
                    </svg>
                </figure>
            <?php endif; ?>
            
            <?php if (get_field('footer_description', 'option')) : ?>
                <p class="site-footer__description"><?php the_field('footer_description', 'option'); ?></p>
            <?php endif; ?>
            
            <?php if (have_rows('footer_social_media', 'option')) : ?>
                <ul class="site-footer__social" role="list">
                    <?php while (have_rows('footer_social_media', 'option')) : the_row(); ?>
                        <li>
                            <a 
                                href="<?php the_sub_field('social_url'); ?>" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                aria-label="<?php the_sub_field('social_name'); ?>">
                                <?php 
                                $icon = get_sub_field('social_icon');
                                if ($icon) {
                                    echo wp_get_attachment_image($icon, 'thumbnail', false, [
                                        'alt' => '',
                                        'aria-hidden' => 'true',
                                        'loading' => 'lazy'
                                    ]);
                                }
                                ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </header>

        <nav class="site-footer__menus">
            <?php if (has_nav_menu('footer-menu-1')) : ?>
                <section class="footer-menu">
                    <?php if (get_field('footer_menu_1_title', 'option')) : ?>
                        <h3 class="footer-menu__title"><?php the_field('footer_menu_1_title', 'option'); ?></h3>
                    <?php endif; ?>
                    <?php 
                    wp_nav_menu([
                        'theme_location' => 'footer-menu-1',
                        'container' => false,
                        'menu_class' => 'footer-menu__list',
                        'depth' => 1
                    ]);
                    ?>
                </section>
            <?php endif; ?>
            
            <?php if (has_nav_menu('footer-menu-2')) : ?>
                <section class="footer-menu">
                    <?php if (get_field('footer_menu_2_title', 'option')) : ?>
                        <h3 class="footer-menu__title"><?php the_field('footer_menu_2_title', 'option'); ?></h3>
                    <?php endif; ?>
                    <?php 
                    wp_nav_menu([
                        'theme_location' => 'footer-menu-2',
                        'container' => false,
                        'menu_class' => 'footer-menu__list',
                        'depth' => 1
                    ]);
                    ?>
                </section>
            <?php endif; ?>
        </nav>

        <aside class="site-footer__newsletter">
            <?php if (get_field('footer_newsletter_title', 'option')) : ?>
                <h3 class="newsletter__title"><?php the_field('footer_newsletter_title', 'option'); ?></h3>
            <?php else : ?>
                <h3 class="newsletter__title">Newsletter</h3>
            <?php endif; ?>
            
            <?php if (get_field('footer_newsletter_description', 'option')) : ?>
                <p class="newsletter__description"><?php the_field('footer_newsletter_description', 'option'); ?></p>
            <?php else : ?>
                <p class="newsletter__description">Fique por dentro de todas as novidades da Sigma Edge</p>
            <?php endif; ?>
            
            <form 
                class="newsletter-form" 
                method="post" 
                action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="newsletter_subscribe">
                <?php wp_nonce_field('newsletter_subscribe', 'newsletter_nonce'); ?>
                
                <div class="newsletter-form__group">
                    <label for="newsletter-email" class="sr-only">E-mail</label>
                    <input 
                        type="email" 
                        id="newsletter-email" 
                        name="newsletter_email" 
                        placeholder="Seu e-mail" 
                        required 
                        autocomplete="email">
                    <button type="submit" class="newsletter-form__submit">
                        Inscrever-se
                    </button>
                </div>
            </form>
        </aside>
    </div>

    <div class="site-footer__bottom">
        <small class="site-footer__copyright">
            <?php if (get_field('footer_copyright', 'option')) : ?>
                <?php the_field('footer_copyright', 'option'); ?>
            <?php else : ?>
                <?php bloginfo('name'); ?> - Copyright &copy; <?php echo date('Y'); ?>
            <?php endif; ?>
        </small>
        
        <?php if (has_nav_menu('footer-legal')) : ?>
            <nav class="site-footer__legal" aria-label="Menu legal">
                <?php 
                wp_nav_menu([
                    'theme_location' => 'footer-legal',
                    'container' => false,
                    'menu_class' => 'footer-legal__list',
                    'depth' => 1
                ]);
                ?>
            </nav>
        <?php endif; ?>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>