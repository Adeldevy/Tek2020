<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="top">

	<?php wp_body_open(); ?>

	<!-- NAVBAR -->
	<?php
	$nav_class = '';
	if ( ! class_exists( 'Essential_Core' ) || is_home() || is_404() || is_search()):
		$nav_class = 'navbar-light-static';
	endif;
	if ( ! class_exists( 'Essential_Core' ) ) {
		$nav_class .= ' small';
	}
	?>
	<div class="navbar fixed-top navbar-expand-xl <?php echo esc_attr( $nav_class ); ?>">
		<div class="navbar-container">

			<?php
			$logo = essential_get_options('essential_logo_image');
			$text_logo = essential_get_options('essential_logo_text', get_bloginfo( 'name' ));
			if ( essential_get_options('essential_type_logo') == 'image' && !empty($logo) ) :
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-title">
					<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $text_logo ); ?>" class="image-logo">
				</a>
			<?php elseif( ( essential_get_options('essential_type_logo') == 'text' || ! class_exists( 'Essential_Core' ) ) || ( essential_get_options('essential_type_logo') == 'image' && empty($logo) ) ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-title">
						<?php echo esc_html( $text_logo ); ?>
				</a>
			<?php endif; ?>

			<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle Navigation">
				<span class="navbar-toggler-icon"></span>
				<span class="navbar-toggler-icon"></span>
				<span class="navbar-toggler-icon"></span>
			</button>

			<?php essential_custom_menu(); ?>

		</div>
	</div>

	<?php if( essential_get_options('essential_page_preloader') ) { ?>
		<div id="loading">
			<div id="loading-center">
				<div id="loading-center-absolute">
					<div class="cssload-wrap">
						<div class="cssload-cssload-spinner"></div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
