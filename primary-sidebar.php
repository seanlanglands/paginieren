<?php
/**
 * The primary sidebar that contains widget areas.
 *
 */
?>
<?php if(is_page_template('template-3-column-sidebar-right.php') || is_page_template('template-3-column-sidebar-left.php')) { ?>
	<aside class="primary-sidebar sidebar one_fifth clearfix">
<?php } else { ?>
	<aside class="primary-sidebar sidebar one_third clearfix">
<?php } ?>

	<?php if (is_active_sidebar('primary-sidebar')) : ?>
		<?php dynamic_sidebar('primary-sidebar'); ?>
	<?php endif; ?>

</aside>