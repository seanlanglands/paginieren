<?php
/**
 * Shortcodes Tinymce functionality.
 *
 */
function pf_add_tinymce_buttons() {
   if(current_user_can('edit_posts') && current_user_can('edit_pages')) {
     add_filter('mce_external_plugins', 'pf_add_plugins');
     add_filter('mce_buttons_3', 'pf_register_buttons');
   }
}
add_action('init', 'pf_add_tinymce_buttons');

/**
 * Enqueue tinymce styles.
 *
 */
function pf_tinymce_enqueue_styles() {
	wp_enqueue_style('pf-tinymce-styles', get_template_directory_uri() . '/framework/shortcodes/tinymce/shortcode-styles.css', false);
	wp_enqueue_style('pf-tinymce-styles');
	
}
add_action('admin_print_styles', 'pf_tinymce_enqueue_styles');

/**
 * Regisiters button for Tinymce.
 *
 */
function pf_register_buttons($buttons) {
   array_push($buttons, "pf_button", "pf_audio");
   return $buttons;
}

/**
 * Regisiters button plugin for Tinymce.
 *
 */
function pf_add_plugins($plugin_array) {
   $plugin_array['pf_button'] = get_bloginfo('template_url').'/framework/shortcodes/tinymce/editor-plugin.php';
   return $plugin_array;
}

/**
 * Button shortcode.
 *
 */
function pf_buttonOutput($atts, $content = null) {
	extract(shortcode_atts(array(
    	'color' => 'grey',
        'size' => 'medium',
        'style' => 'square',
        'align' => 'none',
        'text' => '',
        'title' => '',
        'target' => '',
        'url' => '',
	), $atts));
	
	$target = 'target="'.$target.'"';
		
	return '<a '.$target.' href="'.$url.'" title="'.$title.'" class="pf_button pf_button_'.$color.' pf_button_'.$size.' pf_button_'.$style.' pf_button_align_'.$align.'">'.$content.'</a>';
}
add_shortcode('button', 'pf_buttonOutput');

/**
 * Column shortcodes.
 *
 */
function pf_columnOutputRow($atts, $content = null) {
	$content = do_shortcode($content);
	return '<div class="row clearfix">'.$content.'</div>';	
}
add_shortcode('row', 'pf_columnOutputRow');

function pf_columnOutput($atts, $content = null) {
	extract(shortcode_atts(array(
    	'column' => 'full_width'
	), $atts));
		
	return '<div class="'.$column.'">'.$content.'</div>';
}
add_shortcode('grid', 'pf_columnOutput');

/**
 * Video shortcode.
 *
 */
function pf_videoOutput($atts, $content = null) {
	extract(shortcode_atts(array(
		'file' => '',
    	'width' => 'full_width',
    	'height' => 'full_width'
	), $atts ) );
		
	return '<video src="'.$file.'" width="626px" height="352px"></video>';
}
add_shortcode('video', 'pf_videoOutput');

/**
 * Audio shortcode.
 *
 */
function pf_audioOutput($atts, $content = null) {
	extract(shortcode_atts(array(
		'file' => '',
    	'width' => 'full_width',
    	'height' => 'full_width'
	), $atts ) );
		
	return '<audio src="'.$file.'"></audio>';
}
add_shortcode('audio', 'pf_audioOutput');
?>