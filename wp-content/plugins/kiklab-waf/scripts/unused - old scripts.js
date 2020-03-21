
	// Add bill
	$('#kik_company_billing_history_add_a').click(function(){
		KIK_AJAX_Bill_Add();
	});
	// Delete bill
	$(document).on('click', '.kik_company_billing_history_delete', function() {
		$('#kik_company_billing_history_add_tr').attr('data-bills', ($('#kik_company_billing_history_add_tr').attr('data-bills') - 0 - 1));
		$(this).parents().eq(6).remove();
	});
	
	
	// Add workpoint
	$('#kik_company_workpoints_add_a').click(function(){
		KIK_AJAX_Workpoint_Add();
	});
	// Delete workpoint
	$(document).on('click', '.kik_company_workpoint_delete', function() {
		$('#kik_company_workpoints_add_tr').attr('data-workpoints', ($('#kik_company_workpoints_add_tr').attr('data-workpoints') - 0 - 1));
		$(this).parents().eq(1).remove();
	});
	
	
	// Add CSSM
	$('#kik_company_cssm_add_a').click(function(){
		KIK_AJAX_CSSM_Add();
	});
	// Delete CSSM
	$(document).on('click', '.kik_company_cssm_delete', function() {
		$('#kik_company_cssm_add_tr').attr('data-cssm', ($('#kik_company_cssm_add_tr').attr('data-cssm') - 0 - 1));
		$(this).parents().eq(6).remove();
	});
	
	
	// Add echipament
	$('#kik_company_echipamente_add_a').click(function(){
		KIK_AJAX_Echipament_Add();
	});
	// Delete echipament
	$(document).on('click', '.kik_company_echipament_delete', function() {
		$('#kik_company_echipamente_add_tr').attr('data-echipamente', ($('#kik_company_echipamente_add_tr').attr('data-echipamente') - 0 - 1));
		$(this).parents().eq(6).remove();
	});
	// echipament: toggle iscir
	$(document).on('change', '.KIK_iscir', function(){
		$(this).parent().next().children().eq(0).children().eq(0).toggle();
		$(this).parent().next().children().eq(0).children().eq(1).toggle();
	});
	
	
	// Add angajat
	$(document).on('click', '#kik_company_angajati_add_a', function(){
		KIK_AJAX_Angajat_Add();
	});
	// Delete angajat
	$(document).on('click', '.kik_company_angajat_delete', function() {
		$('#kik_company_angajati_add_tr').attr('data-angajati', ($('#kik_company_angajati_add_tr').attr('data-angajati') - 0 - 1));
		$(this).parents().eq(6).remove();
	});
	
	
		// Angajati noi
	
	
		// Facturi
	//KIK_AJAX_Facturi();
	$(document).on('click', 'form[name="kik_report_facturi"] .kik_save_btn.edit', function(){
		$('form[name="kik_report_facturi"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		KIK_AJAX_Facturi();
	});
	function KIK_AJAX_Facturi() {
		var post_data = $('form[name="kik_report_facturi"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Facturi';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('form[name="kik_report_facturi"] .report_sheet').html(response);
				$('form[name="kik_report_facturi"] .kik_save_btn_response').html('');
			}
		});
	}
	
	
	
	function KIK_AJAX_Bill_Add() {
		var post_data = {
			action: 'KIK_ACTION_Bill_Add'
		};
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('#kik_company_billing_history_add_tr').before(response);
				$('#kik_company_billing_history_add_tr').attr('data-bills', $('#kik_company_billing_history_add_tr').attr('data-bills') - 0 + 1);
			}
		});
	}
	
	function KIK_AJAX_CSSM_Add() {
		var post_data = {
			action: 'KIK_ACTION_CSSM_Add'
		};
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('#kik_company_cssm_add_tr').before(response);
				$('#kik_company_cssm_add_tr').attr('data-cssm', $('#kik_company_cssm_add_tr').attr('data-cssm') - 0 + 1);
			}
		});
	}
	
	function KIK_AJAX_Echipament_Add() {
		var post_data = {
			action: 'KIK_ACTION_Echipament_Add'
		};
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('#kik_company_echipamente_add_tr').before(response);
				$('#kik_company_echipamente_add_tr').attr('data-echipamente', $('#kik_company_echipamente_add_tr').attr('data-echipamente') - 0 + 1);
			}
		});
	}
	
	function KIK_AJAX_Angajat_Add() {
		var post_data = {
			action: 'KIK_ACTION_Angajat_Add'
		};
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('#kik_company_angajati_add_tr').before(response);
				$('#kik_company_angajati_add_tr').attr('data-angajati', $('#kik_company_angajati_add_tr').attr('data-angajati') - 0 + 1);
			}
		});
	}
	
		// Raport semestrial de activitate
	//KIK_AJAX_Raport_semestrial_de_activitate();
	$(document).on('click', 'form[name="kik_report_raport_semestrial"] .kik_save_btn.edit', function(){
		$('form[name="kik_report_raport_semestrial"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		KIK_AJAX_Raport_semestrial_de_activitate();
	});
	function KIK_AJAX_Raport_semestrial_de_activitate() {
		var post_data = $('form[name="kik_report_raport_semestrial"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Raport_semestrial_de_activitate';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('form[name="kik_report_raport_semestrial"] .report_sheet').html(response);
				$('form[name="kik_report_raport_semestrial"] .kik_save_btn_response').html('');
			}
		});
	}
	
	// Instructaj
	//KIK_AJAX_Instructaj();
	$(document).on('click', 'form[name="kik_report_instructaj"] .kik_save_btn.edit', function(){
		$('form[name="kik_report_instructaj"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		KIK_AJAX_Instructaj();
	});
	function KIK_AJAX_Instructaj() {
		var post_data = $('form[name="kik_report_instructaj"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Instructaj';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('form[name="kik_report_instructaj"] .report_sheet').html(response);
				$('form[name="kik_report_instructaj"] .kik_save_btn_response').html('');
			}
		});
	}
	
	//// REMOVE WP STUFF ////
	/*
	var wp_stuff = '' + 
		'#wpfooter, ' +  // footer with 'thank you' and wp version number
		'.type-kik_company > .post-title > .row-actions, ' + // quick edit links
		'.subsubsub, ' + // All | Published | Trash
		'#xxxposts-filter > .search-box, ' + // post listing search box
		//'.tablenav > .actions, ' + 
		'.tablenav > .tablenav-pages, ' + 
		'.tablenav > .view-switch, ' + 
		'#filter-by-date, ' + 
		'.alignleft.actions.bulkactions, ' + 
		'#wpadminbar > *, ' + 
		'#posts-filter > .wp-list-table > tfoot, ' + 
		'#screen-options-wrap, ' + 
		'#screen-meta-links, ' + 
		'#welcome-panel, ' + 
		'#dashboard-widgets-wrap, ' + 
		'';
	alert(wp_stuff);
	$(wp_stuff).remove();
	*/
	
	//$('#event_meta_box').removeClass('closed');
	//$('#reservation_meta_box').removeClass('closed');
	
	//$('#KIK_AUTOR').prepend('<option value="" selected="selected">Creat de</option>');
	
	//// DateTimePicker init ////
	/*
	$('.datetimepicker_input').each(function(){
		$(this).parent().css({'position':'relative'});
		$(this).parent().append('<div class="datetimepicker_clicker" onclick="KIK_DateTimePicker(\'' + $(this).attr('id') + '\',\'yyyyMMdd\',\'arrow\',true,24);"></div>');
	});*/
	
	function KIK_AJAX_Workpoint_Add() {
		var post_data = {
			action: 'KIK_ACTION_Workpoint_Add'
		};
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('#kik_company_workpoints_add_tr').before(response);
				$('#kik_company_workpoints_add_tr').attr('data-workpoints', $('#kik_company_workpoints_add_tr').attr('data-workpoints') - 0 + 1);
			}
		});
	}
	
		// PV instructaj
	//KIK_AJAX_PV_instructaj();
	/*$(document).on('click', 'form[name="kik_report_pv_instructaj"] .kik_save_btn.edit', function(){
		$('form[name="kik_report_pv_instructaj"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		KIK_AJAX_PV_instructaj();
	});*/
	function KIK_AJAX_PV_instructaj() {
		var post_data = $('form[name="kik_report_pv_instructaj"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_PV_instructaj';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('form[name="kik_report_pv_instructaj"] .report_sheet').html(response);
				$('form[name="kik_report_pv_instructaj"] .kik_save_btn_response').html('');
			}
		});
	} 
	
	
	// Echipamente
	//KIK_AJAX_Echipamente();
	$(document).on('click', 'form[name="kik_report_echipamente"] .kik_save_btn.edit', function(){
		$('form[name="kik_report_echipamente"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		//KIK_AJAX_Echipamente();
	});
	function KIK_AJAX_Echipamente() {
		var post_data = $('form[name="kik_report_echipamente"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Echipamente';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('form[name="kik_report_echipamente"] .report_sheet').html(response);
				$('form[name="kik_report_echipamente"] .kik_save_btn_response').html('');
			}
		});
	}

		
	
	// Debite neincasate
	//KIK_AJAX_Debite_neincasate();
	$(document).on('click', 'form[name="kik_report_debite_neincasate"] .kik_save_btn.edit', function(){
		$('form[name="kik_report_debite_neincasate"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		//KIK_AJAX_Debite_neincasate();
	});
	function KIK_AJAX_Debite_neincasate() {
		var post_data = $('form[name="kik_report_debite_neincasate"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Debite_neincasate';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('form[name="kik_report_debite_neincasate"] .report_sheet').html(response);
				$('form[name="kik_report_debite_neincasate"] .kik_save_btn_response').html('');
			}
		});
	}
	
	// Add accident
	$('#kik_company_accidente_add_a').click(function(){
		KIK_AJAX_Accident_Add();
	});
	
	function KIK_AJAX_Accident_Add() {
		var post_data = {
			action: 'KIK_ACTION_Accident_Add'
		};
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('#kik_company_accidente_add_tr').before(response);
				$('#kik_company_accidente_add_tr').attr('data-accidente', $('#kik_company_accidente_add_tr').attr('data-accidente') - 0 + 1);
			}
		});
	}
	
	// Accidente
	//KIK_AJAX_Accidente();
	$(document).on('click', 'form[name="kik_report_accidente"] .kik_save_btn.edit', function(){
		$('form[name="kik_report_accidente"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		//KIK_AJAX_Accidente();
	});
	function KIK_AJAX_Accidente() {
		var post_data = $('form[name="kik_report_accidente"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Accidente';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('form[name="kik_report_accidente"] .report_sheet').html(response);
				$('form[name="kik_report_accidente"] .kik_save_btn_response').html('');
			}
		});
	}
	
		///////// print pdf
