<?php
/**
 * Admin View: Portfolio widget form featured image fields.
 * Displayed at Appearance → Widgets and in the Customizer.
 *
 * @package Genesis Portfolio Pro
 * @since   1.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<p>
	<input id="<?php echo esc_attr( $widget->get_field_id( 'show_image' ) ); ?>"
			type="checkbox"
			name="<?php echo esc_attr( $widget->get_field_name( 'show_image' ) ); ?>"
			value="1"<?php checked( $instance['show_image'] ); ?> />
	<label for="<?php echo esc_attr( $widget->get_field_id( 'show_image' ) ); ?>"><?php esc_html_e( 'Show Featured Image', 'genesis-portfolio-pro' ); ?></label>
</p>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'image_size' ) ); ?>"><?php esc_html_e( 'Image Size', 'genesis-portfolio-pro' ); ?>:</label>
	<select id="<?php echo esc_attr( $widget->get_field_id( 'image_size' ) ); ?>"
			class="genesis-image-size-selector"
			name="<?php echo esc_attr( $widget->get_field_name( 'image_size' ) ); ?>">
	<?php
	$sizes = genesis_get_image_sizes();
	foreach ( (array) $sizes as $name => $size ) {
		echo '<option value="' . esc_attr( $name ) . '" ' . selected( $name, $instance['image_size'], false ) . '>' . esc_html( $name ) . ' (' . absint( $size['width'] ) . 'x' . absint( $size['height'] ) . ')</option>';
	}
	?>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'image_alignment' ) ); ?>"><?php esc_html_e( 'Image Alignment', 'genesis-portfolio-pro' ); ?>:</label>
	<select id="<?php echo esc_attr( $widget->get_field_id( 'image_alignment' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'image_alignment' ) ); ?>">
		<option value="alignnone">- <?php esc_html_e( 'None', 'genesis-portfolio-pro' ); ?> -</option>
		<option value="alignleft" <?php selected( 'alignleft', $instance['image_alignment'] ); ?>><?php esc_html_e( 'Left', 'genesis-portfolio-pro' ); ?></option>
		<option value="alignright" <?php selected( 'alignright', $instance['image_alignment'] ); ?>><?php esc_html_e( 'Right', 'genesis-portfolio-pro' ); ?></option>
		<option value="aligncenter" <?php selected( 'aligncenter', $instance['image_alignment'] ); ?>><?php esc_html_e( 'Center', 'genesis-portfolio-pro' ); ?></option>
	</select>
</p>

<hr class="div" />
