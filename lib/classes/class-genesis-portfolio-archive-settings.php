<?php
/**
 * The Portfolio Archive Settings.
 *
 * @author  StudioPress
 * @package Genesis Portfolio Pro
 * @since   1.2.0
 */

/**
 * Portfolio Archive Settings.
 *
 * @author     StudioPress
 * @package    Genesis Portfolio Pro
 */
class Genesis_Portfolio_Archive_Settings {

	/**
	 * Widget settings name.
	 *
	 * @var string
	 */
	public $settings_field;

	/**
	 * Builds the HTML output for the portfolio archive settings.
	 *
	 * @access public
	 * @param  mixed $pagehook Page hook for the CPT archive settings page.
	 * @return void
	 */
	public function __construct( $pagehook ) {

		$this->settings_field = GENESIS_CPT_ARCHIVE_SETTINGS_FIELD_PREFIX . 'portfolio';

		add_meta_box( 'post_per_page', __( 'Items Per Page', 'genesis-portfolio-pro' ), array( $this, 'posts_per_page_metabox' ), $pagehook, 'main', 'low' );

	}

	/**
	 * Callback on the `genesis_cpt_archives_settings_metaboxes` action.
	 * Checks to see if this is the correct page, then instantiates the object.
	 *
	 * @access public
	 * @static
	 * @param  string $pagehook Page hook for the CPT archive settings page.
	 */
	public static function register_metaboxes( $pagehook ) {

		if ( 'portfolio_page_genesis-cpt-archive-portfolio' !== $pagehook ) {
			return;
		}

		new static( $pagehook );

	}

	/**
	 * Callback for the posts_per_page metabox.
	 * Outputs the settings for the posts per page in the archives
	 *
	 * @access public
	 * @return void
	 */
	public function posts_per_page_metabox() {

		$opts = (array) get_option( $this->settings_field );

		$label_attr = $this->settings_field . '-posts_per_page';
		$name_attr  = $this->settings_field . '[posts_per_page]';
		$value      = $opts['posts_per_page'] ?: get_option( 'posts_per_page' ); // phpcs:ignore WordPress.PHP.DisallowShortTernary

		include GENESIS_PORTFOLIO_VIEWS . '/admin/archive-settings/posts-per-page-meta.php';

	}

}
