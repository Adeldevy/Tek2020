<?php

/**
 * Custom Page Template
 *
 * @package essential
 */

get_header();

if(has_post_thumbnail()) {

?>

<!-- BANNER TOP -->
<div class="banner-top" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url()); ?>);">
	<div class="banner-content">
	<?php if(has_post_thumbnail()) { ?><div class="banner-overlay"><?php } ?>
		<div class="container text-center">
			<h1><?php the_title(); ?></h1>
		</div>
	<?php if(has_post_thumbnail()) { ?></div><?php } ?>
	</div>
</div>

<?php

}

$page_list = apply_filters('essential_custom_page_list', essential_get_options('essential_sortable_pages'));

if ( get_option('show_on_front') == 'page' && essential_get_options('enable_onepage') ) {

	if( !empty($page_list) && in_array( get_the_ID(), $page_list ) ) {
		get_template_part( 'page-templates/page', 'onepage' );
	} else {
		get_template_part( 'page-templates/page', 'multipage' );
	}

} else {
	get_template_part( 'page-templates/page', 'multipage' );
}

get_footer();
