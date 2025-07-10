<?php
/**
 * The template for displaying tours archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TZnew
 */

get_header();
?>

<main id="primary" class="site-main">
	<!-- Hero Section -->
	<section class="relative bg-gradient-to-br from-green-600 via-green-700 to-teal-800 py-20">
		<div class="absolute inset-0 bg-black/20"></div>
		<div class="relative z-10 container mx-auto px-4 text-center text-white">
			<h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
				<?php esc_html_e('Tour Packages', 'tznew'); ?>
			</h1>
			<p class="text-xl md:text-2xl text-green-100 max-w-3xl mx-auto leading-relaxed">
				<?php esc_html_e('Explore amazing destinations and create unforgettable memories with our carefully crafted tour packages', 'tznew'); ?>
			</p>
		</div>
	</section>

	<!-- Filter Section -->
	<section class="bg-white border-b border-gray-200 py-6">
		<div class="container mx-auto px-4">
			<div class="flex flex-wrap items-center justify-between gap-4">
				<div class="flex items-center space-x-4">
					<span class="text-gray-700 font-medium"><?php esc_html_e('Filter by:', 'tznew'); ?></span>
					
					<!-- Region Filter -->
					<select id="region-filter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">
						<option value=""><?php esc_html_e('All Regions', 'tznew'); ?></option>
						<?php
						$regions = get_terms(array(
							'taxonomy' => 'region',
							'hide_empty' => true,
						));
						if (!is_wp_error($regions) && !empty($regions)) :
							foreach ($regions as $region) :
								?>
								<option value="<?php echo esc_attr($region->slug); ?>"><?php echo esc_html($region->name); ?></option>
								<?php
							endforeach;
						endif;
						?>
					</select>
					
					<!-- Tour Type Filter -->
					<select id="tour-type-filter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">
						<option value=""><?php esc_html_e('All Tour Types', 'tznew'); ?></option>
						<?php
						$tour_types = get_terms(array(
							'taxonomy' => 'tour_type',
							'hide_empty' => true,
						));
						if (!is_wp_error($tour_types) && !empty($tour_types)) :
							foreach ($tour_types as $tour_type) :
								?>
								<option value="<?php echo esc_attr($tour_type->slug); ?>"><?php echo esc_html($tour_type->name); ?></option>
								<?php
							endforeach;
						endif;
						?>
					</select>
				</div>
				
				<div class="flex items-center space-x-2">
					<span class="text-gray-700 text-sm"><?php esc_html_e('Sort by:', 'tznew'); ?></span>
					<select id="sort-filter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">
						<option value="date"><?php esc_html_e('Latest', 'tznew'); ?></option>
						<option value="title"><?php esc_html_e('Name A-Z', 'tznew'); ?></option>
						<option value="price"><?php esc_html_e('Price', 'tznew'); ?></option>
					</select>
				</div>
			</div>
		</div>
	</section>

	<!-- Tours Grid -->
	<section class="py-12 bg-gray-50">
		<div class="container mx-auto px-4">
			<?php if (have_posts()) : ?>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="tours-grid">
					<?php
					while (have_posts()) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2'); ?>>
							<!-- Tour Image -->
							<div class="relative h-64 overflow-hidden">
								<?php if (has_post_thumbnail()) : ?>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover transition-transform duration-300 hover:scale-110')); ?>
									</a>
								<?php else : ?>
									<div class="w-full h-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
										<i class="fas fa-camera text-white text-4xl opacity-50"></i>
									</div>
								<?php endif; ?>
								
								<!-- Tour Type Badge -->
								<?php if (function_exists('tznew_get_field_safe')) : ?>
									<?php $tour_type = tznew_get_field_safe('tour_type', get_the_ID()); ?>
									<?php if (!empty($tour_type)) : ?>
										<div class="absolute top-4 left-4">
											<span class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
												<?php echo esc_html(ucfirst($tour_type)); ?>
											</span>
										</div>
									<?php endif; ?>
								<?php endif; ?>
								
								<!-- Price Badge -->
								<?php if (function_exists('tznew_get_field_safe')) : ?>
									<?php $price = tznew_get_field_safe('price', get_the_ID()); ?>
									<?php if (!empty($price)) : ?>
										<div class="absolute top-4 right-4">
											<span class="bg-white text-green-600 px-3 py-1 rounded-full text-sm font-bold shadow-lg">
												$<?php echo esc_html($price); ?>
											</span>
										</div>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							
							<!-- Tour Content -->
							<div class="p-6">
								<h2 class="text-xl font-bold mb-3 text-gray-800 hover:text-green-600 transition-colors duration-300">
									<a href="<?php the_permalink(); ?>" class="block">
										<?php the_title(); ?>
									</a>
								</h2>
								
								<?php if (function_exists('tznew_get_field_safe')) : ?>
									<?php $overview = tznew_get_field_safe('overview', get_the_ID()); ?>
									<?php if (!empty($overview)) : ?>
										<p class="text-gray-600 mb-4 leading-relaxed">
											<?php echo esc_html(wp_trim_words($overview, 20)); ?>
										</p>
									<?php endif; ?>
								<?php endif; ?>
								
								<!-- Tour Meta -->
								<div class="flex items-center justify-between text-sm text-gray-500 mb-4">
									<?php if (function_exists('tznew_get_field_safe')) : ?>
										<?php $duration = tznew_get_field_safe('duration', get_the_ID()); ?>
										<?php if (!empty($duration)) : ?>
											<span class="flex items-center">
												<i class="fas fa-clock mr-1 text-green-600"></i>
												<?php echo esc_html($duration); ?> <?php echo _n('Day', 'Days', $duration, 'tznew'); ?>
											</span>
										<?php endif; ?>
										
										<?php $region = tznew_get_field_safe('region', get_the_ID()); ?>
										<?php if (!empty($region)) : ?>
											<span class="flex items-center">
												<i class="fas fa-location-dot mr-1 text-green-600"></i>
												<?php echo esc_html($region); ?>
											</span>
										<?php endif; ?>
									<?php endif; ?>
								</div>
								
								<!-- Action Buttons -->
								<div class="flex space-x-2">
									<a href="<?php the_permalink(); ?>" class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center py-2 px-4 rounded-lg transition-colors duration-300 text-sm font-semibold">
										<?php esc_html_e('View Details', 'tznew'); ?>
									</a>
									<a href="<?php echo esc_url(home_url('/booking')); ?>?tour_id=<?php echo get_the_ID(); ?>" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 text-center py-2 px-4 rounded-lg transition-colors duration-300 text-sm font-semibold border border-gray-300">
										<?php esc_html_e('Book Now', 'tznew'); ?>
									</a>
								</div>
							</div>
						</article>
						<?php
					endwhile;
					?>
				</div>
				
				<!-- Pagination -->
				<div class="mt-12 flex justify-center">
					<?php
					the_posts_pagination(array(
						'mid_size' => 2,
						'prev_text' => '<i class="fas fa-chevron-left mr-2"></i>' . __('Previous', 'tznew'),
						'next_text' => __('Next', 'tznew') . '<i class="fas fa-chevron-right ml-2"></i>',
						'class' => 'pagination-tours',
					));
					?>
				</div>
			<?php else : ?>
				<div class="text-center py-12">
					<div class="max-w-md mx-auto">
						<i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
						<h2 class="text-2xl font-bold text-gray-800 mb-4"><?php esc_html_e('No Tours Found', 'tznew'); ?></h2>
						<p class="text-gray-600 mb-6"><?php esc_html_e('Sorry, no tours match your criteria. Please try adjusting your filters or check back later.', 'tznew'); ?></p>
						<a href="<?php echo esc_url(get_post_type_archive_link('tours')); ?>" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-300">
							<i class="fas fa-refresh mr-2"></i>
							<?php esc_html_e('View All Tours', 'tznew'); ?>
						</a>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<script>
// Simple filtering functionality
document.addEventListener('DOMContentLoaded', function() {
	const regionFilter = document.getElementById('region-filter');
	const tourTypeFilter = document.getElementById('tour-type-filter');
	const sortFilter = document.getElementById('sort-filter');
	
	if (regionFilter || tourTypeFilter || sortFilter) {
		// Add event listeners for filters
		[regionFilter, tourTypeFilter, sortFilter].forEach(filter => {
			if (filter) {
				filter.addEventListener('change', function() {
					// Reload page with filter parameters
					const url = new URL(window.location);
					
					if (regionFilter && regionFilter.value) {
						url.searchParams.set('region', regionFilter.value);
					} else {
						url.searchParams.delete('region');
					}
					
					if (tourTypeFilter && tourTypeFilter.value) {
						url.searchParams.set('tour_type', tourTypeFilter.value);
					} else {
						url.searchParams.delete('tour_type');
					}
					
					if (sortFilter && sortFilter.value) {
						url.searchParams.set('orderby', sortFilter.value);
					} else {
						url.searchParams.delete('orderby');
					}
					
					window.location.href = url.toString();
				});
			}
		});
	}
});
</script>

<?php
get_footer();