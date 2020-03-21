<?php 

add_action('wp_ajax_KIK_ACTION_Save_New_Equipment', 'KIK_ACTION_Save_New_Equipment');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_New_Equipment', 'KIK_ACTION_Save_New_Equipment');
function KIK_ACTION_Save_New_Equipment(){

	global $wpdb; exit;
	
	$equipmentID =  wp_insert_post(
		array(
			'post_title'=>'Echipament: '.$_POST['numeEchipament'].' - data expirare: '.$_POST['dataExpirare'],
			'post_type'=>'kik_equipment',
			'post_parent'=>$_POST['postId'],
			'post_status'=>'publish',
		)
	); 
	
	$oDataExpirare = DateTime::createFromFormat('d/m/Y', $_POST['dataExpirare']);
	
	update_post_meta($equipmentID, 'idEchipament', $_POST['idEchipament']);
	update_post_meta($equipmentID, 'nrBuc', $_POST['nrBuc']);
	update_post_meta($equipmentID, 'dataExpirare', $oDataExpirare->format('Y/m/d'));
	update_post_meta($equipmentID, 'iscir', $_POST['iscir']);
	if(isset($_POST['dataExpIscir'])){
		$oDataExpIscir = DateTime::createFromFormat('d/m/Y', $_POST['dataExpIscir']);
		update_post_meta($equipmentID, 'dataExpIscir', $oDataExpIscir->format('Y/m/d'));	
	}
	
	echo json_encode($equipmentID);
	wp_die();
}

?>