/* ---------- Admin scripts ---------- */

jQuery(document).ready(function() {
	
	// Active Input Field
	jQuery('input[type="text"], textarea').focus(function() {
		$(this).addClass("focusField");
	}).blur(function() {
		$(this).removeClass("focusField");
	});
	
	// Initital UI View
	jQuery('.pf_section_wrap').each(function() {
		if(!$(this).hasClass('current_section')) {
			$(this).hide();	
		}
	});
	
	// UI Main Navigation
	jQuery('#pf_nav li a').click(function(e) {
		e.preventDefault();
		var displaySection = $(this).attr('rel');
		var currentTab = $('.tab.current').attr('rel');
		
		$('#'+currentTab).fadeOut('fast', function() {
			$('#'+displaySection).fadeIn();
		});
		
		$('a[rel="'+currentTab+'"]').removeClass('current');
		$('a[rel="'+displaySection+'"]').addClass('current');
		
	});
	
	// Upload Modal
	jQuery('.pf-submit-btn').click(function() {
		$('#tiptip_holder').hide();
		var rel = $(this).attr('rel');
		var formfield = $('input[name="'+rel+'"]').attr('name');
		$('#upload_image_rel').val(formfield);
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});

	window.send_to_editor = function(html) {
		var rel = $('#upload_image_rel').val();
		
		if($('img', html).attr('src') != '') {
			var fileurl = $('img', html).attr('src');
		} else {
			var fileurl = $(html).attr('href');	
		}

		$('input[name="'+rel+'"]').val(fileurl);
		tb_remove();
	}

	// Tinymce Visual/HTML
	jQuery('a.toggleVisual').click(
		function() {
			var id = $(this).attr("href").substring(1, $(this).attr("href").length);
			tinyMCE.execCommand('mceAddControl', false, id);
			return false;
		}
	);
	jQuery('a.toggleHTML').click(
		function() {
			var id = $(this).attr("href").substring(1, $(this).attr("href").length);
			tinyMCE.execCommand('mceRemoveControl', false, id);
			return false;
		}
	);
	
});
