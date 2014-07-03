<?php
/**
 * This file adds the custom portfolio post type single post template to the Executive Pro Theme.
 *
 * @author StudioPress
 * @package Executive Pro
 * @subpackage Customizations
 */
 
add_action( 'wp_enqueue_scripts', 'genesis_portfolio_load_default_styles' );

//* Remove the breadcrumb navigation
remove_action( 'genesis_before_loop' , 'genesis_do_breadcrumbs'          );
remove_action( 'genesis_entry_header', 'genesis_post_info'           , 5 );
remove_action( 'genesis_after_entry' , 'genesis_do_author_box_single', 8 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta'               );

genesis();
