<?php
/**
 * Portfolio Archive Settings.
 *
 * @author     StudioPress
 * @package    Genesis Portfolio Pro
 */
class Genesis_Portfolio_Archive_Settings {


	var $settings_field;

	/**
	 * Callback on the `genesis_cpt_archives_settings_metaboxes` action.
	 * Checks to see if this is the correct page, then instantiates the object.
	 *
	 * @access public
	 * @static
	 * @param  string $pagehook
	 * @return void
	 */
	public static function register_metaboxes( $pagehook ) {

		if ( 'portfolio_page_genesis-cpt-archive-portfolio' !== $pagehook ) {
			return;
		}

		new static( $pagehook );

	}

	/**
	 * Builds the HTML output for the portfolio archive settings.
	 *
	 * @access public
	 * @param  mixed $pagehook
	 * @return void
	 */
	public function __construct( $pagehook ) {

		$this->settings_field = GENESIS_CPT_ARCHIVE_SETTINGS_FIELD_PREFIX . 'portfolio';

		add_meta_box( 'post_per_page', __( 'Items Per Page', 'genesis-portfolio-pro' ), array( $this, 'posts_per_page_metabox' ), $pagehook, 'main', 'low' );

	}

	/**
	 * Callback for the posts_per_page metabox.
	 * Outputs the settings for the posts per page in the archives
	 *
	 * @access public
	 * @return void
	 */
	public function posts_per_page_metabox() {
		echo $this->get_post_per_page_setting();
	}

	/**
	 * Gets the posts per page setting HTML markup.
	 *
	 * @access public
	 * @return string
	 */
	public function get_post_per_page_setting() {

		$opts = (array) get_option( $this->settings_field );

		$key = 'posts_per_page';

		return sprintf(
			'<table class="form-table"><tbody>
				<tr valign="top">
					<th scope="row"><label for="%1$s-%2$s"><b>%3$s</b></label></th>
					<td><input name="%1$s[%2$s]" type="number" step="1" min="1" id="%1$s-%2$s" value="%5$s" class="small-text">%4$s</td>
				</tr>
			</tbody></table>',
			$this->settings_field,
			$key,
			__( 'Archives show at most', 'genesis-portfolio-pro' ),
			__( ' portfolio items', 'genesis-portfolio-pro' ),
			empty( $opts[ $key ] ) ? get_option( 'posts_per_page' ) : $opts[ $key ]
		);

	}

}
