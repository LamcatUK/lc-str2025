<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

?>
<main>
    <?php
    the_content();

    if ( has_category() ) {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            $first_category = $categories[0]; // This is a WP_Term object.
            echo '<div class="mt-4">';
            echo wp_kses_post( phil_bio( $first_category->slug ) );
            echo '</div>';
        }
    }
    ?>
</main>
<?php
get_footer();
