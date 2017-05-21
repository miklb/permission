<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package independence
 */

if ( !empty ( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) {
	 return;
}
	// Get the global `$wp_query` object.
$id = get_the_ID();
	// Get the semantic_linkbacks_type 'like'.
$comments = get_linkbacks( 'like', $id );
?>
<section class="section">
<div class="container">
	<h3 class="subtitle">Responding with a post on your own blog? Send me a <a href="http://indieweb.org/webmention">Webmention</a> by writing something on your website that links to this post and then enter your post URL below.</h3>
	<form method="post" id="webmention-form" action="<?php echo get_webmention_endpoint(); ?>">
	 <input id="webmention-target" type="hidden" name="target" value="<?php the_permalink(); ?>" />
	 <p class="control has-addons ">
	<input class="input is-fullwidth" name="source" type="url" placeholder="<?php _e( 'URL/Permalink of your article', 'webmention' ); ?>">
	<button class="button is-info" type="submit">
	Notify Me
	</button>
	</p>
	</form>
<ul class="pile likes">
<li class="icon">
	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100.01" enable-background="new 0 0 100 100.01" xml:space="preserve"><g><path d="M68.422,12.527c1.141,0,2.342,0.058,3.639,0.187c7.86,0.763,16.963,7.97,18.068,21.771v4.59   c-1.031,13.214-11.003,29.501-40.148,49.939c-29.14-20.438-39.11-36.727-40.137-49.939v-4.59   c1.105-13.801,10.202-21.008,18.069-21.771c1.291-0.129,2.504-0.187,3.638-0.187c9.085,0,13.444,3.926,18.43,9.875   C54.973,16.453,59.337,12.527,68.422,12.527"></path></g></svg>
</li>

<?php
// Comment Loop.
if ( $comments ) {
	foreach ( $comments as $comment ) {
		?>
		<li>
			<?php $author_url = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_author_url', true ); ?>
			<!-- TODO: get author name as alt for image -->
			<a href="<?php echo $author_url ?>">
			<?php $author_img = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_avatar', true ); ?>
			<figure class="image is-64x64">
				<img src="<?php echo $author_img ?>" alt="<?php echo $comment->comment_author; ?>">
			</figure>
			</a>
		</li>
<?php
	}
} else {
	echo '<li>No likes.</li>';
}
?>
</ul>


<?php
	// get the semantic_linkbacks_type 'repost'.
	$comments = get_linkbacks( 'repost', $id );
?>

<ul class="pile reposts">
<li class="icon">
	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100.01" enable-background="new 0 0 100 100.01" xml:space="preserve"><g><path d="M50.606,64.447H30.435V50.634h11.05c0.57,0,1.093-0.309,1.354-0.8c0.273-0.499,0.229-1.089-0.1-1.545L26.415,25.445   c-0.281-0.403-0.753-0.643-1.252-0.643c-0.503,0-0.97,0.238-1.259,0.643L7.583,48.289C7.4,48.543,7.306,48.84,7.306,49.137   c0,0.238,0.06,0.477,0.174,0.697c0.266,0.491,0.789,0.801,1.355,0.801h11.057v19.081c0,2.914,2.361,5.274,5.271,5.274h25.442   c2.911,0,5.271-2.36,5.271-5.274C55.877,66.809,53.518,64.447,50.606,64.447z"></path><path d="M48.804,37.672h20.17v13.239h-11.05c-0.569,0-1.093,0.31-1.354,0.8c-0.272,0.499-0.229,1.086,0.101,1.545L72.995,76.1   c0.28,0.4,0.753,0.639,1.252,0.639c0.503,0,0.972-0.237,1.26-0.639l16.32-22.844c0.183-0.258,0.276-0.555,0.276-0.852   c0-0.233-0.06-0.471-0.174-0.693c-0.266-0.49-0.787-0.8-1.354-0.8H79.518V32.4c0-2.912-2.359-5.271-5.271-5.271H48.805   c-2.91,0-5.271,2.359-5.271,5.271C43.534,35.311,45.894,37.672,48.804,37.672z"></path></g></svg>
</li>

<?php
// Comment Loop.
if ( $comments ) {
	foreach ( $comments as $comment ) {
		?>
		<li>
			<?php $author_url = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_author_url', true ); ?>

			<a href="<?php echo $author_url ?>">
			<?php $author_img = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_avatar', true ); ?>
			<figure class="image is-64x64">
				<img src="<?php echo $author_img ?>" alt="<?php echo $comment->comment_author; ?>">
			</figure>
			</li>
			</a>
<?php
	}
} else {
	echo '<li>No Reposts.</li>';
}
?>
</ul>
</div>
</section>
<section class="section">
	<div class="container">
		<?php
			$id = get_the_ID();

			$comments = get_comments(array(
					'post_id' => $id,
					'status' => 'approve',
					'type__not_in' => 'webmention',
				) );
				wp_list_comments(array(
					'per_page' => 10,
					'style' => 'div',
					'reverse_top_level' => true,
					'walker' => new independence_walker_comment,
				), $comments)
		?>
	</div>
</section>
<section class="section">
	<div class="container">
<?php
$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
$comment_args = array(
	'title_reply'  => 'Got Something To Say?',
	'title_reply_before'   => '<h3 class="subtitle">',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="field"><div class="field-label is-medium">
	<label class="label">Name</label></div>
	<p class="control">
		<input id="author" name="author" class="input is-medium" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		'" placeholder="Your name here">
	</p>
</div>',
		'email'  => '<div class="field">
	<label class="label">Email</label>
	<p class="control">
	<input id="email" name ="email" class="input is-medium" type="email" placeholder="hello@example.com" value="' . esc_attr( $commenter['comment_author_email'] ) .
		'">
	</p>
</div>',
		'url'    => '<div class="field">
	<label class="label">Url</label>
	<p class="control">
		<input id="url" name="url" class="input is-medium" type="url" placeholder="https://example.com">
	</p>
</div>',
	) ),
	'comment_field' => '<div class="field">
	<label class="label">Message</label>
	<p class="control">
		<textarea id="comment" name="comment" class="textarea" placeholder="Your thoughts…" required></textarea>
	</p>
</div>',
		'class_submit' => 'button is-primary',
);

comment_form( $comment_args );
?>
	</div>
</section>
	</div>
</section>
