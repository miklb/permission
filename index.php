<?php
/**
 *  Home page template
 *
 * @package independence
 */

get_header(); ?>
  <div class="columns">
    <div class="column is-three-quarters">
      <p>Main column</p>
    </div><!-- end main column-->
    <div class="column">
      <?php get_sidebar(); ?>
    </div><!-- end sidebar -->
  </div><!-- end columns -->
<?php get_footer(); ?>
