<?php
/**
 * LC Theme Functions
 *
 * This file contains the main functions and hooks for the LC Theme.
 * It includes widget initialization, theme support, custom shortcodes,
 * and other WordPress customizations.
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;

require_once LC_THEME_DIR . '/inc/lc-utility.php';
require_once LC_THEME_DIR . '/inc/lc-blocks.php';

/**
 * Initializes widgets and registers navigation menus.
 *
 * This function sets up theme support, registers navigation menus,
 * and unregisters default sidebars and menus.
 */
function widgets_init() {

    register_nav_menus(
        array(
            'primary_nav'   => 'Primary Nav',
            'footer_menu_1' => 'Footer Expertise',
            'footer_menu_2' => 'Footer Links',
        )
    );

    unregister_sidebar( 'hero' );
    unregister_sidebar( 'herocanvas' );
    unregister_sidebar( 'statichero' );
    unregister_sidebar( 'left-sidebar' );
    unregister_sidebar( 'right-sidebar' );
    unregister_sidebar( 'footerfull' );
    unregister_nav_menu( 'primary' );

    add_theme_support( 'disable-custom-colors' );
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => 'Black',
                'slug'  => 'black',
                'color' => '#313747',
            ),
            array(
                'name'  => 'White',
                'slug'  => 'white',
                'color' => '#ffffff',
            ),
            array(
                'name'  => 'Light Grey',
                'slug'  => 'grey-100',
                'color' => '#f4f4f4',
            ),
            array(
                'name'  => 'Mid Grey',
                'slug'  => 'grey-400',
                'color' => '#e6e6e6',
            ),
            array(
                'name'  => 'Ocean Tide',
                'slug'  => 'primary-400',
                'color' => '#00555a',
            ),
            array(
                'name'  => 'Deep Sea',
                'slug'  => 'secondary-400',
                'color' => '#003349',
            ),
        )
    );
}
add_action( 'widgets_init', 'widgets_init', 11 );

remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );


/**
 * Registers a custom dashboard widget for the WordPress admin area.
 *
 * This widget displays a custom message and contact information
 * for the Lamcat theme.
 */
function register_lc_dashboard_widget() {
    wp_add_dashboard_widget(
        'lc_dashboard_widget',
        'Lamcat',
        'lc_dashboard_widget_display'
    );
}
add_action( 'wp_dashboard_setup', 'register_lc_dashboard_widget' );

/**
 * Displays the content of the custom dashboard widget.
 *
 * This function outputs the HTML for the Lamcat dashboard widget,
 * including an image, a contact button, and a message.
 */
function lc_dashboard_widget_display() {
    ?>
    <div style="display: flex; align-items: center; justify-content: space-around;">
        <img style="width: 50%;"
            src="<?= esc_url( get_stylesheet_directory_uri() . '/img/lc-full.jpg' ); ?>">
        <a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer"
            href="mailto:hello@lamcat.co.uk">Contact</a>
    </div>
    <div>
        <p><strong>Thanks for choosing Lamcat!</strong></p>
        <hr>
        <p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
        <p>Use the link above to get in touch and we'll get back to you ASAP.</p>
    </div>
    <?php
}


/**
 * Enqueues theme styles and scripts.
 *
 * This function deregisters jQuery, enqueues external libraries like Splide and AOS,
 * and includes the theme's custom styles and scripts with versioning based on file modification time.
 */
function lc_theme_enqueue() {
    $the_theme = wp_get_theme();
    $theme_version = $the_theme->get( 'Version' );

    $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    // Grab asset urls.
    $theme_styles  = "/css/child-theme{$suffix}.css";
    $theme_scripts = "/js/child-theme{$suffix}.js";

    // $css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles ); // phpcs.ignore
    $css_version = $theme_version;

    wp_deregister_script( 'jquery' );

    wp_enqueue_script( 'splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js', array(), null, true );
    wp_enqueue_style( 'splide-style', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css', array() );

    wp_enqueue_script( 'aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true );
    wp_enqueue_style( 'aos-style', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array() );

    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );

    // $js_version = $theme_version . '.' . filemtime(get_stylesheet_directory() . $theme_scripts); // phpcs.ignore
    $js_version = $theme_version;

    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true );
}
add_action( 'wp_enqueue_scripts', 'lc_theme_enqueue' );


add_filter( 'wpcf7_autop_or_not', '__return_false' );

add_action(
    'admin_head',
    function () {
        echo '<style>
    .block-editor-page #wpwrap {
        overflow-y: auto !important;
    }
    </style>';
    }
);

/**
 * Adds a search icon to the primary navigation menu.
 *
 * @param string $items The HTML list content for the menu items.
 * @param object $args  An object containing wp_nav_menu() arguments.
 * @return string Modified HTML list content with the search icon.
 */
