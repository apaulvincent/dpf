<?php
/*
 * Base
 * Manages the essential stuff for the theme
 */
 
 class DB_Helper extends DB_Base{
 	
	//variables
	//private $class_directory = '';

	
	//magic function, called on creation
	public function __construct(){

	}

	public function get_current_url(){
		global $wp;
		$current_url = home_url(add_query_arg(array(),$wp->request));
		return $current_url;
	}


	public function get_image_sizes() {
		global $_wp_additional_image_sizes;

		$sizes = array();
		//var_dump($_wp_additional_image_sizes);die;

		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
				$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
				$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
				$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		return $sizes;
	}

	public function get_image_size( $size ) {
		$sizes = $this->get_image_sizes();

		if ( isset( $sizes[ $size ] ) ) {
			return $sizes[ $size ];
		}

		return false;
	}
	
	public function get_placeholder_image_url($w, $h ){
		return 'http://via.placeholder.com/'.$w.'x'.$h;
	}

	public function generate_image($image_id, $type = 'thumbnail' ){

	
		$image = wp_get_attachment_image( $image_id, $type);
		if(!($image)){
			return false;
			if(is_array($type)){
				$width = $type[0];
				$height = $type[1];
			}else{
				$sizes = $this->get_image_size( $type );
				//if(!isset($sizes['width'])) {print_r($sizes);}
				$width = $sizes['width'];
				$height = $sizes['height'];
			}
			
			$image = '<img src="'.$this->get_placeholder_image_url($width, $height).'" />';
		}
		return $image;
	}


		//================HELPER QUERIES ==============//

	public function array_search($array, $field, $value) {
		$result = array();
		if(is_array($array) && !empty($array)){
		
			foreach($array as $key => $subarray)
			{
				if ( $subarray[$field] === $value )
					$result[$key] = $subarray;
			}
			}
		return $result;
	}


		// Excerpts
	public function excerpt($text, $limit) {
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



  public function truncate($input, $maxWords, $maxChars)
  {
	  $words = preg_split('/\s+/', $input);
	  $words = array_slice($words, 0, $maxWords);
	  $words = array_reverse($words);
	  $chars = 0;
	  $truncated = array();
	  while(count($words) > 0)
	  {
		  $fragment = trim(array_pop($words));
		  $chars += strlen($fragment);
		  if($chars > $maxChars) break;
		  $truncated[] = $fragment;
	  }
	  $result = implode($truncated, ' ');
	  if ($input == $result)
	  {
		  return $input;
	  }
	  else
	  {
		  return preg_replace('/[^\w]$/', '', $result); // . '...';
	  }
	}
  

	public function strip_tags_content($text, $tags = '', $invert = FALSE) { 

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


	  public function get_content_by_id($post_id) {
		$page_data = get_page($post_id);
		if ($page_data) {
		  return $page_data->post_content;  
		} else {
		   return false;
		}
	  }
	  



 }//end class

 //create new object 
 $DB_Helper = new DB_Helper;