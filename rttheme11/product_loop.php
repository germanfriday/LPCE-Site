<?php
/* 
* rt-theme product loop
*/
$box_counter = "";
global $args;
query_posts($args);
if ( have_posts() ) : while ( have_posts() ) : the_post(); 
?>
 
<!-- box -->
<div class="box products">
 
	<!-- product image -->
	<?php if(get_post_meta($post->ID, 'rt_product_image_url', true)):?>
	<div class="imgarea">
	<a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>">

			<?php
			// Resize Image
			$imgURL = find_image_org_path(get_post_meta($post->ID, 'rt_product_image_url', true));
			$crop 	= true;
			if($imgURL) $image_thumb = @vt_resize( '', $imgURL, 130, 0, ''.$crop.'' );
			?>
			<img src="<?php echo $image_thumb["url"];?>" alt="<?php the_title(); ?>" class="image product_image preload" />

	</a>
	</div> 
	<?php endif;?>
	<!-- / product image -->
		
	<!-- product title-->
	<h5><a href="<?php echo get_permalink() ?>" title=""><?php the_title(); ?></a></h5>
	<?php if(get_post_meta($post->ID, 'rt_short_description', true) || get_post_meta($post->ID, 'rt_product_price', true)):?>
	<p>
	<!-- short description -->
	<?php echo get_post_meta($post->ID, 'rt_short_description', true);?>	
	</p>
	<?php endif;?>
	
</div>
<!-- /box -->
 
<?php
//get page and post counts
$page_count=get_page_count();

	  $box_counter++;
	  if (fmod($box_counter,2)==0 && $box_counter!=$page_count['post_count']){
		  echo "<div class=\"line margin\"></div>"; 
	  }
?>

<?php endwhile?>
<?php
//show pagination if page count bigger then 1
if ($page_count['page_count']>1):
?>
	<div class="line"></div>
	<div class="clear"></div>
	<!-- paging-->
	<ul class="paging"><?php get_pagination(); ?></ul>
	<!-- / paging-->
<?php endif;?>	
<?php endif; wp_reset_query();?>
	 