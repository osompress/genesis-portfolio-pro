<?php
/**
 * Admin View: Portfolio widget form general settings.
 * Displayed at Appearance → Widgets and in the Customizer.
 *
 * @package Genesis Portfolio Pro
 * @since   1.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'items_num' ) ); ?>"><?php esc_html_e( 'Number of Items to Show', 'genesis-portfolio-pro' ); ?>:</label>
	<input type="text" id="<?php echo esc_attr( $widget->get_field_id( 'items_num' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'items_num' ) ); ?>" value="<?php echo esc_attr( $instance['items_num'] ); ?>" size="2" />
</p>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'portfolio_type' ) ); ?>"><?php esc_html_e( 'Portfolio Type', 'genesis-portfolio-pro' ); ?>:</label>
	<?php
	$portfolio_types = array(
		'name'             => $widget->get_field_name( 'portfolio_type' ),
		'id'               => $widget->get_field_id( 'portfolio_type' ),
		'selected'         => $instance['portfolio_type'],
		'orderby'          => 'name',
		'hierarchical'     => 1,
		'show_option_none' => __( 'All Types', 'genesis-portfolio-pro' ),
		'hide_empty'       => '0',
		'taxonomy'         => 'portfolio-type',
	);
	wp_dropdown_categories( $portfolio_types );
	?>
</p>

<p>
	<input id="<?php echo esc_attr( $widget->get_field_id( 'show_type' ) ); ?>"
			type="checkbox"
			name="<?php echo esc_attr( $widget->get_field_name( 'show_type' ) ); ?>"
			value="1"<?php checked( $instance['show_type'] ); ?> />
	<label for="<?php echo esc_attr( $widget->get_field_id( 'show_type' ) ); ?>"><?php esc_html_e( 'Show Portfolio Type', 'genesis-portfolio-pro' ); ?></label>
</p>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order By', 'genesis-portfolio-pro' ); ?>:</label>
	<select id="<?php echo esc_attr( $widget->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'orderby' ) ); ?>">
		<option value="date" <?php selected( 'date', $instance['orderby'] ); ?>><?php esc_html_e( 'Date Published', 'genesis-portfolio-pro' ); ?></option>
		<option value="modified" <?php selected( 'modified', $instance['orderby'] ); ?>><?php esc_html_e( 'Date Modified', 'genesis-portfolio-pro' ); ?></option>
		<option value="title" <?php selected( 'title', $instance['orderby'] ); ?>><?php esc_html_e( 'Title', 'genesis-portfolio-pro' ); ?></option>
		<option value="menu_order" <?php selected( 'menu_order', $instance['orderby'] ); ?>><?php esc_html_e( 'Menu Order', 'genesis-portfolio-pro' ); ?></option>
		<option value="rand" <?php selected( 'rand', $instance['orderby'] ); ?>><?php esc_html_e( 'Random', 'genesis-portfolio-pro' ); ?></option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Sort Order', 'genesis-portfolio-pro' ); ?>:</label>
	<select id="<?php echo esc_attr( $widget->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'order' ) ); ?>">
		<option value="DESC" <?php selected( 'DESC', $instance['order'] ); ?>><?php esc_html_e( 'Descending (3, 2, 1)', 'genesis-portfolio-pro' ); ?></option>
		<option value="ASC" <?php selected( 'ASC', $instance['order'] ); ?>><?php esc_html_e( 'Ascending (1, 2, 3)', 'genesis-portfolio-pro' ); ?></option>
	</select>
</p>

<hr class="div" />
