<?php
/**
 * Post Type and Taxonomies
 *
 * Registers and Formats post types and taxonomies
 *
 * @package Genesis Portfolio Pro
 * @author  StudioPress
 * @license GPL-2.0+
 */

// Registers "portfolio-type" taxonomy for the portfolio post type.
register_taxonomy(
	'portfolio-type',
	'portfolio',
	array(
		'labels'                => array(
			'name'                       => _x( 'Portfolio Types', 'taxonomy general name', 'genesis-portfolio-pro' ),
			'singular_name'              => _x( 'Portfolio Type', 'taxonomy singular name', 'genesis-portfolio-pro' ),
			'search_items'               => __( 'Search Portfolio Types', 'genesis-portfolio-pro' ),
			'popular_items'              => __( 'Popular Portfolio Types', 'genesis-portfolio-pro' ),
			'all_items'                  => __( 'All Types', 'genesis-portfolio-pro' ),
			'edit_item'                  => __( 'Edit Portfolio Type', 'genesis-portfolio-pro' ),
			'update_item'                => __( 'Update Portfolio Type', 'genesis-portfolio-pro' ),
			'add_new_item'               => __( 'Add New Portfolio Type', 'genesis-portfolio-pro' ),
			'new_item_name'              => __( 'New Portfolio Type Name', 'genesis-portfolio-pro' ),
			'separate_items_with_commas' => __( 'Separate Portfolio Types with commas', 'genesis-portfolio-pro' ),
			'add_or_remove_items'        => __( 'Add or remove Portfolio Types', 'genesis-portfolio-pro' ),
			'choose_from_most_used'      => __( 'Choose from the most used Portfolio Types', 'genesis-portfolio-pro' ),
			'not_found'                  => __( 'No Portfolio Types found.', 'genesis-portfolio-pro' ),
			'menu_name'                  => __( 'Portfolio Types', 'genesis-portfolio-pro' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
		),
		'exclude_from_search'   => true,
		'has_archive'           => true,
		'hierarchical'          => true,
		'rewrite'               => array(
			'slug'       => _x( 'portfolio-type', 'portfolio-type slug', 'genesis-portfolio-pro' ),
			'with_front' => false,
		),
		'show_ui'               => true,
		'show_tagcloud'         => false,
		'show_in_rest'          => true,
		'rest_base'             => 'portfolio-type',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	)
);

// Registers the "portfolio" post type.
register_post_type(
	'portfolio',
	array(
		'labels'       => array(
			'name'               => _x( 'Portfolio Items', 'post type general name', 'genesis-portfolio-pro' ),
			'singular_name'      => _x( 'Portfolio Item', 'post type singular name', 'genesis-portfolio-pro' ),
			'menu_name'          => _x( 'Portfolio Items', 'admin menu', 'genesis-portfolio-pro' ),
			'name_admin_bar'     => _x( 'Portfolio Item', 'add new on admin bar', 'genesis-portfolio-pro' ),
			'add_new'            => _x( 'Add New', 'Portfolio Item', 'genesis-portfolio-pro' ),
			'add_new_item'       => __( 'Add New Portfolio Item', 'genesis-portfolio-pro' ),
			'new_item'           => __( 'New Portfolio Item', 'genesis-portfolio-pro' ),
			'edit_item'          => __( 'Edit Portfolio Item', 'genesis-portfolio-pro' ),
			'view_item'          => __( 'View Portfolio Item', 'genesis-portfolio-pro' ),
			'all_items'          => __( 'All Portfolio Items', 'genesis-portfolio-pro' ),
			'search_items'       => __( 'Search Portfolio Items', 'genesis-portfolio-pro' ),
			'parent_item_colon'  => __( 'Parent Portfolio Items:', 'genesis-portfolio-pro' ),
			'not_found'          => __( 'No Portfolio Items found.', 'genesis-portfolio-pro' ),
			'not_found_in_trash' => __( 'No Portfolio Items found in Trash.', 'genesis-portfolio-pro' ),
		),
		'has_archive'  => true,
		'hierarchical' => true,
		'menu_icon'    => 'dashicons-format-gallery',
		'public'       => true,
		'show_in_rest' => true,
		'rewrite'      => array(
			'slug'       => _x( 'portfolio', 'portfolio slug', 'genesis-portfolio-pro' ),
			'with_front' => false,
		),
		'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes', 'genesis-seo', 'genesis-cpt-archives-settings' ),
		'taxonomies'   => array( 'portfolio-type' ),

	)
);

add_filter( 'manage_taxonomies_for_portfolio_columns', 'genesis_portfolio_columns' );
/**
 * Add Portfolio Type Taxonomy to columns
 *
 * @param array $taxonomies The list of taxonomies.
 * @since 0.1.0
 */
function genesis_portfolio_columns( $taxonomies ) {
	$taxonomies[] = 'portfolio-type';
	return $taxonomies;
}
