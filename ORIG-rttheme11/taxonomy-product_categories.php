<?php
/* 
* rt-theme product list
*/
//taxonomy
$taxonomy = 'product_categories';
$term = get_query_var($taxonomy);
$prod_term = get_terms($taxonomy, 'slug='.$term.''); 
$term_slug = $prod_term[0]->slug;
$term_id = $prod_term[0]->term_id;
get_header();
?>

    <div class="sub_header"> 
	
	<div class="left">
	<!-- Page Title -->
		<h2><?php echo $prod_term[0]->name;?></h2>
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
    
	<!--  left side content -->	
	<div class="content sub"> 
	       <?php if($prod_term[0]->description):?>			
			<?php if (preg_match("/\[slider\]/", $prod_term[0]->description)):?>
				<?php echo do_shortcode($prod_term[0]->description);?> 
			<?php else:?>
				<p><?php echo do_shortcode($prod_term[0]->description);?></p>
			<?php endif;?>
	       <div class="line nomargin"></div>
	       <?php endif;?>
	       
		<div class="product_list">
		       <?php
			       //page
			       if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
			       //this term
			       $this_term = get_query_var('product_categories');
						       
			       $args=array(
			       'post_type'=> 'products',
			       'product_categories'=> $this_term ,
			       'post_status'=> 'publish',
			       'orderby'=> 'menu_order',
			       'posts_per_page'=>get_option('rttheme_product_list_pager'),
			       'caller_get_posts'=>1,
			       'paged'=>$paged,
			       'cat' => -0,
		       );
		       ?>
	       <?php get_template_part( 'product_loop', 'product_categories' );?>
	       </div>
	
	
	</div>
	<!-- / left side content -->
	
	<!-- side bar -->
	<div class="sidebar">
	   <?php include(TEMPLATEPATH."/sidebar.php"); ?>
	</div>
	<!-- / side bar -->
	   
</div>
<!-- content -->    
<?php get_footer();?>