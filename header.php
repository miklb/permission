<?php
/**
* The header for our theme.
*
* This is the template that displays all of the <head> section as well as header & nav.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package permission
*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<section class="hero is-primary is-medium">
	<!-- Hero header: will stick at the top -->
	<div class="hero-head">
		<header class="nav">
			<div class="container">
				<div class="nav-left">
					<a class="nav-item title is-2">
						<?php bloginfo( 'title' ); ?>
					</a>
				</div>
				<span class="nav-toggle">
					<span></span>
					<span></span>
					<span></span>
				</span>
				<?php
						$menu_params = array(
							'theme_location' => 'header-menu',
							'container' => 'div',
							'items_wrap' => '%3$s',
							'echo' => false,
							'depth' => 0,
							'container_class' => 'nav-right nav-menu',
						);
						echo strip_tags( wp_nav_menu( $menu_params ), '<a><div>' );
				 	?>
			</div>
		</header>
	</div>

	<!-- Hero content: will be in the middle -->
			<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />

</section>
