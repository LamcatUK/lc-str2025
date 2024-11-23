<section class="success_carousel bg-grey-100 py-6">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-4" data-aos="fadein">
                <h2 class="mb-4 fancy">
                    <?= get_field('title') ?>
                </h2>
                <div class="mb-4">
                    <?= get_field('content') ?>
                </div>
                <a href="/success-stories/" class="button button-primary">Read more</a>
            </div>
            <div class="col-md-8" data-aos="fadein" data-aos-delay="200">
                <div id="successes" class="splide">
                    <div id="splide-controls" class="splide-controls">
                        <div class="splide-prev"></div>
                        <div class="splide-next"></div>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list pb-4">
                            <?php
                            foreach (get_field('successes') as $s) {
                            ?>
                                <li class="splide__slide">
                                    <a class="success_carousel__card" href="<?= get_the_permalink($s) ?>">
                                        <h3><?= get_the_title($s) ?></h3>
                                        <p><?= wp_trim_words(get_the_content(null, false, $s), 30) ?></p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var splide = new Splide('#successes', {
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
        var controls = document.getElementById('splide-controls');
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