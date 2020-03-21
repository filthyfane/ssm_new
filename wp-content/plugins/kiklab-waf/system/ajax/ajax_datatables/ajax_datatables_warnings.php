<?php

	add_action('wp_ajax_ajax_datatables_warnings', 'ajax_datatables_warnings');
	add_action('wp_ajax_nopriv_ajax_datatables_warnings', 'ajax_datatables_warnings');
	
	function ajax_datatables_warnings(){
		global $wpdb;
		
		/* $data = [];
		$date = new DateTime();
		$startDate = $date->format('Y/m/d');
		$date->add(new DateInterval('P14D'));
		$endDate = $date->format('Y/m/d');
		$is_admin = false;
		$currUser = wp_get_current_user();

		foreach($currUser->roles as $role){
			if($role == 'administrator'){
				$is_admin = true;
			}
		}
		
		$data = getCssmNotifications($startDate, $endDate, $currUser, $is_admin, $data);
		$data = getEquipmentNotifications($startDate, $endDate, $currUser, $is_admin, $data);
	
		
		echo json_encode($data); */
		wp_die();	
	}
	
	/**
	* Search and return CSSM Meetings for the next 2 weeks
	*
	*  string $startDate
	*  string $endDate
	*  obj	  $currUser
	*  bool   $is_admin
	*  array  $data
	*/
	/* function getCssmNotifications($startDate, $endDate, $currUser, $is_admin, $data){
		$args = [
			'post_type' => 'kik_cssm',
			'meta_query' => [
				'relation' => 'AND',
				'completed' => [
					'key' => 'realizat',
					'value' => 0,
					'compare' => '='
				],
				'startDate' => [
					'key' => 'dataSedintei',
					'value' => $startDate,
					'compare' => '>='
				],
				'endDate' => [
					'key' => 'dataSedintei',
					'value' => $endDate,
					'compare' => '<='
				],
				
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
				$cssmDate		   = get_post_meta(get_the_ID(), 'dataSedintei', true);
				$dataSedintei	   = DateTime::createFromFormat('Y/m/d', $cssmDate);
				
				if($currUser->ID != $companyInspector && !$currUser->ID != $companySalesAgent && !$is_admin){
					continue;
				}
				
				$dataRow[] = $company->post_title;
				$dataRow[] = 'Ședință CSSM';
				$dataRow[] = $dataSedintei->format('d/m/Y');
				$dataRow[] = '';
				
				$data['data'][] = $dataRow;
				
			}
			wp_reset_postdata();
		}
		
		return $data;
	}
 */
	/* function getEquipmentNotifications($startDate, $endDate, $currUser, $is_admin, $data){

		 $args = [
			'post_type' => 'kik_equipment',
			'meta_query' => [
				'relation' => 'AND',
				'startDate' => [
					'key' => 'dataExpirare',
					'value' => $startDate,
					'compare' => '>='
				],
				'endDate' => [
					'key' => 'dataExpirare',
					'value' => $endDate,
					'compare' => '<='
				],
				
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
					var_dump($dataIscir);
					continue;
				}
				
				$dataExpEchipament	= DateTime::createFromFormat('Y/m/d', $dataEchipament);
				$dataExpIscir		= DateTime::createFromFormat('Y/m/d', $dataIscir);
				
				$dataRow[] = $company->post_title;
				$dataRow[] = 'Expirare echipament';
				$dataRow[] = $dataExpEchipament->format('d/m/Y');
				$dataRow[] = '';
				
				$data['data'][] = $dataRow;
				
				if($dataExpIscir->format('Y/m/d') >= $startDate && $dataExpIscir->format('Y/m/d') <= $endDate){
					
					$dataRow = [];
					$dataRow[] = $company->post_title;
					$dataRow[] = 'Expirare ISCIR echipament';
					$dataRow[] = $dataExpIscir->format('d/m/Y');
					$dataRow[] = '';
					$data['data'][] = $dataRow;
				}
			}
			wp_reset_postdata();
		} 

		return $data;
	} */
?>