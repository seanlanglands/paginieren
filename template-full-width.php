<?php
/**
 * Template Name: Full Width
 *
 * Full width template removes the primary aside so that content
 * can be displayed the entire width of the content area.
 *
 */
get_header(); ?>

    <div class="content full_width">
		<?php get_template_part('loop', 'page'); ?>
	</div> <!-- End Content -->

<?php get_footer(); ?>