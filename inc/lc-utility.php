<?php

function parse_phone($phone)
{
    $phone = preg_replace('/\s+/', '', $phone);
    $phone = preg_replace('/\(0\)/', '', $phone);
    $phone = preg_replace('/[\(\)\.]/', '', $phone);
    $phone = preg_replace('/-/', '', $phone);
    $phone = preg_replace('/^0/', '+44', $phone);
    return $phone;
}

function split_lines($content)
{
    $content = preg_replace('/<br \/>/', '<br/>&nbsp;<br/>', $content);
    return $content;
}

function textarea_array($content)
{
    // Replace <br> tags with newline characters
    $string_with_newlines = str_replace('<br />', "\n", $content);

    // Split the string by newline characters into an array
    $array_of_values = explode("\n", $string_with_newlines);

    // Trim whitespace from each value and remove empty values
    $array_of_values = array_map('trim', $array_of_values);
    $array_of_values = array_filter($array_of_values, function ($value) {
        return !empty($value);
    });

    return $array_of_values;
}

add_shortcode('contact_address', 'contact_address');

function contact_address()
{
    $output = get_field('contact_address', 'options');
    return $output;
}

add_shortcode('contact_phone', 'contact_phone');

function contact_phone($atts)
{

    $atts = shortcode_atts(
        array(
            'text' => '',
        ),
        $atts
    );

    $phone_number = get_field('contact_phone', 'options');

    if ($phone_number) {
        $link_text = $atts['text'] ? $atts['text'] : $phone_number;
        return '<a href="tel:' . parse_phone($phone_number) . '">' . esc_html($link_text) . '</a>';
    }
    return '';
}

add_shortcode('contact_email', 'contact_email');

function contact_email($atts)
{

    $atts = shortcode_atts(
        array(
            'text' => '',
        ),
        $atts
    );

    $email_address = get_field('contact_email', 'options');

    if ($email_address) {
        $link_text = $atts['text'] ? $atts['text'] : $email_address;
        return '<a href="mailto:' . $email_address . '">' . esc_html($link_text) . '</a>';
    }
    return;
}


add_shortcode('social_in_icon', function () {
    $s = get_field('social', 'options') ?? null;
    if ($s['linkedin_url'] ?? null) {
        return '<a href="' . get_field('linkedin_url', 'options') . '" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>';
    }
    return;
});
add_shortcode('social_tw_icon', function () {
    $s = get_field('social', 'options') ?? null;
    if ($s['twitter_url'] ?? null) {
        return '<a href="' . get_field('twitter_url', 'options') . '" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>';
    }
    return;
});

add_shortcode('social_icons', 'social_icons');

function social_icons($size = null)
{

    $s = get_field('socials', 'options');
    // echo '<pre>' . var_dump($s) . '</pre>';

    $output = '<div class="social_icons">';
    if ($s['linkedin_url'] ?? null) {
        $output .= '<a href="' . $s['linkedin_url'] . '" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in fa-2x"></i></a>';
    }
    if ($s['instagram_url'] ?? null) {
        $output .= '<a href="' . $s['instagram_url'] . '" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram fa-2x"></i></a>';
    }
    if ($s['facebook_url'] ?? null) {
        $output .= '<a href="' . $s['facebook_url'] . '" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa-brands fa-facebook-f fa-2x"></i></a>';
    }
    if ($s['twitter_url'] ?? null) {
        $output .= '<a href="' . $s['twitter_url'] . '" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fa-brands fa-x-twitter fa-2x"></i></a>';
    }
    if ($s['youtube_url'] ?? null) {
        $output .= '<a href="' . $s['youtube_url'] . '" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa-brands fa-youtube fa-2x"></i></a>';
    }
    if ($s['tiktok_url'] ?? null) {
        $output .= '<a href="' . $s['tiktok_url'] . '" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="fa-brands fa-tiktok fa-2x"></i></a>';
    }
    $output .= '</div>';

    return $output;
}

function gb_gutenberg_admin_styles()
{
    echo '
        <style>
            /* Main column width */
            .wp-block {
                max-width: 1040px;
            }
 
            /* Width of "wide" blocks */
            .wp-block[data-align="wide"] {
                max-width: 1080px;
            }
 
            /* Width of "full-wide" blocks */
            .wp-block[data-align="full"] {
                max-width: none;
            }	
        </style>
    ';
}
add_action('admin_head', 'gb_gutenberg_admin_styles');



function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces[] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}


function lc_list($field)
{
    ob_start();
    $field = strip_tags($field, '<br />');
    $bullets = preg_split("/\r\n|\n|\r/", $field);
    foreach ($bullets as $b) {
        if ($b == '') {
            continue;
        }
?>
        <li><?= $b ?></li>
<?php
    }
    return ob_get_clean();
}

function formatBytes($bytes, $precision = 2)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    // $bytes /= pow(1024, $pow);
    $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}

