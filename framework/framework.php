<?php
/** 
 * Initial framework constants.
 *
 */
define('PF_HOMEPAGE', 'http://themepress.me/framework/');
define('PF_URL', get_template_directory_uri().'framework');
define('PF_VERSION', '1.0');

/** 
 * Framework setup.
 *
 */
function pf_setup() {
	// Load default widgets
	require('framework-widgets.php');
	
	// Load shortcodes
	require('shortcodes/framework-shortcodes.php');
		
	// This theme uses featured images
	add_theme_support('post-thumbnails');
	add_image_size('blog_thumb', 100, 100, true);	
	
	// Add custom header feature
	add_custom_image_header('pf_header_style', 'pf_admin_header_style', 'pf_admin_header_image');
	define('HEADER_TEXTCOLOR', '333');
	define('HEADER_IMAGE', '');
	add_theme_support('custom-header', array('random-default' => true));

	// The height and width of your custom header
	define('HEADER_IMAGE_WIDTH', 955);
	define('HEADER_IMAGE_HEIGHT', 260);
	
	// Default custom headers
	register_default_headers(array(
		'sap' => array(
			'url' => '%s/framework/images/headers/sap.jpg',
			'thumbnail_url' => '%s/framework/images/headers/sap.jpg',
			'description' => __('Sap', PF_THEME_FILE)
		),
		'tranquil' => array(
			'url' => '%s/framework/images/headers/tranquil.jpg',
			'thumbnail_url' => '%s/framework/images/headers/tranquil.jpg',
			'description' => __('Tranquil', PF_THEME_FILE)
		),
		'sunset' => array(
			'url' => '%s/framework/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/framework/images/headers/sunset.jpg',
			'description' => __('Sunset', PF_THEME_FILE)
		),
		'moss-forest' => array(
			'url' => '%s/framework/images/headers/moss-forest.jpg',
			'thumbnail_url' => '%s/framework/images/headers/moss-forest.jpg',
			'description' => __('Moss Forest', PF_THEME_FILE)
		),
		'dry-grass' => array(
			'url' => '%s/framework/images/headers/dry-grass.jpg',
			'thumbnail_url' => '%s/framework/images/headers/dry-grass.jpg',
			'description' => __('Dry Grass', PF_THEME_FILE)
		)
	));
	
	add_custom_background();
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');
	
	// Add support for a variety of post formats.
	add_theme_support('post-formats', array('gallery', 'image', 'audio', 'video'));
	
	// Themepress uses wp_nav_menu().
	register_nav_menus(array(
		'primary_nav' => 'Primary Navigation',
		'footer_nav' => 'Footer Navigation'
	));
		
	function custom_upload_mimes($existing_mimes = array()) {
		$existing_mimes['ico'] = 'image/x-icon';
		return $existing_mimes;
	}
	add_filter('upload_mimes', 'custom_upload_mimes');
	
	remove_action('wp_head', 'wp_generator');
}
add_action('after_setup_theme', 'pf_setup');

/** 
 * Admin custom header styles
 *
 */
function pf_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1 {
		font-weight: bold;
		font-size: 30px;
		margin: 0 0 5px 0;
		color: #444;
		line-height: 1.2;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#desc {
		color: #888 !important;
		font-size: 16px;
		font-weight: normal;
		line-height: 1;
		margin-bottom: 35px;
	}
	.default-header img {
		width: 200px;
	}
	</style>
<?php
}

/** 
 * Admin custom header output
 *
 */
function pf_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if('blank' == get_theme_mod('header_textcolor', HEADER_TEXTCOLOR) || '' == get_theme_mod('header_textcolor', HEADER_TEXTCOLOR)) {
			$style = 'style="display:none;"';
		} else {
			$style = 'style="color:#'.get_theme_mod('header_textcolor', HEADER_TEXTCOLOR).';"';
		} ?>
		
		<h1><a id="name" <?php echo $style; ?> onclick="return false;" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
		<div id="desc" <?php echo $style; ?>><?php bloginfo('description'); ?></div>
		
		<?php $header_image = get_header_image();
		if(!empty($header_image)) { ?>
			<img src="<?php echo esc_url($header_image); ?>" alt="<?php bloginfo('name'); ?>" />
		<?php } ?>
	</div>
