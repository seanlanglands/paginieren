<?php
/**
 * The template for displaying Tag Archive pages.
 *
 */

get_header(); ?>

	<div id="content" class="two_thirds">
		<h2><?php printf(__('Tag Archives: %s', PF_THEME_FILE), single_tag_title('', false)); ?></h2>
		<?php get_template_part('loop', 'tag'); ?>
	</div> <!-- End Content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>