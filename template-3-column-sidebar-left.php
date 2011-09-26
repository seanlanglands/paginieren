<?php
/**
 * Template Name: 3 Column - Primary Sidebar Left
 *
 * Page template with 3 columns; primary sidebar, content area and secondary sidebar.
 *
 */
 
get_header(); ?>

<?php get_template_part('primary', 'sidebar'); ?>

	<div class="content three_fifths">
		<?php get_template_part('loop', 'page'); ?>
    </div> <!-- End Content -->
    
<?php get_template_part('secondary', 'sidebar'); ?>

<?php get_footer(); ?>