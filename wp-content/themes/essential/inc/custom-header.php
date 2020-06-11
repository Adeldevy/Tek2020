<?php
/*
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Essential
 */

if (!function_exists('essential_custom_header_setup')) :
/**
 * Set up the WordPress core custom header feature.
 *
 * @uses essential_header_style()
 */
	function essential_custom_header_setup() {
		add_theme_support( 'custom-header', apply_filters( 'essential_custom_header_args', array(
			'default-image'          => '',
			'default-text-color'     => '',
			'width'                  => 1000,
			'height'                 => 250,
			'flex-height'            => true,
			'wp-head-callback'       => 'essential_header_style',
		) ) );


		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'essential_custom_background_args', array(
			'default-color' => '',
			'default-image' => '',
		) ) );

	}


endif;
add_action( 'after_setup_theme', 'essential_custom_header_setup' );

if ( ! function_exists( 'essential_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see essential_custom_header_setup().
 */
function essential_header_style() {
	$header_text_color = get_header_textcolor();
	$background_color = get_background_color();
	$background_image = get_background_image(); 
	$header_image = get_header_image(); 


	if ($background_image || $background_color != 'f9f9f9' ) : ?>
	<style type="text/css">
	.rm {
	    border: 50px solid transparent;
	    background-color: transparent;
	    border-bottom: none;
	}
	</style>
	<?php
    endif;

	if ( !empty($header_image) ) : ?>
	<style type="text/css">
		.navbar-fixed-top {
	    	background-image: url(<?php echo esc_url( $header_image ); ?>);
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
		}
	</style>
	<?php
    endif;

	// If we get this far, we have custom styles. Let's do this.
	if( !empty($header_text_color) && $header_text_color != 'fff') : ?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) : 
		else : ?>
		.navbar.navbar-light .navbar-nav.nav-text-light > li.active > a,
		.navbar.navbar-light .navbar-nav.nav-text-light > li > a,
		.navbar-nav > li > a{
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	</style>
	<?php endif; 
	endif;

}
endif;
