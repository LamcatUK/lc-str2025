<section class="py-4">
    <div class="container position-relative wow animated fadeIn">
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
                echo '<div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question" class="pb-3">';
                echo '  <div class="question ' . $collapsed . '" itemprop="name" data-toggle="collapse" id="heading_' . $accordion . '_' . $counter . '" data-target="#collapse_' . $accordion . '_' . $counter . '" aria-expanded="true" aria-controls="collapse_' . $accordion . '_' . $counter . '">' . get_sub_field('question') . '</div>';
                echo '  <div class="answer collapse ' . $show . '" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" id="collapse_' . $accordion . '_' . $counter . '" aria-labelledby="heading_' . $accordion . '_' . $counter . '" data-parent="#accordion' . $accordion . '"><div itemprop="text">' . apply_filters('the_content',get_sub_field('answer')) . '</div></div>';
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