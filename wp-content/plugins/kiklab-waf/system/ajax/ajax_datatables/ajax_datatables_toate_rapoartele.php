<?php

	add_action('wp_ajax_ajax_datatable_toate_rapoartele', 'ajax_datatable_toate_rapoartele');
	add_action('wp_ajax_nopriv_ajax_datatable_toate_rapoartele', 'ajax_datatable_toate_rapoartele');
	
	function ajax_datatable_toate_rapoartele(){
		
		$kik_ID  	  = $_POST['postId'];
		$reports 	  = get_post_meta($kik_ID, 'rapoarte', false);
		$data_reports = array();
		
		if (sizeof($reports) > 0){
			foreach($reports as $report){
				$report 	 = unserialize($report);
				$data_row 	 = array();
				$oUser 		 = get_userdata($report['userId']);
				$oCreateDate = DateTime::createFromFormat('U', $report['createDate']); 
				$aUploadDir  = wp_upload_dir();
				$pdfSource   = esc_url($aUploadDir['baseurl']."/reports/".$report['fileName'].".pdf");
				$reportType  = str_replace('-', ' ', $report['reportType']);
				
				if(isset($report['startDate']) && isset($report['endDate'])){
					$reportType.= ' ('.$report['startDate'].'-'.$report['endDate'].')';
				}
				
				$data_row[] = $reportType;
				$data_row[] = '<span class="hide">'.$oCreateDate->getTimestamp().'</span>'.$oCreateDate->format('d.m.Y H:i:s');
				$data_row[] = $oUser->last_name.' '.$oUser->first_name;
				$data_row[] = '<a class="pdf-anchor" href="' . $pdfSource . '" target="_blank">
								<img class="pdf-img" src="' . KIK_PLUGIN_URLPATH . 'img/pdf.png' . '">
								<span class="pdf-link">Descarcă</span>
							</a>';
				$data_reports['data'][] = $data_row;
			}
			
		} else {
			$data_reports['data'] = array();
		}
		
		echo json_encode($data_reports);

		
		wp_die();
		
	}
?>