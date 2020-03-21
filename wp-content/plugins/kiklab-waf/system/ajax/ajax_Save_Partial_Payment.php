<?php 

add_action('wp_ajax_KIK_ACTION_Save_Partial_Payment', 'KIK_ACTION_Save_Partial_Payment');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_Partial_Payment', 'KIK_ACTION_Save_Partial_Payment');
function KIK_ACTION_Save_Partial_Payment(){
	
	global $wpdb;
	
	validatePartialPaymentData($_POST);

	$postId 	   = $_POST['postId'];
	$facturaId 	   = $_POST['facturaId'];
	$platiPartiale = unserialize(get_post_meta($facturaId, 'platiPartiale', true));
	
	if(!is_array($platiPartiale)) {
		$platiPartiale = array();
	}
	
	$platiPartiale[] = array(
		'data' => $_POST['dataPlatiiPartiale'],
		'suma' => $_POST['sumaPlatita']
	);
	
	update_post_meta($facturaId, 'platiPartiale', serialize($platiPartiale));
	
	echo json_encode([
		'success' => true,
		'modalId' => 'new-partial-payment'
	]);
	
	wp_die();
}

function validatePartialPaymentData($post){
	if(!check_ajax_referer('save-company-data', 'nonce', false)){
		returnError('Cererea nu a putut fi procesată! Vă rugăm reîncercați. În cazul în care problema persistă, contactați administratorul site-ului!');
	}
	
	validatePostId($post['postId'], 'kik_company');
	validatePostId($post['facturaId'], 'kik_billing');
	
	if(!isset($post['dataPlatiiPartiale'])){
		returnError('Data plății parțiale nu a fost completată');
	}
	
	$oSumaPlatita = DateTime::createFromFormat('d/m/Y', $post['dataPlatiiPartiale']);
	if($oSumaPlatita === false){
		returnError('Data plății nu are formatul valid: "zz/ll/aaaa"!');
	}
	
	if($oSumaPlatita > new DateTime()){
		returnError('Data plății nu poate fi mai mare de data curentă!');
	}
	
	if(!isset($post['sumaPlatita']) || !is_numeric($post['sumaPlatita']) || (float)$post['sumaPlatita'] <= 0){
		returnError('Suma platită nu este un număr zecimal mai mare ca 0!');
	}
}

?>