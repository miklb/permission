<?php
/**
 *  Sidebar Right template - main
 *
 * @package permission
 */

if ( is_active_sidebar( 'main_right_1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'main_right_1' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif;
