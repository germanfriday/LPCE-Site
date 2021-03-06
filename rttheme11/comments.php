<?php /* based on twentyten comment template*/ ?>
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
				if(get_comments_number() == 1)
				    $results = __('One Response to' , 'rt_theme');
				else
				    $results = sprintf( __('%s Responses to' , 'rt_theme') , get_comments_number());

				echo $results . ' <em>' . get_the_title() . '</em>';
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
					'callback'          => 'rt_comments', 
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






<?php if ( get_comments_number() > 0) : // Are there comments to navigate through? ?>
<br /><div class="line"><span class="top">[<?php _e( 'top', 'rt_theme' ); ?>]</span></div>
<?php endif;?>

<?php  
$aria_req = "";

//text fields
$commnet_author =  __('Name','rt_theme') . ( $req ? ' *' : '' );
$commnet_author_email =   __('Email','rt_theme') . ( $req ? ' *' : '' );
$comment_author_url =  __('Website','rt_theme');


$fields =  array(
	'author' => '<p><input id="author" name="author" class="showtextback" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /> <label for="author"><small>'.$commnet_author.'</small></label></p>',
	'email' => '<p><input id="email" name="email" class="showtextback" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /> <label for="email"><small>'.$commnet_author_email.'</small></label></p>',
	'url' =>  '<p><input id="url" name="url" class="showtextback" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> <label for="url"><small>'.$comment_author_url.'</small></label></p>'
);


//text fields actions
function rt_comment_form_before_fields(){
	print '<div class="text-boxes">';
}

add_action( 'comment_form_before_fields', 'rt_comment_form_before_fields' );

function rt_comment_form_after_fields(){
	print '</div>';
}

add_action( 'comment_form_after_fields', 'rt_comment_form_after_fields' );



// add_filter('comment_form_default_fields', 'custom_fields');


remove_action ('comment_form_after','');

//comment form args

$comments_args = array( 	
	'comment_field'        => '<div class="text-boxes"><p class="comment-form-comment"><textarea tabindex="4" class="comment_textarea showtextback" rows="10" id="comment" name="comment">'. __('Comment','rt_theme') .' *</textarea></p></div><div class="clear space"></div>',
	'id_form'              => 'commentform', 
	'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
	'id_submit'            => 'submit',
	'class_submit'			=> 'button',
	'title_reply'          => __( 'Leave a Reply' ,'rt_theme'),
	'title_reply_to'       => __( 'Leave a Reply to %s' ,'rt_theme'),
	'cancel_reply_link'    => __( 'Cancel reply' ,'rt_theme'),
	'label_submit'         => __( 'Post Comment','rt_theme' )
);
comment_form( $comments_args, $post->ID );
?> 

</div><!-- #comments -->