<?php
	$marker_lat = get_post_meta($marker->ID, 'marker_lat', true);
	$marker_lng = get_post_meta($marker->ID, 'marker_lng', true);
	$marker_zoom = get_post_meta($marker->ID, 'marker_zoom', true);
	$marker_full_address = get_post_meta($marker->ID, 'marker_full_address', true);
	$marker_email = get_post_meta($marker->ID, 'marker_email', true);
	$marker_phone = get_post_meta($marker->ID, 'marker_phone', true);
	$marker_hour = get_post_meta($marker->ID, 'marker_hour', true);
?>

<table class="form-table">
	<tbody>
		<tr class="marker-full-address">
			<th>
				<label>
					<?php echo __('Full Address', CAT_TEXT_DOMAIN); ?>
				</label>
			</th>
			<td>
				<input type="text" class="regular-text" name="marker_full_address" id="marker_full_address" value="<?php echo esc_attr($marker_full_address); ?>">
			</td>
		</tr>
		<tr class="marker-email">
			<th>
				<label>
					<?php echo __('Email', CAT_TEXT_DOMAIN); ?>
				</label>
			</th>
			<td>
				<input type="text" class="regular-text" name="marker_email" id="marker_email" value="<?php echo esc_attr($marker_email); ?>">
			</td>
		</tr>
		<tr class="marker-phone">
			<th>
				<label>
					<?php echo __('Telephone', CAT_TEXT_DOMAIN); ?>
				</label>
			</th>
			<td>
				<input type="text" class="regular-text" name="marker_phone" id="marker_phone" value="<?php echo esc_attr($marker_phone); ?>">
			</td>
		</tr>
		<tr class="marker-hour">
			<th>
				<label>
					<?php echo __('Working Hours', CAT_TEXT_DOMAIN); ?>
				</label>
			</th>
			<td>
				<input type="text" class="regular-text" name="marker_hour" id="marker_hour" value="<?php echo esc_attr($marker_hour); ?>">
			</td>
		</tr>
		<tr class="marker-geo-location">
			<th>
				<label>
					<?php echo __('Geo Location', CAT_TEXT_DOMAIN); ?>
					<span class="description"> (<?php echo __('required', CAT_TEXT_DOMAIN);  ?>)</span>
				</label>
			</th>
			<td>
				<div class="marker_geo_location" style="height: 500px">
					<input type="search" class="marker_search regular-text" name="marker_search" id="marker_search" placeholder="<?php echo __("Enter Address", CAT_TEXT_DOMAIN); ?>" style="border-radius: 0;margin: 15px;" >
					<div class="marker_content" style="height: 100%;"></div>
					<input type="hidden" class="marker_location marker_lat" name="marker_lat" id="marker_lat" value="<?php echo esc_attr($marker_lat); ?>">
					<input type="hidden" class="marker_location marker_lng" name="marker_lng" id="marker_lng" value="<?php echo esc_attr($marker_lng); ?>">
					<input type="hidden" class="marker_location marker_zoom" name="marker_zoom" id="marker_zoom" value="<?php echo esc_attr($marker_zoom); ?>">
				</div>
			</td>
		</tr>
	</tbody>
</table>