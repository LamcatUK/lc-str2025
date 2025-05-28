<?php
/**
 * Template Name: Sidebar Page
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;

get_header();

$content = get_post_field( 'post_content', $post_id );
$blocks  = parse_blocks( $content );

?>
<main>
    <?php
    foreach ( $blocks as $block ) {
        if ( isset( $block['blockName'] ) && 'acf/lc-hero' === $block['blockName'] ) {
            echo render_block( $block );
        }
        if ( isset( $block['blockName'] ) && 'acf/lc-breadcrumbs' === $block['blockName'] ) {
            echo render_block( $block );
        }
    }
    ?>
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-lg-3">
                <?php

                $sidebar = get_field( 'sidebar', get_the_ID() ) ?? 'Siblings';

                if ( 'Children' === $sidebar ) {
                    display_child_pages_with_sidebar_template( get_the_ID() );
                } elseif ( 'Siblings' === $sidebar ) {
                    display_sibling_pages_with_sidebar_template( get_the_ID() );
                }
                ?>
            </div>
            <div class="col-lg-9">
                <?php
                foreach ( $blocks as $block ) {
                    if ( isset( $block['blockName'] ) && 'acf/lc-hero' === $block['blockName'] ) {
                        continue; // Skip this block.
                    }
                    if ( isset( $block['blockName'] ) && 'acf/lc-breadcrumbs' === $block['blockName'] ) {
                        continue;
                    }
                    $block_content = render_block( $block );
                    echo do_shortcode( $block_content );
                }

                if ( has_category() ) {
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        $first_category = $categories[0]; // This is a WP_Term object.
                        echo '<div class="mt-4">';
                        echo wp_kses_post( phil_bio( $first_category->slug ) );
                        echo '</div>';
                    }
                }

                ?>
            </div>
        </div>
    </div>
    <?php
    get_template_part( 'page-templates/blocks/lc_insights' );
    ?>
</main>
<?php
get_footer();
