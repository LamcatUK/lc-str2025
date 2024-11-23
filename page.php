<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

?>
<main>
    <?php
    the_content();
    ?>
    <hr>
    *** OLD CONTENT BELOW ***
    <hr>
    <?php
    get_template_part('page-templates/flexible-parts');
    ?>
</main>
<?php
get_footer();
