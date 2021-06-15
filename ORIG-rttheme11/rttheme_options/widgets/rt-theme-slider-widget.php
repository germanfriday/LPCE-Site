<?php
/*
Plugin Name: RT-THEME SLIDER WIDGET
Plugin URI: http://themeforest.net/user/stmcan?ref=stmcan
Description: This widget developed for RT- Wordpress Themes. Adds a slide to slider.
Version: 1.0
Author: Tolga can
Author URI: http://themeforest.net/user/stmcan?ref=stmcan
*/

/* RT_THEME_SLIDER_WIDGET Class */
class RT_THEME_SLIDER_WIDGET extends WP_Widget {
    function RT_THEME_SLIDER_WIDGET() {
        $widget_ops = array( 'classname' => 'rt-theme-slider-widget', 'description' => 'Adds a slide to slider.' );
        parent::WP_Widget( 'css-rt-theme-slider-widget', 'RT-THEME SLIDER WIDGET', $widget_ops );
    }


    function widget($args, $instance) {		
        extract( $args );
	$subtitle = $instance['subtitle']; 
	$linkto = apply_filters('title', $instance['linkto']);
	$rt_post_id = apply_filters('rt_post_id', $instance['rt_post_id']);
	$rt_page_id = apply_filters('rt_page_id', $instance['rt_page_id']);
	$slider_background_image=apply_filters('slider_background_image', $instance['slider_background_image']); 
        $text = apply_filters('text', $instance['text']);
	if ($id=="home-page-slider"){$slider=1;} 
        ?>

		<?php if ($slider):?>
			    
			<?php
			if ($linkto == 'page'){//page
			    
			    $query_string = "page_id=$rt_page_id";
			    query_posts($query_string);
			    if (have_posts()) : 
				while (have_posts()) : the_post(); 
					$title=get_the_title();
					$link=get_permalink();
					$link_text ="read more";
					$more = 0;
				endwhile; 
			    endif;
		    
			}elseif($linkto == 'post'){//post
			    
			    $query_string = "p=$rt_post_id";
			    query_posts($query_string);
			    if (have_posts()) : 
				while (have_posts()) : the_post(); 
					$title=get_the_title();
					$link=get_permalink();
					$link_text ="read more";
					$more = 0;
				endwhile; 
			    endif;
				
			}else{//manual
			    
			    $title = apply_filters('title', $instance['title']); 
			    $link = apply_filters('link', $instance['link']);
			    $link_text = apply_filters('link_text', $instance['link_text']);
			}
			?>    
	    	
			<!-- slide -->
			<div class="slide">
			    
			    <?php if($title || $text || ($link && $link_text)): ?>	
			    <!-- sliding text line -->
			    <div class="desc">
				<?php if($title):?><b class="title"><?php if($link): ?><a href="<?php echo $link;?>" title="<?php echo $title;?>"><?php endif;?><?php echo $title;?><?php if($link): ?></a><?php endif;?></b><br /><?php endif;?>
				<?php if($subtitle):?><b class="subtitle"><?php echo $subtitle;?></b><br /><?php endif;?>
				<?php if($text)?><?php echo $text;?>
				<?php if($link && $text):?><a href="<?php echo $link;?>" title="<?php echo $title;?>" <?php echo $open_page;?>><?php echo $link_text;?></a><?php endif;?>
			    </div>
			    <!-- /sliding text line -->
			    <?php endif;?>
	    
	    
			    <!-- slider background image -->
				<?php if($slider_background_image):?>
				    <?php if($link): ?><a href="<?php echo $link;?>" title=""><?php endif;?>						
					<?php if(get_option('rttheme_slider_auto_disable_box')):?>
						<img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo $slider_background_image;?>&amp;w=940&amp;zc=1" alt="" class="image" />
					<?php else:?>
						<img src="<?php echo $slider_background_image;?>" class="image" alt="" />
					<?php endif;?>						    
				    <?php if($link): ?></a><?php endif;?> 
				<?php endif;?>
			    <!-- /slider background image -->					     
			
			</div>
			<!--/ slide -->
			
			<?php endif;?>
		
	<?php
	}

    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    function form($instance) {
	global $post;
		/* link to */
		$linkto = esc_attr($instance['linkto']);
		
		/* slide title */
		$title = esc_attr($instance['title']);
		
		/* slide second title */
		$subtitle = esc_attr($instance['subtitle']);
		
		/* slide text */
		$text = esc_attr($instance['text']);
		
		/* manual link */
		$link = esc_attr($instance['link']);
		$link_text = esc_attr($instance['link_text']);		
		$target_page= esc_attr($instance['target_page']);
		
		/* slide backgroun image */
		$slider_background_image=esc_attr($instance['slider_background_image']); 
		
		
		/* pages */
		$pages = get_pages();
		$rt_getpages = array();
		foreach ($pages as $page_list ) {
		   $rt_getpages[$page_list ->ID] = $page_list ->post_title;
		}
		$rt_page_id = esc_attr($instance['rt_page_id']);
		
		/* posts */
		$rt_post_id = esc_attr($instance['rt_post_id']);
		$rt_getposts = get_posts('numberposts=-1');		

        ?>
	<div class="rt-theme-widget <?php echo $this->get_field_id('linkto'); ?>">
	Select an option to link your slide:
	<select name="<?php echo $this->get_field_name('linkto'); ?>" class="linkto" id="<?php echo $this->get_field_id('linkto'); ?>" >
	    <option value="page" <?php if ( $linkto  == "page") { echo ' selected="selected" '; }?> >   Page   </option>
	    <option value="post" <?php if ( $linkto  == "post") { echo ' selected="selected" '; }?> >   Post   </option>
	    <option value="manual" <?php if ( $linkto  == "manual") { echo ' selected="selected" '; }?> >   Manual   </option>    
	</select>
	
	<div class="page_related <?php if ( $linkto  == "page" || $linkto  == "" ) { echo 'show_true'; }?>">
	<br />Choose a page for link<br />
	<p>	
		<select name="<?php echo $this->get_field_name('rt_page_id'); ?>">  id="<?php echo $this->get_field_id('rt_page_id'); ?>" >
			<?php foreach ($rt_getpages as $op_val=>$option) { ?>
		<option value="<?php echo $op_val;?>" <?php if ( $rt_page_id  == $op_val) { echo ' selected="selected" '; }?>><?php _e($option); ?></option>
		<?php } ?>
		</select>
		
		</label>
	</p>
	</div>

	<div class="post_related <?php if ( $linkto  == "post") { echo 'show_true'; }?>">
	<br />Please choose a post for content!<br />
	<p>
		<label <?php echo $this->get_field_name('rt_post_id'); ?>>
		<select  name="<?php echo $this->get_field_name('rt_post_id'); ?>"  id="<?php echo $this->get_field_id('rt_post_id'); ?>" style="width:225px;" >
		    <?php foreach ($rt_getposts as $post) { ?>
			<option value="<?php echo $post->ID;?>" <?php if ( $rt_post_id  ==  $post->ID) { echo ' selected="selected" '; }?>><?php echo  the_title(); ?></option>
		    <?php } ?>
		</select>
		</label>
	</p>
	</div>
	
	<div class="manual_related <?php if ( $linkto  == "manual") { echo 'show_true'; }?>">
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link (URL):'); ?> <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('link_text'); ?>"><?php _e('Link text (i.e. \'read more\'):'); ?> <input class="widefat" id="<?php echo $this->get_field_id('link_text'); ?>" name="<?php echo $this->get_field_name('link_text'); ?>" type="text" value="<?php echo $link_text; ?>" /></label></p>		
	</div>
	
	<div class="manual_rest show_true">
		<p><small>if you don't want to use one of these fields, you can leave it blank!</small></p>
		<p><label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Second Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" /></label></p>				
		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:'); ?> <br />
		<textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
		</label></p> 
		<p><label for="<?php echo $this->get_field_id('slider_background_image'); ?>"><?php _e('Image For Slider:'); ?> </label><input class="widefat" id="<?php echo $this->get_field_id('slider_background_image'); ?>" name="<?php echo $this->get_field_name('slider_background_image'); ?>" type="text" value="<?php echo $slider_background_image; ?>"  style="width:158px;" /><input  class="rttheme_upload_button <?php echo $this->get_field_id('slider_background_image'); ?> button"  type="button" value="Upload" /></p>
	</div>
	</div>

<?php // end class
}
}
?>
<?php // register RT_THEME_SLIDER_WIDGET widget
add_action('widgets_init', create_function('', 'return register_widget("RT_THEME_SLIDER_WIDGET");'));
?>