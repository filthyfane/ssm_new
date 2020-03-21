<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_Debite_neincasate', 'KIK_ACTION_Debite_neincasate_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Debite_neincasate', 'KIK_ACTION_Debite_neincasate_FUNC');
function KIK_ACTION_Debite_neincasate_FUNC() {
	
	global $wpdb;

	validatePostDataDebiteNeincasate($_POST);
	

	
	$oInspector 	= null;
	$oSalesAgent 	= null;
	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_debite_neincasate_data_inceput']);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_debite_neincasate_data_sfarsit']);
	$currUser 	 	= wp_get_current_user();
	$timestamp 		= (new DateTime())->format('U');
	$postID 		= $_POST['currPostID'];
	
	if($_POST['kik_report_debite_neincasate_inspector']){
		$oInspector = get_userdata($_POST['kik_report_debite_neincasate_inspector']);
	}
	
	if($_POST['kik_report_debite_neincasate_sales_agent']){
		$oSalesAgent = get_userdata($_POST['kik_report_debite_neincasate_sales_agent']);
	}
	
	
	$counter	= 0;
	$queryData	= getBillsByDateInterval($oInspector, $oSalesAgent, $oIntervalStart, $oIntervalEnd);

	if(count($queryData) == 0){
		$extraParams = ['formName' => $_POST['form_name']];
		returnError('Nu au fost găsite date pentru perioada menționată!', $extraParams);
	}

	$reportDetails = [
		'fileName' 	   => 'tmp_' . $_POST['fileName'].'_'.$timestamp,
		'createDate'   => $timestamp,
		'userFullName' => $currUser->user_firstname . " " . $currUser->user_lastname,
		'reportType'   => $_POST['reportType'],
		'titleLines'   => [
			'FIRME CARE AU DEBITE NEÎNCASATE ÎN PERIOADA',
			$oIntervalStart->format('d.m.Y') . ' - ' . $oIntervalEnd->format('d.m.Y')
		]	
	];
	
	// create new PDF document
	$pdf  		 = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$aUploadDir  = wp_upload_dir();
	$path 		 = $aUploadDir['basedir'].'/reports/';
	$pdf->checkPath($path);
	$pdf->setPDFDetails($reportDetails);
	$pdf->printTitle($reportDetails['titleLines']);
	
	// total width 180
	$headerData = [
		['width' => 10, 'string' => '#'],
		['width' => 35, 'string' => 'Firma'],
		['width' => 20, 'string' => 'Data scadenței'],
		['width' => 25, 'string' => 'Nr. factură'],
		['width' => 15, 'string' => 'Valoare'],
		['width' => 15, 'string' => 'Rest Plata'],
		['width' => 30, 'string' => 'Inspector SSM'],
		['width' => 30, 'string' => 'Agent de vânzări'],
	];

	$pdf->printTableHeader($headerData);
	$pdf->SetFont('freesans', '', 8);


	foreach($queryData as $data){
			
		$oInspector	   = get_userdata($data['InspectorId']);
		$oSalesAgent   = get_userdata($data['SalesAgentId']);
		$inspFullName  = $oInspector->last_name .' '. $oInspector->first_name; 
		$salesFullName = $oSalesAgent->last_name .' '. $oSalesAgent->first_name;
		$oCompany	   = get_post($data['PostId']);
		$platiPartiale = unserialize(get_post_meta($data['FacturaId'], 'platiPartiale', true));
		$termenPlata   = get_post_meta($data['FacturaId'], 'termenPlata', true);
		$nrFactura	   = get_post_meta($data['FacturaId'], 'nrFactura', true);
		$currDate	   = new DateTime();
		$sumaFacturii  = get_post_meta($data['FacturaId'], 'sumaFactura', true) . ' LEI';
		$dataFacturii  = get_post_meta($data['FacturaId'], 'dataFacturii', true);
		$oDataFacturii = DateTime::createFromFormat('Y/m/d', $dataFacturii);
		$dataTermen    = DateTime::createFromFormat('Y/m/d', $dataFacturii)->add(new DateInterval('P'.(int)$termenPlata.'D'));
		$suma 		   = 0;
	
		if($platiPartiale){
			foreach($platiPartiale as $plataPartiala){
				$suma += $plataPartiala['suma'];
			}
		}

		$restPlata = ($sumaFacturii - $suma) . ' LEI';
		
		if($dataTermen < $currDate && $suma < $sumaFacturii){
			
			$counter++;
			$dataRow = [
				['width' => 10, 'string' => $counter],
				['width' => 35, 'string' => $oCompany->post_title], 
				['width' => 20, 'string' => $oDataFacturii->format('d.m.Y')], 
				['width' => 25, 'string' => $nrFactura], 
				['width' => 15, 'string' => $sumaFacturii],
				['width' => 15, 'string' => $restPlata],
				['width' => 30, 'string' => $inspFullName],
				['width' => 30, 'string' => $salesFullName],
			];

			$pdf->printTableRow($dataRow, $headerData);
		}
	}

	//Close and output PDF document
	$pdf->Output($path.$reportDetails['fileName'].'.pdf', 'F');

	//SAVE REPORT TO THE CORRESPONDING COMPANY
	add_post_meta($postID, 'rapoarte', serialize($reportDetails));

	$response = [
		'success' => true,
		'pdfUrl'  => $aUploadDir['baseurl'] . '/reports/' . $reportDetails['fileName'].'.pdf',
		'pdfName' => $reportDetails['fileName'],
		'formName' => $_POST['form_name']
	];
	
	echo json_encode($response);
	wp_die();
	

















	
	$response['html'] = "<table border='1' 
			cellspacing='0' 
			cellpadding='0' 
			style='width: 700px;' 
			class='rap-debite-neincasate'>
		<thead>
			<tr>
				<th width='20' align='center'>#</th>
				<th width='200' align='center'> Firmă </th>
				<th width='60' align='center'> Data </th>
				<th width='60' align='center'> Nr. </th>
				<th width='60' align='center'> Valoare </th>
				<th width='100' align='center'> Inspector SSM</th>
				<th width='100' align='center'> Agent de vânzări</th>
			</tr>
		</thead>
		<tbody>";
	
	
	if(sizeof($queryData)>0){
		foreach($queryData as $data){
			
			$oInspector	   = get_userdata($data['InspectorId']);
			$oSalesAgent   = get_userdata($data['SalesAgentId']);
			$inspFullName  = $oInspector->last_name .' '. $oInspector->first_name; 
			$salesFullName = $oSalesAgent->last_name .' '. $oSalesAgent->first_name;
			$post		   = get_post($data['PostId']);
			
			$platiPartiale = unserialize(get_post_meta($data['FacturaId'], 'platiPartiale', true));
			$termenPlata   = get_post_meta($data['FacturaId'], 'termenPlata', true);
			$nrFactura	   = get_post_meta($data['FacturaId'], 'nrFactura', true);
			$currDate	   = new DateTime();
			$sumaFacturii  = get_post_meta($data['FacturaId'], 'sumaFactura', true);
			$dataFacturii  = get_post_meta($data['FacturaId'], 'dataFacturii', true);
			$oDataFacturii = DateTime::createFromFormat('Y/m/d', $dataFacturii);
			$dataTermen    = DateTime::createFromFormat('Y/m/d', $dataFacturii)->add(new DateInterval('P'.$termenPlata.'D'));
			$suma 		   = 0;
		
			if($platiPartiale){
				foreach($platiPartiale as $plataPartiala){
					$suma += $plataPartiala['suma'];
				}
			}
			
			if($dataTermen < $currDate && $suma < $sumaFacturii){
				
				$counter++;
				$response['html'].="<tr>
						<td width='20'>".$counter."</td>
						<td width='200'>".$post->post_title."</td>
						<td width='60'>".$oDataFacturii->format('d/m/Y')."</td>
						<td width='60'>".$nrFactura."</td>
						<td width='60'>".$sumaFacturii." lei</td>
						<td width='100'>".$inspFullName."</td>
						<td width='100'>".$salesFullName."</td>
					</tr>";
			}
		}
	}
	$response['html'].="</tbody></table>";
	
	echo json_encode($response);
	wp_die();
	
}

function validatePostDataDebiteNeincasate($post)
{
	$extraParams = ['formName' => $post['form_name']];
	validateDateInterval(
		$post['kik_report_debite_neincasate_data_inceput'], 
		$post['kik_report_debite_neincasate_data_sfarsit'],
		$extraParams
	);

	if ($_POST['kik_report_debite_neincasate_inspector']) {
		$oInspector = get_userdata($_POST['kik_report_debite_neincasate_inspector']);
		if ($oInspector === false) {
			returnError('Inspectorul selectat nu există! Vă rugăm să contactați administratorul site-ului!', $extraParams);
		}
	}
	
	if ($_POST['kik_report_debite_neincasate_sales_agent']) {
		$oSalesAgent = get_userdata($_POST['kik_report_debite_neincasate_sales_agent']);
		if ($oSalesAgent === false) {
			returnError('Agentul selectat nu există! Vă rugăm să contactați administratorul site-ului!', $extraParams);
		}
	}
}
