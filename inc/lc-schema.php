<?php
/**
 * LC Schema Functions.
 *
 * @package lc-str2025
 */

/**
 * Disables Yoast SEO JSON-LD output.
 */
add_filter( 'wpseo_json_ld_output', '__return_false' );

/**
 * Disable all Trustindex schema injection.
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_dequeue_script( 'trustindex-schema-js-js' );
		wp_dequeue_script( 'trustindex-rich-snippets-js' );
	},
	9999
);

/**
 * Output our base schema from ACF with optional aggregateRating injection.
 */
add_action(
	'wp_head',
	function () {
		$schema = get_field( 'schema' );

		if ( ! $schema ) {
			return;
		}

		// Decode the schema JSON.
		$schema_data = json_decode( $schema, true );

		if ( ! $schema_data ) {
			return;
		}

		// Check if we have rating data from ACF options.
		$rating_value = get_field( 'google_rating_value', 'option' );
		$review_count = get_field( 'google_review_count', 'option' );

		// If we have both rating values and the schema is LegalService, inject aggregateRating.
		if ( $rating_value && $review_count && isset( $schema_data['@type'] ) && 'LegalService' === $schema_data['@type'] ) {
			$schema_data['aggregateRating'] = array(
				'@type'       => 'AggregateRating',
				'ratingValue' => (string) $rating_value,
				'reviewCount' => (int) $review_count,
			);
		}

		// Output the schema.
		echo '<script type="application/ld+json">';
		echo wp_json_encode( $schema_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</script>';
	},
	5
);
