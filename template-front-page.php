<?php
/**
 * Template Name: Front Page
 *
 * Page template used for static front page.
 *
 */
get_header(); ?>

    <div class="content full_width">
		<?php get_template_part('loop', 'page'); ?>
		
		<?php if (is_active_sidebar('front-page-widget-area')) { ?>
			<?php $the_sidebars = wp_get_sidebars_widgets(); ?>
			<div class="front-page-row row widget-cols-<?php echo count($the_sidebars['front-page-widget-area']); ?> clearfix">
				<?php dynamic_sidebar('front-page-widget-area'); ?>
			</div>
		<?php } ?>
	</div> <!-- End Content -->
	
	

<?php get_footer(); ?>