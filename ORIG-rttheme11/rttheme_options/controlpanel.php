<?php
$options = array (

		array("name" => "Stlye Options",
				"desc" => "Please choose a style for your theme.",
				"id" => $shortname."_style",
				"options" =>  array(
                                    1 => "Style 1",
                                    2 => "Style 2",
                                    3 => "Style 3",
                                    4 => "Style 4",
                                    5 => "Style 5",
                                    6 => "Style 6",
                                    7 => "Style 7",
                                    8 => "Style 8",
                                    9 => "Style 9",
                                    10 => "Style 10" 
                                ),
				"type" => "select"),
                
		array(
				"name" => "Logo",
				"desc" => "Please enter file URL of your logo",
				"id" => $shortname."_logo_url",
				"type" => "rttheme_upload"),
 
		array(
				"name" => "Home Page Settings",
				"type" => "heading"),

 
 		array(
				"name" => "Home page box width",
				"desc" => "Please choose a width for your theme content boxes.",
				"id" => $shortname."_home_box_width",
				"options" =>  array(
                                    4 => "1/4",
                                    3 => "1/3",
                                    2 => "1/2",
				    1 => "1/1"
                                ),
				"type" => "select"),

                
		array(
				"name" => "Footer",
				"type" => "heading"),

 
 		array(
				"name" => "Footer Left Area",
				"desc" => "You can enter a text, html or social media shortcodes for this field. You can find the shortcodes in the documentation file.
				
						<blockquote style=\"font-size:11px;\"><u>example</u></blockquote>
						<blockquote style=\"-moz-border-radius: 6px;-khtml-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background:#F8F8F8;font-size:11px;padding:10px;\">
									Copyright &copy; 2009 Company Name, Inc.
</blockquote>



				",
 				"id" => $shortname."_footer_copy",
				"type" => "textarea"), 


		array(
				"name" => "Footer Banner",
				"type" => "heading"),

 
 		array(
				"name" => "Footer Banner Text",
				"desc" => "",
 				"id" => $shortname."_banner_slogan",
				"type" => "text"),

 		array(
				"name" => "Button Text",
				"desc" => "",
 				"id" => $shortname."_banner_button_text",
				"type" => "text"),

 		array(
				"name" => "Button Link",
				"desc" => "",
 				"id" => $shortname."_banner_button_link",
				"type" => "text"),		

 		array(
				"name" => "Sidebar menu for pages",
				"type" => "heading"),
		
		array(  "name" => "Same Lavel Sub Pages",
				"desc" => "Show same lavel pages on sub page sidebar menu.",
				"id" => $shortname."_same_lavel",
				"type" => "checkbox",
				"std" => "false"),

		array(
				"name" => "Don't show sub pages on page's sidebar",
				"id" => $shortname."_hide_sub_pages",
				"type" => "checkbox"),
		
 		array(
				"name" => "Miscellaneous",
				"type" => "heading"),
				
                
		array(  "name" => "Disable Cufon?",
				"desc" => "Check this box if you want to disable the Cufon Font Replacement Plugin",
				"id" => $shortname."_disable_cufon",
				"type" => "checkbox",
				"std" => "false"),
                                

		array("name" => "Google Analytics Tracking Code",
				"id" => $shortname."_anayltics",
				"type" => "textarea")
                
);
$this_file="controlpanel.php";
if ( 'save' == $_REQUEST['action'] & 'controlpanel.php' == $_REQUEST['page'] ) {
		foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ])  ); } else { delete_option( $value['id'] ); } }

							//rttheme_pages[]
							if($_REQUEST['rttheme_pages']!=""){
								$slider_category_final="";
								foreach($_REQUEST['rttheme_pages']  as $slider_category) {
										$slider_category_final .= $slider_category .",";
								}
								update_option( "rttheme_pages[]", $slider_category_final);
							}

							if($_REQUEST['rttheme_footer_pages']!=""){
								//rttheme_footer_pages[]
								$slider_category_final="";
								foreach($_REQUEST['rttheme_footer_pages']  as $slider_category) {
										$slider_category_final .= $slider_category .",";
								}
								update_option( "rttheme_footer_pages[]", $slider_category_final);
							}
	

							if($_REQUEST['rttheme_blog_box_cat']!=""){
								//rttheme_blog_box_cat[]
								$slider_category_final="";
								foreach($_REQUEST['rttheme_blog_box_cat']  as $slider_category) {
										$slider_category_final .= $slider_category .",";
								}
								update_option( "rttheme_blog_box_cat[]", $slider_category_final);
							}


							//rttheme_ex_pages[]
							if($_REQUEST['rttheme_top_pages']!=""){
								$slider_category_final="";
								foreach($_REQUEST['rttheme_top_pages']  as $slider_category) {
										$slider_category_final .= $slider_category .",";
								}
								update_option( "rttheme_top_pages[]", $slider_category_final);
							}

			header("Location:?page=".$_REQUEST['page'] ."&saved=true");

		die;
}
?>