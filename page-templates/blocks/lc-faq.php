<?php
/**
 * FAQ Block Template
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;

$class = $block['className'] ?? 'py-5';
?>
<section class="faq_block <?= esc_attr( $class ); ?>">
    <div class="container-xl">
        <?php
        if ( get_field( 'faq_title' ) ) {
            ?>
            <div class="center-container">
                <h2 class="mb-4">
                    <?= esc_html( get_field( 'faq_title' ) ); ?>
                </h2>
            </div>
            <?php
        }
        if ( get_field( 'faq_intro' ) ) {
            ?>
            <div class="mb-5 faq_intro text-center w-constrained">
                <?= esc_html( get_field( 'faq_intro' ) ); ?>
            </div>
            <?php
        }
        ?>
        <div class="faq_block__inner">
            <?php
            $accordion = random_str( 5 );

            echo '<div itemscope="" itemtype="https://schema.org/FAQPage" id="accordion' . esc_attr( $accordion ) . '" class="accordion">';
            $counter   = 0;
            $show      = '';
            $collapsed = 'collapsed';


            $expanded = 'false';
            $collapse = '';
            $button   = 'collapsed';

            while ( have_rows( 'faq' ) ) {
                the_row();
                $ac = $accordion . '_' . $counter;
                ?>
                <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question" class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button fs-500 <?= esc_attr( $button ); ?>"
                            itemprop="name" type="button" data-bs-toggle="collapse"
                            data-bs-target="#c<?= esc_attr( $ac ); ?>"
                            aria-expanded="<?= esc_attr( $expanded ); ?>"
                            aria-controls="c<?= esc_attr( $ac ); ?>">
                            <?= esc_html( get_sub_field( 'question' ) ); ?>
                        </button>
                    </div>
                    <div id="c<?= esc_attr( $ac ); ?>"
                        class="collapse <?= esc_attr( $show ); ?>" itemscope=""
                        itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"
                        data-bs-parent="#accordion<?= esc_attr( $accordion ); ?>">
                        <div class="accordion-body" itemprop="text">
                            <?= esc_html( get_sub_field( 'answer' ) ); ?>
                        </div>
                    </div>
                </div>
                <?php
                ++$counter;
                $show      = '';
                $collapsed = 'collapsed';
            }
            echo '</div>';
            ?>
        </div>
    </div>
</section>