<?php

/**
 * Onepage Template
 *
 * @package essential
 * @since 1.0
 *
 */

$page_list = apply_filters('essential_custom_page_list', essential_get_options( 'essential_sortable_pages' ));

foreach ($page_list as $key => $post_id) {
	$post = get_post($post_id); ?>
	<div id="<?php echo esc_attr( $post->post_name );?>" class="container">
		<?php echo apply_filters( 'the_content', $post->post_content ); ?>
	</div>
	<?php
}
