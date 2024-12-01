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
            <div class="col-md-3">
                <ul class="sidebar">
                    <?php
                    foreach (get_field('sidebar') as $s) {
                    ?>
                        <li><a href="<?= get_the_permalink($s) ?>"><?= get_the_title($s) ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-9">
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