<?php }

/** 
 * Custom header styles
 *
 */
function pf_header_style() {
	if(HEADER_TEXTCOLOR == get_header_textcolor())
		return;
	?>
	<style type="text/css">
	<?php
		// Is text set to be hidden?
		if('blank' == get_header_textcolor()) {
	?>
		#main-header hgroup {
			display: none;
		}
	<?php
		// If the user has set a custom text color
		} else {
	?>
		#main-header hgroup h1 {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php } ?>
	</style>
	<?php
}

/** 
 * Redirect to control panel upon theme activation
 *
 */
if(is_admin() && isset($_GET['activated']) && $pagenow == "themes.php"){
	header('Location: '.admin_url().'admin.php?page=theme-options');
}

/**
 * Add theme options page to the admin menu.
 *
 */
function pf_admin_nav() {
	add_theme_page('Theme Options', 'Theme Options', 0, 'theme-options', 'pf_options');
}
add_action('admin_menu', 'pf_admin_nav');

/**
 * Properly enqueue scripts for our theme options page.
 *
 */
function pf_admin_enqueue_scripts() {
	//Can't seem to get jQuery playing nicely.
	echo '<script type="text/javascript" src="'.get_bloginfo("template_url").'/framework/js/libs/jquery-1.5.2.min.js"></script>'.PHP_EOL;
		
	wp_deregister_script('jquery');
    wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');
    wp_enqueue_script('jquery');
	
	wp_register_script('pf-upload', get_bloginfo("template_url").'/framework/js/admin.js', array('jquery', 'media-upload', 'thickbox'));
	
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('pf-upload');
}
if(is_admin() && isset($_GET['page']) && $_GET['page'] == "theme-options") {
	add_action('admin_print_scripts', 'pf_admin_enqueue_scripts');
}

/**
 * Properly enqueue styles for our theme options page.
 *
 */
function pf_admin_enqueue_styles() {
	wp_enqueue_style('pf-theme-options', get_template_directory_uri().'/framework/css/admin-styles.css', false);
	wp_enqueue_style('thickbox');
}
add_action('admin_print_styles', 'pf_admin_enqueue_styles');

/**
 * Register the form setting for our pf_options array.
 *
 */
function pf_theme_options_init() {
	
	// If we have no options in the database, let's add them now.
	if(false === pf_get_theme_options()) {
		add_option( 'pf_theme_options', pf_get_default_theme_options() );
	}
		register_setting(
			'pf_options',       		// Options group, see settings_fields() call in theme_options_render_page()
			'pf_theme_options', 		// Database option, see pf_get_theme_options()
			'pf_theme_options_validate' // The sanitization callback, see pf_theme_options_validate()
		);
	
}
add_action( 'admin_init', 'pf_theme_options_init' );

/**
 * Returns the options array for pf
 *
 */
function pf_get_theme_options() {
	return get_option( 'pf_theme_options', pf_get_default_theme_options() );
}

/**
 * Returns the default options for pf.
 *
 */
function pf_get_default_theme_options() {
	$default_theme_options = array(
		'general' 		=> array(
			'custom_logo'	=> '',
			'favicon'	=> '',
			'apple_icon'	=> '',
			'apple_startup'	=> '',
			'footer_text'	=> ''
		),
		'seo' 		=> array(
			'seo_desc'	=> '',
			'seo_keywords'	=> '',
			'seo_analytics'	=> ''
		),
		'color_scheme' 		=> 'default',
		'link_color'   		=> pf_get_default_link_color('light'),
		'theme_layout' 		=> 'content-sidebar',
		'welcome_text'    	=> 'This is your blog sub title',
		'social_links' 		=> array(
			'facebook'	=> '',
			'twitter'	=> ''
		)
	);
	
	return apply_filters('pf_default_theme_options', $default_theme_options);
}



/**
 * Returns an array of default theme color schemes.
 *
 */
