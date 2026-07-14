<?php
/**
 * Section Post Blog
 * ACF Fields: blog_title, blog_posts_count
 */
?>
<section class="section-post-blog">
    <?php if (get_field('blog_title')) : ?>
        <h2 class="section-post-blog__title"><?php the_field('blog_title'); ?></h2>
    <?php else : ?>
        <h2 class="section-post-blog__title">Últimas postagens do Blog</h2>
    <?php endif; ?>

    <?php
    $posts_count = get_field('blog_posts_count') ?: 4;
    
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_count,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );
    
    $blog_query = new WP_Query($args);
    
    if ($blog_query->have_posts()) : ?>
        <div class="section-post-blog__grid">
            <?php while ($blog_query->have_posts()) : $blog_query->the_post(); 
                $categories = get_the_category();
            ?>
                <article class="blog-card">
                    <?php if (!empty($categories)) : ?>
                        <mark class="blog-card__category"><?php echo esc_html($categories[0]->name); ?></mark>
                    <?php endif; ?>

                    <?php if (has_post_thumbnail()) : ?>
                        <figure class="blog-card__image">
                            <?php the_post_thumbnail('medium_large', [
                                'loading' => 'lazy'
                            ]); ?>
                        </figure>
                    <?php endif; ?>

                    <header class="blog-card__header">
                        <h3 class="blog-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </header>

                    <div class="blog-card__content">
                        <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    </div>

                    <footer class="blog-card__footer">
                        <a href="<?php the_permalink(); ?>" class="blog-card__link">
                            Acessar Post
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"/>
                            </svg>
                        </a>
                    </footer>
                </article>
            <?php endwhile; ?>
        </div>
    <?php 
        wp_reset_postdata();
    endif; 
    ?>
</section>