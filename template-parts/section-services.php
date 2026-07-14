<?php
/**
 * Section Services - ACF
 * Fields: services_title, services_categories (repeater), services_posts (relationship)
 */
?>
<section class="section-services">
    <?php if (get_field('services_title')) : ?>
        <h2 class="section-services__title"><?php the_field('services_title'); ?></h2>
    <?php endif; ?>

    <?php if (have_rows('services_categories')) : ?>
        <nav class="section-services__tabs" role="tablist">
            <ul>
                <?php $index = 0; while (have_rows('services_categories')) : the_row(); ?>
                    <li role="presentation">
                        <button 
                            role="tab" 
                            aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                            aria-controls="tab-panel-<?php echo $index; ?>"
                            id="tab-<?php echo $index; ?>"
                            data-tab="<?php echo $index; ?>">
                            <?php the_sub_field('category_name'); ?>
                        </button>
                    </li>
                <?php $index++; endwhile; ?>
                <li role="presentation">
                    <button 
                        role="tab" 
                        aria-selected="false"
                        aria-controls="tab-panel-all"
                        id="tab-all"
                        data-tab="all">
                        Ver tudo
                    </button>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

    <?php if (have_rows('services_categories')) : ?>
        <?php $panel_index = 0; while (have_rows('services_categories')) : the_row(); 
            $category_services = get_sub_field('category_services');
        ?>
            <div 
                class="section-services__grid" 
                role="tabpanel"
                id="tab-panel-<?php echo $panel_index; ?>"
                aria-labelledby="tab-<?php echo $panel_index; ?>"
                <?php echo $panel_index > 0 ? 'hidden' : ''; ?>>
                
                <?php if ($category_services) : foreach ($category_services as $post) : setup_postdata($post); ?>
                    <article class="service-card">
                        <header class="service-card__header">
                            <?php if (has_post_thumbnail()) : ?>
                                <figure class="service-card__image">
                                    <?php the_post_thumbnail('service-thumbnail', [
                                        'loading' => 'lazy'
                                    ]); ?>
                                </figure>
                            <?php endif; ?>
                            <h3 class="service-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </header>
                        <footer class="service-card__footer">
                            <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                            <a href="<?php the_permalink(); ?>" class="service-card__link">
                                Saiba mais
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"/>
                                </svg>
                            </a>
                        </footer>
                    </article>
                <?php endforeach; wp_reset_postdata(); endif; ?>
            </div>
        <?php $panel_index++; endwhile; ?>
    <?php endif; ?>
</section>