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
					<a class="nav-item">
						<?php bloginfo( 'title' ); ?>
					</a>
				</div>
				<span class="nav-toggle">
					<span></span>
					<span></span>
					<span></span>
				</span>
				<div class="nav-right nav-menu">
					<a class="nav-item is-active">
						Home
					</a>
					<a class="nav-item">
						Examples
					</a>
					<a class="nav-item">
						Documentation
					</a>
					<span class="nav-item">
						<a class="button is-primary is-inverted">
							<span class="icon">
								<i class="fa fa-github"></i>
							</span>
							<span>Download</span>
						</a>
					</span>
				</div>
			</div>
		</header>
	</div>

	<!-- Hero content: will be in the middle -->
			<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />

</section>
