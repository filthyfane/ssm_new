<?php 

add_action('wp_ajax_KIK_ACTION_Save_New_File', 'KIK_ACTION_Save_New_File');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_New_File', 'KIK_ACTION_Save_New_File');
function KIK_ACTION_Save_New_File(){

	global $wpdb;
	
	//var_dump($_POST); wp_die();
	
	$fileID =  wp_insert_post(
		array(
			'post_title'=>'Dosar cercetare accident din data de: '.$_POST['dataAccidentului'],
			'post_type'=>'kik_accident',
			'post_parent'=>$_POST['postId'],
			'post_status'=>'publish',
		)
	); 
	
	if(!$_POST['dataAccidentului']){
		update_post_meta($fileID, 'dataAccidentului', $_POST['dataAccidentului']);
	} else {
		$oDataAccidentului = DateTime::createFromFormat('d/m/Y', $_POST['dataAccidentului']);
		update_post_meta($fileID, 'dataAccidentului', $oDataAccidentului->format('Y/m/d'));
	}

	if(!$_POST['dataCercetarii']){
		update_post_meta($fileID, 'dataCercetarii', $_POST['dataCercetarii']);
	} else {
		$oDataCercetarii = DateTime::createFromFormat('d/m/Y', $_POST['dataCercetarii']);
		update_post_meta($fileID, 'dataCercetarii', $oDataCercetarii->format('Y/m/d'));
	}
	
	
	update_post_meta($fileID, 'accidentAngajat', $_POST['accidentAngajat']);
	update_post_meta($fileID, 'accidentDescriere', $_POST['accidentDescriere']);
	
	echo json_encode($fileID);
	wp_die();
}

?>