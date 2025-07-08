<?php
/**
 * The template for displaying the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TZnew
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	// Hero Section
	if (function_exists('get_field')) :
		$hero_title = tznew_get_field_safe('hero_title', 'option');
	$hero_subtitle = tznew_get_field_safe('hero_subtitle', 'option');
	$hero_image = tznew_get_field_safe('hero_image', 'option');
	$hero_cta_text = tznew_get_field_safe('hero_cta_text', 'option');
	$hero_cta_link = tznew_get_field_safe('hero_cta_link', 'option');
	$hero_search_enabled = tznew_get_field_safe('hero_search_enabled', 'option');
		
		$hero_image_url = (is_array($hero_image) && isset($hero_image['url'])) ? $hero_image['url'] : '';
		if (empty($hero_image_url)) {
			$hero_image_url = 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80';
		}
		?>
		<section class="hero-section relative overflow-hidden">
			<div class="hero-image relative h-screen min-h-[700px] bg-cover bg-center bg-fixed parallax" style="background-image: url('<?php echo esc_url($hero_image_url); ?>')" data-speed="0.5">
				<div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/50 to-black/60"></div>
				<div class="absolute inset-0 bg-blue-900/20"></div>
				<div class="container mx-auto px-4 h-full flex items-center relative z-10">
					<div class="text-center mx-auto max-w-4xl">
						<?php if ($hero_title) : ?>
							<h1 class="hero-title text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight animate-fade-in-up"><?php echo esc_html($hero_title); ?></h1>
						<?php else : ?>
							<h1 class="hero-title text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight animate-fade-in-up">Discover Epic Adventures</h1>
						<?php endif; ?>
						
						<?php if ($hero_subtitle) : ?>
							<p class="hero-subtitle text-xl md:text-2xl lg:text-3xl text-white/90 mb-8 font-light animate-fade-in-up delay-200"><?php echo esc_html($hero_subtitle); ?></p>
						<?php else : ?>
							<p class="hero-subtitle text-xl md:text-2xl lg:text-3xl text-white/90 mb-8 font-light animate-fade-in-up delay-200">Experience the world's most breathtaking trekking destinations</p>
						<?php endif; ?>
						
						<div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up delay-400">
							<?php if ($hero_cta_text && $hero_cta_link) : ?>
								<a href="<?php echo esc_url($hero_cta_link); ?>" class="hero-cta btn btn-primary bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-8 rounded-full text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
									<i class="fas fa-mountain mr-2"></i>
									<?php echo esc_html($hero_cta_text); ?>
								</a>
							<?php else : ?>
								<a href="#featured-treks" class="hero-cta btn btn-primary bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-8 rounded-full text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
									<i class="fas fa-mountain mr-2"></i>
									Explore Treks
								</a>
							<?php endif; ?>
							
							<a href="#about" class="btn btn-outline border-2 border-white text-white hover:bg-white hover:text-gray-900 font-bold py-4 px-8 rounded-full text-lg transition-all duration-300">
								<i class="fas fa-info-circle mr-2"></i>
								Learn More
							</a>
						</div>
						
						<?php if ($hero_search_enabled) : ?>
							<div class="mt-8 animate-fade-in-up delay-600">
								<div class="search-form max-w-md mx-auto">
									<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative">
										<input type="search" name="s" placeholder="Search adventures..." class="search-input w-full py-4 px-6 pr-16 rounded-full bg-white/90 backdrop-blur-sm border-0 text-gray-900 placeholder-gray-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-300" />
										<button type="submit" class="search-submit absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition-all duration-300 hover:scale-110">
											<i class="fas fa-search"></i>
										</button>
									</form>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				
				<!-- Scroll indicator -->
				<div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
					<a href="#featured-treks" class="text-white/80 hover:text-white transition-colors">
						<i class="fas fa-chevron-down text-2xl"></i>
					</a>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	// Featured Treks Section
	if (function_exists('get_field')) :
		$featured_treks_title = tznew_get_field_safe('featured_treks_title', 'option');
		$featured_treks_subtitle = tznew_get_field_safe('featured_treks_subtitle', 'option');
		$featured_treks_count = tznew_get_field_safe('featured_treks_count', 'option') ?: 6;
		?>
		<section id="featured-treks" class="featured-treks py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
			<!-- Background decoration -->
			<div class="absolute top-0 left-0 w-full h-full opacity-5">
				<div class="absolute top-20 left-10 w-32 h-32 bg-blue-500 rounded-full animate-float"></div>
				<div class="absolute bottom-20 right-10 w-24 h-24 bg-green-500 rounded-full animate-float delay-1000"></div>
			</div>
			
			<div class="container mx-auto px-4 relative z-10">
				<div class="text-center mb-16 scroll-reveal-up">
					<h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-6">
						<span class="bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">
							<?php echo $featured_treks_title ? esc_html($featured_treks_title) : esc_html__('Featured Treks', 'tznew'); ?>
						</span>
					</h2>
					<?php if ($featured_treks_subtitle) : ?>
						<p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed"><?php echo esc_html($featured_treks_subtitle); ?></p>
					<?php else : ?>
						<p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Discover our most popular trekking adventures, carefully selected for unforgettable experiences that will challenge and inspire you.</p>
					<?php endif; ?>
					<div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-green-600 mx-auto mt-6 rounded-full"></div>
				</div>
				
				<?php
				$featured_args = array(
					'post_type'      => 'trekking',
					'posts_per_page' => intval($featured_treks_count),
					'meta_key'       => 'featured',
					'meta_value'     => '1',
				);
				
				$featured_query = new WP_Query($featured_args);
				
				if ($featured_query->have_posts()) :
					?>
					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 stagger-animation">
						<?php
						$card_index = 0;
						while ($featured_query->have_posts()) :
							$featured_query->the_post();
							$card_index++;
							?>
							<div class="trek-card card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 group">
								<?php if (has_post_thumbnail()) : ?>
									<div class="trek-image relative overflow-hidden">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('medium_large', array('class' => 'w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110')); ?>
										</a>
										<div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
										
										<?php
										$difficulty = tznew_get_field_safe('difficulty');
										if ($difficulty) : ?>
											<div class="absolute top-4 right-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg backdrop-blur-sm">
												<i class="fas fa-signal mr-1"></i>
												<?php echo esc_html($difficulty); ?>
											</div>
										<?php endif; ?>
										
										<?php
										$price = tznew_get_field_safe('price');
										if ($price) : ?>
											<div class="absolute top-4 left-4 bg-gradient-to-r from-green-600 to-green-700 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg backdrop-blur-sm">
												<i class="fas fa-dollar-sign mr-1"></i>
												<?php echo esc_html($price); ?>
											</div>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								
								<div class="trek-content p-6">
									<h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors duration-300">
										<a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition duration-300">
											<?php the_title(); ?>
										</a>
									</h3>
									
									<div class="mb-4 text-gray-700 leading-relaxed">
										<?php
										$overview = tznew_get_field_safe('overview');
										if ($overview) {
											echo wp_trim_words(wp_strip_all_tags($overview), 20, '...');
										} else {
											the_excerpt();
										}
										?>
									</div>
									
									<?php
									$duration = tznew_get_field_safe('duration');
					$max_altitude = tznew_get_field_safe('max_altitude');
									if ($duration || $max_altitude) : ?>
										<div class="trek-meta grid grid-cols-2 gap-4 text-sm text-gray-500 mb-6">
											<?php if ($duration) : ?>
												<div class="flex items-center bg-gray-50 rounded-lg p-2">
													<i class="far fa-clock text-blue-600 mr-2"></i>
													<span class="font-medium"><?php echo esc_html($duration); ?> days</span>
												</div>
											<?php endif; ?>
											<?php if ($max_altitude) : ?>
												<div class="flex items-center bg-gray-50 rounded-lg p-2">
													<i class="fas fa-mountain text-green-600 mr-2"></i>
													<span class="font-medium"><?php echo esc_html($max_altitude); ?>m</span>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
									
									<div class="flex gap-3">
										<a href="<?php the_permalink(); ?>" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 text-center">
											<i class="fas fa-eye mr-2"></i>
											<?php esc_html_e('View Details', 'tznew'); ?>
										</a>
										<button class="bg-gray-100 hover:bg-gray-200 text-gray-700 p-3 rounded-lg transition-colors duration-300" title="Add to Wishlist">
											<i class="far fa-heart"></i>
										</button>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
					
					<div class="text-center mt-16 scroll-reveal-up">
						<a href="<?php echo esc_url(get_post_type_archive_link('trekking')); ?>" class="inline-flex items-center bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-900 hover:to-black text-white font-bold py-4 px-8 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
							<i class="fas fa-hiking mr-3"></i>
							<?php esc_html_e('View All Treks', 'tznew'); ?>
							<i class="fas fa-arrow-right ml-3"></i>
						</a>
					</div>
					<?php
					wp_reset_postdata();
				else :
					?>
					<p class="text-center"><?php esc_html_e('No featured treks found.', 'tznew'); ?></p>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php
	// Popular Tours Section
	if (function_exists('get_field')) :
		$popular_tours_title = tznew_get_field_safe('popular_tours_title', 'option');
		$popular_tours_subtitle = tznew_get_field_safe('popular_tours_subtitle', 'option');
		$popular_tours_count = tznew_get_field_safe('popular_tours_count', 'option') ?: 3;
		?>
		<section class="popular-tours py-16 bg-white">
			<div class="container mx-auto px-4">
				<div class="text-center mb-12">
					<h2 class="text-3xl md:text-4xl font-bold mb-4">
						<?php echo $popular_tours_title ? esc_html($popular_tours_title) : esc_html__('Popular Tours', 'tznew'); ?>
					</h2>
					<?php if ($popular_tours_subtitle) : ?>
						<p class="text-xl text-gray-600"><?php echo esc_html($popular_tours_subtitle); ?></p>
					<?php endif; ?>
				</div>
				
				<?php
				$popular_args = array(
					'post_type'      => 'tours',
					'posts_per_page' => intval($popular_tours_count),
					'meta_key'       => 'featured',
					'meta_value'     => '1',
				);
				
				$popular_query = new WP_Query($popular_args);
				
				if ($popular_query->have_posts()) :
					?>
					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
						<?php
						while ($popular_query->have_posts()) :
							$popular_query->the_post();
							?>
							<div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:-translate-y-2">
								<?php if (has_post_thumbnail()) : ?>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('medium_large', array('class' => 'w-full h-56 object-cover')); ?>
									</a>
								<?php endif; ?>
								<div class="p-6">
									<h3 class="text-xl font-bold mb-2">
										<a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition duration-300">
											<?php the_title(); ?>
										</a>
									</h3>
									
									<div class="flex items-center text-sm text-gray-600 mb-3">
										<?php
										$duration = tznew_get_field_safe('duration');
					$tour_type = tznew_get_field_safe('tour_type');
										$regions = get_the_terms(get_the_ID(), 'region');
										
										if ($duration) : ?>
											<span class="mr-4"><i class="dashicons dashicons-clock"></i> <?php echo esc_html($duration); ?></span>
										<?php endif; ?>
										
										<?php if ($tour_type) : ?>
											<span class="mr-4"><i class="dashicons dashicons-category"></i> <?php echo esc_html($tour_type); ?></span>
										<?php endif; ?>
										
										<?php if ($regions && !is_wp_error($regions)) : ?>
											<span><i class="dashicons dashicons-location"></i> <?php echo esc_html($regions[0]->name); ?></span>
										<?php endif; ?>
									</div>
									
									<?php
									$price = tznew_get_field_safe('price');
									if ($price) :
										?>
										<div class="text-lg font-bold text-blue-600 mb-3">
											<?php echo esc_html($price); ?>
										</div>
									<?php endif; ?>
									
									<div class="mb-4 text-gray-700">
										<?php
										$overview = tznew_get_field_safe('overview');
										if ($overview) {
											echo wp_trim_words(wp_strip_all_tags($overview), 20, '...');
										} else {
											the_excerpt();
										}
										?>
									</div>
									
									<a href="<?php the_permalink(); ?>" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-300">
										<?php esc_html_e('View Details', 'tznew'); ?>
									</a>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
					
					<div class="text-center mt-10">
						<a href="<?php echo esc_url(get_post_type_archive_link('tours')); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
							<?php esc_html_e('View All Tours', 'tznew'); ?>
						</a>
					</div>
					<?php
					wp_reset_postdata();
				else :
					?>
					<p class="text-center"><?php esc_html_e('No popular tours found.', 'tznew'); ?></p>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php
	// Destinations Section
	if (function_exists('get_field')) :
		$destinations_title = tznew_get_field_safe('destinations_title', 'option');
		$destinations_subtitle = tznew_get_field_safe('destinations_subtitle', 'option');
		$destinations_count = tznew_get_field_safe('destinations_count', 'option') ?: 6;
		?>
		<section class="destinations py-16 bg-gray-50">
			<div class="container mx-auto px-4">
				<div class="text-center mb-12">
					<h2 class="text-3xl md:text-4xl font-bold mb-4">
						<?php echo $destinations_title ? esc_html($destinations_title) : esc_html__('Popular Destinations', 'tznew'); ?>
					</h2>
					<?php if ($destinations_subtitle) : ?>
						<p class="text-xl text-gray-600"><?php echo esc_html($destinations_subtitle); ?></p>
					<?php endif; ?>
				</div>
				
				<?php
				// Get regions with image and count
				$regions = get_terms(array(
					'taxonomy' => 'region',
					'hide_empty' => true,
				));
				
				if (!empty($regions) && !is_wp_error($regions)) :
					?>
					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
						<?php foreach ($regions as $region) : 
							$region_image = tznew_get_field_safe('region_image', 'region_' . $region->term_id);
							$region_image_url = isset($region_image['url']) ? $region_image['url'] : '';
							
							if (empty($region_image_url)) {
								$region_image_url = get_template_directory_uri() . '/assets/images/default-region.jpg';
							}
							
							// Count posts in this region
							$count_args = array(
								'post_type' => array('trekking', 'tours'),
								'tax_query' => array(
									array(
										'taxonomy' => 'region',
										'field' => 'term_id',
										'terms' => $region->term_id,
									),
								),
								'posts_per_page' => -1,
							);
							
							$count_query = new WP_Query($count_args);
							$count = $count_query->found_posts;
							?>
							<div class="relative rounded-lg overflow-hidden shadow-lg group transition-transform duration-300 hover:-translate-y-2">
								<a href="<?php echo esc_url(get_term_link($region)); ?>">
									<div class="aspect-w-16 aspect-h-9">
										<img src="<?php echo esc_url($region_image_url); ?>" alt="<?php echo esc_attr($region->name); ?>" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" />
									</div>
									<div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
									<div class="absolute bottom-0 left-0 p-6 text-white">
										<h3 class="text-2xl font-bold mb-2"><?php echo esc_html($region->name); ?></h3>
										<p class="text-sm">
											<?php printf(_n('%s Adventure', '%s Adventures', $count, 'tznew'), number_format_i18n($count)); ?>
										</p>
									</div>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
					<?php
				else :
					?>
					<p class="text-center"><?php esc_html_e('No destinations found.', 'tznew'); ?></p>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php
	// Testimonials Section
	if (function_exists('get_field')) :
		$testimonials_title = tznew_get_field_safe('testimonials_title', 'option');
		$testimonials_subtitle = tznew_get_field_safe('testimonials_subtitle', 'option');
		$testimonials = tznew_get_field_safe('testimonials', 'option');
		?>
		<section class="testimonials py-16 bg-blue-600 text-white">
			<div class="container mx-auto px-4">
				<div class="text-center mb-12">
					<h2 class="text-3xl md:text-4xl font-bold mb-4">
						<?php echo $testimonials_title ? esc_html($testimonials_title) : esc_html__('What Our Clients Say', 'tznew'); ?>
					</h2>
					<?php if ($testimonials_subtitle) : ?>
						<p class="text-xl opacity-90"><?php echo esc_html($testimonials_subtitle); ?></p>
					<?php endif; ?>
				</div>
				
				<?php if ($testimonials) : ?>
					<div class="testimonial-slider max-w-4xl mx-auto">
						<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
							<?php foreach ($testimonials as $testimonial) : ?>
								<div class="bg-white bg-opacity-10 backdrop-blur-sm p-6 rounded-lg">
									<div class="mb-4 text-yellow-300">
										<?php
										// Display stars based on rating
										$rating = isset($testimonial['rating']) ? intval($testimonial['rating']) : 5;
										for ($i = 1; $i <= 5; $i++) {
											if ($i <= $rating) {
												echo '<i class="dashicons dashicons-star-filled"></i>';
											} else {
												echo '<i class="dashicons dashicons-star-empty"></i>';
											}
										}
										?>
									</div>
									<div class="italic mb-4">
										<?php echo esc_html($testimonial['content']); ?>
									</div>
									<div class="flex items-center">
										<?php if (isset($testimonial['photo']) && !empty($testimonial['photo']['url'])) : ?>
											<img src="<?php echo esc_url($testimonial['photo']['url']); ?>" alt="<?php echo esc_attr($testimonial['name']); ?>" class="w-12 h-12 rounded-full mr-4 object-cover" />
										<?php endif; ?>
										<div>
											<div class="font-bold"><?php echo esc_html($testimonial['name']); ?></div>
											<?php if (isset($testimonial['trip'])) : ?>
												<div class="text-sm opacity-90"><?php echo esc_html($testimonial['trip']); ?></div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php else : ?>
					<p class="text-center"><?php esc_html_e('No testimonials found.', 'tznew'); ?></p>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php
	// Blog Section
	if (function_exists('get_field')) :
		$blog_title = tznew_get_field_safe('blog_title', 'option');
		$blog_subtitle = tznew_get_field_safe('blog_subtitle', 'option');
		$blog_count = tznew_get_field_safe('blog_count', 'option') ?: 3;
		?>
		<section class="blog py-16 bg-white">
			<div class="container mx-auto px-4">
				<div class="text-center mb-12">
					<h2 class="text-3xl md:text-4xl font-bold mb-4">
						<?php echo $blog_title ? esc_html($blog_title) : esc_html__('Latest from Our Blog', 'tznew'); ?>
					</h2>
					<?php if ($blog_subtitle) : ?>
						<p class="text-xl text-gray-600"><?php echo esc_html($blog_subtitle); ?></p>
					<?php endif; ?>
				</div>
				
				<?php
				$blog_args = array(
					'post_type'      => 'blog',
					'posts_per_page' => intval($blog_count),
				);
				
				$blog_query = new WP_Query($blog_args);
				
				if ($blog_query->have_posts()) :
					?>
					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
						<?php
						while ($blog_query->have_posts()) :
							$blog_query->the_post();
							?>
							<div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:-translate-y-2">
								<?php if (has_post_thumbnail()) : ?>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('medium_large', array('class' => 'w-full h-48 object-cover')); ?>
									</a>
								<?php endif; ?>
								<div class="p-6">
									<div class="flex items-center text-sm text-gray-500 mb-3">
										<span class="mr-3">
											<i class="dashicons dashicons-calendar-alt"></i> 
											<?php echo get_the_date(); ?>
										</span>
										<?php
										$tags = get_the_terms(get_the_ID(), 'acf_tag');
										if ($tags && !is_wp_error($tags)) :
											?>
											<span>
												<i class="dashicons dashicons-tag"></i>
												<?php echo esc_html($tags[0]->name); ?>
											</span>
											<?php
										endif;
										?>
									</div>
									
									<h3 class="text-xl font-bold mb-3">
										<a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition duration-300">
											<?php the_title(); ?>
										</a>
									</h3>
									
									<div class="mb-4 text-gray-700">
										<?php
										$content = tznew_get_field_safe('content');
										if ($content) {
											echo wp_trim_words(wp_strip_all_tags($content), 20, '...');
										} else {
											the_excerpt();
										}
										?>
									</div>
									
									<a href="<?php the_permalink(); ?>" class="inline-block text-blue-600 hover:text-blue-800 font-medium transition duration-300">
										<?php esc_html_e('Read More', 'tznew'); ?> &rarr;
									</a>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
					
					<div class="text-center mt-10">
						<a href="<?php echo esc_url(get_post_type_archive_link('blog')); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
							<?php esc_html_e('View All Posts', 'tznew'); ?>
						</a>
					</div>
					<?php
					wp_reset_postdata();
				else :
					?>
					<p class="text-center"><?php esc_html_e('No blog posts found.', 'tznew'); ?></p>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php
	// CTA Section
	if (function_exists('get_field')) :
		$cta_title = tznew_get_field_safe('cta_title', 'option');
		$cta_content = tznew_get_field_safe('cta_content', 'option');
		$cta_button_text = tznew_get_field_safe('cta_button_text', 'option');
		$cta_button_link = tznew_get_field_safe('cta_button_link', 'option');
		$cta_background = tznew_get_field_safe('cta_background', 'option');
		
		$cta_bg_url = isset($cta_background['url']) ? $cta_background['url'] : '';
		if (empty($cta_bg_url)) {
			$cta_bg_url = get_template_directory_uri() . '/assets/images/default-cta-bg.jpg';
		}
		?>
		<section class="cta relative py-20" style="background-image: url('<?php echo esc_url($cta_bg_url); ?>'); background-size: cover; background-position: center;">
			<div class="absolute inset-0 bg-blue-900 bg-opacity-80"></div>
			<div class="container mx-auto px-4 relative z-10 text-center text-white">
				<div class="max-w-3xl mx-auto">
					<?php if ($cta_title) : ?>
						<h2 class="text-3xl md:text-4xl font-bold mb-6"><?php echo esc_html($cta_title); ?></h2>
					<?php endif; ?>
					
					<?php if ($cta_content) : ?>
						<div class="text-xl mb-8"><?php echo wp_kses_post($cta_content); ?></div>
					<?php endif; ?>
					
					<?php if ($cta_button_text && $cta_button_link) : ?>
						<a href="<?php echo esc_url($cta_button_link); ?>" class="inline-block bg-white text-blue-900 hover:bg-gray-100 font-bold py-3 px-8 rounded-lg text-lg transition duration-300">
							<?php echo esc_html($cta_button_text); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

</main><!-- #main -->

<?php
get_footer();