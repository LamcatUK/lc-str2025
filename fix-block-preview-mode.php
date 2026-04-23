<?php
/**
 * One-off fix: replace "mode":"preview" with "mode":"edit" in all post content.
 *
 * Hooked to admin_init so it runs once when any admin page is loaded.
 * A flag is stored in wp_options to ensure it only ever runs once.
 *
 * REMOVE THIS FILE after deploying and confirming the fix has run.
 *
 * @package lc-str2025
 */

defined( 'ABSPATH' ) || exit;

add_action(
    'admin_init',
    function () {
        if ( get_option( 'lc_fix_block_preview_mode_done' ) ) {
            return;
        }

        global $wpdb;

        $posts = $wpdb->get_results(
            "SELECT ID FROM {$wpdb->posts}
             WHERE post_content LIKE '%\"mode\":\"preview\"%'
             AND post_status NOT IN ('auto-draft', 'trash')"
        );

        foreach ( $posts as $post ) {
            $content     = get_post_field( 'post_content', $post->ID, 'raw' );
            $new_content = str_replace( '"mode":"preview"', '"mode":"edit"', $content );

            if ( $new_content === $content ) {
                continue;
            }

            $wpdb->update(
                $wpdb->posts,
                array( 'post_content' => $new_content ),
                array( 'ID' => $post->ID ),
                array( '%s' ),
                array( '%d' )
            );

            clean_post_cache( $post->ID );
        }

        update_option( 'lc_fix_block_preview_mode_done', true );
    }
);
