<?php
/**
 * Admin View: Portfolio widget form view all link options.
 * Displayed at Appearance → Widgets and in the Customizer.
 *
 * @package Genesis Portfolio Pro
 * @since   1.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<p>
	<input id="<?php echo esc_attr( $widget->get_field_id( 'show_view_all' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $widget->get_field_name( 'show_view_all' ) ); ?>" value="1" <?php checked( $instance['show_view_all'] ); ?>/>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'show_view_all' ) ); ?>"><?php esc_html_e( 'Show ‘View All’ Link', 'genesis-portfolio-pro' ); ?></label>
</p>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'view_all_position' ) ); ?>"><?php esc_html_e( 'Link position', 'genesis-portfolio-pro' ); ?>:</label>
	<select id="<?php echo esc_attr( $widget->get_field_id( 'view_all_position' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'view_all_position' ) ); ?>">
		<option value="bottom" <?php selected( 'bottom', $instance['view_all_position'] ); ?>><?php esc_html_e( 'Bottom', 'genesis-portfolio-pro' ); ?></option>
		<option value="top" <?php selected( 'top', $instance['view_all_position'] ); ?>><?php esc_html_e( 'Top', 'genesis-portfolio-pro' ); ?></option>
	</select>
</p>
<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'view_all_text' ) ); ?>"><?php esc_html_e( 'Link Text', 'genesis-portfolio-pro' ); ?>:</label>
	<input type="text" id="<?php echo esc_attr( $widget->get_field_id( 'view_all_text' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'view_all_text' ) ); ?>" value="<?php echo esc_attr( $instance['view_all_text'] ); ?>" />
</p>