function add_search_to_nav( $items, $args ) {
    if ( 'primary_nav' !== $args->theme_location ) {
        return $items;
    }

    $link   = '<li class="menu-item nav-item"><a href="/search/" class="nav-link" title="Search"><i class="fas fa-magnifying-glass"></i></a>';
    $items .= $link;

    return $items;
}
add_action( 'wp_nav_menu_items', 'add_search_to_nav', 10, 2 );


/**
 * Customizes the WordPress login page logo.
 *
 * This function replaces the default WordPress login logo with a custom logo
 * specified by the `$custom_logo_url` variable.
 */
function custom_login_logo() {
    $custom_logo_url = '/wp-content/themes/lc-str2025/img/stormcatcher--dk.svg';
    echo '
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(' . $custom_logo_url . ');
                width: 302px;
                height: 64px;
                background-size: contain;
                background-repeat: no-repeat;
                padding-bottom: 1rem;
            }
        </style>
    ';
}
add_action( 'login_enqueue_scripts', 'custom_login_logo' );

add_action(
    'admin_init',
    function () {
        define( 'DISALLOW_FILE_EDIT', true );
    }
);

/**
 * Generates a Splide slider based on provided image IDs.
 *
 * @param array $atts Shortcode attributes, including 'ids' for image IDs.
 * @return string HTML content for the Splide slider or a fallback message.
 */
function splide_slider_shortcode($atts) {
    // Parse the attributes passed to the shortcode.
    $atts = shortcode_atts(
        array(
            'ids' => '', // List of image IDs, default is empty.
        ),
        $atts,
        'splide_slider'
    );

    // Convert the comma-separated IDs into an array.
    $image_ids = array_filter( array_map( 'trim', explode( ',', $atts['ids'] ) ) );

    if ( empty( $image_ids ) ) {
        return '<p>No images provided for the slider.</p>'; // Fallback if no IDs are passed.
    }

    // Start building the HTML for the Splide slider.
    ob_start(); // Start output buffering to capture the slider HTML.
    $unique_id = 'splide-slider-' . uniqid();
?>
    <div id="<?= $unique_id ?>" class="splide splide-shortcode">
        <div class="splide__track">
            <ul class="splide__list">
                <?php foreach ($image_ids as $image_id) :
                    $image_url = wp_get_attachment_image_url($image_id, 'full'); // Get image URL by ID
                    if ($image_url) : ?>
                        <li class="splide__slide">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>">
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('#<?= $unique_id ?>', {
                type: 'loop',
                perPage: 3,
                perMove: 1,
                autoplay: true,
                interval: 2500,
                pauseOnHover: true,
                arrows: false,
                pagination: false,
                breakpoints: {
                    576: {
                        perPage: 1, // Mobile: show 1 slide per page
                        heightRatio: 0.75 // Adjust the height ratio for a taller display on mobile
                    },
                    768: {
                        perPage: 2, // Tablet: show 2 slides per page
                        heightRatio: 0.5 // Adjust height to look balanced
                    },
                    1024: {
                        perPage: 3, // Desktop: show 3 slides per page
                        heightRatio: 0.4 // Adjust height ratio for desktop
                    },
                },
            }).mount();
        });
    </script>
<?php
    return ob_get_clean(); // Return the captured HTML
}
add_shortcode('splide_slider', 'splide_slider_shortcode');

add_filter('wpseo_breadcrumb_links', 'add_expertise_breadcrumb');
function add_expertise_breadcrumb($links)
{
    // Define the pages where 'Expertise' should be added
    $expertise_pages = [
        'automotive-law',
        'consumer-law',
        'construction-law',
        'civil-fraud',
        'dispute-resolution-lawyers',
        'yacht-law'
    ];

    // Get the current post object
    global $post;

    if ($post) {
        // Get the top-level parent or the current post's slug
        $top_level_slug = get_post_field('post_name', get_post_ancestors($post->ID)[0] ?? $post->ID);

        // Check if the current page or one of its ancestors is in the list
        if (in_array($top_level_slug, $expertise_pages)) {
            // Create the 'Expertise' breadcrumb link
            $expertise_link = [
                'url' => home_url('/expertise/'),
                'text' => 'Expertise'
            ];

            // Insert the 'Expertise' link before the current page link
            array_splice($links, 1, 0, [$expertise_link]);
        }
    }

    return $links;
}

// function add_success_cpt_to_yoast_breadcrumbs($links)
// {
//     // Check if we're on a single "success" post
//     if (is_singular('success')) {
//         // Get the archive link for the custom post type
//         $post_type_archive = get_post_type_archive_link('success');

