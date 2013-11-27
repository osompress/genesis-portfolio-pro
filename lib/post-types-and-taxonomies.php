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
 
//registers "portfolio-type" taxonomy for the portfolio post type
register_taxonomy( 'portfolio-type', 'portfolio',
	array(
		'labels' => array(
			'name'          => _x( 'Types', 'taxonomy general name', 'executive' ),
			'add_new_item'  => __( 'Add New Portfolio Type', 'executive' ),
			'new_item_name' => __( 'New Portfolio Type', 'executive' ),
		),
		'exclude_from_search' => true,
		'has_archive'         => true,
		'hierarchical'        => true,
		'rewrite'             => array( 'slug' => 'portfolio-type', 'with_front' => false ),
		'show_ui'             => true,
		'show_tagcloud'       => false,
	)
);

//registers "portfolio" post type
register_post_type( 'portfolio',
	array(
		'labels' => array(
			'name'          => __( 'Portfolio', 'executive' ),
			'singular_name' => __( 'Portfolio', 'executive' ),
		),
		'has_archive'  => true,
		'hierarchical' => true,
		'menu_icon'    => GENESIS_PORTFOLIO_URL . 'lib/images/portfolio.png',
		'public'       => true,
		'rewrite'      => array( 'slug' => 'portfolio', 'with_front' => false ),
		'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes', 'genesis-seo', 'genesis-cpt-archives-settings' ),
		'taxonomies'   => array( 'portfolio-type' ),

	)
);

add_filter( 'manage_taxonomies_for_portfolio_columns', 'portfolio_columns' );
/**
 * Add Portfolio Type Taxonomy to columns
 *
 * @since 0.1.0
 *
 */
function portfolio_columns( $taxonomies ) {

    $taxonomies[] = 'portfolio-type';
    return $taxonomies;

}