function pf_color_schemes() {
	$color_scheme_options = array(
		'default' => array(
			'value' => 'light',
			'label' => 'Light',
			'thumbnail' => get_template_directory_uri().'/images/light.png',
			'default_link_color' => '#1b8be0',
		),
		'dark' => array(
			'value' => 'dark',
			'label' => 'Dark',
			'thumbnail' => get_template_directory_uri().'/images/dark.png',
			'default_link_color' => '#e4741f',
		),
	);

	return apply_filters('pf_color_schemes', $color_scheme_options);
}

/**
 * Returns the default link color, based on color scheme.
 *
*/
function pf_get_default_link_color($color_scheme = null) {
	if( null === $color_scheme ) {
		$options = pf_get_theme_options();
		$color_scheme = $options['color_scheme'];
	}

	$color_schemes = pf_color_schemes();
	if( ! isset( $color_schemes[ $color_scheme ] ) )
		return false;

	return $color_schemes[ $color_scheme ]['default_link_color'];
}


/**
 * Returns an array of default layout options.
 *
 */
function pf_layouts() {
	$layout_options = array(
		'content-sidebar' => array(
			'value' => 'content-sidebar',
			'label' => 'Content on left',
			'thumbnail' => get_template_directory_uri().'/images/content-sidebar.png',
		),
		'sidebar-content' => array(
			'value' => 'sidebar-content',
			'label' => 'Content on right',
			'thumbnail' => get_template_directory_uri().'/images/sidebar-content.png',
		),
		'content' => array(
			'value' => 'content',
			'label' => 'One-column, no sidebar',
			'thumbnail' => get_template_directory_uri().'/images/content.png',
		),
	);

	return apply_filters( 'pf_layouts', $layout_options );
}

