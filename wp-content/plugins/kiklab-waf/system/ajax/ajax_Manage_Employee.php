<?php 

add_action('wp_ajax_KIK_ACTION_Manage_Employee', 'KIK_ACTION_Manage_Employee');
add_action('wp_ajax_nopriv_KIK_ACTION_Manage_Employee', 'KIK_ACTION_Manage_Employee');
function KIK_ACTION_Manage_Employee(){

	global $wpdb;

	validateEmployeeData($_POST);
	
	switch($_POST['actionType']){
		case 'add-new':
			$employeeID = wp_insert_post(
				array(
					'post_title'=>'Angajat: '.$_POST['numeAngajat'].' '.$_POST['prenumeAngajat'],
					'post_type'=>'kik_employee',
					'post_parent'=>$_POST['postId'],
					'post_status'=>'publish',
				)
			); 
			break;
		case 'update':
			$oEmployee = get_post($_POST['recordId']);
			$employeeID = $oEmployee->ID;
			break;
		default:
			returnError('Actiunea nu este valida!');
	}
	
	$oContractStart = DateTime::createFromFormat('d/m/Y', $_POST['contractAngajatStart']);
	$oContractSfarsit = DateTime::createFromFormat('d/m/Y', $_POST['contractAngajatSfarsit']);
	
	update_post_meta($employeeID, 'numeAngajat', $_POST['numeAngajat']);
	update_post_meta($employeeID, 'prenumeAngajat', $_POST['prenumeAngajat']);
	update_post_meta($employeeID, 'functieAngajat', $_POST['functieAngajat']);
	update_post_meta($employeeID, 'adresaAngajat', $_POST['adresaAngajat']);
	update_post_meta($employeeID, 'cnpAngajat', $_POST['cnpAngajat']);
	update_post_meta($employeeID, 'normaAngajat', $_POST['normaAngajat']);
	update_post_meta($employeeID, 'contractAngajatStart', $oContractStart->format('Y/m/d'));
	update_post_meta($employeeID, 'contractAngajatSfarsit', $oContractSfarsit !== false ? $oContractSfarsit->format('Y/m/d') : '');
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
	
	echo json_encode([
		'success' => true,
		'modalId' => 'edit-employee-modal'
	]);
	
	wp_die();
}

function validateEmployeeData($post){
	if(!check_ajax_referer('save-company-data', 'nonce', false)){
		returnError('Cererea nu a putut fi procesată! Vă rugăm reîncercați. În cazul în care problema persistă, contactați administratorul site-ului!');
	}
	
	if(
		(!$post['numeAngajat'] || empty($post['numeAngajat']))
		|| (!$post['prenumeAngajat'] || empty($post['prenumeAngajat']))
	){
		returnError('Numele și prenumele angajatului sunt obligatorii!');
	}
	
	if(!isset($post['contractAngajatStart'])){
		returnError('Vă rugăm să setați data de început a contractului!');
	} elseif (DateTime::createFromFormat('d/m/Y', $_POST['contractAngajatStart']) === false) {
		returnError('Data de început a contractului nu este validă! (format corect: DD/MM/YYYY)');
	}
	
	// data de sfarsit a contractului nu este obligatorie
	// daca totusi este completata, trebuie validata
	if(isset($post['contractAngajatSfarsit']) 
		&& strlen(trim($post['contractAngajatSfarsit'])) > 0
		&& DateTime::createFromFormat('d/m/Y', $_POST['contractAngajatSfarsit']) === false
	){
		returnError('Data de sfârșit a contractului nu este validă! (format corect: zz/ll/aaaa)');
	}
	
	if(!isset($post['normaAngajat']) || empty($post['normaAngajat'])){
		$errors[] = 'Vă rugăm selectați o opțiune pentru norma de lucru!';
	}
	
	$normaTerm = get_term_by('id', $post['normaAngajat'], 'kik_norme_lucru');
	if($normaTerm === false){
		returnError('Norma de lucru selectată nu există!');		
	}	
}

/* CODURI JUDEŢE
01 - ALBA	
11- CARAŞ-SEVERIN

21 - IALOMIŢA	31 - SĂLAJ	 
02 - ARAD	12 - CLUJ	22 - IAŞI	32 - SIBIU	41 - BUCUREŞTI S1
03 - ARGEŞ	13 - CONSTANŢA	23 - ILFOV	33 - SUCEAVA	42 - BUCUREŞTI S2
04 - BACĂU	14 - COVASNA	24 - MARAMUREŞ	34 - TELEORMAN	43 - BUCUREŞTI S3
05 - BIHOR	15 - DÂMBOVIŢA	25 - MEHEDINŢI	35 - TIMIŞ	44 - BUCUREŞTI S4
06 - 
BISTRIŢA-NĂSĂUD	16 - DOLJ	26 - MUREŞ	36 - TULCEA	45 - BUCUREŞTI S5
07 - BOTOŞANI	17 - GALAŢI	
27 - NEAMŢ

37 - VASLUI	46 - BUCUREŞTI S6
08 - BRAŞOV	18 - GORJ	28 - OLT	38 - VÂLCEA	51 - CĂLĂRAŞI
09 - BRĂILA	19 - HARGHITA	29 - PRAHOVA	39 - VRANCEA	52 - GIURGIU
10 - BUZĂU	20 - HUNEDOARA	30 - SATU MARE	40 - BUCUREŞTI	  */
// numar de verificare: 279146358279
?>