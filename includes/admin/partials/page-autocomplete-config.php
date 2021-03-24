<?php
/**
 * Autocomplete config admin template partial.
 *
 * @author  WebDevStudios <contact@webdevstudios.com>
 * @since   0.0.0
 *
 * @package DigitalCube\Galaxy
 */

?>

<table class="widefat table-autocomplete">
	<thead>
		<tr>
			<th style="width: 20px;"></th>
			<th style="width: 75px;"><?php esc_html_e( 'Enable', 'galaxy-wp-plugin' ); ?></th>
			<th><?php esc_html_e( 'Index', 'galaxy-wp-plugin' ); ?></th>
			<th><?php esc_html_e( 'Label', 'galaxy-wp-plugin' ); ?></th>
			<th style="width: 75px;"><?php esc_html_e( 'Max. Suggestions', 'galaxy-wp-plugin' ); ?></th>
			<th><?php esc_html_e( 'Actions', 'galaxy-wp-plugin' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $indices as $index ) : // phpcs:ignore -- This is an admin partial.  ?>
		<tr>
			<td>
				<span class="dashicons dashicons-move"></span>
				<input type="hidden" class="position-input" name="algolia_autocomplete_config[<?php echo esc_attr( $index['index_id'] ); ?>][position]"  value="<?php echo (int) $index['position']; ?>" />
			</td>
			<td>
				<input type="checkbox" name="algolia_autocomplete_config[<?php echo esc_attr( $index['index_id'] ); ?>][enabled]" <?php echo $index['enabled'] ? 'checked="checked"' : ''; ?>/>
			</td>
			<td>
				<?php echo esc_html( $index['admin_name'] ); ?><br>
				<small style="color: #999">
					<?php
					printf(
						/* translators: placeholder is the name of an Algolia search index. */
						esc_html__( 'Index name: %s', 'galaxy-wp-plugin' ),
						esc_html( $index['index_id'] )
					);
					?>
				</small>
			</td>
			<td>
				<input type="text" name="algolia_autocomplete_config[<?php echo esc_attr( $index['index_id'] ); ?>][label]"  value="<?php echo esc_attr( $index['label'] ); ?>" />
			</td>
			<td>
				<input style="width: 40px; text-align: center;" type="number" name="algolia_autocomplete_config[<?php echo esc_attr( $index['index_id'] ); ?>][max_suggestions]"  value="<?php echo (int) $index['max_suggestions']; ?>" />
			</td>
			<td>
				<button type="button" class="algolia-reindex-button button button-primary" data-index="<?php echo esc_attr( $index['index_id'] ); ?>"><?php esc_html_e( 'Re-index', 'galaxy-wp-plugin' ); ?></button>
				<button type="button" class="algolia-push-settings-button button" data-index="<?php echo esc_attr( $index['index_id'] ); ?>"><?php esc_html_e( 'Push Settings', 'galaxy-wp-plugin' ); ?></button>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<p class="description" id="home-description">
	<?php esc_html_e( 'Configure here the indices you want to display in the dropdown menu.', 'galaxy-wp-plugin' ); ?>
	<br />
	<?php esc_html_e( 'Use the `Max. Suggestions` column to configure the number of entries that will be displayed by section.', 'galaxy-wp-plugin' ); ?>
	<br />
	<?php esc_html_e( 'Use the `Position` column to reflect the order of the sections in the dropdown menu.', 'galaxy-wp-plugin' ); ?>
</p>
