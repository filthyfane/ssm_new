<?php

	add_action('wp_ajax_ajax_datatables_alerts', 'ajax_datatables_alerts');
	add_action('wp_ajax_nopriv_ajax_datatables_alerts', 'ajax_datatables_alerts');
	
	function ajax_datatables_alerts(){
		global $wpdb;
		
		$data 	  = [];
		$currDate = new DateTime();
		$is_admin = checkIfCurrUserIsAdmin();
		
		$data = getExpiredTrainings($data, $currDate, $currUser, $is_admin);
		$data = getExpiredCssm($data, $currDate, $currUser, $is_admin);
		//$data = getExpiredEquipments($data, $currDate, $currUser, $is_admin);
		
		if (empty($data)) {
			$data['data'] = '';
		}
		
		echo json_encode($data);
		wp_die();
	}
	
	function getExpiredTrainings($data, $currDate, $currUser, $is_admin){
		$args = [
			'post_type' => 'kik_instructaj',
			'meta_query' => [
				'relation' => 'AND',
				'dataInstructajului' => [
					'key' => 'dataInstructajului',
					'value' => $currDate->format('Y/m/d'),
					'compare' => '<'
				],
				'dataRealizariiExists' => [
					'key' => 'dataRealizarii',
					'value' => '',
					'compare' => '!='
				] 
			]
		];
		
		$query = new WP_Query($args);
		
		if($query->have_posts()){
			while($query->have_posts()){
				$query->the_post();

				$dataRow	= [];
				$companyID 	= wp_get_post_parent_ID();
				$company 	= get_post($companyID);
				
				$companyInspector  	 = get_post_meta($company->ID, 'kik_company_inspector', true);
				$companySalesAgent 	 = get_post_meta($company->ID, 'kik_company_sales_agent', true);
				$dataInstructajului  = get_post_meta(get_the_ID(), 'dataInstructajului', true);
				$oDataInstructajului = DateTime::createFromFormat('Y/m/d', $dataInstructajului);
				
				if($currUser->ID != $companyInspector && !$currUser->ID != $companySalesAgent && !$is_admin){
					continue;
				}
				
				$dataRow['company'] = $company->post_title;
				$dataRow['alertType'] = 'Data instructajului depășită';
				$dataRow['scheduledDate'] = [
					'display' => $oDataInstructajului->format('d-m-Y'),
					'timestamp' => $oDataInstructajului->getTimestamp()
				];
				$dataRow['overdue'] = [
					'display' => $currDate->diff($oDataInstructajului)->format('%a zile'),
					'nbrDays' => $currDate->diff($oDataInstructajului)->format('%a')
				];
				
				$data['data'][] = $dataRow;
				
			}
			wp_reset_postdata();
		}

		return $data;
	}
	
	function getExpiredCssm($data, $currDate, $currUser, $is_admin){
		$args = [
			'post_type' => 'kik_cssm',
			'meta_query' => [
				'relation' => 'AND',
				[
					'key' => 'realizat',
					'value' => 0,
					'compare' => '='
				],
				[
					'key' => 'dataSedintei',
					'value' => $currDate->format('Y/m/d'),
					'compare' => '<'
				],
			]
		];
		
		$query = new WP_Query($args);
		
		if($query->have_posts()){
			while($query->have_posts()){
				$query->the_post();
				
				$dataRow	= [];
				$companyID 	= wp_get_post_parent_ID();
				$company 	= get_post($companyID);
				
				$companyInspector  	= get_post_meta($company->ID, 'kik_company_inspector', true);
				$companySalesAgent 	= get_post_meta($company->ID, 'kik_company_sales_agent', true);
				$cssmDate		    = get_post_meta(get_the_ID(), 'dataSedintei', true);
				$oCssmDate		    = DateTime::createFromFormat('Y/m/d', $cssmDate);
				
				if($currUser->ID != $companyInspector && !$currUser->ID != $companySalesAgent && !$is_admin){
					continue;
				}
				
				$dataRow['company'] = $company->post_title;
				$dataRow['alertType'] = 'Data CSSM depășită';
				$dataRow['scheduledDate'] = [
					'display' => $oCssmDate->format('d-m-Y'),
					'timestamp' => $oCssmDate->getTimestamp()
				];
				
				$dataRow['overdue'] = [
					'display' => $currDate->diff($oCssmDate)->format('%a zile'),
					'nbrDays' => $currDate->diff($oCssmDate)->format('%a')
				];
				
				$data['data'][] = $dataRow;
			}
			wp_reset_postdata();
		}
		
		return $data;
	}

	function getExpiredEquipments($data, $currDate, $currUser, $is_admin){
		$args = [
			'post_type' => 'kik_equipment',
			'meta_query' => [
				[
					'key' => 'dataExpirare',
					'value' => $currDate->format('Y/m/d'),
					'compare' => '<'
				]
			]
		];
		
		$query = new WP_Query($args);
		
		if($query->have_posts()){
			while($query->have_posts()){
				$query->the_post();

				$dataRow = [];
				$companyID = wp_get_post_parent_ID();
				$company = get_post($companyID);
				
				$companyInspector  = get_post_meta($company->ID, 'kik_company_inspector', true);
				$companySalesAgent = get_post_meta($company->ID, 'kik_company_sales_agent', true);
				$dataEchipament	   = get_post_meta(get_the_ID(), 'dataExpirare', true);
				$dataIscir		   = get_post_meta(get_the_ID(), 'dataExpIscir', true);
				
				if($currUser->ID != $companyInspector && !$currUser->ID != $companySalesAgent && !$is_admin){
					continue;
				}
				
				$oDataEchipament = DateTime::createFromFormat('Y/m/d', $dataEchipament);
				$oDataIscir		 = DateTime::createFromFormat('Y/m/d', $dataIscir);
				
				$dataRow[] = $company->post_title;
				$dataRow[] = 'Data verificare echipament depășită';
				$dataRow[] = '<span class="hide">'.$oDataEchipament->getTimestamp().'</span>'. $oDataEchipament->format('d-m-Y');
				$dataRow[] = $currDate->diff($oDataEchipament)->format('%a zile');
				
				$data['data'][] = $dataRow;
				
				if($oDataIscir && $oDataIscir->format('Y/m/d') < $currDate->format('Y/m/d')){
					$dataRow = [];
					$dataRow[] = $company->post_title;
					$dataRow[] = 'Data verificare ISCIR depășită';
					$dataRow['scheduledDate'] = [
						'' => $oDataIscir->format('d-m-Y'),
						'' => $oDataIscir->getTimestamp()
					];
					$dataRow['overdue'] = [
						'display' => $currDate->diff($oDataIscir)->format('%a zile'),
						'order' => $currDate->diff($oDataIscir)->format('%a')
					];
					$data['data'][] = $dataRow;
				} 
			}
			wp_reset_postdata();
		} 

		return $data;
	}
	
?>