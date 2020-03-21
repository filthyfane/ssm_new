<?php 

add_action('wp_ajax_KIK_ACTION_Manage_CSSM', 'KIK_ACTION_Manage_CSSM');
add_action('wp_ajax_nopriv_KIK_ACTION_Manage_CSSM', 'KIK_ACTION_Manage_CSSM');

function KIK_ACTION_Manage_CSSM(){
	
	global $wpdb;
	
	validateCssmData($_POST);
	
	switch($_POST['actionType']){
		case 'add-new':
			createCssm($_POST);
			break;
		case 'update':
			updateCssm($_POST);
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

function createCssm($post){
	$cssmMeetingID =  wp_insert_post([
		'post_title' => 'Ședința din data de '.$post['dataSedintei'],
		'post_type' => 'kik_cssm',
		'post_parent' => $post['postId'],
		'post_status' => 'publish',
	]); 
	
	$oDataSedintei = DateTime::createFromFormat('d/m/Y', $post['dataSedintei']);
	$oDataRealizarii = DateTime::createFromFormat('d/m/Y', $post['dataRealizarii']);
	
	$dataRealizarii = '';
	if($oDataRealizarii){
		$dataRealizarii = $oDataRealizarii->format('Y/m/d');
	}
	
	update_post_meta($cssmMeetingID, 'dataSedintei', $oDataSedintei->format('Y/m/d'));
	update_post_meta($cssmMeetingID, 'dataRealizarii', $dataRealizarii);
}

function updateCssm($post){
	
	global $wpdb;
	$oDataRealizarii = DateTime::createFromFormat('d/m/Y', $post['dataRealizarii']);
	
	$dataRealizarii = '';
	if($oDataRealizarii){
		$dataRealizarii = $oDataRealizarii->format('Y/m/d');
	}

	update_post_meta((int)$post['cssmID'], 'dataRealizarii', $dataRealizarii);
}

function validateCssmData($post){
	if(!check_ajax_referer('save-company-data', 'nonce', false)){
		returnError('Cererea nu a putut fi procesată! Vă rugăm reîncercați. În cazul în care problema persistă, contactați administratorul site-ului!');
	}
	
	validatePostId($post['postId'], 'kik_company');
	
	$oDataSedintei = DateTime::createFromFormat('d/m/Y', $_POST['dataSedintei']);
	if(!$oDataSedintei){
		returnError('Data ședinței nu este validă!');
	}

	if(!empty($post['dataRealizarii'])){
		$oDataRealizarii = DateTime::createFromFormat('d/m/Y', $post['dataRealizarii']);
		if($oDataRealizarii === false){
			returnError('Data realizării ședinței nu este validă!');
		}
	}
}

?>