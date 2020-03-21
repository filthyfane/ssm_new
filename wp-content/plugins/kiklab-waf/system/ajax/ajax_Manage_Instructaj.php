<?php 

add_action('wp_ajax_KIK_ACTION_Manage_Instructaj', 'KIK_ACTION_Manage_Instructaj');
add_action('wp_ajax_nopriv_KIK_ACTION_Manage_Instructaj', 'KIK_ACTION_Manage_Instructaj');
function KIK_ACTION_Manage_Instructaj(){
	
	global $wpdb;

	validateInstructajPostData($_POST);
	
	switch($_POST['actionType']){
		case 'add-new':
			createInstructaj($_POST);
			break;
		case 'update':
			updateInstructaj($_POST);
			break;
		default:
			returnError('Acțiunea nu a putut fi procesată!');
	}
	
	echo json_encode([
		'success' => true,
		'modalId' => $post['modalId']
	]);
	wp_die();
}

function createInstructaj($post){
	
	$instructajID = wp_insert_post(
		array(
			'post_title'  => 'Instructajul din data de '.$post['dataInstructajului'],
			'post_type'   => 'kik_instructaj',
			'post_parent' => $post['postId'],
			'post_status' => 'publish',
		)
	); 
	
	$oDataInstructajului = DateTime::createFromFormat('d/m/Y', $post['dataInstructajului']);
	$oDataRealizarii 	 = DateTime::createFromFormat('d/m/Y', $post['dataRealizarii']);
	
	$dataRealizarii = '';
	if($oDataRealizarii){
		$dataRealizarii = $oDataRealizarii->format('Y/m/d');
	}
	
	update_post_meta($instructajID, 'dataInstructajului', $oDataSedintei->format('Y/m/d'));
	update_post_meta($instructajID, 'dataRealizarii', $dataRealizarii);
	update_post_meta($instructajID, 'tipInstructaj', $post['tipInstructaj']);
}

function updateInstructaj($post){
	
	global $wpdb;
	$oDataRealizarii = DateTime::createFromFormat('d/m/Y', $post['dataRealizarii']);
	
	$dataRealizarii = '';
	if($oDataRealizarii){
		$dataRealizarii = $oDataRealizarii->format('Y/m/d');
	}

	update_post_meta((int)$post['instructajId'], 'dataRealizarii', $dataRealizarii);
}

function validateInstructajPostData($post){
	if(!check_ajax_referer('save-company-data', 'nonce', false)){
		returnError('Cererea nu a putut fi procesată! Vă rugăm reîncercați. În cazul în care problema persistă, contactați administratorul site-ului!');
	}
	
	validatePostId($post['postId'], 'kik_company');
	
	$tipInstructaj = get_term_by('id', (int)$post['tipInstructaj'], 'kik_tipuri_instructaj');
	if(!$tipInstructaj){
		returnError('Tipul instructajului nu este valid!');
	} 
	
	$oDataInstructajului = DateTime::createFromFormat('d/m/Y', $post['dataInstructajului']);
	if($oDataInstructajului === false){
		returnError('Data instructajului nu este validă!');
	}
	
	if(!empty($post['dataRealizarii'])) {		
		$oDataRealizarii = DateTime::createFromFormat('d/m/Y', $post['dataRealizarii']);
		if($oDataRealizarii === false){
			returnError('Data realizării instructajului nu este validă!');
		}
	}
}
?>