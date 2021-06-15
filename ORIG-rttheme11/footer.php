<?php
if(get_option('rttheme_banner_slogan') || get_option('rttheme_banner_button_text')):
?>
<div class="line"></div>
<!-- banner bar with button 
<div id="footer-banner" class="banner">
	
	<?php
	
	//button link
	if(get_option('rttheme_banner_button_link')) $b_link=get_option('rttheme_banner_button_link');
	else $b_link="#";

	$button_text=get_option('rttheme_banner_button_text');
	?>
	<?php if($button_text):?>
	    <a href="<?php echo $b_link;?>" title="" class="banner_button align right"><?php echo $button_text;?></a>
	<?php endif;?>
	
	<?php echo get_option('rttheme_banner_slogan');?>
</div>
 / banner bar with button 
<?php endif;?>
<div class="line"></div>-->

<!-- footer -->
<div id="footer">
 
	<!-- copyright text -->
	<div class="part1">
	    <?php echo do_shortcode(get_option('rttheme_footer_copy')); ?>
	</div>

	<!-- links -->
	<div class="part2">	    
	    <?php
	    
	    //footer menu parameters
	    $footer_menu=array(
		'menu' => 'RT Theme Footer Navigation Menu',
		'depth'=> 1,
		'echo' => false,
		'menu_class'      => '', 
		'menu_id'         => '',
		'container'       => '', 
		'container_class' => '', 
		'container_id'    => '', 
		'fallback_cb' => ''
	    );
	    
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