/* Login Page Logo JS*/

jQuery( document ).ready(function ($) {

	/* Testing the Logo Image onLoad */
	
	$('#lpl_LoginPageLogo_image_button').click(function(e){ 
		e.preventDefault();
		var lpl_LoginPageLogo_uploader = wp.media({
			title: 'Select or upload a logo',
			button: { text: 'Select Logo' },
			multiple: false
		}).on('select', function(){
			var attachment = lpl_LoginPageLogo_uploader.state().get('selection').first().toJSON();
			$('#lpl_LoginPageLogo_logo_image').val(attachment.url);
			$('#lpl_LoginPageLogo_admin_preview').attr("src", attachment.url);
			$('#lpl_LoginPageLogo_admin_hover_preview').attr("src",  attachment.url); /* Also update the preview image */
	}).open();

		
	});


});