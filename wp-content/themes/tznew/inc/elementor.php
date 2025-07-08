<?php
/**
 * Elementor Integration
 *
 * @package TZNEW
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Elementor support for the theme
 */
function tznew_elementor_support() {
    // Add support for Elementor locations
    add_theme_support( 'elementor-header-footer' );
    
    // Add support for Elementor Pro locations
    if ( class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
        add_theme_support( 'elementor-pro-header-footer' );
    }
}
add_action( 'after_setup_theme', 'tznew_elementor_support' );

/**
 * Register Elementor widgets categories
 *
 * @param \Elementor\Elements_Manager $elements_manager Elementor elements manager.
 */
function tznew_register_elementor_categories( $elements_manager ) {
    $elements_manager->add_category(
        'tznew-elements',
        [
            'title' => esc_html__( 'TZNEW Elements', 'tznew' ),
            'icon'  => 'fa fa-plug',
        ]
    );
}
add_action( 'elementor/elements/categories_registered', 'tznew_register_elementor_categories' );