<?php
//page link
$link_page=get_permalink(get_option('rttheme_blog_page'));

//category link
$category_id = get_the_category($post->ID);
$category_id = $category_id[0]->cat_ID;//only one category can be show in the list  - the first one
$link_cat=get_category_link($category_id); 

get_header();
?>

    <div class="sub_header"> 
	
	<div class="left">
	<!-- Page Title -->
		<h2><?php the_title(); ?></h2>
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
    
    <!-- left side content -->
    <div class="content sub">
 

		<?php if (have_posts()) : while (have_posts()) : the_post();
		$current_post=$post->ID;
		?>

		<!-- blog box-->
		<div id="post-<?php the_ID(); ?>" <?php post_class("blog"); ?>>
 
		<?php if(has_post_thumbnail()):
		  //get the image url
		  $image_id  = get_post_thumbnail_id();
		  $image_url = wp_get_attachment_image_src($image_id,'large', true);
		  $image_url = $image_url[0];
		?>
		<!-- blog image-->
			<a href="<?php echo $image_url; ?>" title="<?php the_title(); ?>" rel="prettyPhoto[product]" >				
					<?php											
					if(!get_option('rttheme_blog_resize'))://RT-Theme resize option is enabled						
							// Resize Image
							$imgURL = find_image_org_path($image_url);
							$crop   = true;
							if($imgURL) $image_thumb = @vt_resize( '', $imgURL, 680, 130, ''.$crop.'' );				
					?>							
							<img src="<?php echo $image_thumb["url"];?>" alt="<?php the_title(); ?>" class="aligncenter" />							
					<?php else://use the post thumbnail ?>
							<img src="<?php echo $image_url;?>" alt="<?php the_title(); ?>" class="aligncenter" />
					<?php endif;?>
			</a>	
		<!-- / blog image -->
		<?php endif;?>

				 
		<!-- blog text-->		 
		<?php echo the_content(); ?> 	
		<?php wp_link_pages(); ?>	 
		<!-- /blog text-->
		<div class="line nomargin"></div>
 
 
		<!-- date and cathegory bar -->
		<div class="dateandcategories">
		    <?php _e('On','rt_theme'); ?> <?php the_time('F jS, Y') ?>,
			<b><?php _e('posted in:','rt_theme'); ?></b> <?php the_category(', ') ?>
			<?php _e('by','rt_theme'); ?> <?php the_author_posts_link(); ?>
			<?php echo the_tags( '<span class="comment">', ', ', '</span>');?>
		</div>
		<!-- / date and cathegory bar -->
		
		</div>
		<!-- blog box-->
		
		<div class="line margin"></div> 
			     
			     
		<?php endwhile; ?>
		<?php else: ?>
			<p><?php _e( 'Sorry, no page found.', 'rt_theme' ); ?></p>
		<?php endif; ?>

	<div class="clear"></div>
	<div class='entry commententry'>
	    <?php comments_template(); ?>
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