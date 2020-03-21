$.getScript();
$(document).ready(function(){
	$(document).on('click', '.save-company-settings', function(){
		var form = $("#container form");
		
		data = {
			kikCompanyName: form.find('#kik_company_name').val(),
			kikRegisteredOffice: form.find('#kik_registered_office').val(),
			kikPhone: form.find('#kik_phone').val(),
			kikCity: form.find('#kik_city').val(),
			kikCounty: form.find('#kik_county').val(),
			kikPostalCode: form.find('#kik_postal_code').val(),
			kikCompanyCui: form.find('#kik_company_cui').val(),
			kikCompanyRecom: form.find('#kik_company_recom').val(),
			nonce: $('#company-settings-nonce').val(),
			action: 'KIK_ACTION_Save_Company_Settings'
		};
		
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




	