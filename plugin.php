<?php
/*
  Plugin Name: Genesis Portfolio Pro
  Plugin URI:
  Description: Adds default portfolio to any Genesis HTML5 theme.
  Version: 1.0
  Author: copyblogger
  Author URI: http://www.copyblogger.com
  Text Domain: genesis-portfolio-pro
  Domain Path: /languages

*/

if ( ! defined( 'ABSPATH' ) ) {
	die( "Sorry, you are not allowed to access this page directly." );
}

add_action( 'plugins_loaded', 'genesis_portfolio_load_plugin_textdomain' );

/**
 * Callback on the `plugins_loaded` hook.
 * Loads the plugin text domain via load_plugin_textdomain()
 *
 * @uses load_plugin_textdomain()
 * @since 1.0.0
 * 
 * @access public
 * @return void
 */
function genesis_portfolio_load_plugin_textdomain() {
    load_plugin_textdomain( 'genesis-portfolio-pro', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}


define( 'GENESIS_PORTFOLIO_LIB', dirname( __FILE__ ) . '/lib/' );
define( 'GENESIS_PORTFOLIO_URL', plugins_url( '/', __FILE__ ) );

add_action( 'genesis_init', 'genesis_portfolio_init' );
/**
 * Init action loads required files and other actions.
 * Loaded on genesis_init hook to ensure genesis_ functions are available
 *
 * @since 0.1.0
 *
 * @uses GENESIS_PORTFOLIO_LIB
 *
 */
function genesis_portfolio_init() {

	require_once( GENESIS_PORTFOLIO_LIB . 'post-types-and-taxonomies.php' );

	if ( is_admin() ) {
		add_action( 'admin_enqueue_scripts', 'genesis_portfolio_load_admin_styles' );
	}
	else {
		require_once( GENESIS_PORTFOLIO_LIB . 'template-loader.php' );
	}

	add_action( 'after_setup_theme', 'genesis_portfolio_after_setup_theme' );

}

/**
 * Loads admin-style.css file
 *
 * @since 0.1.0
 *
 * @uses GENESIS_PORTFOLIO_URL
 *
 */
function genesis_portfolio_load_admin_styles() {

	wp_register_style( 'genesis_portfolio_pro_admin_css',
		GENESIS_PORTFOLIO_URL . 'lib/admin-style.css',
		false,
		'1.0.0'
	);
	wp_enqueue_style( 'genesis_portfolio_pro_admin_css' );

}

/**
 * Adds new portfolio image size if not already set in child theme
 *
 * @since 0.1.0
 *
 */
function genesis_portfolio_after_setup_theme(){

	global $_wp_additional_image_sizes;

	if ( ! isset( $_wp_additional_image_sizes['portfolio'] ) ) {
		add_image_size( 'portfolio', 300, 200, TRUE );
	}

}

register_activation_hook( __FILE__, 'genesis_portfolio_rewrite_flush' );
/**
 * Activation hook action to flush the rewrit rules for the custom post type and taxonomy
 *
 * @since 0.1.0
 *
 */
function genesis_portfolio_rewrite_flush() {

	require_once( GENESIS_PORTFOLIO_LIB . 'post-types-and-taxonomies.php' );


	flush_rewrite_rules();
}


/**
 * Removes all actions for the provided hooks by cycling through the hooks and getting the priority so the action is removed correctly.
 *
 * @access public
 * @param string $action
 * @param array $hooks (default: array())
 * @return void
 */
function genesis_portfolio_remove_actions( $action, $hooks = array() ) {

	foreach ( $hooks as $hook ) {
		if ( $priority = has_action( $hook, $action ) ) {
			remove_action( $hook, $action, $priority );
		}
	}

}

/**
 * Removes the specified action from the standard entry hooks.
 *
 * @access public
 * @param  string $action
 * @return void
 */
function genesis_portfolio_remove_entry_actions( $action ) {

	$hooks = array(
		'genesis_entry_header',
		'genesis_before_entry_content',
		'genesis_entry_content',
		'genesis_after_entry_content',
		'genesis_entry_footer',
		'genesis_after_entry',
	);

	genesis_portfolio_remove_actions( $action, $hooks );

}
