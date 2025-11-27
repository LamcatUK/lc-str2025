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

/**
 * Output CaseStudy + Article schema on single Success posts.
 */
add_action(
	'wp_head',
	function () {
		if ( ! is_singular( 'success' ) ) {
			return;
		}

		$post_id   = get_queried_object_id();
		$permalink = get_permalink( $post_id );
		$title     = get_the_title( $post_id );

		// Build description from excerpt or trimmed content.
		if ( has_excerpt( $post_id ) ) {
			$description = wp_strip_all_tags( get_the_excerpt( $post_id ) );
		} else {
			$raw_content = get_post_field( 'post_content', $post_id );
			$description = wp_strip_all_tags( wp_trim_words( $raw_content, 40, '…' ) );
		}

		// Featured image as ImageObject (if present), with fallbacks.
		$image_obj = null;
		if ( has_post_thumbnail( $post_id ) ) {
			$thumb_id = get_post_thumbnail_id( $post_id );
			$src      = wp_get_attachment_image_src( $thumb_id, 'full' );
			if ( $src ) {
				$image_obj = array(
					'@type'  => 'ImageObject',
					'url'    => $src[0],
					'width'  => (int) $src[1],
					'height' => (int) $src[2],
				);
			}
		}

		// Fallback to Phil's photo from options, then to custom logo, then to site icon.
		if ( ! $image_obj ) {
			$phil_img = get_field( 'phil_photo', 'option' );
			$phil_id  = null;
			$phil_url = null;

			if ( is_numeric( $phil_img ) ) {
				$phil_id = (int) $phil_img;
			} elseif ( is_array( $phil_img ) ) {
				if ( isset( $phil_img['ID'] ) ) {
					$phil_id = (int) $phil_img['ID'];
				} elseif ( isset( $phil_img['id'] ) ) {
					$phil_id = (int) $phil_img['id'];
				} elseif ( isset( $phil_img['url'] ) ) {
					$phil_url = $phil_img['url'];
				}
			} elseif ( is_string( $phil_img ) ) {
				$phil_url = $phil_img;
			}

			if ( $phil_id ) {
				$src = wp_get_attachment_image_src( $phil_id, 'full' );
				if ( $src ) {
					$image_obj = array(
						'@type'  => 'ImageObject',
						'url'    => $src[0],
						'width'  => (int) $src[1],
						'height' => (int) $src[2],
					);
				}
			} elseif ( $phil_url ) {
				$image_obj = array(
					'@type' => 'ImageObject',
					'url'   => $phil_url,
				);
			}
		}

		if ( ! $image_obj ) {
			$custom_logo_id = (int) get_theme_mod( 'custom_logo' );
			if ( $custom_logo_id ) {
				$src = wp_get_attachment_image_src( $custom_logo_id, 'full' );
				if ( $src ) {
					$image_obj = array(
						'@type'  => 'ImageObject',
						'url'    => $src[0],
						'width'  => (int) $src[1],
						'height' => (int) $src[2],
					);
				}
			}
		}

		if ( ! $image_obj && function_exists( 'has_site_icon' ) && has_site_icon() ) {
			$icon_url = get_site_icon_url( 512 );
			if ( $icon_url ) {
				$image_obj = array(
					'@type'  => 'ImageObject',
					'url'    => $icon_url,
					'width'  => 512,
					'height' => 512,
				);
			}
		}

		// Author: single lawyer practice - Philip Harmer.
		$author_url  = trailingslashit( home_url( '/about/' ) ) . '#philip-harmer';
		$author_data = array(
			'@type' => 'Person',
			'@id'   => $author_url,
			'name'  => 'Philip Harmer',
			'url'   => $author_url,
		);

		// Keywords/About from categories (and tags if present).
		$keywords = array();
		$cats     = get_the_terms( $post_id, 'category' );
		$tags     = get_the_terms( $post_id, 'post_tag' );

		foreach ( array( $cats, $tags ) as $term_list ) {
			if ( is_array( $term_list ) ) {
				foreach ( $term_list as $t ) {
					if ( $t && ! is_wp_error( $t ) ) {
						$keywords[] = $t->name;
					}
				}
			}
		}
		$keywords = array_values( array_unique( $keywords ) );

		// Article section from first category, fallback label.
		$article_section = 'Success Stories';
		if ( is_array( $cats ) && ! empty( $cats ) && isset( $cats[0]->name ) ) {
			$article_section = $cats[0]->name;
		}

		$org_id = trailingslashit( home_url() ) . '#company';

		$data = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'Article',
			'@id'              => trailingslashit( $permalink ) . '#case-study',
			'url'              => $permalink,
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => $permalink,
			),
			'headline'         => $title,
			'name'             => $title,
			'description'      => $description,
			'datePublished'    => get_the_date( DATE_W3C, $post_id ),
			'dateModified'     => get_the_modified_date( DATE_W3C, $post_id ),
			'inLanguage'       => get_bloginfo( 'language' ),
			'articleSection'   => $article_section,
			'author'           => $author_data,
			'publisher'        => array(
				'@type' => 'LegalService',
				'@id'   => $org_id,
			),
			'provider'         => array(
				'@type' => 'LegalService',
				'@id'   => $org_id,
			),
		);

		if ( $image_obj ) {
			$data['image'] = $image_obj;
		}
		if ( ! empty( $keywords ) ) {
			$data['keywords'] = $keywords;
			$data['about']    = $keywords;
		}

		echo '<script type="application/ld+json">';
		echo wp_json_encode(
			$data,
			JSON_UNESCAPED_SLASHES
			| JSON_UNESCAPED_UNICODE
			| JSON_HEX_TAG
			| JSON_HEX_AMP
			| JSON_HEX_APOS
			| JSON_HEX_QUOT
		); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</script>';
	},
	6
);

