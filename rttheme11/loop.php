<?php
/* 
* rt-theme loop
*/


global $args,$which_theme,$more;


add_filter('excerpt_more', 'new_excerpt_more');
				
				
if ($args) query_posts($args);

if ( have_posts() ) : while ( have_posts() ) : the_post(); 
?>
 
  
 
		<!-- blog box-->
		<div id="post-<?php the_ID(); ?>" <?php post_class("blog"); ?>>
		
				<!-- blog headline-->
				<h3><a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3> 
				<!-- / blog headline-->		    
		
		<div class="line margin"></div>
		
		
		<?php if(has_post_thumbnail()):?>
		<!-- blog image-->
			<a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>">				
					<?php						
					//get the image url
					$image_id  = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id,'large', true);
					$image_url = $image_url[0];
					
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

		
		<?php if(get_the_excerpt()):?>
		<!-- blog text-->
			<?php
				$more=0;
				the_excerpt(); 
			?> 
		<!-- /blog text-->
		<div class="line nomargin"></div>
		<?php endif;?>
 
 
		<!-- date and cathegory bar -->
		<div class="dateandcategories">
		     <?php _e('On','rt_theme'); ?> <?php the_time('F jS, Y') ?>,
			<b><?php _e('posted in:','rt_theme'); ?></b> <?php the_category(', ') ?>
			<?php _e('by','rt_theme'); ?> <?php the_author_posts_link(); ?>
			<?php echo the_tags( '<span class="comment">', ', ', '</span>');?>	
			<?php $comment_count = get_comment_count($post->ID); ?>
			<?php if ($comment_count['approved'] > 0) : ?>
			<span class="comment"><?php comments_popup_link(__('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme')); ?></span><?php endif;?>
		</div>
		<!-- / date and cathegory bar -->
			
		
		</div>
		<!-- blog box-->
		
		<div class="line margin"></div>

 

<?php endwhile;?>
<div class="clear"></div>

		<?php
		//get page and post counts
		$page_count=get_page_count();
		
		//show pagination if page count bigger then 1
		if ($page_count['page_count']>1):
		?>  
		<!-- paging-->
		<ul class="paging"><?php get_pagination(); ?></ul>
		<!-- / paging-->
		<?php endif;?>

<?php wp_reset_query();?>	

<?php else: ?>
<p><?php _e( 'Sorry, no posts matched your criteria.', 'rt_theme' ); ?></p>
	<!-- / paging--> 
<?php endif; ?>




	 