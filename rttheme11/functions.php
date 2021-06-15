<?php

//sidebars
include(get_template_directory().'/functions/rt_ud_sidebars.php');

//custom post types - taxonomies
include(get_template_directory().'/functions/rt_custom_posts.php');
rt_theme_custom_posts(); //call custom post types


//admin panel options
if(is_admin()):
include(get_template_directory().'/rttheme_options/includes.php');
endif;

if(!is_admin()):
//vt resize
include(get_template_directory().'/rttheme_options/plugins/vt_resize.php');

//breadcrumb function
include(get_template_directory().'/functions/rt_breadcrumb.php');

//shortcodes
include(get_template_directory().'/functions/rt_shortcodes.php');

//comments
include(get_template_directory().'/functions/rt_comments.php');
endif;

if ( ! isset( $content_width ) ) $content_width = 680;
	

//Custom background support
add_theme_support( 'custom-background');

// Load text domain
load_theme_textdomain('rt_theme', get_template_directory().'/languages' );

// Automatic Feed Links
add_theme_support( 'automatic-feed-links' );


/*
Theme color selection
*/
if (get_option('rttheme_style')){
	$which_theme=get_option('rttheme_style');
}else{
	$which_theme="1";		
}

/*
*
* Loading Theme Scripts
*
*/

function rt_theme_load_scripts(){
	global $tabbed_page;
	
	$template_directory = get_template_directory_uri();
	
	if (!is_admin()) {//load theme scripts
	   wp_enqueue_script( 'jquery' ); 
	   wp_enqueue_script('jquery-easing', $template_directory  . '/js/jquery.easing.1.3.js', array('jquery') );	   
	   wp_enqueue_script('jquery-cycle', $template_directory  . '/js/jquery.cycle.all.min.js', array('jquery') );
	   wp_enqueue_script('jquery-validate', $template_directory  . '/js/jquery.validate.js', array('jquery') );
	   wp_enqueue_script('jquery-prettyphoto', $template_directory  . '/js/jquery.prettyPhoto.js', array('jquery') );
	   
	   if(!get_option('rttheme_disable_cufon')){//if cufon is active
		  wp_enqueue_script('cufon', $template_directory  . '/js/cufon.js', array('jquery') );
		  wp_enqueue_script('aller-cufon-fonts', $template_directory  . '/js/anivers_400.font.js', array('jquery') ); 
	   }
 
	   wp_enqueue_script('jquery-coda-slider', $template_directory  . '/js/jquery.coda-slider-2.0.js', array('jquery') ); 
	   wp_enqueue_script('rt-theme-scripts', $template_directory  . '/js/script.js', array('jquery') ); 
	   wp_enqueue_script('jquery-form'); 

	}
}

add_action('init', 'rt_theme_load_scripts');

/*
*
* Loading Theme Styles
*
*/

function rt_theme_load_styles(){
	global $which_theme;

	wp_enqueue_style('theme', get_template_directory_uri() . '/css/style.css', 1 , false, 'all');
	wp_enqueue_style('theme-color', get_template_directory_uri() . '/css/'.$which_theme.'/style_cf.css', 2 , false, 'all');
	wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', 3 , false, 'all');

	wp_register_style('theme-ie6',get_template_directory_uri() . '/css/ie6.css', 4 , false, 'screen');
	$GLOBALS['wp_styles']->add_data( 'theme-ie6', 'conditional', 'IE 6' );
	wp_enqueue_style('theme-ie6');  

	wp_enqueue_style('wp', get_template_directory_uri() . '/style.css', 4 , false, 'all');
} 
 
if (!is_admin() && $pagenow != 'wp-login.php') {
	add_filter('init','rt_theme_load_styles'); 
}


/*
*
* Custom CSS Codes
*
*/

function rt_theme_custom_css_codes(){
	echo '<style type="text/css"> '. get_option('rttheme_custom_css') .' </style>';
}
if (!is_admin()) {
	add_filter('wp_head','rt_theme_custom_css_codes'); 
}
 

/*
*
* FIX for IE6
*
*/
function rt_theme_belatedPNG(){
	echo '
		<!--[if IE 6]> 
		<script type="text/javascript" src="'.get_template_directory_uri().'/js/dd_belated_png.js"></script>
		<script>DD_belatedPNG.fix(".png,#numbers a,.first_ul");</script>
		<![endif]-->  
	';	
}

if (!is_admin()) {
	add_filter('wp_head','rt_theme_belatedPNG'); 
} 


/*
Post Thumbnails Support
*/
add_theme_support( 'post-thumbnails', array( 'post' ) ); // Add it for posts

