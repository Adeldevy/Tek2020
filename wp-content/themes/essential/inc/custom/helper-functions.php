<?php
/**
 * Required functions for theme backend.
 *
 * @package essential
 */

/**
 *
 * Helper Functions
 * @since 1.0.0
 * @version 1.0.0
 *
 */

// cs framework missing
if (! function_exists('cs_get_option')) {
   function cs_get_option(){
    return '';
   }
   function cs_get_customize_option(){
    return '';
   }
}

/**
 *
 * Create custom html structure for comments
 *
 */
if ( ! function_exists('essential_comment' ) ) {
  function essential_comment( $comment, $args, $depth ) {

    $GLOBALS['comment'] = $comment;

    $reply_class = ( $comment->comment_parent ) ? 'indented' : '';
    switch ( $comment->comment_type ):
      case 'pingback':
      case 'trackback':
        ?>
          <div class="pingback">
            <?php esc_html_e( 'Pingback:', 'essential' ); ?> <?php comment_author_link(); ?>
            <?php edit_comment_link( esc_html__( '(Edit)', 'essential' ), '<span class="edit-link">', '</span>' ); ?>
          </div>
        <?php
        break;
      default:
        // generate comments
        ?>
          <li <?php comment_class('ct-part'); ?> id="li-comment-<?php comment_ID(); ?>">
          <div id="comment-<?php comment_ID(); ?>">
            <div class="content">
              <div class="person">
                <?php echo get_avatar( $comment, '43', '', '', array('class'=>'img-circle') ); ?>
                <a href="#" class="author">
                  <?php comment_author(); ?>
                </a>
              <span class="comment-date">
                <?php comment_date( get_option('date_format') );?>
              </span>
              </div>
              <div class="text">
                <?php comment_text(); ?>
              </div>
              <div class="reply-wrapper">
                <?php
                  comment_reply_link(
                    array_merge( $args,
                      array(
                        'reply_text' => esc_html__( 'Reply', 'essential' ),
                        'after' => '',
                        'depth' => $depth,
                        'max_depth' => $args['max_depth']
                      )
                    )
                  );
                ?>
              </div>
            </div>
          </div>

        <?php
        break;
    endswitch;
  }
}

/**
 *
 * Get categories for shortcode.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists('essential_element_values' ) ) {
  function essential_element_values() {

    $args = array(
      'type'     => 'post',
      'taxonomy' => 'category'
    );

    $categories = get_categories( $args );
    $list = array();

    foreach ( $categories as $category ) {
      $list[$category->name] = $category->term_id;
    }
    return $list;
  }
}

/*
 * Change exerpt end.
 */
if ( ! function_exists('essential_excerpt_more' ) ) {
  function essential_excerpt_more( $more ) {
    return '...';
  }
}
add_filter('excerpt_more', 'essential_excerpt_more');


if ( ! function_exists('essential_wp_link_pages' ) ) {
  function essential_wp_link_pages() {
    get_post_format();
  }
}

/**
 *
 * Get categories for shortcode.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists('essential_categories' ) ) {
  function essential_categories() {

    $args = array(
      'type'     => 'post',
      'taxonomy' => 'category'
    );

    $categories = get_categories( $args );
    $list = array();

    foreach ( $categories as $category ) {
      $list[$category->name] = $category->slug;
    }
    return $list;
  }
}

// Change excerpt length.
if ( ! function_exists('essential_excerpt_length' ) ) {
  function essential_excerpt_length( $length ) {
    return 22;
  }
}
add_filter( 'excerpt_length', 'essential_excerpt_length', 999 );

// Custom row styles for onepage site type+-.
if ( ! function_exists('essential_dynamic_css' ) ) {
  function essential_dynamic_css() {
    require_once get_template_directory() . '/assets/css/custom.css.php';
    wp_die();
  }
}
add_action( 'wp_ajax_nopriv_essential_dynamic_css', 'essential_dynamic_css' );
add_action( 'wp_ajax_essential_dynamic_css', 'essential_dynamic_css' );
