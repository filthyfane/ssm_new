<?php 

add_action('wp_ajax_KIK_ACTION_Manage_Instructaj', 'KIK_ACTION_Manage_Instructaj');
add_action('wp_ajax_nopriv_KIK_ACTION_Manage_Instructaj', 'KIK_ACTION_Manage_Instructaj');
function KIK_ACTION_Manage_Instructaj(){
	
	global $wpdb;

	$instructajID = wp_insert_post(
		array(
			'post_title'=>'Instructajul din data de '.$_POST['dataInstructajului'],
			'post_type'=>'kik_instructaj',
			'post_parent'=>$_POST['postId'],
			'post_status'=>'publish',
		)
	); 
	
	$oDataSedintei = DateTime::createFromFormat('d/m/Y', $_POST['dataInstructajului']);
	$oDataRealizarii = DateTime::createFromFormat('d/m/Y', $_POST['dataRealizarii']);
	
	$dataRealizarii = '';
	if($oDataRealizarii){
		$dataRealizarii = $oDataRealizarii->format('Y/m/d');
	}
	
	update_post_meta($instructajID, 'dataInstructajului', $oDataSedintei->format('Y/m/d'));
	update_post_meta($instructajID, 'dataRealizarii', $dataRealizarii);
	update_post_meta($instructajID, 'tipInstructaj', $_POST['tipInstructaj']);
	
	
	echo json_encode($instructajID);
	wp_die();
}

?>