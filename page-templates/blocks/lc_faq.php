<?php
$class = $block['className'] ?? 'py-5';
?>
<section class="faq_block <?= $class ?>">
    <div class="container-xl">
        <?php
        if (get_field('faq_title')) {
        ?>
            <div class="center-container">
                <h2 class="mb-4">
                    <?= get_field('faq_title') ?>
                </h2>
            </div>
        <?php
        }
        if (get_field('faq_intro')) {
        ?>
            <div class="mb-5 faq_intro text-center w-constrained">
                <?= get_field('faq_intro') ?>
            </div>
        <?php
        }
        ?>
        <div class="faq_block__inner">
            <?php
            $accordion = random_str(5);

            echo '<div itemscope="" itemtype="https://schema.org/FAQPage" id="accordion' .  $accordion . '" class="accordion">';
            $counter = 0;
            $show = '';
            $collapsed = 'collapsed';


            $expanded = 'false';
            $collapse = '';
            $button = 'collapsed';

            while (have_rows('faq')) {
                the_row();
                $ac = $accordion . '_' . $counter;
            ?>
                <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question" class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button fs-500 <?= $button ?>"
                            itemprop="name" type="button" data-bs-toggle="collapse"
                            data-bs-target="#c<?= $ac ?>"
                            aria-expanded="<?= $expanded ?>"
                            aria-controls="c<?= $ac ?>">
                            <?= get_sub_field('question') ?>
                        </button>
                    </div>
                    <div id="c<?= $ac ?>"
                        class="collapse <?= $show ?>" itemscope=""
                        itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"
                        data-bs-parent="#accordion<?= $accordion ?>">
                        <div class="accordion-body" itemprop="text">
                            <?= get_sub_field('answer') ?>
                        </div>
                    </div>
                </div>
            <?php
                $counter++;
                $show = '';
                $collapsed = 'collapsed';
            }
            echo '</div>';
            ?>
        </div>
</section>