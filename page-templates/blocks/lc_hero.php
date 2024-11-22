<?php
$c = is_front_page() == 1 ? 'home_hero' : '';
?>
<section class="hero <?= $c ?>">
    <!-- Background Image -->
    <?= wp_get_attachment_image(get_field('background'), 'full', false, array('class' => 'hero__bg')) ?>
    <div class="overlay"></div>
    <div class="container-xl py-6 my-auto">
        <?php
        $c = 0;
        if (get_field('pre_title') ?? null) {
        ?>
            <div class="pre-title" data-aos="fadein" data-aos-delay="<?= $c ?>"><?= get_field('pre_title') ?></div>
        <?php
            $c += 200;
        }
        ?>
        <h1 data-aos="fadein" data-aos-delay="<?= $c ?>"><?= get_field('title') ?></h1>
        <?php
        $c += 200;
        if (get_field('content') ?? null) {
        ?>
            <div class="content" data-aos="fadein" data-aos-delay="<?= $c ?>"><?= get_field('content') ?></div>
        <?php
            $c += 200;
        }
        ?>
        <?php
        if (get_field('cta') ?? null) {
            $l = get_field('cta');
        ?>
            <a href="<?= $l['url'] ?>" target="<?= $l['target'] ?>" class="button button-primary" data-aos="fadein" data-aos-delay="<?= $c ?>"><?= $l['title'] ?></a>
        <?php
        }
        ?>
    </div>
</section>