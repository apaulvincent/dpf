<?php
/*
 * Base
 * Manages the essential stuff for the theme
 */
 
 class DB_Base{
 	
	//variables
	private $class_directory = '';
	private $root_directory = '';
	private $active_theme_uri = '';
	/*
				== system
				thumb: 150 x 150	1 : 1
				medium: 300 x 300	1 : 1
				medium_large: 
				large: 1024 x 1024	1 : 1

				== other
				landing_banner_thumb	

				banner_thumb		400 x 100	4:1
				banner_med			800 x 200	4:1
				banner_lge			1800 x 450	4:1

				landscape_thumb 	300 x 150	2:1
				landscape_med 		600 x 300	2:1
				landscape_lge 		1200 x 600	2:1

				portrait_thumb 		150 x 300	1:2
				portrait_med 		300 x 600	1:2
				portrait_lge 		600 x 1200	1:2	

				square_thumb 		300 x 300	1:1
				square_med 			600 x 600	1:1
				square_lge 			1200 x 1200	1:1							

			*/
	public $custom_image_size_arr = array(
		'banner_sm' => array(400, 100, false, 'Small Standard Banner'),
		'banner_md' => array(800, 200, false, 'Medium Standard Banner'),
		'banner_lg' => array(2000, 688, false, 'Large Standard Banner'),

		'landscape_sm' => array(400, 200, false, 'Small Landscape/Feature Banner'),
		'landscape_md' => array(600, 300, false, 'Medium Landscape/Feature Banner'),
		'landscape_lg' => array(1800, 900, false, 'Large Landscape/Feature Banner'),

		'portrait_sm' => array(150, 300, false, 'Small Portrait'),
		'portrait_md' => array(300, 600, false, 'Medium Portrait'),
		'portrait_lg' => array(600, 1200, false, 'Large Portrait'),

		'square_sm' => array(300, 300, false, 'Small Square'),
		'square_md' => array(600, 600, false, 'Medium Square'),

		'square_lg' => array(1200, 1200, false, 'Large Square'),

		'download_image' => array(200, 200, false, 'Download Image'),
	);

	public $site_page_uris = array();

	
	//magic function, called on creation
	public function __construct(){

		$this->set_root_directory_value();//set the site root directory
		$this->set_class_directory_value(); //set the directory url on creation
		$this->set_parent_theme_uri_value(); //set the parent theme url on creation
		$this->set_active_theme_uri_value(); //set the child theme url on creation
		$this->set_site_uri_values();

		$this->run_acf_tweaks();

		add_action('wp_enqueue_scripts', array($this,'enqueue_public_scripts_and_styles')); //enqueue public facing elements
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts_and_styles')); //enqueues admin elements

		add_filter('widget_text', 'do_shortcode');//allow use of shortcodes in text widgets

		add_action( 'after_setup_theme', array($this, 'register_menus') );

		add_action( 'init', array($this, 'create_reusable_content_post_type' ));
		add_action( 'init', array($this, 'create_page_taxonomy' ));


		add_action( 'init', array($this, 'assign_tags_to_post_types' ));

		// Register the image sizes for use in Add Media modal
		add_action( 'init', array($this, 'set_custom_image_sizes'));
		add_filter( 'image_size_names_choose', array($this, 'list_custom_image_sizes') );

		add_action( 'after_setup_theme', array($this, 'wpdocs_after_setup_theme') );

		add_action( 'pre_get_posts', array($this, 'customise_site_search') );

		//require_once($this->root_directory . 'vendor/autoload.php');

		/**
		* Allow shortcodes in Contact Form 7
		*/

		add_filter( 'wpcf7_form_elements', array($this, 'shortcodes_in_cf7') );

		add_action( 'admin_menu', array($this, 'customise_admin_menu'));

		//add custom columns in Admin
		add_filter ( 'manage_download_posts_columns', array($this, 'add_cpt_download_columns') );
  		add_action ( 'manage_download_posts_custom_column', array($this, 'write_cpt_custom_column'), 10, 2 );
	}

/*
 * Add columns to ebp_offer post list
 */
 public function add_cpt_download_columns ( $columns ) {
   return array_merge ( $columns, array ( 
     'post_excerpt' => __ ( 'Excerpt' ),
   ) );
 }


  /*
 * Add custom columns to post list
 */
 public function write_cpt_custom_column ( $column, $post_id ) {
   switch ( $column ) {
       case 'post_excerpt':
       	echo get_the_excerpt($post_id );
       break;

   }
 }

	public function register_menus(){
		add_theme_support( 'menus' );
		register_nav_menu( 'primary_menu', __( 'Main Menu', 'linfox' ) );
		register_nav_menu( 'primary_menu_mobile', __( 'Main Menu Mobile', 'linfox' ) );
		register_nav_menu( 'top_menu', __( 'Top Menu', 'linfox' ) );
		register_nav_menu( 'top_menu_mobile', __( 'Top Menu Mobile', 'linfox' ) );
		register_nav_menu( 'footer1', __( 'Footer 1', 'linfox' ) );
		register_nav_menu( 'footer2', __( 'Footer 2', 'linfox' ) );
	}



public function customise_site_search( $search_query ) {

    if ( !is_admin() && $search_query->is_main_query() && $search_query->is_search ) {

    	$search_query->set('post_type', array('article', 'page') );   
	}

}
	
public function shortcodes_in_cf7( $form ) {
$form = do_shortcode( $form );
return $form;
}
public function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
    add_theme_support( 'post-thumbnails' );
}


