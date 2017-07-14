<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package permission
 */


/**
 * Custom Pagination for use with Bulma
 * @see http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
 * @method permission_bulma_pagination
 * @param  string                        $pages [description]
 * @param  integer                       $range [description]
 * @return [type]                               [description]
 */
function permission_bulma_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<nav class='pagination is-centered'>";
         if($paged > 1 && $showitems < $pages) echo "<a class='pagination-previous' rel='previous' href='".get_pagenum_link($paged - 1)."'>Previous</a>";
         echo "<ul class='pagination-list'>\n";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='pagination-link' rel='next' href='".get_pagenum_link(1)."'>1</a></li>";
         if($paged > 4) {
           echo "<li><span class='pagination-ellipsis'>&hellip;</span></li>";
         }
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class='pagination-link is-current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='pagination-link' >".$i."</a></li>";
             }
         }
         echo "<li><span class='pagination-ellipsis'>&hellip;</span></li>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li> <a class='pagination-link' href='".get_pagenum_link($pages)."'>$pages</a></li>";
         echo "</ul>\n";
         if ($paged < $pages && $showitems < $pages) echo "<a class='pagination-next' href='".get_pagenum_link($paged + 1)."'>Next Page</a>";

         echo "</nav>\n";
     }
}
