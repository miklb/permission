<?php
/**
 *  Home page template
 *
 * @package independence
 */

get_header(); ?>
	<div class="section" id="main">
		<div class="container">
			<div class="columns">
				<div class="column is-three-quarters">
					<p>Main section</p>
				</div><!-- end main column-->
				<div class="column">
					<?php get_sidebar(); ?>
				</div><!-- end sidebar -->
			</div><!-- end columns -->
		</div>
	</div>


<?php get_footer(); ?>
