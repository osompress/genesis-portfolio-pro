<?php
/**
 * Global `genesis_portfolio_` functions.
 *
 * @author     StudioPress
 * @package    Genesis Portfolio Pro
 */

/**
 * Loads the default.css file via wp_enqueue_style.
 * unless the `genesis_portfolio_load_default_styles` is set to a falsie value.
 *
 * @access public
 * @return void
 */
function genesis_portfolio_load_default_styles() {
	/**
	 * Allows disabling the default.css file.
	 *
	 * @param boolean (default = true)
	 */
	if ( apply_filters( 'genesis_portfolio_load_default_styles', true ) ) {

		wp_register_style(
			'genesis_portfolio',
			GENESIS_PORTFOLIO_URL . 'lib/default.css',
			false,
			'1.0.0'
		);
		wp_enqueue_style( 'genesis_portfolio' );

	}

}

/**
 * Remove actions on before entry and setup the portfolio entry actions.
 */
function genesis_portfolio_setup_loop() {
	$hooks = array(
		'genesis_before_entry',
		'genesis_entry_header',
		'genesis_before_entry_content',
		'genesis_entry_content',
		'genesis_after_entry_content',
		'genesis_entry_footer',
		'genesis_after_entry',
	);

	foreach ( $hooks as $hook ) {
		remove_all_actions( $hook );
	}

	add_action( 'genesis_entry_content', 'genesis_portfolio_grid' );
	add_action( 'genesis_after_entry_content', 'genesis_entry_header_markup_open', 5 );
	add_action( 'genesis_after_entry_content', 'genesis_entry_header_markup_close', 15 );
	add_action( 'genesis_after_entry_content', 'genesis_do_post_title' );

}

/**
 * Callback on the `body_classes` filter.
 * Adds the `genesis-por-portfolio` body class on portfolio archive and single pages.
 *
 * @access public
 * @param  array $classes The current body classes.
 * @return array
 */
function genesis_portfolio_add_body_class( $classes ) {
	$classes[] = 'genesis-pro-portfolio';
	return $classes;

}

/**
 * Callback on the `post_classes` filter.
 * Adds the pro-portfolio class to the main query on portfolio archive and single views
 *
 * @access public
 * @param  array $classes The current post classes.
 * @return array
 */
function genesis_portfolio_custom_post_class( $classes ) {
	if ( is_main_query() ) {
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

	$image_id  = get_post_thumbnail_id();
	$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

	$image = genesis_get_image(
		array(
			'format'  => 'html',
			'size'    => 'portfolio',
			'context' => 'archive',
			'attr'    => array(
				'alt'      => $image_alt,
				'class'    => 'portfolio-image',
				'itemprop' => 'image',
			),
		)
	);

	if ( $image ) {
		genesis_markup(
			array(
				'open'    => '<div class="portfolio-featured-image"><a href="' . get_permalink() . '" aria-hidden="true">',
				'close'   => '</a></div>',
				'content' => $image,
				'context' => 'portfolio-pro',
			)
		);
	}

}
