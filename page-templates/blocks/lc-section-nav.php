<?php
/**
 * Section Navigation Block Template
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section_nav">
    <div class="container-xl py-6">
        <?php
        if ( get_field( 'block_title' ) ?? null ) {
            echo '<h2 class="h3">' . wp_kses_post( get_field( 'block_title' ) ) . '</h2>';
        }

        $titles = array();

        $content = get_the_content();
        $blocks  = parse_blocks( $content );

        foreach ( $blocks as $block ) {

            if ( 'core/heading' === $block['blockName'] ) {
                // Check if 'level' is not set or explicitly set to 2 (H2).
                $level = isset( $block['attrs']['level'] ) ? $block['attrs']['level'] : 2; // Default to 2 if not set.
                if ( 2 === $level ) {
                    $heading              = wp_strip_all_tags( $block['innerHTML'] );
                    $anchor_id            = sanitize_title( $heading );
                    $titles[ $anchor_id ] = $heading;
                }
            }
            if ( isset( $block['blockName'] ) && strpos( $block['blockName'], 'acf/' ) === 0 ) {
                if ( 'acf/lc-hero' === $block['blockName'] ) {
                    continue;
                }
                $acf_title = '';
                if ( ! empty( $block['attrs']['data']['title'] ) ) {
                    $titles[] = $block['attrs']['data']['title'];
                }
            }
        }

        ?>
        <ul class="cols-lg-2">
            <?php
            foreach ( $titles as $t ) {
                $anchor_id = sanitize_title( $t );
                ?>
                <li><a href="#<?= esc_html( $anchor_id ); ?>"><?= esc_html( $t ); ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
</section>