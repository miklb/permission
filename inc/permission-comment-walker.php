<?php
/**
 * Override core Walker_Comment for mf2 & Bulma.
 *
 * @method __construct
 */
class Permission_Walker_Comment extends Walker_Comment {
/**
		 * Start the element output.
		 *
		 * This opens the comment.  Will check if the comment has children or is a stand-alone comment.
		 *
		 * @access public
		 * @since 0.1.0
		 *
		 * @see Walker::start_el()
		 * @see wp_list_comments()
		 *
		 * @global int        $comment_depth
		 * @global WP_Comment $comment
		 *
		 * @param string $output  Passed by reference. Used to append additional content.
		 * @param object $comment Comment data object.
		 * @param int    $depth   Depth of comment in reference to parents.
		 * @param array  $args    An array of arguments.
		 */
		public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 )
		{

				$depth++;
				$GLOBALS['comment_depth'] = $depth;
				$GLOBALS['comment'] = $comment;

				if ( !empty( $args['callback'] ) ) {
						ob_start();
						call_user_func( $args['callback'], $comment, $args, $depth );
						$output .= ob_get_clean();
						return;
				}

				if ( ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args['short_ping'] ) {
						ob_start();
						$this->ping( $comment, $depth, $args );
						$output .= ob_get_clean();
				} elseif ( 'html5' === $args['format'] ) {
						ob_start();
						if ( !empty( $args['has_children'] ) ) {
								$this->start_parent_html5_comment( $comment, $depth, $args );
						} else {
								$this->html5_comment( $comment, $depth, $args );
						}
						$output .= ob_get_clean();
				} else {
						ob_start();
						$this->comment( $comment, $depth, $args );
						$output .= ob_get_clean();
				}
		}


		/**
		 * Ends the element output, if needed.
		 *
		 * This ends the comment.  Will check if the comment has children or is a stand-alone comment.
		 *
		 * @access public
		 * @since 0.1.0
		 *
		 * @see Walker::end_el()
		 * @see wp_list_comments()
		 *
		 * @param string     $output  Passed by reference. Used to append additional content.
		 * @param WP_Comment $comment The comment object. Default current comment.
		 * @param int        $depth   Depth of comment.
		 * @param array      $args    An array of arguments.
		 */
		public function end_el( &$output, $comment, $depth = 0, $args = array() )
		{
				if ( !empty( $args['end-callback'] ) ) {
						ob_start();
						call_user_func( $args['end-callback'], $comment, $args, $depth );
						$output .= ob_get_clean();
						return;
				}

				if ( !empty( $args['has_children'] ) && 'html5' === $args['format']) {
						ob_start();
						$this->end_parent_html5_comment( $comment, $depth, $args );
						$output .= ob_get_clean();
				} else {
						if ( 'div' == $args['style'] ) {
								$output .= "</div><!-- #comment-## -->\n";
						} else {
								$output .= "</li><!-- #comment-## -->\n";
						}
				}
		}


		/**
		 * Output the beginning of a parent comment in the HTML5 format.
		 *
		 * Bulma media element requires child comments to be nested within the parent media-content.
		 * The original comment walker writes the entire comment at once, this method writes the opening
		 * of a parent comment so children comments can be nested within.
		 *
		 * @access protected
		 * @since 0.1.0
		 *
		 * @see http://bulma.io/documentation/components/media-object/
		 * @see wp_list_comments()
		 *
		 * @param object $comment Comment to display.
		 * @param int    $depth   Depth of comment.
		 * @param array  $args    An array of arguments.
		 */
		protected function start_parent_html5_comment( $comment, $depth, $args )
		{
				$this->html5_comment( $comment, $depth, $args, $is_parent = true );
		}


		/**
		 * Output a comment in the HTML5 format.
		 *
		 * @access protected
		 * @since 0.1.0
		 *
		 * @see wp_list_comments()
		 *
		 * @param object  $comment   Comment to display.
		 * @param int     $depth     Depth of comment.
		 * @param array   $args      An array of arguments.
		 * @param boolean $is_parent Flag indicating whether or not this is a parent comment
		 */
		protected function html5_comment( $comment, $depth, $args, $is_parent = false )
		{

				$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

				$type = get_comment_type();

				$comment_classes = array();
				$comment_classes[] = 'media';

				// if it's a parent
				if ( $this->has_children ) {
						$comment_classes[] = 'parent';
						$comment_classes[] = 'has-children';
				}

				// if it's a child
				if ( $comment->comment_parent > 0 ) {
						$comment_classes[] = 'child';
						$comment_classes[] = 'has-parent';
						$comment_classes[] = 'parent-' . $comment->comment_parent;
				}

				$comment_classes = apply_filters( 'wp_bootstrap_comment_class', $comment_classes, $comment, $depth, $args );

				$class_str = implode(' ', $comment_classes);

?>
				<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $class_str, $comment ); ?>>

						<article id="div-comment-<?php comment_ID(); ?>" class="media">

							<?php $author_url = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_author_url', true );
			$author_img = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_avatar', true );
							?>
							<figure class="media-left">
								<p class="image is-64x64">

									<?php echo get_avatar( $comment, 65, '[default gravatar URL]', 'Author’s gravatar' ); ?>
								</p>
							</figure>
								<div class="media-content">

									<div class="content is-medium">
						<p>
							<strong><?php printf( __( '%s <span class="says">says:</span>' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) ) ); ?></strong>
							<br>
							 <?php comment_text(); ?>
							<br>
							<small>
								<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
								 <span class="comment-time">
										 <time datetime="<?php comment_time( 'c' ); ?>">
											 <?php
												 /* translators: 1: comment date, 2: comment time */
												 printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
										 ?>
										 </time>
									 </span>
									 <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
								 </a>
								 <?php comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args[ 'max_depth'], 'before' => '<span class="reply">', 'after' => '</span>' )
			 						, $comment->comment_ID
			 						, $comment->comment_post_ID
			 				); ?>
							 </small>
						</p>
						<?php if ( '0' == $comment->comment_approved ) : ?>
				 <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
					<?php endif; ?>

										<?php if ( $is_parent ) { ?>
												<div class="child-comments">
										<?php } else { ?>
										</div><!-- /.media-content -->
												</article><!-- /.media -->
										<?php } ?>

