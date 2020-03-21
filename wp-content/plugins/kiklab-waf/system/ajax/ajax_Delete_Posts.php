<?php


#####------------------------------------
##### FRONT END: DELETE POST
#####------------------------------------


##### Delete custom post
add_action('wp_ajax_KIK_ACTION_Delete_Posts', 'KIK_ACTION_Delete_Posts');
add_action('wp_ajax_nopriv_KIK_ACTION_Delete_Posts', 'KIK_ACTION_Delete_Posts');
function KIK_ACTION_Delete_Posts() {
	global $wpdb;
	$dataTableIds = [
		'cssm' 		 => 'cssm-table',
		'angajat' 	 => 'employees-table',
		'instructaj' => 'instructaje-table',
		'echipament' => 'echipamente-table'
	];
	
	if(!isset($_POST['recordId']) || !isset($_POST['recordType'])){
		returnError('Datele transmise sunt incomplete!');
	}
	
	$dataTableId = '';
	switch($_POST['recordType']){
		case "taxonomy_term":
			$deleted = wp_delete_term($_POST['recordId'], $_POST['taxonomy']);
			$dataTableId = $_POST['taxonomy'];
			break;
		case "cssm":
		case "angajat":
		case "instructaj":
		case "echipament":
			$deleted = wp_delete_post($_POST['recordId'], true); //true = force delete (bypass trash)
			$dataTableId = $dataTableIds[$_POST['recordType']];
			break;
		default:
			returnError('Tipul de inregistrare trimis nu exista!');
	}
	
	if (!$deleted) {
		returnError('Eroare la stergerea inregistrarii!');
	} else {
		echo json_encode([
			'success' => true,
			'hasCount' => true,
			'dataTableId' => $dataTableId
		]);
		wp_die();
	}
}

?>