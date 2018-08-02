<?php


class DB_Content extends DB_Base{
 	
//magic function, called on creation
public function __construct(){

}


public function get_visbility_classes($class){
	

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

 }//end class

 //create new object 
 $DB_Content = new DB_Content;