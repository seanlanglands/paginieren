<?php
/**
 * The template for displaying Comments.
 *
 */
?>
	<div id="comment-section">
	<?php if(post_password_required()) { ?>
		<p>This post is password protected. Enter the password to view any comments.</p>
	<?php } ?>
	
	<?php if(have_comments()) { ?>
	
		<h3 id="comments-title"><?php
		printf(_n('<span>One</span> Response to <em>%2$s</em>', '<span>%1$s</span> Responses to %2$s', get_comments_number(), PF_THEME_FILE),
		number_format_i18n(get_comments_number()), '"'.get_the_title().'"');
		?></h3>
	
	<?php wp_list_comments(array('callback' => 'pf_comment')); ?>

	<?php } else {
	
		if(!comments_open()) { ?>
			<p><?php _e('Comments are closed.', PF_THEME_FILE); ?></p>
		<?php } ?>
	
	<?php } ?>
	</div> <!-- End Comment Section -->
	
<?php comment_form(); ?>