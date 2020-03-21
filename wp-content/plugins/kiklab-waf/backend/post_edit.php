<?php


#####------------------------------------
##### ADMIN PAGE: EDIT COMPANIE
#####------------------------------------


##### Hide some metaboxes
add_action('admin_menu', function($post_id) {
	remove_meta_box('tagsdiv-kik_tip_contract', 'kik_company', 'side');
	remove_meta_box('tagsdiv-kik_periodicitate_instructaj', 'kik_company', 'side');
	remove_meta_box('tagsdiv-kik_perioada_de_facturare', 'kik_company', 'side');
	remove_meta_box('tagsdiv-kik_cod_caen', 'kik_company', 'side');
	remove_meta_box('tagsdiv-kik_documente_predate', 'kik_company', 'side');
	remove_meta_box('tagsdiv-kik_echipamente', 'kik_company', 'side');
	remove_meta_box('tagsdiv-kik_norme_lucru', 'kik_company', 'side');
	remove_meta_box('tagsdiv-kik_ani_instructaj', 'kik_company', 'side');
});



#####==================================================
##### BACKEND ADMIN - KIK_COMPANY POST TYPE META BOXES
#####==================================================

add_action('add_meta_boxes', 'kik_admin_post_type_company');
function kik_admin_post_type_company() {
	# COMPANY
	add_meta_box('meta_box_company', 'Company Details', 'kik_display_meta_box_company', 'kik_company', 'normal', 'high');
}
# COMPANY
function kik_display_meta_box_company($post) {
	# Add 'nonce' field for security purposes
	wp_nonce_field('kik_display_meta_box_company', 'display_meta_box_company_nonce');
	# Retrieve post meta based on ID
	if (1==1) {  # Date societate
		$kik_company_cif = get_post_meta($post->ID, 'kik_company_cif', true);
		$kik_company_reg = get_post_meta($post->ID, 'kik_company_reg', true);
		$kik_company_address = get_post_meta($post->ID, 'kik_company_address', true);
		$kik_company_workpoints = get_post_meta($post->ID, 'kik_company_workpoints', true);
		$kik_company_bank_account = get_post_meta($post->ID, 'kik_company_bank_account', true);
		$kik_company_bank_name = get_post_meta($post->ID, 'kik_company_bank_name', true);
		$kik_company_legal_rep = get_post_meta($post->ID, 'kik_company_legal_rep', true);
		$kik_company_contact_person_name = get_post_meta($post->ID, 'kik_company_contact_person_name', true);
		$kik_company_contact_person_phone = get_post_meta($post->ID, 'kik_company_contact_person_phone', true);
		$kik_company_contact_person_email = get_post_meta($post->ID, 'kik_company_contact_person_email', true);
		$kik_company_caen = ($try = wp_get_object_terms($post->ID, 'kik_cod_caen') ? $try[0] : 0);
		$kik_company_contract_number = get_post_meta($post->ID, 'kik_company_contract_number', true);
		
		$contractDate = get_post_meta($post->ID, 'kik_company_contract_date', true);
		if($contractDate){
			$oContractDate = DateTime::createFromFormat('Y/m/d', $contractDate);
			$kik_company_contract_date = $oContractDate->format('d/m/Y');
		} 
		$kik_company_contract_type = ($try = wp_get_object_terms($post->ID, 'kik_tip_contract') ? $try[0] : 0);
		$kik_company_contract_validity = get_post_meta($post->ID, 'kik_company_contract_validity', true);
		$kik_company_contract_validity_type = get_post_meta($post->ID, 'kik_company_contract_validity_type', true);
		$kik_company_service_frequency = ($try = wp_get_object_terms($post->ID, 'kik_periodicitate_instructaj') ? $try[0] : 0);
		$kik_company_employees = get_post_meta($post->ID, 'kik_company_employees', true);
		$kik_company_billing_frequency = ($try = wp_get_object_terms($post->ID, 'kik_perioada_de_facturare') ? $try[0] : 0);
		$kik_company_billing_deadline = get_post_meta($post->ID, 'kik_company_billing_deadline', true);
		$kik_company_billing_deadline_type = get_post_meta($post->ID, 'kik_company_billing_deadline_type', true);
		$kik_company_inspector = get_post_meta($post->ID, 'kik_company_inspector', true);
		$kik_company_sales_agent = get_post_meta($post->ID, 'kik_company_sales_agent', true);
		$kik_company_status = ($try = wp_get_object_terms($post->ID, 'kik_status') ? $try[0] : 0);
	}
	if (1==1) {  # Facturare
		$kik_company_billing_history = get_post_meta($post->ID, 'kik_company_billing_history', false);
	}
	if (1==1) {  # Periodicitate instructaj
		$kik_company_service_frequency_history = get_post_meta($post->ID, 'kik_company_service_frequency_history', false);
	}
	if (1==1) {  # CSSM
		$kik_company_cssm = get_post_meta($post->ID, 'kik_company_cssm', false);
	}
	if (1==1) {  # Documente predate
		$kik_company_documente_predate = get_terms('kik_documente_predate', array('hide_empty' => 0));
	}
	if (1==1) {  # Echipamente
		$kik_company_echipamente = get_post_meta($post->ID, 'kik_company_echipamente', false);
	}
	if (1==1) {  # Angajati
		$kik_company_angajati = get_post_meta($post->ID, 'kik_company_angajati', false);
	}
	if (1==1) {  # Dosar cercetare accidente
		$kik_company_accidente = get_post_meta($post->ID, 'kik_company_accidente', false);
	}
	# Generate html
	?>	
	<div class="kik_company_tab_titles">
		<a class="kik_company_tab_title_active add-new-h2" href="#">Date societate</a>
		<a class="kik_company_tab_title add-new-h2" href="#">Facturare (<?php echo count($kik_company_billing_history[0]); ?>)</a>
		<a class="kik_company_tab_title add-new-h2" href="#">Instructaje</a>
		<a class="kik_company_tab_title add-new-h2" href="#">CSSM (<?php echo count($kik_company_cssm[0]); ?>)</a>
		<a class="kik_company_tab_title add-new-h2" href="#">Documente predate (<?php echo count(wp_get_post_terms($post->ID, 'kik_documente_predate')); ?>)</a>
		<a class="kik_company_tab_title add-new-h2" href="#">Echipamente (<?php echo count($kik_company_echipamente[0]); ?>)</a>
		<a class="kik_company_tab_title add-new-h2" href="#">Angajați (<span class="count-posts"><?php echo count($kik_company_angajati[0]); ?></span>)</a>
		<a class="kik_company_tab_title add-new-h2" href="#">Dosar cercetare accident (<?php echo count($kik_company_accidente[0]); ?>)</a>
		<a class="kik_company_tab_title add-new-h2" href="#">Rapoarte</a>
	</div>
	<div class="kik_company_tabs">
		<!-- Date societate -->
		<div class="kik_company_tab" style="display:block;">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_date_societate.php'); ?>
		</div>
		<!-- Facturare -->
		<div class="kik_company_tab">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_facturare.php'); ?>
		</div>
		<!-- Periodicitate instructaj -->
		<div class="kik_company_tab">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_periodicitate_instructaj.php'); ?>
		</div>
		<!-- CSSM -->
		<div class="kik_company_tab">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_cssm.php'); ?>
		</div>
		<!-- Documente predate -->
		<div class="kik_company_tab">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_documente_predate.php'); ?>
		</div>
		<!-- Echipamente -->
		<div class="kik_company_tab">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_echipamente.php'); ?>
		</div>
		<!-- Angajati -->
		<div class="kik_company_tab">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_angajati.php'); ?>
		</div>
		<!-- Dosar cercetare accident -->
		<div class="kik_company_tab">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_dosar_cercetare_accident.php'); ?>
		</div>
		<!-- Rapoarte -->
		<div class="kik_company_tab">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_rapoarte.php'); ?>
		</div>
	</div>
	<?php

}

