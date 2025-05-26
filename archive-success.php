<?php
/**
 * Template for displaying the "Success" custom post type archive.
 *
 * @package lc-str2025
 */

get_header();

// Get the page ID for posts to fetch the hero image.
$page_for_posts = get_option( 'page_for_posts' );
?>
<section class="hero">
    <!-- Background Image -->
    <img src="/wp-content/uploads/2021/09/notable-victories-hero.jpg" class="hero__bg">
    <div class="overlay"></div>
    <div class="container-xl py-6 my-auto">
        <h1>Success Stories</h1>
        <div>
            <a href="/contact/" class="button button-primary">Contact Us Today</a>
        </div>
    </div>
</section>

<main>
    <div class="container-xl py-5">
        <div class="row">
            <div class="col-md-3 order-2 order-md-1">
                <div class="sidebar-success">
                    <div class="sidebar">
                        <h3 class="h5">Our Expertise</h3>
                        <?php wp_nav_menu( array( 'theme_location' => 'success_menu' ) ); ?>
                    </div>
                    <div class="mt-4 success-cta d-none d-lg-block">
                        <div class="fw-600 mb-3">Contact Stormcatcher for First Free Advice</div>
                        <div class="d-flex gap-2 justify-content-center align-items-center">
                            <a href="<?= esc_url( 'tel:' . parse_phone( get_field( 'contact_phone', 'option' ) ) ); ?>" class="button button-primary"><i class="fas fa-phone"></i> Call</a>
                            <a href="<?= esc_url( 'mailto:' . antispambot( get_field( 'contact_email', 'option' ) ) ); ?>" class="button button-primary"><i class="fas fa-paper-plane"></i> Email</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 order-1 order-md-2">
                <div class="pb-5">At Stormcatcher, we measure success by the outcomes we achieve for our clients. Below you'll find real examples of the claims we've handled; from mis-sold finance and defective vehicle complaints to high-value disputes involving classic cars and luxury marques. Each case demonstrates our ability to combine deep legal knowledge with practical insight to resolve complex problems and deliver results.</div>
            <?php
            $categories = get_categories(
                array(
                    'hide_empty' => false,
                )
            );

            $page_cats = array_filter(
                $categories,
                function ( $cat ) {
                    $query = new WP_Query(
                        array(
                            'post_type'      => 'success',
                            'category__in'   => array( $cat->term_id ),
                            'posts_per_page' => 1,
                            'fields'         => 'ids',
                        )
                    );
                    return $query->have_posts();
                }
            );

            if ( ! empty( $page_cats ) ) {
                echo '<div class="insights__categories mb-4 d-flex flex-wrap align-items-center">';
                echo '<span class="fw-600 fs-300">Filter:</span>';
                echo '<span class="button button-filter active" data-filter="all">All</span>';
                foreach ( $page_cats as $category ) {
                    echo '<span class="button button-filter" data-filter="cat-' . esc_attr( $category->term_id ) . '">';
                    echo esc_html( $category->name );
                    echo '</span>';
                }
                echo '</div>';
            } else {
                echo '<p>No categories found with posts.</p>';
            }

            $args  = array(
                'post_type'      => 'success',
                'posts_per_page' => -1,
            );
            $query = new WP_Query( $args );


            if ( $query->have_posts() ) {
                $i = 0;
                echo '<div class="success_cards row" id="successCards">';
                while ( $query->have_posts() ) {
                    $query->the_post();
                    ++$i;
                    $categories     = get_the_category();
                    $first_category = ! empty( $categories ) ? $categories[0] : null;
                    $category_class = $first_category ? 'cat-' . esc_attr( $first_category->term_id ) : 'uncategorised';

                    if ( 1 === $i ) {
                        ?>
                    <a href="<?= esc_url( get_the_permalink() ); ?>" class="success_card col-12 mb-4" data-category="<?= esc_attr( $category_class ); ?>">
                        <div class="row success_card__featured">
                            <div class="col-md-5">
                                <h2 class="success_card__title h3"><?= esc_html( get_the_title() ); ?></h2>
                            </div>
                            <div class="col-md-7 d-flex flex-column">
                                <?php
                                if ( $first_category ) {
                                    ?>
                                <div class="success_card__pill mb-4">
                                    <?= esc_html( $first_category->name ); ?>
                                </div>
                                    <?php
                                }
                                ?>
                                <?= wp_kses_post( get_first_paragraphs_min_words( get_the_content(), 30 ) ); ?>
                                <div class="text-end">
                                    <span class="success_card__read-more">Read More...</span>
                                </div>
                            </div>
                        </div>
                    </a>
                        <?php
                    } else {
                        ?>
                    <a href="<?= esc_url( get_the_permalink() ); ?>" class="success_card col-12 mb-4" data-category="<?= esc_attr( $category_class ); ?>">
                        <div class="success_card__content">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h2 class="success_card__title h5"><?= esc_html( get_the_title() ); ?></h2>
                                <div class="success_card__pill success_card__pill--grey"><?= esc_html( $first_category->name ); ?></div>
                            </div>
                            <p class="success_card__text">
                                <?= wp_kses_post( wp_trim_words( get_the_excerpt(), 20 ) ); ?>
                            </p>
                        </div>
                    </a>
                        <?php
                    }
                }
            } else {
                ?>
            <div class="alert alert-warning">
                <p>No successes found.</p>
            </div>
                <?php
            }
            ?>
            </div>
        <?php
            wp_reset_postdata();
        ?>
        </div>
    </div>
    <?php
    get_template_part( 'page-templates/blocks/lc_insights' );
    ?>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.button-filter');
    const cards = document.querySelectorAll('.success_card');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const filter = this.getAttribute('data-filter');

            buttons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            cards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');

                if (filter === 'all' || cardCategory === filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>


<?php get_footer(); ?>