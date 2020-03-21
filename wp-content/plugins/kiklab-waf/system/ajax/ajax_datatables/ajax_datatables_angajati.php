<?php

	add_action('wp_ajax_ajax_datatable_angajati', 'ajax_datatable_angajati');
	add_action('wp_ajax_nopriv_ajax_datatable_angajati', 'ajax_datatable_angajati');
	
	function ajax_datatable_angajati(){
		
		$kik_ID = $_POST['kik_company_id'];
		
		$args = array(
			'post_parent' => $kik_ID,
			'post_type' => 'kik_employee'
		);
		$kik_employees = get_children($args);
		$data_employees = array();
				
		if(sizeof($kik_employees) > 0){
			foreach($kik_employees as $employee){ 
				$data_row = array();
				
				$startContract 		 = get_post_meta($employee->ID, 'contractAngajatStart', true);
				$sfarsitContract 	 = get_post_meta($employee->ID, 'contractAngajatSfarsit', true); 
				$conducator 		 = get_post_meta($employee->ID, 'conducator', true);
				$autorizatieSpeciala = get_post_meta($employee->ID, 'autorizatieSpeciala', true);
				$normaID 			 = get_post_meta($employee->ID, 'normaAngajat', true);
				$oNorma 			 = get_term_by('id', $normaID, 'kik_norme_lucru');
				$norma 				 = is_object($oNorma) ? $oNorma->name : '-';
				
				if(!empty($startContract)){
					$oStartContract = DateTime::createFromFormat('Y/m/d', $startContract);
					$startContract = '<b>Data început contract: </b>'.$oStartContract->format('d/m/Y').'</br>';
				}					
				if(!empty($sfarsitContract)){
					$oSfarsitContract = DateTime::createFromFormat('Y/m/d', $sfarsitContract);
					$sfarsitContract = '<b>Data sfârșit contract: </b>'.$oSfarsitContract->format('d/m/Y').'</br>';
				} 
				if($conducator === 'true'){
					$conducator = '<b>Conducător: </b>Da; <b>Număr telefon: </b>'.
							get_post_meta($employee->ID, 'telefonAngajat', true).
							'; <b>Email: </b>'.get_post_meta($employee->ID, 'emailAngajat', true).'</br>';
				} else {
					$conducator = '<b>Conducător: </b>Nu; </br>';
				}
				if($autorizatieSpeciala === 'true'){
					$autorizatieSpeciala = '<b>Autorizație specială: </b>Da; <b>Tip autorizație: </b>'.
								get_post_meta($employee->ID, 'tipAutorizatie', true).
								'; <b>Data expirare autorizație: </b>'.get_post_meta($employee->ID, 'expirareAutorizatie', true);
				} else {
					$autorizatieSpeciala = '<b>Autorizație specială: </b>Nu; </br>';
				} 
				
				$data_row[] = get_post_meta($employee->ID, 'numeAngajat', true);
				$data_row[] = get_post_meta($employee->ID, 'prenumeAngajat', true);
				$data_row[] = get_post_meta($employee->ID, 'functieAngajat', true);
				$data_row[] = '<b>CNP: </b>'.get_post_meta($employee->ID, 'cnpAngajat', true).'; '.
						'<b>Adresă: </b>'.get_post_meta($employee->ID, 'adresaAngajat', true).'; '.
						'<b>Norma de lucru: </b>'.$norma.'; </br>'.
						$startContract.
						$sfarsitContract.
						$conducator.
						$autorizatieSpeciala;
				$data_row[] = '<div alt="f182" 
							class="dashicons dashicons-trash dashicon-red cursor-pointer delete-record '. $disabled .'"
							record-type="employee"
							title="Șterge angajat"
							record-id="'. $employee->ID . '"
							data-toggle="modal"
							data-target="#confirm-delete-modal">
						</div>
						<div alt="f182" 
							class="dashicons dashicons-edit dashicon-blue cursor-pointer edit-cssm '. $disabled .'"
							record-type="employee"
							title="Editează angajat"
							id="edit-angajat-div"
							record-id="'. $employee->ID . '">
						</div>';
				$data_employees['data'][]=$data_row;
			}
		} else {
			$data_employees['data'] = array();
		}
		
		
		
		echo json_encode($data_employees);

		
		wp_die();
		
	}
?>