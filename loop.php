<?php
/**
 * The loop that displays posts.
 *
 */
?>

<?php if(!have_posts()) { ?>
	<h2><?php _e('Not Found', PF_THEME_FILE); ?></h2>
	<p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', PF_THEME_FILE); ?></p>
	<?php get_search_form(); ?>
<?php } ?>

<?php while(have_posts()) {
	the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<?php if(is_page()) { ?>
			<h2><?php the_title(); ?></h2>
			
        	<?php the_content(); ?>
        	
       	<?php } else if(has_post_format('video') || has_post_format('audio') || has_post_format('image') || has_post_format('gallery')) { ?>
       		<header class="entry-header">
        		<h3 class="entry-title">
                	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
               	</h3>       
        		<div class="entry-meta">
        			<?php pf_posted_on(); ?>
        		</div>
        	</header>
        	
			<?php the_content(); ?>
			
			<footer class="entry-bottom-meta">
        		<?php pf_continue_reading_link(); ?>
        		
        		<?php if(comments_open()) { ?>
					<?php comments_popup_link('<span class="leave-reply">'.__('0 Comments', PF_THEME_FILE) . '</span>', _x('1 Comment', 'comments number', PF_THEME_FILE), _x( '% Comments', 'comments number', PF_THEME_FILE)); ?>
				<?php } ?>
				
        		<?php edit_post_link(__('Edit', PF_THEME_FILE), '<span class="edit-link">', '</span>'); ?>
        	</footer>
		<?php } else { ?>
        	<?php if(has_post_thumbnail()) { ?>
        		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        			<?php the_post_thumbnail('blog_thumb'); ?>
        		</a>
        	<?php } ?>

        	<header class="entry-header">
        		<h3 class="entry-title">
                	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
               	</h3>       
        		<div class="entry-meta">
        			<?php pf_posted_on(); ?>
        		</div>
        	</header>
        	        
        	<div class="entry-summary">
        		<?php the_excerpt(); ?>
        		<?php the_tags('<div class="entry-tags">Tags: ',', ','</div>'); ?>
        	</div>
        	
        	
        	<footer class="entry-bottom-meta">
        		<?php pf_continue_reading_link(); ?>
        		
        		<?php if(comments_open()) { ?>
					<?php comments_popup_link('<span class="leave-reply">'.__('0 Comments', PF_THEME_FILE) . '</span>', _x('1 Comment', 'comments number', PF_THEME_FILE), _x( '% Comments', 'comments number', PF_THEME_FILE)); ?>
				<?php } ?>
				
        		<?php edit_post_link(__('Edit', PF_THEME_FILE), '<span class="edit-link">', '</span>'); ?>
        	</footer>
        	
     	<?php } ?>
	</article>

<?php } // End the loop. ?>

<?php pf_pagination($additional_loop->max_num_pages); ?>