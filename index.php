<?php
/**
 *  Index template
 *
 * @package permission
 */

get_header(); ?>
	<div class="section" id="main">
		<div class="container">
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							if ( is_sticky() ) {
								get_template_part( 'template-parts/content', 'sticky' );
							} else {
								get_template_part( 'template-parts/content', get_post_format() );
							}
						endwhile;
						permission_bulma_pagination();
					else :
							get_template_part( 'template-parts/content', 'none' );
					endif;
					?>
		</div><!-- end .container -->
	</div><!-- end .main -->


<?php get_footer(); ?>
