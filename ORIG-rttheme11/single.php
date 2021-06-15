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
 

		<?php if (have_posts()) : while (have_posts()) : the_post();
		$current_post=$post->ID;
		?>

		<!-- blog box-->
		<div class="blog">
 
			<?php if(has_post_thumbnail()):?>
			<!-- blog image-->
				<?php				
				if(!get_option('rttheme_blog_resize'))://RT-Theme resize option is enabled
				
				//get the image url
				$image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_image_src($image_id,'large', true);
				$image_url = $image_url[0];
			
				?>
					<a href="<?php echo $image_url;?>" title="<?php the_title(); ?>" rel="prettyPhoto[rt_theme_blog]" ><img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo $image_url?>&amp;w=680&amp;h=130&amp;zc=1" alt=""  class="aligncenter" /></a>
				<?php else://use the post thumbnail ?>
					<?php
					$default_attr = array('class'	=> "attachment-$size aligncenter post_image preload");
					echo get_the_post_thumbnail($post->ID,array(680, 200),$default_attr);
					?>					
				<?php endif;?>
			<!-- / blog image -->
			<?php endif;?>
		
		
		 
		<!-- blog text-->
		 
		<?php echo the_content(); ?> 
		 
		<!-- /blog text-->
		<div class="line nomargin"></div>
	 
 
 
		<!-- date and cathegory bar -->
		<div class="dateandcategories">
			On <?php the_time('F jS, Y') ?>,
			<b>posted in:</b> <?php the_category(', ') ?>
			by <?php the_author_posts_link(); ?>
			<?php echo the_tags( '<span class="comment">Tags: ', ', ', '</span>');?>
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
	<?php include(TEMPLATEPATH."/sidebar.php"); ?>
    </div>
    <!-- / side bar -->
    
</div>
<!-- content -->

  
<?php get_footer();?>