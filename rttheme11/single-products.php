<?php
/* 
* rt-theme product detail page
*/

//taxonomy
$taxonomy = 'product_categories';

//page link
$link_page=get_permalink(get_option('rttheme_product_list'));

//category link
$terms = get_the_terms($post->ID, $taxonomy);
$i=0;
if($terms){
	foreach ($terms as $taxindex => $taxitem) {
	if($i==0){
		$link_cat=get_term_link($taxitem->slug,$taxonomy);
		$term_slug = $taxitem->slug;
		$term_id = $taxitem->term_id;
		}
	$i++;
	}
}



//check tabbed page?

$embeded_tabs=array('rt_product_video','rt_other_images','rt_chart_file_url','rt_excel_file_url','rt_pdf_file_url','rt_word_file_url');

foreach ($embeded_tabs as $tab_id) {
	if(trim(get_post_meta($post->ID, $tab_id, true))) $tabbed_page="yes";
}

//free tabs count
$tab_count=2;
for($i=0; $i<$tab_count+1; $i++){
	if (trim(get_post_meta($post->ID, 'rt_free_tab_'.$i.'_title', true)))  $tabbed_page="yes";
}

			
get_header();

?>

	<div class="sub_header"> 
	
	<div class="left">
	<!-- Page Title -->
		<h2><?php the_title(); ?></h2>
	<!-- / Page Title -->
	
	<!-- Page navigation-->
		<div class="breadcrumb"><?php  rt_breadcrumb(); ?></div>
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
		
		<?php
		/*
		*
		*	General info tab
		*	
		*/					
		?>
					
		<?php if($tabbed_page):?>
		<!--Product Data Slider-->
		<div class="product-slider-wrapper">
			<div class="line nomargin"></div>
			<div class="product-slider preload" id="product-slider">



					<!--Panel 1 - General Info-->
					<div class="panel">
						   <div class="panel-wrapper">
							<!--tab name-->
							   <h2 class="title"><?php _e('General Info','rt_theme');?></h2>
		<?php endif;?>
							
							
							   <!--product image-->
							<?php
							if(get_post_meta($post->ID, 'rt_product_image_url', true)):?>
							<a href="<?php echo get_post_meta($post->ID, 'rt_product_image_url', true); ?>" title="<?php the_title(); ?>" rel="prettyPhoto[product]">							
								<?php
								// Resize Portfolio Image
								$imgURL = find_image_org_path(get_post_meta($post->ID, 'rt_product_image_url', true));
								$crop 	= true;
								if($imgURL) $image_thumb = @vt_resize( '', $imgURL, 250, 250, ''.$crop.'' );
								?>
								<img src="<?php echo $image_thumb["url"];?>" alt="" class="alignleft" />			
							</a>
							<?php endif;?>
 
							   
							<?php the_content(); ?>
							
							 <div class="clear"></div>
		<?php if($tabbed_page):?>						
						   </div>
					   </div>
					   <!-- / Panel 1 - General Info-->
		<?php endif;?>
		
					
					<?php
					/*
					*
					*	Product Video
					*	
					*/
				
					if(get_post_meta($post->ID, 'rt_product_video', true)):?>	
					   <!--Panel 2 - Product Video -->
					   <div class="panel">
						   <div class="panel-wrapper">
							<!--tab name-->
							   <h2 class="title"><?php _e('Product Video','rt_theme');?></h2>
							   <div style="height:350px;"><!-- Extra div helps us set the correct height when video panel is cross-linked -->
							   
							<?php echo get_post_meta($post->ID, 'rt_product_video', true);?>
							   
							</div>
						   </div>
					   </div>
					   <!--/ Panel 2 - Product Video -->
					   <?php endif;?>

					<?php
					/*
					*
					*	Product Photos
					*	
					*/					
					
					if (trim(get_post_meta($post->ID, 'rt_other_images', true))):?>
					<!-- Panel 3 - Product Photos -->
					<div class="panel">
						<div class="panel-wrapper">
						<!--tab name-->
						<h2 class="title"><?php _e('Product Photos','rt_theme');?></h2>
						<ul class="photos">
						<?php 
						//Other Product Photos
						if (trim(get_post_meta($post->ID, 'rt_other_images', true))){
						$product_photos=explode("\n",  get_post_meta($post->ID, 'rt_other_images', true));
						foreach ($product_photos as $k => $photo_url) {
						if (trim($photo_url)):
						?>
								<?php
								// Resize Image
								$imgURL = find_image_org_path(trim($photo_url));
								$crop   = true;
								$image_thumb = @vt_resize( '', $imgURL, 130, 100, ''.$crop.'' );						 
								?>
								
							<li><a href="<?php echo $photo_url; ?>" title="" rel="prettyPhoto[product]"><img src="<?php echo $image_thumb["url"];?>" alt="" class="image portf" /></a></li>
						<?php endif;}}?>
						</ul>
						</div>
					</div>
					<!-- / Panel 3  - Product Photos  -->
					<?php endif;?>
				
 
 
					<?php
					/*
					*
					*	Product Documents
					*	
					*/
					
					if(get_post_meta($post->ID, 'rt_chart_file_url', true) || get_post_meta($post->ID, 'rt_excel_file_url', true) || get_post_meta($post->ID, 'rt_pdf_file_url', true) || get_post_meta($post->ID, 'rt_word_file_url', true) ):?>
					   <!-- Panel 4 - Product Documents -->
					<div class="panel">
						<div class="panel-wrapper">
							 
							 <!--tab name-->
							<h2 class="title"><?php _e('Documents','rt_theme');?></h2>
							
							 <!--doc icons-->
							 <ul class="doc_icons">
								<?php if(get_post_meta($post->ID, 'rt_chart_file_url', true)):?><li><a href="<?php echo get_post_meta($post->ID, 'rt_chart_file_url', true); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/Chart_1.png" alt="" class="png" /><?php _e('Donwload Charts','rt_theme');?></a></li><?php endif;?>
								<?php if(get_post_meta($post->ID, 'rt_excel_file_url', true)):?><li><a href="<?php echo get_post_meta($post->ID, 'rt_excel_file_url', true); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/File_Excel.png" alt="" class="png" /><?php _e('Download Excel File','rt_theme');?></a></li><?php endif;?>
								<?php if(get_post_meta($post->ID, 'rt_pdf_file_url', true)):?><li><a href="<?php echo get_post_meta($post->ID, 'rt_pdf_file_url', true); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/File_Pdf.png" alt="" class="png" /><?php _e('Download PDF File','rt_theme');?></a></li><?php endif;?>
								<?php if(get_post_meta($post->ID, 'rt_word_file_url', true)):?><li><a href="<?php echo get_post_meta($post->ID, 'rt_word_file_url', true); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/Word.png" alt="" class="png" /><?php _e('Download Word File','rt_theme');?></a></li><?php endif;?>								
							 </ul>
						</div>
					</div>
					<div class="clear"></div>
					<!-- / Panel 4 - Product Photos -->
					<?php endif;?>
						 
					 
					<?php
					/*
					*
					*	Free Tabs
					*	
					*/					
				
					
					for($i=0; $i<$tab_count+1; $i++){ 
						if (trim(get_post_meta($post->ID, 'rt_free_tab_'.$i.'_title', true))){
						  echo '<div class="panel"><div class="panel-wrapper"><h2 class="title">'.get_post_meta($post->ID, 'rt_free_tab_'.$i.'_title', true).'</h2>'.do_shortcode(get_post_meta($post->ID, 'rt_free_tab_'.$i.'_content', true)).'</div></div>';
						}
					}
					
					?>
					 
		
		<?php if($tabbed_page):?>		
			</div>
			<?php if (trim(get_post_meta($post->ID, 'rt_related_products', true))):?><div class="line nomargin"></div><?php endif;?>
 
		</div>
		<!-- / Product Data Slider-->
		<?php endif;?>
			


		<?php
		/*  Related Products */
		
		if (trim(get_post_meta($post->ID, 'rt_related_products', true))):?>
		<!-- Related Products -->                    
		
		<h3><?php _e('Related Products','rt_theme');?></h3>
		
		<div class="product_list">
		<div class="line"></div>                    

			<div class="portfolio_con">
			<?php 
			$product_ids=explode("\n",  get_post_meta($post->ID, 'rt_related_products', true));
			$p_id_list = "";

				foreach ($product_ids as $k => $product_id) {
				if (trim($product_id)):
					$p_id_list.=$product_id.",";  
				endif;
				}
				
				$p_id_list = explode(',',$p_id_list);

				//taxonomy 
				$args=array(
				'post_type'=> 'products', 
				'post_status'=> 'publish',
				'orderby'=> 'menu_order', 
				'post__in' =>$p_id_list
				);
				get_template_part( 'product_loop', 'product_categories' );
			?>
			</div>
		</div>    
		<!-- / Related Products -->
		<?php endif;?>
			
			
			
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