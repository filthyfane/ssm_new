<?php


#####------------------------------------
##### FRONT END: SAVE POST
#####------------------------------------


##### Save custom post
add_action('wp_ajax_KIK_ACTION_Save_Post', 'KIK_ACTION_Save_Post_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_Post', 'KIK_ACTION_Save_Post_FUNC');
function KIK_ACTION_Save_Post_FUNC() {
	global $wpdb;
	$response = [];
	
	if (isset($_POST['kik_action']) && $_POST['kik_action'] == 'edit') {
		$kik_ID = $_POST['ID'];
		$response['action'] = 'update';
	} else {
		$post = [
			'post_status'    => 'publish',
			'post_type'      => 'kik_company',
		];
		
		$response['action'] = 'new';
		$response['redirect'] = get_home_url();
		
		$kik_ID = wp_insert_post($post);
		
		if(is_wp_error($kik_ID)){
			returnError($kik_ID->get_error_message());
		}
		$response['postId'] = $kik_ID;
	}
	
	#-----------------------------	
	### Date societate
	#-----------------------------	
	if(isset($_POST['kik_company_title'])){
		$result = wp_update_post(['ID' => $kik_ID, 'post_title' => $_POST['kik_company_title']], true);
		if(is_wp_error($result)){
			returnError($result->get_error_message());
		}
	} 
	if(isset($_POST['kik_company_cif'])){
		update_post_meta($kik_ID, 'kik_company_cif', $_POST['kik_company_cif']);
	}
	if(isset($_POST['kik_company_reg'])){		
		update_post_meta($kik_ID, 'kik_company_reg', $_POST['kik_company_reg']);
	}
	if (isset($_POST['kik_company_caen'])) {
		if($_POST['kik_company_caen'] == -1){
			wp_set_object_terms($kik_ID, NULL, 'kik_cod_caen', false);
		} else {
			wp_set_object_terms($kik_ID, (int)$_POST['kik_company_caen'], 'kik_cod_caen', false);
		}
	}
	if(isset($_POST['kik_company_address'])){
		update_post_meta($kik_ID, 'kik_company_address', $_POST['kik_company_address']);
	} 
	if(isset($_POST['kik_workpoints'])){
		foreach($_POST['kik_workpoints'] as $k => $workpoint){
			if(trim($workpoint) == false){
				unset($_POST['kik_workpoints'][$k]);
			}
		}
		update_post_meta($kik_ID, 'kik_company_workpoints', $_POST['kik_workpoints']);
	} else {
		delete_post_meta($kik_ID, 'kik_company_workpoints');
	}

	#-----------------------------
	### Date bancare
	#-----------------------------
	if(isset($_POST['kik_company_bank_account'])){
		update_post_meta($kik_ID, 'kik_company_bank_account', $_POST['kik_company_bank_account']);
	}
	if(isset($_POST['kik_company_bank_name'])){
		update_post_meta($kik_ID, 'kik_company_bank_name', $_POST['kik_company_bank_name']);
	}
	if(isset($_POST['kik_company_legal_rep'])){
		update_post_meta($kik_ID, 'kik_company_legal_rep', $_POST['kik_company_legal_rep']);
	}

	#-----------------------------
	### Date contact
	#-----------------------------
	if(isset($_POST['kik_company_contact_person_name'])){
		update_post_meta($kik_ID, 'kik_company_contact_person_name', $_POST['kik_company_contact_person_name']);
	}
	if(isset($_POST['kik_company_contact_person_phone'])){
		update_post_meta($kik_ID, 'kik_company_contact_person_phone', $_POST['kik_company_contact_person_phone']);
	}
	if(isset($_POST['kik_company_contact_person_email'])){
		update_post_meta($kik_ID, 'kik_company_contact_person_email', $_POST['kik_company_contact_person_email']);
	}
	
	#-----------------------------
	### Date contractuale
	#-----------------------------
	if(isset($_POST['kik_company_contract_number'])){
		update_post_meta($kik_ID, 'kik_company_contract_number', $_POST['kik_company_contract_number']);
	}
	
	if(isset($_POST['kik_company_contract_date'])) {
		$oContractDate = DateTime::createFromFormat('d/m/Y', $_POST['kik_company_contract_date']);
		if($oContractDate){
			update_post_meta($kik_ID, 'kik_company_contract_date', $oContractDate->format('Y/m/d'));
		}
	}
	if(isset($_POST['kik_company_contract_type'])){
		wp_set_object_terms($kik_ID, $_POST['kik_company_contract_type'], 'kik_tip_contract', false);
	}
	if(isset($_POST['kik_company_contract_validity'])){
		update_post_meta($kik_ID, 'kik_company_contract_validity', $_POST['kik_company_contract_validity']);	
	} 
	if(isset($_POST['kik_company_contract_validity_type'])){
		update_post_meta($kik_ID, 'kik_company_contract_validity_type', $_POST['kik_company_contract_validity_type']);
	}
	if(isset($_POST['kik_company_training_type']) && isset($_POST['kik_company_service_frequency'])){
		$kik_instructaj = array_combine($_POST['kik_company_training_type'], $_POST['kik_company_service_frequency']);
		update_post_meta($kik_ID, 'kik_instructaj', $kik_instructaj);
	}	
	if(isset($_POST['kik_company_employees'])){
		update_post_meta($kik_ID, 'kik_company_employees', $_POST['kik_company_employees']);
	}
	if(isset($_POST['kik_company_billing_frequency'])){
		wp_set_object_terms($kik_ID, $_POST['kik_company_billing_frequency'], 'kik_perioada_de_facturare', false);
	}
	if(isset($_POST['kik_company_billing_deadline'])){
		update_post_meta($kik_ID, 'kik_company_billing_deadline', $_POST['kik_company_billing_deadline']);
	}
	if(isset($_POST['kik_company_status'])){
		wp_set_object_terms($kik_ID, $_POST['kik_company_status'], 'kik_status', false);
	}
	
	$response['success'] = true;
	
	echo json_encode($response);
	# Generate fields that aren't editable
	/* wp_update_post(array(
		'ID' => $kik_ID,
		'post_name' => $kik_ID,
	)); */

	# Recalculate alerts?? why?!?!
	//KIK_ACTION_Cron();	
	wp_die();
}
?>