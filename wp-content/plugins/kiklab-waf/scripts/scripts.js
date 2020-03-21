//alert('scripts are working');

var $ = jQuery;
var menuDataTable = '<div class="form-group"><label for="datatable-elem-per-page">Afișează: </label>';
	menuDataTable += "<select class='form-control' id='datatable-elem-per-page'>";
	menuDataTable += 		"<option value='10'>10</option>";
	menuDataTable +=		"<option value='25'>25</option>";
	menuDataTable += 		"<option value='50'>50</option>";
	menuDataTable += 		"<option value='100'>100</option>";
	menuDataTable += "</select>";
	menuDataTable += "înregistrări pe pagină";
	menuDataTable += "</div>";
	
var translationRO = {
		"sProcessing":   "Procesează...",
		"sLengthMenu":   menuDataTable, //"Afișează _MENU_ înregistrări pe pagină",
		"sZeroRecords":  "Nu am găsit nimic - ne pare rău",
		"sInfo":         "Afișate de la _START_ la _END_ din _TOTAL_ înregistrări",
		"sInfoEmpty":    "Afișate de la 0 la 0 din 0 înregistrări",
		"sInfoFiltered": "(filtrate dintr-un total de _MAX_ înregistrări)",
		"sInfoPostFix":  "",
		"sSearch":       "Caută:",
		"sUrl":          "",
		"oPaginate": {
			"sFirst":    "Prima",
			"sPrevious": "Precedenta",
			"sNext":     "Următoarea",
			"sLast":     "Ultima"
		}		
	}
	
$.extend($.fn.dataTableExt.oStdClasses, {
	"sFilterInput": "form-control datatable-search-field",
});

//==============================================
//SHOW BOOTSTRAP MESSAGES
//==============================================
function showMessage(beforeObj, text, alertType='alert-success'){
	$('html, body, .modal').animate({ scrollTop: 0 }, 'fast');
	beforeObj.before(
		"<div class='message-container'>"	
		+  "<div class='alert " + alertType + "' role='alert'>" 
		+    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
		+ 	   "<span aria-hidden='true'>&times;</span>"
		+    "</button>" + text 
		+  "</div>"
		+"</div>"
	);
	window.setTimeout(function() {
		$(".message-container").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
		});
	}, 5000);
}

function getDomDataTable(button){
	return "<'row'<'col-sm-6'l><'col-sm-6 form-group'"+button+"f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-5'i><'col-sm-7'p>>";
}


