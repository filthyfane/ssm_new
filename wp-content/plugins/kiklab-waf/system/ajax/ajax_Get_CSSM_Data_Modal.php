<?php

	add_action('wp_ajax_kik_get_cssm_data_modal', 'kik_get_cssm_data_modal');
	add_action('wp_ajax_nopriv_kik_get_cssm_data_modal', 'kik_get_cssm_data_modal');
	
	function kik_get_cssm_data_modal(){
		global $wpdb;
	
		
		if(!isset($_POST['cssmID']) || empty($_POST['cssmID'])){
			returnError('Datele transmise sunt incomplete!');
		}
		
		$oCssm = get_post((int)$_POST['cssmID']);
		
		if(is_null($oCssm)){
			returnError('Ședința CSSM nu a putut fi identificată!');
		}
		
		$dataCssm	 	 = get_post_meta($oCssm->ID, 'dataSedintei', true);
		$dataRealizarii  = get_post_meta($oCssm->ID, 'dataRealizarii', true);
		
		$oDataCssm 		 = DateTime::createFromFormat('Y/m/d', $dataCssm);
		$oDataRealizarii = DateTime::createFromFormat('Y/m/d', $dataRealizarii);
		
		$html = 
			'<div class="row">
				<!-- DATA SEDINTEI -->
				<div class="form-group no-margin">
					<label class="control-label col-sm-3" for="kik_new_cssm_date">Data ședinței: </label>
					<div class="col-sm-9">
						<input disabled type="text" 
							class="form-control new new-cssm-datepicker" 
							id="kik_new_cssm_date" 
							placeholder="Data ședinței" 
							name="kik_new_cssm_date"
							value="'. ($oDataCssm ? $oDataCssm->format('d/m/Y') : '') .'"/>
					</div>
				</div>
				<!-- DATA REALIZARII SEDINTEI -->
				<div class="form-group no-margin">
					<label class="control-label col-sm-3" for="kik_cssm_fulfill_date">Data realizării: </label>
					<div class="col-sm-9">
						<input type="text" class="form-control new fulfill-cssm-datepicker" 
							id="kik_cssm_fulfill_date" 
							placeholder="Data realizării" 
							name="kik_cssm_fulfill_date"
							value="'. ($oDataRealizarii ? $oDataRealizarii->format('d/m/Y') : '') .'"/>
					</div>
				</div>
			</div>';
			
		$response = [
			'success' => true,
			'html' => $html
		];

		echo json_encode($response);
		die();
	}
?>