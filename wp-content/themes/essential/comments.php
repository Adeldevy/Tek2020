<?php

/**
 * Essential Comment Form
 *
 * @package essential
 */

if ( post_password_required() ) { return; } ?>

<h3 class="title">
 <?php esc_html_e( 'Comments', 'essential' ); ?>
</h3>
<ul class="comments-block">
 <?php wp_list_comments( array( 'callback' => 'essential_comment' ) ); ?>
</ul>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
 <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
   <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'essential' ); ?></h1>
   <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'essential' ) ); ?></div>
   <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'essential' ) ); ?></div>
 </nav>
<?php endif; ?>

<?php

$comments_args = array(
 'id_form' => 'comment-form',
   'fields'               => array(
       'author'            => '<div class="form-group name"><input id="name" type="text" name="name"  placeholder="'. esc_attr__( 'Name', 'essential') .'" required /></div>',
       'email'             => '<div class="form-group email"><input name="email" id="email" type="email" placeholder="'. esc_attr__( 'Email', 'essential') .'" required /></div>',
   ),
   'comment_field' => '<textarea cols="30"  name="comment" rows="10" placeholder="' . esc_attr__( 'Comment', 'essential') . '" required=""></textarea>',
   'must_log_in' => '',
   'logged_in_as' => '',
   'title_reply' => '',
   'title_reply_to' => esc_html__('Leave a Reply to %s', 'essential' ),
   'cancel_reply_link' => esc_html__('Cancel', 'essential' ),
   'label_submit' => esc_html__('send comment', 'essential' ),
   'submit_field'  => '%1$s %2$s',
);

comment_form($comments_args);

?>
