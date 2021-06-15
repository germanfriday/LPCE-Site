<?php
/* 
* rt-theme home page 
*/
get_header();  
?>
<!-- banner bar with button -->
<div class="banner" style="margin-top: -30px; margin-bottom: -2px;">
	
	<?php
	
	//button link
	if(get_option('rttheme_banner_button_link')) $b_link=get_option('rttheme_banner_button_link');
	else $b_link="#";

	$button_text=get_option('rttheme_banner_button_text');
	?>
	<?php if($button_text):?>
	    <a href="<?php echo $b_link;?>" title="" style="width: 120px;" class="banner_button alignright"><?php echo $button_text;?></a>
	<?php endif;?>
	
	<?php echo get_option('rttheme_banner_slogan');?>
</div>
<!-- / banner bar with button -->
<?php if(!get_option("rttheme_remove_slider")):?>
<!-- slider area -->	
<div id="slider">
    <?php if(!get_option('rttheme_slider_numbers')):?> 
    <!-- prev & next buttons -->
    <div id="numbers">
	<div class="prev"><img src="<?php bloginfo('template_directory'); ?>/images/<?php echo $which_theme;?>/slider_left.gif" alt="" /></div>
	<div class="next"><img src="<?php bloginfo('template_directory'); ?>/images/<?php echo $which_theme;?>/slider_right.gif" alt="" /></div>
    </div>
    <!-- / prev & next buttons -->
    <?php endif;?>
	
    <div id="slider_area">

	<?php
	//Home Page Content
	if (function_exists('dynamic_sidebar')){
		dynamic_sidebar('Home Page Slider');
	}
	?>
	
    </div>
    
</div>
<!-- / slider -->
<div class="line margin"></div>
<?php endif;?>
<div id="main">
    
<!-- featured boxes -->
<?php
//Home Page Content
if (function_exists('dynamic_sidebar')){
	dynamic_sidebar('Home Page Contents');
}
?>
<!-- /featured boxes -->


<div class="clear"></div>
</div>

<?php get_footer();?>