<section class="expertise bg-grey-100 py-6">
    <div class="container-xl">
        <div class="row gy-4 justify-content-center">
            <?php
            $c = 0;
            while (have_rows('expertise', 'option')) {
                the_row();
            ?>
                <div class="col-md-4 px-0" data-aos="fade" data-aos-delay="<?= $c ?>">
                    <a class="expertise__card" href="<?= get_the_permalink(get_sub_field('page')[0]) ?>">
                        <img src="<?= get_sub_field('icon') ?>" alt="">
                        <h3><?= get_sub_field('title') ?></h3>
                        <p class="show"><?= get_sub_field('intro') ?></p>
                    </a>
                </div>
            <?php
                $c += 100;
            }
            ?>
        </div>
    </div>
</section>