/*
WP 3.0  custom menu
*/
add_action( 'init', 'rt_theme_navigations' );

function rt_theme_navigations() {
	register_nav_menu( 'rt-theme-main-navigation', __( 'RT Theme Main Navigation' ) ); 
	register_nav_menu( 'rt-theme-footer-navigation', __( 'RT Theme Footer Navigation' ) );
}

wp_create_nav_menu( 'RT Theme Main Navigation Menu', array( 'slug' => 'rt-theme-main-menu' ) ); 
wp_create_nav_menu( 'RT Theme Footer Navigation Menu', array( 'slug' => 'rt-theme-footer-menu') );
 
 
/*
Flush  old re-write rules
note : this function can be removed after develop period - Tolga Can 
*/

function rt_flush_rewrite_rules() 
{
   global $wp_rewrite;
   $wp_rewrite->flush_rules();
}

add_action('admin_init', 'rt_flush_rewrite_rules');


/*
Pagination
*/
function get_page_count(){
	global $wp_query;	
	$count=array('page_count'=>$wp_query->max_num_pages,'post_count'=>$wp_query->post_count);
	return $count;
}

function get_pagination($range = 7){
  global $paged, $wp_query;
  
	if ( !isset($max_page) ) {
		$max_page = $wp_query->max_num_pages;
	}
	
	if($max_page > 1){
		if(!$paged){
			$paged = 1;
		}

		if ($paged > 1){
			echo "<li class=\"arrowleft\">";
				previous_posts_link('&nbsp;');
			echo "</li>\n";
		}
		if($max_page > $range){
		  if($paged < $range){
			for($i = 1; $i <= ($range + 1); $i++){
			  echo "<li";
			  if($i==$paged) echo " class='active'";
			  echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
			  echo "</li>\n";
			}
		  }
		  elseif($paged >= ($max_page - ceil(($range/2)))){
			for($i = $max_page - $range; $i <= $max_page; $i++){
			  echo "<li";
			  if($i==$paged) echo " class='active'";
			  echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
			  echo "</li>\n";
			}
		  }
		  elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
			for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){

			  echo "<li";
			  if($i==$paged) echo " class='active'";
			  echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
			  echo "</li>\n";

			}
		  }
		}
		else{
		  for($i = 1; $i <= $max_page; $i++){
			  echo "<li";
			  if($i==$paged) echo " class=\"active\" ";
			  echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
			  echo "</li>\n";
		  }
		}
		if ($paged != $max_page){
			echo "<li class=\"arrowright\">";
			 next_posts_link('&nbsp;');
			echo "</li>\n";
		} 
	}
}


/*
 add a class to active product and portolio links
*/

function rt_nav($link_page,$link_cat){
global $current_page_link,$current_cat_link;
	
	$current_page_link=$link_page;
	$current_cat_link=$link_cat;
 
		
	//page
	function add_class_page($output) {
		global $current_page_link,$current_cat_link;
		$bul=str_replace('/','\\/','"><a href="'.$current_page_link.'">');
		$bul=str_replace('?','\\?',$bul);
		$degistir=' current-menu-item"><a href="'.$current_page_link.'">';
		return preg_replace('/'.$bul.'/', $degistir, $output, 20); 
	}
	 

	//term in page
	function add_class_cat2($output) {
		global $current_page_link,$current_cat_link;
		
		$bul=str_replace('/','\\/','"><a href="'.$current_cat_link.'">');
		$bul=str_replace('?','\\?',$bul);
		
		$degistir=' current-menu-item"><a href="'.$current_cat_link.'">';
		
		return preg_replace('/'.$bul.'/', $degistir, $output, 20);
	}	
			 

	//call the main menu
	if ( has_nav_menu( 'rt-theme-main-navigation' ) ){        
		$menuVars = array(
			'menu_id'         => 'navigation',
			'echo'            => false,
			'container_id'    => 'dropdown_menu', 
			'theme_location'  => 'rt-theme-main-navigation'
		);
	}else{
		$menuVars = array(
			'menu'            => 'RT Theme Main Navigation Menu',  
			'menu_id'         => 'navigation',
			'echo'            => false,
			'container_id'    => 'dropdown_menu',									
			'theme_location'  => 'rt-theme-main-navigation'
		);	
	}
	


	if($link_page && $link_cat){
		
		if (!is_attachment()){ 
			$dd = add_filter('wp_nav_menu', 'add_class_page'); 
			$dd = add_filter('wp_nav_menu', 'add_class_cat2');
		}
	}
	
	echo wp_nav_menu($menuVars);
}

