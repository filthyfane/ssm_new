<?php

	add_action('wp_ajax_KIK_ACTION_Delete_User', 'KIK_ACTION_Delete_User');
	add_action('wp_ajax_nopriv_KIK_ACTION_Delete_User', 'KIK_ACTION_Delete_User');

	function KIK_ACTION_Delete_User(){
		global $wpdb;
		$currUser = wp_get_current_user();
		$response = [];
		
		if(!isset($_POST['userId']) || !is_numeric($_POST['userId'])){
			returnError('Utilizatorul nu a putut fi șters!');
		}
		
		if(!current_user_can('delete_users')){
			returnError('Nu aveți suficiente drepturi pentru a efectua această acțiune!');
		}
		
		// The current user cannot be deleted
		if($_POST['userId'] == $currUser->ID){
			returnError('Nu puteți șterge acest utilizator!');
		}
		
		
		$result = wp_delete_user($_POST['userId'], $current_user->ID);
		
		if($result){
			$response = ['success' => true];
		} else {
			returnError('O eroare a apărut în timpul ștergerii utilizatorului!');
		}
		
		echo json_encode($response);
		die();
	}
?>