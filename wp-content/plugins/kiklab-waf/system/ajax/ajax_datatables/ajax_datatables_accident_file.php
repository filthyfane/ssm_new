<?php

	add_action('wp_ajax_ajax_datatable_accident_file', 'ajax_datatable_accident_file');
	add_action('wp_ajax_nopriv_ajax_datatable_accident_file', 'ajax_datatable_accident_file');
	
	function ajax_datatable_accident_file(){
		
		$kik_accident_files = getAccidentsByCoId($_POST['kik_company_id']);
		$data_accidents 	= array();
		
		if(sizeof($kik_accident_files) > 0) {
			foreach($kik_accident_files as $kik_accident_file) {
				$data_row = array();
				$oDataCercetarii = DateTime::createFromFormat('Y/m/d', get_post_meta($kik_accident_file->ID, 'dataCercetarii', true));
				$oDataAccidentului = DateTime::createFromFormat('Y/m/d', get_post_meta($kik_accident_file->ID, 'dataAccidentului', true));
				$employeeId = get_post_meta($kik_accident_file->ID, 'accidentAngajat', true);
				$fullEmployeeName = 
					get_post_meta($employeeId, 'numeAngajat', true).' '.
					get_post_meta($employeeId, 'prenumeAngajat', true);
				
				$data_row[] = '<span class="hide">'.$oDataCercetarii->getTimestamp().'</span>'.$oDataCercetarii->format('d/m/Y');
				$data_row[] = $oDataAccidentului->format('d/m/Y');
				$data_row[] = $fullEmployeeName;
				$data_row[] = get_post_meta($kik_accident_file->ID, 'accidentDescriere', true);
				$data_row[] = '<a class="btn btn-danger delete-record"
							record-id= '.$kik_accident_file->ID.' record-type="angajat"
							data-toggle="modal" data-target="#confirm-delete-modal">
							Șterge dosar
						</a>';
				$data_accidents['data'][] = $data_row;
			}
		} else {
			$data_accidents['data'] = array();
		}
		
		echo json_encode($data_accidents);

		wp_die();
		
	}
?>