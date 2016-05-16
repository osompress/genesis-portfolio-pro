<?php

//* Load Portfolio Stylesheet
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

/** Remove actions on before entry and setup the portfolio entry actions */
function genesis_portfolio_setup_loop(){

	$hooks = array(
		'genesis_before_entry',
		'genesis_entry_header',
		'genesis_before_entry_content',
		'genesis_entry_content',
		'genesis_after_entry_content',
		'genesis_entry_footer',
		'genesis_after_entry',
	);
	
	foreach( $hooks as $hook ){
		remove_all_actions( $hook );
	}
	
	add_action( 'genesis_entry_content'      , 'genesis_portfolio_grid'                );
	add_action( 'genesis_after_entry_content', 'genesis_entry_header_markup_open' , 5  );
	add_action( 'genesis_after_entry_content', 'genesis_entry_header_markup_close', 15 );
	add_action( 'genesis_after_entry_content', 'genesis_do_post_title'                 );
	
}

function genesis_portfolio_add_body_class( $classes ) {

   $classes[] = 'genesis-pro-portfolio';
   return $classes;
   
}

function genesis_portfolio_custom_post_class( $classes ) {

    if (is_main_query()) {
	    $classes[] = 'pro-portfolio';
	}

  return $classes;
}

/**
 * Callback on the `genesis_portfolio_grid` action.
 * Verifies there is an image attached to the portfolio item
 * then outputs the HTML for the image with classes for styling.
 * 
 * @uses genesis_get_image()
 * 
 * @access public
 * @return void
 */
function genesis_portfolio_grid() {
	
	$image = genesis_get_image( array(
		'format'  => 'html',
		'size'    => 'portfolio',
		'context' => 'archive',
		'attr'    => array ( 'alt' => the_title_attribute( 'echo=0', 'class' => 'portfolio-image' ) ),
	) );

    if ( $image ) {
        printf( '<div class="portfolio-featured-image"><a href="%s" rel="bookmark"></a></div>', get_permalink(), $image );

    }

}
