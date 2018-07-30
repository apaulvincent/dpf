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



function select_company_contacts( $atts) {

  extract(shortcode_atts(array(
    'id' => 0,
  ), $atts));

	$contacts = get_field('contacts', 'option');
  $markup = '';
  $select_markup = '';

  
  if ($contacts):

      $select_markup .= '<select name="contacts">' ;

      foreach ($contacts as $key => $contact) {

        $hidden = $key != 0 ? 'style="display: none;"' : '';

        if( $contact['name'] != '' && $contact['email'] != '' ):

            $select_markup .= '<option value="'.$key.'">';
            $select_markup .= $contact['name'].', '.$contact['position'];
            $select_markup .= '</option>';

            $markup .= '<ul data-contact-select="'.$key.'" '.$hidden.'>';
            $markup .= '<li><i class="fas fa-user-alt"></i>'.$contact['name'];
            $markup .=  $contact['position'] != '' ? '<br>' . $contact['position'] : '';
            $markup .= '</li>';

            $markup .= '<li><i class="fas fa-paper-plane"></i><a href="mailto:'.$contact['email'].'">'.$contact['email'].'</a></li>';
            $markup .= $contact['phone'] != '' ? '<li><i class="fas fa-phone"></i><a href="tel:'.$contact['phone'].'">'.$contact['phone'].'</a></li>' : '';
            $markup .= '</ul>';

        endif;
      }
       
        $select_markup .= '</select>' ;

  endif;

return   '<div class="contact-select">' .$select_markup . $markup . '</div>';

}
add_shortcode( 'select_company_contacts', 'select_company_contacts' );



function find_by_product_type( $atts) {

  extract(shortcode_atts(array(
    'id' => 0,
  ), $atts));

  $markup = '';

  $taxonomy = 'product-cat';
  $terms = get_terms($taxonomy);

  if ( $terms && !is_wp_error( $terms ) ) :

    $markup .= '<div class="collapsible-block">';
    $markup .= '<h4 class="component-name">
                <span class="d-none d-lg-block">Find by Product Type</span>
                <button class="d-lg-none collapsible-toggle">Find by Product Type <i class="fas fa-chevron-down"></i></button>
                </h4>';

                $markup .= '<div class="component-inner">';
                $markup .= '<div class="row no-gutters grid-links">';
                    foreach ( $terms as $term ) {
                      $markup .= '<div class="col-12 col-lg-4">';
                      $markup .= '<a href="'. get_term_link($term->slug, $taxonomy).'" class="btn btn-3 btn-full">'.$term->name.'</a>';
                      $markup .= '</div>';
                    }
                $markup .= '</div>';
               $markup .= '</div>';

    $markup .= '</div>';

endif;

return  $markup;
}

add_shortcode( 'find_by_product_type', 'find_by_product_type' );



function find_by_crop( $atts) {

  extract(shortcode_atts(array(
    'id' => 0,
  ), $atts));

$args = array( 
    'post_type'         => 'page',
    'orderby'         => 'title',
    'order'             => 'ASC',
    'posts_per_page' => -1,
    'post_status' => 'publish'

);

  $args['tax_query']= array(
        array(
          'taxonomy' => 'page-cat',
          'field' => 'slug',
          'terms' => array('crop'),
    )
      );

$query = new WP_Query($args);

  $markup = '';

    $markup .= '<div class="collapsible-block">';
    $markup .= '<div class="crop-select-wrap">';
    $markup .= '<div class="tbl">';

            $markup .= '<div class="tbl-cell cell-left">';
            $markup .= '<h4 class="component-name">
                        <span class="d-none d-lg-block">Find by Crop</span>
                        <button class="d-lg-none collapsible-toggle">Find by Crop <i class="fas fa-chevron-down"></i></button>
                        </h4>';
            $markup .= '</div>';
            
            $markup .= '<div class="tbl-cell">';
            $markup .= '<div class="component-inner">';
            $markup .= '<div class="form-group">';
            $markup .= '<select name="page-select" class="page-select">
                            <option value="">Select crop</option>';
// Check that we have query results.
if ( $query->have_posts() ) :
 
    // Start looping over the query results.
    while ( $query->have_posts() ) :
 
        $query->the_post();

        $markup .= '<option value="'.get_the_permalink().'">'.get_the_title().'</option>';
 
    endwhile;
 
endif;
 
// Restore original post data.
wp_reset_postdata();
             $markup .= '           </select>';
            $markup .= '</div>';
            $markup .= '</div>';
            $markup .= '</div>';

  $markup .= '</div>';
  $markup .= '</div>';
  $markup .= '</div>';

return  $markup;

}
add_shortcode( 'find_by_crop', 'find_by_crop' );


