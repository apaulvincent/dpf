<?php
/*
reusableblock : Reusable Block
fulltexttitle : Full-width Title and Text
herobanner : Hero Banner
textandcounters : Text and Counters
slider : Slider
3blocksfeatpost : 3 Featured Post Blocks
2blocksfeatpost : 2 Featured Post Blocks
2blocksimgtext : 2 Image & Text Blocks
2blockstext : 2 Blocks Text
countryblocks : Countries Blocks
*/

 
 class DB_Content extends DB_Base{
 	
	//variables
	//private $class_directory = '';
	public $taxonomy_display_attributes = array(
			'taxonomy' => 'post_tag',
			'orderby' => 'name',
			'order' => 'ASC',
			'number' => 0,
			'hide_empty' => 0,

			'--filter-type' => 'term',//defies whether we are calling for terms a based on a term filter or post filter
			'--format' => 'cloud',
			'--container-class' => 'tax-display-container',
			'--child-class' => 'btn btn-default btn-s',
		);
	
	//magic function, called on creation
	public function __construct(){
		//add_shortcode( 'callout-block', array($this, 'prepare_callout_block_from_id'));
		add_shortcode( 'taxonomy-display', array($this, 'generate_taxonomy_display') );
	}


	
//======================THE MAIN ONES====================//
function get_page_content(){

	global $post;

	$site_config = get_fields($post->ID);

	/*
		define the stucture - do we have a sidebar
		get the content, loop thru it and generate all the blocks
	*/
		$html = '<div id="main" class="main">';//set up main container
		
		// SHOW | HIDE SIDEBAR
		if($site_config['has_sidebar'] == 1):
			$html .= '<div class="container">';
			$html .= '<div class="row">';
			$html .= '<div class="col-xs-12 col-md-12 col-lg-9">';
		endif;
		
		
		if(isset($site_config['content-row']) && !empty($site_config['content-row'])):

			foreach($site_config['content-row'] as $section_key => $row):

				if(empty($row)) continue;		

				$section_visibility = '';

				// LOOP THROUGH ROWS
				foreach($row as $row_key => $column):

					// SET VISIBILY CLASSES
					if(  $row_key =='section_visibility') {
						$section_visibility = $this->get_visbility_classes($column);
					}

					if( empty($column) || $row_key != 'content-column' ) continue;	

					$html .= '<section class="content-block '.$row['section_class'].' '. $section_visibility .'">';

					if( is_front_page() ):
						$html .= '<div class="fluid-wrapper">';
						$html .= '<div class="row no-gutters">';
					else:
						$html .= ($site_config['has_sidebar'] == 1) ? '' : '<div class="container">';
						$html .= '<div class="row">';
					endif;

					// LOOP THROUGH COLUMNS
					foreach($column as $col_key => $col):

						if($col['content_type'] == 'reusable-content'):

							// get the data for the reusable content and pass it to the $column array. 
							// that way we get the required content details, including content-type, 
							// but keep the classes etc assigned to the page column

							$reusable_content_fields = array();
							
							foreach($col['reusable_content'] as $reusable_key => $reusable):

								$ID = $reusable->ID;
								$reusable_content_fields['reusable'][ $reusable_key ] = get_fields($ID);

								$col = array_merge($col, $reusable_content_fields);
								
							endforeach;
							
						endif;

						//define col container grid classes
						switch($col['col_width']){
							case '2':
								$col_grid_class  = 'col-xs-12 col-md-12 col-lg-2';
							break;
							case '3':
								$col_grid_class  = 'col-xs-12 col-md-12 col-lg-3';
							break;
							case '4':
								$col_grid_class  = 'col-xs-12 col-md-12 col-lg-4';
							break;
							case '6':
								$col_grid_class  = 'col-xs-12 col-md-12 col-lg-6';
							break;
							case '8':
								$col_grid_class  = 'col-xs-12 col-md-12 col-lg-8';
							break;
							case '9':
								$col_grid_class  = 'col-xs-12 col-md-12 col-lg-9';
							break;
							case '12':
								$col_grid_class  = 'col-xs-12 col-md-12 col-lg-12';
							break;
						}

						//assign any col container classes
						(!empty($col['additional_classes'])) ? $col_classes = $col['additional_classes'] : $col_classes = '';

						// SET VISIBILY CLASSES
						$column_visibility = $this->get_visbility_classes($col['column_visibility']);

						$html .= '<div class=" '.$col_grid_class.' '.$col_classes.' '.$col['content_type'].' '. $column_visibility .'">';
						$html .= '<div class="block-item">';
						$html .= $this->pass_file_to_var('partials/content/'.$col['content_type'].'.php', $col);
						$html .= '</div>';
						$html .= '</div>';

					endforeach;

					$html .= '</div>';

					if( !is_front_page() ):
						$html .= ($site_config['has_sidebar'] == 1) ? '' : '</div>';
					endif;

					$html .= '</section>';
				endforeach;

			endforeach;

		endif;

		// SHOW | HIDE SIDEBAR
		if($site_config['has_sidebar'] == 1):

			$html .= '</div>';
			$html .= '<div class="col-xs-12 col-md-12 col-lg-3">';
			$html .= '<div class="sidebar">'.$this->get_sidebar_content().'</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';

		endif;

		$html .= '</div>'; // END MAIN

		echo $html;

}


function get_sidebar_content(){

	global $post;
	$site_config = get_field('sidebar_content', $post->ID);

	$html = '';
	
	if(!empty($site_config)):

		foreach($site_config as $col):
			
			if($col['content_type'] == 'reusable-content'):

				$reusable_content_fields = array();
				
				foreach($col['reusable_content'] as $reusable_key => $reusable):

					$ID = $reusable->ID;
					$reusable_content_fields['reusable'][ $reusable_key ] = get_fields($ID);

					$col = array_merge($col, $reusable_content_fields);

				endforeach;

			endif;

			//assign any col container classes
			(!empty($col['additional_classes'])) ? $col_classes = $col['additional_classes'] : $col_classes = '';

			// SET VISIBILY CLASSES
			$column_visibility = $this->get_visbility_classes($col['column_visibility']);


			$html .= '<div class="sidebar-block '.$col['content_type'].' '.$col_classes.'  '. $column_visibility .'">';
			$html .= $this->pass_file_to_var('partials/content/'.$col['content_type'].'.php', $col);
			$html .= '</div>';

		endforeach;

	endif;

	return $html;
	
}

function get_reusable_content($reusable_content){
	/*
		get the post & meta
	*/

	$content_type = $reusable_content['content_type'];

	$html = $this->pass_file_to_var('partials/content/'.$content_type.'.php', $reusable_content);

	return $html;

}

function pass_file_to_var($file, $var = array()){
	extract($var);
	ob_start();
	include(locate_template($file)); 
	return ob_get_clean();
}



function get_visbility_classes($class){
	

	if($class == 'xl'){

		return 'd-xl-none';

	} elseif($class == 'lg'){

		return 'd-lg-none';
		
	} elseif($class == 'md'){

		return 'd-md-none';

	} elseif($class == 'sm'){

		return 'd-sm-none';

	} elseif($class == 'vxl'){

		return 'd-none d-xl-block';

	} elseif($class == 'vlg'){

		return 'd-none d-lg-block';
		
	} elseif($class == 'vmd'){

		return 'd-none d-md-block';

	} elseif($class == 'vsm'){

		return 'd-none d-sm-block';

	}

	return '';

}



//==============COMMONS AND HELPERS======================//
public function get_page_breadcrumb(){
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<div id="breadcrumbs" class="breadcrumbs">','</div>');
	}	
}
			
