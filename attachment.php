<?php
/**
 * The template for displaying attachments.
 *
 */

get_header(); ?>

	<div id="content" class="two_thirds">

	<?php if (have_posts()) {
		while (have_posts()) { the_post(); ?>

		<!-- <p><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'starkers' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php /* translators: %s - title of parent post */ printf( __( '&larr; %s', 'starkers' ), get_the_title( $post->post_parent ) ); ?></a></p> -->
				
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header class="entry-header">
        		<h3 class="entry-title"><?php the_title(); ?></a></h3>       
        		<div class="entry-meta">
					<?php
						printf(__('<span class="by-author"><span>by</span> <span class="author"><a href="%1$s" title="%2$s" rel="author">%3$s</a></span></span> <span>on </span><a class="entry-date" href="%4$s" title="%5$s"><time datetime="%6$s" pubdate>%7$s</time></a>', PF_THEME_FILE),
							esc_url(get_author_posts_url(get_the_author_meta('ID'))),
							sprintf(esc_attr(__('View all posts by %s', PF_THEME_FILE)), get_the_author()),
							esc_html(get_the_author()),
							esc_url(get_permalink()),
							esc_attr(get_the_time('g:ia e')),
							esc_attr(get_the_date('c')),
							esc_html(get_the_date())
						);
						edit_post_link(__('Edit', PF_THEME_FILE), '<span class="edit-link">', '</span>');
					?>
				</div>
			</header>

		<?php if (wp_attachment_is_image()) { ?>
			<p><a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php
				echo wp_get_attachment_image($post->ID, array(626, 9999)); ?></a>
			</p>
				
			<nav class="next_prev clearfix">
				<p class="floatLeft"><?php previous_image_link(false, '&larr; '.__('Previous Attachment', PF_THEME_FILE)); ?></p>
				<p class="floatRight"><?php next_image_link(false, __('Next Attachment', PF_THEME_FILE).' &rarr;'); ?></p>
			</nav>
		<?php } else { ?>
			<p><a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_permalink(); ?></a></p>
		<?php } ?>
			<?php if (!empty($post->post_excerpt)) the_excerpt(); ?>

			<?php the_content(); ?>

			<?php wp_link_pages(array('before' => '<nav>'.__('Pages: ', PF_THEME_FILE), 'after' => '</nav>')); ?>

			<?php comments_template(); ?>
			
		</article>

	<?php }
	} ?>

	</div> <!-- End Content -->
	
<?php get_template_part('primary', 'sidebar'); ?>
<?php get_footer(); ?>