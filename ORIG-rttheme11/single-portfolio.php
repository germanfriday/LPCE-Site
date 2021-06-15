<?php
/* 
* rt-theme portfolio detail page
*/

//taxonomy
$taxonomy = 'portfolio_categories';

//page link
$link_page=get_permalink(get_option('rttheme_portf_page'));

//category link
$terms = get_the_terms($post->ID, $taxonomy);
$i=0;
foreach ($terms as $taxindex => $taxitem) {
if($i==0){
    $link_cat=get_term_link($taxitem->slug,$taxonomy);
    $term_slug = $taxitem->slug;
    $term_id = $taxitem->term_id;    
    }
$i++;
}


// portfolio image size 
$w=680;
$h=200;
 


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
    
<!-- content -->
<div id="main">
    
    <!-- left side content -->
    <div class="content sub"> 
 
        
        
        <?php if (have_posts()) : while (have_posts()) : the_post();?>
 

	<?php
	/* Getting image type */
	if (preg_match("/(png|jpg|gif)/", get_post_meta($post->ID, 'rt_portfolio_image', true))) {
		$button="magnifier";
	} else {
		$button="play";
	}
	?>
	
	<!-- portfolio image -->
	 
	<?php
	if(($button=="play" && get_post_meta($post->ID, 'rt_portfolio_thumb_image', true)) || $button=="magnifier" || get_post_meta($post->ID, 'rt_portfolio_thumb_image', true)):?>
	<!-- portfolio image -->
	<div class="imgarea <?php if(get_post_meta($post->ID, 'rt_portfolio_image', true)):?><?php echo $button;?><?php endif;?> subholder">
		<?php if(get_post_meta($post->ID, 'rt_portfolio_image', true)):?><a href="<?php echo get_post_meta($post->ID, 'rt_portfolio_image', true);?>" title="<?php the_title(); ?>" rel="prettyPhoto[rt_theme_portfolio]" ><?php endif;?>
		<?php if(get_post_meta($post->ID, 'rt_portfolio_thumb_image', true)):?><img src="<?php echo get_post_meta($post->ID, 'rt_portfolio_thumb_image', true);?>" alt="<?php the_title(); ?>" class="image portf preload" /><?php else:?><img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, 'rt_portfolio_image', true)?>&amp;w=<?php echo $w;?>&amp;h=<?php echo $h;?>&amp;zc=1" alt="<?php the_title(); ?>" class="image portf preload" /><?php endif;?>
		<?php if(get_post_meta($post->ID, 'rt_portfolio_image', true)):?></a><?php endif;?>
	</div>
	<?php endif;?>


            <!-- text-->
            <?php the_content();?>
            <!-- text -->
        
        <?php endwhile; endif;?>
	
	<?php if ($post->comment_status == 'open') : ?>
	<div class="line margin"></div> 
	<div class='entry commententry'>
	    <?php comments_template(); ?>
	</div>
	<?php endif;?>
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