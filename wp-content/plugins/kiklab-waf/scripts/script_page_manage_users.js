var $ = jQuery;

$.getScript()
$(document).ready(function(){
	var usersOptions = {
		"order": [[ 0, "asc" ]],
		"language": translationRO,
		"dom": getDomDataTable('B'),
		"ajax": {
			"url": WP_PARAMS.URL_AJAX,
			"type": "POST",
			"data": {
				"action": "ajax_datatables_users"  
			}
		},
		"buttons": {
			dom: {
				container: {className: 'pull-right dt-new-btn btn-new-user'},
				button: {tag: 'a', className: 'btn btn-primary'},
				buttonLiner: {tag: ''}
			},
			buttons: [{
				text: 'Adaugă utilizator',
				action: function (e, dt, node, config){
					$('#edit-user-modal .modal-body h3').html('Adaugă utilizator:</br></br>');
					$('#edit-user-modal').modal('show');
				}
			}]
		}
	}
	
	var usersDataTable = $('#kik_users').DataTable(usersOptions);

	//=======================================
	// EDIT/ADD USER
	//=======================================
	$('#edit-user-modal').on('show.bs.modal', function(event){
		var modal = $('#edit-user-modal');
		var button = $(event.relatedTarget);
		var userId = button.attr('user-id');
		
		modal.find('input[type="text"]').val('');
		modal.find('input[type="checkbox"]').prop('checked', false);
		
		if(typeof userId !== typeof undefined && userId !== false){
			$('#btn-save-record').attr('user-id', userId);
			$('#edit-user-modal .modal-body h3').html('Editează utilizator:</br></br>');
			
			$.ajax({
				type: 'POST',
				url: WP_PARAMS.URL_AJAX,
				data: {
					userId: userId,
					action: 'ajax_get_user_data_modal'
				},
				dataType: 'json',
				success: function(response){
					if(response.success === true){
						modal.find('.user-details').remove();
						modal.find('.form-horizontal>div').after(response.html);
					} else {
						showMessage($('#edit-user-modal .modal-body .form-group').first(), response.errMsg, 'alert-danger');
					}
				}
			});
		} else {
			$('#btn-save-record').attr('user-id', 0);
			modal.find('input[name="kik_user_password"]').closest('.user-details').remove();
			modal.find('input[name="kik_user_confirm_password"]').closest('.user-details').remove();
		}
	});
	
	//========================================
	// ADD/UPDATE USER AJAX REQUEST
	//========================================
	$('#btn-save-record').on('click', function(){
		var userId = $(this).attr('user-id');
		var modal  = $('#edit-user-modal');
		var roles = [];
		$(modal.find('input[type="checkbox"]:checked')).each(function(){
			roles.push($(this).val());	
		});
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			dataType: 'json',
			data: {
				userId: userId,
				userLastName: modal.find('input[name="kik_user_first_name"]').val(),
				userFirstName: modal.find('input[name="kik_user_last_name"]').val(),
				userLogin: modal.find('input[name="kik_user_login"]').val(),
				userMail: modal.find('input[name="kik_user_mail"]').val(),
				password: modal.find('input[name="kik_user_password"]').val(),
				confirmPassword: modal.find('input[name="kik_user_confirm_password"]').val(),
				roles: roles,
				action: 'KIK_ACTION_Manage_Users'
			},
			
			success: function(response){
				if(response.success === true){
					$('#edit-user-modal').modal('hide');
					showMessage($('#kik_users_wrapper'), 'Utilizatorul a fost salvat cu succes!');
					usersDataTable.ajax.reload();
				} else {
					showMessage($('#edit-user-modal .modal-body .form-horizontal'), response.errMsg, 'alert-danger');
				}
			}
		});
		
	});
	
	//========================================
	// DELETE USER CONFIRM MODAL
	//========================================
	$('#confirm-delete-user-modal').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var modal  = $('#confirm-delete-user-modal');
		modal.find('#btn-delete-user').attr('user-id', button.attr('user-id'));
	});
	
	//========================================
	// DELETE USER AJAX REQUEST
	//========================================
	$('#btn-delete-user').on('click', function(){
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			dataType: 'json',
			data: {
				userId: $(this).attr('user-id'),
				action: 'KIK_ACTION_Delete_User'
			},
			success: function(response){
				if(response.success === true){
					$('#confirm-delete-user-modal').modal('hide');
					showMessage($('#kik_users_wrapper'), 'Utilizatorul a fost șters cu succes!');
					usersDataTable.ajax.reload();
				} else {
					$('#confirm-delete-user-modal').modal('hide');
					showMessage($('#kik_users_wrapper'), response.errMsg, 'alert-danger');
				}
				console.log(response);
			}
		});
	})
	
	//========================================
	// MODAL GET ASSOCIATE COMPANIES AJAX REQUEST
	//========================================
	$('#add-company-user-modal').on('show.bs.modal', function(event){
		var modal  = $('#add-company-user-modal');
		var userId = $(event.relatedTarget).attr('user-id');
		modal.find('#btn-company-user').attr('user-id', userId);
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			dataType: 'json',
			data: {
				userId: userId,
				action: 'KIK_ACTION_Get_User_Company_Relations'
			},
			success: function(response){
				if(response.success === true){
					$('.multiselect-companies').html(response.html);
					if(response.multiselect.length > 0){
						for(var i=0; i<response.multiselect.length; i++){
							$('#' + response.multiselect[i]).multiSelect();
						}
					}	
				}
			}
		});
	});

	//========================================
	// SAVE ASSOCIATE COMPANIES AJAX REQUEST
	//========================================
	$('#btn-company-user').on('click', function(){
		var selectElems = $('#add-company-user-modal .modal-body select');
		var selectObj   = {};
		
		$.each(selectElems, function(i, selectElem){
			selectObj[$(selectElem).attr('id')] = $(selectElem).val();
		});
		
		$.ajax({
			type: 'POST',
			url: WP_PARAMS.URL_AJAX,
			dataType: 'json',
			data: {
				userId: $(this).attr('user-id'),
				companies: selectObj,
				action: 'KIK_ACTION_Save_Relation_User_Companies'
			},
			success: function(response){
				if(response.success === true){
					$('#add-company-user-modal').modal('hide');
					showMessage($('#kik_users_wrapper'), 'Relațiile au fost salvate cu succes!');
				} else {
					$('#add-company-user-modal').animate({ scrollTop: 0 }, 'slow');
					showMessage($('#add-company-user-modal .modal-body h3').closest('div'), response.errMsg, 'alert-danger');
				}
			}
		});
	});
});