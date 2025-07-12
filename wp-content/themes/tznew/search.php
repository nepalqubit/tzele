<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package TZnew
 */

get_header();
?>

<?php
// Check if Elementor Theme Builder search results template exists
if ( function_exists( 'tznew_elementor_location_exists' ) && tznew_elementor_location_exists( 'search-results' ) ) {
    // Use Elementor Theme Builder search results template
    tznew_elementor_do_location( 'search-results' );
} else {
    // Fallback to default search template
    ?>
    <main id="primary" class="site-main container mx-auto py-8 px-4">

        <?php if ( have_posts() ) : ?>

            <header class="page-header mb-8">
                <h1 class="page-title text-3xl font-bold mb-4">
                    <?php
                    /* translators: %s: search query. */
                    printf( esc_html__( 'Search Results for: %s', 'tznew' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
                
                <?php get_search_form(); ?>
            </header><!-- .page-header -->

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', 'search' );

                endwhile;
                ?>
            </div>

            <?php
            // Previous/next page navigation.
            tznew_pagination();

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>

    </main><!-- #main -->
    <?php
}
?>

<?php
get_sidebar();
get_footer();