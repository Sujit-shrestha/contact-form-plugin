
jQuery(document).on("click", '#cfp_form_btn',
	function (event) {
		event.preventDefault();

		var form = jQuery('#cfp_form_template').serialize();
    
		jQuery.ajax({
      
			url: cfp_jquery_object.ajax_url,
			data: {
				'data': form,
				'action': 'submit_cfp_form_action',
				'author': cfp_jquery_object.current_user_id,
				'nonce': cfp_jquery_object.cfp_nonce

			},
			type: 'post',
			success: function (result) {

    
				if (!result.success) {

					

				} else {

					//Providing success message to the user
					jQuery("#cfp_form_template").html("<h3>Thanks for submittion of the form. We will get back to you soon. </h3>");

				}

			}
		});
	});

	