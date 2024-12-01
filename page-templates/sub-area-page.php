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
        echo '- ' . $block['blockName'] . '<br>';
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
                ?>
            </div>
            <div class="col-lg-9">
                <?php
                the_content();
                ?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
