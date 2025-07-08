<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TZnew
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden'); ?>>
	<?php tznew_post_thumbnail('medium', 'w-full h-48 object-cover'); ?>
	
	<div class="entry-content p-6">
		<?php the_title( sprintf( '<h2 class="entry-title text-xl font-bold mb-2"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta text-sm text-gray-600 mb-4">
			<?php
			tznew_posted_on();
			tznew_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

		<div class="entry-summary mb-4">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<div class="entry-footer">
			<?php
			// Display post type
			$post_type = get_post_type();
			$post_type_obj = get_post_type_object($post_type);
			if ($post_type_obj) :
				?>
				<span class="post-type inline-block bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded mr-2 mb-2">
					<?php echo esc_html($post_type_obj->labels->singular_name); ?>
				</span>
				<?php
			endif;
			
			// For custom post types, show relevant taxonomies
			if ($post_type == 'trekking') :
				$regions = get_the_terms(get_the_ID(), 'region');
				$difficulties = get_the_terms(get_the_ID(), 'difficulty');
				
				if ($regions && !is_wp_error($regions) && !empty($regions)) :
					?>
					<span class="region inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded mr-2 mb-2">
						<?php echo esc_html($regions[0]->name ?? ''); ?>
					</span>
					<?php
				endif;
				
				if ($difficulties && !is_wp_error($difficulties) && !empty($difficulties)) : ?>
			<span class="difficulty inline-block bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded mr-2 mb-2">
				<?php echo esc_html($difficulties[0]->name ?? ''); ?>
			</span>
			<?php endif; ?>
			
		<?php elseif ($post_type == 'tours') :
			$regions = get_the_terms(get_the_ID(), 'region');
			$tour_types = get_the_terms(get_the_ID(), 'tour_type');
			?>
			<?php if ($regions && !is_wp_error($regions) && !empty($regions)) : ?>
				<span class="region inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded mr-2 mb-2">
					<?php echo esc_html($regions[0]->name ?? ''); ?>
				</span>
			<?php endif; ?>
			
			<?php if ($tour_types && !is_wp_error($tour_types) && !empty($tour_types)) : ?>
				<span class="tour-type inline-block bg-green-100 text-green-700 text-xs px-2 py-1 rounded mr-2 mb-2">
					<?php echo esc_html($tour_types[0]->name ?? ''); ?>
				</span>
			<?php endif; ?>
			
		<?php elseif ($post_type == 'blog') :
			$tags = get_the_terms(get_the_ID(), 'acf_tag');
			?>
			<?php if ($tags && !is_wp_error($tags) && !empty($tags)) :
				foreach ($tags as $tag) :
					if (isset($tag->name)) : ?>
						<span class="tag inline-block bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded mr-2 mb-2">
							<?php echo esc_html($tag->name); ?>
						</span>
					<?php endif;
				endforeach;
			endif; ?>
			
		<?php elseif ($post_type == 'post') :
			$categories = get_the_category();
			?>
			<?php if ($categories && !empty($categories)) :
				foreach ($categories as $category) :
					if (isset($category->name)) : ?>
						<span class="category inline-block bg-red-100 text-red-700 text-xs px-2 py-1 rounded mr-2 mb-2">
							<?php echo esc_html($category->name); ?>
						</span>
					<?php endif;
				endforeach;
			<?php endif; ?>
		<?php endif; ?>
		</div><!-- .entry-footer -->
		
		<div class="mt-4">
			<a href="<?php echo esc_url(get_permalink()); ?>" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-300">
				<?php esc_html_e('View Details', 'tznew'); ?>
			</a>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->