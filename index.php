<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

$page_for_posts = get_option('page_for_posts');

?>
<section class="hero">
    <!-- Background Image -->
    <?= get_the_post_thumbnail($page_for_posts, 'full', array('class' => 'hero__bg')) ?>
    <div class="overlay"></div>
    <div class="container-xl py-6 my-auto">
        <h1>Stormcatcher Insights</h1>
        <div>
            <a href="/contact/" class="button button-primary">Contact Us Today</a>
        </div>
    </div>
</section>
<main id="main" class="news_index">
    <div class="container-xl py-5">
        <?= apply_filters('the_content', get_the_content(null, false, $page_for_posts)) ?>
        <?php
        $categories = get_categories([
            'hide_empty' => true, // Only include categories with posts
        ]);

        if (!empty($categories)) {
            echo '<div class="insights__categories mb-4">';
            echo '<a href="/insights/" class="active">All</a>';
            foreach ($categories as $category) {
                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">';
                echo esc_html($category->name);
                echo '</a>';
            }
            echo '</div>';
        } else {
            echo '<p>No categories found with posts.</p>';
        }

        ?>
        <div class="news_index__grid">
            <?php
            $style = 'news_index__card--first';
            $length = 50;
            $c = 'news_index__meta--first';
            while (have_posts()) {
                the_post();

                $categories = get_the_category();
            ?>
                <a href="<?= get_the_permalink() ?>"
                    class="news_index__card <?= $style ?>">
                    <div class="news_index__image">
                        <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large') ?>"
                            alt="">
                    </div>
                    <div class="news_index__inner">
                        <h2><?= get_the_title() ?></h2>
                        <p><?= wp_trim_words(get_the_content(), $length) ?>
                        </p>
                        <div class="news_index__meta <?= $c ?>">
                            <div class="fs-200">
                                <?= get_the_date() ?>
                            </div>
                            <div class="news_index__categories">
                                <?php
                                if ($categories) {
                                    foreach ($categories as $category) {
                                ?>
                                        <span class="news_index__category"><?= esc_html($category->name) ?></span>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
                if ($c != '') {
                ?>
                    <section class="cta my-2">
                        <div class="container-xl px-5 py-4 d-flex justify-content-between align-items-center gap-4 flex-wrap">
                            <h2 class="h4 mb-0 mx-auto ms-md-0">Stormcatcher - Your First Step Towards Resolution</h2>
                            <a href="/contact/" class="button button-primary align-self-center mx-auto me-md-0"><span>Contact Us Today</span></a>
                        </div>
                    </section>
            <?php
                }
                $style = '';
                $c = '';
                $length = 20;
            }
            ?>
            <?= understrap_pagination() ?>
        </div>
    </div>
    <div class="py-6 bg-grey-100">
        <div class="container-xl">
            <?= do_shortcode('[trustindex no-registration=google]') ?>
        </div>
    </div>
</main>
<?php
get_footer();
