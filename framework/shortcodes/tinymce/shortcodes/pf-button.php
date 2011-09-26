<?php 
// Setup base URL to Wordpress directory
$absolute_path = __FILE__;
$path_to_wp = explode('wp-content', $absolute_path);
$wp_url = $path_to_wp[0];

// Access WordPress constants and functions
require_once( $wp_url.'/wp-load.php' );

// URL to TinyMCE plugin folder
$plugin_url = get_template_directory_uri().'/framework/shortcodes/tinymce/';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert Button</title>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>

<style type="text/css" src="<?php bloginfo('url'); ?>/wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>
<link rel="stylesheet" href="<?php echo $plugin_url; ?>shortcode-styles.css" />

<script type="text/javascript">
var ButtonDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ButtonDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertButton(ed) {
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
 
		// Set up vars to contain our input values
		var url = jQuery('#pf-shortcode input#button_url').val(),
		text = jQuery('#pf-shortcode input#button_text').val(),
		size = jQuery('#pf-shortcode select#button_size').val(),
		color = jQuery('#pf-shortcode select#button_color').val(),		 
		style = jQuery('#pf-shortcode select#button_style').val(),		 
		align = jQuery('#pf-shortcode select#button_align').val(),
		target = jQuery('#pf-shortcode select#button_target').val(),
		title = jQuery('#pf-shortcode input#button_title').val(); 		
 
		// Setup the output of our shortcode
		var output = '';
		output = '[button ';
			output += 'size="'+size+'" ';
			output += 'style="'+style+'" ';
			output += 'color="'+color+'" ';
			output += 'align="'+align+'" ';
			output += 'target="'+target+'" ';
 
			// Only insert if the url field is not blank
			if(url) {
				if(url.indexOf('http://', 0) == -1) {
					url = 'http://'+url;
				}
				output += 'url="'+url+'" ';
			}
			if(title) {
				output += 'title="'+title+'" ';
			}
				
		// Check to see if the TEXT field is blank
		if(text) {	
			output += ']'+text+'[/button]';
		}
		else {
			output += ']'+ButtonDialog.local_ed.selection.getContent()+'[/button]';
		}
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ButtonDialog.init, ButtonDialog);
</script>

</head>
<body>
	<div id="pf-shortcode">
		<table>
		<tbody>
			<tr>
				<th valign="top" scope="row">
					<label for="button_url">Button URL</label>
				</th>
				<td><input id="button_url" name="button_url" value="" type="text" /></td>
			</tr>	
			<tr>
				<th valign="top" scope="row">
					<label for="button_text">Button Text</label>
				</th>
				<td><input id="button_text" name="button_text" value="" type="text" /></td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="button_title">Button Title</label>
				</th>
				<td><input id="button_title" name="button_title" value="" type="text" /></td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="button_size">Size</label>
				</th>
				<td>
				<select name="button_size" id="button_size">
					<option value="small">Small</option>
					<option value="medium" selected="selected">Medium</option>
					<option value="large">Large</option>
				</select>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="button_style">Style</label>
				</th>
				<td>
				<select name="button_style" id="button_style">
					<option value="less_round">Less Round</option>
					<option value="round">Round</option>
					<option value="square" selected="selected">Square</option>
				</select>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="button_color">Color</label>
				</th>
				<td>
				<select name="button_color" id="button_color">
					<option value="grey" selected="selected">Gray</option>
					<option value="blue">Blue</option>
					<option value="red">Red</option>
					<option value="green">Green</option>
					<option value="black">Black</option>
				</select>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="button_align">Alignment</label>
				</th>
				<td>
				<select name="button_align" id="button_align">
					<option value="none" selected="selected">None</option>
					<option value="left">Left</option>
					<option value="right">Right</option>
				</select>
				</td>
			</tr>
			<tr>
				<th valign="top" scope="row">
					<label for="button_target">Target</label>
				</th>
				<td>
				<select name="button_target" id="button_target">
					<option value="_self" selected="selected">Same window</option>
					<option value="_blank">New window</option>
				</select>
				</td>
			</tr>
			
		</tbody>
		</table>
		<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" name="cancel" value="Cancel" onclick="tinyMCEPopup.close();" id="cancel">
			</div>

			<div style="float: right">
				<input type="submit" onclick="javascript:ButtonDialog.insert(ButtonDialog.local_ed)" name="insert" value="Insert" id="insert">
			</div>
		</div> <!-- End Action Panel -->
	</div> <!-- End Wrapper -->
</body>
</html>
