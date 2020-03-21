<?php 

add_action('wp_ajax_KIK_ACTION_Save_New_Bill', 'KIK_ACTION_Save_New_Bill');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_New_Bill', 'KIK_ACTION_Save_New_Bill');
function KIK_ACTION_Save_New_Bill(){
	
	global $wpdb;

	$billingID =  wp_insert_post(
		array(
			'post_title'=>'Factura nr. '.$_POST['nrFactura'].'/'.$_POST['dataFacturii'],
			'post_type'=>'kik_billing',
			'post_parent'=>$_POST['postId'],
			'post_status'=>'publish',
		)
	); 
	
	$oDataFacturii = DateTime::createFromFormat('d/m/Y', $_POST['dataFacturii']);
	
	update_post_meta($billingID, 'nrFactura', $_POST['nrFactura']);
	update_post_meta($billingID, 'dataFacturii', $oDataFacturii->format('Y/m/d'));
	update_post_meta($billingID, 'sumaFactura', $_POST['sumaFactura']);
	update_post_meta($billingID, 'termenPlata', $_POST['termenPlata']);
	update_post_meta($billingID, 'incasat', 0);
	update_post_meta($billingID, 'depasit', 0);
	update_post_meta($billingID, 'platiPartiale', serialize(array()));
	
	
	echo json_encode($billingID);
	wp_die();
}

?>