<?php


#####------------------------------------
##### POST GET DATA
#####------------------------------------


	# Date societate
	$kik_company_cif = get_post_meta($kik_ID, 'kik_company_cif', true);
	$kik_company_reg = get_post_meta($kik_ID, 'kik_company_reg', true);
	$kik_company_address = get_post_meta($kik_ID, 'kik_company_address', true);
	
	$kik_company_workpoints = get_post_meta($kik_ID, 'kik_company_workpoints', true);
	$kik_company_bank_account = get_post_meta($kik_ID, 'kik_company_bank_account', true);
	$kik_company_bank_name = get_post_meta($kik_ID, 'kik_company_bank_name', true);
	$kik_company_legal_rep = get_post_meta($kik_ID, 'kik_company_legal_rep', true);
	$kik_company_contact_person_name = get_post_meta($kik_ID, 'kik_company_contact_person_name', true);
	$kik_company_contact_person_phone = get_post_meta($kik_ID, 'kik_company_contact_person_phone', true);
	$kik_company_contact_person_email = get_post_meta($kik_ID, 'kik_company_contact_person_email', true);
	
	$caenCode = wp_get_object_terms($kik_ID, 'kik_cod_caen');
	if(empty($caenCode)){
		$kik_company_caen = -1;
	} else {
		$kik_company_caen = $caenCode[0];
	}
	
	$kik_company_contract_number = get_post_meta($kik_ID, 'kik_company_contract_number', true);
	$kik_company_contract_date = get_post_meta($kik_ID, 'kik_company_contract_date', true);
	
	$kik_company_contract_date = '';
	$contractDate = get_post_meta($kik_ID, 'kik_company_contract_date', true);
	if($contractDate){
		$oContractDate = DateTime::createFromFormat('Y/m/d', $contractDate);
		$kik_company_contract_date = $oContractDate->format('d/m/Y');
	} 

	$contract_type = wp_get_object_terms($kik_ID, 'kik_tip_contract');	
	$kik_company_contract_type = empty($contract_type) ? '' : $contract_type[0];
	
	$kik_company_contract_validity = get_post_meta($kik_ID, 'kik_company_contract_validity', true);
	$kik_company_contract_validity_type = get_post_meta($kik_ID, 'kik_company_contract_validity_type', true);
	//$kik_company_service_frequency = wp_get_object_terms($kik_ID, 'kik_periodicitate_instructaj')[0];
	$kik_company_employees = get_post_meta($kik_ID, 'kik_company_employees', true);
	
	$billing_freq = wp_get_object_terms($kik_ID, 'kik_perioada_de_facturare'); 
	$kik_company_billing_frequency = empty($billing_freq) ? '' : $billing_freq[0];
	
	$kik_company_billing_deadline = get_post_meta($kik_ID, 'kik_company_billing_deadline', true);
	$kik_company_billing_deadline_type = get_post_meta($kik_ID, 'kik_company_billing_deadline_type', true);
	$kik_company_inspector = get_post_meta($kik_ID, 'kik_company_inspector', true);
	$kik_company_sales_agent = get_post_meta($kik_ID, 'kik_company_sales_agent', true);
	
	$co_status = wp_get_object_terms($kik_ID, 'kik_status');
	$kik_company_status = empty($co_status) ? '' : $co_status[0];
	
	# Facturare
	$kik_company_billing_history = get_post_meta($kik_ID, 'kik_company_billing_history', false);
	
	# Periodicitate instructaj
	$kik_company_service_frequency_history = get_post_meta($kik_ID, 'kik_company_service_frequency_history', false);
	
	# CSSM
	$kik_company_cssm = get_post_meta($kik_ID, 'kik_company_cssm', false);
	
	# Echipamente
	$kik_company_echipamente = get_post_meta($kik_ID, 'kik_company_echipamente', false);
	
	# Angajati
	$kik_company_angajati = get_post_meta($kik_ID, 'kik_company_angajati', false);
	
	# Dosar cercetare accidente
	$kik_company_accidente = get_post_meta($kik_ID, 'kik_company_accidente', false);
	
	# Facturi
	$kik_bills = getBills($kik_ID);
	
	# CSSM
	$args = array(
		'post_parent' => $kik_ID,
		'post_type'   => 'kik_cssm'
	);
	$kik_cssm = get_children($args);
	$kik_cssm_size = sizeof($kik_cssm);
	
	# Echipamente
	$kik_equipments = getEquipments($kik_ID);
	
	# Angajati
	$args = array(
		'post_parent' => $kik_ID,
		'post_type' => 'kik_employee',
		'order' => 'ASC',
		'orderby' => 'title'
	);
	$kik_employees = get_children($args);
	
	# Dosare cercetare
	$args = array(
		'post_parent' => $kik_ID,
		'post_type' => 'kik_accident',
		'order' => 'DESC',
		'orderby' => 'title'
	);
	$kik_files = get_children($args);
	
	# Rapoarte
	$kik_reports = get_post_meta($kik_ID, 'rapoarte', false);
	
	# Instructaje
	$args = array(
		'post_parent' => $kik_ID,
		'post_type'   => 'kik_instructaj'
	);
	$kik_instructaje = get_children($args);
	$kik_instructaje_size = sizeof($kik_instructaje);
	
	#Tip Instructaj
	$kik_instructaj = get_post_meta($kik_ID, 'kik_instructaj', true);
?>