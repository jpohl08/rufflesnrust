/**
Author: Sampression
Author URI: sampression.com
This Script helps in Theme Options to make the Browse button functional and like wise...
*/
jQuery(document).ready(function() {
	jQuery('.upload_image_button').click(function() {
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			if(imageholder){
				imageholder.attr('src',imgurl);
			}
			formvar.val(imgurl);
			tb_remove();
		}
		formfield = jQuery(this).prev('.upload_image').attr('name');
		formvar = jQuery(this).prev('.upload_image');
		imageholder = jQuery(this).parent().find('.image-holder img');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
});

function load_theme_action(act) {
	if(act == 'restore') {
		var ans = confirm("You are about to re-store default settings.\nDo you want to continue?");
		if(ans) {
			window.document.getElementById('sampression_theme_action').value = act;
			window.document.frm_theme_option.submit();
		} else {
			return false;
		}
		return false;
	} else {
		window.document.getElementById('sampression_theme_action').value = act;
		window.document.frm_theme_option.submit();
	}
}

function check_frontend_logo() {
	if(window.document.getElementById('logo_front_end').checked == true) {
		window.document.getElementById('sam_use_logo').value = 'yes';
	} else {
		window.document.getElementById('sam_use_logo').value = 'no';
	}
}