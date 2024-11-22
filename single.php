<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
$img = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'single-blog__image'));

add_action('wp_head',function() {
    global $schema;
    echo $schema;
});

get_header();
// $img = get_the_post_thumbnail_url(get_the_ID(),'full');

?>
<main id="main" class="single-blog">
    <?php
    $content = get_the_content();
$blocks = parse_blocks($content);
$sidebar = array();
$after;
?>
    <section class="breadcrumbs container-xl pb-2">
        <?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
}
?>
    </section>
    <div class="container-xl">
        <div class="row g-4 pb-4">
            <div class="col-lg-9">
                <h1 class="single-blog__title"><?=get_the_title()?>
                </h1>
                <?=$img?>
                <div class="single-blog__read">
                    <?=get_the_date()?> |
                    <?=estimate_reading_time_in_minutes(get_the_content(), 200, true, true)?>
                </div>
                <?php
foreach ($blocks as $block) {
    if ($block['blockName'] == 'core/heading') {
        if (!array_key_exists('level', $block['attrs'])) {
            $heading = strip_tags($block['innerHTML']);
            $id = acf_slugify($heading);
            echo '<a id="' . $id . '" class="anchor"></a>';
            $sidebar[$heading] = $id;
        }
    }
    // echo render_block($block);
    echo apply_filters('the_content', render_block($block));
}
?>
            </div>
            <div class="col-lg-3">
                <div class="sidebar">
                    <?php
    if ($sidebar) {
        ?>
                    <div class="quicklinks">
                        <div class="h5 has-line d-none d-lg-inline-block">Quick Links</div>
                        <button class="d-lg-none accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#links" aria-expanded="true" aria-controls="links">Quick Links</button>

                        <!-- <div class="h5 d-lg-none" data-bs-toggle="collapse" href="#links" role="button">Quick Links</div> -->
                        <div class="collapse d-lg-block" id="links">
                            <div class="pt-3 pt-lg-0">
                                <?php
                foreach ($sidebar as $heading => $id) {
                    ?>
                                <li><a
                                        href="#<?=$id?>"><?=$heading?></a>
                                </li>
                                <?php
                }
        ?>
                            </div>
                        </div>
                    </div>
                    <?php
    }
?>
                </div>
            </div>
        </div>
        <?php

$cats = get_the_category();
$ids = wp_list_pluck($cats, 'term_id');

$q = new WP_Query(array(
    'post_type' => 'post',
    'category__in' => $ids,
    'posts_per_page' => 4,
    'post__not_in' => array(get_the_ID())
));

if ($q->have_posts()) {
    ?>
    <h3 class="fs-700"><span>Related</span> Posts</h3>
    <div class="grid mb-4">
        <?php
    while ($q->have_posts()) {
    $q->the_post();
    $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
    if (!$img) {
        $img = get_stylesheet_directory_uri() . '/img/default-blog.jpg';
    }

    ?>
        <a class="grid__card grid__card--sm <?=$catclass?>"
            href="<?=get_the_permalink(get_the_ID())?>">
            <div class="card card--<?=$flashcat?>">
                <div class="card__image_container">
                    <?=get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'card__image'))?>
                </div>
                <div class="card__inner">
                    <h3 class="card__title mb-0">
                        <?=get_the_title()?>
                    </h3>
                </div>
            </div>
        </a>
        <?php
    }
    wp_reset_postdata();
}
?>
    </div>
</main>
<?php
get_footer();
?>