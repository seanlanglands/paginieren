<?php
/**
 * The template for displaying the search results page.
 *
 */

get_header(); ?>

	<div class="content two_thirds">

		<?php if(!have_posts()) { ?>
			<h2><?php _e('No Search Results Found', PF_THEME_FILE); ?></h2>
			<p><?php _e('Apologies, but nothing matched your search criteria. Please try again with some different keywords.', PF_THEME_FILE); ?></p>
			<?php get_search_form(); ?>
		<?php } else { ?>
			<h2><?php printf(__('Search Results for: %s', PF_THEME_FILE), '<span>'.get_search_query().'</span>'); ?></h2>
			<?php get_template_part('loop', 'index'); ?>
		<?php } ?>
	
	</div> <!-- End Content -->
	
<?php get_template_part('primary', 'sidebar'); ?>
<?php get_footer(); ?>