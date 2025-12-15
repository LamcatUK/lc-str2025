<?php
/**
 * The template for displaying single success stories
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;

get_header();

?>
<main id="main" class="single-blog">
    <?php
    $content = get_the_content();
    $blocks  = parse_blocks( $content );
    $sidebar = array();
    $after;
    ?>
    <section class="breadcrumbs container-xl pb-2">
        <?php
        if ( function_exists( 'yoast_breadcrumb' ) ) {
            yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
        }
        ?>
    </section>
    <div class="container-xl">
        <div class="row g-4 pb-4">
            <div class="col-lg-9 order-2 order-lg-1">
                <h1 class="single-blog__title"><?= esc_html( get_the_title() ); ?>
                </h1>
                <div class="single-blog__read">
                    <?= wp_kses_post( estimate_reading_time_in_minutes( get_the_content(), 200, true, true ) ); ?>
                </div>
                <?php
                foreach ( $blocks as $block ) {
                    if ( 'core/heading' === $block['blockName'] ) {
                        if ( ! array_key_exists( 'level', $block['attrs'] ) ) {
                            $heading    = wp_strip_all_tags( $block['innerHTML'] );
                            $heading_id = sanitize_title( $heading );
                            echo '<a id="' . esc_attr( $heading_id ) . '" class="anchor"></a>';
                            $sidebar[ $heading ] = $heading_id;
                        }
                    }
                    echo apply_filters( 'the_content', render_block( $block ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }
                $categories = get_the_category( $post_id );

                if ( ! empty( $categories ) ) {
                    $first_category = $categories[0]; // This is a WP_Term object.
                    echo '<div class="mt-4 mb-5">';
                        echo wp_kses_post( phil_bio( $first_category->slug ) );
                        echo '</div>';
                }
                ?>
            </div>
            <div class="col-lg-3 order-1 order-lg-2">
                <div class="sidebar-insights">
                    <?php
                    if ( $sidebar ) {
                        ?>
                        <div class="quicklinks">
                            <div class="h5 has-line d-none d-lg-inline-block">Quick Links</div>
                            <button class="d-lg-none accordion-button collapsed h5" type="button" data-bs-toggle="collapse"
                                data-bs-target="#links" aria-expanded="true" aria-controls="links">Quick Links</button>
                            <div class="collapse d-lg-block" id="links">
                                <ul class="pt-3 pt-lg-0">
                                    <?php
                                    foreach ( $sidebar as $heading => $heading_id ) {
                                        ?>
                                        <li>
                                            <a href="#<?= esc_attr( $heading_id ); ?>"><?= esc_html( $heading ); ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="sidebar-insights__cta mt-3 d-none d-lg-block">
                        <div class="fw-600 mb-3">Contact Stormcatcher for First Free Advice</div>
                        <div class="d-flex gap-2 justify-content-center align-items-center">
                            <a href="<?= esc_url( 'tel:' . parse_phone( get_field( 'contact_phone', 'option' ) ) ); ?>" class="button button-primary"><i class="fas fa-phone"></i> Call</a>
                            <a href="<?= esc_url( 'mailto:' . antispambot( get_field( 'contact_email', 'option' ) ) ); ?>" class="button button-primary"><i class="fas fa-paper-plane"></i> Email</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>