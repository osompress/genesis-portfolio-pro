<?php
/**
 * The Portfolio Widget.
 *
 * @author  StudioPress
 * @package Genesis Portfolio Pro
 * @since   1.2.0
 */

/**
 * Genesis_Portfolio_Widget class.
 * Generates the “Genesis - Portfolio” Widget.
 */
class Genesis_Portfolio_Widget extends WP_Widget {


	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 1.2.0
	 */
	public function __construct() {

		$this->defaults = array(
			'title'             => '',

			'items_num'         => 3,
			'portfolio_type'    => '',
			'show_type'         => 0,
			'orderby'           => '',
			'order'             => '',

			'show_image'        => 0,
			'image_size'        => 'portfolio',
			'image_alignment'   => '',

			'show_title'        => 0,
			'show_content'      => '',
			'content_limit'     => '',
			'more_text'         => __( 'View More', 'genesis-portfolio-pro' ),

			'show_view_all'     => 0,
			'view_all_position' => 'bottom',
			'view_all_text'     => __( 'View All Items', 'genesis-portfolio-pro' ),
		);

		$widget_ops = array(
			'classname'   => 'featured-content featured-portfolio featuredpost',
			'description' => __( 'Displays one or more portfolio items.', 'genesis-portfolio-pro' ),
		);

		$control_ops = array(
			'id_base' => 'featured-portfolio',
			'width'   => 200,
			'height'  => 250,
		);

		parent::__construct( 'featured-portfolio', __( 'Genesis - Portfolio', 'genesis-portfolio-pro' ), $widget_ops, $control_ops );

	}

	/**
	 * Output the widget content on the front-end.
	 *
	 * @since 1.2.0
	 *
	 * @param array $args     Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {

		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		include GENESIS_PORTFOLIO_VIEWS . '/widget/portfolio.php';

	}

	/**
	 * Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @since 1.2.0
	 *
	 * @param  array $new_instance New settings for this instance as input by the user via form().
	 * @param  array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {

		$new_instance['title']     = wp_strip_all_tags( $new_instance['title'] );
		$new_instance['more_text'] = wp_strip_all_tags( $new_instance['more_text'] );
		return $new_instance;

	}

	/**
	 * Echo the settings update form.
	 *
	 * @since 1.2.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {

		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$widget = $this;

		include GENESIS_PORTFOLIO_VIEWS . '/admin/widget-form/widget-title.php';
		include GENESIS_PORTFOLIO_VIEWS . '/admin/widget-form/general.php';
		include GENESIS_PORTFOLIO_VIEWS . '/admin/widget-form/featured-images.php';
		include GENESIS_PORTFOLIO_VIEWS . '/admin/widget-form/portfolio-title.php';
		include GENESIS_PORTFOLIO_VIEWS . '/admin/widget-form/view-all.php';

	}

}
