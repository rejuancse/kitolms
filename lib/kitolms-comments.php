<?php 

/**
* Returns Comments section.
*/
function kitolms_get_discussion_data() {
	static $discussion, $post_id;

	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}

	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);

	$authors = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}

	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);

	return $discussion;
}

/**
* Changes comment form default fields.
*/
function kitolms_comment_form_defaults( $defaults ) {
	$comment_field = $defaults['comment_field'];
	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );
	return $defaults;
}
add_filter( 'comment_form_defaults', 'kitolms_comment_form_defaults' );


if ( ! function_exists( 'kitolms_comment_form' ) ) :
	/**
	* Documentation for function.
	*/
	function kitolms_comment_form( $order ) {
		if ( true === $order || strtolower( $order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) { ?>

			<div class="comment-box submit-form">
				<div class="comment-form">

					<?php 
						$commenter = wp_get_current_commenter();
						$comments_args = array(
							'label_submit'         => __('Submit Now', 'kitolms'),
							'comment_form_top'     => 'bt',
							'id_form'              => 'commentform',
							'id_submit'            => 'submit',
							'class_container'      => 'comment-respond',
							'class_form'           => 'comment-form',
							'class_submit'         => 'btn theme-bg text-white',
							'name_submit'          => 'submit',
							'logged_in_as' 			=> null,
							'title_reply'  			=> null,
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
		}
	}
endif;

# Comments Author Avatar
function kitolms_get_avatar_size() {
	return 70;
}
