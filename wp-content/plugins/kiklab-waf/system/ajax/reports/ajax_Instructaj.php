<?php


##### REPORTS: Afiseaza toate instructajele ce vor avea loc intr-un interval de timp
add_action('wp_ajax_KIK_ACTION_instructaj', 'KIK_ACTION_instructaj_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_instructaj', 'KIK_ACTION_instructaj_FUNC');
function KIK_ACTION_instructaj_FUNC() {
	
	global $wpdb;
	if(!$_POST['kik_report_instructaj_data_inceput'] || 
	   !$_POST['kik_report_instructaj_data_sfarsit'] ||
	   !$_POST['kik_report_instructaj_inspector']){
		echo json_encode(array(
			'status' 	=> 'error',
			'form_name'  => $_POST['form_name']
		));
		wp_die();
    }
	
	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_instructaj_data_inceput']);
	$oIntervalEnd  	= DateTime::createFromFormat('d/m/Y', $_POST['kik_report_instructaj_data_sfarsit']);
	$oInspector 	= get_userdata($_POST['kik_report_instructaj_inspector']); 
	$inspFullName 	= $oInspector->last_name .' '. $oInspector->first_name; 
	$counter 		= 0; 
	$posts 			= getCompaniesByInspector($oInspector->ID);
	$response 		= array('status' => 'success', 'table' => '.rap-instructaj');

	//<!-- DATA TABLE -->
	$response['html'] = "<table	border='1' cellspacing='0' 
			cellpadding='0' 
			style='width: 700px;' 
			class='rap-instructaj'
			data-start-date='".$oIntervalStart->format('d/m/Y')."'
			data-end-date='".$oIntervalEnd->format('d/m/Y')."'>
		<thead>
			<tr align='center'>
				<th width='20' align='center'>#</th>
				<th width='250' align='center'> Firmă </th>
				<th width='100' align='center'> Data instructaj </th>
				<th width='150' align='center'> Tip instructaj </th>
				<th width='130' align='center'> Inspector SSM</th>
			</tr>
		</thead>
		<tbody>";
			
	foreach($posts as $post){
		
		$aInstructaje = get_post_meta($post->ID, 'kik_instructaj', true);
		
		if($aInstructaje){
			foreach($aInstructaje as $id_tip_instructaj => $id_periodicitate){
				$oPeriodicitate = get_term_by('id', $id_periodicitate, 'kik_periodicitate_instructaj');
				$oTipInstructaj = get_term_by('id', $id_tip_instructaj, 'kik_tipuri_instructaj');
				
				$interval = getFrequencyInterval($oPeriodicitate->name);
				$contractDate = get_post_meta($post->ID, 'kik_company_contract_date', true);
				if (!$contractDate) {
					$counter ++;
					$response['html'].=
						'<tr>
						<td width="20">'.$counter.'</td>
						<td width="250">'.$post->post_title.'</td>
						<td width="100">Data contractului nu este setată</td>
						<td width="150" >'.$oTipInstructaj->name.' - '.$oPeriodicitate->name.'</td>
						<td width="130">'.$inspFullName.'</td>
						</tr>';
					continue;
				}
				$oContractStartDate = DateTime::createFromFormat('Y/m/d', $contractDate);
				$oContractStartDate->add(new DateInterval($interval));
				
				while($oContractStartDate <= $oIntervalEnd){
					if($oContractStartDate >= $oIntervalStart && $oContractStartDate <= $oIntervalEnd){
						$counter++;
						$response['html'].=
						'<tr>
						<td width="20">'.$counter.'</td>
						<td width="250">'.$post->post_title.'</td>
						<td width="100">'.$oContractStartDate->format('d/m/Y').'</td>
						<td width="150" >'.$oTipInstructaj->name.' - '.$oPeriodicitate->name.'</td>
						<td width="130">'.$inspFullName.'</td>
						</tr>';
					}
					$oContractStartDate->add(new DateInterval($interval));
				} 
			}
		}
	}
	
	$response['html'] .= "</tbody></table>";
	$response['status'] = 'success';
	$response['form_name'] = $_POST['form_name'];
	$response['message'] = "Raport generat cu succes! Puteți vizualiza raportul în format PDF în secțiunea 'Toate Rapoartele'!";
	
	echo json_encode($response);
	wp_die();
} ?>