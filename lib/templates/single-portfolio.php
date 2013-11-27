<?php
/**
 * This file adds the custom portfolio post type single post template to the Executive Pro Theme.
 *
 * @author StudioPress
 * @package Executive Pro
 * @subpackage Customizations
 */
 
add_action( 'wp_enqueue_scripts', 'genesis_portfolio_load_default_styles' );
//* Load Admin Stylesheet
function genesis_portfolio_load_default_styles() {

	if( apply_filters( 'genesis_portfolio_load_default_styles', true ) ) {

		wp_register_style( 'genesis_portfolio', 
							GENESIS_PORTFOLIO_URL . 'lib/default.css',
							false, 
							'1.0.0' 
						);
		wp_enqueue_style( 'genesis_portfolio' );
	
	}

}
 
//* Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 5 );

//* Remove the author box on single posts
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Remove the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

genesis();
