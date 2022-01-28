<?php
class Kitolms_Comment extends Walker_Comment {
	protected function html5_comment( $comment, $depth, $args ) {

		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li'; ?>

		<<?php echo esc_attr($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent article_comments_wrap' : '', $comment ); ?>>
			
			<article id="div-comment-<?php comment_ID(); ?>">
				<div class="article_comments_thumb">
					<?php
						$comment_author_link = get_comment_author_link( $comment );
						$comment_author_url  = get_comment_author_url( $comment );
						$comment_author      = get_comment_author( $comment );
						$avatar              = get_avatar( $comment, $args['avatar_size'] );
						if ( 0 != $args['avatar_size'] ) {
							if ( empty( $comment_author_url ) ) {
								echo wp_kses_post($avatar);
							} else {
								printf( '<a href="%s" rel="external nofollow" class="url skip-link">', esc_url($comment_author_url) );
								echo wp_kses_post($avatar);
							}
						}
						
						if ( ! empty( $comment_author_url ) ) {
							echo '</a>';
						}
					?>
				</div>

				<div class="comment-details">
					<div class="comment-meta">
						<div class="comment-left-meta">
							<?php 
								printf(
									/* translators: %s: comment author link */
									'<h4 class="author-name">' . get_comment_author_link( $comment ) . '<span class="selected"><i class="fas fa-bookmark"></i></span></h4>'
								);
							?>	
							<div class="comment-date">
								<?php
									/* translators: 1: comment date, 2: comment time */
									$comment_timestamp = sprintf( __( '%1$s at %2$s', 'kitolms' ), get_comment_date( '', $comment ), get_comment_time() );
								?>
								<time datetime="<?php comment_time( 'c' ); ?>" title="<?php echo esc_attr( $comment_timestamp ); ?>">
									<?php echo esc_attr( $comment_timestamp ); ?>
								</time>
							</div>
						</div>

						<div class="comment-reply">
							<?php
								comment_reply_link(
									array_merge(
										$args,
										array(
											'add_below' => 'div-comment',
											'depth'     => $depth,
											'max_depth' => $args['max_depth'],
											'before'    => '<div class="reply"><span class="icona"><i class="ti-back-left"></i></span>',
											'after'     => '</div>',
										)
									)
								);
							?>
							<div class="reply"><?php edit_comment_link( __( 'Edit', 'kitolms' ), ' <span class="edit-link"></span>' ); ?></div>
						</div>
					</div>

					<div class="comment-text">
						<p><?php comment_text(); ?></p>
					</div>
				</div>
			</article>	
		<?php
	}
}
