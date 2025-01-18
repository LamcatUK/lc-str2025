<?php
/* Template Name: Sidebar Page */
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
        <div class="row">
            <div class="col-lg-3">
                <?php
                $sidebar = get_field('sidebar', get_the_ID()) ?? 'Siblings';

                if ($sidebar === 'Children') {
                    echo display_child_pages_with_sidebar_template(get_the_ID());
                } else if ($sidebar === 'Siblings') {
                    display_sibling_pages_with_sidebar_template(get_the_ID());
                }
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
                    // echo render_block($block);
                    $block_content = render_block($block);
                    echo do_shortcode($block_content);
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    get_template_part('page-templates/blocks/lc_insights');
    /*
    ?>
    <hr>
    *** OLD CONTENT BELOW ***
    <hr>
    <?php
    get_template_part('page-templates/flexible-parts');
    */
    ?>
</main>
<?php
get_footer();
