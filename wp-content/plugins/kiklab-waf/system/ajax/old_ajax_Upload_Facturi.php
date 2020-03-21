<?php


##### UPLOAD: Facturi
add_action('wp_ajax_KIK_ACTION_Upload_Facturi', 'KIK_ACTION_Upload_Facturi_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Upload_Facturi', 'KIK_ACTION_Upload_Facturi_FUNC');
function KIK_ACTION_Upload_Facturi_FUNC() {
	
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
		$cols_count = 5;  # number of columns expected
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
				$kik_company_billing_history['bill_date'] = $cols[1];
				$kik_company_billing_history['bill_nr'] = $cols[2];
				$kik_company_billing_history['bill_val'] = $cols[3];
				$kik_company_billing_history['bill_bool'] = $cols[4];
				
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
					
					# check if the bill is already registered for another company
					$meta_key_cnp_substr = 's:7:"bill_nr";s:' . strlen($kik_company_billing_history['bill_nr']) . ':"' . $kik_company_billing_history['bill_nr'] . '"';
					$args_other = array(
						'post__not_in' => array($companies[0]->ID),
						'post_type' => 'kik_company',
						'meta_query' => array(
							array(
								'key' => 'kik_company_billing_history',
								'value' => $meta_key_cnp_substr,
								'compare' => 'LIKE',
							),
						),
					);
					$other = get_posts($args_other);
					if ($other[0]) {  # if bill exists
						
						if (!$_POST['confirmed']) echo '<span class="kik_error">Linia ' . $i . ': EROARE: Factura "' . $kik_company_billing_history['bill_nr'] . '" există deja pentru compania "' . $cols[0] . '" (' . $other[0]->post_title . '). Factura va fi fost ignorată.</span><br />';
						else echo '<span class="kik_error">Linia ' . $i . ': EROARE: Factura "' . $kik_company_billing_history['bill_nr'] . '" există deja pentru compania "' . $cols[0] . '" (' . $other[0]->post_title . '). Factura a fost ignorată.</span><br />';
						$messages['error']++;
						
					}
					else {
						
						# check if the bill is already registered for the company
						$meta_key_cnp_substr = 's:7:"bill_nr";s:' . strlen($kik_company_billing_history['bill_nr']) . ':"' . $kik_company_billing_history['bill_nr'] . '"';
						$args_bills = array(
							'queried_object_id' => $companies[0]->ID,
							'post_type' => 'kik_company',
							'meta_query' => array(
								array(
									'key' => 'kik_company_billing_history',
									'value' => $meta_key_cnp_substr,
									'compare' => 'LIKE',
								),
							),
						);
						$bills = get_posts($args_bills);
						
						# retrieve array of bills from post meta to insert/update bills
						$facturi = get_post_meta($companies[0]->ID, 'kik_company_billing_history', true);
						
						if ($bills[0]) {  # if bill exists
							if (!$_POST['confirmed']) echo '<span class="kik_warning">Linia ' . $i . ': ATENȚIE: Factura "' . $kik_company_billing_history['bill_nr'] . '" pentru compania "' . $cols[0] . '" (' . $companies[0]->post_title . ') există deja. Factura va fi suprascrisă.</span><br />';
							else echo '<span class="kik_warning">Linia ' . $i . ': ATENȚIE: Factura "' . $kik_company_billing_history['bill_nr'] . '" pentru compania "' . $cols[0] . '" (' . $companies[0]->post_title . ') există deja. Factura a fost suprascrisă.</span><br />';
							$messages['warning']++;
							# replace the existing bill
							foreach ($facturi as &$factura) {
								if ($factura[cnp] == $kik_company_billing_history['cnp']) $factura = $kik_company_billing_history;
							}
						}
						else {  # if new bill
							if (!$_POST['confirmed']) echo '<span class="kik_success">Linia ' . $i . ': SUCCES! Factura "' . $kik_company_billing_history['bill_nr'] . '" va fi înregistrată pentru compania "' . $cols[0] . '" (' . $companies[0]->post_title . ').</span><br />';
							else echo '<span class="kik_success">Linia ' . $i . ': SUCCES! Factura "' . $kik_company_billing_history['bill_nr'] . '" a fost înregistrată pentru compania "' . $cols[0] . '" (' . $companies[0]->post_title . ').</span><br />';
							$messages['success']++;
							# add bill
							if ($kik_company_billing_history['bill_bool'] == 'DA') $kik_company_billing_history['bill_bool'] = 'ON';
							else unset($kik_company_billing_history['bill_bool']);
							$facturi[] = $kik_company_billing_history;
						}
						
						# update array of employees in db
						if ($_POST['confirmed']) update_post_meta($companies[0]->ID, 'kik_company_billing_history', $facturi);
						
					}
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
			echo '<span class="kik_success">' . $messages['success'] . ($messages['success'] != 1 ? ' facturi vor fi introduse' : ' factură va fi introdusă') . '.</span><br />';
			echo '<span class="kik_warning">' . $messages['warning'] . ($messages['warning'] != 1 ? ' facturi vor fi suprascrise' : ' factură va fi suprascrisă') . '.</span><br />';
			echo '<span class="kik_error">' . $messages['error'] . ' linii vor fi ignorate.</span><br />';
			echo '---------------<br />';
			if ($messages['success'] || $messages['warning']) {
				echo ($messages['success'] + $messages['warning']) . ($messages['success'] + $messages['warning'] != 1 ? ' înregistrări valide.' : ' înregistrare validă.') . ' Confirmați și operați modificările? <button id="UploadFacturi_confirm">Da, confirm. Uploadează!</button> <button id="UploadFacturi_cancel">Renunță</button><br />';
			}
			else {
				echo 'Nicio înregistrare validă. Încercați din nou!<br />';
			}
		}
		else {
			echo '<span class="kik_success">' . $messages['success'] . ($messages['success'] != 1 ? ' facturi au fost introduse' : ' factură a fost introdusă') . '.</span><br />';
			echo '<span class="kik_warning">' . $messages['warning'] . ($messages['warning'] != 1 ? ' facturi au fost suprascrise' : ' factură a fost suprascrisă') . '.</span><br />';
			echo '<span class="kik_error">' . $messages['error'] . ' linii au fost ignorate.</span><br />';
			echo '---------------<br />';
			echo ($messages['success'] + $messages['warning']) . ($messages['success'] + $messages['warning'] != 1 ? ' înregistrări valide.' : ' înregistrare validă.') . ' Modificările au fost operate cu succes! <button id="UploadFacturi_ok">OK</button><br />';
		}
		
		unlink($sourcePath);
	}
	
	//echo ' {--DONE--} ';
	
	wp_die();
}







/**/

?>