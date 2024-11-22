<section class="sub_area_nav py-6 bg-grey-100">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-md-3">
                <h2 class="fancy"><?= get_field('block_title') ?></h2>
            </div>
            <div class="col-md-9">
                <?php

                $sub_area_pages = [];

                // Query for child pages
                $args = [
                    'post_type'      => 'page',
                    'post_parent'    => 26, // get_the_ID(),
                    'post_status'    => 'publish',
                    'posts_per_page' => -1
                ];

                $children = get_posts($args);

                // Loop through each child page
                foreach ($children as $child) {
                    // Check if the child page uses the 'Sub-Area Page' template
                    $template = get_page_template_slug($child->ID);
                    if ($template === 'page-templates/sub-area-page.php') {
                        $sub_area_pages[] = $child->ID;
                    }
                }
                ?>
                <div class="row g-4 justify-content-center">
                    <?php
                    foreach ($sub_area_pages as $s) {
                    ?>
                        <div class="col-md-4">
                            <a href="<?= get_the_permalink($s) ?>" class="sub_area_nav__card">
                                <?= wp_get_attachment_image(get_field('icon', $s), 'full', false, array('class' => 'sub_area_nav__image')) ?>
                                <h3><?= get_the_title($s) ?></h3>
                                <p><?= get_field('intro', $s) ?></p>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>