<?php
/**
* The template for displaying comments
*/

/*
* If the current post is protected by a password and
* the visitor has not yet entered the password we will
* return early without loading the comments.
*/

if ( post_password_required() ) {
    return;
}

$kitolms_discussion = kitolms_get_discussion_data(); 

if ($kitolms_discussion->responses > 0) {
    $comments_title = 'comments-title-wrap';
}else {
    $comments_title = 'comments-title-wrap no-responses';
}
?>
<div class="article_detail_wrapss single_article_wrap format-standard">
    <div id="comments" class="comment-area <?php echo comments_open() ? 'comments-area comments post-comment-area' : 'comments-area comments-closed'; ?>">
        <div class="all-comments">

            <?php if ( comments_open() ) { ?>
                <h3 class="comments-title"><?php echo get_comments_number(get_the_ID()); ?> Comments</h3>
            <?php } ?>

            
            <?php
                if ( have_comments() ) :

                    // Show comment form at top if showing newest comments at the top.
                    if ( comments_open() ) {
                        kitolms_comment_form( 'desc' );
                    }

                    ?>
                    
                    <div class="comment-list">
                        <ul>
                            <?php
                                wp_list_comments(
                                    array(
                                        'walker'      => new Kitolms_Comment(),
                                        'avatar_size' => kitolms_get_avatar_size(),
                                        'short_ping'  => true,
                                        'style'       => 'ul',
                                    )
                                );
                            ?>
                        </ul>
                    </div><!-- .comment-list -->


                    <?php
                    // Show comment navigation
                    if ( have_comments() ) :
                        $comments_text = __( 'Comments', 'kitolms' );
                        the_comments_navigation(
                            array(
                                'prev_text' => sprintf( '%s <span class="nav-prev-text"><span class="primary-text">%s</span> <span class="secondary-text">%s</span></span>', '<i class="fa fa-arrow-left"></i>', __( 'Previous', 'kitolms' ), __( 'Comments', 'kitolms' ) ),
                                'next_text' => sprintf( '<span class="nav-next-text"><span class="primary-text">%s</span> <span class="secondary-text">%s</span></span> %s', __( 'Next', 'kitolms' ), __( 'Comments', 'kitolms' ), '<i class="fa fa-arrow-right"></i>' ),
                            )
                        );
                    endif;

                    // Show comment form at bottom if showing newest comments at the bottom.
                    if ( comments_open() && 'asc' === strtolower( get_option( 'comment_order', 'asc' ) ) ) :
                        ?>
                        <div class="comment-box submit-form">
                            <div class="comment-form">
                                <?php $comments_args = array(
                                        'label_submit'         =>'Submit Now',
                                        'comment_form_top'     => 'bt',
                                        'id_form'              => 'commentform',
                                        'id_submit'            => 'submit',
                                        'class_container'      => 'comment-respond',
                                        'class_form'           => 'comment-form',
                                        'class_submit'         => 'btn theme-bg text-white',
                                        'name_submit'          => 'submit',
                                        'title_reply'          => __( 'Post Comment', 'kitolms' ),
                                        'title_reply_to'       => __( 'Leave a Reply to %s', 'kitolms' ),
                                        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
                                        'title_reply_after'    => '</h3>',
                                        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
                                        'submit_field'         => '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><div class="form-group">%1$s %2$s</div></div></div>',

                                        'fields' => apply_filters( 'kitolms_comment_form_default_fields', array(
                                            'author' => '<div class="row"><div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <input id="author" name="author" type="text" class="form-control" placeholder="Your Name" value="' . esc_attr( $commenter['comment_author'] ) .'">
                                                            </div>
                                                        </div>',

                                            'email' => '<div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <input id="email" name="email" type="text" class="form-control" placeholder="Your Email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                                                                '">
                                                            </div>
                                                        </div></div>',
                                        )),

                                        // redefine your own textarea (the comment body)
                                        'comment_field' => '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <textarea id="comment" name="comment" class="form-control" cols="30" rows="6" placeholder="Type your comments...." aria-required="true"></textarea>
                                                </div>
                                            </div></div>',
                                    
                                    );

                                    comment_form($comments_args);
                                ?>
                            </div>
                        </div>
                            
                        <?php
                    endif;

                    // If comments are closed and there are comments, let's leave a little note, shall we?
                    if ( ! comments_open() ) :
                        ?>
                        <p class="no-comments">
                            <?php esc_html_e( 'Comments are closed.', 'kitolms' ); ?>
                        </p>
                        <?php
                    endif;

                else :

                    // Show comment form.
                    kitolms_comment_form( true );

                endif; // if have_comments();
                ?>
        </div>
    </div><!-- #comments -->
</div>
