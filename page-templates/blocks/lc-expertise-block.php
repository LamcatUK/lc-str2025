<?php
/**
 * Expertise Block Template
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="expertise bg-grey-100 py-6">
    <div class="container-xl">
        <div class="row gy-4 justify-content-center">
            <?php
            $c = 0;
            while ( have_rows( 'expertise', 'option' ) ) {
                the_row();
                ?>
                <div class="col-md-4 px-0" data-aos="fade" data-aos-delay="<?= esc_attr( $c ); ?>">
                    <a class="expertise__card" href="<?= esc_url( get_the_permalink( get_sub_field( 'page' )[0] ) ); ?>">
                        <img src="<?= esc_url( get_sub_field( 'icon' ) ); ?>" alt="">
                        <h3><?= esc_html( get_sub_field( 'title' ) ); ?></h3>
                        <p class="show"><?= esc_html( get_sub_field( 'intro' ) ); ?></p>
                    </a>
                </div>
                <?php
                $c += 100;
            }
            ?>
        </div>
    </div>
</section>