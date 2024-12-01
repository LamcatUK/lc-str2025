<?php
/* Template Name: Sidebar Page */
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$content = get_post_field('post_content', $post_id);
$blocks = parse_blocks($content);

function get_sibling_pages_with_sidebar_template($post_id)
{
    // Get the parent of the current page
    $parent_id = wp_get_post_parent_id($post_id);

    // If no parent, consider it a top-level page
    $parent_id = $parent_id ? $parent_id : $post_id;

    // Query for sibling pages
    $siblings = get_pages([
        'post_parent'    => $parent_id,
        'post_type'      => 'page',
        'post_status'    => 'publish',
    ]);

    // Filter siblings to include only those with the 'sidebar-page.php' template
    $sidebar_pages = array_filter($siblings, function ($page) {
        return get_page_template_slug($page->ID) === 'sidebar-page.php';
    });

    return $sidebar_pages;
}

function display_sibling_pages_with_sidebar_template($post_id)
{
    // Get sibling pages using the function
    $siblings = get_sibling_pages_with_sidebar_template($post_id);

    if (!empty($siblings)) {
        echo '<ul class="sibling-pages">';
        foreach ($siblings as $sibling) {
            echo '<li><a href="' . esc_url(get_permalink($sibling->ID)) . '">' . esc_html($sibling->post_title) . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No sibling pages found with the sidebar template.</p>';
    }
}

function get_child_pages_with_sidebar_template($post_id)
{
    // Query for child pages
    $children = get_pages([
        'post_parent'    => $post_id,
        'post_type'      => 'page',
        'post_status'    => 'publish',
    ]);

    // Filter children to include only those with the 'sidebar-page.php' template
    $sidebar_children = array_filter($children, function ($page) {
        return get_page_template_slug($page->ID) === 'sidebar-page.php';
    });

    return $sidebar_children;
}

function display_child_pages_with_sidebar_template($post_id)
{
    // Get child pages using the function
    $children = get_child_pages_with_sidebar_template($post_id);

    if (!empty($children)) {
        echo '<ul class="child-pages">';
        foreach ($children as $child) {
            echo '<li><a href="' . esc_url(get_permalink($child->ID)) . '">' . esc_html($child->post_title) . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No child pages found with the sidebar template.</p>';
    }
}

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
                    if (get_field('sidebar') == 'Show Children') {
                        display_child_pages_with_sidebar_template(get_the_ID());
                    } else {
                        display_sibling_pages_with_sidebar_template(get_the_ID());
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
