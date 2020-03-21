var $ = jQuery;

$.getScript()
$(document).ready(function(){
	
	function getDataTable(className, taxonomy, btnText, modalTitle, modalCatPlaceholder, modalDescrPlaceholder){
		var termsDataTable = {
			"order": [[ 0, "desc" ]],
			"autoWidth": false,
			"columnDefs": [
				{"width": "150px", "targets": 0},
				{"width": "auto", "targets": 1},
				{"width": "160px", "orderable": false, "targets": 2},
			],
			"language": translationRO,
			"dom": getDomDataTable('B'),
			"ajax": {
				"url": WP_PARAMS.URL_AJAX,
				"type": "POST",
				"data": {
					"taxonomy" : taxonomy,
					"action": "ajax_datatables_categs"  
				}
			},
			"buttons": {
				dom: {
					container: {className: className},
					button: {tag: 'a', className: 'btn btn-primary'},
					buttonLiner: {tag: ''}
				},
				buttons: [{
					text: btnText,
					action: function (e, dt, node, config){
						var taxonomy = $(e.currentTarget).closest('.dataTables_wrapper').find('table').attr('id');
						$('#btn-add-term').attr('taxonomy', taxonomy);
						$('.term-modal-title').text(modalTitle);
						$('.kik_term_category').attr('placeholder', modalCatPlaceholder);
						$('.kik_term_description').attr('placeholder', modalDescrPlaceholder);
						$('#new-term-modal').modal('show');
					}
				}]
			}
		}
		return $('#' + taxonomy).DataTable(termsDataTable);
	}
	
	var CaenDataTable = getDataTable('pull-right dt-new-btn btn-new-cod-caen', 'kik_cod_caen', 'Adaugă cod CAEN', 'Adaugă cod Caen: ', 'Categorie cod CAEN', 'Descriere cod CAEN');
	var TipContractDataTable = getDataTable('pull-right dt-new-btn btn-new-tip-contract', 'kik_tip_contract', 'Adaugă tip contract', 'Adaugă tip contract:', 'Categorie tip contract', 'Descriere tip contract');
	var PeriodicitateInstructajDataTable = getDataTable('pull-right dt-new-btn btn-new-periodicitate-contract', 'kik_periodicitate_instructaj', 'Adaugă periodicitate contract', 'Adăugare periodicitate contract:', 'Categorie periodicitate', 'Categorie descriere');
	var PerioadaFacturareDataTable = getDataTable('pull-right dt-new-btn btn-new-perioada-facturare', 'kik_perioada_de_facturare', 'Adaugă perioada de facturare', 'Adăugare perioada de facturare:', 'Categorie perioadă de facturare', 'Descriere perioadă facturare');
	var StatusContracteDataTable = getDataTable('pull-right dt-new-btn btn-new-status', 'kik_status', 'Adaugă status', 'Adăugare status:', 'Categorie status', 'Descriere status');
	var DocPredateDataTable = getDataTable('pull-right dt-new-btn btn-new-documente-predate', 'kik_documente_predate', 'Adaugă tip document predat', 'Adăugare tip document predat:', 'Categorie tip document predat', 'Descriere tip document predat');
	var EchipamenteDataTable = getDataTable('pull-right dt-new-btn btn-new-echipament', 'kik_echipamente', 'Adaugă echipament', 'Adăugare echipament:', 'Categorie echipament', 'Descriere echipament');
	var NormeLucruDataTable = getDataTable('pull-right dt-new-btn btn-new-norma-lucru', 'kik_norme_lucru', 'Adaugă normă de lucru', 'Adăugare normă de lucru:', 'Categorie normă de lucru', 'Descriere normă de lucru');
	var AniInstructajDataTable = getDataTable('pull-right dt-new-btn btn-new-ani-instructaj', 'kik_ani_instructaj', 'Adaugă an', 'Adăugare an instructaj:', 'An instructaj', 'Descriere');
	var TipEvenimentDataTable = getDataTable('pull-right dt-new-btn btn-new-tip-eveniment', 'kik_tipuri_evenimente', 'Adaugă tip eveniment', 'Adăugare tip eveniment:', 'Tip eveniment', 'Descriere tip eveniment');
	var TipInstructajDataTable = getDataTable('pull-right dt-new-btn btn-new-tip-instructaj', 'kik_tipuri_instructaj', 'Adaugă tip instructaj', 'Adăugare tip instructaj:', 'Tip instructaj', 'Descriere instructaj');
	
	
	//======================
	// ADD NEW TERM BUTTON
	//======================
	$(document).on('click', '#btn-add-term', function(){
		var data = {};
		data.action 	= "KIK_ACTION_Save_New_Term";
		data.categ		= $(this).closest('.modal').find('input.kik_term_category').val();
		data.descr  	= $(this).closest('.modal').find('input.kik_term_description').val();
		data.taxonomy	= $(this).attr('taxonomy');
		
		$.ajax({
			type: 'post',
			url: WP_PARAMS.URL_AJAX,
			data: data,
			dataType: 'json',
			success: function(response){
				if(response.success === true){
					$('#new-term-modal').modal('hide');
					$('#' + data.taxonomy).DataTable().ajax.reload();
					$('.kik_term_category, .kik_term_description').val('');
				} else {
					showMessage($('#new-term-modal .modal-body .form-group').first(), response.errMsg, 'alert-danger');
				}
			},
		});
	});
	
	//===========================================
	// EDIT CATEGORY TERM
	//===========================================
	$('#edit-categ-modal').on('show.bs.modal', function(event){
		var button  = $(event.relatedTarget);
		var row     = button.closest('tr');
		var categ   = row.find('td').eq(0).html();
		var descr   = row.find('td').eq(1).html();
		var editBtn = $(this).find('#btn-save-record');
		
		$('input[name="kik_term_categorie"]').val(categ);
		$('input[name="kik_term_descriere"]').val(descr);
		
		editBtn.attr('term-id', button.attr('term-id'));
		editBtn.attr('taxonomy', button.attr('taxonomy'));
	});
	
	$('#btn-save-record').on('click', function() {
		var data      = {};
		data.termId   = $(this).attr('term-id');
		data.taxonomy = $(this).attr('taxonomy');
		data.args	  = {
			"name": $(this).closest(".modal-dialog").find('input[name="kik_term_categorie"]').val(),
			"description": $(this).closest(".modal-dialog").find('input[name="kik_term_descriere"]').val()
		}
		data.action = 'KIK_ACTION_Update_Taxonomy_Terms';
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			data:data,
			dataType: 'json',
			success: function(response){
				if(response.success === true){
					$('#edit-categ-modal').modal('hide');
					$('#' + response.taxonomy).DataTable().ajax.reload();
				} else {
					showMessage($('#edit-categ-modal .modal-body .form-group').first(), response.errMsg, 'alert-danger');
				}
			}
		});
	});
});