<?php
/* 
* rt-theme archive 
*/
get_header();  
?>
    <div class="sub_header"> 
	
	<div class="left">
	<!-- Page Title -->
		<h2><?php wp_title(''); ?></h2>
	<!-- / Page Title -->
	
	<!-- Page navigation-->
		<div class="breadcrumb"><?php  rt_breadcrumb($post->ID); ?></div>
	<!-- /Page navigation-->
	</div>

	<!-- search -->
		<?php rt_search_form();?>
	<!-- / search-->	
	<div class="clear"></div>
    </div>
    <div class="line margin"></div>

<!-- content -->
<div id="main">
 
	<!-- left side content -->
	<div class="content sub">
	 
		<?php get_template_part( 'loop', 'archive' );?>
	
	</div>

	<!-- side bar -->
	<div class="sidebar"> 
	    <?php include(TEMPLATEPATH."/sidebar.php"); ?>
	</div>
	<!-- / side bar -->
    
</div>
<!-- content -->
<?php get_footer();?>