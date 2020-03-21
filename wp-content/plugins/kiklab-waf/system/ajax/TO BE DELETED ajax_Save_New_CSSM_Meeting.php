<?php 

add_action('wp_ajax_KIK_ACTION_Save_New_CSSM_Meeting', 'KIK_ACTION_Save_New_CSSM_Meeting');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_New_CSSM_Meeting', 'KIK_ACTION_Save_New_CSSM_Meeting');
function KIK_ACTION_Save_New_CSSM_Meeting(){
	
	global $wpdb;
	$cssmMeetingID =  wp_insert_post(
		array(
			'post_title'=>'Ședința din data de '.$_POST['dataSedintei'],
			'post_type'=>'kik_cssm',
			'post_parent'=>$_POST['postId'],
			'post_status'=>'publish',
		)
	); 
	
	$realizat = 0;
	if($_POST['realizat'] === 'true'){
		$realizat = 1;
	}
	
	$oDataSedintei = DateTime::createFromFormat('d/m/Y', $_POST['dataSedintei']);
	
	update_post_meta($cssmMeetingID, 'dataSedintei', $oDataSedintei->format('Y/m/d'));
	update_post_meta($cssmMeetingID, 'realizat', $realizat);
	
	echo json_encode($cssmMeetingID);
	wp_die();
}

?>