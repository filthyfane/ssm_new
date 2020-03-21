$.getScript();
$(document).ready(function(){
	
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
	
	//=====================================
	// SAVE COMPANY
	//=====================================
	$(document).on('click', '.kik-add-company', function(){
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
					window.location.replace(response.redirect);
				} else {
					showMessage($('.nav.nav-tabs'), 'error', 'alert-danger');
				}
			}
		});
	});
});