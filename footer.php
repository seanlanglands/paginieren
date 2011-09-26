<?php
/**
 * The template for displaying the footer.
 *
 */
?>
	</div> <!-- End Main Content -->
	
	<footer id="main-footer">
    	
    	<?php if(is_active_sidebar('footer-sidebar')) { ?>
    		<?php $the_sidebars = wp_get_sidebars_widgets(); ?>
    		<div class="footer-cols widget-cols-<?php echo count($the_sidebars['footer-sidebar']); ?> clearfix">
				<?php dynamic_sidebar('footer-sidebar'); ?>
    		</div> <!-- End Footer Cols -->
		<?php } ?>
			
        <div id="bottom-bar" class="clearfix">
        	<?php wp_nav_menu(array('container' => 'nav', 'container_class' => 'menu-footer-nav-container full_width', 'theme_location' => 'footer_nav', 'menu_class' => 'sub-footer-menu', 'fallback_cb' => 'footer_fallback')); ?>
        	<div class="copyright full_width">
        		<p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved. Powered by <a target="_blank" href="http://wordpress.org/" title="Wordpress">WordPress</a>.</p>
        	</div>
        </div> <!-- End Bottom Bar -->
        
    </footer> <!-- End Footer -->
    
    </div> <!-- End Wrapper -->

<!-- Custom Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
<script>window.jQuery || document.write('<script src="<?php bloginfo('template_url'); ?>/framework/js/libs/jquery-1.5.2.min.js">\x3C/script>')</script>

<script src="<?php bloginfo('template_url'); ?>/framework/js/libs/mediaelement/mediaelement-and-player.min.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/framework/js/libs/mediaelement/mediaelementplayer.css" />

<script type="text/javascript">
	$('video, audio').mediaelementplayer();
</script>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/framework/js/scripts.js"></script>

<?php wp_footer(); ?>

</body>
</html>