<?php
$class = $block['className'] ?? 'my-5';
?>
<section class="cta <?= $class ?>">
    <div class="container-xl">
        <div class="bg-primary-400 text-white text-center p-4">
            <?php
            if (get_field('pre_title') ?? null) {
            ?>
                <div class="text-uppercase fw-bold pb-2"><?= get_field('title') ?></div>
            <?php
            }
            if (get_field('title') ?? null) {
            ?>
                <div class="h3"><?= get_field('title') ?></div>
            <?php
            }
            if (get_field('content') ?? null) {
            ?>
                <div class="pb-4"><?= get_field('content') ?></div>
            <?php
            }
            ?>
            <a href="tel:<?= parse_phone(get_field('contact_phone', 'option')) ?>" class="button button-primary"><i class="fas fa-phone"></i> Call</a>
            <a href="mailto:<?= get_field('contact_email', 'option') ?>" class="button button-primary"><i class="fas fa-paper-plane"></i> Email</a>
        </div>
    </div>
</section>