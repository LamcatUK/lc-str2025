<?php

/**
 * The template for displaying search results.
 */

get_header(); ?>

<main id="primary" class="site-main">
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
