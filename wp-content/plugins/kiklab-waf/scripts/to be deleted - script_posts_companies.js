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
	var accidentFilesOptions = ('ajax_datatable_accident_file', 'btn-new-accident-file', 'Adaugă dosar', 'new-accident-file-modal');
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
	$('#add-new-bill').on('click', function(){
		data = {};
		data.dataFacturii = $('#kik_new_bill_date').val();
		data.nrFactura = $('#kik_new_bill_number').val();
		data.sumaFactura = $('#kik_new_bill_amount').val();
		data.termenPlata = $('#kik_new_bill_deadline').val();
		data.postId = $('#kik_company_id').val();
		data.action = 'KIK_ACTION_Save_New_Bill';
		
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				var beforeObj = $(document).find('#billing-table_wrapper');
				showMessage(beforeObj, 'Ședință CSSM creată cu succes!');
				$('#new-bill-modal').modal('hide');
				billingTable.ajax.reload();
			}
		});
	});	
	
	
	//===========================================
	//MODAL SAVE NEW PARTIAL PAYMENT
	//===========================================	
	$('#new-partial-payment').on('show.bs.modal', function(e){
		var triggerBtn = $(e.relatedTarget);
		$('#add-new-partial-payment').attr('data-bill-id', triggerBtn.data('bill-id'));
	})
	
	$(document).on('click', '#add-new-partial-payment', function(){

		var currModal = $(this).closest('.modal');
		data={};
		data.facturaId = $(this).attr('data-bill-id');
		data.dataPlatiiPartiale = currModal.find('#kik_data_factura_partiala').val();
		data.sumaPlatita = currModal.find('#kik_suma_plata_partiala').val();
		data.postId = $('#kik_company_id').val();
		data.action = 'KIK_ACTION_Save_Partial_Payment';
				
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			success: function(response){
				$('#new-partial-payment').modal('hide');
				billingTable.ajax.reload();
			}
		});
	});
	
	//============================================
	//MODAL SAVE NEW CSSM MEETING
	//============================================
	$(document).on('click', '#add-new-cssm', function(){

		var data = {};
		data.dataSedintei = $('#kik_new_cssm_date').val();
		data.realizat = $('#kik_new_cssm_made').is(":checked");
		data.postId = $('#kik_company_id').val();
		data.action = 'KIK_ACTION_Save_New_CSSM_Meeting';
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				var beforeObj = $(document).find('#cssm-table_wrapper');
				showMessage(beforeObj, 'Factura a fost creată cu succes!');
				$('#new-cssm-modal').modal('hide');
				cssmTable.ajax.reload();
			}
		});
	})
	
	//============================================
	//MODAL SAVE NEW INSTRUCTAJ
	//============================================
	$(document).on('click', '#add-new-instructaj', function(){
		var data = {};
		data.tipInstructaj = $('#kik_new_type_instructaj option:selected').val();
		data.dataInstructajului = $('#kik_new_instructaj_date').val();
		data.realizat = $('#kik_new_instructaj_realizat').is(":checked");
		data.postId = $('#kik_company_id').val();
		data.action = "KIK_ACTION_Save_New_Instructaj";
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				var beforeObj = $(document).find('#instructaje-table_wrapper');
				showMessage(beforeObj, 'Instructajul a fost creat cu succes!');
				$('#new-instructaj-modal').modal('hide');
				instructajTable.ajax.reload();
			}
		});
		
	});
	
	//============================================
	//MODAL SAVE NEW EQUIPMENT
	//============================================
	$(document).on('click', '#add-new-equipment', function(){
		
		var data={};
		data.idEchipament = $('#kik_echipament').val();
		data.numeEchipament = $('#kik_echipament option:selected').text();
		data.nrBuc = $('#kik_echipament_bucati').val();
		data.dataExpirare = $('#kik_echipament_data_exp').val();
		data.iscir = $('#kik_echipament_iscir').prop('checked');
		
		if(data.iscir === true){
			data.dataExpIscir = $('#kik_echipament_iscir_exp').val();
		}
		
		data.postId = $('#kik_company_id').val();
		data.action = 'KIK_ACTION_Save_New_Equipment';
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				var beforeObj = $(document).find('#echipamente-table_wrapper');
				showMessage(beforeObj, 'Echipamentul a fost creat cu succes!');
				$('#new-echipament-modal').modal('hide');
				equipmentTable.ajax.reload();
			}
		});
	});
	
	//============================================
	//MODAL SAVE NEW EMPLOYEE
	//============================================
	$(document).on('click', '#add-new-employee', function(){
		var data = {};
		data.numeAngajat = $('#kik_angajat_lastname').val();
		data.prenumeAngajat = $('#kik_angajat_firstname').val();
		data.functieAngajat = $('#kik_angajat_functie').val();
		data.adresaAngajat = $('#kik_angajat_adresa').val();
		data.cnpAngajat = $('#kik_angajat_cnp').val();
		data.normaAngajat = $('#kik_angajat_norma').val();
		data.contractAngajatStart = $('#kik_angajat_contract_start').val();
		data.contractAngajatSfarsit = $('#kik_angajat_contract_end').val();
		data.conducator = $('#kik_angajat_conducator').prop('checked');
		data.autorizatieSpeciala = $('#kik_angajat_autorizatie').prop('checked');
		
		if(data.conducator === true){
			data.telefonAngajat = $('#kik_angajat_telefon').val();
			data.emailAngajat = $('#kik_angajat_email').val();
		}
		
		if(data.autorizatieSpeciala === true){
			data.tipAutorizatie = $('#kik_angajat_tip_autorizatie').val();
			data.expirareAutorizatie = $('#kik_angajat_autorizatie_end').val();
		}
		data.postId = $('#kik_company_id').val();
		data.action = 'KIK_ACTION_Save_New_Employee';
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				var beforeObj = $(document).find('#employees-table_wrapper');
				showMessage(beforeObj, 'Angajatul a fost creat cu succes!');
				$('#new-employee-modal').modal('hide');
				employeesTable.ajax.reload();
		
			}
		});	

	})
	
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
					showMessage($('.nav.nav-tabs'), 'error', 'alert-danger');
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
	
	$('.delete_company')
	
});