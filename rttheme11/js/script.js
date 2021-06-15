//home page slider

var rttheme_effect_options = jQuery("meta[name=rttheme_effect_options]").attr('content');
var rttheme_slider_time_out = jQuery("meta[name=rttheme_slider_time_out]").attr('content');
var rttheme_slider_numbers = jQuery("meta[name=rttheme_slider_numbers]").attr('content');
var rttheme_template_dir = jQuery("meta[name=rttheme_template_dir]").attr('content');
        
var showEffect;
jQuery.each(jQuery.browser, function(i) {
         if(jQuery.browser.msie){
              showEffect = 'false';
         }
});

jQuery(document).ready(function(){
	var slider_area;
	var slider_buttons;

	// Which slider
	if (jQuery('#slider_area').length>0){
		
		// Home Page Slider
		slider_area="#slider_area";	
		slider_buttons="#numbers";	
	
		jQuery(slider_area).cycle({                        
      fx:    rttheme_effect_options, 
			timeout:  rttheme_slider_time_out,
			easing: 'backout', 
			prev: '.prev', 
			next: '.next',
			cleartype:  1,
			pause:           true,     // true to enable "pause on hover"
			pauseOnPagerHover: true,   // true to pause when hovering over pager link				
			before:  onBefore, 
			after:   onAfter ,				
			pagerAnchorBuilder: function(idx) { 
				return '<a href="#" title=""><img src="'+rttheme_template_dir+'/images/pixel.gif" width="14" heigth="14"></a>'; 
			}
		});
		
	} 

	if (jQuery('.sub_slider').length>0){
		
		// Sub Page Slider
		sub_slider_area=".sub_slider";	

		jQuery(sub_slider_area).cycle({ 
			fx:     'fade', 
			timeout:  rttheme_slider_time_out,
			pager:'.sub_slider_pager',
			cleartype:  1
		});
		
	}
        
	
      jQuery('.prev, .next').css({opacity:0});
      jQuery('#slider').hover(function()
      {
              jQuery('.prev, .next').stop().animate({opacity:1},400);
      },
      function()
      {
              jQuery('.prev, .next').stop().animate({opacity:0},400);
      });


	function onBefore() {
		if (showEffect!="false"){
			jQuery('.desc').stop().animate({opacity:0},0);
		}else{
				
		}
	} 
	function onAfter() {
		if (showEffect!="false"){
			jQuery('.desc').stop().animate({opacity:1},400);
		}else{
				
		}			
	}
	
});


//pretty photo
jQuery(document).ready(function(){
        jQuery("a[rel^='prettyPhoto']").prettyPhoto({animationSpeed:'slow',theme:'light_rounded',slideshow:false,overlay_gallery: false,social_tools:false,deeplinking:false});
});  
 
 
//validate contact form
jQuery(document).ready(function(){

      // show a simple loading indicator

      
         var loader = jQuery('<img src="'+rttheme_template_dir+'/images/loading.gif" alt="loading..." />')
         
              .appendTo(".loading")
              .hide();
      jQuery().ajaxStart(function() {
              loader.show();
      }).ajaxStop(function() {
              loader.hide();
      }).ajaxError(function(a, b, e) {
              throw e;
      });
      
      jQuery.validator.messages.required = "";
      var v = jQuery("#validate_form").validate({
              submitHandler: function(form) {
                      jQuery(form).ajaxSubmit({
                              target: "#result"
                      });
              }
      });
      
      jQuery("#reset").click(function() {
              v.resetForm();
      });
 });



//cufon fonts
var rttheme_disable_cufon= jQuery("meta[name=rttheme_disable_cufon]").attr('content');
         if(rttheme_disable_cufon!='true') {
         jQuery(document).ready(function(){
                Cufon.replace('h1,h2,h3,h4,h5,h6,.title,.title a,.subtitle, .subtitle a, .banner, a.banner_button', {hover: true});
         });
}	
	 
 
//drop down menu
jQuery(document).ready(function() {
	jQuery("#navigation li").each(function()
	{   
            jQuery(this).hover(function()
            {	
                       jQuery(this).find('ul:first').stop().css({
                             paddingTop:"8px",                              
                             height:"auto",
                             overflow:"hidden",
                             display:"none"
                             }).slideDown(200, function()
                       {
                       jQuery(this).css({
                             height:"auto",
                             overflow:"visible"
                       });
            });
                       
            },
            
            function()
            {	
                 jQuery(this).find('ul:first').stop().slideUp(200, function()
                 {	
                         jQuery(this).css({
                          display:"none",
                          overflow:"hidden"
                          });
                 });
            });	
	});
        
        jQuery("#navigation ul ").css({
            display: "none"}
         ); 
});


//search field function
jQuery(document).ready(function() {
	var search_text=jQuery(".search_bar .search_text").val();

	jQuery(".search_bar .search_text").focus(function() {
		jQuery(".search_bar .search_text").val('');
	})
});
	 

//preloading 
jQuery(function () {
	//jQuery('.preload').hide();//hide all the images on the page
	jQuery('.play,.magnifier').css({opacity:0});
	jQuery('.preload').css({opacity:0});
	jQuery('.preload').addClass("animated");
	jQuery('.play,.magnifier').addClass("animated_icon");
});


var i = 0;//initialize
var cint=0;//Internet Explorer Fix
jQuery(window).bind("load", function() {//The load event will only fire if the entire page or document is fully loaded
	var cint = setInterval("PreImage(i)",70);//500 is the fade in speed in milliseconds
});

function PreImage() {
	var images = jQuery('.preload').length;//count the number of images on the page
	if (i >= images) {// Loop the images
		clearInterval(cint);//When it reaches the last image the loop ends
	}
	//jQuery('.preload:hidden').eq(i).fadeIn(500);//fades in the hidden images one by one
	jQuery('.animated_icon').eq(0).animate({opacity:1},{"duration": 500});
	jQuery('.animated').eq(0).animate({opacity:1},{"duration": 500});
	jQuery('.animated').eq(0).removeClass("animated");
	jQuery('.animated_icon').eq(0).removeClass("animated_icon");
	i++;//add 1 to the count
}

//image effects 
jQuery(document).ready(function(){
         var image_e= jQuery(".image.portf, .image.product_image");
         image_e.mouseover(function(){jQuery(this).stop().animate({ opacity:0.7
                         }, 400);
         }).mouseout(function(){
                 image_e.stop().animate({ 
                         opacity:1
                         }, 400 );
         });
});


//Coda slider on product detail page
jQuery(document).ready(function() {
  if (jQuery('#product-slider').length>0){	
        jQuery('#product-slider').codaSlider(
                {
                dynamicArrows: false,
                dynamicTabsAlign: "left",
                dynamicTabsPosition: "top"
                }
        );
  }
});
