(function($) {
	$(document).ready(function() {
		$("#pushflew_email_edit").click(function() {
			$("#pushflew_email_p").toggle();
			$("#pushflew_email_input").toggle();
			if ($(this).html() == "Edit") {
				$(this).html("Cancel");
			} else {
				$(this).html("Edit");
			}
		});
		$("#pushflew_email_confirm").click(function() {
			var email = "";
			if( $("#pushflew_email_edit").html() == "Edit" ){
				email = $("#pushflew_email_p").html();
			} else if( $("#pushflew_email_edit").html() == "Cancel" ) {
				email = $("#pushflew_email_input").val();
			}
			var data  = "action=pushflew_email_confirm&confirm_email="+email;
			$.ajax({
				url : ajax_var.url,
            	type : 'post',
            	data : data,
            	success : function(response) {
            		html_arr = response.split('"');
            		$("#pushflew_info_alert").html(html_arr[1]);
            		$("#pushflew_info_alert").show();
            		$(".pushflew_info_text").html("");
            	}
			});
		});
	});
}(jQuery));