<?php
/* RT-Theme Shortcodes */ 


/*using shortcodes in widgets*/

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

//shortcodes 

//Social Media Holder 
function rt_social_media( $atts, $content = null ) {
	//[social_media]
	$rt_photo_gallery='<div class="social_media_icons">';
	$rt_photo_gallery .= do_shortcode(strip_tags($content));
	$rt_photo_gallery.='<div class="clear"></div></div>';
	return $rt_photo_gallery;
}

//Social Media Icons
function rt_social_media_links( $atts, $content = null ) {
	//[media name="" url=""]
	
	//clear p tag
	$content = preg_replace('#^<\/p>|<p>$#', '', trim($content));	 
	return '<a href="'.trim($atts["url"]).'" title="'.trim($atts["name"]).'" target="_blank"><img src="'.get_template_directory_uri().'/images/social_media/'.trim($atts["name"]).'.png" alt="'.trim($atts["name"]).'" /></a>';
}

add_shortcode('social_media', 'rt_social_media');
add_shortcode('media', 'rt_social_media_links');


/*
* ------------------------------------------------- *
*		pull qoutes		
* ------------------------------------------------- *		
*/
function rt_highlights( $atts, $content = null ) {
	// [hlight red - yellow - black][/hlight]
	$class = "";

	//class
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);		
	}else{
		$class="htext";
	}
  
	//fix shortcode
	$content = fixshortcode($content);  
	$content = '<span class="'.$class.'">'.trim($content).'</span>';
	 
	return $content;
}
add_shortcode('hlight', 'rt_highlights');


/*
* ------------------------------------------------- *
*		pull qoutes		
* ------------------------------------------------- *		
*/
function rt_pull_quotes( $atts, $content = null ) {
	$class = "";

	// [pullquote pullleft or pullright][/pullquote]
	
	//class
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);		
	}
  
	//fix shortcode
	$content = fixshortcode($content);  
	$content = '<blockquote class="'.$class.'">'.trim($content).'</blockquote>';
	 
	return $content;
}
add_shortcode('pullquote', 'rt_pull_quotes');

/*
* ------------------------------------------------- *
*		lists		
* ------------------------------------------------- *		
*/
function rt_lined_list( $atts, $content = null ) {
	// [list lined - red_arrow - silver_arrow -  blue_arrow][/list]

	$class = "";

	//class
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);		
	}
  
	//fix shortcode
	$content = fixshortcode($content);  
	$content = preg_replace('#<ul>#', '<ul class="'.$class.'">', trim($content));
	 
	return $content;
}

add_shortcode('list', 'rt_lined_list');


/*
* ------------------------------------------------- *
*		PHOTO GALLERY		
* ------------------------------------------------- *		
*/ 
function rt_photo_gallery( $atts, $content = null ) {
	//[photo_gallery]
	$rt_photo_gallery='<ul class="photo_gallery">';
	$rt_photo_gallery .= do_shortcode(strip_tags($content));
	$rt_photo_gallery.='</ul><div class="clear"></div>';
	return $rt_photo_gallery;
}

function rt_photo_gallery_lines( $atts, $content = null ) {
	//[image url="" thumb_width="" thumb_height="" lightbox="" tooltip=""]
	$rt_photo_gallery_lines = "";
	
	//dimension attiributes
	$thumb_width= isset ( $atts["thumb_width"] ) ? trim($atts["thumb_width"]) : "";  
	$thumb_height= isset ( $atts["thumb_height"] ) ? trim($atts["thumb_height"]): "";  
	
	//dimension defaults
	if(!$thumb_width && !$thumb_height):
		$thumb_width="130";
		$thumb_height="100";
	endif;
 
 	//lightbox = default is true
	$lightbox= isset ( $atts["lightbox"] ) ? trim($atts["lightbox"]): "";  
	if($lightbox=="") $lightbox='rel="prettyPhoto[rt_theme_thumb]"';

	//title
	$title= isset ( $atts["title"] ) ? trim($atts["title"]): "";  
	
	//tooltip - default is true
	$tooltip= isset ( $atts["tooltip"] ) ? trim($atts["tooltip"]): "";  
	if(!$tooltip): $tooltip ='title="'.$title.'"'; $title ='title=""';
	else: $title ='title="'.$title.'"';
	endif;
 
	$photo=trim($content);
	
	//link - default is image
	$photo_link= isset ( $atts["url"] ) ? trim($atts["url"]): "";  
	if (!$photo_link) $photo_link=trim($content);

	// Resize Image
	$imgURL   = find_image_org_path(trim($photo));
	$crop 	= true;
	if($imgURL) $image_thumb = @vt_resize( '', $imgURL,$thumb_width, $thumb_height, ''.$crop.'' );	
			
	$rt_photo_gallery_lines.='<li><a href="'.$photo_link.' " '.$title.'  '.$lightbox.' ><img src="'.$image_thumb["url"].'" '.$tooltip.' class="image portf preload" /></a></li>';
	
	return $rt_photo_gallery_lines;
}	

