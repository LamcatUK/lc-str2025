<?php
$child_query = new WP_Query(array(
    'post_parent'    => get_the_ID(),
    'post_type'      => 'page',
    'posts_per_page' => -1, // Retrieve all child pages
    'post_status'    => 'publish',
    'order'          => 'ASC'
));

if ($child_query->have_posts()) {
?>
    <section class="child_cards py-6">
        <div class="container-xl">
            <ul class="cols-lg-3">
                <?php
                while ($child_query->have_posts()) {
                    $child_query->the_post();
                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                }
                wp_reset_postdata(); // Reset the post data after the query
                ?>
            </ul>
        </div>
    </section>
<?php
} else {
    echo '<!-- No child pages found. -->';
}