// Control Panel
function pf_options() { ?>

<div class="wrap">
    <?php settings_errors(); ?>
    <div id="icon-themes" class="icon32"><br></div>
    <h2>Theme Options</h2>   
    
    <div id="pf_container">
    	<form method="post" action="options.php">
        	<input type="hidden" id="upload_image_rel" value="" /> 
            <?php
				settings_fields( 'pf_options' );
				$options = pf_get_theme_options();
				$default_options = pf_get_default_theme_options();
			?>            
            <div id="pf_nav_wrap">
            	<input type="submit" id="pf_submit" class="top-save" value="Save All Changes" />
                <ul id="pf_nav" class="clearfix">
                    <li><a class="current tab" rel="pf_general" id="tab_0" href=""><span>General</span></a></li>
                    <li><a class="tab" rel="pf_seo" id="tab_2" href=""><span>SEO</span></a></li>
                </ul>
            </div>
            
		<div id="pf_general" class="pf_section_wrap current_section">
        
        	<fieldset><div class="legend_wrap"><legend>General</legend></div>
				<table class="pf_form_table">
				<tr valign="top">
                    <th scope="row"><label for="pf_theme_options[general][custom_logo]">Custom Logo</label>
                    <p class="desc">Upload a custom logo or leave blank too use site name and description.</p></th>
                    <td><span><input name="pf_theme_options[general][custom_logo]" type="text" id="pf_theme_options[general][custom_logo]" value="<?php echo $options['general']['custom_logo']; ?>" class="pf_textfield">
                    &nbsp;<input class="pf-submit-btn button-small" type="button" value="Upload" rel="pf_theme_options[general][custom_logo]" /></span>
                    <?php if($options['general']['custom_logo']) { ?>
	                    <div class="custom-image-wrap">
	                    	<img src="<?php echo $options['general']['custom_logo']; ?>" alt="Custom Logo" />
	                    </div>
                    <?php } ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="pf_theme_options[general][favicon]">Custom Favicon</label>
                    <p class="desc">Your favicon must be <strong>16 x 16</strong> <i>.ico</i> format too be supported on all browsers.</p>
                    </th>
                    <td><span><input name="pf_theme_options[general][favicon]" type="text" id="pf_theme_options[general][favicon]" value="<?php echo $options['general']['favicon']; ?>" class="pf_textfield">
                    &nbsp;<input class="pf-submit-btn button-small" type="button" value="Upload" rel="pf_theme_options[general][favicon]" /></span></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="pf_theme_options[general][apple_icon]">Apple Touch Icon</label>
                    <p class="desc">This icon represents your website if a visitor adds it too the home screen of a iOS device. Must be <strong>114 x 114</strong> in dimension.</p>
                    </th>
                    <td><span><input name="pf_theme_options[general][apple_icon]" type="text" id="pf_theme_options[general][apple_icon]" value="<?php echo $options['general']['apple_icon']; ?>" class="pf_textfield">
                    &nbsp;<input class="pf-submit-btn button-small" type="button" value="Upload" rel="pf_theme_options[general][apple_icon]" /></span></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="pf_theme_options[general][apple_startup]">Apple Startup Image</label>
                    <p class="desc">This startup image is displayed while your website launches on an iOS device. Must be <strong>320 x 460</strong> in dimension and in portrait orientation.</p>
                    </th>
                    <td><span><input name="pf_theme_options[general][apple_startup]" type="text" id="pf_theme_options[general][apple_startup]" value="<?php echo $options['general']['apple_startup']; ?>" class="pf_textfield">
                    &nbsp;<input class="pf-submit-btn button-small" type="button" value="Upload" rel="pf_theme_options[general][apple_startup]" /></span></td>
                </tr>
               <tr valign="top">
                    <th scope="row"><label for="pf_theme_options[general][footer_text]">Custom Footer Text</label>
                    </th>
                    <td><span><input name="pf_theme_options[general][footer_text]" type="text" id="pf_theme_options[general][footer_text]" value="<?php echo $options['general']['footer_text']; ?>" class="pf_textfield full_textfield"></td>
                </tr>
            </table>
            </fieldset>
        </div> <!-- End General -->
        
        <div id="pf_seo" class="pf_section_wrap">
        	<fieldset><div class="legend_wrap"><legend>Search Engine Optimization</legend></div>
				<table class="pf_form_table">
                <tr valign="top">
                    <th scope="row"><label for="pf_theme_options[seo_desc]">Description</label>
                    <p class="desc">The META description for your homepage that describes your web site in a sentence.</p>
                    </th>
                    <td><span><textarea name="pf_theme_options[seo_desc]" id="pf_theme_options[seo_desc]" class="pf_textarea small_textarea"><?php echo $options['seo_desc']; ?></textarea></span></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="pf_theme_options[seo_keywords]">Keywords</label>
                    <p class="desc">A comma separated list of your most important keywords for your site that will be written as META keywords on your homepage.</p>
                    </th>
                    <td><span><textarea name="pf_theme_options[seo_keywords]" id="pf_theme_options[seo_keywords]" class="pf_textarea small_textarea"><?php echo $options['seo_keywords']; ?></textarea></span></td>
                </tr>
            </table>
            </fieldset>
            
            <fieldset><div class="legend_wrap"><a class="help-link" href="http://www.google.com/analytics/" target="_blank">Learn More About Google Analytics</a><legend>Analytics</legend> </div>
				<table class="pf_form_table">
                <tr valign="top">
                    <th scope="row"><label for="pf_theme_options[seo_analytics]">Google Analytics Code</label>
                    <p class="desc">Insert your Google Analytics tracking code too track your visitors.</p>
</th>
                    <td><span><textarea name="pf_theme_options[seo_analytics]" id="pf_theme_options[seo_analytics]" class="code pf_textarea medium_textarea"><?php echo $options['seo_analytics']; ?></textarea></span></td>
                </tr>
            </table>
            </fieldset>
        </div> <!-- End SEO -->
        
        <div id="pf_bottom_bar">  
        	<span class="current-theme"><?php echo PF_THEME_NAME; ?> <?php echo PF_THEME_VERSION; ?></span><span class="framework-version">Framework Version <?php echo PF_VERSION; ?></span>   
       		<input type="submit" id="pf_submit" value="Save All Changes" />
        </div> <!-- End Bottom -->
        
    	</form> <!-- End Main Form -->
    	    
    </div> <!-- End Container -->
</div> <!-- End Wrap -->

<?php }

