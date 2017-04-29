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
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

}
	add_action( 'widgets_init', 'permission_widgets_init' );