$.getScript();
$(document).ready(function(){

	//============================================
	// AJAX START/COMPLETE FUNCTIONS
	//============================================
	$(document).ajaxStart(function(){
		$('#kik_company_tabs_overlay').show().css('opacity', '0.5');
	}).ajaxComplete(function(){
		$('#kik_company_tabs_overlay').hide();
	});
	
	//=============================================
	// DATATABLE COMPANIES
	//=============================================
	jQuery('#companies-table').dataTable({
		"columnDefs": [
			{"width": "auto", "targets": 0},
			{"width": "80px", "targets": 1},
			{"width": "auto", "targets": 2},
			{"width": "245px", "targets": 3},
			{"width": "110px", "targets": 4},
			{"orderable": false, "targets": 5},
		],
		"language": translationRO,
		"dom" : getDomDataTable(''),
		"pageLength": 100
	});
	
	
	
	//=================================================
	// SHOW/HIDE ISCIR EXPIRE DATE
	//=================================================
	$(document).on('change', '#kik_echipament_iscir', function(){
		var iscir = $(this).is(":checked");
		if(iscir === true){
			$('#kik_echipament_iscir_exp').closest('.form-group').show();
		} else {
			$('#kik_echipament_iscir_exp').closest('.form-group').hide();
			$('#kik_echipament_iscir_exp').data("DateTimePicker").clear();
		}
	});
	
	//=================================================
	// SHOW/HIDE ANGAJAT CONDUCATOR LOC MUNCA
	//=================================================
	$(document).on('change', '#kik_angajat_conducator', function(){
		var modal = $(this).closest('.modal');
		var iscir = $(this).is(":checked");
		if(iscir === true){
			modal.find('#kik_angajat_telefon').closest('.form-group').show();
			modal.find('#kik_angajat_email').closest('.form-group').show();
		} else {
			modal.find('#kik_angajat_email').closest('.form-group').hide();
			modal.find('#kik_angajat_telefon').closest('.form-group').hide();
			modal.find('#kik_angajat_email, #kik_angajat_telefon').val('');
		}
	});
	
	//=================================================
	// SHOW/HIDE AUTORIZATIE ANGAJAT
	//=================================================
	$(document).on('change', '#kik_angajat_autorizatie', function(){
		var modal = $(this).closest('.modal');
		var iscir = $(this).is(":checked");
		if(iscir === true){
			modal.find('#kik_angajat_tip_autorizatie').closest('.form-group').show();
			modal.find('#kik_angajat_autorizatie_end').closest('.form-group').show();
		} else {
			modal.find('#kik_angajat_tip_autorizatie').closest('.form-group').hide();
			modal.find('#kik_angajat_autorizatie_end').closest('.form-group').hide();
			modal.find('#kik_angajat_tip_autorizatie').val('');
			modal.find('#kik_angajat_autorizatie_end').data("DateTimePicker").clear();
		}
	});
	
	//=================================================
	//DATEPICKER
	//=================================================
	$('.new-bill-datepicker, .new-cssm-datepicker, .fulfill-cssm-datepicker, .new-data-exp-datepicker, .new-exp-iscir-datepicker, ' + 
		'.new-data-cercetare-datepicker, .new-data-accident-datepicker, .pv-predare-doc-datepicker, .pv-instructaj-datepicker, ' + 
		'.rap-sem-start-date-datepicker, .rap-sem-end-date-datepicker, .pv-instructaj-start-datepicker, .pv-instructaj-end-datepicker, ' + 
		'.new-plata-partiala-datepicker, .datepicker-contract-date, .raport-facturi-data-start, .raport-facturi-data-sfarsit, ' + 
		'.echipamente-start-datepicker, .echipamente-end-datepicker, .debite-neincasate-start-datepicker, .debite-neincasate-end-datepicker, ' +
		'.raport-accidente-data-inceput, .raport-accidente-data-sfarsit, .act-nerealizate-data-inceput, .act-nerealizate-data-sfarsit, ' + 
		'.new-instructaj-datepicker, .fulfill-instructaj-datepicker, .angajati-noi-data-inceput, .angajati-noi-data-sfarsit')
	.datetimepicker({format: 'DD/MM/YYYY'});
	
	//============================================
	// CONFIRM DELETE MODAL
	//============================================
	
	$('#confirm-delete-modal').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var recordId = button.attr('record-id');
		var recordType = button.attr('record-type');
		var modalDeleteBtn = $(this).find('#btn-delete-record');
	
		modalDeleteBtn.attr('record-id', recordId);
		modalDeleteBtn.attr('record-type', recordType);
		if(recordType == 'taxonomy_term'){
			modalDeleteBtn.attr('taxonomy', button.attr('taxonomy'));
		}
		
	});
	
	$('#btn-delete-record').on('click', function(){
		var data = {};
		data.recordId = $(this).attr('record-id');
		data.recordType = $(this).attr('record-type');
		data.postId = $('#kik_company_id').val();
		data.action = 'KIK_ACTION_Delete_Posts';
		
		if(data.recordType == 'taxonomy_term'){
			data.taxonomy = $(this).attr('taxonomy');
		}
		
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				if(response.success === true){
					if(response.dataTableId.length > 0){
						$('#confirm-delete-modal').modal('hide');
						$('#' + response.dataTableId).DataTable().ajax.reload();
					}
					if(response.hasOwnProperty('hasCount') && response.hasCount === true){
						$('.nav.nav-tabs li.active .count-posts, .tab-content .tab-pane.active .count-posts').each(function(key, elem){
							$(this).html($(this).text()-1);
						});
					}
				} else {
					$('#confirm-delete-modal').modal('hide');
					showMessage($("#content"), response.errMsg, "alert-danger");
				}
			}
		});
	});

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/***********************************************************/
	/***********************************************************/
	/*************************OLD SHIT**********************************/
	/***********************************************************/
	/***********************************************************/
	
	// EDIT USER
	/* $(document).on('click', 'form[name="kik_user"] .kik_save_btn.edit', function(){
		$('form[name="kik_user"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		$('#kik_user_companies_sales_associated option').attr('selected', true);
		$('#kik_user_companies_inspector_associated option').attr('selected', true);
		KIK_AJAX_Save_User();
	}); 
	function KIK_AJAX_Save_User() {
		var post_data = $('form[name="kik_user"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Save_User';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			dataType: 'json',
			success: function(response){
				//$('form[name="kik_user"] .kik_save_btn_response').html(response);
				$('#kik_user_first_name').next().html(response.first_name ? '<span class="kik_error">Prenumele nu poate fi gol</span>' : '');
				$('#kik_user_first_name').next().html(response.last_name ? '<span class="kik_error">Numele nu poate fi gol</span>'  : '');
				$('#kik_user_email').next().html(response.email ? (response.email == 'empty' ? '<span class="kik_error">Emailul nu poate fi gol</span>' : (response.email == 'exists' ? '<span class="kik_error">Acest email este asociat unui alt utilizator</span>' : '<span class="kik_error">Emailul este invalid</span>')) : '');
				$('#kik_user_pass').next().html(response.pass ? '<span class="kik_error">Parola este prea scurtă</span>' : '');
				$('#kik_user_pass_confirm').next().html(response.pass_confirm ? '<span class="kik_error">Cele două câmpuri trebuie să se potrivească</span>' : '');
				if (response.status) window.location.reload();
				else $('form[name="kik_user"] .kik_save_btn_response').html('<span class="kik_error">Corectați erorile și încercați din nou!</span>');
				
			}
		});
	}*/
	
	// MANAGE ASSOCIATED COMPANIES
	$(document).on('click', '#kik_user_companies_sales_available_add', function(){
		$('#kik_user_companies_sales_available option:selected').appendTo('#kik_user_companies_sales_associated');
		$('#kik_user_companies_sales_associated').html($('#kik_user_companies_sales_associated option').sort(function(a, b) { return a.text == b.text ? 0 : a.text < b.text ? -1 : 1 }));
	});
	$(document).on('click', '#kik_user_companies_sales_associated_remove', function(){
		$('#kik_user_companies_sales_associated option:selected').appendTo('#kik_user_companies_sales_available');
		$('#kik_user_companies_sales_available').html($('#kik_user_companies_sales_available option').sort(function(a, b) { return a.text == b.text ? 0 : a.text < b.text ? -1 : 1 }));
	});
	$(document).on('click', '#kik_user_companies_inspector_available_add', function(){
		$('#kik_user_companies_inspector_available option:selected').appendTo('#kik_user_companies_inspector_associated');
		$('#kik_user_companies_inspector_associated').html($('#kik_user_companies_inspector_associated option').sort(function(a, b) { return a.text == b.text ? 0 : a.text < b.text ? -1 : 1 }));
	});
	$(document).on('click', '#kik_user_companies_inspector_associated_remove', function(){
		$('#kik_user_companies_inspector_associated option:selected').appendTo('#kik_user_companies_inspector_available');
		$('#kik_user_companies_inspector_available').html($('#kik_user_companies_inspector_available option').sort(function(a, b) { return a.text == b.text ? 0 : a.text < b.text ? -1 : 1 }));
	});
	
	// NEW USER
	/* $(document).on('click', 'form[name="kik_user"] .kik_save_btn.add', function(){
		$('form[name="kik_user"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		//KIK_AJAX_Add_User();
	});
	function KIK_AJAX_Add_User() {
		var post_data = $('form[name="kik_user"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Save_User';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				window.location.href = WP_PARAMS.URL_WP + '/author/' + response;
			}
		});
	} */
	

	
	
	// NEW COMPANY
	/* $(document).on('click', 'form[name="kik_company"] .kik_save_btn.add', function(){
		$('form[name="kik_company"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		$('#kik_company_tabs_overlay').show().animate({'opacity':'0.5'}, 250, function(){
			KIK_AJAX_Add_Post();
		});
	});
	
	function KIK_AJAX_Add_Post() {
		var post_data = $('form[name="kik_company"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Save_Post';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				window.location.href = WP_PARAMS.URL_WP + '/companies/' + response;
			}
		});
	} */
	
	
	
	
	// Upload Angajati
	
	function UploadAngajati(confirmed) {
		var formData = new FormData();
		formData.append('file', $('#UploadAngajati_choose')[0].files[0]);
		formData.append('action', 'KIK_ACTION_Upload_Angajati');
		formData.append('confirmed', confirmed);
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			success: function(response){
				$('#UploadAngajati_message').html(response);
				$('#UploadAngajati_message, #UploadAngajati_submit').show();
				$('#UploadAngajati_choose, #UploadAngajati_submit').attr('disabled', 'disabled');
				$('#UploadAngajati_button_message').html('');
			}
		});
		return false;
	}
	$(document).on('click', '#UploadAngajati_submit', function(){
		if ($('#UploadAngajati_choose')[0].files[0]) {  // if the user has chosen a file
			$('#UploadAngajati_button_message').html('<span class="kik_info">Se încarcă...</span>');
			$('#UploadAngajati_message, #UploadAngajati_submit').hide();
			UploadAngajati(0);  // upload, show expected results and await confirmation
		}
		else {
			$('#UploadAngajati_button_message').html('<span class="kik_error">Alege un fișier de la butonul de sus!</span>');
		}
	});
	$(document).on('click', '#UploadAngajati_confirm', function(){
		if ($('#UploadAngajati_choose')[0].files[0]) {  // if the user has chosen a file
			$('#UploadAngajati_button_message').html('<span class="kik_info">Se încarcă...</span>');
			$('#UploadAngajati_message').hide();
			UploadAngajati(1);  // upload again and make the changes
			$('#UploadAngajati_choose').closest('form')[0].reset();
		}
		else {
			$('#UploadAngajati_button_message').html('<span class="kik_error">Alege un fișier de la butonul de sus!</span>');
		}
	});
	$(document).on('click', '#UploadAngajati_ok', function(){
		$('#UploadAngajati_message').hide().html('');
		$('#UploadAngajati_choose, #UploadAngajati_submit').removeAttr('disabled');
		$('#UploadAngajati_button_message').html('<span class="kik_info">Importați un nou fișier?</span>');
	});
	$(document).on('click', '#UploadAngajati_cancel', function(){
		$('#UploadAngajati_message').hide().html('');
		$('#UploadAngajati_choose').closest('form')[0].reset();
		$('#UploadAngajati_choose, #UploadAngajati_submit').removeAttr('disabled');
		$('#UploadAngajati_button_message').html('<span class="kik_info">Importați un nou fișier?</span>');
	});
	
	// Upload Facturi
	
	function UploadFacturi(confirmed) {
		var formData = new FormData();
		formData.append('file', $('#UploadFacturi_choose')[0].files[0]);
		formData.append('action', 'KIK_ACTION_Upload_Facturi');
		formData.append('confirmed', confirmed);
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			success: function(response){
				
				if(response.length > 0){
					$('#UploadFacturi_message').html(response);
				} else {
					$('#UploadFacturi_message').html('Facturile au fost importate cu succes!');
				}
				$('#UploadFacturi_message, #UploadFacturi_submit').show();
				//$('#UploadFacturi_choose, #UploadFacturi_submit').attr('disabled', 'disabled');
				$('#UploadFacturi_button_message').html('');
				console.log(response.length);
			}
		});
		return false;
	}
	$(document).on('click', '#UploadFacturi_submit', function(){
		if ($('#UploadFacturi_choose')[0].files[0]) {  // if the user has chosen a file
			$('#UploadFacturi_button_message').html('<span class="kik_info">Se încarcă...</span>');
			$('#UploadFacturi_message, #UploadFacturi_submit').hide();
			UploadFacturi(0);  // upload, show expected results and await confirmation
		}
		else {
			$('#UploadFacturi_button_message').html('<span class="kik_error">Alege un fișier de la butonul de sus!</span>');
		}
	});
	$(document).on('click', '#UploadFacturi_confirm', function(){
		if ($('#UploadFacturi_choose')[0].files[0]) {  // if the user has chosen a file
			$('#UploadFacturi_button_message').html('<span class="kik_info">Se încarcă...</span>');
			$('#UploadFacturi_message').hide();
			UploadFacturi(1);  // upload again and make the changes
			$('#UploadFacturi_choose').closest('form')[0].reset();
		}
		else {
			$('#UploadFacturi_button_message').html('<span class="kik_error">Alege un fișier de la butonul de sus!</span>');
		}
	});
	$(document).on('click', '#UploadFacturi_ok', function(){
		$('#UploadFacturi_message').hide().html('');
		$('#UploadFacturi_choose, #UploadFacturi_submit').removeAttr('disabled');
		$('#UploadFacturi_button_message').html('<span class="kik_info">Importați un nou fișier?</span>');
	});
	$(document).on('click', '#UploadFacturi_cancel', function(){
		$('#UploadFacturi_message').hide().html('');
		$('#UploadFacturi_choose').closest('form')[0].reset();
		$('#UploadFacturi_choose, #UploadFacturi_submit').removeAttr('disabled');
		$('#UploadFacturi_button_message').html('<span class="kik_info">Importați un nou fișier?</span>');
	});
	$(document).on('click', '.datetimepicker_input', function(){
		KIK_DateTimePicker($(this).attr('id'), 'yyyyMMdd', 'arrow');
	});
	
	//// AJAX ////
	
	
	

	
	//DO NOT DELETE ==> USED IN IMPORTS 
	$('#kik_company_tab_titles a').click(function(){
		console.log('dddddd');
		
		return;
		$(this).parent().find('.kik_company_tab_title_active').removeClass('kik_company_tab_title_active').addClass('kik_company_tab_title');
		$(this).removeClass('kik_company_tab_title').addClass('kik_company_tab_title_active');
		$(this).parent().next().children().hide();
		$(this).parent().next().children().eq($(this).index()).show();
	});
	
	// angajat: toggle boss,auth
	$(document).on('change', '.KIK_angajat_boss, .KIK_angajat_auth', function(){
		$(this).parent().parent().next().children().eq(0).children().eq(0).toggle();
		$(this).parent().parent().next().children().eq(0).children().eq(1).toggle();
		$(this).parent().parent().next().next().children().eq(0).children().eq(0).toggle();
		$(this).parent().parent().next().next().children().eq(0).children().eq(1).toggle();
	});
	
	// Delete accident
	/* $(document).on('click', '.kik_company_accident_delete', function() {
		$('#kik_company_accidente_add_tr').attr('data-accidente', ($('#kik_company_accidente_add_tr').attr('data-accidente') - 0 - 1));
		$(this).parents().eq(6).remove();
	}); */
	
	
	// synced select boxes: Facturare
	$(document).on('change', '#kik_company_billing_frequency', function(){ $('#kik_company_billing_frequency_dedicated').val($(this).val()); });
	$(document).on('change', '#kik_company_billing_frequency_dedicated', function(){ $('#kik_company_billing_frequency').val($(this).val()); });
	//$(document).on('change', '#kik_company_billing_deadline', function(){ $('#kik_company_billing_deadline_dedicated').val($(this).val()); });
	//$(document).on('change', '#kik_company_billing_deadline_dedicated', function(){ $('#kik_company_billing_deadline').val($(this).val()); });
	$(document).on('change', '#kik_company_billing_deadline_type', function(){ $('#kik_company_billing_deadline_type_dedicated').val($(this).val()); });
	$(document).on('change', '#kik_company_billing_deadline_type_dedicated', function(){ $('#kik_company_billing_deadline_type').val($(this).val()); });
	// synced select boxes: Periodicitate instructaj
	$(document).on('change', '#kik_company_service_frequency', function(){ $('#kik_company_service_frequency_dedicated').val($(this).val()); });
	$(document).on('change', '#kik_company_service_frequency_dedicated', function(){ 
		$('#kik_company_service_frequency').val($(this).val()); 
	});
	$(document).on('change', '#kik_company_service_frequency_history_year', function(){
		$('[data-for="istoric_instructaj"] [data-dependency="year"]').css({'display':'none'});
		$('[data-for="istoric_instructaj"] [data-year="' + $(this).val() + '"]').css({'display':'block'});
	});
	
	
	//// AUTOHINT FIELDS ////
	$(document).on('focus', '[data-autohint="true"]', function(){
		$(this).css({'color':'#333333', 'font-style':'normal'});
		if ($(this).val() == $(this).attr('title')) $(this).val('');
	});
	$(document).on('blur', '[data-autohint="true"]', function(){
		if ($(this).val() == '' || $(this).val() == $(this).attr('title')) {
			$(this).val($(this).attr('title'));
			$(this).css({'color':'#cccccc', 'font-style':'italic'});
		}
	});
	
	
	////////// Categorii de date
	
	// Add term
	$('.kik_term_add_a').click(function(){
		KIK_AJAX_Term_Add($(this).attr('data-taxonomy'));
	});
	function KIK_AJAX_Term_Add(taxonomy) {
		var post_data = {
			action: 'KIK_ACTION_Term_Add',
			taxonomy: taxonomy
		};
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('.kik_term_add_tr[data-taxonomy=' + taxonomy + ']').closest('table').closest('tr').before(response);
				//$('.kik_term_add_tr[data-taxonomy=' + taxonomy + ']').attr('data-count', $('.kik_term_add_tr[data-taxonomy=' + data_for + ']').attr('data-count') - 0 + 1);
			}
		});
	}
	// Delete term
	$(document).on('click', '.kik_term_delete', function() {
		$('.kik_term_add_tr[data-taxonomy=' + $(this).attr('data-taxonomy') + ']').attr('data-count', $('.kik_term_add_tr[data-taxonomy=' + $(this).attr('data-taxonomy') + ']') - 0 - 1);
		$(this).closest('table').closest('tr').remove();
	});
	
	// Save all terms where??
	/* $(document).on('click', 'form[name="kik_terms"] .kik_save_btn.edit', function(){
		$('form[name="kik_terms"] .kik_save_btn_response').html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		KIK_AJAX_Save_Terms();
	}); */
	
	/* function KIK_AJAX_Save_Terms() {
		var post_data = $('form[name="kik_terms"]').serialize();
		var post_data = post_data; //+ '&action=KIK_ACTION_Save_Terms';
		console.log(WP_PARAMS.URL_AJAX);
	
		
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: { big_value : post_data, action : 'KIK_ACTION_Save_Terms'}, //post_data,
			//dataType: 'json',
			success: function(response){
				console.log(response);
				//$('form[name="kik_terms"] .kik_save_btn_response').html(response);
				window.location.reload();
			},
			error: function (request, status, error) {
				alert(request.responseText);}
			
		});
	} */
	
	//// delete post
	$(document).on('click', 'form[name="kik_company"] .kik_delete_btn', function(){
		var message = 'Sigur ștergeți firma?';
		if (confirm(message) == true) {
			KIK_AJAX_Delete_Post();
		}
	});
	function KIK_AJAX_Delete_Post() {
		var post_data = $('form[name="kik_company"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Delete_Post';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				window.location.href = WP_PARAMS.WP_URL;
			}
		});
	}
	
	
	/////// cron
	
	// Test
	/* $(document).on('click', 'form[name="kik_company"] .kik_save_btn.test', function(){
		$(this).next().html('<i class="fa fa-fw fa-refresh fa-spin"></i>');
		KIK_AJAX_Cron_Test();
	});
	function KIK_AJAX_Cron_Test() {
		var post_data = $('form[name="kik_company"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Cron_Test';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			success: function(response){
				$('form[name="kik_company"] .kik_save_btn.test').next().html(response);
			}
		});
	} */
	
	

	
	//==================================================
	// PRINT REPORT
	//==================================================
	$(document).on('click', '.save-pdf-report', function(){
		
		var textToPdf = $(this).closest('form').find('.report_sheet').clone();
		var currForm = $(this).closest('form');
		var formName = currForm.attr('name');

		textToPdf = replaceFormsInReport(textToPdf);
		
		data = {};
		data.action     = 'KIK_ACTION_Save_New_Pdf';
		data.reportType = textToPdf.data('report-type');
		data.formName	= currForm.attr('name');
		data.fileName   = textToPdf.data('file-name');
		data.companyID  = currForm.find('#kik_report_select_firma option:selected').val();
		data.currPostID = $('#curr-post-id').val();
		hasInterval 	= textToPdf.find('[data-start-date]');
		
		if(hasInterval.length > 0){
			data.startDate = hasInterval.data('start-date');
			data.endDate   = hasInterval.data('end-date');
		}
		
		data.pdfText = textToPdf.html();
		
		if (formName === 'kik_report_facturi') {
			PrintElem(currForm.find('.report_container')[0].innerHTML);
		} else {
			printReport(data);
		}
	});
	
	
	function replaceFormsInReport(textToPdf) {
		textToPdf.find('input[type="checkbox"]').each(function(){
			if ($(this).is(':checked')) {
				$(this).closest('p').html($(this).data('document'));
			} else {
				$(this).closest('p').remove();
			}
		});
		
		textToPdf.find('textarea').each(function(){
			$(this).closest('span').html($(this).val().replace(/(\r\n|\n|\r)/gm, '<br />'));
		});
		
		return textToPdf;
	}
	
	
	//==================================================
	// FUNCTION TO PRINT THE REPORT TO PDF
	//==================================================
	function printReport(data){
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			dataType: 'json',
			data: data,
			success: function(response){
				//allReports.ajax.reload();
				console.log(response);
				console.log(response.pdfUrl);
				if(response === 'error'){
					//kik_save_area
				} else {
					let a = document.createElement('a');
					a.href = response.pdfUrl;
					a.download = response.pdfName;
					document.body.append(a);
            		a.click();
            		a.remove();

				}
				//$window.print();
			}
		});
	}
	
	function PrintElem(elem)
	{
		
		var mywindow = window.open('', 'PRINT', 'height=400,width=600');

		mywindow.document.write('<html><head><title>' + document.title  + '</title>');
		mywindow.document.write('</head><body >');
		mywindow.document.write('<h1>' + document.title  + '</h1>');
		mywindow.document.write(elem);
		mywindow.document.write('</body></html>');

		mywindow.document.close(); // necessary for IE >= 10
		mywindow.focus(); // necessary for IE >= 10

		mywindow.print();
		mywindow.close();

		return true;
	}
	
	
	
	
	
});