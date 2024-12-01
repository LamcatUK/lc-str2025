<section class="section_nav">
    <div class="container-xl py-6">
        <?php
        if (get_field('block_title') ?? null) {
            echo '<h2 class="h3">' . get_field('block_title') . '</h2>';
        }

        $titles = [];

        $content = get_the_content();
        $blocks = parse_blocks($content);

        // var_dump($blocks);

        foreach ($blocks as $block) {
            echo '--' . $block['blockName'] . '--<br>';

            if ($block['blockName'] == 'core/heading') {
                var_dump($block);

                if (isset($block['attrs']['level']) && $block['attrs']['level'] === 2) {
                    $heading = strip_tags($block['innerHTML']);
                    $id = acf_slugify($heading);
                    $titles[$id] = $heading;
                }
            }
            if (isset($block['blockName']) && strpos($block['blockName'], 'acf/') === 0) {
                if ($block['blockName'] == 'acf/lc-hero') {
                    continue;
                }
                $acf_title = '';
                if (!empty($block['attrs']['data']['title'])) {
                    $titles[] = $block['attrs']['data']['title'];
                }
            }
        }

        ?>
        <ul class="cols-lg-2">
            <?php
            foreach ($titles as $t) {
                $id = acf_slugify($t);
            ?>
                <li><a href="#<?= $id ?>"><?= $t ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</section>