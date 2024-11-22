<?php
switch (get_field('split')) {
    case 4060:
        $colTitle = 'col-md-4';
        $colContent = 'col-md-8';
        break;
    default:
        $colTitle = 'col-md-6';
        $colContent = 'col-md-6';
}
?>
<section class="title_text">
    <div class="container-xl py-6">
        <div class="row">
            <div class="<?= $colTitle ?>" data-aos="fadein">
                <h2 class="fancy"><?= get_field('title') ?></h2>
            </div>
            <div class="<?= $colContent ?>" data-aos="fadein" data-aos-delay="200">
                <?= get_field('content') ?>
            </div>
        </div>
    </div>
</section>