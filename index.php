<?php
/**
 *  Index template
 *
 * @package permission
 */

get_header(); ?>
	<div class="section" id="main">
		<div class="container">
			<div class="columns">
				<div class="column is-three-quarters">
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', get_post_format() );
						endwhile;
					else :
						get_template_part( 'template-parts/content', 'index' );
					endif;
					?>
				</div><!-- end main column-->
				<div class="column">
					<?php get_sidebar(); ?>
				</div><!-- end sidebar -->
			</div><!-- end columns -->
		</div>
	</div>


<?php get_footer(); ?>
