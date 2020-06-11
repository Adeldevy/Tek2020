<?php

/**
* Multipage page template
*
* @package essential
* @since 1.0
*
*/

$content_class = ( cs_get_option('single_page_sidebar') && cs_get_option('single_page_sidebar') == true ) ? 9 : 12;

get_header();

while ( have_posts() ) : the_post();
    $comments_count = wp_count_comments( get_the_ID() );
    $content = get_the_content();
    if ( ! stristr( $content, 'vc_' ) ) {
        ?>
        <div class="container simple-article-block">
            <div class="row">
                <div class="posts-wrapper style-1 col-md-<?php echo esc_attr( $content_class );?>">
                    <div class="post-content">
                        <?php if(!has_post_thumbnail()) { ?>
                        <div class="article-title">
                            <h2 class="title">
                                <?php the_title(); ?>
                            </h2>
                        </div>
                        <?php } ?>
                        <div class="simple-article single-page">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php if ( comments_open() ) { ?>
                        <div class="comment-widget">
                            <?php comments_template( '', true ); ?>
                        </div>
                    <?php } ?>
                </div>
                <?php if( cs_get_option('single_page_sidebar') && cs_get_option('single_page_sidebar') == true ) { ?>
                    <div class="col-md-3 bg-c-1 sidebar style-1">
                        <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar('sidebar') ); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <div class="container">
            <?php the_content(); ?>
        </div>
    <?php } ?>
<?php endwhile; ?>

<?php get_footer();
