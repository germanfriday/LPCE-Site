<?php
/* 
* rt-theme product list
*/
//taxonomy
$taxonomy	= 'product_categories';
$term_slug	= get_query_var('term');
$term		= get_term_by( 'slug', $term_slug, $taxonomy, 'true', '' );
$term_id	= $term->term_id;

get_header();
?>

	<div class="sub_header"> 
	
	<div class="left">
	<!-- Page Title -->
		<h2><?php echo $term->name;?></h2> 
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
	
	<!--  left side content -->	
	<div class="content sub"> 
		<?php if($term->description):?>
		<?php if (preg_match("/\[slider\]/", $term->description)):?>
			<?php echo do_shortcode($term->description);?> 
		<?php else:?>
			<?php  echo apply_filters('the_content',($term->description));?>
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
					'orderby'=> get_option('rttheme_product_list_orderby'),
					'order'=> get_option('rttheme_product_list_order'),
					'posts_per_page'=>get_option('rttheme_product_list_pager'), 
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
		<?php include(get_template_directory()."/sidebar.php"); ?>
	</div>
	<!-- / side bar -->

</div>
<!-- content -->    
<?php get_footer();?>