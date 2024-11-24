<?php
defined('ABSPATH') || exit;

// require_once get_theme_file_path('inc/class-bs-collapse-navwalker.php');

require_once LC_THEME_DIR . '/inc/lc-utility.php';
require_once LC_THEME_DIR . '/inc/lc-blocks.php';

function widgets_init()
{

    register_nav_menus(array(
        'primary_nav' => 'Primary Nav',
        'footer_menu_1' => 'Footer Expertise',
        'footer_menu_2' => 'Footer Links',
    ));

    unregister_sidebar('hero');
    unregister_sidebar('herocanvas');
    unregister_sidebar('statichero');
    unregister_sidebar('left-sidebar');
    unregister_sidebar('right-sidebar');
    unregister_sidebar('footerfull');
    unregister_nav_menu('primary');

    add_theme_support('disable-custom-colors');
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name' => 'Black',
                'slug' => 'black',
                'color' => '#313747'
            ),
            array(
                'name' => 'White',
                'slug' => 'white',
                'color' => '#ffffff'
            ),
            array(
                'name' => 'Light Grey',
                'slug' => 'grey-100',
                'color' => '#f4f4f4'
            ),
            array(
                'name' => 'Mid Grey',
                'slug' => 'grey-400',
                'color' => '#e6e6e6'
            ),
            array(
                'name' => 'Ocean Tide',
                'slug' => 'primary-400',
                'color' => '#00555a'
            ),
            array(
                'name' => 'Deep Sea',
                'slug' => 'secondary-400',
                'color' => '#003349'
            ),
        )
    );
}
add_action('widgets_init', 'widgets_init', 11);

remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

//Custom Dashboard Widget
add_action('wp_dashboard_setup', 'register_lc_dashboard_widget');
function register_lc_dashboard_widget()
{
    wp_add_dashboard_widget(
        'lc_dashboard_widget',
        'Lamcat',
        'lc_dashboard_widget_display'
    );
}

function lc_dashboard_widget_display()
{
?>
    <div style="display: flex; align-items: center; justify-content: space-around;">
        <img style="width: 50%;"
            src="<?= get_stylesheet_directory_uri() . '/img/lc-full.jpg'; ?>">
        <a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer"
            href="mailto:hello@lamcat.co.uk/">Contact</a>
    </div>
    <div>
        <p><strong>Thanks for choosing Lamcat!</strong></p>
        <hr>
        <p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
        <p>Use the link above to get in touch and we'll get back to you ASAP.</p>
    </div>
<?php
}


function lc_theme_enqueue()
{
    $the_theme = wp_get_theme();
    $theme_version = $the_theme->get('Version');

    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    // Grab asset urls.
    $theme_styles  = "/css/child-theme{$suffix}.css";
    $theme_scripts = "/js/child-theme{$suffix}.js";

    $css_version = $theme_version . '.' . filemtime(get_stylesheet_directory() . $theme_styles);

    wp_deregister_script('jquery');

    wp_enqueue_script('splide', "https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js", array(), null, true);
    wp_enqueue_style('splide-style', "https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css", array());

    wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true);
    wp_enqueue_style('aos-style', "https://unpkg.com/aos@2.3.1/dist/aos.css", array());

    wp_enqueue_style('child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version);

    $js_version = $theme_version . '.' . filemtime(get_stylesheet_directory() . $theme_scripts);

    wp_enqueue_script('child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true);
}
add_action('wp_enqueue_scripts', 'lc_theme_enqueue');

// function custom_gutenberg_scripts()
// {
//     wp_enqueue_script(
//         'custom-gutenberg',
//         get_stylesheet_directory_uri() . '/js/custom-gutenberg.js',
//         array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
//         filemtime(get_stylesheet_directory() . '/js/custom-gutenberg.js'),
//         true
//     );
// }
// add_action('enqueue_block_editor_assets', 'custom_gutenberg_scripts');

add_filter('wpcf7_autop_or_not', '__return_false');

add_action('admin_head', function () {
    echo '<style>
   .block-editor-page #wpwrap {
       overflow-y: auto !important;
   }
   </style>';
});

function add_search_to_nav($items, $args)
{
    if ($args->theme_location != 'primary_nav') {
        return $items;
    }

    $link  = '<li class="menu-item nav-item"><a href="/search/" class="nav-link" title="Search"><i class="fas fa-magnifying-glass"></i></a>';

    $items .= $link;

    return $items;
}
add_action('wp_nav_menu_items', 'add_search_to_nav', 10, 2);


// cb branding on wp-login.php
function custom_login_logo()
{
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
add_action('login_enqueue_scripts', 'custom_login_logo');


function splide_slider_shortcode($atts)
{
    // Parse the attributes passed to the shortcode
    $atts = shortcode_atts(
        array(
            'ids' => '', // List of image IDs, default is empty
        ),
        $atts,
        'splide_slider'
    );

    // Convert the comma-separated IDs into an array
    $image_ids = array_filter(array_map('trim', explode(',', $atts['ids'])));

    if (empty($image_ids)) {
        return '<p>No images provided for the slider.</p>'; // Fallback if no IDs are passed
    }

    // Start building the HTML for the Splide slider
    ob_start(); // Start output buffering to capture the slider HTML
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
        'dispute-resolution',
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

?>