<?php
/**
 * LC Blocks
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers custom ACF blocks for the theme.
 */
function acf_blocks() {
    if ( function_exists( 'acf_register_block_type' ) ) {

        acf_register_block_type(array(
            'name'                => 'lc-featured-page',
            'title'               => __('LC Featured Page'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'     => 'page-templates/blocks/lc-featured-page.php',
            'mode'                => 'edit',
            'supports'            => array('mode' => false, 'anchor' => true, 'className' => true),
        ));


        acf_register_block_type(array(
            'name'                => 'lc-single-bio',
            'title'               => __('LC Single Bio'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'     => 'page-templates/blocks/lc-single-bio.php',
            'mode'                => 'edit',
            'supports'            => array('mode' => false, 'anchor' => true, 'className' => true),
        ));


        acf_register_block_type(array(
            'name'                => 'lc-selected-successes',
            'title'               => __('LC Selected Successes'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'     => 'page-templates/blocks/lc-selected-successes.php',
            'mode'                => 'edit',
            'supports'            => array('mode' => false, 'anchor' => true, 'className' => true),
        ));


        acf_register_block_type(
            array(
                'name'            => 'lc-video-feature',
                'title'           => __( 'LC Video Feature' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc-video-feature.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_hero',
                'title'           => __( 'LC Hero' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc-hero.php',
                'mode'            => 'edit',
                'supports'        => array( 'mode' => false ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_title_text',
                'title'           => __( 'LC Title / Text' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_title_text.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_text_image',
                'title'           => __( 'LC Text/Image' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_text_image.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_expertise',
                'title'           => __( 'LC Expertise Nav' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_expertise.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_expertise_block',
                'title'           => __( 'LC Expertise Cards' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_expertise_block.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_success_carousel',
                'title'           => __( 'LC Success Carousel' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_success_carousel.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_success_by_speciality',
                'title'           => __( 'LC Success by Speciality' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_success_by_speciality.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_insights',
                'title'           => __( 'LC Insights' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_insights.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_contact',
                'title'           => __( 'LC Contact' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_contact.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_section_nav',
                'title'           => __( 'LC Section Nav' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_section_nav.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_sub_area_nav',
                'title'           => __( 'LC Sub-Area Nav' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_sub_area_nav.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_faq',
                'title'           => __( 'LC FAQ' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_faq.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_breadcrumbs',
                'title'           => __( 'LC Breadcrumbs' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_breadcrumbs.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_cta',
                'title'           => __( 'LC CTA' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_cta.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                ),
            )
        );

    }
}
add_action( 'acf/init', 'acf_blocks' );

/**
 * Modifies the arguments for core block types to add a custom render callback.
 *
 * @param array  $args The block type arguments.
 * @param string $name The block type name.
 * @return array Modified block type arguments.
 */
function core_image_block_type_args( $args, $name ) {
    if ( 'core/paragraph' === $name ) {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ( 'core/heading' === $name ) {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ( 'core/list' === $name ) {
        $args['render_callback'] = 'modify_core_add_container';
    }
    return $args;
}
add_filter( 'register_block_type_args', 'core_image_block_type_args', 10, 3 );

/**
 * Adds a container wrapper around the content of core blocks.
 *
 * @param array  $attributes The block attributes.
 * @param string $content    The block content.
 * @return string The modified block content with a container wrapper.
 */
function modify_core_add_container( $attributes, $content ) {
    ob_start();
    ?>
    <div class="container-xl">
        <?= wp_kses_post( $content ); ?>
    </div>
    <?php
    $content = ob_get_clean();
    return $content;
}


/**
 * Sets the default value for the ACF link field for the LC Hero CTA.
 *
 * @param array $field The ACF field array.
 * @return array The modified field array with default values.
 */
function set_default_acf_link_field( $field ) {
    // Check the field key or name to ensure you're targeting the correct field.
    if ( 'field_67331133d7555' === $field['key'] || $field ) {
        $field['default_value'] = array(
            'url'    => '/contact/', // Default URL.
            'title'  => 'Contact Us Today', // Default link text.
            'target' => '_self', // Default target (_self, _blank, etc.).
        );
    }
    return $field;
}
add_filter( 'acf/load_field/key=field_67331133d7555', 'set_default_acf_link_field' );


/**
 * Deregisters Yoast SEO blocks from the block editor.
 *
 * This function removes the Yoast SEO breadcrumbs and FAQ blocks
 * from the block editor if the `unregister_block_type` function exists.
 */
function deregister_yoast_blocks() {
    if ( function_exists( 'unregister_block_type' ) ) {
        unregister_block_type( 'yoast-seo/breadcrumbs' );
        unregister_block_type( 'yoast/faq-block' );
    }
}
add_action( 'init', 'deregister_yoast_blocks', 20 ); // Higher priority.


/**
 * Removes featured image support for specific page templates in the admin area.
 *
 * This function checks if the current post uses a specific template and removes
 * the featured image (thumbnail) support for pages using those templates.
 */
function remove_featured_image_support_for_sidebar_template() {
    // Check if we're in the admin area.
    if ( is_admin() ) {
        // Get the current post ID.
        $post_id = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : null;

        if ( $post_id ) {
            // Get the template assigned to the post.
            $template = get_page_template_slug( $post_id );

            // Check if the template matches your specific template.
            if (
                'page-templates/sidebar-page.php' === $template
                ||
                'page-templates/sub-area-page.php' === $template
            ) {
                // Remove featured image support for pages.
                remove_post_type_support( 'page', 'thumbnail' );
            }
        }
    }
}
add_action( 'load-post.php', 'remove_featured_image_support_for_sidebar_template' );
add_action( 'load-post-new.php', 'remove_featured_image_support_for_sidebar_template' );

?>