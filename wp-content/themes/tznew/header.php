<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TZnew
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Preloader -->
<div class="preloader fixed inset-0 bg-white z-50 flex items-center justify-center">
	<div class="preloader-content text-center">
		<div class="animate-spin rounded-full h-16 w-16 border-b-2 border-blue-600 mx-auto mb-4"></div>
		<p class="text-gray-600 animate-pulse">Loading...</p>
	</div>
</div>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'tznew' ); ?></a>

	<header id="masthead" class="site-header bg-white/95 backdrop-blur-md shadow-lg fixed w-full top-0 z-40 transition-all duration-300">
		<div class="container mx-auto px-4 py-4">
			<div class="flex items-center justify-between">
				<div class="site-branding flex items-center animate-fade-in-left">
					<?php
					if ( has_custom_logo() ) :
						the_custom_logo();
					else :
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title text-2xl lg:text-3xl font-bold text-blue-800 hover:text-blue-600 transition-colors">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
							<?php
					else :
							?>
							<p class="site-title text-2xl lg:text-3xl font-bold text-blue-800 hover:text-blue-600 transition-colors">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</p>
							<?php
					endif;
					endif;
					?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation animate-fade-in-right">
					<button class="menu-toggle lg:hidden flex flex-col gap-1 p-2 rounded-lg hover:bg-gray-100 transition-colors" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle Menu">
						<span class="w-6 h-0.5 bg-gray-700 transition-all duration-300"></span>
						<span class="w-6 h-0.5 bg-gray-700 transition-all duration-300"></span>
						<span class="w-6 h-0.5 bg-gray-700 transition-all duration-300"></span>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container_class' => 'primary-menu-container hidden lg:block',
							'menu_class'     => 'primary-menu flex items-center space-x-8',
							'fallback_cb'    => false,
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->

	<?php if (!is_front_page()): ?>
	<div class="breadcrumbs-container bg-gray-100 py-2">
		<div class="container mx-auto px-4">
			<?php tznew_breadcrumbs(); ?>
		</div>
	</div>
	<?php endif; ?>

	<div id="content" class="site-content pt-20">