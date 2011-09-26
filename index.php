<?php
/**
 * The main template file.
 *
 */
get_header(); ?>

    <div class="content two_thirds">
		<?php get_template_part('loop', 'index'); ?>
	</div> <!-- End Content -->

<?php get_template_part('primary', 'sidebar'); ?>
<?php get_footer(); ?>