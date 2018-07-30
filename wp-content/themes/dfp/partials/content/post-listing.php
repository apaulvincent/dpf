<?php

global $DB_Content, $DB_Helper;

/*
$column
	- pages: array of post objects
	- display_columns: 1,2,3,4

	use display_columns to set the layout of the page links
*/


$markup = '';

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
if( !isset($order_by) ) $order_by = 'post_date';
if( !isset($order) ) $order = 'ASC';
$args = array(
  'paged'             => $paged,
  'post_type'      => $select_post_type,
  'posts_per_page' => 15,
  'orderby'         => $order_by,
    'order'             => $order,

);

$paging_markup = '';

$wp_query  = new WP_Query( $args );

if ( $wp_query->have_posts() ) :
  
  if( $wp_query->max_num_pages <= 1 ):
    
  else:
  ob_start();
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

    $paging_markup .= ob_get_contents();
  ob_end_clean();
  endif;


  $markup .=  '<div class="paging-wrap">'.$paging_markup.'</div>';
  
  $markup .=  '<div class="section-listing">';
  $markup .=  '<div class="row">';

  while ( $wp_query->have_posts() ) : $wp_query->the_post();
  
  
  $banner_image_id = get_field( 'banner_image', get_the_ID() );
  $banner_image_portrait = wp_get_attachment_image_src($banner_image_id,'landscape_sm');


  $content = get_the_excerpt();
  $content = strip_tags_content($content);

  $markup .=  '<div class="col-lg-4">';
  $markup .=  '<div class="card">';
        $markup .=  '<a href="'.get_permalink().'" class="card-image" style="background-image: url('.$banner_image_portrait[0].')">';
        $markup .=  '</a>';
        $markup .=  '<div class="card-body">';
        $markup .=  '<h4>'.get_the_title().'</h4>';
        
        if( $select_post_type == 'insight' ):
            $markup .=  '<span class="date">'. date_format(date_create(get_the_date()), 'd.m.y').'</span>';
        endif;

        $markup .=  '<p>'.excerpt($content, 20).'</p>';
        $markup .=  '<a href="'.get_permalink().'" class="btn btn-4 btn-box-icon icon-arrow">Read more</a>';
        $markup .=  '</div>';
  $markup .=  '</div>';
  $markup .=  '</div>';

  endwhile;

  $markup .=  '</div>';
  $markup .=  '</div>';

  $markup .=  '<div class="paging-wrap bottom">'.$paging_markup.'</div>';

  wp_reset_postdata();
  
endif; 


echo  $markup;