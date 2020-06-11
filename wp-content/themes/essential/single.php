<?php

/**
 * Single Post
 *
 * @package essential
 */

get_header();

$content_class = '';

if(((is_active_sidebar('sidebar-1') && essential_get_options('single_post_sidebar')) || (is_active_sidebar('sidebar-1') && ! class_exists('Essential_Core'))) && is_active_sidebar('sidebar-1') && function_exists('get_field') && get_field('sidebar', 'option') && function_exists('get_field') && get_field('sidebar_position', 'option') == 'left') {
	 $content_class .= 'pl-5';
}

if(((is_active_sidebar('sidebar-1') && essential_get_options('single_post_sidebar')) || (is_active_sidebar('sidebar-1') && ! class_exists('Essential_Core'))) && is_active_sidebar('sidebar-1') && ((function_exists('get_field') && get_field('sidebar', 'option') && get_field('sidebar_position', 'option') == 'right') || !function_exists('get_field'))) {
	 $content_class .= 'pr-5';
}

while ( have_posts() ) : the_post();

    $comments_count = wp_count_comments( get_the_ID() );
?>

    <div class="banner-post s-back-switch">

      <?php the_post_thumbnail( 'large', array('class' => 's-img-switch')); ?>

      <div class="banner-content">
         <div class="article-title">
             <h2 class="title">
                 <?php the_title(); ?>
             </h2>
         </div>
         <div class="post-details">
             <span class="date"><?php the_time( get_option('date_format') ); ?> | </span>
             <span class="post-social-link"> <?php echo esc_html( $comments_count->total_comments );?> <?php esc_html_e( 'Comments', 'essential' ); ?></span>
         </div>
      </div>
    </div>

    <div class="container simple-article-block single-posts margin-lg-100t margin-sm-30t margin-xs-15t">
      <?php if((is_active_sidebar('sidebar-1') && essential_get_options('single_post_sidebar')) || (is_active_sidebar('sidebar-1') && ! class_exists('Essential_Core'))) { ?>

          <div class="row">
             <?php if(function_exists('get_field') && get_field('sidebar', 'option') && get_field('sidebar_position', 'option') == 'left') {
                get_sidebar();
             }

             if((function_exists('get_field') && get_field('sidebar', 'option')) || !function_exists('get_field')) { ?>
                <div class="col-lg-9 col-12 <?php echo esc_attr($content_class); ?>">
             <?php } ?>

      <?php } ?>
     	<div class="post-block-article posts-wrapper">
          <div class="simple-article margin-lg-40b margin-sm-20b">
          	<?php the_content(); ?>
              <?php wp_link_pages('link_before=<span class="pages">&link_after=</span>&before=<div class="post-nav"> <span>' . esc_html__( "Page:", 'essential' ) . ' </span> &after=</div>'); ?>
          </div>
      	<?php if( has_tag() ) { ?>
         	<div class="tags-widget">
             	<div class="tag-box">
                 	<?php the_tags();?>
             	</div>
         	</div>
      	<?php } ?>
     		<?php if( has_category() ) { ?>
         	<div class="tags-widget">
             	<div class="tag-box">
                      <?php esc_html_e('Category:', 'essential'); ?>
                 	<?php the_category(', ');?>
             	</div>
         	</div>
      	<?php } ?>
		<?php if ( comments_open() ) { ?>
		  <div class="comment-widget margin-sm-35t margin-lg-50t">
		      <?php comments_template( '', true ); ?>
		  </div>
		<?php } ?>
		<?php if( essential_get_options('post_navigation') ) { ?>
		  <div class="sm-widget">
		      <div class="same-post row">
		      <?php
		      $prev_post = get_previous_post();
		      if ( ! empty( $prev_post ) ) : ?>
		          <div class="col-md-6">
		              <b class="sm-title"><?php esc_html_e('Previous Post', 'essential'); ?></b>
		              <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="title"><?php echo esc_html( $prev_post->post_title); ?></a>
		          </div>
		      <?php endif; ?>
		      <?php
		      $next_post = get_next_post();
		      if ( ! empty( $next_post ) ) : ?>
		          <div class="col-md-6 text-align-right">
		              <b class="sm-title"><?php esc_html_e('Next Post', 'essential'); ?></b>
		              <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="title"><?php echo esc_html( $next_post->post_title); ?></a>
		          </div>
		      <?php endif; ?>
		      </div>
		  </div>
		<?php } ?>
      </div>
      <?php if((is_active_sidebar('sidebar-1') && essential_get_options('single_post_sidebar')) || (is_active_sidebar('sidebar-1') && ! class_exists('Essential_Core'))) { ?>

		</div>

     	<?php if((function_exists('get_field') && get_field('sidebar', 'option') && get_field('sidebar_position', 'option') == 'right') || !function_exists('get_field')) { ?>

     	<?php get_sidebar(); ?>

     	<?php } ?>

     	</div>

     <?php } ?>
 </div>

<?php endwhile; ?>

<?php get_footer();
