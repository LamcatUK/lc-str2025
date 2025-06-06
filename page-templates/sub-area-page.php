<?php
/* Template Name: Sub-Area Page */
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$content = get_post_field('post_content', $post_id);
$blocks = parse_blocks($content);

?>
<main>
    <?php
    foreach ($blocks as $block) {
        if (isset($block['blockName']) && $block['blockName'] === 'acf/lc-hero') {
            echo render_block($block);
            // return; // Output only the first instance of the hero block
        }
        if (isset($block['blockName']) && $block['blockName'] === 'acf/lc-breadcrumbs') {
            echo render_block($block);
            // return; // Output only the first instance of the hero block
        }
    }
    ?>
    <div class="container-xl">
        <?php
        if (display_child_pages_with_sidebar_template(get_the_ID()) !== null) {
        ?>
            <div class="row g-4">
                <div class="col-lg-3">
                    <?=
                    display_child_pages_with_sidebar_template(get_the_ID());
                    ?>
                </div>
                <div class="col-lg-9">
                    <?php
                    foreach ($blocks as $block) {
                        if (isset($block['blockName']) && $block['blockName'] === 'acf/lc-hero') {
                            continue; // Skip this block
                        }
                        if (isset($block['blockName']) && $block['blockName'] === 'acf/lc-breadcrumbs') {
                            continue;
                        }
                        echo render_block($block);
                    }
                    ?>
                </div>
            </div>
        <?php
        } else {
            foreach ($blocks as $block) {
                if (isset($block['blockName']) && $block['blockName'] === 'acf/lc-hero') {
                    continue; // Skip this block
                }
                if (isset($block['blockName']) && $block['blockName'] === 'acf/lc-breadcrumbs') {
                    continue;
                }
                echo render_block($block);
            }
        }
        
        if ( has_category() ) {
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                $first_category = $categories[0]; // This is a WP_Term object.
                echo '<div class="mt-4 mb-5">';
                echo wp_kses_post( phil_bio( $first_category->slug ) );
                echo '</div>';
            }
        }
        ?>
    </div>
</main>
<?php
get_footer();
