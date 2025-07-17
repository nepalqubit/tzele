<?php
/**
 * The template for displaying single trekking posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TZnew
 */

get_header();
?>

<?php
// Check if Elementor Theme Builder single template exists for trekking posts
if ( function_exists( 'tznew_elementor_location_exists' ) && tznew_elementor_location_exists( 'single' ) ) {
    // Use Elementor Theme Builder single template
    tznew_elementor_do_location( 'single' );
} else {
    // Fallback to default trekking template
    ?>
    <main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		
		<!-- Hero Section -->
		<section class="relative h-96 md:h-[500px] overflow-hidden">
			<?php if (has_post_thumbnail()) : ?>
				<div class="absolute inset-0">
					<?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
					<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
				</div>
			<?php else : ?>
				<div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-800"></div>
			<?php endif; ?>
			
			<div class="relative z-10 container mx-auto px-4 h-full flex items-end pb-12">
				<div class="text-white max-w-4xl">
					<div class="flex items-center gap-2 mb-4">
						<?php
						$regions = get_the_terms(get_the_ID(), 'region');
						if ($regions && !is_wp_error($regions)) :
							foreach ($regions as $region) :
						?>
							<span class="bg-blue-600/80 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium">
								<i class="fas fa-location-dot mr-1"></i>
								<?php echo esc_html($region->name); ?>
							</span>
						<?php
							endforeach;
						endif;
						?>
					</div>
					<h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
						<?php the_title(); ?>
					</h1>
					<?php
					$overview = tznew_get_field_safe('overview');
					if ($overview) :
					?>
						<p class="text-xl md:text-2xl text-gray-200 leading-relaxed max-w-3xl">
							<?php echo wp_trim_words(wp_strip_all_tags($overview), 30, '...'); ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<!-- Trek Meta Information -->
		<section class="bg-white shadow-lg relative z-20 -mt-16 mx-4 md:mx-8 rounded-2xl overflow-hidden">
			<div class="container mx-auto px-6 py-8">
				<?php
				$duration = tznew_get_field_safe('duration');
				$difficulty = tznew_get_field_safe('difficulty');
				$max_altitude = tznew_get_field_safe('max_altitude');
				$best_season = tznew_get_field_safe('best_season');
				$group_size = tznew_get_field_safe('group_size');
				$cost_info = tznew_get_field_safe('cost_info');
				
				if ($duration || $difficulty || $max_altitude || $best_season || $group_size) :
				?>
					<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
						<?php if ($duration) : ?>
							<div class="text-center group">
								<div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform duration-300">
									<i class="fas fa-clock"></i>
								</div>
								<h3 class="font-semibold text-gray-800 mb-1"><?php esc_html_e('Duration', 'tznew'); ?></h3>
								<p class="text-2xl font-bold text-blue-600"><?php echo esc_html($duration); ?></p>
								<p class="text-sm text-gray-600"><?php echo esc_html(_n('Day', 'Days', intval($duration), 'tznew')); ?></p>
							</div>
						<?php endif; ?>
						
						<?php if ($difficulty) : ?>
							<div class="text-center group">
								<div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform duration-300">
									<i class="fas fa-mountain"></i>
								</div>
								<h3 class="font-semibold text-gray-800 mb-1"><?php esc_html_e('Difficulty', 'tznew'); ?></h3>
								<p class="text-lg font-bold text-orange-600"><?php echo esc_html(ucfirst($difficulty)); ?></p>
							</div>
						<?php endif; ?>
						
						<?php if ($max_altitude) : ?>
							<div class="text-center group">
								<div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform duration-300">
									<i class="fas fa-arrow-up"></i>
								</div>
								<h3 class="font-semibold text-gray-800 mb-1"><?php esc_html_e('Max Altitude', 'tznew'); ?></h3>
								<p class="text-lg font-bold text-green-600"><?php echo esc_html(number_format($max_altitude)); ?></p>
								<p class="text-sm text-gray-600"><?php esc_html_e('meters', 'tznew'); ?></p>
							</div>
						<?php endif; ?>
						
						<?php if ($best_season) : ?>
							<div class="text-center group">
								<div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform duration-300">
									<i class="fas fa-calendar-days"></i>
								</div>
								<h3 class="font-semibold text-gray-800 mb-1"><?php esc_html_e('Best Season', 'tznew'); ?></h3>
								<p class="text-lg font-bold text-purple-600"><?php echo esc_html($best_season); ?></p>
							</div>
						<?php endif; ?>
						
						<?php if ($group_size) : ?>
							<div class="text-center group">
								<div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform duration-300">
									<i class="fas fa-users"></i>
								</div>
								<h3 class="font-semibold text-gray-800 mb-1"><?php esc_html_e('Group Size', 'tznew'); ?></h3>
								<p class="text-lg font-bold text-indigo-600"><?php echo esc_html($group_size); ?></p>
							</div>
						<?php endif; ?>
						
						<?php if ($cost_info && isset($cost_info['price_usd']) && $cost_info['price_usd']) : ?>
							<div class="text-center group">
								<div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform duration-300">
									<i class="fas fa-dollar-sign"></i>
								</div>
								<h3 class="font-semibold text-gray-800 mb-1"><?php esc_html_e('Price', 'tznew'); ?></h3>
								<p class="text-2xl font-bold text-yellow-600">$<?php echo esc_html(number_format($cost_info['price_usd'])); ?></p>
								<?php if (isset($cost_info['pricing_type']) && $cost_info['pricing_type']) : ?>
									<p class="text-sm text-gray-600"><?php echo esc_html($cost_info['pricing_type']); ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<!-- Main Content -->
		<div class="container mx-auto px-4 py-12">
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
				<!-- Main Content Column -->
				<div class="lg:col-span-2 space-y-12">
					<?php get_template_part( 'template-parts/content', 'trekking' ); ?>
				</div>
				
				<!-- Sidebar -->
				<div class="lg:col-span-1">
					<div class="sticky top-8 space-y-8">
						<!-- Quick Booking Card -->
						<div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
							<h3 class="text-xl font-bold text-blue-800 mb-4 flex items-center">
								<i class="fas fa-calendar-check mr-2"></i>
								<?php esc_html_e('Book This Trek', 'tznew'); ?>
							</h3>
							
							<?php if ($cost_info && isset($cost_info['price_usd']) && $cost_info['price_usd']) : ?>
								<div class="mb-4">
									<span class="text-sm text-gray-600"><?php esc_html_e('Starting from', 'tznew'); ?></span>
									<div class="text-3xl font-bold text-blue-600">$<?php echo esc_html(number_format($cost_info['price_usd'])); ?></div>
									<?php if (isset($cost_info['pricing_type']) && $cost_info['pricing_type']) : ?>
										<span class="text-sm text-gray-600"><?php echo esc_html($cost_info['pricing_type']); ?></span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							
							<div class="space-y-3">
								<a href="<?php echo esc_url(home_url('/booking?trekking_id=' . get_the_ID())); ?>" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 text-center">
									<i class="fas fa-paper-plane mr-2"></i>
									<?php esc_html_e('Book Now', 'tznew'); ?>
								</a>
								<a href="<?php echo esc_url(home_url('/inquiry?trekking_id=' . get_the_ID())); ?>" class="block w-full bg-white hover:bg-gray-50 text-blue-600 font-bold py-3 px-6 rounded-xl border-2 border-blue-600 transition-all duration-300 text-center">
									<i class="fas fa-question-circle mr-2"></i>
									<?php esc_html_e('Send Inquiry', 'tznew'); ?>
								</a>
							</div>
						</div>
						
						<!-- Trek Highlights -->
						<?php if (tznew_have_rows_safe('highlights')) : ?>
							<div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
								<h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
									<i class="fas fa-star text-yellow-500 mr-2"></i>
									<?php esc_html_e('Trek Highlights', 'tznew'); ?>
								</h3>
								<ul class="space-y-2">
									<?php while (tznew_have_rows_safe('highlights')) : tznew_the_row_safe(); ?>
										<?php $highlight = tznew_get_sub_field_safe('highlight'); ?>
										<?php if ($highlight) : ?>
											<li class="flex items-start text-gray-700">
												<i class="fas fa-circle-check text-green-500 mr-2 mt-1 flex-shrink-0"></i>
												<span class="text-sm"><?php echo wp_kses_post(is_string($highlight) ? $highlight : ''); ?></span>
											</li>
										<?php endif; ?>
									<?php endwhile; ?>
								</ul>
							</div>
						<?php endif; ?>
						
						<!-- Related Treks -->
						<?php
						$related_treks = get_posts(array(
							'post_type' => 'trekking',
							'posts_per_page' => 3,
							'post__not_in' => array(get_the_ID()),
							'meta_query' => array(
								array(
									'key' => 'difficulty',
									'value' => $difficulty,
									'compare' => '='
								)
							)
						));
						
						if ($related_treks) :
						?>
							<div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
								<h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
									<i class="fas fa-hiking mr-2"></i>
									<?php esc_html_e('Similar Treks', 'tznew'); ?>
								</h3>
								<div class="space-y-4">
									<?php foreach ($related_treks as $trek) : ?>
										<a href="<?php echo esc_url(get_permalink($trek->ID)); ?>" class="block group">
											<div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-300">
												<?php if (has_post_thumbnail($trek->ID)) : ?>
													<img src="<?php echo esc_url(get_the_post_thumbnail_url($trek->ID, 'thumbnail')); ?>" alt="<?php echo esc_attr($trek->post_title); ?>" class="w-12 h-12 object-cover rounded-lg">
												<?php else : ?>
													<div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
														<i class="fas fa-mountain text-blue-600"></i>
													</div>
												<?php endif; ?>
												<div class="flex-1">
													<h4 class="font-medium text-gray-800 group-hover:text-blue-600 transition-colors duration-300 text-sm"><?php echo esc_html($trek->post_title); ?></h4>
													<?php
													$trek_duration = tznew_get_field_safe('duration', $trek->ID);
													if ($trek_duration) :
													?>
														<p class="text-xs text-gray-500"><?php echo esc_html($trek_duration); ?> <?php echo esc_html(_n('Day', 'Days', intval($trek_duration), 'tznew')); ?></p>
													<?php endif; ?>
												</div>
											</div>
										</a>
									<?php endforeach; ?>
								</div>
							</div>
						<?php
						wp_reset_postdata();
						endif;
						?>
					</div>
				</div>
			</div>
		</div>

		<?php
		// Display FAQ section
		tznew_display_faqs();
		?>

		<?php
		// Previous/next post navigation.
		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Trek:', 'tznew' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Trek:', 'tznew' ) . '</span> <span class="nav-title">%title</span>',
				'class'     => 'container mx-auto px-4 my-12 p-6 bg-gray-50 rounded-2xl',
			)
		);

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>
</main><!-- #main -->
    <?php
}
?>

<?php
get_footer();