// REMOVE TAG AND COMMENT SUPPORT

// Disable Tags Dashboard WP
// add_action('admin_menu', 'my_remove_sub_menus');

function my_remove_sub_menus()
{
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}
// Remove tags support from posts
function myprefix_unregister_tags()
{
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'myprefix_unregister_tags');

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

function remove_comments()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'remove_comments');

// Remove comment-reply.min.js from footer
function remove_comment_reply_header_hook()
{
    wp_deregister_script('comment-reply');
}
add_action('init', 'remove_comment_reply_header_hook');

add_action('admin_menu', 'remove_comments_menu');
function remove_comments_menu()
{
    remove_menu_page('edit-comments.php');
}

add_filter('theme_page_templates', 'child_theme_remove_page_template');
function child_theme_remove_page_template($page_templates)
{
    // unset($page_templates['page-templates/blank.php'],$page_templates['page-templates/empty.php'], $page_templates['page-templates/fullwidthpage.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    unset($page_templates['page-templates/blank.php'], $page_templates['page-templates/empty.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    return $page_templates;
}
add_action('after_setup_theme', 'remove_understrap_post_formats', 11);
function remove_understrap_post_formats()
{
    remove_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));
}


function estimate_reading_time_in_minutes($content = '', $words_per_minute = 300, $with_gutenberg = false, $formatted = false)
{
    // In case if content is build with gutenberg parse blocks
    if ($with_gutenberg) {
        $blocks = parse_blocks($content);
        $contentHtml = '';

        foreach ($blocks as $block) {
            $contentHtml .= render_block($block);
        }

        $content = $contentHtml;
    }

    // Remove HTML tags from string
    $content = wp_strip_all_tags($content);

    // When content is empty return 0
    if (!$content) {
        return 0;
    }

    // Count words containing string
    $words_count = str_word_count($content);

    // Calculate time for read all words and round
    $minutes = ceil($words_count / $words_per_minute);

    if ($formatted) {
        $minutes = '<p class="reading">Estimated reading time ' . $minutes . ' ' . pluralise($minutes, 'minute') . '</p>';
    }

    return $minutes;
}

function pluralise($quantity, $singular, $plural = null)
{
    if ($quantity == 1 || !strlen($singular)) {
        return $singular;
    }
    if ($plural !== null) {
        return $plural;
    }

    $last_letter = strtolower($singular[strlen($singular) - 1]);
    switch ($last_letter) {
        case 'y':
            return substr($singular, 0, -1) . 'ies';
        case 's':
            return $singular . 'es';
        default:
            return $singular . 's';
    }
}

function get_wp_menus()
{
    $menus = wp_get_nav_menus();
    $menu_options = array();

    foreach ($menus as $menu) {
        $menu_options[$menu->term_id] = $menu->name;
    }

    return $menu_options;
}

function acf_load_menu_field_choices($field)
{
    // Reset choices
    $field['choices'] = array();

    // Get menus
    $menus = get_wp_menus();

    // Populate choices
    if (!empty($menus)) {
        foreach ($menus as $key => $value) {
            $field['choices'][$key] = $value;
        }
    }

    return $field;
}
add_filter('acf/load_field/name=sidebar_menu', 'acf_load_menu_field_choices');

// show template name in admin
function add_page_template_column($columns)
{
    $columns['page_template'] = 'Template';
    return $columns;
}
add_filter('manage_pages_columns', 'add_page_template_column');

function display_page_template_column($column, $post_id)
{
    if ($column === 'page_template') {
        $template = get_page_template_slug($post_id);

        if ($template) {
            // Get the human-readable name of the template
            $templates = wp_get_theme()->get_page_templates();
            echo isset($templates[$template]) ? esc_html($templates[$template]) : esc_html($template);
        } else {
            echo 'Default Template';
        }
    }
}
add_action('manage_pages_custom_column', 'display_page_template_column', 10, 2);

function make_page_template_column_sortable($columns)
{
    $columns['page_template'] = 'page_template';
    return $columns;
}
add_filter('manage_edit-page_sortable_columns', 'make_page_template_column_sortable');

function sort_page_template_column($query)
{
    if (!is_admin() || !$query->is_main_query() || $query->get('orderby') !== 'page_template') {
        return;
    }

    $query->set('meta_key', '_wp_page_template');
    $query->set('orderby', 'meta_value');
}
add_action('pre_get_posts', 'sort_page_template_column');

function get_first_paragraphs_min_words( $content, $min_words = 20 ) {
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );
    preg_match_all( '/<p>(.*?)<\/p>/is', $content, $matches );
    $paragraphs = $matches[0] ?? [];
    $output = '';
    $word_count = 0;

    foreach ( $paragraphs as $p ) {
        $output .= $p;
        $word_count += str_word_count( wp_strip_all_tags( $p ) );
        if ( $word_count >= $min_words ) {
            break;
        }
    }
    return $output;
}

?>