/**
 * Output Article schema on single Blog posts.
 */
add_action(
	'wp_head',
	function () {
		if ( ! is_singular( 'post' ) ) {
			return;
		}

		$post_id   = get_queried_object_id();
		$permalink = get_permalink( $post_id );
		$title     = get_the_title( $post_id );

		// Build description from excerpt or trimmed content.
		if ( has_excerpt( $post_id ) ) {
			$description = wp_strip_all_tags( get_the_excerpt( $post_id ) );
		} else {
			$raw_content = get_post_field( 'post_content', $post_id );
			$description = wp_strip_all_tags( wp_trim_words( $raw_content, 40, '…' ) );
		}

		// Featured image as ImageObject (if present), with fallbacks.
		$image_obj = null;
		if ( has_post_thumbnail( $post_id ) ) {
			$thumb_id = get_post_thumbnail_id( $post_id );
			$src      = wp_get_attachment_image_src( $thumb_id, 'full' );
			if ( $src ) {
				$image_obj = array(
					'@type'  => 'ImageObject',
					'url'    => $src[0],
					'width'  => (int) $src[1],
					'height' => (int) $src[2],
				);
			}
		}

		// Fallback to Phil's photo from options, then to custom logo, then to site icon.
		if ( ! $image_obj ) {
			$phil_img = get_field( 'phil_photo', 'option' );
			$phil_id  = null;
			$phil_url = null;

			if ( is_numeric( $phil_img ) ) {
				$phil_id = (int) $phil_img;
			} elseif ( is_array( $phil_img ) ) {
				if ( isset( $phil_img['ID'] ) ) {
					$phil_id = (int) $phil_img['ID'];
				} elseif ( isset( $phil_img['id'] ) ) {
					$phil_id = (int) $phil_img['id'];
				} elseif ( isset( $phil_img['url'] ) ) {
					$phil_url = $phil_img['url'];
				}
			} elseif ( is_string( $phil_img ) ) {
				$phil_url = $phil_img;
			}

			if ( $phil_id ) {
				$src = wp_get_attachment_image_src( $phil_id, 'full' );
				if ( $src ) {
					$image_obj = array(
						'@type'  => 'ImageObject',
						'url'    => $src[0],
						'width'  => (int) $src[1],
						'height' => (int) $src[2],
					);
				}
			} elseif ( $phil_url ) {
				$image_obj = array(
					'@type' => 'ImageObject',
					'url'   => $phil_url,
				);
			}
		}

		if ( ! $image_obj ) {
			$custom_logo_id = (int) get_theme_mod( 'custom_logo' );
			if ( $custom_logo_id ) {
				$src = wp_get_attachment_image_src( $custom_logo_id, 'full' );
				if ( $src ) {
					$image_obj = array(
						'@type'  => 'ImageObject',
						'url'    => $src[0],
						'width'  => (int) $src[1],
						'height' => (int) $src[2],
					);
				}
			}
		}

		if ( ! $image_obj && function_exists( 'has_site_icon' ) && has_site_icon() ) {
			$icon_url = get_site_icon_url( 512 );
			if ( $icon_url ) {
				$image_obj = array(
					'@type'  => 'ImageObject',
					'url'    => $icon_url,
					'width'  => 512,
					'height' => 512,
				);
			}
		}

		// Author: single lawyer practice - always Philip Harmer for blog posts.
		$author_url  = trailingslashit( home_url( '/about/' ) ) . '#philip-harmer';
		$author_data = array(
			'@type' => 'Person',
			'@id'   => $author_url,
			'name'  => 'Philip Harmer',
			'url'   => $author_url,
		);

		// Keywords/About from categories (and tags if present).
		$keywords = array();
		$cats     = get_the_terms( $post_id, 'category' );
		$tags     = get_the_terms( $post_id, 'post_tag' );

		foreach ( array( $cats, $tags ) as $term_list ) {
			if ( is_array( $term_list ) ) {
				foreach ( $term_list as $t ) {
					if ( $t && ! is_wp_error( $t ) ) {
						$keywords[] = $t->name;
					}
				}
			}
		}
		$keywords = array_values( array_unique( $keywords ) );

		// Article section from first category, fallback label.
		$article_section = 'Insights';
		if ( is_array( $cats ) && ! empty( $cats ) && isset( $cats[0]->name ) ) {
			$article_section = $cats[0]->name;
		}

		$org_id = trailingslashit( home_url() ) . '#company';

		$data = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'Article',
			'@id'              => trailingslashit( $permalink ) . '#article',
			'url'              => $permalink,
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => $permalink,
			),
			'headline'         => $title,
			'name'             => $title,
			'description'      => $description,
			'datePublished'    => get_the_date( DATE_W3C, $post_id ),
			'dateModified'     => get_the_modified_date( DATE_W3C, $post_id ),
			'inLanguage'       => get_bloginfo( 'language' ),
			'articleSection'   => $article_section,
			'author'           => $author_data,
			'publisher'        => array(
				'@type' => 'LegalService',
				'@id'   => $org_id,
			),
			'provider'         => array(
				'@type' => 'LegalService',
				'@id'   => $org_id,
			),
		);

		if ( $image_obj ) {
			$data['image'] = $image_obj;
		}
		if ( ! empty( $keywords ) ) {
			$data['keywords'] = $keywords;
			$data['about']    = $keywords;
		}

		echo '<script type="application/ld+json">';
		echo wp_json_encode(
			$data,
			JSON_UNESCAPED_SLASHES
			| JSON_UNESCAPED_UNICODE
			| JSON_HEX_TAG
			| JSON_HEX_AMP
			| JSON_HEX_APOS
			| JSON_HEX_QUOT
		); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</script>';
	},
	6
);
