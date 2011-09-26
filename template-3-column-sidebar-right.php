<?php
/**
 * Template Name: 3 Column - Primary Sidebar Right
 *
 * Page template with 3 columns; secondary sidebar, content area and primary sidebar.
 *
 */
 
get_header(); ?>

<?php get_template_part('secondary', 'sidebar'); ?>

	<div class="content three_fifths">
		<?php get_template_part('loop', 'page'); ?>
    </div> <!-- End Content -->
    
<?php get_template_part('primary', 'sidebar'); ?>

<?php get_footer(); ?>