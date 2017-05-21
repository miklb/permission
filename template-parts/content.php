<?php
/**
 * Main content file
 *
 * @package permission
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>>
	<div class="columns">
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="column is-10 is-offset-1">
		<figure class="led-image image">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail( '' );
} ?>
		</figure>
		</div>
	</div>
	<div class="columns">
	<?php } ?>
		<header class="column is-one-quarter entry-header">
			<a class="u-url" href="<?php the_permalink(); ?>" rel="bookmark"><h2 class="title is-1"><?php the_title(); ?></h2></a>
			<h4>Posted on: <time class="dt-published" datetime="<?php echo esc_attr( get_the_date( DATE_ATOM ) ); ?>"><?php echo get_the_date( '' ); ?></time></h4>

		</header><!-- .entry-header -->
		<div class="column content is-medium content-wrapper">
			<?php the_content(); ?>

		<footer class="entry-footer">
		</footer><!-- .entry-footer -->
		</div><!-- .content-wrapper -->
	</div>
</article><!-- #post-## -->
