<?php





// In your template files like footer.php

// The items_wrap value ('%3$s') removes the wrapping <ul>, while the custom walker (Nav_Footer_Walker) removes the <li>'s.

// wp_nav_menu(array('items_wrap'=> '%3$s', 'walker' => new Nav_Footer_Walker(), 'container'=>false, 'menu_class' => '', 'theme_location'=>'footer', 'fallback_cb'=>false ));





class Nav_Min_Walker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat("\t", $depth);

		$output .= "\n$indent\n";

	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat("\t", $depth);

		$output .= "$indent\n";

	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );

		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';

		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';

		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;

		$item_output .= '<a'. $attributes .'>';

		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

		$item_output .= '</a>';

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {

		$output .= "\n";

	}

}









class Custom_Foundation_Nav_Menu extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {

	   $indent = str_repeat("\t", $depth);

 

	   // add the dropdown CSS class

	   $output .= "\n$indent<ul class=\"sub-menu\">\n";

	}



	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

 

	   // add 'not-click' class to the list item

	   $element->classes[] = 'not-click';

 

	   // if element is current or is an ancestor of the current element, add 'active' class to the list item

	   $element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';

 

	   // if it is a root element and the menu is not flat, add 'has-dropdown' class 

	   // from https://core.trac.wordpress.org/browser/trunk/src/wp-includes/class-wp-walker.php#L140

	   $element->has_children = ! empty( $children_elements[ $element->ID ] );

	   $element->classes[] = ( $element->has_children && 1 !== $max_depth ) ? 'has-dropdown' : '';

 

	   // call parent method

	   parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

	}

 }



















 /**

 * Custom walker class.

 */

class Linfox_Walker_Main_Menu extends Walker_Nav_Menu {





    function start_lvl( &$output, $depth = 0, $args = array() ) {

        // Depth-dependent classes.

        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent

		$display_depth = ( $depth + 1); // because it counts the first submenu as 0

        $classes = array(
			'sub-menu',
			( $depth == 0 ? 'row' : '' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' )
		);

        $class_names = implode( ' ', $classes );

        // Build HTML for output.
        $output .= "\n" . $indent . '<div class="' . $class_names . '">' . "\n";

    }


    function end_lvl( &$output, $depth = 0, $args = array() ) {

        $output .= "\n" . '</div>' . "\n";

    }



 

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query, $DB_Helper;


        $nav_content = $DB_Helper->get_content_by_id($item->object_id);

        $nav_content = $DB_Helper->strip_tags_content($nav_content);

        $nav_content = $DB_Helper->excerpt($nav_content, 20);


        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        $markup = '<div id="menu-id-'. $item->ID . '" class="menu-list-row">';

        $output .= ( $depth == 0 ) ? $markup : ''; 

        // Depth-dependent classes.

        $depth_classes = array(
            ( $depth == 0 ? '' : 'sub-menu-item' ),
            ( $depth == 1 ? 'col-md-3' : '' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth == 0 ? '' : 'menu-item-depth-' . $depth )
        );

        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // Build HTML.

        $output .= $indent . '<div class="' . $depth_class_names . '">';


        // Link attributes.

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        // Build HTML output and pass through the proper filter.
        // Hide Parent Nav

        $item_output = ( $depth == 0 ) ? '' : sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
		);

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }



	function end_el( &$output, $item, $depth = 0, $args = array() ) {

        if($depth == 0 ){
            $output .= "\n" . '</div></div>' . "\n";
        } else {
            $output .= "\n" . '</div>' . "\n";
        }

	}







}