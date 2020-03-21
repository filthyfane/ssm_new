<?php

	add_action('wp_ajax_KIK_ACTION_Save_Relation_User_Companies', 'KIK_ACTION_Save_Relation_User_Companies');
	add_action('wp_ajax_nopriv_KIK_ACTION_Save_Relation_User_Companies', 'KIK_ACTION_Save_Relation_User_Companies');
	
	function KIK_ACTION_Save_Relation_User_Companies(){

		if( !isset($_POST['userId']) || empty($_POST['userId']) || 
			!isset($_POST['companies']) || empty($_POST['companies'])){
			returnError('Datele transmise sunt incomplete!');
		}
		
		$user = get_user_by('id', $_POST['userId']);
		
		if(!user){
			returnError('Utilizatorul cu ID-ul transmis nu există!');
		} else {
			foreach($_POST['companies'] as $metaKey => $arrCompanies){
				if(empty($arrCompanies)){
					continue;
				} else {
					foreach($arrCompanies as $companyId){
						update_post_meta($companyId, $metaKey, $user->ID);
					}
				}
			}
			$response = ['success' => true];
		}
		
		echo json_encode($response);
		die();
	}
?>