$.getScript();
$(document).ready(function(){
	$(document).on('click', '.update-author-btn', function(){
		var form = $("#container form");
		console.log('test');
		
		data = {
			kikAuthorFirstName: form.find('#kik_user_first_name').val(),
			kikAuthorLastName: form.find('#kik_user_last_name').val(),
			kikAuthorMail: form.find('#kik_user_email').val(),
			kikAuthorPass: form.find('#kik_user_pass').val(),
			kikAuthorPassConfirm: form.find('#kik_user_pass_confirm').val(),
			kikUserId: form.find('#user_id').val(),
			nonce: $('#author-nonce').val(),
			action: 'KIK_ACTION_Update_Author'
		};

		console.log(data);
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				if(response.success === true) {
					showMessage(form, 'Datele au fost salvate cu success!');
				} else {
					showMessage(form, response.errMsg, 'alert-danger');
				}
			}
		});
	});
});