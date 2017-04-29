<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
		<figure class="led-image image">
			
		</figure>
	<? } ?>

	<header class="entry-header">
		<?php the_title(); ?>
	</header><!-- .entry-header -->
	<div class="content is-medium content-wrapper">
		<?php the_content(); ?>

	</div><!-- .content-wrapper -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
