<?php
header("Content-type: text/css; charset: UTF-8");


$page_list = apply_filters('essential_custom_page_list', essential_get_options( 'essential_sortable_pages' ));

if (class_exists('Vc_Base')) {
	$customCss = new Vc_Base;
	foreach ($page_list as $post_id) {
	    $post = get_post($post_id); 
	    echo wp_kses_post( $customCss->parseShortcodesCustomCss( $post->post_content ) );
	}
}