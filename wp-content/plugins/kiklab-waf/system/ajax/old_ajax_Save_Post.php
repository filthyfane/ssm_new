<?php


#####------------------------------------
##### FRONT END: SAVE POST
#####------------------------------------


##### Save custom post
add_action('wp_ajax_KIK_ACTION_Save_Post', 'KIK_ACTION_Save_Post_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_Post', 'KIK_ACTION_Save_Post_FUNC');
function KIK_ACTION_Save_Post_FUNC() {

	global $wpdb;
	
	//echo DrawObject($_POST);
	
	if (isset($_POST['kik_action']) && $_POST['kik_action'] == 'edit') {
		$kik_ID = $_POST['ID'];
		echo "update";
	}
	else {
		$post = array(
			'post_status'    => 'publish',
			'post_type'      => 'kik_company',
		);
		$kik_ID = wp_insert_post($post);
		echo $kik_ID;  # return the ID in the ajax response!!!
	}
		
	### Date societate
	if (1==1) {
		# TITLE
		if (isset($_POST['kik_company_title'])) wp_update_post(array('ID' => $kik_ID, 'post_title' => $_POST['kik_company_title']));
		# CIF
		if (isset($_POST['kik_company_cif'])) update_post_meta($kik_ID, 'kik_company_cif', $_POST['kik_company_cif']);
		# REG
		if (isset($_POST['kik_company_reg'])) update_post_meta($kik_ID, 'kik_company_reg', $_POST['kik_company_reg']);
		# ADDRESS
		if (isset($_POST['kik_company_address'])) update_post_meta($kik_ID, 'kik_company_address', $_POST['kik_company_address']);
		# WORKPOINTS
		if (isset($_POST['kik_workpoints'])) {
			update_post_meta($kik_ID, 'kik_company_workpoints', $_POST['kik_workpoints']);
		} else {
			delete_post_meta($kik_ID, 'kik_company_workpoints');
		}
		
		#INSTRUCTAJE
		$kik_instructaj = array_combine($_POST['kik_company_training_type'], $_POST['kik_company_service_frequency']);
		update_post_meta($kik_ID, 'kik_instructaj', $kik_instructaj);
		
		
		
		# BANK ACCOUNT
		if (isset($_POST['kik_company_bank_account'])) update_post_meta($kik_ID, 'kik_company_bank_account', $_POST['kik_company_bank_account']);
		# BANK NAME
		if (isset($_POST['kik_company_bank_name'])) update_post_meta($kik_ID, 'kik_company_bank_name', $_POST['kik_company_bank_name']);
		# LEGAL REP
		if (isset($_POST['kik_company_legal_rep'])) update_post_meta($kik_ID, 'kik_company_legal_rep', $_POST['kik_company_legal_rep']);
		# CONTACT PERSON NAME
		if (isset($_POST['kik_company_contact_person_name'])) update_post_meta($kik_ID, 'kik_company_contact_person_name', $_POST['kik_company_contact_person_name']);
		# CONTACT PERSON PHONE
		if (isset($_POST['kik_company_contact_person_phone'])) update_post_meta($kik_ID, 'kik_company_contact_person_phone', $_POST['kik_company_contact_person_phone']);
		# CONTACT PERSON EMAIL
		if (isset($_POST['kik_company_contact_person_email'])) update_post_meta($kik_ID, 'kik_company_contact_person_email', $_POST['kik_company_contact_person_email']);
		# CAEN
		if (isset($_POST['kik_company_caen'])) {
			if ($_POST['kik_company_caen'] == -1) wp_set_object_terms($kik_ID, NULL, 'kik_cod_caen', false);
			else wp_set_object_terms($kik_ID, $_POST['kik_company_caen'], 'kik_cod_caen', false);
		}
		# CONTRACT NUMBER
		if (isset($_POST['kik_company_contract_number'])) update_post_meta($kik_ID, 'kik_company_contract_number', $_POST['kik_company_contract_number']);
		# CONTRACT DATE
		if (isset($_POST['kik_company_contract_date'])) {
			$oContractDate = DateTime::createFromFormat('d/m/Y', $_POST['kik_company_contract_date']);
			update_post_meta($kik_ID, 'kik_company_contract_date', $oContractDate->format('Y/m/d'));
		}
		# CONTRACT TYPE
		if (isset($_POST['kik_company_contract_type'])) wp_set_object_terms($kik_ID, $_POST['kik_company_contract_type'], 'kik_tip_contract', false);
		# CONTRACT VALIDITY
		if (isset($_POST['kik_company_contract_validity'])) update_post_meta($kik_ID, 'kik_company_contract_validity', $_POST['kik_company_contract_validity']);
		# CONTRACT VALIDITY TYPE
		if (isset($_POST['kik_company_contract_validity_type'])) update_post_meta($kik_ID, 'kik_company_contract_validity_type', $_POST['kik_company_contract_validity_type']);
		# SERVICE FREQUENCY
		//if (isset($_POST['kik_company_service_frequency'])) wp_set_object_terms($kik_ID, $_POST['kik_company_service_frequency'], 'kik_periodicitate_instructaj', false);
		# EMPLYEES
		if (isset($_POST['kik_company_employees'])) update_post_meta($kik_ID, 'kik_company_employees', $_POST['kik_company_employees']);
		# BILLING FREQUENCY
		if (isset($_POST['kik_company_billing_frequency'])) wp_set_object_terms($kik_ID, $_POST['kik_company_billing_frequency'], 'kik_perioada_de_facturare', false);
		# BILLING DEADLINE
		if (isset($_POST['kik_company_billing_deadline'])) update_post_meta($kik_ID, 'kik_company_billing_deadline', $_POST['kik_company_billing_deadline']);
		# BILLING DEADLINE TYPE
		if (isset($_POST['kik_company_billing_deadline_type'])) update_post_meta($kik_ID, 'kik_company_billing_deadline_type', $_POST['kik_company_billing_deadline_type']);
		# INSPECTOR
		if (isset($_POST['kik_company_inspector'])) update_post_meta($kik_ID, 'kik_company_inspector', $_POST['kik_company_inspector']);
		# SALES AGENT
		if (isset($_POST['kik_company_sales_agent'])) update_post_meta($kik_ID, 'kik_company_sales_agent', $_POST['kik_company_sales_agent']);
		# STATUS
		if (isset($_POST['kik_company_status'])) wp_set_object_terms($kik_ID, $_POST['kik_company_status'], 'kik_status', false);
	}
	 
	### Facturare
	if (1==1) {
		# ISTORIC FACTURI
		if (isset($_POST['kik_company_billing_history'])) {
			foreach ($_POST['kik_company_billing_history'] as &$obj) {
				if ($obj['bill_date'] == 'Data factura') $obj['bill_date'] = '';
				if ($obj['bill_nr'] == 'Nr. factura') $obj['bill_nr'] = '';
				if ($obj['bill_val'] == 'Valoare') $obj['bill_val'] = '';
			}
			update_post_meta($kik_ID, 'kik_company_billing_history', $_POST['kik_company_billing_history']);
		}
		else delete_post_meta($kik_ID, 'kik_company_billing_history');
	}
	
	### Periodicitate instructaj
	if (1==1) {
		# ISTORIC INSTRUCTAJ
		if (isset($_POST['kik_company_service_frequency_history'])) update_post_meta($kik_ID, 'kik_company_service_frequency_history', $_POST['kik_company_service_frequency_history']);
		else delete_post_meta($kik_ID, 'kik_company_service_frequency_history');
	}
	
	### Sedinte CSSM
	if (1==1) {
		# CSSM
		if (isset($_POST['kik_company_cssm'])) {
			foreach ($_POST['kik_company_cssm'] as &$obj) {
				if ($obj['cssm_data'] == 'Data sedintei CSSM') $obj['cssm_data'] = '';
			}
			update_post_meta($kik_ID, 'kik_company_cssm', $_POST['kik_company_cssm']);
		}
		else delete_post_meta($kik_ID, 'kik_company_cssm');
	}
	
	### Documente predate
	/* if (1==1) {
		$kik_documente_predate = array();
		# DOCUMENTE PREDATE
		$docs = get_terms('kik_documente_predate', array('hide_empty' => 0));
		foreach($docs as $doc){
			if (isset($_POST['kik_company_documente_predate_' . $doc->slug])) $kik_documente_predate[] = $doc->slug;
		}
		wp_set_object_terms($kik_ID, $kik_documente_predate, 'kik_documente_predate', false);
	} */
	
	### Echipamente
	/* if (1==1) {
		# ECHIPAMENTE
		if (isset($_POST['kik_company_echipamente'])) {
			foreach ($_POST['kik_company_echipamente'] as &$obj) {
				if ($obj['exp'] == 'Data expirarii') $obj['exp'] = '';
				if ($obj['iscir'] == 'Data expirarii ISCIR') $obj['iscir_bool'] = '';
				if (!$obj['iscir_bool'] || $obj['iscir'] == 'Data expirarii ISCIR') $obj['iscir'] = '';
			}
			update_post_meta($kik_ID, 'kik_company_echipamente', $_POST['kik_company_echipamente']);
		}
		else delete_post_meta($kik_ID, 'kik_company_echipamente');
	} */
	
	### Angajati
	if (1==1) {
		# ANGAJATI
		if (isset($_POST['kik_company_angajati'])) {
			foreach ($_POST['kik_company_angajati'] as &$obj) {
				if ($obj['nume'] == 'Nume') $obj['nume'] = '';
				if ($obj['prenume'] == 'Prenume') $obj['prenume'] = '';
				if ($obj['functie'] == 'Functie') $obj['functie'] = '';
				if ($obj['cnp'] == 'CNP') $obj['cnp'] = '';
				if ($obj['adresa'] == 'Adresa') $obj['adresa'] = '';
				if ($obj['contract_start'] == 'Data incepere contract') $obj['contract_start'] = '';
				if ($obj['contract_end'] == 'Data incetare contract') $obj['contract_end'] = '';
				if ($obj['boss_phone'] == 'Telefon' && $obj['boss_email'] == 'Email') $obj['boss_bool'] = '';
				if (!$obj['boss_bool'] || $obj['boss_phone'] == 'Telefon') $obj['boss_phone'] = '';
				if (!$obj['boss_bool'] || $obj['boss_email'] == 'Email') $obj['boss_email'] = '';
				if ($obj['auth_type'] == 'Tip autorizatie' && $obj['auth_exp'] == 'Data expirarii autorizatiei') $obj['auth_bool'] = '';
				if (!$obj['auth_bool'] || $obj['auth_type'] == 'Tip autorizatie') $obj['auth_type'] = '';
				if (!$obj['auth_bool'] || $obj['auth_exp'] == 'Data expirarii autorizatiei') $obj['auth_exp'] = '';
			}
			update_post_meta($kik_ID, 'kik_company_angajati', $_POST['kik_company_angajati']);
		}
		else delete_post_meta($kik_ID, 'kik_company_angajati');
	}
	
	### Dosar cercetare accidente
	if (1==1) {
		# ACCIDENTE
		if (isset($_POST['kik_company_accidente'])) {
			foreach ($_POST['kik_company_accidente'] as &$obj) {
				if ($obj['cercetare'] == 'Data cercetarii') $obj['cercetare'] = '';
				if ($obj['producere'] == 'Data producerii') $obj['producere'] = '';
				if ($obj['angajat'] == 'Numele angajatului implicat') $obj['angajat'] = '';
				if ($obj['descriere'] == 'Scurta descriere a cauzelor accidentului') $obj['descriere'] = '';
				if ($obj['tip'] == 'Tipul evenimentului') $obj['tip'] = '';
			}
			update_post_meta($kik_ID, 'kik_company_accidente', $_POST['kik_company_accidente']);
		}
		else delete_post_meta($kik_ID, 'kik_company_accidente');
	}
	
	# Generate fields that aren't editable
	wp_update_post(array(
		'ID' => $kik_ID,
		'post_name' => $kik_ID,
	));

	# Recalculate alerts
	KIK_ACTION_Cron();
	
	//echo ' {--DONE--} ';
	
	wp_die();
}





