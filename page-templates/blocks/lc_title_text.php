<?php
$background = get_field('background') ?: 'white';
$class = $block['className'] ?? 'py-6';

switch (get_field('split')) {
    case 4060:
        $colTitle = 'col-md-4';
        $colContent = 'col-md-8';
        break;
    default:
        $colTitle = 'col-md-6';
        $colContent = 'col-md-6';
}

$id = acf_slugify(get_field('title'));
?>
<section class="title_text bg-<?= $background ?> <?= $class ?>" id="<?= $id ?>">
    <div class="container-xl">
        <div class="row gy-5">
            <div class="<?= $colTitle ?>" data-aos="fadein">
                <h2 class="fancy"><?= get_field('title') ?></h2>
            </div>
            <div class="<?= $colContent ?>" data-aos="fadein" data-aos-delay="200">
                <?= get_field('content') ?>
            </div>
        </div>
    </div>
</section>