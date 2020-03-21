<?php

						
						
						# get the years of service
						//$years = get_post_meta($post->ID, 'kik_company_service_frequency_history', true);
						//echo DrawObject($years);
						
					/* 	if ($years) foreach ($years as $year => $months) {
							//echo '[[' . $year . ']]== ' . DrawObject($months);
							
							$j = 0;
							if ($months) foreach ($months as $j => $vals) {
								if (isset($vals['serv_billed']) && $vals['serv_billed'] && !$vals['serv_cashed']) {
									$formatted_date = $year . '-' . sprintf("%02d", $j) . '-' . sprintf("%02d", $vals['day']);
									//echo $formatted_date . ' [' . $vals['serv_billed'] . '][' . $vals['serv_cashed'] . ']<br />';
									if ($_POST['kik_report_facturi_data_inceput'] <= $formatted_date 
									&& $formatted_date <= $_POST['kik_report_facturi_data_sfarsit']) {
										$i++;
										if ($all_bills = get_post_meta($post->ID, 'kik_company_billing_history', true)) {
											//echo DrawObject($all_bills);
											foreach ($all_bills as $a_bill) if ($a_bill['bill_bool']) $cashed_bills[] = $a_bill;
											//echo DrawObject($cashed_bills);
											usort($cashed_bills, 'KIK_SORT_BILLING_HISTORY_BY_DATE_OF_LAST_CASHED_BILL');
											//echo DrawObject($cashed_bills);
											//$last_cashed_bill = array_pop($cashed_bills);
											$last_cashed_bill = $cashed_bills[0];
										}
										echo '
											<tr>
												<td>' . $i . '</td>
												<td>' . $post->post_title . '</td>
												<td>' . wp_get_post_terms($post->ID, 'kik_perioada_de_facturare')[0]->name . '</td>
												<td>' . $last_cashed_bill['bill_date'] . '</td>
												<td>' . $last_cashed_bill['bill_nr'] . '</td>
												<td>' . $last_cashed_bill['bill_val'] . '</td>
											</tr>
										';
									}
								}
							}
							
						}
						 */
						 
						 
##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_Facturi', 'KIK_ACTION_Facturi_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Facturi', 'KIK_ACTION_Facturi_FUNC');
function KIK_ACTION_Facturi_FUNC() {
	
	global $wpdb;
	
	//echo DrawObject($_POST);
	
	$kik_company_data_inceput = explode('-', $_POST['kik_report_facturi_data_inceput']);
	$kik_company_data_sfarsit = explode('-', $_POST['kik_report_facturi_data_sfarsit']);
	
	?>
		
		<p class="align-center"><b>Firme care au facturi de intocmit in perioada <span class="report_field">&emsp;<?php echo implode('.', array_reverse($kik_company_data_inceput)); ?>&emsp;</span> - <span class="report_field">&emsp;<?php echo implode('.', array_reverse($kik_company_data_sfarsit)); ?>&emsp;</span></b></p>
		<p></p>
		<p></p>
		<table class="report_list">
			<thead>
				<tr>
					<th rowspan="2">#</th>
					<th rowspan="2">Firma</th>
					<th rowspan="2">Perioada de facturare</th>
					<th colspan="3">Ultima factură încasată</th>
				</tr>
				<tr>
					<th>Data</th>
					<th>Nr.</th>
					<th>Valoare</th>
				</tr>
			</thead>
			<tbody><?php
			
				if($_POST['kik_report_facturi_data_inceput']){
					var_dump('dfdfdfddd');
					$i = 0;
					$counter = 1;
					// DE MODIFICAT DUPA CE SCHIMB PAGINA
					$oIntervalStart = DateTime::createFromFormat('Y-m-d', $_POST['kik_report_facturi_data_inceput']);
					$oIntervalEnd = DateTime::createFromFormat('Y-m-d', $_POST['kik_report_facturi_data_sfarsit']);
					$posts = get_posts(array(
						'posts_per_page' => -1,
						'post_type' => 'kik_company',
					));
				
					foreach ($posts as $post) { 
						
						$oContractStartDate = DateTime::createFromFormat('d/m/Y', get_post_meta($post->ID, 'kik_company_contract_date', true));
						$oIntervalFacturare = wp_get_object_terms($post->ID, 'kik_perioada_de_facturare')[0];
						
						switch($oIntervalFacturare->name){
							case 'Anual': 
								$interval = 'P1Y';
								break;
							case 'Semestrial':
								$interval = 'P6M';
								break;
							case 'Trimestrial':
								$interval = 'P3M';
								break;
							case 'Lunar':
								$interval = 'P1M';
								break;
						}
						
						if(!is_object($oContractStartDate)) {
							continue;
						};
						
						$oContractStartDate = $oContractStartDate->add(new DateInterval($interval));
						
						while($oContractStartDate < $oIntervalEnd){
							$oContractStartDate = $oContractStartDate->add(new DateInterval($interval));
							if($oContractStartDate > $oIntervalStart && $oContractStartDate < $oIntervalEnd){
								echo '<tr>
									<td>' . $counter . '</td>
									<td>' . $post->post_title . '</td>
									<td>' . wp_get_post_terms($post->ID, 'kik_perioada_de_facturare')[0]->name . '</td>
									<td>'. $oContractStartDate->format('d-m-Y').'</td>
									<td>-</td>
									<td>-</td>
								</tr>';
								$counter++;
							}
						}

					}
				
				}
				?>
			</tbody>
		</table>
		
	<?php
	
	//echo ' {--DONE--} ';
	
	wp_die();
}










/**/

?>