<?php
		}

		/**
		 * Output the end of a parent comment in the HTML5 format.
		 *
		 * Bulma media element requires child comments to be nested within the parent media-content.
		 * The original comment walker writes the entire comment at once, this method writes the end
		 * of a parent comment so child comments can be nested within.
		 *
		 * @see http://bulma.io/documentation/components/media-object/
		 *
		 * @access protected
		 * @since 0.1.0
		 *
		 * @see wp_list_comments()
		 *
		 * @param object $comment Comment to display.
		 * @param int    $depth   Depth of comment.
		 * @param array  $args    An array of arguments.
		 */
		protected function end_parent_html5_comment( $comment, $depth, $args )
		{
				$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
										</div><!-- /.child-comments -->
								</div><!-- /.media-body -->
						</article><!-- /.comment-body -->
				</<?php echo $tag; ?>><!-- /.parent -->

<?php
		}


		/**
		 * Output a pingback comment.
		 *
		 * @access protected
		 * @since 0.1.0
		 *
		 * @see wp_list_comments()
		 *
		 * @param WP_Comment $comment The comment object.
		 * @param int        $depth   Depth of comment.
		 * @param array      $args    An array of arguments.
		 */
		protected function ping( $comment, $depth, $args ) {

				$tag = ( 'div' == $args['style'] ) ? 'div' : 'li';

				$comment_classes = array();
				$comment_classes[] = 'media';

				$comment_classes = apply_filters( 'wp_bootstrap_comment_class', $comment_classes, $comment, $depth, $args );

				$class_str = implode(' ', $comment_classes);
?>
				<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $class_str, $comment ); ?>>
						<div class="comment-body">
								<div class="media-body">
										<?php _e( 'Pingback:' ); ?> <?php comment_author_link( $comment ); ?> <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
								</div><!-- /.media-body -->
						</div><!-- /.comment-body -->
<?php
		}


		/**
		 * Generate avatar markup
		 *
		 * @access protected
		 * @since 0.1.0
		 *
		 * @param object $comment Comment to display.
		 * @param array  $args    An array of arguments.
		 */
		protected function get_comment_author_avatar( $comment, $args )
		{
				$avatar_string = get_avatar( $comment, $args['avatar_size'] );
				$comment_author_url = get_comment_author_url( $comment );

				if ( '' !== $comment_author_url ) {
						$avatar_string = sprintf(
								'<a href="%1$s" class="author-link url" rel="external nofollow">%2$s</a>',
								esc_url($comment_author_url),
								$avatar_string
						);
				};

				return $avatar_string;
		}


		/**
		 * Displays the HTML content for reply to comment link.
		 *
		 * @access protected
		 * @since 0.1.0
		 *
		 * @param object $comment   Comment being replied to. Default current comment.
		 * @param int    $depth     Depth of comment.
		 * @param array  $args      An array of arguments for the Walker Object
		 * @param string $add_below The id of the element where the comment form will be placed
		 */
		protected function comment_reply_link( $comment, $depth, $args, $add_below = 'div-comment' )
		{
				$type = get_comment_type();

		if ( 'pingback' === $type || 'trackback' === $type ) {
				return;
		}

				comment_reply_link( array_merge( $args, array(
						'add_below' => $add_below,
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div id="reply-comment-' . $comment->comment_ID . '" class="reply">',
						'after'     => '</div>',
				) ) );
	}

}
