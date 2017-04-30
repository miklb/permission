<?php
/**
 * Main content file for sticky posts.
 *
 * @package permission
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('message is-info'); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<figure class="led-image image">

		</figure>
	<?php } ?>

	<header class="entry-header message-header">
		<?php the_title(); ?>
	</header><!-- .entry-header -->
		<div class="content is-medium content-wrapper message-body">

		<?php the_content(); ?>

	</div><!-- .content-wrapper -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
