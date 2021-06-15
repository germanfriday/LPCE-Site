<?php
/* 
* rt-theme portfolio loop
*/

global $args,$which_theme;
$box_counter = 0;

query_posts($args);

/*
* portfolio layout
*/
$portfolio_layout_names=array("4"=>"four","3"=>"three","2"=>"two");
if(get_option('rttheme_portfolio_layout')){
	$rttheme_portfolio_layout=get_option('rttheme_portfolio_layout');
}else{
	$rttheme_portfolio_layout=4;
}

/*
* thumbnail sizes
*/

switch ($rttheme_portfolio_layout) {
	case 4:
		$w=220;
	$h=100;
		break;
	case 3:
		$w=300;
	$h=120;
		break;
	case 2:
		$w=460;
	$h=180;
		break;
}



if ( have_posts() ) : while ( have_posts() ) : the_post();


?>

<!-- box -->
<div class="box <?php echo $portfolio_layout_names[$rttheme_portfolio_layout];?> portfolio">

	<!-- portfolio title-->
	<h5><?php if(!get_option('rttheme_portf_no_detail')): ?><a href="<?php echo get_permalink() ?>" title=""><?php endif; ?><?php the_title(); ?><?php if(!get_option('rttheme_portf_no_detail')): ?></a><?php endif; ?></h5>
	
	<?php
	/* Getting image type */
	if (preg_match("/(png|jpg|gif)/", get_post_meta($post->ID, 'rt_portfolio_image', true))) {
		$button="magnifier";
	} else {
		$button="play";
	}
	?>
	
	<?php
	if(($button=="play" && get_post_meta($post->ID, 'rt_portfolio_thumb_image', true)) || $button=="magnifier" || get_post_meta($post->ID, 'rt_portfolio_thumb_image', true)):?>
		<!-- portfolio image -->
		<div class="imgarea <?php if(get_post_meta($post->ID, 'rt_portfolio_image', true)):?><?php echo $button;?><?php endif;?> alignleft">
			<?php if(get_post_meta($post->ID, 'rt_portfolio_image', true)):?><a href="<?php echo get_post_meta($post->ID, 'rt_portfolio_image', true);?>" title="<?php the_title(); ?>" rel="prettyPhoto[rt_theme_portfolio]" ><?php endif;?>
			<?php if(get_post_meta($post->ID, 'rt_portfolio_thumb_image', true)):?><img src="<?php echo get_post_meta($post->ID, 'rt_portfolio_thumb_image', true);?>" alt="<?php the_title(); ?>" class="image portf preload" /><?php else:?>
			
			<?php
			// Resize Portfolio Image
			$imgURL = find_image_org_path(get_post_meta($post->ID, 'rt_portfolio_image', true));
			$crop 	= true;
			if($imgURL) $image_thumb = @vt_resize( '', $imgURL, $w, $h, ''.$crop.'' );
			?>
			<img src="<?php echo $image_thumb["url"];?>" alt="<?php the_title(); ?>" class="image portf preload" />			 
			<?php endif;?>
			<?php if(get_post_meta($post->ID, 'rt_portfolio_image', true)):?></a><?php endif;?>
		</div>
		<div class="clear"></div>
	<?php endif;?>
	
	<?php if(get_post_meta($post->ID, 'rt_portfolio_desc', true)):?>
		<p>
		<!-- text-->
		<?php echo get_post_meta($post->ID, 'rt_portfolio_desc', true);?>
		
		<?php if(!get_option('rttheme_portf_no_detail')):?>
			<a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><?php _e( 'read more', 'rt_theme' ); ?></a>
		<?php endif;?>
		
		</p>
	<?php endif;?>
</div>
<!-- /box -->

 
<?php
//get page and post counts
$page_count=get_page_count();

	  $box_counter++;
	  if (fmod($box_counter,$rttheme_portfolio_layout)==0 && $box_counter!=$page_count['post_count']){
		  echo "<div class=\"line margin\"></div>";
	  }
?>

<?php endwhile?>
<?php
//show pagination if page count bigger then 1
if ($page_count['page_count']>1):
?>
	<div class="line margin"></div>
	<div class="clear"></div>
	<!-- paging-->
	<ul class="paging"><?php get_pagination(); ?></ul>
	<!-- / paging-->
<?php endif;?>	
<?php endif;  wp_reset_query();?>
	 