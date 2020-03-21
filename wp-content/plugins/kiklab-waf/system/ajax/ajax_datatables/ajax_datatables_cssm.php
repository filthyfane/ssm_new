<?php

	add_action('wp_ajax_ajax_datatable_cssm', 'ajax_datatable_cssm');
	add_action('wp_ajax_nopriv_ajax_datatable_cssm', 'ajax_datatable_cssm');
	
	function ajax_datatable_cssm(){
		
		$kik_cssm = getAllCssm($_POST['kik_company_id']);
		$data_cssm = array();
		
		if(sizeof($kik_cssm)>0){
			foreach($kik_cssm as $cssm){ 
				$data_row = array(); 
				$dataSedinta = get_post_meta($cssm->ID, 'dataSedintei', true);
				$dataRealizarii = get_post_meta($cssm->ID, 'dataRealizarii', true);
				
				if(!$dataSedinta){
					continue;
				}
				
				$oDataSedinta = DateTime::createFromFormat('Y/m/d', $dataSedinta);
				$oDataRealizarii = DateTime::createFromFormat('Y/m/d', $dataRealizarii);
				
				/*$realizat = get_post_meta($cssm->ID, "realizat", true);
				$checked = "";
				if($realizat === "1") 
					{$checked = "checked "; 
				} */
				
				$data_row[] = 
					'<span class="hide">'.$oDataSedinta->getTimestamp().'</span>'.
					$oDataSedinta->format('d/m/Y');
				
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
						record-type="cssm"
						title="Șterge ședință CSSM"
						record-id="'. $cssm->ID . '" 
						'. $enableDelete .'></div>
					<div alt="f182" 
						class="dashicons dashicons-edit dashicon-blue cursor-pointer edit-cssm '. $disabled .'"
						record-type="cssm"
						title="Editează ședință CSSM"
						id="edit-cssm-div"
						record-id="'. $cssm->ID . '">
						</div>';

						
			$data_cssm['data'][] = $data_row;
			}
		} else {
			$data_cssm['data'] = '';
		}
		
		echo json_encode($data_cssm);
		wp_die();
		
	}
?>