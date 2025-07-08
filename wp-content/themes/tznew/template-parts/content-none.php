<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TZnew
 */

?>

<section class="no-results not-found bg-white rounded-lg shadow-md p-8 mb-8">
	<header class="page-header mb-6">
		<h1 class="page-title text-2xl font-bold"><?php esc_html_e( 'Nothing Found', 'tznew' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'tznew' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p class="mb-6"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'tznew' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

			<p class="mb-6"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'tznew' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->