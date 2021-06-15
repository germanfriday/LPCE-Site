<?php 

/*
Plugin Name: RT-THEME NEWS WIDGET
Plugin URI: http://themeforest.net/user/stmcan?ref=stmcan
Description: This widget developed for RT- Wordpress Themes. Adds latest blog posts.
Version: 1.0
Author: Tolga can
Author URI: http://themeforest.net/user/stmcan?ref=stmcan
*/

/* RT_THEME_NEWS_WIDGET Class */
class RT_THEME_NEWS_WIDGET extends WP_Widget {
    function RT_THEME_NEWS_WIDGET() {
        $widget_ops = array( 'classname' => 'rt-theme-news-widget', 'description' => 'Adds a latest blog posts.' );
        parent::WP_Widget( 'css-rt-theme-news-widget', 'RT-THEME NEWS WIDGET', $widget_ops );
    }


    function widget($args, $instance) {
	//Find this widget order 
	
	$wp_get_sidebars_widgets=wp_get_sidebars_widgets();
	$this_widget_id=$args['widget_id'];
	$this_sidebar_widgets=$wp_get_sidebars_widgets['home-page-contents'];	
	
	foreach ($this_sidebar_widgets as $k=>$value){
	    
	    if ($value==$this_widget_id){
		$this_widget_order=$k+1;	
	    } 	  	    
	}
	
        extract( $args );
	
	$title = apply_filters('title', $instance['title']);
	$rt_news_id= apply_filters('rt_news_id', $instance['rt_news_id']);
	$rt_news_number= apply_filters('rt_news_number', $instance['rt_news_number']);
	 
	$hide_date= apply_filters('hide_date', $instance['hide_date']);

	if (apply_filters('link_text', $instance['link_text'])!=''){
	    $link_text =apply_filters('link_text', $instance['link_text']);
	}else{
	    $link_text ="&#32;";    
	}
	
	if ($id=="home-page-contents"){$home_page=1;}
 

	$sub_page_class="four";
	$box_image_width="220";		

    
	if(!$rt_news_number){
	    $rt_news_number="10";		
	}	
	?>
	
 
	<?php
	
	//home page content boxes width
	

	if(get_option("rttheme_home_box_width")){
	    $box_width=get_option("rttheme_home_box_width");  
	}else{
	    $box_width=4;
	}
	
	
	if($box_width==4){
					    
	    if(fmod($this_widget_order,4)==0){
		$box_class="four last";
		$box_image_width="218";
		$clear=true;
	    }else{
		$box_class="four";
		$box_image_width="218";					
	    }
	    
	}elseif($box_width==3){
	    
	    if(fmod($this_widget_order,3)==0){
		$box_class="three last";
		$box_image_width="218";
		$clear=true;
	    }else{
		$box_class="three";
		$box_image_width="218";					
	    }
	    
	}elseif($box_width==2){
	    
	    if(fmod($this_widget_order,2)==0){
		$box_class="two last";
		$box_image_width="218";
		$clear=true;
	    }else{
		$box_class="two";
		$box_image_width="218";					
	    }
	    
	}elseif($box_width==1){
	    
	    $box_class="one";
	    $box_image_width="218";								    
	}
	
	
	//sidebar case
	if(!$home_page){
	    $box_class="four";
	    $box_image_width="218";					    
	}
	
	?>
				
		<div class="box <?php echo $box_class;?>">

			<?php if($title):?>
			<!-- box title-->					
			    <h4><?php echo $title;?></h4>
			<?php endif; ?>
  
			<ul class="latest_news">  

			    <?php

			    wp_reset_query();
		     
			    $args=array(
			       'post_type'=>'post',
			       'showposts'=>$rt_news_number,
			       'cat'=>$rt_news_id
			    );
			    
			    
			    $the_query = new WP_Query($args);
			    $more = 0;
			    $i=1;
			    $count_posts = $the_query->post_count;
			    ?>
			    
			   <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
			   
				    $title=get_the_title();
				    $link=get_permalink();
				    $date=get_the_time('d M Y');
				    $more = 0;			
			    ?>
					<li>
					    
					<!-- text-->
					<a href="<?php echo $link;?>" class="read_more" title="<?php echo $title;?>"><?php echo $title; ?> </a>
					<?php if(!$hide_date):?> - <span class="news_date"><?php echo $date;?></span><?php endif;?>
					</li>
			    <?php $i++; endwhile; endif;wp_reset_query();?>
			
			</ul>
		</div>
		<?php if(!$home_page || $clear):?> <div class="clear"></div><?php endif;?>
	<!-- /news box -->
		



 


		
	<?php
	}

    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    function form($instance) {
	global $rt_getcat;
	$title = esc_attr($instance['title']);
	$rt_news_number= esc_attr($instance['rt_news_number']);
	$rt_news_id = esc_attr($instance['rt_news_id']); 
	$hide_date= esc_attr($instance['hide_date']);
	$link_text = esc_attr($instance['link_text']);	
    ?>
	<div class="rt-theme-widget">

 	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
 
	Choose a category<br />
	<p>	
		<select name="<?php echo $this->get_field_name('rt_news_id'); ?>">  id="<?php echo $this->get_field_id('rt_news_id'); ?>" >
			<?php foreach ($rt_getcat as $op_val=>$option) { ?>
		<option value="<?php echo $op_val;?>" <?php if ( $rt_news_id  == $op_val) { echo ' selected="selected" '; }?>><?php _e($option); ?></option>
		<?php } ?>
		</select>
		
		</label>
	</p>
 

	<p> <label for="<?php echo $this->get_field_id('hide_date'); ?>"><?php _e('Hide Dates:'); ?></label> <input  id="<?php echo $this->get_field_id('hide_date'); ?>"   <?php if($hide_date=='on') echo "checked";?> name="<?php echo $this->get_field_name('hide_date'); ?>" type="checkbox"></p>

	<p><label for="<?php echo $this->get_field_id('rt_news_number'); ?>"><?php _e('Number Posts (default: \'10\'):'); ?> <input class="widefat" id="<?php echo $this->get_field_id('rt_news_number'); ?>" name="<?php echo $this->get_field_name('rt_news_number'); ?>" type="text" value="<?php echo $rt_news_number; ?>" /></label></p>
	 
	<p><label for="<?php echo $this->get_field_id('link_text'); ?>"><?php _e('Link text (default: \'read more\'):'); ?> <input class="widefat" id="<?php echo $this->get_field_id('link_text'); ?>" name="<?php echo $this->get_field_name('link_text'); ?>" type="text" value="<?php echo $link_text; ?>" /></label></p>
	 
 
	</div>

<?php // end class
}
}
?>
<?php // register RT_THEME_NEWS_WIDGET widget
add_action('widgets_init', create_function('', 'return register_widget("RT_THEME_NEWS_WIDGET");'));
?>