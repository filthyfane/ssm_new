$.getScript();
$(document).ready(function(){
	//==================================================
	// POPULATE REPORT
	//==================================================
	$(document).on('click', '.populate-report', function(){
		var reportForm = $(this).closest('form');
		var sp = '&emsp;';
		var data = {
			reportType: reportForm.data('report-type'),
			fileName: reportForm.data('file-name')
		};
		
		switch (reportForm.attr('name')) {
			case 'kik_report_pv_instructaj':
				populatePVInstructaj(reportForm, sp, data);
				break;
			case 'kik_report_pv_predare_documente':
				populatePVPredarePrimire(reportForm, sp, data);
				break;
			case 'kik_report_raport_semestrial':
				populateRapSem(reportForm, sp, data);
				break;
			case 'kik_report_facturi':
				populateRaportFacturi(reportForm, data);
				break;
			case 'kik_report_instructaj':
				populateRaportInstructaj(reportForm, sp, data);
				break;
			case 'kik_report_echipamente':
				populateRaportEchipamente(reportForm, sp, data);
				break;
			case 'kik_report_debite_neincasate':
				populateRaportDebiteNeincasate(reportForm, data);
				break;
			case 'kik_report_accidente':
				populateRaportAccidente(reportForm, sp, data);
				break;
			case 'kik_report_activitati_nerealizate':
				populateRaportActivitatiNerealizate(reportForm, sp, data);
				break;
			case 'kik_report_angajati_noi':
				generateRaportAngajatiNoi(reportForm, sp, data);
				break;
		}
	});
	
	//==================================================
	// POPULATE PV PREDARE DOCUMENTE
	//==================================================
	function populatePVPredarePrimire(reportForm, sp, data){
		reportForm.find('.pv-data-field').html(sp + reportForm.find('#kik_report_pv_predare_documente_data').val() + sp);
		reportForm.find('.pv-reprezentant-ssm').html(sp + reportForm.find('#kik_report_pv_predare_documente_reprezentant_ssm option:selected').html() + sp);
		reportForm.find('.pv-repr-firma-field').html(sp + reportForm.find('#kik_report_pv_predare_documente_reprezentant_firma').val() + sp);
		
		if(reportForm.find('#kik_report_select_firma option:selected').val() != "-1") {
			reportForm.find('.pv-firma-field').html(sp + reportForm.find('#kik_report_select_firma option:selected').html() + sp);
		}	
	};
	
	//==================================================
	// POPULATE PV INSTRUCTAJ
	//==================================================
	function populatePVInstructaj(reportForm, sp, data){
		
		reportForm.find('.nbr-field').html(sp + reportForm.find('#kik_report_pv_instructaj_nr').val() + sp);
		reportForm.find('.pv-data-field').html(sp + reportForm.find('#kik_report_pv_instructaj_data').val() + sp);
		reportForm.find('.pv-reprezentant-ssm').html(sp + reportForm.find('#kik_report_pv_instructaj_reprezentant_ssm option:selected').html() + sp);
		reportForm.find('.pv-repr-firma-field').html(sp + reportForm.find('#kik_report_pv_instructaj_reprezentant_firma').val() + sp);
		reportForm.find('.dept-field').html(sp + reportForm.find('#kik_report_pv_instructaj_departament').val() + sp);
		reportForm.find('.report_box').html(reportForm.find('#kik_report_pv_instructaj_material').val().replace(/(\r\n|\n|\r)/gm, '<br />'));
		//TODO: ce e cu lista angajati?
		
		if(reportForm.find('#kik_report_select_firma option:selected').val() != "-1") {
			reportForm.find('.pv-firma-field').html('&emsp;' + reportForm.find('#kik_report_select_firma option:selected').html() + '&emsp;');
		}
	};
	
	//==================================================
	// POPULATE RAPORT SEMESTRIAL
	//==================================================
	function populateRapSem(reportForm, sp, data){
		
		reportForm.find('.rap_sem_start_date').html(sp + reportForm.find('#kik_rap_sem_start_date').val() + sp);
		reportForm.find('.rap_sem_end_date').html(sp + reportForm.find('#kik_rap_sem_end_date').val() + sp);
	}
	
	//==================================================
	// POPULATE RAPORT FACTURI DE INTOCMIT
	//==================================================
	function populateRaportFacturi(reportForm, data)
	{
		data.kik_report_facturi_data_inceput = reportForm.find('#kik_report_facturi_data_inceput').val();
		data.kik_report_facturi_data_sfarsit = reportForm.find('#kik_report_facturi_data_sfarsit').val();
		data.form_name = reportForm.attr('name');
		data.action = 'KIK_ACTION_Facturi';
		
		functions.populateReport(data);
	}
	
	//==================================================
	// POPULATE RAPORT INSTRUCTAJ
	//==================================================
	function populateRaportInstructaj(reportForm, sp, data){
		var data = {};
		
		data.kik_report_instructaj_data_inceput = reportForm.find('#kik_report_instructaj_data_inceput').val();
		data.kik_report_instructaj_data_sfarsit = reportForm.find('#kik_report_instructaj_data_sfarsit').val();
		data.kik_report_instructaj_inspector = reportForm.find('#kik_report_instructaj_inspector option:selected').val();
		data.form_name = reportForm.attr('name');
		data.action = 'KIK_ACTION_instructaj';
		
		reportForm.find('.report_field.instructaj-data-inceput').html(sp + data.kik_report_instructaj_data_inceput + sp);
		reportForm.find('.report_field.instructaj-data-sfarsit').html(sp + data.kik_report_instructaj_data_sfarsit + sp);
		
		functions.populateReport(data);
	}
	
	//==================================================
	// POPULATE RAPORT ECHIPAMENTE
	//==================================================	
	function populateRaportEchipamente(reportForm, sp, data)
	{
		var data = {};
		
		data.kik_report_echipamente_data_inceput = reportForm.find('#kik_report_echipamente_data_inceput').val();
		data.kik_report_echipamente_data_sfarsit = reportForm.find('#kik_report_echipamente_data_sfarsit').val();
		data.kik_report_echipamente_inspector = reportForm.find('#kik_report_echipamente_inspector option:selected').val();
		data.form_name = reportForm.attr('name');
		data.action = 'KIK_ACTION_Echipamente';
		
		reportForm.find('.echipamente-data-inceput').html(sp + data.kik_report_echipamente_data_inceput + sp);
		reportForm.find('.echipamente-data-sfarsit').html(sp + data.kik_report_echipamente_data_sfarsit + sp);
		
		functions.populateReport(data);
	}
	
	//==================================================
	// POPULATE RAPORT DEBITE NEINCASATE
	//==================================================	
	function populateRaportDebiteNeincasate(reportForm, data)
	{
		data.kik_report_debite_neincasate_data_inceput = reportForm.find('#kik_report_debite_neincasate_data_inceput').val();
		data.kik_report_debite_neincasate_data_sfarsit = reportForm.find('#kik_report_debite_neincasate_data_sfarsit').val();
		data.kik_report_debite_neincasate_inspector    = reportForm.find('#kik_report_debite_neincasate_inspector option:selected').val();
		data.kik_report_debite_neincasate_sales_agent  = reportForm.find('#kik_report_debite_neincasate_sales_agent option:selected').val();
		data.form_name = reportForm.attr('name');
		data.action = 'KIK_ACTION_Debite_neincasate';
		
		functions.populateReport(data);
	}
	
	//==================================================
	// POPULATE RAPORT ACCIDENTE
	//==================================================
	function populateRaportAccidente(reportForm, sp, data)
	{
		data.kik_report_accidente_data_inceput = reportForm.find('#kik_report_accidente_data_inceput').val();
		data.kik_report_accidente_data_sfarsit = reportForm.find('#kik_report_accidente_data_sfarsit').val();
		data.form_name = reportForm.attr('name');
		data.action = 'KIK_ACTION_Accidente';
		
		// old - DO NOT DELETE YET: fill in the preview
		// reportForm.find('.accidente-data-inceput').html(sp + data.kik_report_accidente_data_inceput + sp);
		// reportForm.find('.accidente-data-sfarsit').html(sp + data.kik_report_accidente_data_sfarsit + sp);
		
		functions.populateReport(data);
	}
	
	//==================================================
	// POPULATE RAPORT ACTIVITATI NEREALIZATE
	//==================================================
	function populateRaportActivitatiNerealizate(reportForm, sp, data)
	{	
		data.kik_act_nerealizate_data_inceput = reportForm.find('#kik_act_nerealizate_data_inceput').val();
		data.kik_act_nerealizate_data_sfarsit = reportForm.find('#kik_act_nerealizate_data_sfarsit').val();
		data.kik_act_nerealizate_inspector    = reportForm.find('#kik_act_nerealizate_inspector option:selected').val();
		data.form_name = reportForm.attr('name');
		data.action = 'KIK_ACTION_Activitati_nerealizate';
		
		functions.populateReport(data, reportForm);
	}
	
	//==================================================
	// POPULATE RAPORT ANGAJATI NOI
	//==================================================
	function generateRaportAngajatiNoi(reportForm, sp, data)
	{		
		data.kik_angajati_noi_data_inceput = reportForm.find('#kik_report_angajati_noi_data_inceput').val();
		data.kik_angajati_noi_data_sfarsit = reportForm.find('#kik_report_angajati_noi_data_sfarsit').val();
		data.form_name = reportForm.attr('name');
		data.action = 'KIK_ACTION_Angajati_noi';
		
		functions.populateReport(data);
	}
	
	var functions = {
		populateReport: function(data){
			data.currPostID = $('#curr-post-id').val();
			$.ajax({
				type: 'POST',
				url: WP_PARAMS.URL_AJAX,
				data: data,
				dataType: 'json',
				success: function(response){
					var formObj = $(document).find('form[name="'+response.formName+'"]');
					if(response.success === false){
						showMessage(formObj, response.errMsg, 'alert-danger');
					} else {
						console.log('test');
						$('iframe').remove();
						formObj.append('<iframe src="' + response.pdfUrl + '" height="400" width="100%"></iframe>');
					}
				}
			});
		}
	}
});




	