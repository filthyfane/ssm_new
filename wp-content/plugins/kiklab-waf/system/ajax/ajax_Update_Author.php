<?php
	add_action('wp_ajax_KIK_ACTION_Update_Author', 'KIK_ACTION_Update_Author');
	add_action('wp_ajax_nopriv_KIK_ACTION_Update_Author', 'KIK_ACTION_Update_Author');

	function KIK_ACTION_Update_Author(){
		global $wpdb;

		//stefan01!
		validateUpdateAuthor($_POST);

		$oUser = get_user_by('id', $_POST['kikUserId']);

		$oUser->first_name 	= $_POST['kikAuthorFirstName'];
		$oUser->last_name 	= $_POST['kikAuthorLastName'];
		$oUser->user_email 	= $_POST['kikAuthorMail'];
		$userId 			= wp_update_user($oUser);

		if(is_wp_error($userId)){
			returnError($userId->get_error_message());
		}

		if(strlen(trim($_POST['kikAuthorPass'])) > 0){
			wp_set_password($_POST['kikAuthorPass'], $oUser->ID);
			$response = wp_mail($oUser->user_email, 'Update user', 'Noua parolă este ' . $_POST['kikAuthorPass']);
			if (!response){
				returnError('Mailul nu a putut fi trimis! Vă rugăm să contactați administratorul site-ului!');
			}
		}

		echo json_encode(['success' => true]);
		die();
	}

	function validateUpdateAuthor($post){
		if(!check_ajax_referer('update-author', 'nonce', false)){
			returnError('Cererea nu a putut fi procesată! Vă rugăm reîncercați. În cazul în care problema persistă, contactați administratorul site-ului!');
		}

		$fields = [
			'kikAuthorFirstName' => 'Prenumele',
			'kikAuthorLastName' => 'Numele',
			'kikAuthorMail' => 'Email-ul',
			'kikUserId' => 'Utilizatorul '
		];

		foreach($fields as $field => $text){
			if(strlen(trim($post[$field])) == 0){
				returnError($text . ' nu este completat!');
			}
		}

		if(strlen(trim($post['kikAuthorPass'])) > 0){
			passwordValidator($post['kikAuthorPass'], $post['kikAuthorPassConfirm']);
		}
	}
?>