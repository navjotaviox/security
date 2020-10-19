<?php
	$search_result_page = CAT_Settings::get_option('search_result_page', '');
	$categories = get_terms( 'marker-category', array(
	    'hide_empty' => false,
	) );
?>
<div class="ct-marker-search">
	<div class="ct-marker-search-inner">
		<div class="ct-marker-search-form">
			<form action="<?php echo esc_url(get_permalink($search_result_page)); ?>" method="POST">
				<?php if(!is_wp_error($categories)): ?>
					<div class="ct-marker-categories">
						<?php
							$count = 0;
							foreach ($categories as $category) : ?>
							<input type="radio" name="marker_category" id="marker-category-<?php echo esc_attr($category->term_id); ?>" value="<?php echo esc_attr($category->term_id); ?>" style="display: none;" <?php echo $count==0?'checked':''; ?>>
							<span class="btn-marker-category <?php echo $count==0?'active cat-frist':''; ?>" data-target="#marker-category-<?php echo esc_attr($category->term_id); ?>"><?php echo esc_html($category->name); ?></span>
						<?php
							$count++;
							endforeach;
						?>
					</div>
				<?php endif; ?>
				<div class="ct-marker-search-meta">
					<input type="search" class="ct-marker-search-input" name="cat_marker_search_input" id="ct-marker-search-input" placeholder="<?php echo __("E.g London, UK", CAT_TEXT_DOMAIN); ?>">
					<input type="hidden" name="cat_marker_search_lat" id="ct-marker-search-lat" value="">
					<input type="hidden" name="cat_marker_search_lng" id="ct-marker-search-lng" value="">
					<input type="hidden" name="action" id="action" value="ct-marker-search">
					<button type="button" class="ct-marker-search-button"><?php echo __("Go", CAT_TEXT_DOMAIN); ?><i class="fac fa-angle-right"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>
