<?php


##### REPORTS: Raport accidente
add_action('wp_ajax_KIK_ACTION_Accidente', 'KIK_ACTION_Accidente_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Accidente', 'KIK_ACTION_Accidente_FUNC');
function KIK_ACTION_Accidente_FUNC() {
	
	global $wpdb;

	validatePostDataAccidente($_POST);

	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_accidente_data_inceput']);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_accidente_data_sfarsit']);
	$queryData      = getAccidentsByInterval($oIntervalStart, $oIntervalEnd);
	$currUser 	 	= wp_get_current_user();
	$timestamp 		= (new DateTime())->format('U');
	$postID 		= $_POST['currPostID'];
	$counter        = 0;

	if(count($queryData) == 0){
		$extraParams = ['formName' => $_POST['form_name']];
		returnError('Nu au fost găsite evenimente pentru perioada menționată!', $extraParams);
	} 

	$reportDetails = [
		'fileName' 	   => 'tmp_' . $_POST['fileName'].'_'.$timestamp,
		'createDate'   => $timestamp,
		'userFullName' => $currUser->user_firstname . " " . $currUser->user_lastname,
		'reportType'   => $_POST['reportType'],
		'titleLines'   => [
			'FIRME CARE AU DOSARE DE CERCETARE ACCIDENT ÎN PERIOADA',
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
	
	// total width: 180
	$headerData = [
		['width' => 10, 'string' => '#'],
		['width' => 50, 'string' => 'Firma'],
		['width' => 20, 'string' => 'Data cercetării'],
		['width' => 20, 'string' => 'Data producerii'],
		['width' => 30, 'string' => 'Nume angajat'],
		['width' => 50, 'string' => 'Descriere'],
	];

	$pdf->printTableHeader($headerData);
	$pdf->SetFont('freesans', '', 8);


	foreach($queryData as $accident){
		$counter++;
		$oCompany          = get_post($accident->post_parent);
		$angajatPost       = get_post(get_post_meta($accident->ID, 'accidentAngajat', true));
		$dataAccident  	   = get_post_meta($accident->ID, 'dataAccidentului', true);
		$dataCercetare     = get_post_meta($accident->ID, 'dataCercetarii', true);
		$inspectorID   	   = get_post_meta($oCompany->ID, 'kik_company_inspector', true);
		$employeeFullName  = '';
		$angFullName       = '';
			
		if($inspectorID){
			$oInspector = get_userdata($inspectorID);
			$inspFullName = $oInspector->last_name.' '.$oInspector->first_name;
		}
			
		if($angajatPost){
			$employeeFullName = get_post_meta($angajatPost->ID, 'numeAngajat', true).' '.get_post_meta($angajatPost->ID, 'prenumeAngajat', true);
		}
			
		if($dataAccident){
			$oDataAccident = DateTime::CreateFromFormat('Y/m/d', $dataAccident);
			$dataAccident  = $oDataAccident->format('d/m/Y');
		}
			
		if($dataCercetare){
			$oDataCercetare = DateTime::CreateFromFormat('Y/m/d', $dataCercetare);
			$dataCercetare  = $oDataCercetare->format('d/m/Y');
		}

		$dataRow = [
			['width' => 10, 'string' => $counter],
			['width' => 50, 'string' => $oCompany->post_title], 
			['width' => 20, 'string' => $employeeFullName], 
			['width' => 20, 'string' => $dataCercetare], 
			['width' => 30, 'string' => $dataAccident],
			['width' => 50, 'string' => get_post_meta($accident->ID, 'accidentDescriere', true)]
		];

		$pdf->printTableRow($dataRow, $headerData);
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


	// OLD - DO NOT DELETE
	// $oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_accidente_data_inceput']);
	// $oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_accidente_data_sfarsit']);
	// $queryData      = getAccidentsByInterval($oIntervalStart, $oIntervalEnd);
	// $response		= array('status'=>'success', 'table' => '.rap-accidente'); 
	// $counter        = 0;
	
	// $response['html'] = "<table border='1'
	// 		cellspacing='0'
	// 		cellpadding='0' 
	// 		style='width: 700px;'
	// 		class='rap-accidente'
	// 		data-start-date = '".$oIntervalStart->format('d/m/Y')."'
	// 		data-end-date = '".$oIntervalEnd->format('d/m/Y')."'>
	// 	<thead>
	// 		<tr align='center'>
	// 			<th width='20' align='center'>#</th>
	// 			<th width='170' align='center'> Firmă </th>
	// 			<th width='90' align='center'> Data cercetării </th>
	// 			<th width='90' align='center'> Data producerii</th>
	// 			<th width='100' align='center'> Angajat</th>
	// 			<th width='180' align='center'> Descriere</th>
	// 		</tr>
	// 	</thead>
	// 	<tbody>";
	
	// foreach($queryData as $accident){
	// 	$companyPost   = get_post($accident->post_parent);
	// 	$angajatPost   = get_post(get_post_meta($accident->ID, 'accidentAngajat', true));
	// 	$dataAccident  = get_post_meta($accident->ID, 'dataAccidentului', true);
	// 	$dataCercetare = get_post_meta($accident->ID, 'dataCercetarii', true);
	// 	$inspectorID   = get_post_meta($companyPost->ID, 'kik_company_inspector', true);
	// 	$inspFullName  = '';
	// 	$angFullName   = '';
	// 	$counter++;
		
	// 	if($inspectorID){
	// 		$oInspector = get_userdata($inspectorID);
	// 		$inspFullName = $oInspector->last_name.' '.$oInspector->first_name;
	// 	}
		
	// 	if($angajatPost){
	// 		$angFullName = get_post_meta($angajatPost->ID, 'numeAngajat', true).' '.get_post_meta($angajatPost->ID, 'prenumeAngajat', true);
	// 	}
		
	// 	if($dataAccident){
	// 		$oDataAccident = DateTime::CreateFromFormat('Y/m/d', $dataAccident);
	// 		$dataAccident  = $oDataAccident->format('d/m/Y');
	// 	}
		
	// 	if($dataCercetare){
	// 		$oDataCercetare = DateTime::CreateFromFormat('Y/m/d', $dataCercetare);
	// 		$dataCercetare  = $oDataCercetare->format('d/m/Y');
	// 	}
		
	// 	$response['html'] .= "<tr>
	// 		<td width='20'>".$counter."</td>
	// 		<td width='170'>".$companyPost->post_title."</td>
	// 		<td width='90'>".$dataCercetare."</td>
	// 		<td width='90'>".$dataAccident."</td>
	// 		<td width='100'>".$angFullName."</td>
	// 		<td width='180'>".get_post_meta($accident->ID, 'accidentDescriere', true)."</td>
	// 	</tr>";
	// }
		
	// $response['html'].="</tbody></table>";
	
	// echo json_encode($response);
		
	// wp_die();
}

function validatePostDataAccidente($post)
{
	$optionalParams = ['formName' => $post['form_name']];
	validateDateInterval(
		$post['kik_report_accidente_data_inceput'], 
		$post['kik_report_accidente_data_sfarsit'],
		['formName' => $post['form_name']]
	);
}

?>