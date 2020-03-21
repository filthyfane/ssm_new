<?php 

add_action('wp_ajax_KIK_ACTION_Manage_Bill', 'KIK_ACTION_Manage_Bill');
add_action('wp_ajax_nopriv_KIK_ACTION_Manage_Bill', 'KIK_ACTION_Manage_Bill');
function KIK_ACTION_Manage_Bill(){
	
	global $wpdb;
	
	validateBillPostData($_POST);

	$oDataFacturii = DateTime::createFromFormat('d/m/Y', $_POST['dataFacturii']);
	$billingID 	   = wp_insert_post(
		[
			'post_title'=>'Factura nr. '.$_POST['nrFactura'].'/'.$oDataFacturii->format('d.m.Y'),
			'post_type'=>'kik_billing',
			'post_parent'=>$_POST['postId'],
			'post_status'=>'publish',
		],
		true
	);
	
	if(is_wp_error($billingID)){
		returnError($billingID->get_error_message());
	}
	
	update_post_meta($billingID, 'nrFactura', $_POST['nrFactura']);
	update_post_meta($billingID, 'dataFacturii', $oDataFacturii->format('Y/m/d'));
	update_post_meta($billingID, 'sumaFactura', $_POST['sumaFactura']);
	update_post_meta($billingID, 'termenPlata', $_POST['termenPlata']);
	update_post_meta($billingID, 'incasat', 0);
	update_post_meta($billingID, 'depasit', 0);
	update_post_meta($billingID, 'platiPartiale', serialize(array()));
	
	echo json_encode([
		'success' => true,
		'modalId' => 'new-bill-modal'
	]);
	wp_die();
}

function validateBillPostData($post){
	if(!check_ajax_referer('save-company-data', 'nonce', false)){
		returnError('Cererea nu a putut fi procesată! Vă rugăm reîncercați. În cazul în care problema persistă, contactați administratorul site-ului!');
	}
	
	validatePostId($post['postId'], 'kik_company');
	
	if(!isset($post['nrFactura']) || strlen(trim($post['nrFactura'])) == 0){
		returnError('Numărul facturii nu poate fi gol!');
	}
	
	if(!isset($post['dataFacturii'])){
		returnError('Data facturii nu a fost completată!');
	}
	
	$oDataFacturii = DateTime::createFromFormat('d/m/Y', $post['dataFacturii']);
	if($oDataFacturii === false){
		returnError('Data facturii nu are formatul valid: "zz/ll/aaaa"!');
	}

	if(!isset($post['sumaFactura']) || !is_numeric($post['sumaFactura']) || (float)$post['sumaFactura'] <= 0){
		returnError('Suma facturii nu este un numar zecimal mai mare ca 0!');
	}
	
	if(!isset($post['termenPlata']) || !is_numeric($post['termenPlata']) || (int)$post['termenPlata'] <= 0){
		returnError('Termenul de plată nu este un număr întreg mai mare ca zero!');
	}
}	

?>