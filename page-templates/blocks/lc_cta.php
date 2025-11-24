<?php
/**
 * CTA block template.
 *
 * Adds a brief description for tooling and linting.
 *
 * @package lc-str2025
 */

$class = $block['className'] ?? 'my-5';
?>
<section class="cta" data-aos="fade">
    <div class="container-xl">
        <div class="cta__inner text-center p-4  <?= esc_attr( $class ); ?>">
            <?php
            if ( get_field( 'pre_title' ) ?? null ) {
                ?>
                <div class="text-uppercase fw-bold pb-2"><?= esc_html( get_field( 'pre_title' ) ); ?></div>
                <?php
            }
            if ( get_field( 'title' ) ?? null ) {
                ?>
                <div class="h3"><?= esc_html( get_field( 'title' ) ); ?></div>
                <?php
            }
            if ( get_field( 'content' ) ?? null ) {
                ?>
                <div class="pb-4"><?= wp_kses_post( get_field( 'content' ) ); ?></div>
                <?php
            }
            ?>
            <a href="/contact/" class="button button-primary">
                <i class="fas fa-paper-plane"></i> Message
            </a>
            <a href="tel:<?= esc_attr( parse_phone( get_field( 'contact_phone', 'option' ) ) ); ?>" class="button button-primary">
                <i class="fas fa-phone"></i> Call<span class="d-none d-md-inline">: <?= esc_html( get_field( 'contact_phone', 'option' ) ); ?></span>
            </a>
            <a href="mailto:<?= esc_attr( get_field( 'contact_email', 'option' ) ); ?>" class="button button-primary"><i class="fas fa-envelope"></i>
                Email
            </a>
        </div>
    </div>
</section>