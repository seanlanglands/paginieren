<?php 
header("Content-Type:text/javascript");

// Setup base URL to Wordpress directory
$absolute_path = __FILE__;
$path_to_wp = explode('wp-content', $absolute_path);
$wp_url = $path_to_wp[0];

// Access WordPress constants and functions
require_once( $wp_url.'/wp-load.php' );

// URL to TinyMCE plugin folder
$plugin_url = get_template_directory_uri().'/framework/shortcodes/tinymce/';
?>
(function() {
	tinymce.create('tinymce.plugins.pf_button', {
		init : function(ed, url) {
			_self = this;
			pf_button_editor = ed;
			
			ed.addCommand('mcebutton', function() {
				ed.windowManager.open({
					file : '<?php echo $plugin_url; ?>shortcodes/pf-button.php',
					width : 400 + parseInt(ed.getLang('button.delta_width', 0)),
					height : 395 + parseInt(ed.getLang('button.delta_height', 0)),
					inline : 1
				});
			});
			ed.addButton('pf_button', {title : 'Insert Button', cmd : 'mcebutton' });
		},
	    getInfo : function() {
	      return {
	        longname:  'TinyMCE Generic WP Shortcode Editor',
	        author:    'Cau Guanabara',
	        authorurl: 'http://caugb.com.br',
	        infourl:   '',
	        version:   '1.0'
	      };
	    }
	});
	tinymce.PluginManager.add('pf_button', tinymce.plugins.pf_button); 
})();