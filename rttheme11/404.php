<?php
/* 
* rt-theme 404 
*/
get_header();
?>

    <div class="sub_header"> 
	
	<div class="left">
	<!-- Page Title -->
		<h2><?php wp_title(); ?></h2>
	<!-- / Page Title -->
	
	<!-- Page navigation-->
		<div class="breadcrumb"><?php rt_breadcrumb(); ?></div>
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

 
    <!-- full side content -->
    <div class="content sub full">
 
	 <h3><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'rt_theme' ); ?></h3>
	
    </div>
   <!-- / full side content -->
    
    
</div>
<!-- content -->
  
<?php get_footer();
?> 