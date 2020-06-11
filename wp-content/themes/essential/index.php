<?php

/**
 * Index Page
 *
 * @package essential
 */

get_header();

$content_class = '';

if((is_active_sidebar('sidebar-1') && essential_get_options('blog_sidebar')) || (is_active_sidebar('sidebar-1') && ! class_exists('Essential_Core')) && function_exists('get_field') && get_field('sidebar', 'option') && function_exists('get_field') && get_field('sidebar_position', 'option') == 'left') {
	 $content_class .= 'pl-5';
}

if((is_active_sidebar('sidebar-1') && essential_get_options('blog_sidebar')) || (is_active_sidebar('sidebar-1') && ! class_exists('Essential_Core')) && ((function_exists('get_field') && get_field('sidebar', 'option') && get_field('sidebar_position', 'option') == 'right') || !function_exists('get_field'))) {
	 $content_class .= 'pr-5';
}

?>

<div class="container blog-main-page simple-article-block">

	<?php if((is_active_sidebar('sidebar-1') && essential_get_options('blog_sidebar')) || (is_active_sidebar('sidebar-1') && ! class_exists('Essential_Core'))) { ?>

		<div class="row">
			<?php if(function_exists('get_field') && get_field('sidebar', 'option') && get_field('sidebar_position', 'option') == 'left') {
				get_sidebar();
			}

			if((function_exists('get_field') && get_field('sidebar', 'option')) || !function_exists('get_field')) { ?>
				<div class="col-lg-9 col-12 <?php echo esc_attr($content_class); ?>">
			<?php } ?>

	<?php } ?>

	<div class="posts-wrapper">
		<?php if ( have_posts() ) : ?>
			<h2 class="blog-main-title"> <?php esc_html_e('The Blog', 'essential');?><hr></h2>
	        <?php while ( have_posts() ) : the_post();
	        	$comments_count = wp_count_comments( get_the_ID() );
				$meta_data = get_post_meta( get_the_ID(), 'essential_post_options', true );
				$post_preview_style = ( ! empty( $meta_data['post_preview_style'] ) ) ? $meta_data['post_preview_style'] : 'image'; ?>
					<div <?php post_class('blog-post-item'); ?>>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php if(!is_page()) { ?>
				 	<div class="post-details">
						<span class="post-date"><span class="ion-ios-calendar"></span> <?php the_time( get_option('date_format') ); ?></span>
						<span class="post-comments"><span class="ion-ios-chatboxes"></span> <?php echo esc_html( $comments_count->total_comments ); ?> <?php esc_html_e( 'comments', 'essential' ); ?></span>
						<span class="post-categories"><span class="ion-ios-bookmark"></span>
						<?php the_category(); ?>
						</span>
					</div>
					<?php
					}
					switch ( $post_preview_style ) {
					   	case 'image':
					   		if ( has_post_thumbnail() ) {
								?>
							<div class="post-image">
								<?php the_post_thumbnail('large');?>
							</div>
						<?php }
					    	break;
					   	case 'video':
					   		if( ! empty( $meta_data['post_video'] ) ) {
					   			?>
					      		<div class="post-video">
					      			<?php echo wp_kses_post( $meta_data['post_video'] ); ?>
					      		</div>
					   		<?php }
					   		break;
					    case 'slider':
					 		if( ! empty( $meta_data['post_slider'] ) ) { ?>
					 			<div class="swiper-container post-slider" data-autoplay="0" data-loop="1" data-speed="1000" data-center="0" data-slides-per-view="1">
								<div class="swiper-wrapper">
								<?php
									$ids = explode( ',', $meta_data['post_slider'] );
									foreach ( $ids as $id ) { ?>
										<div class="swiper-slide">
											<img class="center-image" src="<?php echo esc_url( $id['src'] );?>" alt="<?php echo esc_attr($id['alt']); ?>">
										</div>
									<?php }
								?>
								</div>
										<div class="pagination"></div>
							</div>
					   		<?php }
					   		break;

					   	default:
					   		if ( has_post_thumbnail() ) {
					          the_post_thumbnail();
					      }
					  		break;
					}
					?>
					<div class="excerpt">
					   	<?php the_excerpt(); ?>
						</div>
					<a href="<?php the_permalink(); ?>" class="btn"><?php esc_html_e( 'Read More', 'essential' ); ?></a>
				</div>
	        <?php endwhile; ?>
	    	<?php
		 	$paginate_links = paginate_links( array( 'prev_text' => '', 'next_text' => '' ) );
    		if ( $paginate_links ) { ?>
	        <div class="essential-paginations">
	            <?php echo wp_kses_post( $paginate_links ); ?>
	        </div>
	    	<?php } ?>
	 		<?php else : ?>
			<div id="empty-search-result">
			    <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'essential' ); ?></p>
			    <?php get_search_form( true ); ?>
			</div>
		<?php endif; ?>
	</div>

	<?php if((is_active_sidebar('sidebar-1') && essential_get_options('blog_sidebar')) || (is_active_sidebar('sidebar-1') && ! class_exists('Essential_Core'))) { ?>

		</div>

	<?php if((function_exists('get_field') && get_field('sidebar', 'option') && get_field('sidebar_position', 'option') == 'right') || !function_exists('get_field')) { ?>

		<?php get_sidebar(); ?>

	<?php } ?>

		</div>

	<?php } ?>

</div>

<?php get_footer(); ?>
