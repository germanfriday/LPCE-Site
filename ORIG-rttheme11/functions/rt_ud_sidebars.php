<?php
/*
RT-Theme Dynamic Sidebar Function 
*/
function rt_sidebar($sidebar_id,$sidebar_name,$place){

	//home page content boxes width				

	if(get_option("rttheme_home_box_width")){
	    $box_width=get_option("rttheme_home_box_width");  
	}else{
	    $box_width=4;
	}
	
	
	if($box_width==4){ 
		$box_class="four"; 
	    
	}elseif($box_width==3){ 
		$box_class="three"; 
	    
	}elseif($box_width==2){
	 
		$box_class="two";  
	    
	}elseif($box_width==1){
		$box_class="one"; 								    
	}
	  
	  		
	if ($sidebar_name=='Home Page Contents'){
	register_sidebar(array(
		'id'=> $sidebar_id,
		'name' => $sidebar_name,
		'before_widget' => '<div class="box '.$box_class.'">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	}else{
	register_sidebar(array(
		'id'=> $sidebar_id,
		'name' => $sidebar_name,
		'before_widget' => '<div class="box four">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));		
	}
	
} 
 

//pre defined sidebars
function rt_widgets_init(){
    $rt_sidebars=array( 
	   "home-page-slider" => "Home Page Slider",
	   "home-page-contents" => "Home Page Contents" , 
	   "common-sidebar" => "Common Sidebar",	
	   "sidebar-for_pages" => "Sidebar For Pages" ,	
	   "sidebar-for_blog" => "Sidebar For Blog",
	   "sidebar-for-products" => "Sidebar For Products", 
	   "sidebar-for-product-detail-page" => "Sidebar For Product Detail Page",
	   "sidebar-for-portfolio-detail-page" => "Sidebar For Portfolio Detail Page",
    );
    foreach ($rt_sidebars as $k => $v) {
	   rt_sidebar($k,$v,$place);
    } 
}
add_action( 'widgets_init', 'rt_widgets_init' );


//user defined sidebars
function rt_ud_widgets_init(){
        global $rt_ud_sidebars;
    if(get_option('rttheme_ud_sidebars')){
	   $rt_ud_sidebars= split(';',substr(get_option('rttheme_ud_sidebars'), 0, -1));
	   
	   foreach ($rt_ud_sidebars as $k) {
		  $parameters = split(',',$k);
		  $ud_sidebar_id = trim(preg_replace('/\*/','',$parameters[0].'-'.$parameters[1]));
		  rt_sidebar($ud_sidebar_id,$parameters[2],'ud');		  
	   } 
    }
}
add_action( 'widgets_init', 'rt_ud_widgets_init' );

function rt_ud_sidebars($type,$id){
    global $rt_ud_sidebars;
    if ($rt_ud_sidebars){
        foreach ($rt_ud_sidebars as $k) {
            $parameters = explode(',',$k); 
            $item_ids = explode('**',$parameters[0]); 
            foreach ($item_ids as $v){
                if (trim($v)==trim($id) && $parameters[1]==$type){
                    if (function_exists('dynamic_sidebar') && dynamic_sidebar($parameters[2]));
                }
            }
        }
    }
}


//Get embeded and user defined sidebars
function rt_get_sidebar(){
	global $taxonomy,$post;
	 

	//Dynamic Sidebars
	if (function_exists('dynamic_sidebar')){
		
		// Home Page
		if(is_home()){	
			dynamic_sidebar('Home Page Sidebar');
		}
		
		
		// Regular Pages
		if(is_page() && $post->ID != get_option('rttheme_blog_page') && $post->ID != get_option('rttheme_portf_page')  && $post->ID != get_option('rttheme_product_list')){	
			dynamic_sidebar('Sidebar For Pages');	
			rt_ud_sidebars('page',$post->ID); 
		}
		
		// Regular Categories - Blog Sidebar
		if(is_category()  || $post->ID == get_option('rttheme_blog_page') || is_single() && !$taxonomy){
			dynamic_sidebar('Sidebar For Blog');	
			if (is_category()) rt_ud_sidebars('cat',get_query_var('cat'));
		}

		// Product Sidebars
		if($post->ID == get_option('rttheme_product_list') || $taxonomy=="product_categories" || get_query_var("product_categories")){		
			dynamic_sidebar('Sidebar For Products');			
			if (is_tax()) rt_ud_sidebars('product_cat',get_query_var("product_categories"));//product categories user defined sidebars			
			
			if (is_single()) {
				dynamic_sidebar('Sidebar For Product Detail Page');
				rt_ud_sidebars('post',$post->ID);//product detail page user defined sidebars
			}	
		}
		
		// Portfolio Sidebars
		if($post->ID == get_option('rttheme_portf_page') || $taxonomy=="portfolio_categories" || get_query_var("portfolio_categories")){		
			dynamic_sidebar('Sidebar For Portfolio');			
			if (is_tax()) rt_ud_sidebars('portf_cat',get_query_var("portfolio_categories"));//portfolio categories user defined sidebars			
			
			if (is_single()) {
				dynamic_sidebar('Sidebar For Portfolio Detail Page');
				rt_ud_sidebars('post',$post->ID);//portfolio detail page user defined sidebars
			}	
		}
		
		// Common Sidebar - For all site
		dynamic_sidebar('Common Sidebar');
	}
}
?>