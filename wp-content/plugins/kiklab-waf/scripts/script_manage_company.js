$.getScript();
$(document).ready(function(){

	function getDataTableOptions(action, className, btnText, modalId){
		return {
			language: translationRO,
			dom : getDomDataTable("B"),
			order: [[ 0, "desc" ]],
			ajax: {
				url: WP_PARAMS.URL_AJAX,
				type: "POST",
				data: {
					kik_company_id: $('#kik_company_id').val(),
					action: action,
				}
			},
			"buttons": {
				dom: {
					container: {className: 'pull-right dt-new-btn ' + className},
					button: {tag: 'a', className: 'btn btn-primary'},
					buttonLiner: {tag: ''}
				},
				buttons: [{ 
					text: btnText,
					action: function(e, dt, node, config){
						$('#' + modalId).modal('show');
					}
				}]		
			},
		};
	}
	
	// DATATABLE FACTURI	
	var billingOptions = getDataTableOptions('ajax_datatable_facturi', 'btn-new-bill-modal', 'Adaugă factură', 'new-bill-modal');
	billingOptions.rowCallback = function(row, data, index) {
		var currRow = $(row);
		var overdue = currRow.find('.overdue');
		
		if(overdue.length > 0){
			currRow.addClass('bg-danger');
		}
	}
	var billingTable = jQuery('#billing-table').DataTable(billingOptions);
	
	// DATATABLE CSSM
	var cssmOptions = getDataTableOptions('ajax_datatable_cssm', 'btn-new-cssm-modal', 'Adaugă ședință CSSM', 'new-cssm-modal');
	var cssmTable = jQuery('#cssm-table').DataTable(cssmOptions);
	
	// DATATABLE INSTRUCTAJ
	var instructajOptions = getDataTableOptions('ajax_datatable_instructaje', 'btn-new-instructaj-modal', 'Adaugă instructaj', 'new-instructaj-modal');
	var instructajTable = jQuery('#instructaje-table').DataTable(instructajOptions);
	
	// DATATABLES ECHIPAMENTE
	var equipmentOptions = getDataTableOptions('ajax_datatable_echipamente', 'btn-new-echipament-modal', 'Adaugă echipament', 'new-echipament-modal');
	var equipmentTable = jQuery('#echipamente-table').DataTable(equipmentOptions);
	
	// DATATABLES ANGAJATI
	var employeesOptions = getDataTableOptions('ajax_datatable_angajati', 'btn-new-employee-modal', 'Adaugă angajat', 'new-employee-modal');
	var employeesTable = jQuery('#employees-table').DataTable(employeesOptions);
	
	//DATATABLES DOSARE ACCIDENTE
	var accidentFilesOptions = getDataTableOptions('ajax_datatable_accident_file', 'btn-new-accident-file', 'Adaugă dosar', 'new-accident-file-modal');
	var accidentFilesTable = jQuery('#accident-file-table').DataTable(accidentFilesOptions);
	
	//DATATABLES ALL REPORTS
	var allReports = jQuery('#rapoarte-table').DataTable({
		language: translationRO,
		order: [[ 1, "desc" ]],
		ajax: {
			url: WP_PARAMS.URL_AJAX,
			type: "POST",
			data: {
				postId: $('body').attr('post-id'),
				action: "ajax_datatable_toate_rapoartele",
			}
		}
	});
	
	//===========================================
	//MODAL SAVE NEW BILL
	//===========================================
	$(document).on('click', '#add-new-bill', function(){
		manageBill($(this));
	});
	
	function manageBill(elem){
		var modal = elem.closest('.modal');
		var data = {
			dataFacturii: modal.find('#kik_new_bill_date').val(),
			nrFactura: 	  modal.find('#kik_new_bill_number').val(),
			sumaFactura:  modal.find('#kik_new_bill_amount').val(),
			termenPlata:  modal.find('#kik_new_bill_deadline').val(),
			postId: 	  $('#kik_company_id').val(),
			action: 	  'KIK_ACTION_Manage_Bill',
			nonce: 		  $('#company-nonce').val(),
		};
		
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				if(response.success === true){
					var beforeObj = $(document).find('#billing-table_wrapper');
					showMessage(beforeObj, 'Factura a fost adăugată cu succes!');
					modal.modal('hide');
					billingTable.ajax.reload();
				} else {
					beforeObj = modal.find('.modal-body');
					showMessage(beforeObj, response.errMsg, 'alert-danger');
				}
			}
		});
	}
	
	//clear form values
	$('#new-bill-modal').on('hidden.bs.modal', function(e){
		$(this).find('#kik_new_bill_date').data('DateTimePicker').clear();
		$(this).find('#kik_new_bill_number').val('');
		$(this).find('#kik_new_bill_amount').val('');
		$(this).find('#kik_new_bill_deadline').val('');
	});
	
	//===========================================
	//MODAL SAVE NEW PARTIAL PAYMENT
	//===========================================	
	$('#new-partial-payment').on('show.bs.modal', function(e){
		var triggerBtn = $(e.relatedTarget);
		$('#add-new-partial-payment').attr('data-bill-id', triggerBtn.data('bill-id'));
	})
	
	$(document).on('click', '#add-new-partial-payment', function(){
		var modal = $(this).closest('.modal');
		var data = {
			facturaId: 			$(this).attr('data-bill-id'),
			dataPlatiiPartiale: modal.find('#kik_data_factura_partiala').val(),
			sumaPlatita: 		modal.find('#kik_suma_plata_partiala').val(),
			postId: 			$('#kik_company_id').val(),
			nonce: 		  		$('#company-nonce').val(),
			action: 			'KIK_ACTION_Save_Partial_Payment'
		};
		
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				if(response.success === true) {
					var beforeObj = $(document).find('#billing-table_wrapper');
					showMessage(beforeObj, 'Plata parțială a fost adăugată cu succes!');
					modal.modal('hide');
					billingTable.ajax.reload();					
				} else {
					beforeObj = modal.find('.modal-body');
					showMessage(beforeObj, response.errMsg, 'alert-danger');
				}
			}
		});
	});
	
	$('#new-partial-payment').on('hidden.bs.modal', function(e){
		$(this).find('#kik_data_factura_partiala').data('DateTimePicker').clear();;
		$(this).find('#kik_suma_plata_partiala').val('');
	});
	
	//============================================
	//MODAL SAVE NEW CSSM
	//============================================
	
	$(document).on('click', '#add-new-cssm, #update-cssm', function(){
		manageCssm($(this));
	});
	
	function manageCssm(elem){
		var modal = elem.closest('.modal');
		var data = {
			dataSedintei: 	modal.find('#kik_new_cssm_date').val(),
			dataRealizarii: modal.find('#kik_cssm_fulfill_date').val(),
			cssmID: 		elem.attr('record-id'),
			postId: 		$('#kik_company_id').val(),
			actionType: 	elem.attr('action-type'),
			modalId: 		modal.attr('id'),
			action: 		'KIK_ACTION_Manage_CSSM',
			nonce: 			$('#company-nonce').val()
		};
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				if(response.success === true){
					var beforeObj = $(document).find('#cssm-table_wrapper');
					showMessage(beforeObj, 'Ședința a fost creată cu succes!');
					modal.modal('hide');
					cssmTable.ajax.reload();
				} else {
					beforeObj = modal.find('.modal-body');
					showMessage(beforeObj, response.errMsg, 'alert-danger');
				}
			}
		});
	}
	
	//todo start
	//============================================
	// MODAL EDIT CSSM (GET CONTENT)
	//============================================
	$(document).on('click', '#edit-cssm-div', function(){	
		if($(this).hasClass('disabled')){
			return;
		}
		var data = {
			action: 'kik_get_cssm_data_modal',
			cssmID: $(this).attr('record-id')
		};
		
		$('#update-cssm').attr('record-id', $(this).attr('record-id'));
		
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			success: function(response){
				if(response.success === true){
					$('#edit-cssm-modal').find('.modal-body').html(response.html);
					$('.new-cssm-datepicker, .fulfill-cssm-datepicker').datetimepicker({format: 'DD/MM/YYYY'});
					$('#edit-cssm-modal').modal('show');
				} else {
					var beforeObj = $(document).find('#cssm-table_wrapper');
					showMessage(beforeObj, response.errMsg, 'alert-danger');
				}
			}
		});
	});	
	
	//clear form values
	$('#new-cssm-modal').on('hidden.bs.modal', function(e){
		$('.fulfill-cssm-datepicker').data('DateTimePicker').clear();
		$('.new-cssm-datepicker').data('DateTimePicker').clear();
	});
	
	/////to do end
	
	//============================================
	//MODAL SAVE NEW/UPDATE INSTRUCTAJ
	//============================================
	function manageInstructaj(elem){
		var modal = elem.closest('.modal');
		var data = {
			tipInstructaj: 		modal.find('#kik_new_type_instructaj option:selected').val(),
			dataInstructajului: modal.find('#kik_new_instructaj_date').val(),
			dataRealizarii: 	modal.find('#kik_instructaj_fulfill_date').val(),
			instructajId: 		elem.attr('record-id'),
			postId: 			$('#kik_company_id').val(),
			actionType: 		elem.attr('action-type'),
			modalId: 			modal.attr('id'),
			action: 			'KIK_ACTION_Manage_Instructaj',
			nonce: 				$('#company-nonce').val(),
		};
		
		console.log(data);
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				if(response.success === true){
					var beforeObj = $(document).find('#instructaje-table_wrapper');
					showMessage(beforeObj, 'Instructajul a fost creat cu succes!');
					$('#' + response.modalId).modal('hide');
					instructajTable.ajax.reload();
				} else {
					beforeObj = modal.find('.modal-body');
					showMessage(beforeObj, response.errMsg, 'alert-danger');
				}
			}
		});
	}
	
	$(document).on('click', '#add-new-instructaj', function(){
		manageInstructaj($(this));
	});
	
	$(document).on('click', '#update-instructaj', function(){
		manageInstructaj($(this));
	});
	
	//============================================
	// MODAL EDIT INSTRUCTAJ (GET CONTENT)
	//============================================
	$(document).on('click', '#edit-instructaj-div', function(){	
		if($(this).hasClass('disabled')){
			return;
		}
		var data = {
			action: 'kik_get_instructaje_data_modal',
			instructajID: $(this).attr('record-id')
		};
		
		$('#update-instructaj').attr('record-id', $(this).attr('record-id'));
		
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			success: function(response){
				if(response.success === true){
					$('#edit-instructaj-modal').find('.modal-body').html(response.html);
					$(document).find('#edit-instructaj-modal #kik_new_type_instructaj').prop('disabled', true);
					$('.new-instructaj-datepicker, .fulfill-instructaj-datepicker').datetimepicker({format: 'DD/MM/YYYY'});
					$('#edit-instructaj-modal').modal('show');
				} else {
					var beforeObj = $(document).find('#instructaje-table_wrapper');
					
					showMessage(beforeObj, 'Eroare!', 'alert-danger');
				}
			}
		});
	});	
	
	//clear form values
	$('#new-instructaj-modal').on('hidden.bs.modal', function(e){
		$(this).find('select option:selected').prop('selected', false);
		$('#kik_instructaj_fulfill_date').data('DateTimePicker').clear();
		$('#kik_new_instructaj_date').data('DateTimePicker').clear();
	});
	
	//============================================
	//MODAL SAVE NEW EQUIPMENT
	//============================================
	$(document).on('click', '#add-new-equipment', function(){
		manageEquipment($(this));
	});
	
	function manageEquipment(elem){
		var modal = elem.closest('.modal');
		
		var data = {
			idEchipament: 	modal.find('#kik_echipament').val(),
			numeEchipament: modal.find('#kik_echipament option:selected').text(),
			nrBuc: 			modal.find('#kik_echipament_bucati').val(),
			dataExpirare: 	modal.find('#kik_echipament_data_exp').val(),
			iscir: 			modal.find('#kik_echipament_iscir').prop('checked'),
			postId: 		$('#kik_company_id').val(),
			action: 		'KIK_ACTION_Manage_Equipment',
			nonce: 			$('#company-nonce').val(),
		}
		
		if(data.iscir === true){
			data.dataExpIscir = modal.find('#kik_echipament_iscir_exp').val();
		}
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				if(response.success === true){
					var beforeObj = $(document).find('#echipamente-table_wrapper');
					showMessage(beforeObj, 'Echipamentul a fost adăugat cu succes!');
					$('#' + response.modalId).modal('hide');
					equipmentTable.ajax.reload();
				} else {
					beforeObj = modal.find('.modal-body');
					showMessage(beforeObj, response.errMsg, 'alert-danger');
				}
			}
		});
	}
	
	//clear form values
	$('#new-echipament-modal').on('hidden.bs.modal', function(e){
		$(this).find('select option:selected').prop('selected', false);
		$(this).find('input').val('');
		$(this).find('#kik_echipament_iscir').prop('checked', false);
		$(this).find('#kik_echipament_iscir_exp').closest('.form-group').hide();
		$('#kik_echipament_data_exp').data('DateTimePicker').clear();
		$('#kik_echipament_iscir_exp').data('DateTimePicker').clear();
	});
	
	//============================================
	//MODAL SAVE/UPDATE EMPLOYEE
	//============================================
	$(document).on('click', '#add-new-employee, #update-employee', function(){
		var modal = $(this).closest('.modal');
		var data = {
			nonce: 					$('#company-nonce').val(),
			numeAngajat: 			modal.find('#kik_angajat_lastname').val(),
			prenumeAngajat: 		modal.find('#kik_angajat_firstname').val(),
			functieAngajat: 		modal.find('#kik_angajat_functie').val(),
			adresaAngajat: 			modal.find('#kik_angajat_adresa').val(),
			cnpAngajat: 			modal.find('#kik_angajat_cnp').val(),
			normaAngajat: 			modal.find('#kik_angajat_norma').val(),
			contractAngajatStart: 	modal.find('#kik_angajat_contract_start').val(),
			contractAngajatSfarsit: modal.find('#kik_angajat_contract_end').val(),
			conducator: 			modal.find('#kik_angajat_conducator').prop('checked'),
			autorizatieSpeciala: 	modal.find('#kik_angajat_autorizatie').prop('checked'),
			postId: 				modal.find('#kik_company_id').val(),
			action: 				'KIK_ACTION_Manage_Employee',
			actionType:				$(this).attr('action-type')
		};
		
		if(data.conducator === true){
			data.telefonAngajat = modal.find('#kik_angajat_telefon').val();
			data.emailAngajat = modal.find('#kik_angajat_email').val();
		}
		
		if(data.autorizatieSpeciala === true){
			data.tipAutorizatie = modal.find('#kik_angajat_tip_autorizatie').val();
			data.expirareAutorizatie = modal.find('#kik_angajat_autorizatie_end').val();
		}
		
		if(typeof $(this).attr('record-id') !== 'undefined' && $(this).attr('record-id')!== false){
			data.recordId = $(this).attr('record-id');
		}
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				if(response.success === true){
					var beforeObj = $(document).find('#employees-table_wrapper');
					showMessage(beforeObj, 'Angajatul a fost creat/actualizat cu succes!');
					$('#' + response.modalId).modal('hide');
					employeesTable.ajax.reload();
				} else {
					beforeObj = modal.find('.modal-body');
					showMessage(beforeObj, response.errMsg, 'alert-danger');
				}
			}
		});	

	})

	$('#new-employee-modal').on('hidden.bs.modal', function(e){
		$(this).find('select option:selected').prop('selected', false);
		$(this).find('input').val('');
		$(this).find('#kik_angajat_conducator, #kik_angajat_autorizatie').prop('checked', false);
		$(this).find('#kik_angajat_autorizatie_end').data('DateTimePicker').clear();
		$(this).find('#kik_angajat_telefon, #kik_angajat_email, #kik_angajat_tip_autorizatie, #kik_angajat_autorizatie_end').closest('.form-group').hide();
	});
	//============================================
	//MODAL EDITEAZA ANGAJAT
	//============================================	
	$(document).on('click', '#edit-angajat-div', function(){
		var data = {
			action: 'ajax_get_employee_data_modal',
			employeeID: $(this).attr('record-id')
		};
		
		$('#update-employee').attr('record-id', $(this).attr('record-id'));
		
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			success: function(response){
				if(response.success === true){
					$('#edit-employee-modal').find('.modal-body').html(response.html);
					$('.new-data-exp-datepicker').datetimepicker({format: 'DD/MM/YYYY'});
					$('#edit-employee-modal').modal('show');
				} else {
					var beforeObj = $(document).find('#instructaje-table_wrapper');
					showMessage(beforeObj, 'Eroare!', 'alert-danger');
				}
			}
		});
		
	});
	
	//============================================
	//MODAL ADAUGA DOSAR CERCETARE ACCIDENT
	//============================================
	
	$(document).on('click', '#add-new-file', function(){
		var data = {};
		
		data.dataAccidentului = $('#kik_data_accidentului').val();
		data.dataCercetarii = $('#kik_data_cercetarii').val();
		data.accidentDescriere = $('#kik_accident_descriere').val();
		
		if (typeof $('#kik_accident_angajat').val() !== 'undefined') {
			data.accidentAngajat = $('#kik_accident_angajat option:selected').val();
		} else {
			$('.modal-body').prepend('Nu există nici un angajat pentru această companie! ');
			return;
		}
		
		data.postId = $('#kik_company_id').val();
		data.action = 'KIK_ACTION_Save_New_File';
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				
				var beforeObj = $(document).find('#accident-file-table_wrapper');
				showMessage(beforeObj, 'Dosarul de cercetare a fost creat cu succes!');
				$('#new-accident-file-modal').modal('hide');
				accidentFilesTable.ajax.reload();
			}
		});	
		
	});
	
	//=================================================
	//MANAGE COMPANY WORKPOINTS
	//=================================================	
	
	// ADD WORKPOINT SKELETON
	$(document).on('click', '#add-repeating-workpoint', function(){
		
		var workpointClone = $('.workpoint-skeleton').clone();
		var lastWorkpoint = $('.workpoint-added').last();
		workpointClone.removeClass('workpoint-skeleton').addClass('workpoint-added');
		
		if(lastWorkpoint.length > 0){
			lastWorkpoint.after(workpointClone);
		} else {
			workpointClone.find('label').text('Adresă punct de lucru:');
			$(this).closest('.form-group').before(workpointClone);
		}
	});
	
	// REMOVE WORKPOINT
	$(document).on('click', '.remove-workpoint', function(){
		var workpoint = $(this).closest('.workpoint');
		if (workpoint.find('label').text() != ''){
			workpoint.next().find('label').text('Punct de lucru');
		}
		workpoint.remove(workpoint.outerHTML);
	});
	
	//=================================================
	//MANAGE COMPANY INSTRUCTAJE
	//=================================================	
	
	//ADD INSTRUCTAJ
	$(document).on('click', '#add-repeating-training', function(){
		
		var instructaj = $('.instructaj-skeleton').clone();
		var lastInstructaj = $('.data-instructaj').last();
		
		instructaj.removeClass('instructaj-skeleton').addClass('data-instructaj');
		lastInstructaj.after(instructaj);
	});
	
	//REMOVE INSTRUCTAJ
	$(document).on('click', '.remove-instructaj', function(){
		$(this).closest('.data-instructaj').remove();
	});
	
	//SELECT 2 CAEN CODES
	$('#kik_company_caen').select2();
	
	
	// SAVE COMPANY
	$(document).on('click', 'form[name="kik_company"] .kik_save_btn.edit', function(){
		var post_data = $('form[name="kik_company"]').serialize();
		var post_data = post_data + '&action=KIK_ACTION_Save_Post';
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: post_data,
			dataType: 'json',
			success: function(response){
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				if(response.success === true){
					showMessage($('.nav.nav-tabs'), 'Compania a fost actualizată cu succes!');
				} else {
					showMessage($('.nav.nav-tabs'), response.errMsg, 'alert-danger');
				}
				console.log(response);
				/* if(response === 'update') {
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						var beforeObj = $(document).find('.save-company-container');
						showMessage(beforeObj, 'Datele au fost salvate cu succes!');
				} */
			}
		});
	});
	
	$('#confirm-delete-company-modal').on('show.bs.modal', function(e){
		var button = $(e.relatedTarget);
		$('#btn-delete-company').attr('href', button.attr('delete-link'));
	});
});