/**
 * Sanitize and validate form input.
 *
 */
function pf_theme_options_validate($input) {
	$output = $defaults = pf_get_default_theme_options();

	// Our defaults for the link color may have changed, based on the color scheme.
	$output['link_color'] = $defaults['link_color'] = pf_get_default_link_color( $output['color_scheme'] );
	
	// General
	
	// Favicon must be .ico format.
	$favicon = $input['general']['favicon'];
	
	$file_extension = explode('.', $favicon);
	if(isset($favicon) && array_pop($file_extension) == 'ico' || $favicon == '') {
		$output['general']['favicon'] = $favicon;
	} else {
		add_settings_error('pf_theme_options', 'settings_updated', 'Error: Favicon must be in .ico format');
	}
	
	$output['general']['custom_logo'] = $input['general']['custom_logo'];	
	$output['general']['apple_icon'] = $input['general']['apple_icon'];
	$output['general']['apple_startup'] = $input['general']['apple_startup'];
	$output['general']['footer_text'] = $input['general']['footer_text'];
	
	// SEO	
	$output['seo_desc'] = $input['seo_desc'];
	$output['seo_keywords'] = $input['seo_keywords'];
	$output['seo_analytics'] = $input['seo_analytics'];
	
	// Theme Settings
	$output['welcome_text'] = $input['welcome_text'];
	
	// Social Media
	add_option('facebook_link', $input['facebook_link']);

	return apply_filters( 'pf_theme_options_validate', $output, $input, $defaults );
}

/**
 * Print Google Analytics code.
 *
 */
function pf_header() {
	$header_image = get_header_image();
	if(!empty( $header_image)) {
?>
	<a href="<?php echo esc_url(home_url('/')); ?>">
		<img style="display: block;" src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
	</a>
<?php }  
}

/**
 * Print Google Analytics code.
 *
 */
function pf_google_analytics() {
	$options = pf_get_theme_options();
	$htmlStr = $options['seo_analytics'];
	
	echo $htmlStr.PHP_EOL;  
}

/**
 * Outputs site logo.
 *
 */
function pf_site_logo() {
	$options = pf_get_theme_options();
	$custom_logo = $options['general']['custom_logo'];
	
	if(!$custom_logo) {
		$htmlStr = '<hgroup><h1 style="color: #'.get_header_textcolor().'"><a href="'.get_bloginfo('url').'" title="'.get_bloginfo('name').'">'.get_bloginfo('name').'</a></h1><h2>'.get_bloginfo('description').'</h2></hgroup>';
	} else {
		$htmlStr = '<hgroup><h1><img src="'.$custom_logo.'" alt="'.get_bloginfo('name').'" title="'.get_bloginfo('description').'" /></h1></hgroup>';
	}

	echo $htmlStr.PHP_EOL;
}


/**
 * Add a style block to the theme for the current link color.
 *
 */
function pf_head() {
	$options = pf_get_theme_options();
	$htmlStr = PHP_EOL;
	if($options['seo_desc'] != '')
		$htmlStr .= '<meta name="description" content="'.$options['seo_desc'].'" />'.PHP_EOL;
	if($options['seo_keywords'] != '')
		$htmlStr .= '<meta name="keywords" content="'.$options['seo_keywords'].'" />'.PHP_EOL;
	if($options['general']['favicon'] != '')
		$htmlStr .= '<link rel="shortcut icon" href="'.$options['general']['favicon'].'">'.PHP_EOL;
	if($options['general']['apple_icon'] != '')
		$htmlStr .= '<link rel="apple-touch-icon" href="'.$options['general']['apple_icon'].'">'.PHP_EOL;
	if($options['general']['apple_startup'] != '')
		$htmlStr .= '<link rel="apple-touch-startup-image" href="'.$options['general']['apple_startup'].'">'.PHP_EOL;
	
	echo $htmlStr.PHP_EOL;	
}
add_action('wp_head', 'pf_head');

/**
 * Redirect to documentation external web page.
 *
 */
