<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_Facturi', 'KIK_ACTION_Facturi_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Facturi', 'KIK_ACTION_Facturi_FUNC');
function KIK_ACTION_Facturi_FUNC() {
	
	global $wpdb;


	validatePostDataFacturi($_POST);

	$currUser 	 	= wp_get_current_user();
	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_facturi_data_inceput']);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_facturi_data_sfarsit']);
	$timestamp 		= (new DateTime())->format('U');
	$postID 		= $_POST['currPostID'];
	$counter		= 0;
	
	$reportDetails = [
		'fileName' 	   => 'tmp_' . $_POST['fileName'].'_'.$timestamp,
		'createDate'   => $timestamp,
		'userFullName' => $currUser->user_firstname . " " . $currUser->user_lastname,
		'reportType'   => $_POST['reportType'],
		'titleLines'   => [
			'FIRME PENTRU CARE EXISTĂ FACTURI DE ÎNTOCMIT ÎN PERIOADA',
			$oIntervalStart->format('d.m.Y') . ' - ' . $oIntervalEnd->format('d.m.Y')
		]	
	];


	$pdf  		 = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$aUploadDir  = wp_upload_dir();
	$path 		 = $aUploadDir['basedir'].'/reports/';
	$pdf->checkPath($path);
	$pdf->setPDFDetails($reportDetails);
	$pdf->printTitle($reportDetails['titleLines']);

	$headerData = [
		['width' => 10, 'string' => '#'],
		['width' => 60, 'string' => 'Firma'],
		['width' => 60, 'string' => 'Perioada de facturare'],
		['width' => 50, 'string' => 'Data de emitere a facturii'],
	];

	$pdf->printTableHeader($headerData);
	$pdf->SetFont('freesans', '', 8);

	$posts = getAllCompanies();
	$rows = [];

	foreach ($posts as $post) {
		$oContractStartDate = DateTime::createFromFormat('Y/m/d', get_post_meta($post->ID, 'kik_company_contract_date', true));
		$oIntervalFacturare = wp_get_object_terms($post->ID, 'kik_perioada_de_facturare')[0];
		$interval = getFrequencyInterval($oIntervalFacturare->name);

		if($oContractStartDate === false) {
			continue;
		};
		
		// calculate the interval to add $contractStartDate as close as possible to the 
		// interval introduced by the user
		$addYears = $oIntervalStart->format('Y') - $oContractStartDate->format('Y') - 1;
		if ($addYears > 0) {
			$oContractStartDate = $oContractStartDate->add(new DateInterval('P' . $addYears . 'Y'));
		}
				
		$oContractStartDate = $oContractStartDate->add(new DateInterval($interval));
		
		while($oContractStartDate <= $oIntervalEnd){
			if($oContractStartDate >= $oIntervalStart && $oContractStartDate <= $oIntervalEnd){
				$counter++;
				$rows[] = [
					['width' => 10, 'string' => $counter],
					['width' => 60, 'string' => $post->post_title], 
					['width' => 60, 'string' => wp_get_post_terms($post->ID, 'kik_perioada_de_facturare')[0]->name], 
					['width' => 50, 'string' => $oContractStartDate->format('d-m-Y')], 
				];
			}

			$oContractStartDate = $oContractStartDate->add(new DateInterval($interval));
		}
	}

	if (count($rows) == 0) {
		$optionalParams = ['formName' => $_POST['form_name']];
		returnError('Nu au fost găsite informații pentru perioada menționată!', $optionalParams);
	}

	foreach ($rows as $dataRow) {
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


function validatePostDataFacturi($post)
{
	$optionalParams = ['formName' => $post['form_name']];
	validateDateInterval(
		$post['kik_report_facturi_data_inceput'], 
		$post['kik_report_facturi_data_sfarsit'],
		['formName' => $post['form_name']]
	);
}







/**/

?>