<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_Angajati_noi', 'KIK_ACTION_Angajati_noi_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Angajati_noi', 'KIK_ACTION_Angajati_noi_FUNC');
function KIK_ACTION_Angajati_noi_FUNC() {
	
	global $wpdb;

	validatePostDataAngajatiNoi($_POST);
	
	$currUser 	 	= wp_get_current_user();
	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_angajati_noi_data_inceput']);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_angajati_noi_data_sfarsit']);
	$queryData      = getAngajatiNoi($oIntervalStart, $oIntervalEnd);
	$counter		= 0;
	$timestamp 		= (new DateTime())->format('U');
	$postID 		= $_POST['currPostID'];
	
	if(count($queryData) == 0){
		$optionalParams = ['formName' => $_POST['form_name']];
		returnError('Nu au fost găsiți angajați noi pentru perioada menționată!', $optionalParams);
	} 

	$reportDetails = [
		'fileName' 	   => 'tmp_' . $_POST['fileName'].'_'.$timestamp,
		'createDate'   => $timestamp,
		'userFullName' => $currUser->user_firstname . " " . $currUser->user_lastname,
		'reportType'   => $_POST['reportType'],
		'titleLines'   => [
			'FIRME CARE AU ANGAJATI NOI IN PERIOADA',
			$_POST['kik_angajati_noi_data_inceput'] . ' - ' . $_POST['kik_angajati_noi_data_sfarsit']
		]	
	];
	
	// create new PDF document
	$pdf  		 = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$aUploadDir  = wp_upload_dir();
	$path 		 = $aUploadDir['basedir'].'/reports/';
	$pdf->checkPath($path);
	$pdf->setPDFDetails($reportDetails);
	$pdf->printTitle($reportDetails['titleLines']);
	
	$headerData = [
		['width' => 10, 'string' => '#'],
		['width' => 60, 'string' => 'Firma'],
		['width' => 60, 'string' => 'Nume angajat'],
		['width' => 25, 'string' => 'Data angajarii'],
		['width' => 25, 'string' => 'Functia'],
	];

	$pdf->printTableHeader($headerData);
	$pdf->SetFont('freesans', '', 8);

	foreach($queryData as $oEmployee){
		$counter++;
		$oCompany 		  = get_post($oEmployee->post_parent);
		$employeeFullName = get_post_meta($oEmployee->ID, 'numeAngajat', true).' '.get_post_meta($oEmployee->ID, 'prenumeAngajat', true);
		$oDataAngajarii   = DateTime::createFromFormat('Y/m/d', get_post_meta($oEmployee->ID, 'contractAngajatStart', true));
		$functie		  = get_post_meta($oEmployee->ID, 'functieAngajat', true);
		$dataRow 		  = [
			['width' => 10, 'string' => $counter],
			['width' => 60, 'string' => $oCompany->post_title], 
			['width' => 60, 'string' => $employeeFullName], 
			['width' => 25, 'string' => $oDataAngajarii->format('d/m/Y')], 
			['width' => 25, 'string' => $functie]
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
}

function validatePostDataAngajatiNoi($post)
{
	$extraParams = ['formName' => $post['form_name']];
	validateDateInterval(
		$post['kik_angajati_noi_data_inceput'], 
		$post['kik_angajati_noi_data_sfarsit'],
		$extraParams
	);
}

?>