function download_select( $atts) {

  extract(shortcode_atts(array(
    'id' => 0,
    'taxonomy' => '',
    'select_title' => 'Select'

  ), $atts));


$args = array( 
    'post_type'         => 'download',
    'orderby'         => 'title',
    'order'             => 'ASC',
    'posts_per_page' => -1,
    'post_status' => 'publish'

);
if(isset($taxonomy) && !empty($taxonomy)):
  $args['tax_query']= array(
        array(
          'taxonomy' => 'category',
          'field' => 'slug',
          'terms' => array($taxonomy),
    )
      );
    endif;

$query = new WP_Query($args);
//var_dump($query);exit;

    $markup = '';

    $markup .= '<div class="row no-gutters download-select-container">';

    $markup .= '<div class="col-12">';
                    $markup .= '<div class="form-group">';
                    $markup .= '<select name="download-select" class="download-select">
                                  <option value="">-- '.$select_title.' --</option>';
// Check that we have query results.
if ( $query->have_posts() ) :
 
    // Start looping over the query results.
    while ( $query->have_posts() ) :
 
        $query->the_post();
        $file = get_field('file', get_the_ID());

        $markup .= '<option value="'.$file.'">'.get_the_title().'</option>';
 
    endwhile;
 
endif;
 
// Restore original post data.
wp_reset_postdata();
                                  
  $markup .= '                              </select>';
                  $markup .= '</div>';
  $markup .= '</div>';

  $markup .= '<div class="col-6 d-none d-lg-block">';
  $markup .= '<a href="#" download class="btn btn-full btn-2 download-link">Download</a>';
  $markup .= '</div>';

  $markup .= '<div class="col-6 d-none d-lg-block">';
  $markup .= '<a href="#" target="_blank" class="btn btn-full btn-1 download-link">View online</a>';
  $markup .= '</div>';


  $markup .= '</div>';



return  $markup;

}
add_shortcode( 'download_select', 'download_select' );


function product_select( $atts) {
  extract(shortcode_atts(array(
    'taxonomy' => '',
  ), $atts));
  
  $args = array( 
    'post_type'         => 'product',
    'orderby'         => 'title',
    'order'             => 'ASC',
    'posts_per_page' => -1,
    'post_status' => 'publish'

);
  if(isset($taxonomy) && !empty($taxonomy)):
  $args['tax_query']= array(
        array(
          'taxonomy' => 'product-cat',
          'field' => 'slug',
          'terms' => array($taxonomy),
    )
      );
    endif;

$query = new WP_Query($args);

      $markup = '';

      $markup .= '<div class="row no-gutters download-select-container">';

      $markup .= '<div class="col-12">';
                      $markup .= '<div class="form-group">';
                      $markup .= '<select name="download-select" class="download-select">
                                    <option value="">Select product</option>';
// Check that we have query results.
if ( $query->have_posts() ) :
 
    // Start looping over the query results.
    while ( $query->have_posts() ) :
 
        $query->the_post();
        $file = get_field('file', get_the_ID());

        $markup .= '<option value="'.get_the_permalink().'">'.get_the_title().'</option>';
 
    endwhile;
 
endif;
// Restore original post data.
wp_reset_postdata();
                      $markup .=            '</select>';
                    $markup .= '</div>';
      $markup .= '</div>';

     // $markup .= '<div class="col-6 d-none d-lg-block">';
     // $markup .= '<a href="#" download class="btn btn-full btn-2 download-link">Download</a>';
     // $markup .= '</div>';

      $markup .= '<div class="col-12 d-none d-lg-block">';
      $markup .= '<a href="#" class="btn btn-full btn-1 download-link">View online</a>';
      $markup .= '</div>';
      $markup .= '</div>';

return  $markup;

}
add_shortcode( 'product_select', 'product_select' );


//manage search function to include custom fields

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );