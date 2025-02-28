<?php
// get posts
$speciality_terms = get_field('speciality');
if (!empty($speciality_terms) && is_array($speciality_terms)) {
    $query_args = [
        'post_type'      => 'success',  // Your custom post type
        'posts_per_page' => -1,         // Retrieve all posts (adjust as needed)
        'tax_query'      => [
            [
                'taxonomy' => 'speciality', // Your taxonomy name
                'field'    => 'term_id',   // Matching by term ID
                'terms'    => $speciality_terms,
                'operator' => 'IN',        // Matches any of the provided term IDs
            ],
        ],
    ];

    // Execute query
    $q = new WP_Query($query_args);
    if ($q->have_posts()) {
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
                            while ($q->have_posts()) {
                                $q->the_post();
                            ?>
                                <li class="splide__slide">
                                    <a class="success_carousel__card" href="<?= get_the_permalink() ?>">
                                        <h3><?= get_the_title() ?></h3>
                                        <p><?= wp_trim_words(get_the_content(null, false, get_the_ID()), 55) ?></p>
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

        add_action('wp_footer', function () {
        ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
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
                        var prevButton = controls.querySelector('.splide-prev');
                        var nextButton = controls.querySelector('.splide-next');

                        prevButton.addEventListener('click', function() {
                            splide.go('<');
                        });

                        nextButton.addEventListener('click', function() {
                            splide.go('>');
                        });
                    });

                    splide.mount();
                });
            </script>
<?php
        });
    }
}
