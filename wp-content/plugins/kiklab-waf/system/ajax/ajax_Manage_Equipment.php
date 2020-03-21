<?php 

add_action('wp_ajax_KIK_ACTION_Manage_Equipment', 'KIK_ACTION_Manage_Equipment');
add_action('wp_ajax_nopriv_KIK_ACTION_Manage_Equipment', 'KIK_ACTION_Manage_Equipment');
function KIK_ACTION_Manage_Equipment(){

	global $wpdb;
	
	validateEquipmentPostData($_POST);
	
	$equipmentID = wp_insert_post([
		'post_title'=>'Echipament: '.$_POST['numeEchipament'].' - data expirare: '.$_POST['dataExpirare'],
		'post_type'=>'kik_equipment',
		'post_parent'=>$_POST['postId'],
		'post_status'=>'publish',
	]); 
	
	$oDataExpirare = DateTime::createFromFormat('d/m/Y', $_POST['dataExpirare']);
	
	update_post_meta($equipmentID, 'idEchipament', $_POST['idEchipament']);
	update_post_meta($equipmentID, 'nrBuc', $_POST['nrBuc']);
	update_post_meta($equipmentID, 'dataExpirare', $oDataExpirare->format('Y/m/d'));
	update_post_meta($equipmentID, 'iscir', $_POST['iscir']);
	
	if(isset($_POST['dataExpIscir'])){
		$oDataExpIscir = DateTime::createFromFormat('d/m/Y', $_POST['dataExpIscir']);
		update_post_meta($equipmentID, 'dataExpIscir', $oDataExpIscir->format('Y/m/d'));	
	}
	
	echo json_encode([
		'success' => true,
		'modalId' => 'new-echipament-modal'
	]);
	wp_die();
}

function validateEquipmentPostData($post){
	if(!check_ajax_referer('save-company-data', 'nonce', false)){
		returnError('Cererea nu a putut fi procesată! Vă rugăm reîncercați. În cazul în care problema persistă, contactați administratorul site-ului!');
	}
	
	validatePostId($post['postId'], 'kik_equipment');
	
	if(!isset($post['idEchipament']) || strlen(trim($post['idEchipament'])) == 0){
		returnError('Nu a fost selectat nici un echipament!');
	}
	
	$echipament = get_term_by('id', (int)$post['idEchipament'], 'kik_echipamente');
	if(!$echipament){
		returnError('Echipamentul selectat nu există!');
	}
	
	if(!isset($post['nrBuc']) || !is_numeric($post['nrBuc']) || (int)$post['nrBuc'] <= 0){
		returnError('Numărul de bucăți trebuie să fie un număr întreg mai mare ca 0!');
	}
	
	$oDataExpirare = DateTime::createFromFormat('d/m/Y', $post['dataExpirare']);
	if($oDataExpirare === false){
		returnError('Data expirării echipamentului nu este validă!');
	}
	
	if(isset($post['iscir']) && $post['iscir'] === 'true'){
		$oDataExpIscir = DateTime::createFromFormat('d/m/Y', $post['dataExpIscir']);
		if($oDataExpIscir === false){
			returnError('Data expirării ISCIR-ului nu este validă!');
		}
	}
}

?>