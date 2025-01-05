<?php

/**
 * Template for displaying the "Success" custom post type archive.
 */

get_header();

// Get the page ID for posts to fetch the hero image
$page_for_posts = get_option('page_for_posts');
?>

<section class="hero">
    <!-- Background Image -->
    <img src="/wp-content/uploads/2021/09/notable-victories-hero.jpg" class="hero__bg">
    <div class="overlay"></div>
    <div class="container-xl py-6 my-auto">
        <h1>Stormcatcher Insights</h1>
        <div>
            <a href="/contact/" class="button button-primary">Contact Us Today</a>
        </div>
    </div>
</section>

<main>
    <div class="container-xl py-5">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
        ?>
                <article id="post-<?php the_ID(); ?>">
                    <a href="<?= get_the_permalink() ?>" class="success_card">
                        <h2 class="success_card__title h5"><?= get_the_title() ?></h2>
                        <p class="success_card__text">
                            <?= wp_trim_words(get_the_excerpt(), 20) ?>
                        </p>
                    </a>
                </article>
            <?php
            } ?>

            <div class="pagination py-4">
                <?= understrap_pagination(); ?>
            </div>

        <?php
        } else {
        ?>
            <div class="alert alert-warning">
                <p>No successes found.</p>
            </div>
        <?php
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>