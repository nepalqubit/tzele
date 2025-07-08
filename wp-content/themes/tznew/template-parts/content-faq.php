<?php
/**
 * Template part for displaying FAQ posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TZnew
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden'); ?>>
	<div class="entry-content p-6">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title text-3xl font-bold mb-6">', '</h1>' );
			
			// Display FAQ content
			if (function_exists('get_field')) :
				?>
				<?php
				// FAQ Categories
			if (tznew_have_rows_safe('faq_categories')) : ?>
				<div class="faq-categories space-y-8 mb-8">
					<?php while (tznew_have_rows_safe('faq_categories')) : tznew_the_row_safe(); ?>
						<div class="faq-category">
							<?php if (tznew_get_sub_field_safe('category_name')) : ?>
							<h2 class="text-2xl font-bold mb-4 pb-2 border-b border-gray-200"><?php echo esc_html(tznew_get_sub_field_safe('category_name')); ?></h2>
							<?php endif; ?>
							
							<?php if (tznew_have_rows_safe('questions')) : ?>
								<div class="faq-questions space-y-4">
									<?php while (tznew_have_rows_safe('questions')) : tznew_the_row_safe(); ?>
										<div class="faq-item bg-gray-50 rounded-lg overflow-hidden">
											<div class="faq-question p-4 font-medium cursor-pointer flex justify-between items-center">
												<span><?php echo esc_html(tznew_get_sub_field_safe('question')); ?></span>
												<span class="dashicons dashicons-arrow-down-alt2"></span>
											</div>
											<div class="faq-answer p-4 pt-0 border-t border-gray-200 hidden">
												<div class="prose max-w-none pt-4">
													<?php echo wp_kses_post(tznew_get_sub_field_safe('answer')); ?>
												</div>
											</div>
										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
				
				<?php
				// Additional Information
			$additional_info = tznew_get_field_safe('additional_information');
			if ($additional_info) : ?>
				<div class="faq-additional-info mt-8 p-6 bg-blue-50 rounded-lg">
					<h2 class="text-2xl font-bold mb-4"><?php esc_html_e('Additional Information', 'tznew'); ?></h2>
					<div class="prose max-w-none">
						<?php echo wp_kses_post($additional_info); ?>
					</div>
				</div>
			<?php endif; ?>
				
				<?php
				// Contact Information
			$show_contact_info = tznew_get_field_safe('show_contact_info');
			$contact_info = tznew_get_field_safe('contact_information');
			if ($show_contact_info && $contact_info) : ?>
				<div class="faq-contact-info mt-8 p-6 bg-gray-50 rounded-lg">
					<h2 class="text-2xl font-bold mb-4"><?php esc_html_e('Still Have Questions?', 'tznew'); ?></h2>
					<div class="prose max-w-none">
						<?php echo wp_kses_post($contact_info); ?>
					</div>
				</div>
			<?php endif; ?>
				
				<script>
				// FAQ Toggle Script
				document.addEventListener('DOMContentLoaded', function() {
					const faqQuestions = document.querySelectorAll('.faq-question');
					faqQuestions.forEach(question => {
						question.addEventListener('click', function() {
							const answer = this.nextElementSibling;
							const icon = this.querySelector('.dashicons');
							
							// Toggle answer visibility
							answer.classList.toggle('hidden');
							
							// Toggle icon
							if (answer.classList.contains('hidden')) {
								icon.classList.remove('dashicons-arrow-up-alt2');
								icon.classList.add('dashicons-arrow-down-alt2');
							} else {
								icon.classList.remove('dashicons-arrow-down-alt2');
								icon.classList.add('dashicons-arrow-up-alt2');
							}
						});
					});
				});
				</script>
				
			<?php endif; // End if function_exists('get_field') ?>
			
		else :
			// Archive view
			the_title( '<h2 class="entry-title text-xl font-bold mb-2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			
			// Display FAQ excerpt
			if (function_exists('get_field') && tznew_have_rows_safe('faq_categories')) :
				// Get the first category and first question as preview
				$first_category = null;
				$first_question = null;
				$first_answer = null;
				
				while (tznew_have_rows_safe('faq_categories')) {
					tznew_the_row_safe();
					$first_category = tznew_get_sub_field_safe('category_name');
					
					if (tznew_have_rows_safe('questions')) {
						while (tznew_have_rows_safe('questions')) {
							tznew_the_row_safe();
							$first_question = tznew_get_sub_field_safe('question');
							$first_answer = tznew_get_sub_field_safe('answer');
							break 2; // Break out of both loops
						}
					}
				}
				
				if ($first_category) :
					?>
					<div class="faq-category-preview text-sm text-gray-600 mb-2">
						<?php echo esc_html($first_category); ?>
					</div>
					<?php
				endif;
				
				if ($first_question && $first_answer) :
					?>
					<div class="faq-preview mb-4">
						<div class="faq-question-preview font-medium mb-2">
							<?php echo esc_html($first_question); ?>
						</div>
						<div class="faq-answer-preview">
							<?php echo wp_trim_words(wp_strip_all_tags($first_answer), 20, '...'); ?>
						</div>
					</div>
					<?php
				endif;
			else :
				the_excerpt();
			endif;
			?>
			
			<div class="mt-4">
				<a href="<?php echo esc_url(get_permalink()); ?>" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-300">
					<?php esc_html_e('View All FAQs', 'tznew'); ?>
				</a>
			</div>
			
		endif; // End is_singular() check
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->