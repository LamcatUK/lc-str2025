<?php
if (get_row_layout() == 'faq') {
            ?>
<section class="faq py-5">
    <div class="container position-relative">
        <?php
            if (get_sub_field('faq_title')) {
                echo '<h2 class="h2 mb-4">' . get_sub_field('faq_title') . '</h2>';
            }
            echo '<div itemscope="" itemtype="https://schema.org/FAQPage" id="accordion' . $accordion . '">';
            $counter = 0;
            $show = 'show';
            $collapsed = '';
            while (have_rows('faq')) {
                the_row();
                $border = $counter == 0 ? 'border-top' : '';
                echo '<div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question" class="py-4 border-bottom ' . $border . '">';
                echo '  <div class="question ' . $collapsed . '" itemprop="name" data-toggle="collapse" id="heading_' . $accordion . '_' . $counter . '" data-target="#collapse_' . $accordion . '_' . $counter . '" aria-expanded="true" aria-controls="collapse_' . $accordion . '_' . $counter . '">' . get_sub_field('question') . '</div>';
                echo '  <div class="answer pt-2 collapse ' . $show . '" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" id="collapse_' . $accordion . '_' . $counter . '" aria-labelledby="heading_' . $accordion . '_' . $counter . '" data-parent="#accordion' . $accordion . '"><div itemprop="text">' . apply_filters('the_content',get_sub_field('answer')) . '</div></div>';
                echo '</div>';
                $counter++;
                $show = '';
                $collapsed = 'collapsed';
            }
            echo '</div>';
        ?>
    </div>
</section>
    <?php
    $accordion++;
}