##### Save custom post
add_action('save_post', 'kik_save_meta_box_data', 10, 3);
function kik_save_meta_box_data($post_id, $post) {
	
	//echo DrawObject($_POST);
	
	# COMPANY
	if ($post->post_type == 'kik_company') {
		
		### Check if it's safe for us to save the data.
		
		# Check if nonce is set.
		if (!isset($_POST['display_meta_box_company_nonce'])) return;
		# Verify that the nonce is valid.
		if (!wp_verify_nonce($_POST['display_meta_box_company_nonce'], 'kik_display_meta_box_company')) return;
		# If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		# Check the user's permissions.
		if (isset($_POST['post_type']) && $_POST['post_type'] == 'company') { if (!current_user_can('edit_page', $post_id)) return; }
		else { if (!current_user_can('edit_post', $post_id)) return; }
		
		### OK, it's safe for us to save the data now.
		
		### Date societate
		if (1==1) {
			# CIF
			if (isset($_POST['kik_company_cif'])) update_post_meta($post_id, 'kik_company_cif', $_POST['kik_company_cif']);
			# REG
			if (isset($_POST['kik_company_reg'])) update_post_meta($post_id, 'kik_company_reg', $_POST['kik_company_reg']);
			# ADDRESS
			if (isset($_POST['kik_company_address'])) update_post_meta($post_id, 'kik_company_address', $_POST['kik_company_address']);
			# WORKPOINTS
			if (isset($_POST['kik_company_workpoints'])) {
				foreach ($_POST['kik_company_workpoints'] as &$obj) {
					if ($obj['address'] == 'Punct de lucru') $obj['address'] = '';
				}
			}
			else delete_post_meta($post_id, 'kik_company_workpoints');
			update_post_meta($post_id, 'kik_company_workpoints', $_POST['kik_company_workpoints']);
			# BANK ACCOUNT
			if (isset($_POST['kik_company_bank_account'])) update_post_meta($post_id, 'kik_company_bank_account', $_POST['kik_company_bank_account']);
			# BANK NAME
			if (isset($_POST['kik_company_bank_name'])) update_post_meta($post_id, 'kik_company_bank_name', $_POST['kik_company_bank_name']);
			# LEGAL REP
			if (isset($_POST['kik_company_legal_rep'])) update_post_meta($post_id, 'kik_company_legal_rep', $_POST['kik_company_legal_rep']);
			# CONTACT PERSON NAME
			if (isset($_POST['kik_company_contact_person_name'])) update_post_meta($post_id, 'kik_company_contact_person_name', $_POST['kik_company_contact_person_name']);
			# CONTACT PERSON PHONE
			if (isset($_POST['kik_company_contact_person_phone'])) update_post_meta($post_id, 'kik_company_contact_person_phone', $_POST['kik_company_contact_person_phone']);
			# CONTACT PERSON EMAIL
			if (isset($_POST['kik_company_contact_person_email'])) update_post_meta($post_id, 'kik_company_contact_person_email', $_POST['kik_company_contact_person_email']);
			# CAEN
			if (isset($_POST['kik_company_caen'])) {
				if ($_POST['kik_company_caen'] == -1) wp_set_object_terms($post_id, NULL, 'kik_cod_caen', false);
				else wp_set_object_terms($post_id, $_POST['kik_company_caen'], 'kik_cod_caen', false);
			}
			# CONTRACT NUMBER
			if (isset($_POST['kik_company_contract_number'])) update_post_meta($post_id, 'kik_company_contract_number', $_POST['kik_company_contract_number']);
			# CONTRACT DATE
			if (isset($_POST['kik_company_contract_date'])) update_post_meta($post_id, 'kik_company_contract_date', $_POST['kik_company_contract_date']);
			# CONTRACT TYPE
			if (isset($_POST['kik_company_contract_type'])) wp_set_object_terms($post_id, $_POST['kik_company_contract_type'], 'kik_tip_contract', false);
			# CONTRACT VALIDITY
			if (isset($_POST['kik_company_contract_validity'])) update_post_meta($post_id, 'kik_company_contract_validity', $_POST['kik_company_contract_validity']);
			# CONTRACT VALIDITY TYPE
			if (isset($_POST['kik_company_contract_validity_type'])) update_post_meta($post_id, 'kik_company_contract_validity_type', $_POST['kik_company_contract_validity_type']);
			# SERVICE FREQUENCY
			if (isset($_POST['kik_company_service_frequency'])) wp_set_object_terms($post_id, $_POST['kik_company_service_frequency'], 'kik_periodicitate_instructaj', false);
			# EMPLYEES
			if (isset($_POST['kik_company_employees'])) update_post_meta($post_id, 'kik_company_employees', $_POST['kik_company_employees']);
			# BILLING FREQUENCY
			if (isset($_POST['kik_company_billing_frequency'])) wp_set_object_terms($post_id, $_POST['kik_company_billing_frequency'], 'kik_perioada_de_facturare', false);
			# BILLING DEADLINE
			if (isset($_POST['kik_company_billing_deadline'])) update_post_meta($post_id, 'kik_company_billing_deadline', $_POST['kik_company_billing_deadline']);
			# BILLING DEADLINE TYPE
			if (isset($_POST['kik_company_billing_deadline_type'])) update_post_meta($post_id, 'kik_company_billing_deadline_type', $_POST['kik_company_billing_deadline_type']);
			# INSPECTOR
			if (isset($_POST['kik_company_inspector'])) update_post_meta($post_id, 'kik_company_inspector', $_POST['kik_company_inspector']);
			# SALES AGENT
			if (isset($_POST['kik_company_sales_agent'])) update_post_meta($post_id, 'kik_company_sales_agent', $_POST['kik_company_sales_agent']);
			# STATUS
			if (isset($_POST['kik_company_status'])) wp_set_object_terms($post_id, $_POST['kik_company_status'], 'kik_status', false);
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
				update_post_meta($post_id, 'kik_company_billing_history', $_POST['kik_company_billing_history']);
			}
			else delete_post_meta($post_id, 'kik_company_billing_history');
		}
		
		### Periodicitate instructaj
		if (1==1) {
			# ISTORIC INSTRUCTAJ
			if (isset($_POST['kik_company_service_frequency_history'])) update_post_meta($post_id, 'kik_company_service_frequency_history', $_POST['kik_company_service_frequency_history']);
			else delete_post_meta($post_id, 'kik_company_service_frequency_history');
		}
		
		### Sedinte CSSM
		if (1==1) {
			# CSSM
			if (isset($_POST['kik_company_cssm'])) {
				foreach ($_POST['kik_company_cssm'] as &$obj) {
					if ($obj['cssm_data'] == 'Data sedintei CSSM') $obj['cssm_data'] = '';
				}
				update_post_meta($post_id, 'kik_company_cssm', $_POST['kik_company_cssm']);
			}
			else delete_post_meta($post_id, 'kik_company_cssm');
		}
		
		### Documente predate
		if (1==1) {
			# DOCUMENTE PREDATE
			$docs = get_terms('kik_documente_predate', array('hide_empty' => 0));
			foreach($docs as $doc){
				if (isset($_POST['kik_company_documente_predate_' . $doc->slug])) $kik_documente_predate[] = $doc->slug;
			}
			wp_set_object_terms($post_id, $kik_documente_predate, 'kik_documente_predate', false);
		}
		
		### Echipamente
		if (1==1) {
			# ECHIPAMENTE
			if (isset($_POST['kik_company_echipamente'])) {
				foreach ($_POST['kik_company_echipamente'] as &$obj) {
					if ($obj['exp'] == 'Data expirarii') $obj['exp'] = '';
					if ($obj['iscir'] == 'Data expirarii ISCIR') $obj['iscir_bool'] = '';
					if (!$obj['iscir_bool'] || $obj['iscir'] == 'Data expirarii ISCIR') $obj['iscir'] = '';
				}
				update_post_meta($post_id, 'kik_company_echipamente', $_POST['kik_company_echipamente']);
			}
			else delete_post_meta($post_id, 'kik_company_echipamente');
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
				update_post_meta($post_id, 'kik_company_angajati', $_POST['kik_company_angajati']);
			}
			else delete_post_meta($post_id, 'kik_company_angajati');
			if (isset($_POST['kik_company_angajat'][contract_type])) wp_set_object_terms($post_id, $_POST['kik_company_status'], 'kik_status', false);
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
				}
				update_post_meta($post_id, 'kik_company_accidente', $_POST['kik_company_accidente']);
			}
			else delete_post_meta($post_id, 'kik_company_accidente');
		}
		
	}
	
}
# Generate fields that aren't editable
add_filter('wp_insert_post_data', 'modify_post_title', '99', 2);
function modify_post_title($data, $postarr) {
	# COMPANY
	if ($data['post_type'] == 'kik_company') {
		if (trim($postarr['post_title']) == '') $data['post_title'] = '(Fără nume)';
		$data['post_name'] = $postarr['ID'];
	}
	return $data;
}
?>