/* 	$(document).on('click', '.kik_save_btn.print', function(){
		//var $window = window;
		var textToPdf = $(this).closest('form').find('.report_sheet').clone();
		var currForm = $(this).closest('form');
		var formName = currForm.attr('name');
		
		data = {};
		data.action = 'KIK_ACTION_Save_New_Pdf';
		
		switch(formName){
			case "kik_report_pv_predare_documente":
				var companyID = $('#kik_report_pv_predare_documente_firma option:selected').val();
				data.reportType = "Proces-verbal";
		}
		
		console.log(companyID);
		
		textToPdf.find('input[type="checkbox"]').each(function(){
			if ($(this).is(':checked')) {
				$(this).closest('p').html($(this).data('document'));
			} else {
				$(this).closest('p').remove();
			}
		});
		
		console.log(textToPdf.html());
		
		
		data.pdfText = textToPdf.html();
		data.companyID = companyID;
		data.fileName = 'PV_predare_documente';
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			success: function(response){
				//console.log(response);
				//$window.print();
			}
		});
		
	}); */
	
	
		// Activitati nerealizate
	KIK_AJAX_Activitati_nerealizate();
	$(document).on('click', 'form[name="kik_report_activitati_nerealizate"] .kik_save_btn.edit', function(){
		$('form[name="kik_report_activitati_nerealizate"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		KIK_AJAX_Activitati_nerealizate();
	});
	function KIK_AJAX_Activitati_nerealizate() {
		var post_data = $('form[name="kik_report_activitati_nerealizate"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Activitati_nerealizate';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('form[name="kik_report_activitati_nerealizate"] .report_sheet').html(response);
				$('form[name="kik_report_activitati_nerealizate"] .kik_save_btn_response').html('');
			}
		});
	}

	//////////////////// reports
	
	function KIK_AJAX_PV_predare_documente() {
		var post_data = $('form[name="kik_report_pv_predare_documente"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_PV_predare_documente';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('form[name="kik_report_pv_predare_documente"] .report_sheet').html(response);
				$('form[name="kik_report_pv_predare_documente"] .kik_save_btn_response').html('');
			}
		});
	}
	// USER PAGE
	/*function sanitize(str) {
		str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim, "");
		return str.trim();
	}
	$(document).on('change', '#kik_user_first_name, #kik_user_last_name', function(){
		var username = sanitize($('#kik_user_first_name').val()) + '.' + sanitize($('#kik_user_last_name').val());
		$('#kik_user_login').val();
	});*/
	
		//KIK_AJAX_Angajati_noi();
	$(document).on('click', 'form[name="kik_report_angajati_noi"] .kik_save_btn.edit', function(){
		$('form[name="kik_report_angajati_noi"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		KIK_AJAX_Angajati_noi();
	});
	function KIK_AJAX_Angajati_noi() {
		var post_data = $('form[name="kik_report_angajati_noi"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Angajati_noi';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('form[name="kik_report_angajati_noi"] .report_sheet').html(response);
				$('form[name="kik_report_angajati_noi"] .kik_save_btn_response').html('');
			}
		});
	}