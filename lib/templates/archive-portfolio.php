<?php
/**
 * The portfolio type taxonomy archive template.
 *
 * @author     StudioPress
 * @package    Genesis Portfolio Pro
 * @subpackage Customizations
 */

add_filter( 'genesis_site_layout', 'genesis_portfolio_archive_template_layout' );
/**
 * Callback on the `genesis_site_layout` filter.
 * Force fullwidth content in the archive layout unless there is a specific archive layout set.
 *
 * @access public
 * @param  string $layout The current layout.
 * @return string
 */
function genesis_portfolio_archive_template_layout( $layout ) {
	$archive_opts = get_option( 'genesis-cpt-archive-settings-portfolio' );
	$layout       = empty( $archive_opts['layout'] ) ? __genesis_return_full_width_content() : $archive_opts['layout'];

	return $layout;

}

// Remove the breadcrumb navigation.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_action( 'wp_enqueue_scripts', 'genesis_portfolio_load_default_styles' );
add_action( 'genesis_loop', 'genesis_portfolio_setup_loop', 9 );

// Add portfolio body class to the head.
add_filter( 'body_class', 'genesis_portfolio_add_body_class' );
add_filter( 'post_class', 'genesis_portfolio_custom_post_class' );

genesis();
