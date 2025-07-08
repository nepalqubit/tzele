<?php
/**
 * The template for displaying search forms
 *
 * @package TZnew
 */

// Unique ID for search form
$tznew_unique_id = wp_unique_id( 'search-form-' );
?>

<form role="search" method="get" class="search-form flex w-full max-w-md mx-auto" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $tznew_unique_id ); ?>" class="sr-only">
		<?php echo esc_html_x( 'Search for:', 'label', 'tznew' ); ?>
	</label>
	<div class="relative flex-grow">
		<input type="search" id="<?php echo esc_attr( $tznew_unique_id ); ?>" class="search-field w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
			placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'tznew' ); ?>" 
			value="<?php echo get_search_query(); ?>" 
			name="s" />
	</div>
	<button type="submit" class="search-submit bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-r-md transition duration-300">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'tznew' ); ?></span>
		<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
		</svg>
	</button>
</form>