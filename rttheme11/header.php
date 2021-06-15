<?php
global $link_page,$link_cat,$which_theme,$tabbed_page;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>  
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />


<?php if(get_option('rttheme_effect_options')){?>
<meta name="rttheme_effect_options" content="<?php echo get_option('rttheme_effect_options');?>" />
<?php }else{?>
<meta name="rttheme_effect_options" content="scrollLeft" />
<?php }?>
<?php if(get_option('rttheme_slider_time_out')){?>
<meta name="rttheme_slider_time_out" content="<?php echo get_option('rttheme_slider_time_out')*1000;?>" />
<?php }else{?>
<meta name="rttheme_slider_time_out" content="6000" />
<?php }?>
<meta name="rttheme_template_dir" content="<?php echo get_template_directory_uri(); ?>" />
<?php if(get_option('rttheme_disable_cufon')){?>
<meta name="rttheme_disable_cufon" content="<?php echo get_option('rttheme_disable_cufon');?>" />
<?php }?>

<title><?php if (is_home()): bloginfo('name'); else: wp_title('');endif; ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.cycle.all.min.js"></script>
<?php if($tabbed_page){?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.coda-slider-2.0.js"></script>
<?php }?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.prettyPhoto.js"></script>
<?php if(!get_option('rttheme_disable_cufon')){?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/cufon.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/anivers_400.font.js"></script>
<?php }?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/script.js"></script>

<?php if(get_option('rttheme_slider_height')):
$new_heigth=get_option('rttheme_slider_height');
$new_heigth=trim(preg_replace('#px#', "",$new_heigth));
$new_arrow_position = ($new_heigth/2)-20;
?>
<style type="text/css">
  
    #slider, #slider_area, .slide{
	height:<?php echo $new_heigth;?>px !important;
    }    
 
    .prev, 
    .next {
	margin:<?php echo $new_arrow_position;?>px 0 0 0px;
    }
    
</style>
<?php endif;?>

<?php
#
#   Custom CSS Codes
#
echo '<style type="text/css"> '. get_option('rttheme_custom_css') .' </style>';
?>

</head>
<body <?php body_class(); ?>>

<div id="container">

	<!-- header -->
	<div id="header">
	    <!-- logo -->
	    <div id="logo"><a href="<?php echo home_url(); ?>" title="<?php echo bloginfo('name');?>"><img src="<?php if(get_option('rttheme_logo_url')): echo get_option('rttheme_logo_url'); else:?><?php echo get_template_directory_uri(); ?>/images/<?php echo $which_theme;?>/logo.png<?php endif;?>" alt="<?php echo bloginfo('name');?>" class="png" /></a></div>
	    <!-- /logo -->
	
	    <!-- header right -->

			<!-- navigation -->
			    <?php
				rt_nav($link_page,$link_cat);
			    ?>
			<!-- / navigation  -->
			
	    <!-- /header right -->
	</div>
	<!-- /header -->

<div class="clear"></div>
 

