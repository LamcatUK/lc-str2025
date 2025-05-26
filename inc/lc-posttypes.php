<?php
/**
 * Register custom post types for the theme.
 *
 * @package lc-stormcatcher2025
 */

add_action(
	'init',
	function() {
		register_post_type(
			'success',
			array(
				'labels' => array(
					'name' => 'Successes',
					'singular_name' => 'Success',
					'menu_name' => 'Successes',
					'all_items' => 'All Successes',
					'edit_item' => 'Edit Success',
					'view_item' => 'View Success',
					'view_items' => 'View Successes',
					'add_new_item' => 'Add New Success',
					'add_new' => 'Add New Success',
					'new_item' => 'New Success',
					'parent_item_colon' => 'Parent Success:',
					'search_items' => 'Search Successes',
					'not_found' => 'No successes found',
					'not_found_in_trash' => 'No successes found in Trash',
					'archives' => 'Success Archives',
					'attributes' => 'Success Attributes',
					'insert_into_item' => 'Insert into success',
					'uploaded_to_this_item' => 'Uploaded to this success',
					'filter_items_list' => 'Filter successes list',
					'filter_by_date' => 'Filter successes by date',
					'items_list_navigation' => 'Successes list navigation',
					'items_list' => 'Successes list',
					'item_published' => 'Success published.',
					'item_published_privately' => 'Success published privately.',
					'item_reverted_to_draft' => 'Success reverted to draft.',
					'item_scheduled' => 'Success scheduled.',
					'item_updated' => 'Success updated.',
					'item_link' => 'Success Link',
					'item_link_description' => 'A link to a success.',
				),
				'public' => true,
				'show_in_rest' => true,
				'menu_icon' => 'dashicons-admin-post',
				'supports' => array(
					0 => 'title',
					1 => 'editor',
					2 => 'custom-fields',
				),
				'has_archive' => true,
				'rewrite' => array(
					'slug' => 'success-stories',
					'with_front' => false,
					'feeds' => false,
				),
				'delete_with_user' => false,
				'taxonomies' => array( 'category' ),
			)
		);
	}
);


function add_categories_to_pages() {
    register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'add_categories_to_pages' );

function add_taxonomy_support_to_pages() {
    add_post_type_support( 'page', 'category' );
}
add_action( 'init', 'add_taxonomy_support_to_pages' );
