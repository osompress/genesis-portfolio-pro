<?php
/**
 * Admin View: Portfolio widget form title.
 * Displayed at Appearance → Widgets and in the Customizer.
 *
 * @package Genesis Portfolio Pro
 * @since   1.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<p>
	<label for="<?php echo $widget->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'genesis-portfolio-pro' ); ?>:</label>
	<input type="text"
			id="<?php echo $widget->get_field_id( 'title' ); ?>"
			name="<?php echo esc_attr( $widget->get_field_name( 'title' ) ); ?>"
			value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
</p>

<hr class="div" />
