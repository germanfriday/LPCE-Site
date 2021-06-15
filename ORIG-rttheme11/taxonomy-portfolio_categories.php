<?php
/* 
* rt-theme product list
*/
//taxonomy
$taxonomy = 'portfolio_categories';
$term = get_query_var($taxonomy);
$prod_term = get_terms($taxonomy, 'slug='.$term.''); 
$term_slug = $prod_term[0]->slug;
get_header();
?>

<div class="sub_header"> 
    
    <div class="left">
    <!-- Page Title -->
	    <h2><?php echo $prod_term[0]->name;?></h2>
    <!-- / Page Title -->
    
    <!-- Page navigation-->
	    <div class="breadcrumb"><?php rt_breadcrumb($prod_term[0]->ID); ?></div>
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
 	
	<!-- Start Porfolio Items -->
	
	<div class="portfolio_wrapper">	

	
		<?php if($prod_term[0]->description):?>
		<div class="content sub full">
		    <?php echo wpautop(do_shortcode($prod_term[0]->description));?> 
		</div>
		<div class="line margin"></div>
		<?php endif;?>
	       
		<?php
			//page
			if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
			//taxonomy
			$this_term = get_query_var('portfolio_categories');
						
			$args=array(
			'post_type'=> 'portfolio',
			'portfolio_categories'=> $this_term,
			'post_status'=> 'publish',
			'orderby'=> get_option('rttheme_portf_list_orderby'),
			'order'=> get_option('rttheme_portf_list_order'),
			'posts_per_page'=>get_option('rttheme_portf_pager'), 
			'caller_get_posts'=>1,
			'paged'=>$paged,
			'cat' => -0,
		);
		?>
	<?php get_template_part( 'portfolio_loop', 'portfolio_categories' );?>
	</div>
</div>
<!-- content -->
<?php get_footer();?>