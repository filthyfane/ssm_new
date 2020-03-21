<?php 


// AJAX FUNCTION CALLED ON SAVE REPORT
add_action('wp_ajax_KIK_ACTION_Save_New_Pdf', 'KIK_ACTION_Save_New_Pdf');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_New_Pdf', 'KIK_ACTION_Save_New_Pdf');

function KIK_ACTION_Save_New_Pdf(){	
	$currUser 	 = wp_get_current_user();
	$textToPrint = str_replace('\\', '', $_POST['pdfText']);
	$aUploadDir  = wp_upload_dir();
	$path        = $aUploadDir['basedir'].'/reports/';
	
	//Create the directory reports if it not exists
	if (!is_dir($path) ){
		mkdir($path);
	} 
	
	$postID 	= isset($_POST['companyID']) ? $_POST['companyID'] : $_POST['currPostID'];
	$date 		= new DateTime();
	$timestamp 	= $date->format('U');
	
	
	$raport = array(
		'userId' 	 => $currUser->ID,
		'reportType' => $_POST['reportType'],
		'fileName' 	 => $_POST['fileName'].'_'.$timestamp,
		'createDate' => $timestamp
	);
	
	if(isset($_POST['startDate']) && isset($_POST['endDate'])){
		$raport['startDate'] = $_POST['startDate'];
		$raport['endDate']   = $_POST['endDate'];
	}

	
	
	// create new PDF document
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor($currUser->user_firstname . " " . $currUser->user_lastname);
	$pdf->SetTitle($raport["fileName"]);
	$pdf->SetSubject("Raport SSM");

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $raport["fileName"], PDF_HEADER_STRING);

	// set header and footer fonts
	$pdf->SetFont('freesans', '', 8);
	//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setHeaderFont(Array('freesans', '', 8));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set dynamic margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	    require_once(dirname(__FILE__).'/lang/eng.php');
	    $pdf->setLanguageArray($l);
	}

	// set font
	$pdf->SetFont('freesans', 'B', 20);

	// add a page
	if($_POST['reportType'] == 'Raport-semestrial') {
		$pdf->AddPage('L');
	} else {
		$pdf->AddPage();
	}

	$pdf->SetFont('freesans', '', 8);
	$pdf->writeHTML($textToPrint, true, false, false, false, '');

	//Close and output PDF document
	$pdf->Output($path.$raport['fileName'].'.pdf', 'F');

	//SAVE REPORT TO THE CORRESPONDING COMPANY
	add_post_meta($postID, 'rapoarte', serialize($raport));

	$response = [
		'success' => true,
		'pdfUrl'  => $aUploadDir['baseurl'] . '/reports/' . $raport['fileName'].'.pdf',
		'pdfName' => $raport['fileName']
	];
	
	echo json_encode($response);
	wp_die();
}

?>