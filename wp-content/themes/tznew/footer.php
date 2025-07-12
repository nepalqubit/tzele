<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TZnew
 */

?>

	</div><!-- #content -->

<?php
// Check if Elementor Theme Builder footer exists
if ( function_exists( 'tznew_elementor_location_exists' ) && tznew_elementor_location_exists( 'footer' ) ) {
    // Use Elementor Theme Builder footer
    tznew_elementor_do_location( 'footer' );
} else {
    // Fallback to default footer
    ?>
    <footer id="colophon" class="site-footer bg-gradient-to-b from-gray-900 to-black text-white relative overflow-hidden">
		<!-- Background decoration -->
		<div class="absolute inset-0 opacity-10">
			<div class="absolute top-10 left-10 w-20 h-20 bg-blue-500 rounded-full animate-pulse"></div>
			<div class="absolute bottom-10 right-10 w-16 h-16 bg-green-500 rounded-full animate-pulse delay-1000"></div>
			<div class="absolute top-1/2 left-1/4 w-12 h-12 bg-yellow-500 rounded-full animate-pulse delay-500"></div>
		</div>
		
		<div class="container mx-auto px-4 py-16 relative z-10">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
				<div class="footer-section animate-fade-in-up">
					<div class="mb-6">
						<h3 class="text-2xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-green-400 bg-clip-text text-transparent">
							<?php bloginfo('name'); ?>
						</h3>
						<p class="text-gray-300 leading-relaxed"><?php bloginfo('description'); ?></p>
					</div>
					<div class="flex items-center space-x-2 text-sm text-gray-400">
						<i class="fas fa-award text-yellow-500"></i>
						<span>Licensed & Insured</span>
					</div>
				</div>
				
				<div class="footer-section animate-fade-in-up delay-200">
					<h3 class="text-lg font-bold mb-6 text-white">Quick Links</h3>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer',
						'menu_class' => 'footer-menu space-y-3',
						'container' => false,
						'fallback_cb' => 'tznew_footer_fallback_menu',
					));
					?>
				</div>
				
				<div class="footer-section animate-fade-in-up delay-400">
					<h3 class="text-lg font-bold mb-6 text-white">Contact Info</h3>
					<div class="space-y-4 text-gray-300">
						<div class="flex items-start space-x-3 hover:text-white transition-colors duration-300">
							<i class="fas fa-location-dot text-blue-400 mt-1"></i>
							<span>123 Adventure Street, Kathmandu, Nepal</span>
						</div>
						<div class="flex items-center space-x-3 hover:text-white transition-colors duration-300">
							<i class="fas fa-phone text-green-400"></i>
							<a href="tel:+977-1-234567" class="hover:text-blue-400 transition-colors">+977-1-234567</a>
						</div>
						<div class="flex items-center space-x-3 hover:text-white transition-colors duration-300">
							<i class="fas fa-envelope text-yellow-400"></i>
							<a href="mailto:info@dragonholidays.com" class="hover:text-blue-400 transition-colors">info@dragonholidays.com</a>
						</div>
						<div class="flex items-center space-x-3 hover:text-white transition-colors duration-300">
							<i class="fas fa-clock text-purple-400"></i>
							<span>24/7 Support Available</span>
						</div>
					</div>
				</div>
				
				<div class="footer-section animate-fade-in-up delay-600">
					<h3 class="text-lg font-bold mb-6 text-white">Follow Our Journey</h3>
					<div class="flex flex-wrap gap-4 mb-6">
						<a href="#" class="bg-blue-600 hover:bg-blue-700 p-3 rounded-full transition-all duration-300 transform hover:scale-110 hover:shadow-lg" title="Facebook">
							<i class="fab fa-facebook-f text-lg"></i>
						</a>
						<a href="#" class="bg-blue-400 hover:bg-blue-500 p-3 rounded-full transition-all duration-300 transform hover:scale-110 hover:shadow-lg" title="Twitter">
							<i class="fab fa-twitter text-lg"></i>
						</a>
						<a href="#" class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 p-3 rounded-full transition-all duration-300 transform hover:scale-110 hover:shadow-lg" title="Instagram">
							<i class="fab fa-instagram text-lg"></i>
						</a>
						<a href="#" class="bg-red-600 hover:bg-red-700 p-3 rounded-full transition-all duration-300 transform hover:scale-110 hover:shadow-lg" title="YouTube">
							<i class="fab fa-youtube text-lg"></i>
						</a>
						<a href="#" class="bg-green-600 hover:bg-green-700 p-3 rounded-full transition-all duration-300 transform hover:scale-110 hover:shadow-lg" title="WhatsApp">
							<i class="fab fa-whatsapp text-lg"></i>
						</a>
					</div>
					
					<div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-4 border border-gray-700">
						<h4 class="font-semibold mb-2 text-blue-400">Newsletter</h4>
						<p class="text-sm text-gray-300 mb-3">Get adventure updates & exclusive offers</p>
						<form class="flex gap-2">
							<input type="email" placeholder="Your email" class="flex-1 px-3 py-2 bg-gray-700 border border-gray-600 rounded text-sm focus:outline-none focus:border-blue-500 transition-colors" />
							<button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-sm font-medium transition-colors">
								<i class="fas fa-paper-plane"></i>
							</button>
						</form>
					</div>
				</div>
			</div>
			
			<!-- Trust badges -->
			<div class="border-t border-gray-700 mt-12 pt-8">
				<div class="flex flex-wrap justify-center items-center gap-8 mb-8 text-sm text-gray-400">
					<div class="flex items-center space-x-2">
						<i class="fas fa-shield-alt text-green-400"></i>
						<span>Secure Booking</span>
					</div>
					<div class="flex items-center space-x-2">
						<i class="fas fa-medal text-yellow-400"></i>
						<span>15+ Years Experience</span>
					</div>
					<div class="flex items-center space-x-2">
						<i class="fas fa-users text-blue-400"></i>
						<span>10,000+ Happy Travelers</span>
					</div>
					<div class="flex items-center space-x-2">
						<i class="fas fa-star text-yellow-400"></i>
						<span>4.9/5 Rating</span>
					</div>
				</div>
				
				<div class="text-center text-gray-400">
					<p class="mb-2">
						&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
						<span class="mx-2">|</span>
						<a href="/privacy-policy" class="hover:text-blue-400 transition-colors">Privacy Policy</a>
						<span class="mx-2">|</span>
						<a href="/terms-conditions" class="hover:text-blue-400 transition-colors">Terms & Conditions</a>
					</p>
					<p class="text-sm">
						Powered by <a href="https://techzeninc.com" target="_blank" class="text-blue-400 hover:text-blue-300 transition duration-300">TechZen Corporation</a>
					</p>
				</div>
			</div>
		</div>
		
		<!-- Back to top button -->
		<div class="back-to-top fixed bottom-8 right-8 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 cursor-pointer opacity-0 invisible" id="back-to-top">
			<i class="fas fa-arrow-up"></i>
		</div>
	</footer><!-- #colophon -->
    <?php
}
?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>