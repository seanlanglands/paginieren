<?php
/**
 * Template Name: Sidebar Left
 *
 * Full width template removes the primary aside so that content
 * can be displayed the entire width of the content area.
 *
 */
 
get_header(); ?>
<?php get_template_part('primary', 'sidebar'); ?>

	<div class="content two_thirds">
		<?php get_template_part('loop', 'page'); ?>
    </div> <!-- End Content -->

<?php get_footer(); ?>