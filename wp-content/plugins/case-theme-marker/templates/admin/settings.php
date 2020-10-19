<?php
	$screen = get_current_screen();
	$pages = get_posts([
		'post_type' => 'page',
		'numberposts' => -1,
	]);
	$search_result_page_id = $settings->get_option('search_result_page', '');
	$search_result_page_not_found_id = $settings->get_option('search_result_page_not_found', '');
?>
<h1><?php echo __("Settings", CAT_TEXT_DOMAIN); ?></h1>
<form action="#" method="POST" enctype="multipart/form-data">
	<table class="form-table">
		<tbody>
			<tr class="marker-geo-location">
				<th>
					<label>
						<?php echo __('Google Maps API Key', CAT_TEXT_DOMAIN); ?>
					</label>
				</th>
				<td>
					<input type="text" name="marker_settings[google_maps_api_key]" id="google_maps_api_key" value="<?php echo $settings->get_option('google_maps_api_key', ''); ?>" class="regular-text">
				</td>
			</tr>
			<tr class="marker-search-result">
				<th>
					<label>
						<?php echo __('Search Result Page', CAT_TEXT_DOMAIN); ?>
					</label>
				</th>
				<td>
					<select class="select2 regular-text" name="marker_settings[search_result_page]" id="search_result_page">
						<option value=""><?php echo __("Select a Page", CAT_TEXT_DOMAIN); ?></option>
						<?php
							foreach ($pages as $page) :
						?>
							<option value="<?php echo esc_attr($page->ID); ?>" <?php echo $search_result_page_id == $page->ID?'selected':''; ?>><?php echo esc_html($page->post_title); ?></option>
						<?php
							endforeach;
						?>
					</select>
				</td>
			</tr>
			<tr class="marker-search-result-not-found">
				<th>
					<label>
						<?php echo __('Search Result Page Not Found', CAT_TEXT_DOMAIN); ?>
					</label>
				</th>
				<td>
					<select class="select2 regular-text" name="marker_settings[search_result_page_not_found]" id="search_result_page_not_found">
						<option value=""><?php echo __("Select a Page", CAT_TEXT_DOMAIN); ?></option>
						<?php
							foreach ($pages as $page) :
						?>
							<option value="<?php echo esc_attr($page->ID); ?>" <?php echo $search_result_page_not_found_id == $page->ID?'selected':''; ?>><?php echo esc_html($page->post_title); ?></option>
						<?php
							endforeach;
						?>
					</select>
				</td>
			</tr>
			<tr class="marker-search-within-radius">
				<th>
					<label>
						<?php echo __('Search within Radius Options', CAT_TEXT_DOMAIN); ?>
					</label>
				</th>
				<td>
					<input type="text" name="marker_settings[search_within_radius_options]" id="search_within_radius_options" value="<?php echo $settings->get_option('search_within_radius_options', '500,1000,2000,3000,5000'); ?>" class="regular-text">
				</td>
			</tr>
			<tr class="list-shortcodes">
				<th>
					<label>
						<?php echo __('Shortcodes', CAT_TEXT_DOMAIN); ?>
					</label>
				</th>
				<td>
					<p>[cat_marker_search_form]</p>
					<p>[cat_marker_search_result]</p>
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit">
		<button name="save" class="button-primary" type="submit"><?php echo __("Save changes", CAT_TEXT_DOMAIN); ?></button>
	</p>
</form>