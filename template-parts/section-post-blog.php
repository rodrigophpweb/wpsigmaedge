<?php
/**
 * Section Post Blog
 */

$blog = sigma_edge_get_blog_data();
?>
<section class="section-post-blog">
    <h2 class="section-post-blog__title"><?php echo esc_html($blog['title']); ?></h2>

    <?php if ($blog['posts']) : ?>
        <div class="section-post-blog__grid">
            <?php foreach ($blog['posts'] as $post) : ?>
                <article class="blog-card">
                    <?php if ($post['category_name']) : ?>
                        <mark class="blog-card__category"><?php echo esc_html($post['category_name']); ?></mark>
                    <?php endif; ?>

                    <?php if ($post['thumbnail_id']) : ?>
                        <figure class="blog-card__image">
                            <?php echo wp_get_attachment_image($post['thumbnail_id'], 'medium_large', false, ['loading' => 'lazy', 'alt' => '']); ?>
                        </figure>
                    <?php endif; ?>

                    <header class="blog-card__header">
                        <h3 class="blog-card__title">
                            <a href="<?php echo esc_url($post['permalink']); ?>"><?php echo esc_html($post['title']); ?></a>
                        </h3>
                    </header>

                    <div class="blog-card__content">
                        <p class="blog-card__excerpt"><?php echo esc_html($post['excerpt']); ?></p>
                    </div>

                    <footer class="blog-card__footer">
                        <a href="<?php echo esc_url($post['permalink']); ?>" class="blog-card__link">
                            Acessar Post
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"/>
                            </svg>
                        </a>
                    </footer>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
