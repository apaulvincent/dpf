<?php

include_once('inc/Base.php');
include_once('inc/Content.php');
include_once('inc/Helper.php');

include_once('inc/walkers/walkers.php');

// Remove admin bar on site
add_filter('show_admin_bar', '__return_false');

// *********************** Post Thumbnails
add_theme_support( 'post-thumbnails' );

add_image_size( 'banner-image', 1400, 500, true );
add_image_size( 'feat-banner-image', 760, 999999, false );

add_image_size( 'listing-image', 560, 560, true );
add_image_size( 'single-image', 560, 360, true );

add_image_size( 'thumb-sm', 360, 360, true );
add_image_size( 'thumb-md', 400, 400, true );
add_image_size( 'thumb-lg', 600, 600, true );
// add_image_size( 'news-thumb', 790, 99999, false ); // false -> resize no crop


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

// Sidebar main content
function sidebar_content( $atts) {

  global $DB_Content;

  extract(shortcode_atts(array(
    'ids' => '14502|14504',
  ), $atts));

  $ids_arr = explode('|', $ids);

  $args = array( 
      'post_type'         => 'reusable-block',
      'post__in'          => $ids_arr, 
      'orderby'           => array( 'post__in' )
  );

  $query = new WP_Query($args);

  if ( $query->have_posts() ) :
  
      while ( $query->have_posts() ) : $query->the_post();

          $block = get_fields($post->ID);

          echo $DB_Content->pass_file_to_var('partials/content/'. $block['reusable_block_setup'] .'.php', $block);
  
      endwhile;
  
  endif;
  
  // Restore original post data.
  wp_reset_postdata();

}

add_shortcode( 'sidebar_content', 'sidebar_content' );



function dfp_sf_form(){

  global $DB_Content;

  $var = array();

  return $DB_Content->pass_file_to_var('partials/content/dfp-sf-form.php', $var);

}
add_shortcode('dfp_sf_form', 'dfp_sf_form');









// Category listing
function dfp_list_categories( $atts ) {

    $html = "";

    $html .= "<ul class='category-list'>";
    // Get the ID of a given category
    $category_id = get_cat_ID( 'Solutions' );
    $cat_name =  get_cat_name( $category_id );

    // Get the URL of this category
    $category_link = get_category_link( $category_id );

    $html .= "<li><a href='".esc_url( $category_link )."' >" . $cat_name . "</a></li>";

    // Get the ID of a given category
    $category_id = get_cat_ID( 'Developer Advice' );
    $cat_name =  get_cat_name( $category_id );

    // Get the URL of this category
    $category_link = get_category_link( $category_id );

    $html .= "<li><a href='".esc_url( $category_link )."' >" . $cat_name . "</a></li>";

    // Get the ID of a given category
    $category_id = get_cat_ID( 'Strategy' );
    $cat_name =  get_cat_name( $category_id );

    // Get the URL of this category
    $category_link = get_category_link( $category_id );

    $html .= "<li><a href='".esc_url( $category_link )."' >" . $cat_name . "</a></li>";

    $html .= "</ul>";


    return $html;
}

add_shortcode( 'dfp_list_categories', 'dfp_list_categories' );


// Featured article shortcode
function dfp_featured_list( $atts ) {

    $html = "";

    $args = array(
        'post_type' => 'post',
        'order' => 'ASC',
        'orderby' => 'rand',
        'tag' => 'featured',
        'posts_per_page' => 5
      );

    $query = new WP_Query( $args );


    if( $query->have_posts() ):

      $html .= "<ul>";

      while ( $query->have_posts() ):
        $query->the_post();

        $html .= "<li><a href='".get_permalink()."' >".get_the_title()."</a></li>";

      endwhile;

      $html .= "</ul>";

    else:

      $html .= "<p class='no-featured'>Sorry, no featured article found.</p>";

    endif;

    return $html;
}

add_shortcode( 'dfp_featured_list', 'dfp_featured_list' );


// Add Widget Area
function widgets_init() {

  register_sidebar( array(
      'name'          => __( 'Sidebar Widgets', 'dfp' ),
      'id'            => 'sidebar-widget',
      'description'   => __( '', 'dfp' ),
      'before_widget' => '<section id="%1$s" class="standard-content-block widget-block %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>',
  ));

}

add_action( 'widgets_init', 'widgets_init' );




//Register tag cloud filter callback
function tag_widget_limit($args){

  if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
    $args['number'] = 16; //Limit number of tags
  }

 return $args;
}

add_filter('widget_tag_cloud_args', 'tag_widget_limit');












//to fix WP's admin double login bug
setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN);
if ( SITECOOKIEPATH != COOKIEPATH ) setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN);