//         // Add a new breadcrumb link for the custom post type archive
//         $breadcrumb = [
//             'url'  => home_url('/success-stories/'),
//             'text' => 'Success Stories',
//         ];

//         // Insert the new breadcrumb before the current post breadcrumb
//         array_splice($links, -1, 0, [$breadcrumb]);
//     }

//     return $links;
// }
// add_filter('wpseo_breadcrumb_links', 'add_success_cpt_to_yoast_breadcrumbs');

add_filter('nav_menu_css_class', function ($classes, $item, $args, $depth) {
    // Check if we're on the "Success" archive or a single "Success" post
    if (is_post_type_archive('success') || is_singular('success')) {
        // Get the blog page ID
        $blog_page_id = get_option('page_for_posts');

        // Forcefully remove current_page_parent from the blog menu item
        if (isset($item->object_id) && $item->object_id == $blog_page_id) {
            $classes = array_filter($classes, function ($class) {
                return $class !== 'current_page_parent';
            });
        }
    }

    return $classes;
}, 10, 4);

function correct_success_stories_canonical($canonical)
{
    if (is_singular('success')) {
        $canonical = home_url('/success-stories/' . get_post_field('post_name', get_queried_object()));
    }
    return $canonical;
}
add_filter('wpseo_canonical', 'correct_success_stories_canonical');



function get_sibling_pages_with_sidebar_template($post_id)
{
    // Get the parent of the current page
    $parent_id = wp_get_post_parent_id($post_id);

    // If no parent, consider it a top-level page
    $parent_id = $parent_id ? $parent_id : $post_id;

    $args = [
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'post_parent'    => $parent_id,
        'posts_per_page' => -1, // Fetch all children
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ];

    $query = new WP_Query($args);

    // Filter siblings to include only those with the 'sidebar-page.php' template
    $sidebar_pages = array_filter($query->posts, function ($page) {
        return get_page_template_slug($page->ID) === 'page-templates/sidebar-page.php';
    });

    return $sidebar_pages;
}

function display_sibling_pages_with_sidebar_template($post_id)
{
    // Get sibling pages using the function
    $siblings = get_sibling_pages_with_sidebar_template($post_id);

    $parent_id = wp_get_post_parent_id($post_id);

    // If no parent, consider it a top-level page
    $parent_id = $parent_id ? $parent_id : $post_id;

    if (!empty($siblings)) {
        echo '<div class="sidebar sibling-pages">';
        echo '<h3><a href="' . get_the_permalink($parent_id) . '">' . get_the_title($parent_id) . '</a></h3>';
        echo '<ul>';
        foreach ($siblings as $sibling) {
            $active = ($sibling->ID == get_the_ID()) ? 'active' : '';
            echo '<li><a href="' . esc_url(get_permalink($sibling->ID)) . '" class="' . $active . '">' . esc_html($sibling->post_title) . '</a></li>';
        }
        echo '</ul></div>';
    } else {
        echo '<p>No sibling pages found with the sidebar template.</p>';
    }
}

function get_child_pages_with_sidebar_template($post_id)
{

    $args = [
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'post_parent'    => $post_id,
        'posts_per_page' => -1, // Fetch all children
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ];

    $query = new WP_Query($args);

    $sidebar_children = array_filter($query->posts, function ($page) {
        return get_page_template_slug($page->ID) === 'page-templates/sidebar-page.php';
    });

    // Reset post data after custom query
    wp_reset_postdata();

    return $sidebar_children;
}

function display_child_pages_with_sidebar_template($post_id)
{
    // Get child pages using the function
    $children = get_child_pages_with_sidebar_template($post_id);

    if (!empty($children)) {
        $output = '<div class="sidebar child-pages">';
        $output .= '<h3><a href="' . get_the_permalink($post_id) . '">' . get_the_title($post_id) . '</a></h3>';
        $output .= '<ul>';
        foreach ($children as $child) {
            $output .= '<li><a href="' . esc_url(get_permalink($child->ID)) . '">' . esc_html($child->post_title) . '</a></li>';
        }
        $output .= '</ul></div>';

        return $output;
    } else {
        // echo '<p>No child pages found with the sidebar template.</p>';
        return null;
    }
}

function modify_search_results_per_page($query)
{
    // Check if it's the main query and a search query
    if ($query->is_main_query() && $query->is_search()) {
        $query->set('posts_per_page', 10); // Set the desired number of results per page
    }
}
add_action('pre_get_posts', 'modify_search_results_per_page');

function remove_dashboard_widgets()
{
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // At a Glance.
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Activity.
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Quick Draft.
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress News and Events.
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

function force_add_current_menu_ancestor($items)
{
    global $post;

    if (isset($post->ID)) {
        $current_page_id = $post->ID;
        $ancestor_ids = get_post_ancestors($current_page_id);

        foreach ($items as &$item) {
            // Check if the menu item's object ID is in the current page's ancestor list
            if (in_array($item->object_id, $ancestor_ids)) {
                $item->classes[] = 'current-menu-ancestor';
            }

            // Optionally add a class to the direct parent
            if ($item->object_id == $post->post_parent) {
                $item->classes[] = 'current-menu-parent';
            }
        }
    }

    return $items;
}
add_filter('wp_nav_menu_objects', 'force_add_current_menu_ancestor', 10, 1);

add_filter('wpseo_canonical', function ($canonical) {
    if (is_singular('success')) {
        return user_trailingslashit($canonical, 'single');
    }
    return $canonical;
});

/**
 * Retrieves and displays Phil's bio from the 'phil_bio' custom field.
 *
 * @return string HTML content of Phil's bio or an empty string if not available.
 */
function phil_bio( $cat = null ) {

    $cat = preg_replace( '/-/', '_', $cat );
    $bio = get_field( $cat, 'option' ) ?? null;

    if ( $bio ) {
        $img = get_field( 'phil_photo', 'option' );
        return '<div class="bio"><div class="row"><div class="col-md-2">' . 
            wp_get_attachment_image( $img, 'medium', false, array( 'class' => 'bio-image' ) ) .
            '</div><div class="col-md-10"><h2>About Philip Harmer</h2>' .
            $bio .
            '</div></div></div>';
    }

    return '';
}
// function phil_bio() {
//     $bio = get_field( 'phil_bio', 'option' );
//     $img = get_field( 'phil_photo', 'option' );
//     if ( $bio ) {
//         return '<div class="bio"><div class="row"><div class="col-md-2">' . 
//             wp_get_attachment_image( $img, 'medium', false, array( 'class' => 'bio-image' ) ) .
//             '</div><div class="col-md-10"><h2>About Philip Harmer</h2>' .
//             convert_h3_p_to_accordion( $bio, 'philBioAccordion' ) .
//             '</div></div></div>';
//     }
//     return '';
// }

/**
 * Converts HTML content with <h3> and <p> tags into a Bootstrap accordion structure.
 *
 * @param string $html The HTML content to be converted.
 * @param string $accordion_id The ID for the accordion container (default: 'accordionExample').
 * @return string The generated HTML for the Bootstrap accordion.
 */
function convert_h3_p_to_accordion( $html, $accordion_id = 'philBioAccordion' ) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); // Suppress warnings for bad HTML
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    libxml_clear_errors();

    $body = $dom->getElementsByTagName('body')->item(0);
    $elements = $body->childNodes;

    $accordion = '<div class="accordion" id="' . htmlspecialchars($accordion_id) . '">' . PHP_EOL;
    $index = 0;
    $openItem = false;

    foreach ($elements as $element) {
        if ($element->nodeType !== XML_ELEMENT_NODE) {
            continue;
        }

        if ($element->tagName === 'h3') {
            // Close previous item if open
            if ($openItem) {
                $accordion .= '    </div>' . PHP_EOL; // Close accordion-body
                $accordion .= '  </div>' . PHP_EOL; // Close accordion-collapse
                $accordion .= '</div>' . PHP_EOL; // Close accordion-item
            }

            $index++;
            $heading_id = 'heading-' . $index;
            $collapse_id = 'collapse-' . $index;

            $accordion .= '<div class="accordion-item">' . PHP_EOL;
            $accordion .= '  <h3 class="accordion-header" id="' . $heading_id . '">' . PHP_EOL;
            $accordion .= '    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#' . $collapse_id . '" aria-expanded="false" aria-controls="' . $collapse_id . '">' . PHP_EOL;
            $accordion .= '      ' . htmlspecialchars($element->textContent) . PHP_EOL;
            $accordion .= '    </button>' . PHP_EOL;
            $accordion .= '  </h3>' . PHP_EOL;
            $accordion .= '  <div id="' . $collapse_id . '" class="accordion-collapse collapse" aria-labelledby="' . $heading_id . '" data-bs-parent="#' . htmlspecialchars($accordion_id) . '">' . PHP_EOL;
            $accordion .= '    <div class="accordion-body">' . PHP_EOL;

            $openItem = true;
        } elseif ($element->tagName === 'p' && $openItem) {
            $accordion .= '      ' . trim($dom->saveHTML($element)) . PHP_EOL;
        }
    }

    // Close last open item
    if ($openItem) {
        $accordion .= '    </div>' . PHP_EOL; // Close accordion-body
        $accordion .= '  </div>' . PHP_EOL; // Close accordion-collapse
        $accordion .= '</div>' . PHP_EOL; // Close accordion-item
    }

    $accordion .= '</div>' . PHP_EOL; // Close accordion wrapper

    return $accordion;
}

?>
