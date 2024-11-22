<section class="expertise bg-grey-100 py-6">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-lg-3" data-aos="fadein">
                <h2 class="fancy">Our<br><span>Expertise</span></h2>
                <p>intro</p>
                <a href="/expertise/" class="button button-primary">All Practice Areas</a>
            </div>
            <div class="col-lg-9 expertise__slider">
                <div class="splide" id="expertiseSplide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php
                            $c = 200;
                            while (have_rows('expertise', 'option')) {
                                the_row();
                            ?>
                                <li class="splide__slide">
                                    <a class="expertise__card" href="<?= get_the_permalink(get_sub_field('page')[0]) ?>" data-aos="fadein" data-aos-delay="<?= $c ?>">
                                        <img src="<?= get_sub_field('icon') ?>" alt="">
                                        <h3><?= get_sub_field('title') ?></h3>
                                        <p><?= get_sub_field('intro') ?></p>
                                    </a>
                                </li>
                            <?php
                                $c += 100;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- Custom controls container below the carousel -->
                <div class="splide-controls" data-aos="fadein">
                    <button class="splide__arrow splide__arrow--prev" aria-label="Previous"></button>
                    <div class="splide__pagination"></div>
                    <button class="splide__arrow splide__arrow--next" aria-label="Next"></button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Splide JavaScript -->
<?php add_action('wp_footer', function () { ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const splide = new Splide('#expertiseSplide', {
                breakpoints: {
                    1400: {
                        perPage: 3,
                    },
                    768: {
                        perPage: 2,
                    },
                    576: {
                        perPage: 1,
                    },
                },
                type: 'loop',
                autoplay: true,
                interval: 3000,
                perPage: 3,
                perMove: 1,
                gap: '1px', // Add gap between slides
                pagination: false, // Disable default pagination
                arrows: false, // Disable default arrows
            }).mount();

            // Custom Arrow Controls
            document.querySelector('.splide__arrow--prev').addEventListener('click', function() {
                splide.go('<');
            });

            document.querySelector('.splide__arrow--next').addEventListener('click', function() {
                splide.go('>');
            });

            // Custom Pagination Rendering
            const paginationContainer = document.querySelector('.splide__pagination');

            // Check if paginationContainer is found
            if (!paginationContainer) {
                console.error("Pagination container not found!");
                return;
            }

            // Generate the custom pagination dots based on the number of slides
            const slides = splide.Components.Elements.slides;
            slides.forEach((slide, index) => {
                const dot = document.createElement('button');
                dot.classList.add('splide__pagination__page');
                if (index === 0) dot.classList.add('is-active'); // Set the first dot as active initially

                // Navigate to slide on dot click
                dot.addEventListener('click', function() {
                    splide.go(index);
                });

                paginationContainer.appendChild(dot);
            });

            // Update the active state of pagination dots when the slide changes
            splide.on('move', function() {
                const dots = paginationContainer.querySelectorAll('.splide__pagination__page');
                dots.forEach((dot, index) => {
                    dot.classList.toggle('is-active', index === splide.index);
                });
            });
        });
    </script>
<?php }, 9999); ?>