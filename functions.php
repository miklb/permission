<?php
/**
 * Permission Theme functions and definitions.
 *
 * @package Permission
 * @since Permission 1.0
 */

/**
 * Register our sidebars and widgetized areas.*
 */
function permission_widgets_init() {

	register_sidebar( array(
		'name'          => 'Main right sidebar',
		'id'            => 'main_right_1',
		'before_widget' => '<div class="box">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="subtitle">',
		'after_title'   => '</h2>',
	) );

}
	add_action( 'widgets_init', 'permission_widgets_init' );

	/**
	 * Enqueue scripts.
	 */
	function permission_scripts() {
		wp_enqueue_style( 'permission-style', get_template_directory_uri() . '/style.min.css' );
		if (
	        is_singular()
	        and get_option( 'thread_comments' )
	    )
	        wp_enqueue_script( 'comment-reply' );
}

	add_action( 'wp_enqueue_scripts', 'permission_scripts' );
