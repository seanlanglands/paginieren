/* ---------- Custom scripts ---------- */

jQuery(document).ready(function() {
	
	// Active Input Field
	jQuery('input[type="text"], textarea').focus(function() {
		$(this).addClass("focusField");
	}).blur(function() {
		$(this).removeClass("focusField");
	});
	
});