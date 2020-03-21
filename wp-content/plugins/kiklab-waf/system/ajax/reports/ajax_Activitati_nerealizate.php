<?php


##### REPORTS: Instructaje nerealizate
add_action('wp_ajax_KIK_ACTION_Activitati_nerealizate', 'KIK_ACTION_Activitati_nerealizate_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Activitati_nerealizate', 'KIK_ACTION_Activitati_nerealizate_FUNC');
function KIK_ACTION_Activitati_nerealizate_FUNC() {
	
	global $wpdb;

	validatePostDataActiviatiNerealizate($_POST);
		
	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_act_nerealizate_data_inceput']);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_act_nerealizate_data_sfarsit']);
	$queryData		= getInstructajeNerealizate($oIntervalStart, $oIntervalEnd);
	$response		= array('status' => 'success', 'table' => '.rap-act-nerealizate');
	$counter		= 0;
	$oInsp			= $_POST['kik_act_nerealizate_inspector'] ? get_userdata($_POST['kik_act_nerealizate_inspector']) : null;
	$currUser 	 	= wp_get_current_user();
	$postID 		= $_POST['currPostID'];
	$timestamp 		= (new DateTime())->format('U');

	if(count($queryData) == 0){
		$optionalParams = ['form_name'	=> $_POST['form_name']];
		returnError('Nu au fost găsite activități pentru perioada menționată!', $optionalParams);
	} 
	
	$reportDetails = [
		'fileName' 	   => 'tmp_' . $_POST['fileName'].'_'.$timestamp,
		'createDate'   => $timestamp,
		'userFullName' => $currUser->user_firstname . " " . $currUser->user_lastname,
		'reportType'   => $_POST['reportType'],
		'titleLines'   => [
			'ACTIVITĂȚI NEREALIZATE ÎN PERIOADA',
			$_POST['kik_act_nerealizate_data_inceput'] . ' - ' . $_POST['kik_act_nerealizate_data_sfarsit']
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
		['width' => 55, 'string' => 'Firma'],
		['width' => 25, 'string' => 'Data angajarii'],
		['width' => 45, 'string' => 'Tip instructaj'],
		['width' => 40, 'string' => 'Nume angajat'],
	];

	$pdf->printTableHeader($headerData);
	$pdf->SetFont('freesans', '', 8);

	foreach($queryData as $instr){
		$counter++;

		$oDataInstr 	= DateTime::createFromFormat('Y/m/d', get_post_meta($instr->ID, 'dataInstructajului', true));
		$oCompany   	= get_post($instr->post_parent);
		$coInspId   	= get_post_meta($oCompany->ID, 'kik_company_inspector', true);
		$oCoInsp		= get_userdata($coInspId);
		$tipInstructaj 	= get_post_meta($instr->ID, 'tipInstructaj', true);
		$oTipInstructaj = get_term_by('slug', $tipInstructaj, 'kik_tipuri_instructaj');

		$coInspFullName = 'Nu există inspector asociat!';
		if (!is_null($coInspId)) {
			$coInspFullName = $oCoInsp->first_name.' '.$oCoInsp->last_name;
		}

		// exclude lines if the company inspector is not the selected inspector
		if(!is_null($oInsp) && !is_null($oCoInsp) && $oInsp->ID != $coInspId){
			continue;
		}

		$dataRow = [
			['width' => 10, 'string' => $counter],
			['width' => 55, 'string' => $oCompany->post_title], 
			['width' => 25, 'string' => $oDataInstr->format('d/m/Y')],
			['width' => 45, 'string' => $oTipInstructaj->name],
			['width' => 40, 'string' => $coInspFullName], 
		];

		$pdf->printTableRow($dataRow, $headerData);
	}

	//Close and output PDF document
	$pdf->Output($path.$reportDetails['fileName'].'.pdf', 'F');

	//SAVE REPORT TO THE CORRESPONDING COMPANY
	add_post_meta($postID, 'rapoarte', serialize($reportDetails));

	$response = [
		'success'  => true,
		'pdfUrl'   => $aUploadDir['baseurl'] . '/reports/' . $reportDetails['fileName'].'.pdf',
		'pdfName'  => $reportDetails['fileName'],
		'formName' => $_POST['form_name']
	];
	
	echo json_encode($response);
	wp_die();
} 

function validatePostDataActiviatiNerealizate($post)
{
	$extraParams = ['formName' => $post['form_name']];
	validateDateInterval(
		$post['kik_act_nerealizate_data_inceput'],
		$post['kik_act_nerealizate_data_sfarsit'],
		$extraParams
	);
}

?>