public function get_section_divider($type = 'full', $class = array()){
	switch($type){
		
		case 'full':
			$divider = '<div class="row">
							<div class="col-md-12">
								<div class="divider '.implode(' ', $class).'"></div>
							</div>
						</div>';
		break;

		case 'half':
			$divider = '<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<div class="divider '.implode(' ', $class).'"></div>
							</div>
						</div>';
		break;

		case 'quarter-no-offset':
			$divider = '<div class="row">
							<div class="col-md-3">
								<div class="divider '.implode(' ', $class).'"></div>
							</div>
						</div>';
		break;
	}

	return $divider;
}
		
public function get_section_spacer( $size = '30', $class = array() ){
	$spacer = ' <div class="spacer '.implode(' ', $class).'" style="margin-bottom: '.$size.'px;"></div>';
	return $spacer;
}

public function get_news_articles($query_mods = array()){

		$args = array(
			'posts_per_page'    => -1,
			'post_type'      => 'article',
			'post_status' => 'publish',
			'orderby' => 'date',
			'order'  => 'desc',
		);

	$args = array_replace ($args, $query_mods);
	$query = new WP_Query( $args );
	return $query ;
}

public function get_article_tile($post, $display_rules = array() ){
	global $DB_Helper;

	$col_class_number = floor( 12 / $display_rules['columns'] ); //work out the column class
	$post_thumb_id = get_post_thumbnail_id($post);

	$content = '';

	switch($display_rules['display_type']){
			case 'standard':
				$feature_image = $DB_Helper->generate_image( $post_thumb_id, 'news_thumbnail' );

					$content .= '<div class="col-xs-12 col-sm-6 col-md-'.$col_class_number.'">';
					$content .= '<div class="news-block '.$display_rules['display_type']. '">
						<a href="'.get_permalink($post).'" class="link-wrap">
							<div class="news-image">
							' . $feature_image .'
							</div>
							
							<h3 class="news-title">' . get_the_title() . '</h3>
							<div class="news-date">' . str_replace(',', '', get_the_date()) . '</div>
						
						</a>';
	 				if($display_rules['columns']){

	 					$atts = array(
	 						'--filter-type' => 'post',
	 						'post_id' => get_the_ID(),
	 						'taxonomy' => 'post_tag',
	 						'--child-class' => 'btn btn-primary',
	 						);
	 					
	 					$tags = $this->get_taxonomy_display($atts);

	 					if(!empty($tags)){
							$content .= '<div class="tag-cloud">';
							$content .= $tags;
	 						$content .= '</div>';
	 					}
					 }
					 
	 				$content .= '</div>';
	 				$content .= '</div>';
			break;
			case 'home-news':
				$feature_image = $DB_Helper->generate_image( $post_thumb_id, 'news_thumbnail' );

					$content .= '<div class="col-xs-12 col-sm-6 col-md-'.$col_class_number.'">';
					$content .= '<div class="news-block '.$display_rules['display_type']. '">
						<a href="'.get_permalink($post).'" class="link-wrap">
							<div class="news-image">
							' . $feature_image .'
							</div>
							
							<h3 class="news-title">' . get_the_title() . '</h3>
							<div class="news-date">' . str_replace(',', '', get_the_date()) . '</div>
	 					
	 					</a>';
	 				if($display_rules['columns']){

	 					$atts = array(
	 						'--filter-type' => 'post',
	 						'post_id' => get_the_ID(),
	 						'taxonomy' => 'post_tag',
	 						'--child-class' => 'btn btn-primary',
	 						);
	 					
	 					$tags = $this->get_taxonomy_display($atts);

	 					if(!empty($tags)){
							$content .= '<div class="tag-cloud">';
							$content .= $tags;
	 						$content .= '</div>';
	 					}
					 }
					 
	 				$content .= '</div>';
	 				$content .= '</div>';
			break;
	}

	return $content;

}

