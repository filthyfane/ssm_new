
	<!-- ****************************************************************************************-->
	<!-- *****************************DATE SOCIETATE*********************************************-->
	<!-- ****************************************************************************************-->
	<?php 
		$title = get_the_title() != "Firmă nouă" ? get_the_title() : ''; 
		$noMargin = $title ? '' : 'style="margin-top:0px"';
	?>
	
	<div class="row no-margin">
		<div class="col-sm-12">
			<h3 class="tab-title" <?php echo $noMargin; ?>><i>Date societate</i></h3>
		</div>
	</div>
	
		
	<div class="row no-margin">
		<!-- NUME COMPANIE -->
		<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_title">Nume: </label>
			<!--id="kik_company_title"-->
			<div class="col-sm-10">
				<input type="text" class="form-control"  name="kik_company_title" placeholder="Numele companiei" value="<?php echo $title; ?>" />
			</div>
		</div>
		
		<!-- CUI(CIF) -->
		<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_cif">CUI (CIF): </label>
			<!--id="kik_company_title"-->
			<div class="col-sm-10">
				<input type="text" class="form-control" id="kik_company_cif" placeholder="Cod unic de înregistrare" name="kik_company_cif" value="<?php echo esc_html($kik_company_cif); ?>" />
			</div>
		</div>
		
		<!-- NUMAR RECOM -->
		<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_reg">Număr RECOM: </label>
			<!--id="kik_company_title"-->
			<div class="col-sm-10">
				<input type="text" class="form-control" id="kik_company_reg" placeholder="Număr Registru Comerțului" name="kik_company_reg" value="<?php echo esc_html($kik_company_reg); ?>" />
			</div>
		</div>
		
		<!-- COD CAEN -->
		<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_caen">Cod CAEN: </label>
			<div class="col-sm-10">
				<select class="form-control kik_company_caen" name="kik_company_caen" id="kik_company_caen">
					<option value="-1">-- Alege codul CAEN --</option><?php

					$html = '';
					$terms = get_terms('kik_cod_caen', ['hide_empty' => 0]);
					$selectedId = is_object($kik_company_caen) ? $kik_company_caen->term_id : '';
					foreach($terms as $term){
						$selected = '';
						if($selectedId == $term->term_id){
							$selected = 'selected';
						} 
						$html .= "<option value='{$term->term_id}' {$selected}>{$term->name} - {$term->description}</option>";
					} 
					echo $html; ?>
				</select>
			</div>
		</div>
		
		<!-- SEDIUL SOCIAL -->
		<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_address">Adresă sediu social: </label>
			<!--id="kik_company_title"-->
			<div class="col-sm-10">
				<input type="text" class="form-control" id="kik_company_address" placeholder="Adresă sediul social" name="kik_company_address" value="<?php echo esc_html($kik_company_address); ?>" />
			</div>
		</div>
		<div class="row no-margin workpoints-container"><?php 
			if(!empty($kik_company_workpoints)){
				foreach($kik_company_workpoints as $k => $adress){
					$label = $k > 0 ? '' : 'Punct de lucru'; ?>
					<div class="form-group workpoint">
						<label class="control-label col-sm-2" for=""><?php echo $label; ?></label>
						<div class="col-sm-9">
							<input type="text" 
								   class="form-control" 
								   id="kik_workpoint" 
								   placeholder="Adresă punct de lucru" 
								   name="kik_workpoints[]" 
								   placeholder="Adresă punct de lucru" 
								   value="<?php echo $adress; ?>" />
						</div>
						<div class="col-sm-1">
							<button id="b1" class="btn btn-danger remove-workpoint" type="button">Șterge</button>
						</div>
					</div> <?php
				}
			} ?>
		</div>
		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-10">
				<a class="btn btn-primary" id='add-repeating-workpoint'>Adaugă punct de lucru</a>
			</div>
		</div>
	</div>

	<!-- ****************************************************************************************-->
	<!-- *****************************DATE BANCARE************************************-->
	<!-- ****************************************************************************************-->
	<div class="row no-margin">
		<div class="col-sm-12">
			<h3 class="tab-title"><i>Date bancare</i></h3>
		</div>
	</div>
	<div class="row no-margin">
		<!-- CONT BANCAR -->
		<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_bank_account">Cont bancar: </label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="kik_company_bank_account" placeholder="ROxx xxxx xxxx xxxx xxxx xxxx" name="kik_company_bank_account" value="<?php echo esc_html($kik_company_bank_account); ?>"  />
			</div>
		</div>
		
		<!-- BANCA -->
		<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_bank_name">Banca: </label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="kik_company_bank_name" placeholder="Nume bancă" name="kik_company_bank_name" value="<?php echo esc_html($kik_company_bank_name); ?>" />
			</div>
		</div>
		
		<!-- REPREZENTANT LEGAL -->
		<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_legal_rep">Reprezentant legal: </label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="kik_company_legal_rep" placeholder="Nume reprezentant legal" name="kik_company_legal_rep" value="<?php echo esc_html($kik_company_legal_rep); ?>" />
			</div>
		</div>
	</div>
		
	<!-- ****************************************************************************************-->
	<!-- *****************************DATE CONTACT***************************************-->
	<!-- ****************************************************************************************-->
	<div class="row no-margin">
		<div class="col-sm-12">
			<h3 class="tab-title"><i>Date contact</i></h3>
		</div>
	</div>	
	
	<!-- PERSOANA DE CONTACT -->
	<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_contact_person_name">Persoană de contact: </label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="kik_company_contact_person_name" placeholder="Nume persoană contact" name="kik_company_contact_person_name" value="<?php echo esc_html($kik_company_contact_person_name); ?>" />
			</div>
		</div>
	
	<!-- TELEFON PERSOANA CONTACT -->
	<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_contact_person_phone">Număr de telefon: </label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="kik_company_contact_person_phone" placeholder="Număr de telefon" name="kik_company_contact_person_phone" value="<?php echo esc_html($kik_company_contact_person_phone); ?>" />
			</div>
		</div>
	
	<!-- ADRESA DE EMAIL -->
	<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_contact_person_email">Adresă de e-mail: </label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="kik_company_contact_person_email" placeholder="E-mail" name="kik_company_contact_person_email" value="<?php echo esc_html($kik_company_contact_person_email); ?>" />
			</div>
	</div>
	
	
	<!-- ****************************************************************************************-->
	<!-- *****************************DATE CONTRACTUALE*******************************-->
	<!-- ****************************************************************************************-->
	<div class="row no-margin">
		<div class="col-sm-12">
			<h3 class="tab-title"><i>Date contractuale</i></h3>
		</div>
	</div>	
	
	<!-- CONTRACT NUMBER -->
	<div class="form-group">
		<label class="control-label col-sm-2" for="kik_company_contract_number">Număr contract: </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="kik_company_contract_number" placeholder="Numărul contractului" name="kik_company_contract_number" value="<?php echo esc_html($kik_company_contract_number); ?>" />
		</div>
	</div>
	
	<!-- CONTRACT DATE -->
	<div class="form-group">
		<label class="control-label col-sm-2" for="kik_company_contract_date">Data încheierii contractului: </label>
		<div class="col-sm-10">
			<input type="text" 
				class="form-control datepicker-contract-date" 
				id="kik_company_contract_date" 
				placeholder="Data încheierii contractului" 
				name="kik_company_contract_date" 
				value="<?php echo esc_html($kik_company_contract_date); ?>" />
		</div>
	</div>
	
	<!-- CONTRACT TYPE -->
	<div class="form-group">
		<label class="control-label col-sm-2" for="kik_company_contract_type">Tip contract: </label>
		<div class="col-sm-10"><?php
			$kik_walker = new KIK_WALKER();
			wp_dropdown_categories(array(
				'walker'        => $kik_walker,
				'orderby'       => 'NAME', 
				'hide_empty'    => 0, 
				'selected'      => empty($kik_company_contract_type) ? '' : $kik_company_contract_type->term_id,
				'hierarchical'  => 1, 
				'name'          => 'kik_company_contract_type',
				'id'            => 'kik_company_contract_type',
				'class'         => 'form-control',
				'taxonomy'      => 'kik_tip_contract',
				'style'			=> '')
			); ?>
		</div>
	</div>
	
	<!-- VALABILITATE CONTRACT -->
	<div class="form-group">
		<label class="control-label col-sm-2" for="kik_company_contract_validity">Valabilitate contract: </label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="kik_company_contract_validity" name="kik_company_contract_validity" value="<?php echo esc_html($kik_company_contract_validity); ?>" />
		</div>
		<div class="col-sm-5">
			<select class="form-control" id="kik_company_contract_validity_type" name="kik_company_contract_validity_type">
				<option value="zile"<?php echo (($kik_company_contract_validity_type) == 'zile' ? ' selected="selected"' : '');?>>zile</option>
				<option value="luni"<?php echo (($kik_company_contract_validity_type) == 'luni' ? ' selected="selected"' : '');?>>luni</option>
				<option value="ani"<?php echo (($kik_company_contract_validity_type) == 'ani' ? ' selected="selected"' : '');?>>ani</option>
			</select>
		</div>
	</div>
	
	<!-- PERIODICITATE INSTRUCTAJ -->
	<?php 
	if($kik_instructaj){
		$i = 0;
		foreach($kik_instructaj as $training_type_id => $periodicitate_instructaj_id){ ?>
			<div class="form-group data-instructaj">
				<label class="control-label col-sm-2" for="kik_company_service_frequency">
					<?php echo $i == 0 ? 'Instructaj:' : ''; ?>
				</label>
				<!--id="kik_company_title"-->
				<div class="col-sm-5"><?php
					$kik_walker = new KIK_WALKER();
					wp_dropdown_categories(array(
						'walker'             => $kik_walker,
						'orderby'            => 'NAME', 
						'hide_empty'         => 0, 
						'selected'           => $training_type_id,
						'hierarchical'       => 1, 
						'name'               => 'kik_company_training_type[]',
						'id'                 => '',
						'class'              => 'form-control kik_company_training_type',
						'taxonomy'           => 'kik_tipuri_instructaj',
						'style'				=> '',
						'value_field'	=>'term_id')
					);?>
				</div>
				<div class="col-sm-5"><?php
					$kik_walker = new KIK_WALKER();
					wp_dropdown_categories(array(
						'walker'             => $kik_walker,
						'orderby'            => 'NAME', 
						'hide_empty'      => 0, 
						'selected'          => '',//DE FACUT FOREACH DACA SUNT MAI MULTE VARIANTE $kik_company_service_frequency->term_id,
						'hierarchical'      => 1, 
						'name'              => 'kik_company_service_frequency[]',
						'id'                   => $periodicitate_instructaj_id,
						'class'              => 'form-control kik_company_service_frequency',
						'taxonomy'        => 'kik_periodicitate_instructaj',
						'style'				=> '',
						'value_field'  => 'term_id')
					);
					
					if($i>0){?>
						<button id="b1" class="btn btn-danger remove-instructaj" type="button">-</button><?php
					} 
					$i++;
					?>
					
				</div>
			</div> <?php
		}
	} else { ?>
		<div class="form-group data-instructaj">
			<label class="control-label col-sm-2" for="kik_company_service_frequency">Instructaj: </label>
			<!--id="kik_company_title"-->
			<div class="col-sm-5"><?php
				$kik_walker = new KIK_WALKER();
				wp_dropdown_categories(array(
					'walker'             => $kik_walker,
					'orderby'            => 'NAME', 
					'hide_empty'         => 0, 
					'selected'           => '',
					'hierarchical'       => 1, 
					'name'               => 'kik_company_training_type[]',
					'id'                 => '',
					'class'              => 'form-control kik_company_training_type',
					'taxonomy'           => 'kik_tipuri_instructaj',
					'style'				=> '',
					'value_field'	=>'term_id')
				);?>
			</div>
			<div class="col-sm-5"><?php
				$kik_walker = new KIK_WALKER();
				wp_dropdown_categories(array(
					'walker'             => $kik_walker,
					'orderby'            => 'NAME', 
					'hide_empty'      => 0, 
					'selected'          => '',//DE FACUT FOREACH DACA SUNT MAI MULTE VARIANTE $kik_company_service_frequency->term_id,
					'hierarchical'      => 1, 
					'name'              => 'kik_company_service_frequency[]',
					'id'                   => '',
					'class'              => 'form-control kik_company_service_frequency',
					'taxonomy'        => 'kik_periodicitate_instructaj',
					'style'				=> '',
					'value_field'  => 'term_id')
				); ?>
			</div>	
		</div><?php
	} ?>
		
	<div class="form-group">
		<div class="col-sm-2"></div>
		<div class="col-sm-10">
			<a class="btn btn-primary" id='add-repeating-training'>Adaugă instructaj</a>
		</div>
	</div>
	
	<!-- ============================ -->
	
	<!-- NO. EMPLOYEES -->
	<div class="form-group">
		<label class="control-label col-sm-2" for="kik_company_employees">Numărul de salariați: </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Numărul de salariați" id="kik_company_employees" name="kik_company_employees" value="<?php echo esc_html($kik_company_employees); ?>" />
		</div>
	</div>
	
	<!-- BILLING FREQUENCY -->
	<div class="form-group">
		<label class="control-label col-sm-2" for="kik_company_contract_date">Perioada de facturare: </label>
		<div class="col-sm-10"><?php
			$kik_walker = new KIK_WALKER();
			wp_dropdown_categories(array(
				'walker'        => $kik_walker,
				'orderby'       => 'NAME', 
				'hide_empty'  	=> 0, 
				'selected'      => empty($kik_company_billing_frequency) ? '' : $kik_company_billing_frequency->term_id,
				'hierarchical'  => 1, 
				'name'          => 'kik_company_billing_frequency',
				'id'            => 'kik_company_billing_frequency',
				'class'         => 'form-control',
				'taxonomy'      => 'kik_perioada_de_facturare',
				'style'			=> '')
			);?>
		</div>
	</div>
	
	<!-- BILLING DEADLINE -->
	
	<div class="form-group">
		<label class="control-label col-sm-2" for="kik_company_billing_deadline">Termen de plată (zile): </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="kik_company_billing_deadline" 
				name="kik_company_billing_deadline" 
				value="<?php echo esc_html($kik_company_billing_deadline); ?>" />
		</div>
	</div>
	
	
	<!-- ****************************************************************************************-->
	<!-- *****************************STATUS COMPANIE**********************************-->
	<!-- ****************************************************************************************-->
	
	<?php
	$current_user_id = wp_get_current_user()->ID;
	$current_user_roles = get_user_meta($current_user_id, 'kik_user_roles', true);
	if (($current_user_id == 1) || (is_array($current_user_roles) && in_array('Administrator', $current_user_roles))) { ?>
		<div class="row no-margin">
			<div class="col-sm-12">
				<h3 class="tab-title"><i>Status companie</i></h3>
			</div>
		</div>
		<!-- INSPECTOR SSM -->
		<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_inspector">Inspector SSM: </label>
			<div class="col-sm-10">
				<?php echo KIK_DROPDOWN_USERS(
				'kik_company_inspector', 
				'kik_company_inspector', 
				'kik_ssm', 
				$kik_company_inspector, true, 'form-control'); ?>
			</div>
		</div>
		
		<!-- AGENT VANZARI -->
		<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_sales_agent">Agent de vânzări: </label>
			<div class="col-sm-10">
				<?php echo KIK_DROPDOWN_USERS(
					'kik_company_sales_agent', 
					'kik_company_sales_agent', 
					'kik_inspector_ssm', 
					$kik_company_sales_agent, 
					true, 'form-control'); ?>
			</div>
		</div><?php 
	} ?>
	
	<!-- STATUS -->
	
	<div class="form-group">
			<label class="control-label col-sm-2" for="kik_company_status">Status: </label>
			<div class="col-sm-10"><?php
				$kik_walker = new KIK_WALKER();
				wp_dropdown_categories(array(
					'walker'             => $kik_walker,
					'orderby'            => 'NAME', 
					'hide_empty'         => 0, 
					'selected'           => empty($kik_company_status) ? '' : $kik_company_status->term_id,
					'hierarchical'       => 1,
					'name'               => 'kik_company_status',
					'id'                 => 'kik_company_status',
					'class'              => 'form-control',
					'taxonomy'           => 'kik_status',
					'style'				 => '')
				);?>
			</div>
	</div>	