/*
*
* Find top level item of the current taxonomy
*
*/
function find_top_level_tax($term_id,$taxonomy){
	
	$parent_term = get_term_by('term_id',$term_id, $taxonomy);
	
	if (is_object($parent_term) && $parent_term->parent){ 
		
		return find_top_level_tax($parent_term -> parent,$taxonomy);
		
	}else{

		return $term_id;
	}
	
	return;
}


/*
*
* replace [...] more in excerpts 
*
*/
function new_excerpt_more($more) {
		global $post;
		return ' .. <a href="'. get_permalink($post->ID) . '">'.__('read more','rt_theme').'</a>';
}


/*
*
* replace current-cat as active
*
*/
function category_class($output){
	return preg_replace('/current-cat/', 'current_page_item', $output, 20);
}

/*
*
* replace top-level parent cat as active
*
*/
function category_top_class($output){
	global $term_id,$taxonomy;

	//get top level parent term id 
	$top_level_parent_id=find_top_level_tax($term_id,$taxonomy);
	 
	 if($top_level_parent_id):
	$term_link=get_term_link(intval($top_level_parent_id),$taxonomy);
	
	//find and replace 	
	$bul=str_replace('/','\\/','"><a href="'.$term_link.'"');
	$bul=str_replace('?','\\?',$bul);
	$degistir=' current_page_item"><a href="'.$term_link.'"';
	 return preg_replace('/'.$bul.'/', $degistir, $output, 20);
	 else:
	 return $output;
	endif;	
	
}

/*
*
*  get the post thumbnail url
*  
*/
function get_post_thumbnail() {
$files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image');
if($files) :
	$keys = array_reverse(array_keys($files));
	$j=0;
	$num = $keys[$j];
	$image=wp_get_attachment_image($num, 'large', false);
	$imagepieces = explode('"', $image);
	$imagepath = $imagepieces[1];
	$url=wp_get_attachment_thumb_url($num);
	return $url; 
endif;
}

#
# find orginal image url - clean thumbnail extensions
#

function rt_clean_thumbnail_ext ($image_src) { 
	$search = '#-\d+x\d+#';  
	return preg_replace($search, "", $image_src);
}


//installing RT-THEME WIDGETS
require_once(get_template_directory() . '/rttheme_options/widgets/rt-theme-box-widget.php'); 
require_once(get_template_directory() . '/rttheme_options/widgets/rt-theme-slider-widget.php');
require_once(get_template_directory() . '/rttheme_options/widgets/rt-theme-news-widget.php');



//Get the search bar
function rt_search_form(){
 
$s_form='<div class="search_bar">';
$s_form.='<form action="'.get_bloginfo('url').'" method="get">';
$s_form.='<fieldset><input type="text" class="search_text" name="s" id="s" value="' . __('SEARCH', 'rt_theme') . '" /><input type="image" src="'.get_template_directory_uri().'/images/pixel.gif" class="searchsubmit" alt="" /></fieldset>';
$s_form.='</form>';
$s_form.='</div>';

echo $s_form;
}





#
# WPML match post id
#
function wpml_post_id($id){
	if(function_exists('icl_object_id')) {
		return icl_object_id($id,'post',false);
	} else {
		return $id;
	}
}

#
# WPML match page id
#
function wpml_page_id($id){
	if(function_exists('icl_object_id')) {
		return icl_object_id($id,'page',true);
	} else {
		return $id;
	}
}

#
# WPML match categories
#
function wpml_lang_object_ids($ids_array, $type) {
	if(function_exists('icl_object_id')) {
		$res = array();
		
		if(!empty($ids_array) && is_array($ids_array)){
			foreach ($ids_array as $id) {
				$xlat = icl_object_id($id,$type,false);
				if(!is_null($xlat)) $res[] = $xlat;
			}
		}
		
		return $res;
	} else {
		return $ids_array;
	}
}
 



#
# gets orginal paths of images when multi site mode active
#
function find_image_org_path($image) {
	if(is_multisite()){
		global $blog_id;
		if (isset($blog_id) && $blog_id > 0) {
			if(strpos($image,get_bloginfo('wpurl'))!==false){//image is local
				$the_image_path = get_current_site(1)->path.str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$image);
			}else{
				$the_image_path = $image;
			}
		}else{
			$the_image_path = $image;
		}
	}else{
		$the_image_path = $image;
	}
	
	return $the_image_path;
}


#
# returns a post ID from a url
#

function rt_get_attachment_id_from_src ($image_src) { 
		global $wpdb; 
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id    = $wpdb->get_var($query);
		return $id; 
}

?>