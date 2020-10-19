<?php
$filters = isset($_COOKIE["cat_marker_filters"])?unserialize(str_replace('\\', '', $_COOKIE['cat_marker_filters'])):[];
if(!empty($filters)) {
	$radius_options = CAT_Settings::get_option('search_within_radius_options', '500,1000,2000,3000,5000');
	$radius_options = explode(',', $radius_options);
	$radius = isset($_REQUEST['radius'])?floatval($_REQUEST['radius']):floatval($radius_options[0]);
	$filters['radius'] = $radius;
	$limit = isset($_REQUEST['limit'])?intval($_REQUEST['limit']):10;
	$page = !empty(get_query_var('page'))?get_query_var('page'):1;
	$markers = CAT_Shortcode::get_search_result($page, $limit, $filters);
	$total = intval(CAT_Shortcode::get_search_total_result($filters));
	$totalPage = ceil($total / $limit); ?>
	<div class="ct-marker-search-results">
		<div class="ct-marker-search-meta">
			<div class="ct-marker-search-left">
				<div class="results-counting">
					<span class="results-from"><?php echo esc_html(($limit * ($page - 1)) + 1); ?></span>
					-
					<span class="results-to"><?php echo esc_html(($limit * $page) < $total ? ($limit * $page) : $total); ?></span>
					of
					<span class="results-total"><?php echo esc_attr($total); ?></span>
				</div>
				<div class="results-limitation">
					<label><?php echo esc_html__('Displaying', CAT_TEXT_DOMAIN); ?></label>
					<select id="results-limitation">
						<option value="10" <?php echo $limit == 10 ? 'selected' : ''; ?>>10</option>
						<option value="50" <?php echo $limit == 50 ? 'selected' : ''; ?>>50</option>
						<option value="100" <?php echo $limit == 100 ? 'selected' : ''; ?>>100</option>
					</select>
				</div>
			</div>
			<div class="search-within-radius">
				<?php
					$radius_options = CAT_Settings::get_option('search_within_radius_options', '500,1000,2000,3000,5000');
					$radius_options = explode(',', $radius_options);
				?>
				<select id="search-within-radius">
					<?php
						foreach ($radius_options as $r) :
							$r = floatval($r);
					?>
						<option value="<?php echo esc_attr($r) ?>" <?php echo $radius == $r ? 'selected' : ''; ?>><?php echo esc_attr($r) ?> km</option>
					<?php
						endforeach;
					?>
				</select>
			</div>
		</div>
		<div class="ct-marker-list">
			<?php $count = 0;
			foreach($markers as $marker):
				$count++;
				$_post = get_post($marker['ID']);
				$marker_full_address = get_post_meta($_post->ID, 'marker_full_address', true);
				$marker_email = get_post_meta($_post->ID, 'marker_email', true);
				$marker_phone = get_post_meta($_post->ID, 'marker_phone', true);
				$marker_hour = get_post_meta($_post->ID, 'marker_hour', true); ?>
				<div class="ct-marker-item">
					<div class="ct-marker-count">
						<span><?php echo esc_html($count); ?></span>
					</div>
					<div class="ct-marker-info">
						<h3 class="ct-marker-title">
							<?php echo esc_html($_post->post_title); ?>
						</h3>
						<div class="ct-marker-meta">
							<div class="ct-marker-full-addres">
								<label><?php echo esc_html__('Address:', CAT_TEXT_DOMAIN); ?></label>
								<?php echo esc_html($marker_full_address); ?>
							</div>
							<div class="ct-marker-email">
								<label><?php echo esc_html__('Email:', CAT_TEXT_DOMAIN); ?></label>
								<a href="mailto:<?php echo esc_html($marker_email); ?>"><?php echo esc_html($marker_email); ?></a>
							</div>
							<div class="ct-marker-phone">
								<label><?php echo esc_html__('Telephone:', CAT_TEXT_DOMAIN); ?></label>
								<a href="tel:<?php echo esc_html($marker_phone); ?>"><?php echo esc_html($marker_phone); ?></a>
							</div>
							<div class="ct-marker-hour">
								<label><?php echo esc_html__('Working Hours:', CAT_TEXT_DOMAIN); ?></label>
								<?php echo esc_html($marker_hour); ?>
							</div>
							<div class="ct-marker-distance distance-mobile">
								<?php echo esc_html(round($marker['distance_in_km'], 2, PHP_ROUND_HALF_UP)); ?>
								<span class="ct-marker-distance-unit">km</span>
							</div>
						</div>
					</div>
					<div class="ct-marker-distance">
						<?php echo esc_html(round($marker['distance_in_km'], 2, PHP_ROUND_HALF_UP)); ?>
						<span class="ct-marker-distance-unit">km</span>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if($totalPage > 1): ?>
			<div class="ct-marker-pagination">
				<a href="javascript:void(0)" data-page="<?php echo esc_attr($page - 1); ?>" class=" prev <?php echo $page == 1 ? 'disable' : '' ?>" title="<?php echo __("Previous Page"); ?>"><i class="fac fa-angle-left"></i></a>
				<a href="javascript:void(0)" data-page="<?php echo esc_attr($page + 1); ?>" class=" next <?php echo $page == $totalPage ? 'disable' : '' ?>" title="<?php echo __("Next Page"); ?>"><i class="fac fa-angle-right"></i></a>
			</div>
		<?php endif; ?>
	</div>
<?php } else { ?>
	<?php echo do_shortcode('[cat_marker_search_form]'); ?>
<?php } ?>