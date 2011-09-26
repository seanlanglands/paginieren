<?php
/**
 * The template for displaying Author Archive pages.
 *
 */

get_header(); ?>

	<div id="content" class="two_thirds">

	<?php if (have_posts()) the_post(); ?>

		<?php
		// If a user has filled out their description, show a bio on their entries.
		if (get_the_author_meta('description')) { ?>
		<div class="author-info clearfix">
			<div class="author-avatar"><?php echo get_avatar(get_the_author_meta('user_email'), 100); ?></div>
			<h2><?php printf(__('About %s', PF_THEME_FILE), get_the_author()); ?></h2>
			<?php the_author_meta('description'); ?>
		</div>
		<?php } ?>
		
		<h2 class="page-title"><?php printf(__('Author Archives: %s', PF_THEME_FILE), get_the_author()); ?></h2>
		
		<?php
			rewind_posts();
		
			get_template_part('loop', 'author');
		?>

	</div> <!-- End Contents -->

<?php get_template_part('primary', 'sidebar'); ?>
<?php get_footer(); ?>