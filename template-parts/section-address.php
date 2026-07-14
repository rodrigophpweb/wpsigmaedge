<?php
/**
 * Section Address - Mapa + Formulário de Contato
 * ACF Fields: address_map_embed, address_title, address_subtitle, address_description
 */
?>
<section class="section-address">
    <?php if (get_field('address_map_embed')) : ?>
        <div class="section-address__map">
            <?php 
            // ACF oEmbed field para Google Maps
            $map_embed = get_field('address_map_embed');
            echo $map_embed;
            ?>
        </div>
    <?php else : ?>
        <div class="section-address__map">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.1976!2d-46.6333!3d-23.5505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDMzJzAxLjgiUyA0NsKwMzcnNTkuOSJX!5e0!3m2!1spt-BR!2sbr!4v1234567890123"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Mapa de localização">
            </iframe>
        </div>
    <?php endif; ?>

    <div class="section-address__content">
        <header class="section-address__header">
            <figure class="section-address__icon" aria-hidden="true">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" fill="currentColor"/>
                </svg>
            </figure>
            
            <div class="section-address__heading">
                <?php if (get_field('address_title')) : ?>
                    <h2 class="section-address__title"><?php the_field('address_title'); ?></h2>
                <?php else : ?>
                    <h2 class="section-address__title">Sigma Edge | Matriz São Bernardo</h2>
                <?php endif; ?>
                
                <?php if (get_field('address_subtitle')) : ?>
                    <span class="section-address__subtitle"><?php the_field('address_subtitle'); ?></span>
                <?php endif; ?>
            </div>
        </header>

        <div class="section-address__info">
            <h3>Fale com a gente:</h3>
            <?php if (get_field('address_description')) : ?>
                <p><?php the_field('address_description'); ?></p>
            <?php else : ?>
                <p>Preencha o formulário abaixo e nossa equipe entrará em contato com você o mais breve possível.</p>
            <?php endif; ?>
        </div>

        <form class="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="contact_form_submit">
            <?php wp_nonce_field('contact_form', 'contact_form_nonce'); ?>
            
            <div class="contact-form__group">
                <label for="contact-name">Nome completo</label>
                <input 
                    type="text" 
                    id="contact-name" 
                    name="contact_name" 
                    required 
                    autocomplete="name">
            </div>

            <div class="contact-form__group">
                <label for="contact-email">E-mail</label>
                <input 
                    type="email" 
                    id="contact-email" 
                    name="contact_email" 
                    required 
                    autocomplete="email">
            </div>

            <div class="contact-form__group">
                <label for="contact-phone">Telefone com DDD</label>
                <input 
                    type="tel" 
                    id="contact-phone" 
                    name="contact_phone" 
                    required 
                    autocomplete="tel">
            </div>

            <div class="contact-form__group">
                <label for="contact-message">Mensagem</label>
                <textarea 
                    id="contact-message" 
                    name="contact_message" 
                    rows="4" 
                    required></textarea>
            </div>

            <button type="submit" class="contact-form__submit">
                Solicitar contato
            </button>
        </form>
    </div>
</section>