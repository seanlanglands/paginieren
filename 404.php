<?php
/**
 * The template for displaying 404 pages.
 *
 */

get_header(); ?>

	<div class="content two_thirds">
		<h2><?php _e('404 Not Found', PF_THEME_FILE); ?></h2>
		<p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find the page or post you are looking for.', PF_THEME_FILE); ?></p>
		<?php get_search_form(); ?>
	</div> <!-- End Content -->

<?php get_template_part('primary', 'sidebar'); ?>
<?php get_footer(); ?>