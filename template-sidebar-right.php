<?php
/**
 * Template Name: Sidebar Right
 *
 * Full width template removes the primary aside so that content
 * can be displayed the entire width of the content area.
 *
 */
 
get_header(); ?>

	<div class="content two_thirds">
		<?php get_template_part('loop', 'page'); ?>
    </div> <!-- End Content -->
    
<?php get_template_part('primary', 'sidebar'); ?>
<?php get_footer(); ?>