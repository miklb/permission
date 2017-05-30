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

	$header = array(
		'flex-width'    => true,
		'width'         => 1920,
		'flex-height'    => true,
		'height'        => 400,
		'default-image' => get_template_directory_uri() . '/assets/img/header.jpg',
	);
	add_theme_support( 'custom-header', $header );


	/**
	 * Add our Customizer content
	 */
	function permission_customize_register( $wp_customize ) {
	   // Add all your Customizer content (i.e. Panels, Sections, Settings & Controls) here...
	}

	add_action( 'customize_register', 'permission_customize_register' );


/**
 * Load Custom Comment Walker Class
 */
require get_template_directory() . '/inc/permission-comment-walker.php';
