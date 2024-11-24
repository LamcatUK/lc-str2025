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
            $first = true;
            $length = 50;

            while ($q->have_posts()) {
                $q->the_post();
            ?>
                <a class="insights__card" href="<?= get_the_permalink() ?>" data-aos="fadein" data-aos-delay="<?= $c ?>">
                    <div class="insights__image">
                        <?= get_the_post_thumbnail(get_the_ID(), 'large') ?>
                    </div>
                    <h3><?= get_the_title() ?></h3>
                    <?php
                    if ($first == true) {
                    ?>
                        <p class="fs-300"><?= wp_trim_words(get_the_content(), $length) ?>
                        <?php
                        $first = false;
                    }
                        ?>
                        <div class="insights__date"><?= get_the_date() ?></div>
                </a>
            <?php
                $c += 100;
            }
            ?>
        </div>
        <div class="text-center" data-aos="fadein">
            <a href="/insights/" class="button button-outline">Explore Our Insights</a>
        </div>
    </div>
</section>