add_shortcode('photo_gallery', 'rt_photo_gallery');
add_shortcode('image', 'rt_photo_gallery_lines');

 
/*
* ------------------------------------------------- *
*	Auto Thumbnails & Lightboxes	
* ------------------------------------------------- *		
*/ 
function rt_auto_thumb( $atts, $content = null ) {
	//[auto_thumb width="" height="" link="" lightbox="" align="" title="" alt="" iframe="" tooltip=""]
 
	$fix_width = "";
	$fix_width_2 = "";
	
	//clear p and br tags
	$content = preg_replace('#^<\/p>|<p>$#', '', trim($content));
	$content = preg_replace('#^<p>|<\/p>$#', '', trim($content));
	$content = preg_replace('#^<br />$#', '', trim($content));
	
	//lightbox
	$lightbox=trim($atts["lightbox"]);
	if($lightbox!="no") $lightbox="yes";
	if($lightbox=="yes") $lightbox='rel="prettyPhoto[rt_theme_thumb]"';	
	
	//link
	$link= isset($atts["link"]) ? trim($atts["link"]) : "";	
		
 	//if it's not a video
	if($link=="") $link=$content;
	
	/* icon */
	if (preg_match("/(png|jpg|gif)/",  trim($link) )) {
		$icon="magnifier";
	} else {
		$icon="play";
	}
 
	
	//other attiributes
	$width= isset ($atts["width"]) ? trim($atts["width"]) : "";  
	$height= isset ($atts["height"]) ? trim($atts["height"]) : "";  


	$align= isset ($atts["align"]) ? trim($atts["align"]) : "";
	if(!$align) $align='left';
	
	$alt= isset ($atts["alt"]) ? trim($atts["alt"]) : "";
	$title= isset ($atts["title"]) ? trim($atts["title"]) : "";
	
	
	//tooltip
	$tooltip=isset ($atts["tooltip"]) ? trim($atts["tooltip"]) : "";
	if($tooltip): $tooltip ='title="'.$title.'"'; $title ='title=""';
	else: $title ='title="'.$title.'"';
	endif;
	
	//iframe
	$iframe =isset ($atts["iframe"]) ? trim($atts["iframe"]) : "";
	if ($iframe && $iframe!="false") $iframe= "?iframe=true&width=100%&height=100%";
	if (preg_match("/(mov|avi|swf|vimeo|youtube|screenr)/",  trim($link))): $iframe= ""; else: if($iframe && trim($atts["link"])) $icon="";endif;
	
	//fix the width for center align
	if ($align=="center"): $fix_width='<table class="nomargin"><tr><td>'; $fix_width_2='</td></tr></table>';endif;

	// Resize Image
	$imgURL   = find_image_org_path(trim($content));
	$crop 	= true;
	if($imgURL) $image_thumb = @vt_resize( '', $imgURL,$width, $height, ''.$crop.'' );
	
	//result
	if (trim($content)): 
	$rt_auto_thumb=''.$fix_width.'<div class="rt_auto_thumb imgarea '.$align.' '.$icon.'"  >';	
	$rt_auto_thumb.='<a href="'.$link.''.$iframe.'" '.$title.'  '.$lightbox.' ><img src="'.$image_thumb["url"].'" alt="'.$alt.'" '.$tooltip.' class="image portf preload rt_auto_thumb_tooltip" /></a>';	
	$rt_auto_thumb.='</div>'.$fix_width_2.'';
	else:
	$rt_auto_thumb.='<a href="'.$link.''.$iframe.'" title="'.trim($atts["title"]).'"  '.$lightbox.' >'.trim($atts["title"]).'</a>';
	endif;
 
	
	return $rt_auto_thumb;
}

add_shortcode('auto_thumb', 'rt_auto_thumb');



/*
* ------------------------------------------------- *
*		Fix shortcodes
* ------------------------------------------------- *
*/

function fixshortcode($content){

	//remove invalid p
 
	$content = preg_replace('#^<\/p>|<p>$#', '', trim($content));
	
	//fix line shortcode	
	$content = preg_replace('#<p>\n<div class="line margin#', '<div class="line margin', trim($content));

	$array = array (
	    '<p>[' => '[', 
	    ']</p>' => ']', 
	    ']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;

}



/*
* ------------------------------------------------- *
*
*
*		COLUMNS
*		
* ------------------------------------------------- *		
*/


 
/*
* ------------------------------------------------- *
*		two column
* ------------------------------------------------- *
*/

function rt_shortcode_two_column( $atts, $content = null ) {
	$clear = "";
	$class = "";

	//left side
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);
		if (trim($atts[0])=="last") $clear='<div class="clear"></div>';
	}
	
	$content = do_shortcode(fixshortcode($content));
 
	return '<div class="box two-col '.$class.'">' . $content . '</div>'.$clear;
	
}

