$.getScript();
$(document).ready(function(){
	var allCompaniesOptions = {
		order: [[ 0, "asc" ]],
		language: translationRO,
		columnDefs: [
			{"width": "auto", "targets": 0},
			{"width": "80px", "targets": 1},
			{"width": "auto", "targets": 2},
			{"width": "245px", "targets": 3},
			{"width": "110px", "targets": 4},
			{"orderable": false, "targets": 5},
		],
		pageLength: 100,
		ajax: {
			"url": WP_PARAMS.URL_AJAX,
			"type": "POST",
			"data": {
				"action": "ajax_datatables_companies"  
			}
		}
	}
	
	var companiesDataTable = $('#kik_all_companies').DataTable(allCompaniesOptions);
	
	//=========================================
	// QUICK UPDATE
	//=========================================
	$(document).on('click', '.kik_company_update', function() {
		var currRow = $(this).closest('tr');
		var data = {
			action: 'KIK_ACTION_Quick_Update_Company',
			postId: $(this).attr('data-company-id'),
			inspectorId: currRow.find('#kik_company_inspector').val(),
			salesAgentId: currRow.find('#kik_company_sales_agent').val(),
			companyStatus: currRow.find('#kik_company_status').val()
		};
		
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			dataType: 'json',
			data: data,
			success: function(response){
				if(response.success === true){
					$('html, body').animate({ scrollTop: 0 }, 'fast');
					showMessage($('#kik_all_companies_wrapper'), 'Compania a fost actualizată cu succes!');
				}
			}
		});
	});
});