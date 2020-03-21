<?php

	add_action('wp_ajax_ajax_datatables_users', 'ajax_datatables_users');
	add_action('wp_ajax_nopriv_ajax_datatables_users', 'ajax_datatables_users');
	
	function ajax_datatables_users(){
		global $wpdb;
		global $wp_roles;
		$arrRoles   = [];
		$data_terms = [];
		$users 		= get_users();
		
		foreach($wp_roles->roles as $role => $roleDetails){
			$arrRoles[$role] = $roleDetails['name'];
		}
		
		if(sizeof($users)>0){
			foreach($users as $user){ 
				$displayRoles = [];
				foreach($user->roles as $role){
					$displayRoles[$role] = $arrRoles[$role];
				}
				$data_row	= [];
				$data_row[] = $user->first_name . ' ' . $user->last_name;
				$data_row[] = $user->user_login;
				$data_row[] = $user->user_email;
				$data_row[] = implode(', ', $displayRoles);
				$data_row[] = "<div alt='f182' 
								class='dashicons dashicons-trash dashicon-red cursor-pointer'
								title='Șterge utilizator'
								user-id='". $user->ID . "'
								data-toggle='modal'
								data-target='#confirm-delete-user-modal'></div>
							<div alt='f464' 
								class='dashicons dashicons-edit dashicon-blue cursor-pointer'
								title='Editează utilizator'
								user-id='". $user->ID . "'
								data-toggle='modal'
								data-target='#edit-user-modal'></div>
							<div alt='f123' 
								class='dashicons dashicons-format-aside dashicon-blue cursor-pointer'
								title='Asociază firme'
								user-id='". $user->ID . "'
								data-toggle='modal'
								data-target='#add-company-user-modal'></div>";
				$data_terms['data'][] = $data_row;
			}
		} else {
			$data_terms['data'] = '';
		}
		
		echo json_encode($data_terms);
		wp_die();	
	}
?>