add_shortcode('two_column', 'rt_shortcode_two_column');

/*
* ------------------------------------------------- *
*		three column
* ------------------------------------------------- *
*/

function rt_shortcode_three_column( $atts, $content = null ) {
	$clear = "";
	$class = "";

	//left side
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);
		if (trim($atts[0])=="last") $clear='<div class="clear"></div>';
	}

	
	$content = do_shortcode(fixshortcode($content));	
 
	return '<div class="box three-col '.$class.'">' . do_shortcode($content) . '</div>'.$clear;
	
}

add_shortcode('three_column', 'rt_shortcode_three_column');



/*
* ------------------------------------------------- *
*		four column
* ------------------------------------------------- *
*/

function rt_shortcode_four_column( $atts, $content = null ) {
	$clear = "";
	$class = "";

	//left side
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);
		if (trim($atts[0])=="last") $clear='<div class="clear"></div>';
	}
	
	$content = do_shortcode(fixshortcode($content));
	
	return '<div class="box four-col '.$class.'">' . do_shortcode($content) . '</div>'.$clear;
	
}

add_shortcode('four_column', 'rt_shortcode_four_column');


/*
* ------------------------------------------------- *
*		one half column
* ------------------------------------------------- *
*/

function rt_shortcode_onehalf_column( $atts, $content = null ) {
	$clear = "";
	$class = "";

	//left side
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);
		if (trim($atts[0])=="last") $clear='<div class="clear"></div>';
	}
	
	$content = do_shortcode(fixshortcode($content));
	
	return '<div class="box one-half-col '.$class.'">' . do_shortcode($content) . '</div>'.$clear;
	
}

add_shortcode('onehalf_column', 'rt_shortcode_onehalf_column');



/*
* ------------------------------------------------- *
*		Lines
* ------------------------------------------------- *
*/

function rt_shortcode_lines( $atts, $content = null ) {
	//[line toplink="top"]
	if (isset($atts["toplink"]) && trim($atts["toplink"])){
		$line='<div class="line margin"><a href="#" class="top">['.$atts["toplink"].']</a></div>';
	}else{
		$line = '<div class="line margin"></div>';
	}
	
	return $line;
	
}

add_shortcode('line', 'rt_shortcode_lines');





//contact form 
function rt_shortcode_contact_form( $atts, $content = null ) {
$contact_form = ""; 
if(isset($atts['title'])) $contact_form= '<h3>'.$atts['title'].'</h3>';
if(isset($atts['text'])) $contact_form.= '<p><i>'.$atts['text'].'</i></p>';

if(isset($atts['email'])){

$contact_form.= "".    
	'<!-- contact form -->'.
	'<div id="result"></div>'.
	'<div id="contact_form">'.
	'	<form action="'.get_template_directory_uri().'/contact_form.php" name="contact_form" id="validate_form" method="post">'.
	'		<ul>'.
	'			<li><label for="name">'.__('Your name: (*)','rt_theme').'</label><input id="name" type="text" name="name" value="" class="required" /> </li>'.
	'			<li><label for="email">'.__('Your Email: (*)','rt_theme').'</label><input id="email" type="text" name="email" value="" class="required"	 /> </li>'.
	'			<li><label for="phone">'.__('Phone Number: (*)','rt_theme').' </label><input id="phone" type="text" name="phone" value="" class="required" /> </li>'.
	'			<li><label for="company_name">'.__('Company Name:','rt_theme').' </label><input id="company_name" type="text" name="company_name" value="" /> </li>'.
	'			<li><label for="company_url">'.__('Company URL:','rt_theme').' </label><input id="company_url" type="text" name="company_url" value="" /> </li>'.
	'			<li><label for="message">'.__('Your message: (*)','rt_theme').'</label><textarea  id="message" name="message" rows="8" cols="40"	class="required"></textarea></li>'.
	'			<li>'.
	'			<input type="hidden" name="your_email" value="'.trim($atts['email']).'">'.
	'			<input type="hidden" name="your_web_site_name" value="'.get_bloginfo('name').'">'.
	
	'			<input type="hidden" name="text_1" value="'.__('Thanks','rt_theme').'">'.	
	'			<input type="hidden" name="text_2" value="'.__('Your email was successfully sent. We will be in touch soon.','rt_theme').'">'.	
	'			<input type="hidden" name="text_3" value="'.__('There was an error submitting the form.','rt_theme').'">'.	
	'			<input type="hidden" name="text_4" value="'.__('Please enter a valid email address!','rt_theme').'">'.
	
	'			<input type="submit" class="button" value="'.__('Send','rt_theme').'"  /><span class="loading"></span></li>'.
	'		</ul>'.
	'	</form>'.
	'</div>'.
	'<!-- /contact form -->';

 
	
}else{
	$contact_form="ERROR: This shortcode is not contains an email attribute!";
}

return $contact_form;
}

