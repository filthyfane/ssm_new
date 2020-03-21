<?php 

require_once(KIK_PLUGIN_ABSPATH . '/plugins/tcpdf/tcpdf.php');

//////////////////////////////TCPDF//////////////////////////////////////////////
class MYPDF extends TCPDF {
	const PDF_SUBJECT = "Raport SSM";
	const PDF_NEW_MARGIN_BOTTOM = 10;

	public function setPDFDetails($pdfDetails)
	{
		// set document information
		$this->SetCreator(PDF_CREATOR);
		$this->SetAuthor($pdfDetails['userFullName']);
		$this->SetTitle($pdfDetails["fileName"]);
		$this->SetSubject(self::PDF_SUBJECT);

		// set default header data
		$this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $pdfDetails["fileName"], PDF_HEADER_STRING);

		// set header and footer fonts
		$this->SetFont('freesans', '', 8);
		$this->setHeaderFont(Array('freesans', '', 8));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set dynamic margins
		$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$this->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$this->SetAutoPageBreak(TRUE, self::PDF_NEW_MARGIN_BOTTOM);
		// $this->SetAutoPageBreak(FALSE);

		// set image scale factor
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $this->setLanguageArray($l);
		}

		// add a page
		if($pdfDetails['reportType'] == 'Raport-semestrial') {
			$this->AddPage('L');
		} else {
			$this->AddPage();
		}
	}

	public function checkPath($path) {
		if(!is_dir($path)){
			mkdir($path);
		} 
	}

    //Page header
    public function Header() {
    	$text = "Denumirea: " . get_option("kikCompanyName") . "\r\n"
    		. "Sediu: " . get_option("kikRegisteredOffice") . "\r\n"
			. "Cod Poștal: " . get_option("kikPostalCode") . "\r\n"
			. "Localitate: " . get_option("kikCity") . "\r\n"
			. "Cod unic de înregistrare: " . get_option("kikCompanyCui") . "\r\n"
			. "Număr RECOM: " . get_option("kikCompanyRecom") . "\r\n";

		// add header text
        $this->Multicell(0, $this->getStringHeight(0, $text) + 2, $text, 0, 'L', false, 1);

		if ($this->header_xobjid === false) {
			// start a new XObject Template
			$this->header_xobjid = $this->startTemplate($this->w, $this->tMargin);
			$headerfont = $this->getHeaderFont();
			$headerdata = $this->getHeaderData();
			$this->x = $this->original_lMargin;
			
			// set starting margin for text data cell
			$header_x = $this->original_lMargin + ($headerdata['logo_width'] * 1.1);
			
			$this->SetX($this->original_lMargin);	
			$this->endTemplate();
		}
		
		// print an ending header line
		$this->SetLineStyle(array(
			'width' => 0.85 / $this->k,
			'cap' => 'butt', 
			'join' => 'miter', 
			'dash' => 0, 
			'color' => $headerdata['line_color']
		));
		$this->Cell(($this->w - $this->original_lMargin - $this->original_rMargin), 0, '', 'T', 0, 'C');
			

		// set custom header height
		$this->SetMargins(PDF_MARGIN_LEFT, $this->y, PDF_MARGIN_RIGHT);

		// print header template
		$x = 0;
		$dx = 0;

		if ($this->rtl) {
			$x = $this->w + $dx;
		} else {
			$x = 0 + $dx;
		}
		
		$this->printTemplate($this->header_xobjid, $x, $this->y, 0, 0, '', '', false);
		if ($this->header_xobj_autoreset) {
			// reset header xobject template at each page
			$this->header_xobjid = false;
		}
    }

    public function getTabelRowMaxHeight($data)
    {
    	$maxHeight = 0;
    	foreach ($data as $cellData) {
    		$cellHeight = $this->getStringHeight($cellData['width'], $cellData['string'], false, true, 0, 1);
    		if ($cellHeight > $maxHeight) {
    			$maxHeight = $cellHeight;
    		}
    	}
    	return $maxHeight;
    }

    public function printTableHeader($data)
    {
    	$this->SetFont('freesans', 'B', 8);
    	$this->setY($this->getY() + 7);

    	$rowHeight = $this->getTabelRowMaxHeight($data);
    	$lastKey = end(array_keys($data));

    	foreach($data as $key => $dataHeader){
    		$ln = $key == $lastKey ? 1 : 0;
			$this->MultiCell($dataHeader['width'], $rowHeight, $dataHeader['string'], 1, 'C', false, $ln, '', '', true, 0, false, true, $rowHeight, 'M');
    	}
    	
    	$this->SetFont('freesans', '', 8);
    }

    public function printTableRow($dataRow, $headerData)
    {
    	$height = $this->getTabelRowMaxHeight($dataRow);
		$bottom = $this->getPageHeight() - self::PDF_NEW_MARGIN_BOTTOM - 5;

		$this->startTransaction();
		
    	$lastKey = end(array_keys($dataRow));
    	foreach($dataRow as $key => $row){
    		$ln = $key == $lastKey ? 1 : 0;

			$this->Multicell($row['width'], $height, $row['string'], 1, 'L', false, $ln, '', '', true, 0, false, true, $height, 'M');
    	}

		if ($this->getY() > $bottom) {
			// use true as param or $pdf = $pdf->rollBackTransaction();
			$this->rollbackTransaction(true);
			
			$this->addPage();

			$this->printTableHeader($headerData);
			$this->printTableRow($dataRow, $height);
		} else {
			$this->commitTransaction();
		}
		
    }

    public function printTitle($titleLines)
    {
		$this->SetFont('freesans', 'B', 12);
		$this->setY($this->getY() + 10);

		foreach ($titleLines as $titleLine) {
			$this->Write(0, $titleLine, '', false, 'C', true);
		}
    }
}