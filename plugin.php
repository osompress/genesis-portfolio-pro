<?php
/*
  Plugin Name: Genesis Portfolio Pro
  Plugin URI:
  Description: Adds default portfolio to any Genesis HTML5 theme.
  Version: 1.1
  Author: StudioPress
  Author URI: http://www.studiopress.com
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
define( 'GENESIS_PORTFOLIO_URL', plugins_url( '/', __FILE__ )  );

spl_autoload_register( 'genesis_portfolio_autoload' );
/**
 * Callback for the `spl_autoload_register` function.
 * Requires class files for specified classes.
 *
 * @access public
 * @param  string $class
 * @return void
 */
function genesis_portfolio_autoload( $class ) {

	$classes = array(
		'Genesis_Portolio_Archive_Settings',
	);

	if ( in_array( $class, $classes ) ) {
		require sprintf( '%s/classes/class.%s.php', GENESIS_PORTFOLIO_LIB, $class );
	}

}

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

	//archive settings
	add_action( 'genesis_cpt_archives_settings_metaboxes', array( 'Genesis_Portolio_Archive_Settings', 'register_metaboxes' ) );

	add_action( 'genesis_settings_sanitizer_init'      , 'genesis_portfolio_archive_setting_sanitization'        );
	add_action( 'genesis_cpt_archive_settings_defaults', 'genesis_portfolio_archive_setting_defaults'    , 10, 2 );
	add_action( 'after_setup_theme'                    , 'genesis_portfolio_after_setup_theme'                   );

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
function genesis_portfolio_after_setup_theme() {

	global $_wp_additional_image_sizes;

	if ( ! isset( $_wp_additional_image_sizes['portfolio'] ) ) {
		add_image_size( 'portfolio', 300, 200, TRUE );
	}

}

/**
 * Callback on the `genesis_settings_sanitizer_init` hook.
 * Registers the sanitize method for the posts_per_page archive setting option
 *
 * @access public
 * @static
 * @return void
 */
function genesis_portfolio_archive_setting_sanitization() {

	genesis_add_option_filter(
		'absint',
		GENESIS_CPT_ARCHIVE_SETTINGS_FIELD_PREFIX . 'portfolio',
		array(
			'posts_per_page',
		)
	);

}

/**
 * Callback on the `genesis_cpt_archive_settings_defaults` filter.
 * Adds the archive setting for pagination
 *
 * @access public
 * @param  array  $defaults
 * @param  string $post_type
 * @return array
 */
function genesis_portfolio_archive_setting_defaults( $defaults = array(), $post_type ) {

	if ( 'portfolio' === $post_type ) {
		$defaults                   = (array) $defaults;
		$defaults['posts_per_page'] = get_option( 'posts_per_page' );
	}

	return $defaults;

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

add_filter( 'pre_get_posts', 'genesis_portfolio_archive_pre_get_posts', 999 );
/**
 * Callback on the pre_get_posts hook.
 * Changes the posts per page setting for portfolio and portfolio-type archives if set.
 *
 * @access public
 * @param  obj $query
 * @return void
 */
function genesis_portfolio_archive_pre_get_posts( $query ) {

	if ( ! $query->is_main_query() ) {
		return;
	}

	if ( ! $query->is_post_type_archive( 'portfolio' ) && ! $query->is_tax( 'portfolio-type' ) ) {
		return;
	}

	$opts = (array) get_option( GENESIS_CPT_ARCHIVE_SETTINGS_FIELD_PREFIX . 'portfolio' );

	if ( empty( $opts['posts_per_page'] ) ) {
		return;
	}

	$query->set( 'posts_per_page', intval( $opts['posts_per_page'] ) );

}
