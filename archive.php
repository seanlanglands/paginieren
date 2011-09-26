<?php
/**
 * The template for displaying Archive pages.
 *
 */

get_header(); ?>

	<div class="content two_thirds">

	<?php
	if (have_posts())
		the_post();
	?>
	
		<h2>
	<?php if (is_day()) { ?>
		<?php printf(__('Daily Archives: %s', PF_THEME_FILE), get_the_date()); ?>
	<?php } elseif (is_month()) { ?>
		<?php printf(__('Monthly Archives: %s', PF_THEME_FILE), get_the_date('F Y')); ?>
	<?php } elseif (is_year()) { ?>
			<?php printf(__('Yearly Archives: %s', PF_THEME_FILE), get_the_date('Y')); ?>
	<?php } else { ?>
			<?php _e('Blog Archives', PF_THEME_FILE); ?>
	<?php } ?>
		</h2>
		
	<?php
	rewind_posts();
	get_template_part('loop', 'archive');
	?>
	</div> <!-- End Content -->

<?php get_template_part('primary', 'sidebar'); ?>
<?php get_footer(); ?>