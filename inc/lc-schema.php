<?php
/**
 * LC Schema Functions.
 *
 * @package lc-str2025
 */

add_action(
	'wp_head',
	function () {
		ob_start(
			function ( $buffer ) {
				// remove Trustindex JSON-LD (Product / Organization)
				$buffer = preg_replace('/<script type="application\/ld\+json".*?<\/script>/s', '', $buffer);
				return $buffer;
			}
		);
	}
);


/*
Plugin Name: Disable Trustindex Organization Schema
*/
add_action(
	'wp_head',
	function () {
		ob_start(
			function ( $buffer ) {

				// Remove Trustindex JSON-LD (<script type="application/ld+json"> ... </script>)
				$buffer = preg_replace(
					'/<!-- Inserted by https:\/\/cdn\.trustindex\.io\/loader\.js.*?<script type="application\/ld\+json">.*?<\/script>/s',
					'',
					$buffer
				);

				return $buffer;
			}
		);
	}
);

/**
 * Disables Yoast SEO JSON-LD output.
 */
add_filter( 'wpseo_json_ld_output', '__return_false' );
