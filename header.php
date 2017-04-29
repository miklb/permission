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
  <header class="hero is-primary is-medium">
    <div class="hero-body">
      <div class="container">
        <h1 class="title"><?php bloginfo('name'); ?></h1>
        <h2 class="subtitle"><?php bloginfo('description'); ?></h2>
      </div>
    </div>
  </header>
  
