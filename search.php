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
        <h2>
            <?php
            // Display the search query
            printf(
                esc_html__('Search Results for: %s', 'lc-str2025'),
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h2>
        <?php if (have_posts()) { ?>
            <div class="row">
                <?php while (have_posts()) {
                    the_post(); ?>
                    <div class="col-md-4 mb-4">
                        <a href="<?php the_permalink(); ?>" class="card-img-top">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('medium', ['class' => 'img-fluid']);
                            } else {
                                // Retrieve the post content and parse it for blocks
                                $blocks = parse_blocks(get_the_content());
                                $background_image_url = null;

                                // Loop through the blocks to find the first 'acf/lc-hero' block
                                foreach ($blocks as $block) {
                                    if ($block['blockName'] === 'acf/lc-hero' && !empty($block['attrs']['data']['attached_file_id'])) {
                                        // Get the image URL from the 'attached_file_id'
                                        $background_image_id = $block['attrs']['data']['attached_file_id'];
                                        $background_image_url = wp_get_attachment_image_url($background_image_id, 'medium');
                                        break; // Exit the loop once we find the hero block
                                    }
                                }

                                if ($background_image_url) {
                                    // Output the background image from the hero block
                                    echo '<img src="' . esc_url($background_image_url) . '" alt="Hero Background" class="img-fluid">';
                                } else {
                                    // Fallback to the placeholder image
                                    echo '<img src="' . esc_url(get_stylesheet_directory_uri() . '/img/placeholder.jpg') . '" alt="Placeholder Image" class="img-fluid">';
                                }
                            }
                            ?>
                            <h2 class="h5"><?= get_the_title() ?></h2>
                            <div><?= wp_trim_words(get_the_excerpt(), 20) ?></div>
                        </a>
                    </div>
                <?php } ?>
            </div>

            <!-- Pagination -->
            <?= understrap_pagination() ?>

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
