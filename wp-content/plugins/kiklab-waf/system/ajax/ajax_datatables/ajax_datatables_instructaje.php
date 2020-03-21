<?php

	add_action('wp_ajax_ajax_datatable_instructaje', 'ajax_datatable_instructaje');
	add_action('wp_ajax_nopriv_ajax_datatable_instructaje', 'ajax_datatable_instructaje');
	
	function ajax_datatable_instructaje(){

		$instructaje  = getAllInstructajeByPostId($_POST['kik_company_id']);
		$data_instr   = array();
		
		if(sizeof($instructaje)>0){
			foreach($instructaje as $instructaj){ 
				$data_row  = array(); 
				$dataInstr = get_post_meta($instructaj->ID, 'dataInstructajului', true);
				$dataRealizarii = get_post_meta($instructaj->ID, 'dataRealizarii', true);
				$tipInstr  = get_term_by('slug', get_post_meta($instructaj->ID, 'tipInstructaj', true), 'kik_tipuri_instructaj');
				
				if(!$dataInstr){
					continue;
				}
				
				$oDataInstr = DateTime::createFromFormat('Y/m/d', $dataInstr);
				$oDataRealizarii = DateTime::createFromFormat('Y/m/d', $dataRealizarii);
				
				$data_row[] = $tipInstr->name;
				$data_row[] = 
					'<span class="hide">'.$oDataInstr->getTimestamp().'</span>'.
					$oDataInstr->format('d/m/Y');
				$data_row[] = '<span class="hide">'. ($oDataRealizarii ? $oDataRealizarii->getTimestamp() : '') .'</span>' . 
					($oDataRealizarii ? $oDataRealizarii->format('d/m/Y') : '-');
			
				$disabled = '';
				$enableDelete = 'data-toggle="modal"
					data-target="#confirm-delete-modal"';

				if($oDataRealizarii){
					$disabled = 'disabled';
					$enableDelete = '';
				}
				
				$data_row[] =
					'<div alt="f182" 
						class="dashicons dashicons-trash dashicon-red cursor-pointer delete-record '. $disabled .'"
						record-type="instructaj"
						title="Șterge instructaj"
						record-id="'. $instructaj->ID . '" 
						'. $enableDelete .'></div>
					<div alt="f182" 
						class="dashicons dashicons-edit dashicon-blue cursor-pointer edit-instructaj '. $disabled .'"
						record-type="instructaj"
						title="Editează instructaj"
						id="edit-instructaj-div"
						record-id="'. $instructaj->ID . '">
						</div>';

				$data_instr['data'][] = $data_row;
			}
		} else {
			$data_instr['data'] = '';
		}
		
		echo json_encode($data_instr);
		wp_die();
		
	}
?>