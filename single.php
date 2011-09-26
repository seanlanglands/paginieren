<?php
/**
 * The Template for displaying all single posts.
 *
 */

get_header(); ?>

	<div id="content" class="two_thirds">
	
	<?php while(have_posts()) { the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<header class="entry-header">
        		<h3 class="entry-title"><?php the_title(); ?></a></h3>       
        		<div class="entry-meta">
        			<?php pf_posted_on(); ?>
        		</div>
        	</header>
			
			<div class="entry">
            	<?php the_content(); ?>
            	<?php the_tags('<div class="entry-tags">Tags: ',', ','</div>'); ?>
            </div>
 
            <nav class="next_prev clearfix">
                <p class="floatLeft"><?php previous_post_link('%link', ''._x('&larr;', 'Previous post link', PF_THEME_FILE).' %title'); ?></p>
                <p class="floatRight"><?php next_post_link('%link', '%title '._x('&rarr;', 'Next post link', PF_THEME_FILE).''); ?></p>
            </nav>

           
				
		</article>

	<?php } ?>
	
	 <?php comments_template('', false); ?>
	</div> <!-- End Content -->

<?php get_template_part('primary', 'sidebar'); ?>
<?php get_footer(); ?>