function pf_docs() {
	echo "<script type='text/javascript'>window.location='http://themepress.me/themes/".PF_THEME_FILE."/';</script>";
}

/**
 * Redirect to themes page external web page.
 *
 */
function pf_buy_themes() {
	echo "<script type='text/javascript'>window.location='http://themepress.me/themes/';</script>";
}

function pf_pagination($pages = '', $range = 4) {
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '') {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages) {
             $pages = 1;
         }
     }   
 
     if(1 != $pages) {
         echo "<div class=\"pagination clearfix\"><span class=\"pagination-nav\">Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++) {
             if(1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

/**
 * Register our sidebars and widgetized areas. Along with registering custom widgets.
 *
 */
function pf_widgets_init() {
	register_widget('PF_Recent_Posts');

	register_sidebar(array(
		'name' => __('Primary Sidebar', PF_THEME_FILE),
		'id' => 'primary-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => __('Secondary Sidebar', PF_THEME_FILE),
		'id' => 'secondary-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' =>  __('Front Page Area'),
		'id' => 'front-page-widget-area',
		'description' =>  __('An optional widget area to be used with the front page template', PF_THEME_FILE),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' =>  __('Footer Area'),
		'id' => 'footer-sidebar',
		'description' =>  __('An optional widget area for your site footer', PF_THEME_FILE),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
}
add_action('widgets_init', 'pf_widgets_init');

/**
 * Primary menu fallback if no menu exsists.
 *
 */
function primary_fallback() {
	echo '<nav class="menu-primary-nav-container full_width"><ul id="menu-primary-nav" class="menu">';
	wp_list_pages('depth=0&title_li=');
	echo '</ul></nav>';
}

/**
 * Footer menu fallback if no menu exsists.
 *
 */
function footer_fallback() {
	echo '<nav class="menu-footer-nav-container full_width"><ul id="menu-primary-nav-1" class="sub-footer-menu">';
	wp_list_pages('depth=1&title_li=');
	echo '</ul></nav>';
}

/**
 * Post type excerpt filter.
 *
 */
function shortcode_excerpt_filter($str) {
	global $post;
	if(!is_single() && has_post_format('video') || has_post_format('audio') || has_post_format('gallery')) {
		$pattern = get_shortcode_regex();
		preg_match_all( '/'.$pattern.'/s', $post->post_content, $matches );
		if(is_array( $matches ) && array_key_exists( 2, $matches ) && in_array('video', $matches[2]) || in_array('audio', $matches[2]) || in_array('gallery', $matches[2])) {
			return $matches[0][0];
		}
	} else if(has_post_format('image')) {
		$str = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
		return '<img class="image-format" src="'.$str[0].'" alt="'.get_the_title().'" /><p class="image-format-caption">'.get_post(get_post_thumbnail_id())->post_excerpt.'</p>';
	}
	return $str;
}

add_filter('the_content', 'shortcode_excerpt_filter');

/** 
 * Remove default gallery styles.
 *
 */
add_filter('use_default_gallery_style', '__return_false');

/** 
 * HTML5 input types.
 *
 */
function pf_input_types($fields) {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');
	$fields =  array(
		'author' => '<div class="comment-fields"><p><label for="author">'.__('Your Name', PF_THEME_FILE).'</label> '.($req ? '<span class="required">*</span>' : '').'<br /><input id="author" name="author" type="text" value="'.esc_attr($commenter['comment_author'] ).'" size="30"'.$aria_req.' /></p>',
		'email' => '<p><label for="email">'.__('Your Email', PF_THEME_FILE).'</label> '.($req ? '<span class="required">*</span>' : '').'<br /><input id="email" name="email" type="email" value="'.esc_attr($commenter['comment_author_email']).'" size="30"'.$aria_req.' /></p>',
		'url' => '<p><label for="url">'.__('Website (URL)', PF_THEME_FILE).'</label><br /><input id="url" name="url" type="url" value="'.esc_attr($commenter['comment_author_url']).'" size="30" /></p></div>'
	);
	return $fields;
}
add_filter('comment_form_default_fields','pf_input_types');