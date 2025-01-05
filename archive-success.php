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
        <?php if (have_posts()) { ?>
            <div class="row">
                <?php while (have_posts()) {
                    the_post(); ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100'); ?>>
                            <a href="<?php the_permalink(); ?>" class="card-img-top">
                                <?php if (has_post_thumbnail()) { ?>
                                    <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                                <?php } else { ?>
                                    <img src="<?= get_template_directory_uri(); ?>/images/placeholder.jpg" alt="Placeholder Image" class="img-fluid">
                                <?php } ?>
                            </a>
                            <div class="card-body">
                                <h2 class="card-title h5">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="card-text">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="<?php the_permalink(); ?>" class="button button-secondary">Read More</a>
                            </div>
                        </article>
                    </div>
                <?php } ?>
            </div>

            <div class="pagination py-4">
                <?= understrap_pagination(); ?>
            </div>

        <?php } else { ?>
            <div class="alert alert-warning">
                <p>No successes found.</p>
            </div>
        <?php } ?>
    </div>
</main>

<?php get_footer(); ?>