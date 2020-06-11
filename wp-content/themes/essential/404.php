<?php

/**
 * 404 Page
 *
 * @package essential
 */

get_header(); ?>

<div class="not-founded simple-article-block page404">
	<div class="no-found-wrap">
		<div class="not-found-title">
			<span><?php esc_html_e( 'Error 404', 'essential' ); ?></span>
			<h1><?php esc_html_e( 'Looks like page do not exist', 'essential' ); ?></h1>
		</div>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn"><?php esc_html_e( 'Go home', 'essential' ); ?></a>
	</div>
</div>

<?php get_footer(); ?>
