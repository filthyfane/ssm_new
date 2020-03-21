<?php 

add_action('wp_ajax_KIK_ACTION_Save_New_Employee', 'KIK_ACTION_Save_New_Employee');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_New_Employee', 'KIK_ACTION_Save_New_Employee');
function KIK_ACTION_Save_New_Employee(){

	global $wpdb;

	if(!check_ajax_referer('save-new-employee', 'nonce', false)){
		returnError('Cererea nu a putut fi procesată! Vă rugăm contactați administratorul site-ului!');
	}
	
	$errors = checkData($_POST);
	
	if(count($errors) > 0){
		$response = [
			'success' => false,
			'errors'  => $errors
		];
		
		echo json_encode($response);
		wp_die();
	}
	
	$employeeID =  wp_insert_post(
		array(
			'post_title'=>'Angajat: '.$_POST['numeAngajat'].' '.$_POST['prenumeAngajat'],
			'post_type'=>'kik_employee',
			'post_parent'=>$_POST['postId'],
			'post_status'=>'publish',
		)
	); 
	
	
	$oContractStart = DateTime::createFromFormat('d/m/Y', $_POST['contractAngajatStart']);
	$oContractSfarsit = DateTime::createFromFormat('d/m/Y', $_POST['contractAngajatSfarsit']);
	
	update_post_meta($employeeID, 'numeAngajat', $_POST['numeAngajat']);
	update_post_meta($employeeID, 'prenumeAngajat', $_POST['prenumeAngajat']);
	update_post_meta($employeeID, 'functieAngajat', $_POST['functieAngajat']);
	update_post_meta($employeeID, 'adresaAngajat', $_POST['adresaAngajat']);
	update_post_meta($employeeID, 'cnpAngajat', $_POST['cnpAngajat']);
	update_post_meta($employeeID, 'normaAngajat', $_POST['normaAngajat']);
	update_post_meta($employeeID, 'contractAngajatStart', $oContractStart->format('Y/m/d'));
	update_post_meta($employeeID, 'contractAngajatSfarsit', $oContractSfarsit->format('Y/m/d'));
	update_post_meta($employeeID, 'conducator', $_POST['conducator']);
	update_post_meta($employeeID, 'autorizatieSpeciala', $_POST['autorizatieSpeciala']);
	
	
	if(isset($_POST['telefonAngajat'])){
		update_post_meta($employeeID, 'telefonAngajat', $_POST['telefonAngajat']);	
	}
	
	if(isset($_POST['emailAngajat'])){
		update_post_meta($employeeID, 'emailAngajat', $_POST['emailAngajat']);	
	}
	
	if(isset($_POST['tipAutorizatie'])){
		update_post_meta($employeeID, 'tipAutorizatie', $_POST['tipAutorizatie']);	
	}
	
	if(isset($_POST['expirareAutorizatie'])){
		update_post_meta($employeeID, 'expirareAutorizatie', $_POST['expirareAutorizatie']);	
	}
	
	echo json_encode($employeeID);
	wp_die();
}

function checkData($post){
	$errors = [];
	
	if(
		(!$post['numeAngajat'] || empty($post['numeAngajat']))
		|| (!$post['prenumeAngajat'] || empty($post['prenumeAngajat']))
	){
		$errors[] = 'Numele și prenumele angajatului sunt obligatorii!';
	}
	
	if(!$post['contractAngajatStart']){
		$errors[] = 'Vă rugăm să setați data de început a contractului!';
	} elseif (!DateTime::createFromFormat('d/m/Y', $_POST['contractAngajatSfarsit'])) {
		$errors[] = 'Data de început a contractului nu este validă! (format corect: DD/MM/YYYY)';
	}
	
	if(!$post['contractAngajatSfarsit']){
		$errors[] = 'Vă rugăm să setați data de sfârșit a contractului!';
	} elseif(!DateTime::createFromFormat('d/m/Y', $_POST['contractAngajatSfarsit'])){
		$errors[] = 'Data de sfârșit a contractului nu este validă! (format corect: DD/MM/YYYY)';
	}
	
	if(!isset($post['normaAngajat']) || empty($post['normaAngajat'])){
		$errors[] = 'Vă rugăm selectați o opțiune pentru norma de lucru!';
	}
	
	return $errors;
}

?>