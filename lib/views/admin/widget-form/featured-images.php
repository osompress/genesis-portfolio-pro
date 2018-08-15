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
	<input id="<?php echo $widget->get_field_id( 'show_image' ); ?>"
			type="checkbox"
			name="<?php echo esc_attr( $widget->get_field_name( 'show_image' ) ); ?>"
			value="1"<?php checked( $instance['show_image'] ); ?> />
	<label for="<?php echo esc_attr( $widget->get_field_id( 'show_image' ) ); ?>"><?php _e( 'Show Featured Image', 'genesis-portfolio-pro' ); ?></label>
</p>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'image_size' ) ); ?>"><?php _e( 'Image Size', 'genesis-portfolio-pro' ); ?>:</label>
	<select id="<?php echo esc_attr( $widget->get_field_id( 'image_size' ) ); ?>"
			class="genesis-image-size-selector"
			name="<?php echo esc_attr( $widget->get_field_name( 'image_size' ) ); ?>">
		<option value="thumbnail">thumbnail (<?php echo absint( get_option( 'thumbnail_size_w' ) ); ?>x<?php echo absint( get_option( 'thumbnail_size_h' ) ); ?>)</option>
	<?php
	$sizes = genesis_get_additional_image_sizes();
	foreach ( (array) $sizes as $name => $size ) {
		echo '<option value="' . esc_attr( $name ) . '" ' . selected( $name, $instance['image_size'], false ) . '>' . esc_html( $name ) . ' (' . absint( $size['width'] ) . 'x' . absint( $size['height'] ) . ')</option>';
	}
	?>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'image_alignment' ) ); ?>"><?php _e( 'Image Alignment', 'genesis-portfolio-pro' ); ?>:</label>
	<select id="<?php echo esc_attr( $widget->get_field_id( 'image_alignment' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'image_alignment' ) ); ?>">
		<option value="alignnone">- <?php _e( 'None', 'genesis-portfolio-pro' ); ?> -</option>
		<option value="alignleft" <?php selected( 'alignleft', $instance['image_alignment'] ); ?>><?php _e( 'Left', 'genesis-portfolio-pro' ); ?></option>
		<option value="alignright" <?php selected( 'alignright', $instance['image_alignment'] ); ?>><?php _e( 'Right', 'genesis-portfolio-pro' ); ?></option>
		<option value="aligncenter" <?php selected( 'aligncenter', $instance['image_alignment'] ); ?>><?php _e( 'Center', 'genesis-portfolio-pro' ); ?></option>
	</select>
</p>

<hr class="div" />
