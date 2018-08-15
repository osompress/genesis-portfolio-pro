<?php
/**
 * The portfolio type taxonomy archive template.
 *
 * @author     StudioPress
 * @package    Genesis Portfolio Pro
 * @subpackage Customizations
 */

add_filter( 'genesis_site_layout', 'genesis_portfolio_taxonomy_template_layout' );
/**
 * Callback on the `genesis_site_layout` filter.
 * Force fullwidth content in the archive layout unless there is a specific taxonomy layout set.
 *
 * @access public
 * @param  string $layout The current layout.
 * @return string
 */
function genesis_portfolio_taxonomy_template_layout( $layout ) {
	global $wp_query;

	$term   = $wp_query->get_queried_object();
	$opt    = get_term_meta( $term->term_id, 'layout', true );
	$layout = ( $term && isset( $term->term_id ) && $opt ) ? $opt : __genesis_return_full_width_content();

	return $layout;
}

// * Remove the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_action( 'wp_enqueue_scripts', 'genesis_portfolio_load_default_styles' );
add_action( 'genesis_loop', 'genesis_portfolio_setup_loop', 9 );

// * Add portfolio body class to the head
add_filter( 'body_class', 'genesis_portfolio_add_body_class' );
add_filter( 'post_class', 'genesis_portfolio_custom_post_class' );

genesis();