public function customise_admin_menu() {
	//hide the posts section
    remove_menu_page( 'edit.php' );
}


public function assign_tags_to_post_types(){

	//assigns tags to articles, products. the idea is for them to share the tags
	return;
	
	register_taxonomy_for_object_type('post_tag', 'insight');
	// register_taxonomy_for_object_type('post_tag', 'case-study');

	$labels = array(
				'name' => _x('Global Tags', 'post type general name'),
				'singular_name' => _x('Global Tag', 'post type singular name'),
				'add_new' => _x('Add Global Tag', 'portfolio item'),
				'add_new_item' => __('Add Global Tag'),
				'edit_item' => __('Edit Global Tag'),
				'new_item' => __('New Global Tag'),
				'view_item' => __('View Global Tag'),
				'search_items' => __('Search Global Tags'),
				'not_found' =>  __('Nothing found'),
				'not_found_in_trash' => __('Nothing found in Trash'),
				'parent_item_colon' => ''
			);
	register_taxonomy( 'post_tag', array('insight'), array(
		'labels' => $labels,
		) );
}



function create_reusable_content_post_type() {

	$labels = array(
		'name' => _x('Reusable Blocks', 'post type general name'),
		'singular_name' => _x('Reusable Blocks', 'post type singular name'),
		'add_new' => _x('Add Reusable Blocks', 'portfolio item'),
		'add_new_item' => __('Add Reusable Blocks'),
		'edit_item' => __('Edit Reusable Blocks'),
		'new_item' => __('New Reusable Blocks'),
		'view_item' => __('View Reusable Blocks'),
		'search_items' => __('Search Reusable Blocks'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'has_archive'  	=>  false,
		'supports' 		=> array( 'title' )
	  ); 
 
	register_post_type( 'reusable-block' , $args );			
}   

function create_page_taxonomy(){
	register_taxonomy(
		'page-cat',
		'page',
		array(
			'label' => __( 'Page Category' ),
			'rewrite' => array( 'slug' => 'page-category' ),
			'hierarchical' => true,
		)
	);
}
public function set_custom_image_sizes(){


	foreach($this->custom_image_size_arr as $name => $image){
		add_image_size( $name, $image[0], $image[1], $image[2] );
	}
}

function list_custom_image_sizes( $sizes ) {
	foreach($this->custom_image_size_arr as $name => $image){
		$custom_size[$name] = $image[3];
	}
    return array_merge( $sizes, $custom_size );
}


	//sets the directory (path) so that we can use this later
	public function set_class_directory_value(){
		$this->class_directory = get_stylesheet_directory_uri() . '/inc';
	}

	public function set_root_directory_value(){
		$this->root_directory = ABSPATH;

	}
	public function set_site_uri_values(){
		$this->site_uri = get_site_url();
		$this->site_page_uris = array(
			'product-tags' => get_field('product_tag_page', 'option')

			);
	}

	//sets the URI so that we can use this later
	public function set_active_theme_uri_value(){
		$this->active_theme_uri = get_stylesheet_directory_uri();
	}

	//sets the URI so that we can use this later
	public function set_parent_theme_uri_value(){
		$this->parent_theme_uri = get_template_directory_uri();
	}

//enqueue public scripts and styles
public function enqueue_public_scripts_and_styles(){

    //load the site CSS, with dependencies defined
		
	// wp_enqueue_style(
	// 	'open-sans', 
	// 	'https://fonts.googleapis.com/css?family=Open+Sans:400,700'
	// );


	// wp_enqueue_style(
	// 	'bootstrap',
	// 	get_stylesheet_directory_uri().'/node_modules/bootstrap/dist/css/bootstrap.css');

	// wp_enqueue_style(
	// 	'slick',
	// 	get_stylesheet_directory_uri().'/node_modules/slick-carousel/slick/slick.css');
	wp_enqueue_style(
		'main',
		get_stylesheet_directory_uri().'/assets/css/main.css');
	
	// wp_deregister_script('jquery');
	// wp_enqueue_script(
	// 	'jquery',
	// 	get_stylesheet_directory_uri().'/node_modules/jquery/dist/jquery.min.js');
	// wp_enqueue_script(
	// 	'slick',
	// 	get_stylesheet_directory_uri().'/node_modules/slick-carousel/slick/slick.min.js');
	wp_enqueue_script(
		'main',
		get_stylesheet_directory_uri().'/assets/js/main.js');


}
//enqueue admin scripts and styles
public function enqueue_admin_scripts_and_styles(){
	global $pagenow, $post_type;
	
	//process only in admin
	if( is_admin() ){
			
			
	}
}



public function run_acf_tweaks(){

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
						  $desktop_site_logo_light_field, 
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