<?php

/**
 * The template for displaying search results.
 */

get_header(); ?>
<section class="hero">
    <!-- Background Image -->
    <img fetchpriority="high" decoding="async" width="1280" height="853" src="/wp-content/uploads/2024/11/sea-4242303_1280.jpg" class="hero__bg" alt="" srcset="/wp-content/uploads/2024/11/sea-4242303_1280.jpg 1280w, /wp-content/uploads/2024/11/sea-4242303_1280-300x200.jpg 300w, /wp-content/uploads/2024/11/sea-4242303_1280-1024x682.jpg 1024w, /wp-content/uploads/2024/11/sea-4242303_1280-768x512.jpg 768w" sizes="(max-width: 1280px) 100vw, 1280px">
    <div class="overlay"></div>
    <div class="container-xl py-6 my-auto">
        <h1>Search</h1>
        <div>
            <a href="/contact/" class="button button-primary">Contact Us Today</a>
        </div>
    </div>
</section>
<main>
    <div class="container-xl py-5">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                // Display the search query
                printf(
                    esc_html__('Search Results for: %s', 'your-text-domain'),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
        </header><!-- .page-header -->

        <?php if (have_posts()) { ?>
            <div class="row">
                <?php while (have_posts()) {
                    the_post(); ?>
                    <div class="col-md-4 mb-4">
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

            <!-- Pagination -->
            <div class="pagination py-4">
                <?php
                // Display pagination
                the_posts_pagination([
                    'mid_size'  => 2,
                    'prev_text' => __('&laquo; Previous', 'your-text-domain'),
                    'next_text' => __('Next &raquo;', 'your-text-domain'),
                ]);
                ?>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning">
                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'your-text-domain'); ?></p>
            </div>

            <!-- Search form -->
            <div class="search-form-wrapper">
                <?php get_search_form(); ?>
            </div>
        <?php } ?>
    </div>
</main><!-- #primary -->

<?php
get_footer();
