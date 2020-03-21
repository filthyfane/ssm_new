<?php

	add_action('wp_ajax_ajax_datatable_echipamente', 'ajax_datatable_echipamente');
	add_action('wp_ajax_nopriv_ajax_datatable_echipamente', 'ajax_datatable_echipamente');
	
	function ajax_datatable_echipamente(){
		
		$kik_ID = $_POST['kik_company_id'];
		
		$args = array(
			'post_parent' => $kik_ID,
			'post_type'   => 'kik_equipment', 
		);
		$kik_equipments = get_children($args);
		$data_equipments = array();
		
		if (sizeof($kik_equipments) > 0){
			foreach($kik_equipments as $echipament){
				$data_row 	   = array();
				$idEchipament  = get_post_meta($echipament->ID, 'idEchipament', true);
				$objEchipament = get_term_by('id', $idEchipament, 'kik_echipamente'); 
				$iscir 		   = get_post_meta($echipament->ID, 'iscir', true); 
				$iscir_checked = $iscir === "true" ? " checked" : "";
				$oIscirExpDate = $iscir === "true" ? DateTime::createFromFormat('Y/m/d', get_post_meta($echipament->ID, 'dataExpIscir', true)) : "-";  
				$oDataExpirare = DateTime::createFromFormat('Y/m/d', get_post_meta($echipament->ID, 'dataExpirare', true));
				
				$data_row[] = $objEchipament->name;
				$data_row[] = get_post_meta($echipament->ID, 'nrBuc', true);
				$data_row[] = $oDataExpirare->format('d/m/Y');
				
				$data_row[] = '<div class="col-sm-9">
							<div class="checkbox">
								<label class="checkbox-label">
									<input type="checkbox"
										   disabled'. $iscir_checked .' />
									<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								</label>
							</div>
						</div>';
				$data_row[] = is_object($oIscirExpDate) ? $oIscirExpDate->format('d/m/Y') : '-';
				$data_row[] = '<div alt="f182" 
						class="dashicons dashicons-trash dashicon-red cursor-pointer delete-record"
						record-type="echipament"
						title="Șterge echipament"
						record-id="'. $echipament->ID . '"
						data-toggle="modal"
						data-target="#confirm-delete-modal">
					</div>';
				$data_equipments['data'][] = $data_row;
			}
		} else {
			$data_equipments['data'] = [];
		}
	
		echo json_encode($data_equipments);
		wp_die();
		
	}
?>