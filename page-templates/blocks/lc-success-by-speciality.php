<?php
/**
 * Success By Speciality Block Template
 *
 * Displays a carousel of success stories filtered by speciality or category.
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;

// get posts.
$speciality_terms = get_field( 'speciality' );

// if speciality_terms is empty, choose the first 5 terms from the 'category' taxonomy.
if ( empty( $speciality_terms ) || ! is_array( $speciality_terms ) ) {
    $terms = get_terms(
        array(
            'taxonomy'   => 'category',
            'hide_empty' => true,
            'number'     => 5,
        )
    );

    $speciality_terms = wp_list_pluck( $terms, 'term_id' ); // Get term IDs.
}


if ( ! empty( $speciality_terms ) && is_array( $speciality_terms ) ) {
    $query_args = array(
        'post_type'      => 'success',  // Your custom post type.
        'posts_per_page' => -1,         // Retrieve all posts (adjust as needed).
        'tax_query'      => array(      // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
            'taxonomy' => 'category',  // Your taxonomy name.
            'field'    => 'term_id',   // Matching by term ID.
            'terms'    => $speciality_terms,
            'operator' => 'IN',        // Matches any of the provided term IDs.
        ),
    );

    $q = new WP_Query( $query_args );
    if ( $q->have_posts() ) {
        ?>
        <section class="success_sp">
            <div class="container-xl py-5">
                <div id="successBySpec" class="splide">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h2 class="mb-4 fancy">
                            Success Stories
                        </h2>
                        <div id="splide-controlsSBS" class="splide-controls">
                            <div class="splide-prev"></div>
                            <div class="splide-next"></div>
                        </div>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list pb-4">
                            <?php
                            while ( $q->have_posts() ) {
                                $q->the_post();
                                ?>
                                <li class="splide__slide">
                                    <a class="success_carousel__card" href="<?= esc_url( get_the_permalink() ); ?>">
                                        <h3><?= esc_html( get_the_title() ); ?></h3>
                                        <p><?= wp_kses_post( wp_trim_words( get_the_content( null, false, get_the_ID() ), 55 ) ); ?></p>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php
        add_action(
            'wp_footer',
            function () {
                ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var root = document.getElementById('successBySpec');
        if (!root) { return; }
        var splide = new Splide('#successBySpec', {
            direction: 'ltr', // Vertical direction
            perPage: 1, // Show two slides at once
            perMove: 1, // Move one slide at a time
            autoplay: true, // Enable autoplay
            interval: 4000, // Interval between slides (in milliseconds)
            pauseOnHover: true, // Pause autoplay on hover
            wheel: true, // Allows navigation using the mouse wheel
            speed: 800, // Transition speed in milliseconds (optional)
            type: 'loop', // Loop through the slides
            pagination: false,
            arrows: false,
            autoHeight: true,
        });
        // Manually attach control buttons
        var controls = document.getElementById('splide-controlsSBS');
        splide.on('mounted', function() {
            // Attach previous/next buttons from the custom container
            if (!controls) { return; }
            var prevButton = controls.querySelector('.splide-prev');
            var nextButton = controls.querySelector('.splide-next');

            if (prevButton) {
                prevButton.addEventListener('click', function() {
                    splide.go('<');
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', function() {
                    splide.go('>');
                });
            }
        });

        splide.mount();
    });
</script>
                <?php
            }
        );
    }
}
