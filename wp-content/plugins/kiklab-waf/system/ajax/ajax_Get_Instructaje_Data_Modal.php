<?php

	add_action('wp_ajax_kik_get_instructaje_data_modal', 'kik_get_instructaje_data_modal');
	add_action('wp_ajax_nopriv_kik_get_instr_instructaje_modal', 'kik_get_instructaje_data_modal');
	
	function kik_get_instructaje_data_modal(){
		global $wpdb;
	
		
		if(!isset($_POST['instructajID']) || empty($_POST['instructajID'])){
			returnError('Datele transmise sunt incomplete!');
		}
		
		$oInstructaj = get_post($_POST['instructajID']);
		
		if(is_null($oInstructaj)){
			returnError('Instructajul nu a putut fi identificat!');
		}
		
		$dataInstructajului = get_post_meta($oInstructaj->ID, 'dataInstructajului', true);
		$dataRealizarii 	= get_post_meta($oInstructaj->ID, 'dataRealizarii', true);
		$tipInstructaj 		= get_post_meta($oInstructaj->ID, 'tipInstructaj', true);
		
		$oDataInstructajului = DateTime::createFromFormat('Y/m/d', $dataInstructajului);
		$oDataRealizarii 	 = DateTime::createFromFormat('Y/m/d', $dataRealizarii);
		$oTipInstructaj		 = get_term_by('slug', $tipInstructaj, 'kik_tipuri_instructaj');
		
		$html = 
			'<div class="row">
				<!-- TIPUL INSTRUCTAJULUI -->
				<div class="form-group no-margin">
					<label class="control-label col-sm-3" for="kik_new_type_instructaj">Tipul instructajului: </label>
					<div class="col-sm-9">'. 
						KIK_DROPDOWN_TERMS(
							'kik_new_type_instructaj',
							'kik_new_type_instructaj',
							'kik_tipuri_instructaj',
							$oTipInstructaj->term_id
						) . ' 
					</div>
				</div>
				<!-- DATA INSTRUCTAJULUI -->
				<div class="form-group no-margin">
					<label class="control-label col-sm-3" for="kik_new_instructaj_date">Data programării: </label>
					<div class="col-sm-9">
						<input disabled type="text" class="form-control new new-instructaj-datepicker" 
							id="kik_new_instructaj_date" 
							placeholder="Data instructajului" 
							name="kik_new_instructaj_date"
							value="'. ($oDataInstructajului ? $oDataInstructajului->format('d/m/Y') : '') .'"/>
					</div>
				</div>
				<!-- DATA REALIZARII INSTRUCTAJULUI -->
				<div class="form-group no-margin">
					<label class="control-label col-sm-3" for="kik_instructaj_fulfill_date">Data realizării: </label>
					<div class="col-sm-9">
						<input type="text" class="form-control new fulfill-instructaj-datepicker" 
							id="kik_instructaj_fulfill_date" 
							placeholder="Data realizării instructajului" 
							name="kik_instructaj_fulfill_date"
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