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
                $sidebar = get_field('sidebar', get_the_ID());
                if (!$sidebar) {
                    echo "NO SIDEBAR DEFINED";
                    $sidebar = 'Siblings'; // Default value if unset
                }

                if ($sidebar === 'Children') {
                    echo "SIDEBAR CHILDREN " . get_the_ID();
                    display_child_pages_with_sidebar_template(get_the_ID());
                } else if ($sidebar === 'Siblings') {
                    echo "SIDEBAR SIBLINGS " . get_the_ID();
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
                    echo render_block($block);
                }
                ?>
            </div>
        </div>
    </div>
    <hr>
    *** OLD CONTENT BELOW ***
    <hr>
    <?php
    get_template_part('page-templates/flexible-parts');
    ?>
</main>
<?php
get_footer();
