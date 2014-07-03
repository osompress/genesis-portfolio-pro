<?php
/**
 * This file adds the portfolio type taxonomy archive template to the Executive Pro Theme.
 *
 * @author StudioPress
 * @package Genesis Portfolio Pro
 * @subpackage Customizations
 */
 
//* Remove the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_action( 'wp_enqueue_scripts', 'genesis_portfolio_load_default_styles' );
add_action( 'genesis_loop', 'genesis_portfolio_setup_loop', 9 );

//* Add portfolio body class to the head
add_filter( 'body_class', 'genesis_portfolio_add_body_class'   );
add_filter('post_class' , 'genesis_portfolio_custom_post_class');

genesis();
