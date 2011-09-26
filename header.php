<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section.
 *
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
?></title>
    
<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="stylesheet/less" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/framework/css/reset.less?ts=<?=time()?>" />
<link rel="stylesheet/less" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/framework/css/grid.less?ts=<?=time()?>" />
<link rel="stylesheet/less" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/framework/css/default.less?ts=<?=time()?>" />

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/framework/js/libs/less-1.1.3.min.js"></script>

<link href='http://fonts.googleapis.com/css?family=Gentium+Book+Basic' rel='stylesheet' type='text/css'>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if(is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>

<?php wp_head(); ?>

<?php pf_google_analytics(); ?>

</head>

<body <?php body_class(); ?>>
    
    <div id="wrapper" class="container_12 clearfix">

        <header id="main-header" class="full_width clearfix">
        	
        	<?php pf_site_logo(); ?>
        	<?php pf_header(); ?>
        	<?php wp_nav_menu(array('container' => 'nav', 'container_class' => 'menu-primary-nav-container full_width', 'theme_location' => 'primary_nav', 'fallback_cb' => 'primary_fallback')); ?>
        	
        </header> <!-- End Header --->
	
    	<div id="main-content" class="clearfix">