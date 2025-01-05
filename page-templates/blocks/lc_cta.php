<section class="cta">
    <div class="container-xl">
        <div class="bg-primary-400 text-white text-center">
            <div class="h3"><?= get_field('title') ?></div>
            <div><?= get_field('content') ?></div>
            <a href="tel:<?= parse_phone(get_field('contact_phone', 'option')) ?>" class="button button-primary"><i class="fas fa-phone"></i> Call</a>
            <a href="mailto:<?= get_field('contact_email', 'option') ?>" class="button button-primary"><i class="fas fa-paper-plane"></i> Email</a>
        </div>
    </div>
</section>