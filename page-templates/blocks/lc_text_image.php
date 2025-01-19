<?php
$background = get_field('bg_colour') ?: 'white';
$class = $block['className'] ?? 'py-6';

switch (get_field('split')) {
    case 4060:
        $colText = 'col-md-4';
        $colImage = 'col-md-8';
        break;
    case 6040:
        $colText = 'col-md-8';
        $colImage = 'col-md-4';
        break;
    case 7030:
        $colText = 'col-md-9';
        $colImage = 'col-md-3';
        break;
    default:
        $colText = 'col-md-6';
        $colImage = 'col-md-6';
}

$orderText = get_field('order') == 'Text Image' ? 'order-md-1' : 'order-md-2';
$orderImage = get_field('order') == 'Text Image' ? 'order-md-2' : 'order-md-1';

if (isset($block['anchor'])) {
    echo '<a id="' . esc_attr($block['anchor']) . '" class="anchor"></a>';
}

$link = get_field('image_link') ?? null;

?>
<section
    class="text_image bg-<?= $background ?> <?= $class ?>">
    <div class="container-xl">
        <div class="row gy-5">
            <div
                class="<?= $colText ?> <?= $orderText ?> d-flex flex-column justify-content-center" data-aos="fadein">
                <h2 class="mb-4 fancy">
                    <?= get_field('title') ?>
                </h2>
                <div>
                    <?= get_field('content') ?>
                </div>
                <?php
                if (get_field('cta') ?? null) {
                    $l = get_field('cta');
                ?>
                    <a href="<?= $l['url'] ?>" target="<?= $l['target'] ?>" class="button button-primary mt-2"><?= $l['title'] ?></a>
                <?php
                }
                ?>
            </div>
            <div
                class="<?= $colImage ?> <?= $orderImage ?> d-flex justify-content-center align-items-center" data-aos="fadein" data-aos-delay="200">
                <?php
                if ($link) {
                ?>
                    <a class="text_image__image rounded--lg has-shadow--lg overflow-hidden" href="<?= $link['url'] ?>" target="<?= $link['target'] ?>">
                        <img src="<?= wp_get_attachment_image_url(get_field('image'), 'large') ?>" alt="">
                    </a>
                <?php
                } else {
                ?>
                    <div class="text_image__image rounded--lg has-shadow--lg overflow-hidden">
                        <img src="<?= wp_get_attachment_image_url(get_field('image'), 'large') ?>" alt="">
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>