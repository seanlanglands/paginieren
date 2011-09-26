<?php
/** 
 * Set up theme constants.
 *
 */
function pf_theme_init() {
	// Constants
	$pf_theme_data = get_theme_data(TEMPLATEPATH.'/style.css');
	define('PF_THEME_NAME', $pf_theme_data['Name']);
	define('PF_THEME_HOMEPAGE', $pf_theme_data['URI']);
	define('PF_THEME_VERSION', trim($pf_theme_data['Version']));
	define('PF_THEME_URL', get_template_directory_uri());
	define('PF_THEME_FILE', str_replace(' ', '-', strtolower(PF_THEME_NAME)));
	define('PF_FOLDER', 'framework');
	
	// Load options page and related code
	require('framework/framework.php');
}
pf_theme_init();

/**
 * Display navigation to next/previous pages when called.
 *
 */
function pf_content_nav($nav_id) {
	global $wp_query;

	if($wp_query->max_num_pages > 1) { ?>
		<nav id="<?php echo $nav_id; ?>">
			<div class="nav-previous">
				<?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', PF_THEME_FILE)); ?></div>
			<div class="nav-next">
				<?php previous_posts_link( __('Newer posts <span class="meta-nav">&rarr;</span>', PF_THEME_FILE)); ?></div>
		</nav> <!-- End Content Nav -->
	<?php }
}

/** 
 * Custom excerpt lengths.
 *
 */
function pf_excerpt_length($length) {
	return 75;
}
add_filter('excerpt_length', 'pf_excerpt_length');

function pf_auto_excerpt_more($more) {
	return ' [&hellip;]';
}
add_filter('excerpt_more', 'pf_auto_excerpt_more');

/** 
 * Single comment structure.
 *
 */
function pf_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	
	switch($comment->comment_type) {
		case 'pingback' :
		case 'trackback' :
	?>
		<li class="post pingback">
			<p><?php _e('Pingback:', PF_THEME_FILE); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', PF_THEME_FILE), '<span class="edit-link">', '</span>'); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			

			<div class="comment-content">
			
				<div class="comment-text">
					<?php comment_text(); ?>
				</div>
				
				<div class="comment-meta">
					<div class="reply">
						<?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply <span>&darr;</span>', PF_THEME_FILE), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
					</div>
					
					<div class="comment-author vcard">
						<?php echo get_avatar($comment, 30); ?>
					</div>
	
					<?php if($comment->comment_approved == '0') { ?>
						<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', PF_THEME_FILE); ?></em>
					<?php } ?>
					<?php
					printf('%1$s %2$s',
						sprintf('<span class="fn"><strong>%s</strong></span>', get_comment_author_link()),
						sprintf('<a class="comment-link" href="%1$s"><span>#</span></a> <br /><time pubdate datetime="%2$s">%3$s</time>',
							esc_url( get_comment_link( $comment->comment_ID)),
							get_comment_time('c'),
							sprintf('%1$s at %2$s', 
								get_comment_date(), 
								get_comment_time()
							)
						)
					); ?>
					<?php edit_comment_link(__('Edit', PF_THEME_FILE), '<span class="edit-link">', '</span>'); ?>
				</div>
				
			</div>

			<div class="clear"></div>
		</article>

	<?php
			break;
	}
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 */
function pf_posted_on() {
	printf(__('<span class="by-author"><span>by</span> <span class="author"><a href="%1$s" title="%2$s" rel="author">%3$s</a></span></span> <span>on </span><a class="entry-date" href="%4$s" title="%5$s"><time datetime="%6$s" pubdate>%7$s</time></a> in %8$s', PF_THEME_FILE),
		esc_url(get_author_posts_url(get_the_author_meta('ID'))),
		sprintf(esc_attr(__('View all posts by %s', PF_THEME_FILE)), get_the_author()),
		esc_html(get_the_author()),
		esc_url(get_permalink()),
		esc_attr(get_the_time('g:ia e')),
		esc_attr(get_the_date('c')),
		esc_html(get_the_date()),
		get_the_category_list(', ', $post->ID)
	);
}

/**
 * Prints HTML with post permalink on blog pages.
 *
 */
function pf_continue_reading_link() {
	printf(__('<a class="floatRight" href="%1$s" title="%2$s">Continue Reading&hellip;</a>', PF_THEME_FILE),
		esc_url(get_permalink()),
		esc_attr(get_the_title())
	);
}

/**
 * Display more link.
 *
 */
function pf_more_link($more_link, $more_link_text) {
	return str_replace($more_link_text, '<p class="more-link">Continue Reading&hellip;</p>', $more_link);
}
add_filter('the_content_more_link', 'pf_more_link', 10, 2);