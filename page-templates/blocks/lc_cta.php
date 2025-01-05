<?php
$class = $block['className'] ?? 'my-5';
?>
<section class="cta" data-aos="fade">
    <div class="container-xl">
        <div class="cta__inner text-center p-4  <?= $class ?>">
            <?php
            if (get_field('pre_title') ?? null) {
            ?>
                <div class="text-uppercase fw-bold pb-2"><?= get_field('pre_title') ?></div>
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