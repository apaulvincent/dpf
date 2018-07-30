<?php
require_once('inc/Base.php');
require_once('inc/Helper.php');
require_once('inc/Content.php');

include_once('inc/walkers/walkers.php');

function wpcf7_dynamic_to_filter_example($recipient, $args=array()) {
  if (isset($args['location'])) {
    if ($args['location'] == 'Australia	') {
      $recipient = 'dbjoaquin@gmail.com';
    } elseif ($args['location'] == 'New Zealand') {
      $recipient = 'djoaquin@drumbeat.net.au';
    } elseif ($args['location'] == 'Cambodia') {
      $recipient = 'djoaquin@drumbeat.net.au';
    }
  }
  return $recipient;
} // end function wpcf7_dynamic_to_filter_example
add_filter('wpcf7-dynamic-recipient-example-filter', 'wpcf7_dynamic_to_filter_example', 10, 2);


//to fix WP's admin double login bug
setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN);
if ( SITECOOKIEPATH != COOKIEPATH ) setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN);


// Remove admin bar on site
add_filter('show_admin_bar', '__return_false');

//add excerpts to pages
add_post_type_support( 'page', 'excerpt' );

/**
 * Hide editor on specific pages.
 *
 */
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
  
  // Get the Post ID.
  if(isset($_GET['post'])){
     $posttype = get_post_type($_GET['post']);
  }elseif(isset($_GET['post_type']) ){
    $posttype = $_GET['post_type'];
  }else{
    $posttype = '';
  }

  // Hide the editor on all pages
  if($posttype == 'page' ){ //
    remove_post_type_support('page', 'editor');
  }

}

// Excerpts
function excerpt($text, $limit) {
	$excerpt = explode(' ',$text , $limit);
	if (count($excerpt)>=$limit) {
	  array_pop($excerpt);
	  $excerpt = implode(" ",$excerpt).'...';
	} else {
	  $excerpt = implode(" ",$excerpt);
	} 
	// $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
	return $excerpt;
  }



function strip_tags_content($text, $tags = '', $invert = FALSE) { 

  preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags); 
  $tags = array_unique($tags[1]); 
    
  if(is_array($tags) AND count($tags) > 0) { 
    if($invert == FALSE) { 
    return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text); 
    } 
    else { 
    return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text); 
    } 
  } 
  elseif($invert == FALSE) { 
    return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text); 
  } 
  return $text; 
  } 


// Pagination
function wp_pagination() {
  if( is_singular() )
    return;
  global $wp_query;
  /** Stop execution if there's only 1 page */
  if( $wp_query->max_num_pages <= 1 )
    return;
  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
  $max   = intval( $wp_query->max_num_pages );
  /** Add current page to the array */
  if ( $paged >= 1 )
    $links[] = $paged;
  /** Add the pages around the current page to the array */
  if ( $paged >= 3 ) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }
  if ( ( $paged + 2 ) <= $max ) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
  }
  echo '<div class="pagination"><ul>' . "\n";
  /** Previous Post Link */
  if ( get_previous_posts_link() )
    printf( '<li class="prev">%s</li>' . "\n", get_previous_posts_link('<i class="pe-7s-angle-left"></i>') );
  /** Link to first page, plus ellipses if necessary */
  if ( ! in_array( 1, $links ) ) {
    $class = 1 == $paged ? ' class="active"' : '';
    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
    if ( ! in_array( 2, $links ) )
      echo '<li class="ellip">…</li>';
  }
  /** Link to current page, plus 2 pages in either direction if necessary */
  sort( $links );
  foreach ( (array) $links as $link ) {
    $class = $paged == $link ? ' class="active"' : '';
    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
  }
  /** Link to last page, plus ellipses if necessary */
  if ( ! in_array( $max, $links ) ) {
    if ( ! in_array( $max - 1, $links ) )
      echo '<li class="ellip">…</li>' . "\n";
    $class = $paged == $max ? ' class="active"' : '';
    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
  }
  /** Next Post Link */
  if ( get_next_posts_link() )
    printf( '<li class="next">%s</li>' . "\n", get_next_posts_link('<i class="pe-7s-angle-right"></i>') );
  echo '</ul></div>' . "\n";
}