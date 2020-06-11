<?php
/**
 * Essential Theme Customizer.
 *
 * @package Essential
 */

if (!function_exists('essential_customize_register')) :
	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function essential_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_image' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_image' )->transport = 'postMessage';
	}
endif;
add_action( 'customize_register', 'essential_customize_register' );

if (!function_exists('essential_customize_preview_js')) :
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function essential_customize_preview_js() {
	wp_enqueue_script( 'essential_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20160714', true );

	wp_localize_script( 'essential_customizer', 'wp_customizer', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'theme_url' => get_template_directory_uri(),
		'site_name' => get_bloginfo( 'name' )
	));
}
endif;
add_action( 'customize_preview_init', 'essential_customize_preview_js' );

if (!function_exists('essential_button_customize_js')) :
function essential_button_customize_js(){

	wp_enqueue_script( 'essential_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-controls' ), '20160714', true );

}
endif;
add_action( 'customize_controls_enqueue_scripts', 'essential_button_customize_js' );