// Add Shortcode
function generate_taxonomy_display( $atts ) {
	/*
	returns tags, categories for any post type in a range of display formats
	*/
	// Attributes
	// att query options here: https://developer.wordpress.org/reference/classes/wp_term_query/__construct/
	$atts = shortcode_atts(
		$this->taxonomy_display_attributes,
		$atts,
		'taxonomy-display'
	);

	return $this->get_taxonomy_display($atts);

}

//===========================================
public function get_taxonomy_display($atts){
		global $DB_Base, $DB_Helper;
		/*
			returns the taxonomy display
		*/
			
		$atts = array_merge($this->taxonomy_display_attributes, $atts);//merge the default values with the supplied ones

		$presentation = array();

		foreach($atts as $key => $att){

			if(substr($key,0,2) == '--'){
				
				$presentation[ substr($key,2) ] = $att;
				unset($atts[$key]);
			}
		}
		//get the terms
		switch($presentation['filter-type']){
			case 'term':
				$terms = get_terms($atts);
			break;
			case 'post':

				$terms = wp_get_post_terms($atts['post_id'], $atts['taxonomy'], array('orderby' => $atts['orderby'], 'order' => $atts['order'],));
			break;
		}
		
		if( empty( $terms ) || is_wp_error( $terms ) ) return;

		$html = '';

		//present the terms
		(isset($presentation['container-class'])) ? $container_class = $presentation['container-class'] : $container_class = '';
		(isset($presentation['child-class'])) ? $child_class = $presentation['child-class'] : $child_class = '';

		switch($presentation['format']){
			case 'cloud':
				$html .= '<ul class="'.$presentation['format'].' '.$container_class.'">';

				foreach($terms as $term){

					$html .= '<li><a href="'.get_term_link($term).'" class="'.$child_class.' btn-cloud">'.$term->name.'</a></li>';
				}
				$html .= '</ul>';

			break;

		}

		return $html;
	}

//===========================================
	/*public function prepare_callout_block_from_id($atts){

		//used by the shortcode to return the content

        global $Content;

        $atts = shortcode_atts(
		array(
			'id' => '',
		), $atts
	);

		$data = $this->get_callout_blocks(array('callout_block_id' => $atts['id']));

        if(empty($data)){
        	return;
        }else{
        	return $this->get_callout_block( $data[0] );
        } 
    }
    */

 }//end class

 //create new object 
 $DB_Content = new DB_Content;