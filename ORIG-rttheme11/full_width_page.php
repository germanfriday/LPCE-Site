<?php
/*
Template Name: Full Width Page
*/
get_header();
?>

    <div class="sub_header"> 
	
	<div class="left">
	<!-- Page Title -->
		<h2><?php the_title(); ?></h2>
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

 
    <!-- full side content -->
    <div class="content sub full">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 
	    <?php the_content(); ?>
 
	<?php endwhile;?>
 
	<?php else: ?>
		<p><?php _e( 'Sorry, no page found.', 'rt_theme' ); ?></p>
	<?php endif; ?>
   
    </div>
   <!-- / full side content -->
    
    
</div>
<!-- content -->
  
<?php get_footer();
?>