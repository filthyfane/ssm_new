<?php

	add_action('wp_ajax_ajax_get_employee_data_modal', 'ajax_get_employee_data_modal');
	add_action('wp_ajax_nopriv_ajax_get_employee_data_modal', 'ajax_get_employee_data_modal');
	
	function ajax_get_employee_data_modal(){
		global $wp_roles;
		
		if(!isset($_POST['employeeID']) || empty($_POST['employeeID'])){
			returnError('Datele transmise sunt incomplete!');
		}
		
		$oEmployee = get_post((int)$_POST['employeeID']);
		
		if(is_null($oEmployee)){
			returnError('Ședința CSSM nu a putut fi identificată!');
		}
		
		$numeAngajat 			= get_post_meta($oEmployee->ID, 'numeAngajat', true);
		$prenumeAngajat 		= get_post_meta($oEmployee->ID, 'prenumeAngajat', true);
		$functieAngajat 		= get_post_meta($oEmployee->ID, 'functieAngajat', true);
		$adresaAngajat 			= get_post_meta($oEmployee->ID, 'adresaAngajat', true);
		$cnpAngajat 			= get_post_meta($oEmployee->ID, 'cnpAngajat', true);
		$normaAngajat 			= get_post_meta($oEmployee->ID, 'normaAngajat', true);
		$contractAngajatStart 	= get_post_meta($oEmployee->ID, 'contractAngajatStart', true);
		$contractAngajatSfarsit = get_post_meta($oEmployee->ID, 'contractAngajatSfarsit', true);
		$conducator 			= get_post_meta($oEmployee->ID, 'conducator', true);
		$autorizatieSpeciala 	= get_post_meta($oEmployee->ID, 'autorizatieSpeciala', true);
		
		$html = '
			<!-- FIELD: NUME -->
			<div class="form-horizontal">
				<div class="form-group no-margin">
					<label class="control-label col-sm-3" for="kik_angajat_lastname">Nume angajat: </label>
					<div class="col-sm-9">
						<input type="text" 
							class="form-control" 
							id="kik_angajat_lastname" 
							placeholder="Nume angajat" 
							name="kik_angajat_lastname"
							value="' . $numeAngajat . '"/>
					</div>
				</div>';
		
		$html .= '
			<!-- FIELD: PRENUME -->
			<div class="form-group no-margin">
				<label class="control-label col-sm-3" for="kik_angajat_firstname">Prenume angajat: </label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control" 
						id="kik_angajat_firstname" 
						placeholder="Prenume angajat" 
						name="kik_angajat_firstname"
						value="' . $prenumeAngajat . '"/>
				</div>
			</div>';
			
		$html .= '
			<!-- FIELD: FUNCTIE -->
			<div class="form-group no-margin">
				<label class="control-label col-sm-3" for="kik_angajat_functie">Funcție angajat: </label>
				<div class="col-sm-9">
					<input type="text" 
					   class="form-control" 
					   id="kik_angajat_functie" 
					   placeholder="Funcție" 
					   name="kik_angajat_functie"
					   value="' . $functieAngajat . '"/>
				</div>
			</div>';
				
		$html .= '
			<!-- FIELD: ADRESA -->
			<div class="form-group no-margin">
				<label class="control-label col-sm-3" for="kik_angajat_adresa">Adresă angajat: </label>
				<div class="col-sm-9">
					<input type="text" 
						class="form-control" 
						id="kik_angajat_adresa" 
						placeholder="Adresă angajat" 
						name="kik_angajat_adresa"
						value="' . $adresaAngajat . '"/>
				</div>
			</div>';
				
		$html .= '
			<!-- FIELD: CNP ANGAJAT -->
			<div class="form-group no-margin">
				<label class="control-label col-sm-3" for="kik_angajat_cnp">CNP angajat: </label>
				<div class="col-sm-9">
					<input type="text" size=13 maxlength=13
						class="form-control" 
						id="kik_angajat_cnp" 
						placeholder="Cod numeric personal" 
						name="kik_angajat_cnp"
						value="' . $cnpAngajat . '"/>
				</div>
			</div>';
			
		$html .= '
			<!-- FIELD: NORMA DE LUCRU -->
			<div class="form-group no-margin">
				<label class="control-label col-sm-3" for="kik_angajat_norma">Norma de lucru: </label>
				<div class="col-sm-9">' . 
					wp_dropdown_categories(array(
						'show_option_none'   => '-- Alege --',
						'orderby'            => 'NAME', 
						'hide_empty'         => 0,
						'echo'               => 0,
						'selected'           => $normaAngajat,
						'name'               => 'kik_angajat_norma',
						'id'                 => 'kik_angajat_norma',
						'class'              => 'form-control',
						'taxonomy'           => 'kik_norme_lucru',
						'hide_if_empty'      => false,
					)) . '
				</div>
			</div>';
		
		$oDataInceputContract = DateTime::createFromFormat('Y/m/d', $contractAngajatStart);
		$html .= '
			<!-- FIELD: DATA INCEPERE CONTRACT -->
			<div class="form-group no-margin">
				<label class="control-label col-sm-3" for="kik_angajat_contract_start">Data de început a contractului: </label>
				<div class="col-sm-9">
					<input 	type="text" 
						class="form-control new new-data-exp-datepicker" 
						id="kik_angajat_contract_start" 
						placeholder="Dată început" 
						name="kik_angajat_contract_start" 
						value="' . ($oDataInceputContract !== false ? $oDataInceputContract->format('d/m/Y') : '') . '"/>
				</div>
			</div>';
			
		$oDataSfarsitContract = DateTime::createFromFormat('Y/m/d', $contractAngajatSfarsit);
		$html .= '
			<!-- FIELD: DATA SFARSIT CONTRACT -->
			<div class="form-group no-margin">
				<label class="control-label col-sm-3" for="kik_angajat_contract_end">Data de sfârșit a contractului: </label>
				<div class="col-sm-9">
					<input 	type="text" 
						class="form-control new new-data-exp-datepicker" 
						id="kik_angajat_contract_end" 
						placeholder="Dată sfârșit" 
						name="kik_angajat_contract_end" 
						value="' . ($oDataSfarsitContract !== false ? $oDataSfarsitContract->format('d/m/Y') : '') . '"/>
				</div>
			</div>';
				
		$html .= '
			<!-- FIELD: CONDUCATOR LOC DE MUNCA -->
			<div class="form-group no-margin">
				<label class="control-label col-sm-3" for="kik_angajat_conducator">Conducător loc de muncă: </label>
				<div class="col-sm-9">
					<div class="checkbox">
						<label class="checkbox-label">
							<input type="checkbox"
								id="kik_angajat_conducator" 
								name="kik_angajat_conducator" 
								' . ($conducator === 'true' ? 'checked' : '') . '/>
							<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
						</label>
					</div>
				</div>
			</div>';
			
		$style 			= 'style="display:none"';
		$telefonAngajat = get_post_meta($oEmployee->ID, 'telefonAngajat', true);
		$emailAngajat   = get_post_meta($oEmployee->ID, 'emailAngajat', true);
		
		if($conducator === 'true'){
			$style = '';
		}
		
		$html .= '
			<!-- FIELD: TELEFON -->
			<div class="form-group no-margin" ' . $style . '>
				<label class="control-label col-sm-3" for="kik_angajat_telefon">Telefon: </label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control" 
						id="kik_angajat_telefon" 
						placeholder="Telefon" 
						name="kik_angajat_telefon"
						value="' . $telefonAngajat . '"
						/>
				</div>
			</div>
			<!-- FIELD: EMAIL -->
			<div class="form-group no-margin" ' . $style . '>
				<label class="control-label col-sm-3" for="kik_angajat_email">Email: </label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control" 
						id="kik_angajat_email" placeholder="Email" 
						name="kik_angajat_email"
						value="' . $emailAngajat . '"/>
				</div>
			</div>';
		
		
		$html .= '
			<!-- FIELD: AUTORIZATIE SPECIALA -->
			<div class="form-group no-margin">
				<label class="control-label col-sm-3" for="kik_angajat_autorizatie">Autorizație specială: </label>
				<div class="col-sm-9">
					<div class="checkbox">
						<label class="checkbox-label">
							<input 	type="checkbox"
								id="kik_angajat_autorizatie" 
								name="kik_angajat_autorizatie" 
								' . ($autorizatieSpeciala === 'true' ? 'checked' : '') . '/>
							<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
						</label>
					</div>
				</div>
			</div>';
				
		$style = "style='display:none'";
		$tipAutorizatie = get_post_meta($oEmployee->ID, 'tipAutorizatie', true);
		$expirareAutorizatie = get_post_meta($oEmployee->ID, 'expirareAutorizatie', true);
		$oExpirareAutorizatie = DateTime::createFromFormat('Y/m/d', $expirareAutorizatie);
		
		if($autorizatieSpeciala === 'true'){
			$style = '';
		}
		
		$html .= '
			<!-- FIELD: TIP AUTORIZATIE -->
			<div class="form-group no-margin" ' . $style . '>
				<label class="control-label col-sm-3" for="kik_angajat_tip_autorizatie">Tip autorizație: </label>
				<div class="col-sm-9">
					<input type="text"
						class="form-control" 
						id="kik_angajat_tip_autorizatie" placeholder="Tip autorizație" 
						name="kik_angajat_tip_autorizatie"
						value="' . $tipAutorizatie . '"/>
				</div>
			</div>
			<!-- FIELD: DATA EXPIRARE AUTORIZATIE -->
			<div class="form-group no-margin" style="display:none">
				<label class="control-label col-sm-3" for="kik_angajat_autorizatie_end">Data de sfârșit a autorizației: </label>
				<div class="col-sm-9">
					<input 	type="text" 
						class="form-control new new-data-exp-datepicker" 
						id="kik_angajat_autorizatie_end" 
						placeholder="Data expirării autorizației" 
						name="kik_angajat_autorizatie_end" 
						value="' . ($oExpirareAutorizatie !== false ? $oExpirareAutorizatie->format('d/m/Y') : '') . '"/>
				</div>
			</div>
		</div>';
		
		$response = [
			'success' => true,
			'html' 	  => $html
		];
		
		echo json_encode($response);
		die();
	}
?>