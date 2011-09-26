<?php
/**
 * The template for displaying all pages.
 *
 */

get_header(); ?>

	<div class="content two_thirds">
		<?php get_template_part('loop', 'page'); ?>
    </div> <!-- End Content -->
    
<?php get_template_part('primary', 'sidebar'); ?>
<?php get_footer(); ?>