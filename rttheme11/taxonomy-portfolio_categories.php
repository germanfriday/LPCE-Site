<?php
/* 
* rt-theme portfolio list
*/
//taxonomy
$taxonomy  = 'portfolio_categories';
$term_slug = get_query_var('term');
$term      = get_term_by( 'slug', $term_slug, $taxonomy, 'true', '' );
$term_id   = $term->term_id;

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
	
	<!-- Start Porfolio Items -->
	
	<div class="portfolio_wrapper">	

	
		<?php if($term->description):?>
		<div class="content sub full">
			<p><?php  echo apply_filters('the_content',($term->description));?></p>
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
			'paged'=>$paged,
			'cat' => -0,
		);
		?>
	<?php get_template_part( 'portfolio_loop', 'portfolio_categories' );?>
	</div>
</div>
<!-- content -->
<?php get_footer();?>