<?php

/**
 * Setup for page blocks
 *
 * @package lc-str2021
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$accordion = 0;
if (have_rows('flexible_blocks')) {
    while (have_rows('flexible_blocks')) {
        the_row();

        get_template_part('page-templates/blocks-old/' . get_row_layout());
    }
} else {
    echo 'no sections';
}

if ($parallax == 1) {
    // add_action('wp_footer', function () {
    //     echo '<script src="'.get_stylesheet_directory_uri() . '/js/parallax.min.js"></script>';
    // });
}
