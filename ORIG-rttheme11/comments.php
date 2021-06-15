<?/* based on twentyten comment template*/ ?>
<div id="comments">
<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'rt_theme' ); ?></p>
		</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h6 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'rt_theme' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h6>
			
			
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'rt_theme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'rt_theme' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use twentyten_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define twentyten_comment() and that will be used instead.
					 * See twentyten_comment() in twentyten/functions.php for more.
					 */
					wp_list_comments( 
								
						array(
					'walker'            => null,
					'max_depth'         => 2,
					'style'             => 'ul',
					'callback'          => rt_comments, 
					'type'              => 'all',  
					'avatar_size'       => 58,
					)
					); 
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'rt_theme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'rt_theme' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

		<?php if ( ! comments_open() ) :?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'rt_theme' ); ?></p>
		<?php endif; // end ! comments_open() ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
?> 
			
<?php endif; // end have_comments() ?>




 
<?php if ($post->comment_status == 'open') : ?>

		<div id="respond">
		<?php if ( have_comments() ) : ?><br /><div class="line margin"></div><?php endif;?>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

				<p><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('Log in','rt_theme'); ?></a> <?php _e('to post a comment.','rt_theme'); ?></p>
		<?php else:?>
		
		<h3 id="reply-title"><?php _e('Leave a Reply','rt_theme');?> <small><?php cancel_comment_reply_link(__("Cancel Reply",'rt_theme')); ?></small></h3>
		
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<div class='personal_data'>
					<?php if ( $user_ID ) : ?>
					
						<p><?php _e('Logged in as','rt_theme'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title=""><?php _e('Log out','rt_theme'); ?> &raquo;</a></p>
						
					<?php else : ?>
					
						<p><input type="text" name="author" class="text_input" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1"  />
						<label for="author"><small><?php _e('Name','rt_theme');  if ($req) _e(' (required)','rt_theme'); ?></small></label></p>
						
						<p><input type="text" name="email" class="text_input" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
						<label for="email"><small><?php _e('Email','rt_theme');  if ($req) _e(' (required)','rt_theme'); ?></small></label></p>
						
						<p><input type="text" name="url" class="text_input" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
						<label for="url"><small><?php _e('Website','rt_theme'); ?></small></label></p>
					
					<?php endif; ?>
					
				</div>
				
				<div class='message_data'>
				<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
				
				<p><textarea name="comment" id="comment" cols="100%" rows="10" class='text_area' tabindex="4"></textarea></p>
				</div>
				
				<p><input name="submit" class="button" type="submit" id="submit" tabindex="5" value="Submit" />
				<?php 
				comment_id_fields();
				do_action('comment_form', $post->ID);
				?></p>
			</form>
		<?php endif;?>
		</div><!-- #respond -->
<?php endif; ?>


</div><!-- #comments -->