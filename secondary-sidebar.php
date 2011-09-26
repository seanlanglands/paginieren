<?php
/**
 * The primary aside that contains widget areas.
 *
 */
?>

<?php if(is_page_template('template-3-column-sidebar-right.php') || is_page_template('template-3-column-sidebar-left.php')) { ?>
	<aside class="secondary-sidebar sidebar one_fifth clearfix">
<?php } else { ?>
	<aside class="secondary-sidebar sidebar one_third clearfix">
<?php } ?>

	<?php if (is_active_sidebar( 'secondary-sidebar')) : ?>
		<?php dynamic_sidebar('secondary-sidebar'); ?>
	<?php endif; ?>

</aside>