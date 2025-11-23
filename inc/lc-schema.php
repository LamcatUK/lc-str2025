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
Plugin Name: Disable Trustindex Schema
*/

add_action( 'wp_head', function() {
    ob_start(function($buffer){
        // Remove ALL JSON-LD inside Trustindex's auto-generated scripts
        $buffer = preg_replace('/\(function\(\)\{var b=\{.*?\}\}\)\(document\);?<\/script>/s', '', $buffer);
        return $buffer;
    });
});


/**
 * Disables Yoast SEO JSON-LD output.
 */
add_filter( 'wpseo_json_ld_output', '__return_false' );
