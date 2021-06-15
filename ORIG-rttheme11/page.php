<?php
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

<?php if($post->ID != get_option('rttheme_portf_page')):?> 
    <!-- left side content -->
    <div class="content sub">
<?php endif;?>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	    <?php if($post->ID == get_option('rttheme_portf_page') && get_the_content()):?><div class="content sub full"><?php endif; //portfolio start page?>
	
	    <?php the_content(); ?>
	
	    <?php if($post->ID == get_option('rttheme_portf_page') && get_the_content()):?><div class="line margin"></div></div><?php endif; //portfolio start page?>
	 
	<?php endwhile;?>
	
	    <?php
	    /*
	    *  Products Start Page     
	    */
    
	    if($post->ID == get_option('rttheme_product_list') && !get_option("rttheme_products_first_page_hide") ):
	    ?>

	    <?php
	    $product_page_content=get_the_content();
	    
	    if(trim($product_page_content)):?>			
	    <div class="line nomargin"></div>
	    <?php endif;?>
	       
	       
	    <div class="product_list">
		    <?php
			    //page
			    if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
			    $args=array(
			    'post_type'=> 'products',
			    'product_categories'=> get_option('rttheme_product_start_cat'),
			    'post_status'=> 'publish',
			    'orderby'=> get_option('rttheme_product_list_orderby'),
			    'order'=> get_option('rttheme_product_list_order'),
			    'posts_per_page'=>get_option('rttheme_product_list_pager'), 
			    'paged'=>$paged,
		    );
		    ?>
	    <?php get_template_part( 'product_loop', 'product_categories' );?>
	    </div>
	    <?php endif;?>


	    <?php
	    /*
	    *  Portfolio Start Page     
	    */
    
	    if($post->ID == get_option('rttheme_portf_page') && !get_option("rttheme_portf_first_page_hide") ):
	    ?>
	    <div class="portfolio_wrapper">
		
		    <?php
			    //page
			    if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
			    $args=array(
			    'post_type'=> 'portfolio',
			    'portfolio_categories'=> get_option('rttheme_portf_start_cat'),
			    'post_status'=> 'publish',
			    'orderby'=> get_option('rttheme_portf_list_orderby'),
			    'order'=> get_option('rttheme_portf_list_order'),
			    'posts_per_page'=>get_option('rttheme_portf_pager'), 
			    'paged'=>$paged,
		    );
		    ?>
	    <?php get_template_part( 'portfolio_loop', 'portfolio_categories' );?>
	    </div>
	    <?php endif;?>	    

	    <?php
	    /*
	    *  Blog Start Page     
	    */
    
	    if($post->ID == get_option('rttheme_blog_page')):
	    ?>
	    
		
		    <?php
			    //page
			    $query_string = "showposts=".get_option('rttheme_blog_pager')."&cat=".get_option('rttheme_blog_ex_cat[]')."&paged=$paged";
			    
			    if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
			    $args=array(
			    'post_status'=> 'publish',
			    'orderby'=> 'date',
			    'order'=> 'DESC',
			    'cat'=> get_option('rttheme_blog_ex_cat[]'), 
			    'paged'=>$paged,
		    );
		    ?>
		    
	    <?php get_template_part( 'loop', 'archive' );?>
	     
	    <?php endif;?>
	
	<?php else: ?>
		<p><?php _e( 'Sorry, no page found.', 'rt_theme' ); ?></p>
	<?php endif; ?>
   
<?php if($post->ID != get_option('rttheme_portf_page')):?> 
    </div>
   <!-- / left side content -->
   
    <!-- side bar -->
    <div class="sidebar">
	<?php include(TEMPLATEPATH."/sidebar.php"); ?>
    </div>
    <!-- / side bar -->
<?php endif;?>
    
</div>
<!-- content -->
  
<?php get_footer();
?>