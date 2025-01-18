<?php
defined('ABSPATH') || exit;

function acf_blocks()
{
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'                => 'lc_hero',
            'title'                => __('LC Hero'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_hero.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_title_text',
            'title'                => __('LC Title / Text'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_title_text.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_text_image',
            'title'                => __('LC Text/Image'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_text_image.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_expertise',
            'title'                => __('LC Expertise Nav'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_expertise.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_expertise_block',
            'title'                => __('LC Expertise Cards'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_expertise_block.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_success_carousel',
            'title'                => __('LC Success Carousel'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_success_carousel.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_insights',
            'title'                => __('LC Insights'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_insights.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_contact',
            'title'                => __('LC Contact'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_contact.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_section_nav',
            'title'                => __('LC Section Nav'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_section_nav.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_sub_area_nav',
            'title'                => __('LC Sub-Area Nav'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_sub_area_nav.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_faq',
            'title'                => __('LC FAQ'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_faq.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_breadcrumbs',
            'title'                => __('LC Breadcrumbs'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_breadcrumbs.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'                => 'lc_cta',
            'title'                => __('LC CTA'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/lc_cta.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
    }
}

add_action('acf/init', 'acf_blocks');

// Gutenburg core modifications
add_filter('register_block_type_args', 'core_image_block_type_args', 10, 3);
function core_image_block_type_args($args, $name)
{
    if ($name == 'core/paragraph') {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ($name == 'core/heading') {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ($name == 'core/list') {
        $args['render_callback'] = 'modify_core_add_container';
    }

    return $args;
}

function modify_core_add_container($attributes, $content)
{
    ob_start();
    // $class = $block['className'];
?>
    <div class="container-xl">
        <?= $content ?>
    </div>
<?php
    $content = ob_get_clean();
    return $content;
}


function set_default_acf_link_field($field)
{
    // Check the field key or name to ensure you're targeting the correct field
    if ($field['key'] === 'field_67331133d7555') {
        $field['default_value'] = array(
            'url'    => '/contact/',  // Default URL
            'title'  => 'Contact Us Today',          // Default link text
            'target' => '_self',              // Default target (_self, _blank, etc.)
        );
    }

    return $field;
}
add_filter('acf/load_field/key=field_67331133d7555', 'set_default_acf_link_field');

?>