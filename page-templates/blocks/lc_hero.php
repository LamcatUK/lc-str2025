<?php
/**
 * LC Hero Block Template.
 *
 * @package lc-str2025
 */

! defined( 'ABSPATH' ) && exit;

$c = is_front_page() === 1 ? 'home_hero' : '';
?>
<section class="hero <?= esc_attr( $c ); ?>">
    <!-- Background Image -->
    <?= wp_get_attachment_image( get_field( 'background' ), 'full', false, array( 'class' => 'hero__bg' ) ); ?>
    <div class="overlay"></div>
    <div class="container-xl py-6 my-auto">
        <div class="row g-4">
            <div class="col-md-8">
        <?php
        $c = 0;
        if ( get_field( 'pre_title' ) ?? null ) {
            ?>
            <div class="pre-title" data-aos="fadein" data-aos-delay="<?= esc_attr( $c ); ?>"><?= esc_html( get_field( 'pre_title' ) ); ?></div>
            <?php
            $c += 200;
        }
        ?>
        <h1 data-aos="fadein" data-aos-delay="<?= esc_attr( $c ); ?>"><?= esc_html( get_field( 'title' ) ); ?></h1>
        <?php
        $c += 200;
        if ( get_field( 'content' ) ?? null ) {
            ?>
            <div class="content" data-aos="fadein" data-aos-delay="<?= esc_attr( $c ); ?>"><?= esc_html( get_field( 'content' ) ); ?></div>
            <?php
            $c += 200;
        }
        ?>
        <?php
        if ( get_field( 'cta' ) ?? null ) {
            $l = get_field( 'cta' );
            ?>
            <div data-aos="fadein" data-aos-delay="<?= esc_attr( $c ); ?>">
                <a href="<?= esc_url( $l['url'] ); ?>" target="<?= esc_attr( $l['target'] ); ?>" class="button button-primary"><?= esc_html( $l['title'] ); ?></a>
            </div>
            <?php
        }
        ?>
            </div>
            <div class="col-md-4 my-auto" data-aos="fadein" data-aos-delay="<?= esc_attr( $c + 200 ); ?>">
                <div class="badge mt-4" style="min-height:140px;">
                    <?= do_shortcode( '[trustindex data-widget-id=a23e05058af5912541863bba2b3]' ); ?>
                </div>
            </div>
        </div>
    </div>
</section>