add_shortcode('contact_form', 'rt_shortcode_contact_form');





/*
* ------------------------------------------------- *
*		Image Slider
* ------------------------------------------------- *
*/
    	


function rt_shortcode_slider( $atts, $content = null ) {
	//[slider][/slider]

	//fix content
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));
	
 	$content = wpautop(do_shortcode($content));
	$content = fixshortcode($content);
	
	return '<div class="sub_slider_con"><div class="sub_slider_pager"></div><div class="sub_slider">' . trim($content) . '</div></div>';
}

function rt_shortcode_slider_slides( $atts, $content = null ) {
 
	//[slide image_width="" image_height="" link="" alt_text="" auto_resize=""]


	//fix content
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));	
	
	//dimensions
	$image_width=trim($atts["image_width"]);
	$image_height=trim($atts["image_height"]);
	$link=trim($atts["link"]);
	$alt_text=trim($atts["alt_text"]);
	$auto_resize=trim($atts["auto_resize"]);
 
	if($link){
		$link1='<a href="'.$link.'">';
		$link2='</a>';
	}

	// Resize Image
	$imgURL   = find_image_org_path(trim($content));
	$crop 	= true;
	if($imgURL) $image_thumb = @vt_resize( '', $imgURL,$image_width, $image_height, ''.$crop.'' );
	
	
	$slide='<div class="sub_slide">';	
	
	if($auto_resize=="true"){
	$slide.=$link1.'<img src="'.$image_thumb["url"].'" width="'.$image_width.'" height="'.$image_height.'" alt="'.$alt_text.'" />'.$link2;
	}else{
	$slide.=$link1.'<img src="'.$content.'" width="'.$image_width.'" height="'.$image_height.'" alt="'.$alt_text.'" />'.$link2;
	}
	$slide.='</div>';
	
	return $slide;
}





add_shortcode('slider', 'rt_shortcode_slider');
add_shortcode('slide', 'rt_shortcode_slider_slides');


/*
* ------------------------------------------------- *
*		buttons
* ------------------------------------------------- *
*/

function rt_shortcode_buttons( $atts, $content = null ) {
	//[button size="" link="" title="" align=""][/button]
	
	//parameters
	
	$size=trim($atts["size"]);
	if(!$size || $size=="big")  $size="banner_button";
	else $size="small_button";
	
	$link=trim($atts["link"]);
	if(!$link)  $link="#";
	
	$align='align'.trim($atts["align"]);
	
	$title=trim($atts["title"]);

	//fix shortcode
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content)); 

 
	return '<a href="'.$link.'" title="'.$title.'" class="'.$size.' '.$align.'">' . $content . '</a>';
}

add_shortcode('button', 'rt_shortcode_buttons');



/*
* ------------------------------------------------- *
*		Info Table
* ------------------------------------------------- *
*/

function rt_shortcode_info_table( $atts, $content = null ) {
	//[infotable][/infotable]
 
	//fix shortcode
	$content = apply_filters('the_content',$content);
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content)); 

	return '<table class="product_data">' . $content . '</table>';
}

function rt_shortcode_info_table_rows( $atts, $content = null ) {
	//[row label="" value=""] 
 
	//parameters
 	$label=trim($atts["label"]);
	$value=trim($atts["value"]);
	
	//fix shortcode
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content)); 

	return '<tr><td class="left">' . $label . '</td><td>:</td><td>' . $value . '</td></tr>';
}

add_shortcode('infotable', 'rt_shortcode_info_table');
add_shortcode('row', 'rt_shortcode_info_table_rows');



/*
* ------------------------------------------------- *
*		show shortcode :)
* ------------------------------------------------- *
*/

function rt_shortcode_show_shortcode( $atts, $content = null ) {
 
	//convert html [] spacial chars  

	//fix shortcode
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));
	$content = preg_replace('#\[\/braket_close\]#', "[/show_shortcode]",trim($content));

	
	return '<code>' . htmlspecialchars($content) . '</code>';
}

add_shortcode('show_shortcode', 'rt_shortcode_show_shortcode');


?>