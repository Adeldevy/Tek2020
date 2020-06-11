<?php

// ACF functions

function essential_generate_options_css() {
   ob_start();
   require(F_PATH . '/custom-styles.php');
   $css = ob_get_clean();

   global $wp_filesystem;

   if( is_null( $wp_filesystem ) )
       WP_Filesystem();

   $filename = T_PATH . '/assets/css/custom-styles.css';

   $wp_filesystem->put_contents($filename, $css, LOCK_EX);
   chmod($filename, 0664);
}
add_action('acf/save_post', 'essential_generate_options_css', 20);

if ( ! function_exists( 'essential_acf_init' ) ) {
   function essential_acf_init() {

   	if( function_exists('acf_add_options_page') ) {

   		$option_page = acf_add_options_page(array(
   			'page_title' 	=> __('Theme Settings', 'essential'),
   			'menu_title' 	=> __('Theme Settings', 'essential'),
   			'menu_slug' 	=> 'theme-settings',
   		));

         acf_add_options_sub_page(array(
      		'page_title' 	=> __('General Options', 'essential'),
      		'menu_title'	=> __('General Options', 'essential'),
      		'parent_slug'	=> 'theme-settings',
      	));

         acf_add_options_sub_page(array(
      		'page_title' 	=> __('Header Options', 'essential'),
      		'menu_title'	=> __('Header Options', 'essential'),
      		'parent_slug'	=> 'theme-settings',
      	));

      	acf_add_options_sub_page(array(
      		'page_title' 	=> __('Footer Options', 'essential'),
      		'menu_title'	=> __('Footer Options', 'essential'),
      		'parent_slug'	=> 'theme-settings',
      	));

   	}

   }
}
add_action('acf/init', 'essential_acf_init');

function essential_acf_json_save_point( $path ) {
	$path = F_PATH . '/acf/acf-json';

	return $path;
}
add_filter( 'acf/settings/save_json', 'essential_acf_json_save_point' );

function essential_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = F_PATH . '/acf/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'essential_acf_json_load_point' );

?>
