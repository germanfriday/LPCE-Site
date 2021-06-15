<?php
global $link_page,$link_cat,$which_theme,$tabbed_page;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<meta name="rttheme_template_dir" content="<?php bloginfo('template_directory'); ?>" />
<?php if(get_option('rttheme_disable_cufon')){?>
<meta name="rttheme_disable_cufon" content="<?php echo get_option('rttheme_disable_cufon');?>" />
<?php }?>

<title><?php if (is_home()): bloginfo('name'); else: wp_title('');endif; ?></title>

<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/<?php echo $which_theme;?>/style_cf.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/prettyPhoto.css" media="screen" />

<?php
//Register Jquery
wp_deregister_script('jquery');
wp_register_script('jquery',get_bloginfo('template_directory')  . '/js/jquery-1.3.2.min.js', false, '');
wp_enqueue_script('jquery'); 
?>

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.cycle.all.min.js"></script>
<?php if($tabbed_page){?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.coda-slider-2.0.js"></script>
<?php }?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.form.js"></script>
<script t