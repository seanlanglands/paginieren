<?php
/**
 * The template for displaying Category Archive pages.
 *
 */

get_header(); ?>

	<div id="content" class="two_thirds">
    	<h2><?php printf(__('Category Archives: %s', PF_THEME_FILE), '<span>'.single_cat_title('', false).'</span>'); ?></h2>
		<?php get_template_part('loop', 'category'); ?>
    </div> <!-- End Content -->

<?php get_template_part('primary', 'sidebar'); ?>
<?php get_footer(); ?>