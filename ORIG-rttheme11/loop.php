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
		<div class="blog">
		
				<!-- blog headline-->
				<h3><a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3> 
				<!-- / blog headline-->		    
		
		<div class="line margin"></div>
		
		
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
			On <?php the_time('F jS, Y') ?>,
			<b>posted in:</b> <?php the_category(', ') ?>
			by <?php the_author_posts_link(); ?>
			<?php echo the_tags( '<span class="comment">Tags: ', ', ', '</span>');?>	
			<?php $comment_count = get_comment_count($post->ID); ?>
			<?php if ($comment_count['approved'] > 0) : ?>
			<span class="comment"><?php comments_popup_link('', '1 Comment', '% Comment'); ?></span><?php endif;?>
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




	 