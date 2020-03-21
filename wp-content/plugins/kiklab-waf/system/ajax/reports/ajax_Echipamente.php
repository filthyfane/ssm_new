<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_Echipamente', 'KIK_ACTION_Echipamente_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Echipamente', 'KIK_ACTION_Echipamente_FUNC');
function KIK_ACTION_Echipamente_FUNC() {
	
	global $wpdb;
	if(!$_POST['kik_report_echipamente_data_inceput'] ||
	   !$_POST['kik_report_echipamente_data_sfarsit'] ||
	   !$_POST['kik_report_echipamente_inspector']
	){
		echo json_encode(array(
			'status' 	=> 'error',
			'form_name'  => $_POST['form_name']
		));
		wp_die();
	}
	
	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_echipamente_data_inceput']);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_echipamente_data_sfarsit']);
	$oInspector     = get_userdata($_POST['kik_report_echipamente_inspector']); 
	$inspFullName   = $oInspector->last_name .' '. $oInspector->first_name; 
	$counter		= 0;
	$response		= array('status' => 'success', 'table' => '.rap-echipamente');
	$posts			= getCompaniesByInspector($oInspector->ID);
	
	//<!-- DATA TABLE -->
	$response['html'] = "<table	border='1' 
			cellspacing='0' 
			cellpadding='0'
			style='width: 700px;' 
			class='rap-echipamente'
			data-start-date = '".$oIntervalStart->format('d/m/Y')."'
			data-end-date = '".$oIntervalEnd->format('d/m/Y')."'>
		<thead>
			<tr align='center'>
				<th width='20' align='center'>#</th>
				<th width='250' align='center'> Firmă </th>
				<th width='200' align='center'> Echipament </th>
				<th width='180' align='center'> Inspector SSM</th>
			</tr>
		</thead>
		<tbody>"; 
		foreach($posts as $post){
			$equipments = getEquipments($post->ID);
			
			foreach($equipments as $equipment){
				$dataExp = DateTime::createFromFormat('d/m/Y', get_post_meta($equipment->ID, 'dataExpirare', true));					
				$iscir   = get_post_meta($equipment->ID, 'dataExpirare', true);
				$echipId = get_post_meta($equipment->ID, 'idEchipament', true);
				$oEchip  = get_term($echipId, 'kik_echipamente');
				
				if($iscir){
					$dataExpIscir = DateTime::createFromFormat('Y/m/d', $iscir);
				}
				
				if(($dataExp > $oIntervalStart && $dataExp < $oIntervalEnd) ||
				   ($iscir && $dataExpIscir > $oIntervalStart && $dataExpIscir < $oIntervalEnd)){
					$counter++;
					$response['html'].="<tr>
						<td width='20'>".$counter."</td>
						<td width='250'>".$post->post_title."</td>
						<td width='200'>".$oEchip->name."</td>
						<td width='180'>".$inspFullName."</td>
					</tr>";
				}
			}
		}
		$response['html'].="</tbody></table>";
		
	echo json_encode($response);
	wp_die();
}










/**/

?>