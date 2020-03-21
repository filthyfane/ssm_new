<?php


##### UPLOAD: Angajati
add_action('wp_ajax_KIK_ACTION_Upload_Angajati', 'KIK_ACTION_Upload_Angajati_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Upload_Angajati', 'KIK_ACTION_Upload_Angajati_FUNC');
function KIK_ACTION_Upload_Angajati_FUNC() {
	
	global $wpdb;
	
	//echo DrawObject($_POST);
	//echo DrawObject($_FILES);
	
	if ($_FILES) {
		
		$sourcePath = $_FILES['file']['tmp_name'];
		//echo $sourcePath . '<br />';
		//echo __DIR__ . $sourcePath . '<br />';
		
		/*
		$targetPath = wp_upload_dir()[basedir] . '/kik_uploads/' . $_FILES['file']['name'];
		echo $targetPath . '<br />';
		
		echo '<br />';
		if ($move = move_uploaded_file($sourcePath, $targetPath)) echo 'Success!';
		else echo 'FAIL!';
		
		echo '<br />move result: ' . DrawObject($move);
		*/
		
		
		if (!$_POST['confirmed']) echo 'Se va importa din "<b>' . $_FILES['file']['name'] . '</b>"<br />';
		else echo 'Se importă din "<b>' . $_FILES['file']['name'] . '</b>"<br />';
		echo '---------------<br />';
		$messages['success'] = 0;
		$messages['warning'] = 0;
		$messages['error'] = 0;
		
		//$file = file_get_contents($sourcePath);
		$file = file($sourcePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		//$lines = explode("\r\n", $file);
		$lines = array_map('str_getcsv', $file);
		$cols_count = 8;  # number of columns expected
		$i = 0;
		if ($lines) foreach ($lines as $cols) {
			//echo '<pre>' . DrawObject($cols) . '</pre>';
			$i++;
			//if ($i == 1) continue;  # skip first row -> column heads
			$cols_count_i = count($cols);
			if ($cols_count_i != $cols_count) {
				if (!$_POST['confirmed']) echo '<span class="kik_error">Linia ' . $i . ': EROARE: Număr invalid de coloane. Se caută ' . $cols_count . ', s-a' . ($cols_count_i != 1 ? 'u' : '') . ' găsit ' . $cols_count_i . '. Linia va fi ignorată.</span><br />';
				else echo '<span class="kik_error">Linia ' . $i . ': EROARE: Număr invalid de coloane. Se caută ' . $cols_count . ', s-a' . ($cols_count_i != 1 ? 'u' : '') . ' găsit ' . $cols_count_i . '. Linia a fost ignorată.</span><br />';
				$messages['error']++;
				continue;
			}
			else {
				
				# prepare input values from line data
				$kik_company_angajati['nume'] = $cols[1];
				$kik_company_angajati['prenume'] = $cols[2];
				$kik_company_angajati['functie'] = $cols[3];
				$kik_company_angajati['cnp'] = $cols[4];
				$kik_company_angajati['adresa'] = $cols[5];
				$kik_company_angajati['contract_start'] = $cols[7];
				$kik_company_angajati['contract_end'] = $cols[8];
				
				# check if company exists
				$args_company = array(
					'post_type' => 'kik_company',
					'meta_query' => array(
						array(
							'key' => 'kik_company_cif',
							'value' => $cols[0],
							'compare' => '=',
						),
					),
				);
				$companies = get_posts($args_company);
				if ($companies[0]) {  # if company exists
					
					# check if the person is already an employee with the company
					$meta_key_cnp_substr = 's:3:"cnp";s:' . strlen($kik_company_angajati['cnp']) . ':"' . $kik_company_angajati['cnp'] . '"';
					$args_employees = array(
						'queried_object_id' => $companies[0]->ID,
						'post_type' => 'kik_company',
						'meta_query' => array(
							array(
								'key' => 'kik_company_angajati',
								'value' => $meta_key_cnp_substr,
								'compare' => 'LIKE',
							),
						),
					);
					$employees = get_posts($args_employees);
					
					# retrieve array of employees from post meta to insert/update employees
					$angajati = get_post_meta($companies[0]->ID, 'kik_company_angajati', true);
					
					if ($employees[0]) {  # if employee exists
						if (!$_POST['confirmed']) echo '<span class="kik_warning">Linia ' . $i . ': ATENȚIE: Angajatul "' . $kik_company_angajati['cnp'] . '" (' . $kik_company_angajati['nume'] . ' ' . $kik_company_angajati['prenume'] . ') de la compania "' . $cols[0] . '" (' . $companies[0]->post_title . ') există deja. Angajatul va fi suprascris.</span><br />';
						else echo '<span class="kik_warning">Linia ' . $i . ': ATENȚIE: Angajatul "' . $kik_company_angajati['cnp'] . '" (' . $kik_company_angajati['nume'] . ' ' . $kik_company_angajati['prenume'] . ') de la compania "' . $cols[0] . '" (' . $companies[0]->post_title . ') există deja. Angajatul a fost suprascris.</span><br />';
						$messages['warning']++;
						# replace the existing employee
						foreach ($angajati as &$angajat) {
							if ($angajat[cnp] == $kik_company_angajati['cnp']) $angajat = $kik_company_angajati;
						}
					}
					else {  # if new employee
						if (!$_POST['confirmed']) echo '<span class="kik_success">Linia ' . $i . ': SUCCES! Angajatul "' . $kik_company_angajati['cnp'] . '" (' . $kik_company_angajati['nume'] . ' ' . $kik_company_angajati['prenume'] . ') va fi introdus la compania "' . $cols[0] . '" (' . $companies[0]->post_title . ').</span><br />';
						else echo '<span class="kik_success">Linia ' . $i . ': SUCCES! Angajatul "' . $kik_company_angajati['cnp'] . '" (' . $kik_company_angajati['nume'] . ' ' . $kik_company_angajati['prenume'] . ') a fost introdus la compania "' . $cols[0] . '" (' . $companies[0]->post_title . ').</span><br />';
						$messages['success']++;
						# add employee
						$angajati[] = $kik_company_angajati;
					}
					
					# update array of employees in db
					if ($_POST['confirmed']) update_post_meta($companies[0]->ID, 'kik_company_angajati', $angajati);
					
				}
				else {  # company doesn't exist
					if (!$_POST['confirmed']) echo '<span class="kik_error">Linia ' . $i . ': EROARE: Compania "' . $cols[0] . '" nu există. Linia va fi ignorată.</span><br />';
					else echo '<span class="kik_error">Linia ' . $i . ': EROARE: Compania "' . $cols[0] . '" nu există. Linia a fost ignorată.</span><br />';
					$messages['error']++;
				}
			}
		}
		else {
			echo '<span class="kik_error">File is empty!</span><br />';
		}
			
		echo '---------------<br />';
		if (!$_POST['confirmed']) {
			echo '<span class="kik_success">' . $messages['success'] . ($messages['success'] != 1 ? ' angajați vor fi introduși' : ' angajat va fi introdus') . '.</span><br />';
			echo '<span class="kik_warning">' . $messages['warning'] . ($messages['warning'] != 1 ? ' angajați vor fi suprascriși' : ' angajat va fi suprascris') . '.</span><br />';
			echo '<span class="kik_error">' . $messages['error'] . ' linii vor fi ignorate.</span><br />';
			echo '---------------<br />';
			if ($messages['success'] || $messages['warning']) {
				echo ($messages['success'] + $messages['warning']) . ($messages['success'] + $messages['warning'] != 1 ? ' înregistrări valide.' : ' înregistrare validă.') . ' Confirmați și operați modificările? <button id="UploadAngajati_confirm">Da, confirm. Uploadează!</button> <button id="UploadAngajati_cancel">Renunță</button><br />';
			}
			else {
				echo 'Nicio înregistrare validă. Încercați din nou!<br />';
			}
		}
		else {
			echo '<span class="kik_success">' . $messages['success'] . ($messages['success'] != 1 ? ' angajați au fost introduși' : ' angajat a fost introdus') . '.</span><br />';
			echo '<span class="kik_warning">' . $messages['warning'] . ($messages['warning'] != 1 ? ' angajați au fost suprascriși' : ' angajat a fost suprascris') . '.</span><br />';
			echo '<span class="kik_error">' . $messages['error'] . ' linii au fost ignorate.</span><br />';
			echo '---------------<br />';
			echo ($messages['success'] + $messages['warning']) . ($messages['success'] + $messages['warning'] != 1 ? ' înregistrări valide.' : ' înregistrare validă.') . ' Modificările au fost operate cu succes! <button id="UploadAngajati_ok">OK</button><br />';
		}
		
		unlink($sourcePath);
	}
	
	//echo ' {--DONE--} ';
	
	wp_die();
}










/**/

?>