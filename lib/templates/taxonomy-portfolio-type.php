<?php
/**
 * This file adds the portfolio type taxonomy archive template to the Executive Pro Theme.
 *
 * @author StudioPress
 * @package Genesis Portfolio Pro
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

add_action( 'genesis_before_entry', 'genesis_portfolio_remove_default_entry_actions' );

/** Replaces Existing Genesis Menu */
function genesis_portfolio_remove_default_entry_actions() {
	
	$actions = array( 
		'genesis_post_info', 
		'genesis_post_meta', 
		'genesis_do_post_image',
		'genesis_do_post_content',
	);
	
	foreach ( $actions as $action ) {
		genesis_portfolio_remove_entry_actions( $action );
	}

}


//* Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );


//* Add portfolio body class to the head
add_filter( 'body_class', 'genesis_portfolio_add_body_class' );
function genesis_portfolio_add_body_class( $classes ) {

   $classes[] = 'genesis-pro-portfolio';
   return $classes;
   
}

//* Add the featured image after post title
add_action( 'genesis_entry_header', 'genesis_portfolio_grid' );
function genesis_portfolio_grid() {

    if ( $image = genesis_get_image( 'format=url&size=portfolio' ) ) {
        printf( '<div class="portfolio-featured-image"><a href="%s" rel="bookmark"><img src="%s" alt="%s" /></a></div>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );

    }

}

genesis();
