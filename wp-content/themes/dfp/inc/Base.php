<?php
/*
 * Base
 * Manages the essential stuff for the theme
 */
 
 class DB_Base{


	//magic function, called on creation
	public function __construct(){

		$this->acf_site_options();

		add_action('wp_enqueue_scripts', array($this,'enqueue_public_scripts_and_styles')); //enqueue public facing elements
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts_and_styles')); //enqueues admin elements
		add_action( 'after_setup_theme', array($this, 'register_menus') );
	}



public function register_menus(){
	add_theme_support( 'menus' );
	register_nav_menu( 'main_menu', __( 'Main Menu', 'DFP' ) );
	register_nav_menu( 'footer1', __( 'Footer 1', 'DFP' ) );
	register_nav_menu( 'footer2', __( 'Footer 2', 'DFP' ) );
	register_nav_menu( 'footer3', __( 'Footer 3', 'DFP' ) );
}



//enqueue public scripts and styles
public function enqueue_public_scripts_and_styles(){

	//load the site CSS, with dependencies defined

	wp_enqueue_style('main', get_stylesheet_directory_uri().'/assets/css/main.css');
	wp_enqueue_script('main', get_stylesheet_directory_uri().'/assets/js/main.js');

}


//enqueue admin scripts and styles
public function enqueue_admin_scripts_and_styles(){
	global $pagenow, $post_type;
	
	if( is_admin() ){ }
}


private function acf_site_options(){

	if( function_exists('acf_add_options_page') ) {
   
		$parent = acf_add_options_page('Site Options');
	  
		// PARENT
		$parent = acf_add_options_page(array(
		  'page_title'  => 'Site Options',
		  'menu_title'  => 'Site Options',
		  'redirect'    => false
		));
		
		// SUBPAGES
		acf_add_options_sub_page(array(
		  'page_title'  => 'Branding Images',
		  'menu_title'  => 'Branding Images',
		  'parent_slug'   => $parent['menu_slug'],
		));
	  
		acf_add_options_sub_page(array(
		  'page_title'  => 'Social Media',
		  'menu_title'  => 'Social Media',
		  'parent_slug'   => $parent['menu_slug'],
		));
	  
		acf_add_options_sub_page(array(
		  'page_title'  => 'Footer Options',
		  'menu_title'  => 'Footer Options',
		  'parent_slug'   => $parent['menu_slug'],
		));
	  
	  }
	  

if( function_exists('acf_add_local_field_group') ):

	// : SITE OPTIONS
	$phone_number = array (
		'key' => 'field_phone_number',
		'label' => 'Phone Number',
		'name' => 'phone_number',
		'type' => 'textarea',
		'rows' => 1,
		'default_value' => '000 0000 000',
	);

	$fax_number = array (
		'key' => 'field_fax_number',
		'label' => 'Fax Number',
		'name' => 'fax_number',
		'type' => 'textarea',
		'rows' => 1,
		'default_value' => '000 0000 000',
	);

	$email_address = array (
		'key' => 'field_email_address',
		'label' => 'Email Address',
		'name' => 'email_address',
		'type' => 'textarea',
		'rows' => 1,
		'default_value' => 'sample@info.com',
	);

	$address = array (
		'key' => 'field_address',
		'label' => 'Address',
		'name' => 'address',
		'type' => 'textarea',
		'rows' => 2,
		'default_value' => '123 Street, City, State, Country',
	);

	$page_not_found = array (
		'key' => 'page_not_found',
		'label' => '404 page URL',
		'name' => 'page_not_found',
		'type' => 'text',
	);

	acf_add_local_field_group(array (
		'key' => 'site_options',
		'title' => 'Site Options',
		'fields' => array ( 
							$phone_number, 
							$fax_number, 
							$address, 
							$email_address,
							$page_not_found,
						  ),
		'location' => array (
		  array (
			array (
			  'param' => 'options_page',
			  'operator' => '==',
			  'value' => 'acf-options-site-options',
			),
		  ),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	  ));
	

	// : BRANDING OPTIONS
	$desktop_site_logo_field = array(
	  'key' => 'field_desktop_logo',
	  'label' => 'Desktop Branding',
	  'name' => 'desktop_site_logo',
	  'type' => 'image',
	  'return_format' => 'url',
	  'preview_size' => 'thumbnail',
	  'library' => 'all',
	);
  
	$desktop_site_logo_light_field = array(
	  'key' => 'field_desktop_logo_light',
	  'label' => 'Desktop Branding Light',
	  'name' => 'desktop_site_logo_light',
	  'type' => 'image',
	  'return_format' => 'url',
	  'preview_size' => 'thumbnail',
	  'library' => 'all',
	);
  
  
	acf_add_local_field_group(array (
	  'key' => 'branding_options',
	  'title' => 'Branding Options',
	  'fields' => array ( 
						  $desktop_site_logo_field, 
						  // $desktop_site_logo_light_field, 
						),
	  'location' => array (
		array (
		  array (
			'param' => 'options_page',
			'operator' => '==',
			'value' => 'acf-options-branding-images',
		  ),
		),
	  ),
	  'menu_order' => 0,
	  'position' => 'normal',
	  'style' => 'default',
	  'label_placement' => 'top',
	  'instruction_placement' => 'label',
	  'hide_on_screen' => '',
	));
  

  
	// : SOCIAL MEDIA
  
	$social_name = array (
	  'key' => 'field_social_name',
	  'label' => 'Social Name',
	  'name' => 'social_name',
	  'type' => 'text',
	  'wrapper' => array (
		'width' => '50',
		'class' => '',
		'id' => '',
	  ),
	);
  
	$social_url = array (
	  'key' => 'field_social_url',
	  'label' => 'Social Url',
	  'name' => 'social_url',
	  'type' => 'text',
	  'wrapper' => array (
		'width' => '50',
		'class' => '',
		'id' => '',
	  ),
	);
  
	$repeat_field = array(
	  'key' => 'social_field_repeater',
	  'label' => 'Social Media Fields',
	  'name' => 'social_media_fields',
	  'type' => 'repeater',
	  'instructions' => '',
	  'sub_fields' => array( $social_name,  $social_url),
	  'layout' => 'table',
	);
  
  
	acf_add_local_field_group(array (
	  'key' => 'social_fields',
	  'title' => 'Social Fields',
	  'fields' => array ($repeat_field),
	  'location' => array (
		array (
		  array (
			'param' => 'options_page',
			'operator' => '==',
			'value' => 'acf-options-social-media',
		  ),
		),
	  ),
	  'menu_order' => 0,
	  'position' => 'normal',
	  'style' => 'default',
	  'label_placement' => 'top',
	  'instruction_placement' => 'label',
	  'hide_on_screen' => '',
	));
  
  
  
	// : FOOTER OPTIONS
  
	$copyright = array (
		'key' => 'field_site_copyright',
		'label' => 'Site Copyright',
		'name' => 'site_copyright',
		'type' => 'textarea',
		'rows' => 2,
		'default_value' => 'PV Theme | 2017',
	);

	acf_add_local_field_group(array (
	  'key' => 'footer_options',
	  'title' => 'Footer Options',
	  'fields' => array ( 
							$copyright
						),
	  'location' => array (
		array (
		  array (
			'param' => 'options_page',
			'operator' => '==',
			'value' => 'acf-options-footer-options',
		  ),
		),
	  ),
	  'menu_order' => 0,
	  'position' => 'normal',
	  'style' => 'default',
	  'label_placement' => 'top',
	  'instruction_placement' => 'label',
	  'hide_on_screen' => '',
	));
  
  
  endif;


}

 }//end class

 //create new object 
 $DB_Base = new DB_Base;