<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package permission
 */

 /**
 * Wraps the_excerpt in p-summary
 *
 */

function permission_the_excerpt( $content ) {
	if ( permission_template_type()=='article' ) {
       // TODO: Customize excerpt markup for this theme. Too generic of markup.
			 $wrap = '<div class="entry-summary p-summary" itemprop="description">';
	}
				else {
			 $wrap = '<div class="entry-summary p-summary p-name" itemprop="description">';
		}
		if ($content!="") {
			 return $wrap . $content . '</div>';
		}
	 return $content;
 }
 add_filter( 'the_excerpt', 'permission_the_excerpt', 1 );

 /**
* Wraps the_content in e-content
*
*/
function permission_the_content( $content ) {
  // TODO: Customize article content for this theme. Too generic of markup.
	 if ((permission_template_type()=='article')||(is_page())) {
			$wrap = '<div class="entry-content e-content"><p>';
	 }
	 else {
			$wrap = '<div class="entry-content e-content p-name"><p>';
	 }
	 if ($content!="") {
			return $wrap . $content . "\n" . '</div>' . '<!-- .entry-content -->';
	 }
	return $content;
}
add_filter( 'the_content', 'permission_the_content', 1 );


if ( ! function_exists( 'permission_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
	function permission_posted_on() {
		$time_string = '<time class="entry-date dt-published dt-updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
      // TODO: tweak time check to only show updated if different day. +bug
			$time_string = '<time class="entry-date dt-published" datetime="%1$s">%2$s</time><time class="dt-updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_ATOM ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_ATOM ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'permission' ),
			'<a class="u-url" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'permission' ),
			'<span class="author p-author h-card vcard"><a class="url u-url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'permission_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function permission_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'permission' ) );
			if ( $categories_list && permission_categorized_blog() ) {
				printf( '<p class="content is-medium"><span class="cat-links">' . esc_html__( 'Posted in %1$s', 'permission' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '<span class="tag is-light is-medium">',', ','</span>' );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( ' Tagged %1$s', 'permission' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'permission' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( ' Edit %s', 'permission' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span></p>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function permission_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'permission_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'permission_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so permission_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so permission_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in permission_categorized_blog.
 */
function permission_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'permission_categories' );
}
add_action( 'edit_category', 'permission_category_transient_flusher' );
add_action( 'save_post',     'permission_category_transient_flusher' );