// nefolosite
### Documente predate
	/* if (1==1) {
		$kik_documente_predate = array();
		# DOCUMENTE PREDATE
		$docs = get_terms('kik_documente_predate', array('hide_empty' => 0));
		foreach($docs as $doc){
			if (isset($_POST['kik_company_documente_predate_' . $doc->slug])) $kik_documente_predate[] = $doc->slug;
		}
		wp_set_object_terms($kik_ID, $kik_documente_predate, 'kik_documente_predate', false);
	} */
	
	### Echipamente
	/* if (1==1) {
		# ECHIPAMENTE
		if (isset($_POST['kik_company_echipamente'])) {
			foreach ($_POST['kik_company_echipamente'] as &$obj) {
				if ($obj['exp'] == 'Data expirarii') $obj['exp'] = '';
				if ($obj['iscir'] == 'Data expirarii ISCIR') $obj['iscir_bool'] = '';
				if (!$obj['iscir_bool'] || $obj['iscir'] == 'Data expirarii ISCIR') $obj['iscir'] = '';
			}
			update_post_meta($kik_ID, 'kik_company_echipamente', $_POST['kik_company_echipamente']);
		}
		else delete_post_meta($kik_ID, 'kik_company_echipamente');
	} */




/**/

### Periodicitate instructaj
	if (1==1) {
		# ISTORIC INSTRUCTAJ
		if (isset($_POST['kik_company_service_frequency_history'])) update_post_meta($kik_ID, 'kik_company_service_frequency_history', $_POST['kik_company_service_frequency_history']);
		else delete_post_meta($kik_ID, 'kik_company_service_frequency_history');
	}
	
	### Sedinte CSSM
	if (1==1) {
		# CSSM
		if (isset($_POST['kik_company_cssm'])) {
			foreach ($_POST['kik_company_cssm'] as &$obj) {
				if ($obj['cssm_data'] == 'Data sedintei CSSM') $obj['cssm_data'] = '';
			}
			update_post_meta($kik_ID, 'kik_company_cssm', $_POST['kik_company_cssm']);
		}
		else delete_post_meta($kik_ID, 'kik_company_cssm');
	}
	
	
	
	### Angajati
	if (1==1) {
		# ANGAJATI
		if (isset($_POST['kik_company_angajati'])) {
			foreach ($_POST['kik_company_angajati'] as &$obj) {
				if ($obj['nume'] == 'Nume') $obj['nume'] = '';
				if ($obj['prenume'] == 'Prenume') $obj['prenume'] = '';
				if ($obj['functie'] == 'Functie') $obj['functie'] = '';
				if ($obj['cnp'] == 'CNP') $obj['cnp'] = '';
				if ($obj['adresa'] == 'Adresa') $obj['adresa'] = '';
				if ($obj['contract_start'] == 'Data incepere contract') $obj['contract_start'] = '';
				if ($obj['contract_end'] == 'Data incetare contract') $obj['contract_end'] = '';
				if ($obj['boss_phone'] == 'Telefon' && $obj['boss_email'] == 'Email') $obj['boss_bool'] = '';
				if (!$obj['boss_bool'] || $obj['boss_phone'] == 'Telefon') $obj['boss_phone'] = '';
				if (!$obj['boss_bool'] || $obj['boss_email'] == 'Email') $obj['boss_email'] = '';
				if ($obj['auth_type'] == 'Tip autorizatie' && $obj['auth_exp'] == 'Data expirarii autorizatiei') $obj['auth_bool'] = '';
				if (!$obj['auth_bool'] || $obj['auth_type'] == 'Tip autorizatie') $obj['auth_type'] = '';
				if (!$obj['auth_bool'] || $obj['auth_exp'] == 'Data expirarii autorizatiei') $obj['auth_exp'] = '';
			}
			update_post_meta($kik_ID, 'kik_company_angajati', $_POST['kik_company_angajati']);
		}
		else delete_post_meta($kik_ID, 'kik_company_angajati');
	}
	
	### Dosar cercetare accidente
	if (1==1) {
		# ACCIDENTE
		if (isset($_POST['kik_company_accidente'])) {
			foreach ($_POST['kik_company_accidente'] as &$obj) {
				if ($obj['cercetare'] == 'Data cercetarii') $obj['cercetare'] = '';
				if ($obj['producere'] == 'Data producerii') $obj['producere'] = '';
				if ($obj['angajat'] == 'Numele angajatului implicat') $obj['angajat'] = '';
				if ($obj['descriere'] == 'Scurta descriere a cauzelor accidentului') $obj['descriere'] = '';
				if ($obj['tip'] == 'Tipul evenimentului') $obj['tip'] = '';
			}
			update_post_meta($kik_ID, 'kik_company_accidente', $_POST['kik_company_accidente']);
		}
		else delete_post_meta($kik_ID, 'kik_company_accidente');
	}
	
	 
	### Facturare
	if (1==1) {
		# ISTORIC FACTURI
		if (isset($_POST['kik_company_billing_history'])) {
			foreach ($_POST['kik_company_billing_history'] as &$obj) {
				if ($obj['bill_date'] == 'Data factura') $obj['bill_date'] = '';
				if ($obj['bill_nr'] == 'Nr. factura') $obj['bill_nr'] = '';
				if ($obj['bill_val'] == 'Valoare') $obj['bill_val'] = '';
			}
			update_post_meta($kik_ID, 'kik_company_billing_history', $_POST['kik_company_billing_history']);
		}
		else delete_post_meta($kik_ID, 'kik_company_billing_history');
	}
	
	// din post_edit_date_societate.php
	
	<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		
		<?php
			/* $i = 0;
			//echo DrawObject($kik_company_workpoints);
			if ($kik_company_workpoints) {
				foreach ($kik_company_workpoints as $kik_company_workpoint) {
					$i++; ?>
						<tr>
							<td><label for="kik_company_workpoint_<?php echo $i; ?>">Punct de lucru</label></td>
							<td>
								<input 	type="text" 
										class="size_xl" 
										id="kik_company_workpoint_<?php echo $i; ?>" 
										name="kik_company_workpoints[<?php echo $i; ?>][address]" 
										value="<?php echo $kik_company_workpoint[address] ? esc_html($kik_company_workpoint[address]) : 'Punct de lucru" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Punct de lucru" /> <a class="kik_company_workpoint_delete" href="javascript:;">Sterge</a>
							</td>
						</tr> <?php
				} ?>
					<tr id="kik_company_workpoints_add_tr" data-workpoints="<?php echo $i; ?>">
						<td>
						</td>
						<!-- <td>
							<a id="kik_company_workpoints_add_a" href="javascript:;">Adauga punct de lucru</a>
						</td> -->
					</tr>
					<div class="form-group">
						<label class="control-label col-sm-2" for=""></label>
						<!--id="kik_company_title"-->
						<div class="col-sm-10">
							
						</div>
					</div> <?php
			} */ ?>

?>