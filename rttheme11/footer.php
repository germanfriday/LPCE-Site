<?php
if(get_option('rttheme_banner_slogan') || get_option('rttheme_banner_button_text')):
?>
<div class="line"></div>
<!-- banner bar with button -->
<div class="banner">
	
	<?php
	
	//button link
	if(get_option('rttheme_banner_button_link')) $b_link=get_option('rttheme_banner_button_link');
	else $b_link="#";

	$button_text=get_option('rttheme_banner_button_text');
	?>
	<?php if($button_text):?>
	    <a href="<?php echo $b_link;?>" title="" class="banner_button alignright"><?php echo $button_text;?></a>
	<?php endif;?>
	
	<?php echo get_option('rttheme_banner_slogan');?>
</div>
<!-- / banner bar with button -->
<?php endif;?>
<div class="line"></div>

<!-- footer -->
<div id="footer">
 
	<!-- copyright text -->
	<div class="part1">
	    <?php echo do_shortcode(get_option('rttheme_footer_copy')); ?>
	</div>

	<!-- links -->
	<div class="part2">	    
	    <?php
	     

	    if ( has_nav_menu( 'rt-theme-footer-navigation' ) ){        
	        $footer_menu=array(          
	            'depth'=> 1,
	            'echo' => false,
	            'theme_location'  => 'rt-theme-footer-navigation' 
	        );
	    }else{
	        $footer_menu=array(
	            'menu' => 'RT Theme Footer Navigation Menu',
	            'depth'=> 1,
	            'echo' => false,
	            'theme_location'  => 'rt-theme-footer-navigation' 
	        );
	    }	    


	    echo wp_nav_menu($footer_menu);				    
	    ?>
	</div>
 
</div>
<!-- /footer -->
</div>

<?php wp_footer();?>
<?php echo get_option('rttheme_anayltics');?>
</body>
</html>
