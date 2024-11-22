<section class="insights py-6 bg-grey-100">
    <div class="container-xl">
        <div class="insights__title mb-4" data-aos="fadein">
            <div class="line"></div>
            <h2>Stormcatcher <span>Insights</span></h2>
            <div class="line"></div>
        </div>
        <div class="insights__grid mb-4">
            <?php
            $q = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 5
            ));
            $c = 200;
            while ($q->have_posts()) {
                $q->the_post();
            ?>
                <a class="insights__card" href="<?= get_the_permalink() ?>" data-aos="fadein" data-aos-delay="<?= $c ?>">
                    <div class="insights__image">
                        <?= get_the_post_thumbnail(get_the_ID(), 'large') ?>
                    </div>
                    <h3><?= get_the_title() ?></h3>
                    <div class="insights__date"><?= get_the_date() ?></div>
                </a>
            <?php
                $c += 200;
            }
            ?>
        </div>
        <div class="text-center">
            <a href="/insights/" class="button button-outline" data-aos="fadein" data-aos-delay="<?= $c ?>">View More Insights</a>
        </div>
    </div>
</section>