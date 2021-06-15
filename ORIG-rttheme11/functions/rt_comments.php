<?php
//Comments
function rt_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; 
?>
	<?php if ($comment->comment_approved == '1') : ?>

	<?php
	//highlight the author's comments
	if($comment->user_id == get_the_author_id()){
		$author_comment_class="author";
	}
	?>
		
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-body <?php echo $author_comment_class;?>">
      
 
	<div class="comment-avatar  <?php echo $author_comment_class;?>">	
        <?php
	if(get_comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))){
		echo get_avatar($comment,$size=$args['avatar_size']);
	}else{
	  
		echo get_avatar($comment,$size=42);
	}
	?>
        </div>
      
	<div class="comment-holder-top">
	<div class="comment-holder  <?php echo $author_comment_class;?>">
		<div class="comment-author">
			<h6><?php echo get_comment_author_link();?></h6> <span class="comment-meta"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),' ','') ?></span>
		</div>
		<div class="clear"></div>
		<div class="comment-text">
		<?php comment_text(); ?>
		</div>
		
		<?php if($comment_reply_link=get_comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))):?>
			
			<span class="reply">
			<?php			 
				echo $comment_reply_link;
			?>	
			</span>
		 
		<?php endif;?>
		
		<div class="clear"></div>    
	</div>
	</div>

      
      <div class="clear"></div>
    </div>
    <?php endif; ?>
<?php
}
?>