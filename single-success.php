<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('wp_head', function () {
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
            <div class="col-lg-9 order-2 order-lg-1">
                <h1 class="single-blog__title"><?= get_the_title() ?>
                </h1>
                <div class="single-blog__read">
                    <?= get_the_date() ?><span>|</span>
                    <?= estimate_reading_time_in_minutes(get_the_content(), 200, true, true) ?>
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
            <div class="col-lg-3 order-1 order-lg-2">
                <div class="sidebar-insights">
                    <?php
                    if ($sidebar) {
                    ?>
                        <div class="quicklinks">
                            <div class="h5 has-line d-none d-lg-inline-block">Quick Links</div>
                            <button class="d-lg-none accordion-button collapsed h5" type="button" data-bs-toggle="collapse"
                                data-bs-target="#links" aria-expanded="true" aria-controls="links">Quick Links</button>

                            <!-- <div class="h5 d-lg-none" data-bs-toggle="collapse" href="#links" role="button">Quick Links</div> -->
                            <div class="collapse d-lg-block" id="links">
                                <ul class="pt-3 pt-lg-0">
                                    <?php
                                    foreach ($sidebar as $heading => $id) {
                                    ?>
                                        <li><a
                                                href="#<?= $id ?>"><?= $heading ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="sidebar-insights__cta mt-3 d-none d-lg-block">
                        <div class="fw-600 mb-3">Contact Stormcatcher for First Free Advice</div>
                        <div class="d-flex gap-2 justify-content-center align-items-center">
                            <a href="tel:<?= parse_phone(get_field('contact_phone', 'option')) ?>" class="button button-primary"><i class="fas fa-phone"></i> Call</a>
                            <a href="mailto:<?= get_field('contact_email', 'option') ?>" class="button button-primary"><i class="fas fa-paper-plane"></i> Email</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>