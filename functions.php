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
					&& get_option( 'thread_comments' )
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
	 * Register the top main nav
	 *
	 * @method register_permission_menus
	 */
	function register_permission_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu' ),
				'extra-menu' => __( 'Extra Menu' ),
			)
		);
	}
	add_action( 'init', 'register_permission_menus' );

	/**
	 * Set active class for navigation.
	 *
	 * @method permission_active_nav_class
	 * @param  string $classes navigation classes.
	 * @param  string $item item.
	 * @return string $classes classes.
	 */
	function permission_active_nav_class( $classes, $item ) {
		if ( in_array( 'current-menu-item', $classes ) ) {
				$classes[] = 'is-active ';
		}
		return $classes;
	}

	add_filter( 'nav_menu_css_class' , 'permission_active_nav_class' , 10 , 2 );

	/**
	 * [permission_nav_link_class description]
	 *
	 * @method permission_nav_link_class
	 * @param string $atts attributes.
	 * @param string $item item.
	 * @param string $args arguments.
	 * @return $atts
	 */
	function permission_nav_link_class( $atts, $item, $args ) {
		$atts['class'] = 'nav-item';
		return $atts;
	}

	add_filter( 'nav_menu_link_attributes', 'permission_nav_link_class', 10, 3 );

	/**
 * Load Custom Comment Walker Class
 */
	require get_template_directory() . '/inc/permission-comment-walker.php';

	/**
	 * Load template tag functions
	 */
	 require get_template_directory() . '/inc/template-tags.php';
