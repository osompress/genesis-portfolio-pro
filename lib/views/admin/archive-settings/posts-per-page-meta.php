<?php
/**
 * Admin View: Posts per page meta box.
 * Displayed at Portfolio Items → Archive Settings as “Items Per Page”.
 *
 * @package Genesis Portfolio Pro
 */

?>

<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row"><label for="<?php echo esc_attr( $label_attr ); ?>"><b><?php echo esc_html_e( 'Archives show at most', 'genesis-portfolio-pro' ); ?></b></label></th>
			<td><input name="<?php echo esc_attr( $name_attr ); ?>"
						type="number"
						step="1"
						min="1"
						id="<?php echo esc_attr( $label_attr ); ?>"
						value="<?php echo esc_attr( $value ); ?>"
						class="small-text"><?php esc_html_e( ' portfolio items', 'genesis-portfolio-pro' ); ?></td>
		</tr>
	</tbody>
</table>
