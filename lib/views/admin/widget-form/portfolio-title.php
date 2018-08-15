<?php
/**
 * Admin View: Portfolio widget form individual portfolio title field options.
 * Displayed at Appearance → Widgets and in the Customizer.
 *
 * @package Genesis Portfolio Pro
 * @since   1.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<p>
	<input id="<?php echo esc_attr( $widget->get_field_id( 'show_title' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $widget->get_field_name( 'show_title' ) ); ?>" value="1" <?php checked( $instance['show_title'] ); ?>/>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'show_title' ) ); ?>"><?php esc_html_e( 'Show Portfolio Item Title', 'genesis-portfolio-pro' ); ?></label>
</p>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'show_content' ) ); ?>"><?php esc_html_e( 'Content Type', 'genesis-portfolio-pro' ); ?>:</label>
	<select id="<?php echo esc_attr( $widget->get_field_id( 'show_content' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'show_content' ) ); ?>">
		<option value="" <?php selected( '', $instance['show_content'] ); ?>><?php esc_html_e( 'No Content', 'genesis-portfolio-pro' ); ?></option>
		<option value="content" <?php selected( 'content', $instance['show_content'] ); ?>><?php esc_html_e( 'Show All Content', 'genesis-portfolio-pro' ); ?></option>
		<option value="excerpt" <?php selected( 'excerpt', $instance['show_content'] ); ?>><?php esc_html_e( 'Show Excerpt', 'genesis-portfolio-pro' ); ?></option>
		<option value="content-limit" <?php selected( 'content-limit', $instance['show_content'] ); ?>><?php esc_html_e( 'Show Content Limit', 'genesis-portfolio-pro' ); ?></option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'content_limit' ) ); ?>"><?php esc_html_e( 'Limit content to', 'genesis-portfolio-pro' ); ?>
		<input type="text" id="<?php echo esc_attr( $widget->get_field_id( 'content_limit' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'content_limit' ) ); ?>" value="<?php echo esc_attr( (int) $instance['content_limit'] ); ?>" size="3" />
	<?php esc_html_e( 'characters', 'genesis-portfolio-pro' ); ?>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'more_text' ) ); ?>"><?php esc_html_e( 'More Text', 'genesis-portfolio-pro' ); ?>:</label>
	<input type="text" id="<?php echo esc_attr( $widget->get_field_id( 'more_text' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'more_text' ) ); ?>" value="<?php echo esc_attr( $instance['more_text'] ); ?>" />
</p>

<hr class="div" />
