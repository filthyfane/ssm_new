<?php

	add_action('wp_ajax_ajax_get_user_data_modal', 'ajax_get_user_data_modal');
	add_action('wp_ajax_nopriv_ajax_get_user_data_modal', 'ajax_get_user_data_modal');
	
	function ajax_get_user_data_modal(){
		global $wp_roles;
		
		$user = get_user_by('id', $_POST['userId']);
		
		if ($user) {
			
			$html_roles = '';
			foreach($wp_roles->roles as $role => $roleDetails){
				$checked = in_array($role, $user->roles) ? 'checked' : '';
				$html_roles .= '<div class="col-sm-5 col-md-4">
					<input type="checkbox" name="kik_roles[]" '.$checked.' id="'. $role .'" value="'. $role .'"> 
						<label for="'. $role .'">'. $roleDetails['name'] .'</label>
				</div>';
			}
				
			$html = 
				'<div class="form-group user-details">
					<label class="control-label col-sm-2" for="kik_user_login">Utilizator: </label>
					<div class="col-sm-10">
						<input disabled type="text" 
							class="form-control" 
							name="kik_user_login" 
							placeholder="Nume utilizator" 
							value="'.$user->user_login.'">
					</div>
				</div>
				<div class="form-group user-details">
					<label class="control-label col-sm-2" for="kik_user_last_name">Nume: </label>
					<div class="col-sm-10">
						<input type="text" 
							class="form-control" 
							name="kik_user_last_name" 
							placeholder="Prenume utilizator" 
							value="'.$user->first_name.'">
					</div>
				</div>
				<div class="form-group user-details">
					<label class="control-label col-sm-2" for="kik_user_first_name">Prenume: </label>
					<div class="col-sm-10">
						<input type="text" 
							class="form-control" 
							name="kik_user_first_name" 
							placeholder="Nume" 
							value="'.$user->last_name.'">
					</div>
				</div>				
				<div class="form-group user-details">
					<label class="control-label col-sm-2" for="kik_user_mail">Email: </label>
					<div class="col-sm-10">
						<input 
							type="text" 
							class="form-control" 
							name="kik_user_mail" 
							placeholder="Email" 
							value="'.$user->user_email.'">
					</div>
				</div>
				<div class="form-group user-details">
					<label class="control-label col-sm-2" for="kik_user_password">Parolă nouă: </label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="kik_user_password" placeholder="Parolă nouă" value="">
					</div>
				</div>
				<div class="form-group user-details">
					<label class="control-label col-sm-2" for="kik_user_confirm_password">Confirmă parola: </label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="kik_user_confirm_password" placeholder="Confirmă parola" value="">
					</div>
				</div>
				<div class="form-group user-details">
					<label class="control-label col-sm-2">Drepturi: </label>
					<div class="col-sm-10">
						'.$html_roles.'
					</div>
				</div>';

			$response = [
				'success' => true,
				'html'    => $html
			];
		} else {
			returnError('Nu au fost găsite detalii pentru acest utilizator!');
		}
		
		echo json_encode($response);
		die();
	}
?>