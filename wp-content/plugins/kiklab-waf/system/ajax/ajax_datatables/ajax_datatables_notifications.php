<?php

	add_action('wp_ajax_ajax_datatables_notifications', 'ajax_datatables_notifications');
	add_action('wp_ajax_nopriv_ajax_datatables_notifications', 'ajax_datatables_notifications');
	
	function ajax_datatables_notifications(){
		global $wpdb;
		
		$data 		= [];
		$date 		= new DateTime();
		$startDate 	= $date->format('Y/m/d');
		$date->add(new DateInterval('P14D'));
		$endDate 	= $date->format('Y/m/d');
		$is_admin 	= checkIfCurrUserIsAdmin();
		
		$data = getCssmNotifications($startDate, $endDate, $currUser, $is_admin, $data);
		$data = getEquipmentNotifications($startDate, $endDate, $currUser, $is_admin, $data);
		$data = getInstructajNotifications($startDate, $endDate, $currUser, $is_admin, $data);
		
		if (empty($data)) {
			$data['data'] = '';
		}
	
		echo json_encode($data);
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
	function getCssmNotifications($startDate, $endDate, $currUser, $is_admin, $data){
		$args = [
			'post_type' => 'kik_cssm',
			'meta_query' => [
				'relation' => 'AND',
				[
					'key' => 'dataSedintei',
					'value' => $startDate,
					'compare' => '>=',
				],
				[
					'key' => 'dataSedintei',
					'value' => $endDate,
					'compare' => '<=',
				],
				
			]
		];
		
		$query = new WP_Query($args);
		
		if($query->have_posts()){
			while($query->have_posts()){
				$query->the_post();

				$dataRow = [];
				$companyID = wp_get_post_parent_ID(get_the_ID());
				$company = get_post($companyID);
				
				$companyInspector  = get_post_meta($company->ID, 'kik_company_inspector', true);
				$companySalesAgent = get_post_meta($company->ID, 'kik_company_sales_agent', true);
				$cssmDate		   = get_post_meta(get_the_ID(), 'dataSedintei', true);
				$dataSedintei	   = DateTime::createFromFormat('Y/m/d', $cssmDate);
				
				if($currUser->ID != $companyInspector && !$currUser->ID != $companySalesAgent && !$is_admin){
					continue;
				}
				
				if($currUser->ID != get_post_meta($companyID, 'kik_company_inspector', true) && !$is_admin){
					continue;
				}
				
				$dataRow[] = $company->post_title;
				$dataRow[] = 'Ședință CSSM';
				$dataRow[] = '<span class="hide">'.$dataSedintei->getTimestamp().'</span>'. $dataSedintei->format('d/m/Y');
				$dataRow[] = '';
				if(!(defined( 'DOING_AJAX' ) && DOING_AJAX) && $is_admin){
					$inspectorId = get_post_meta($companyID, 'kik_company_inspector', true);
					$oInspector  = get_user_by('id', $inspectorId);
					$dataRow[]   = ucfirst($oInspector->first_name) . ' ' . ucfirst($oInspector->last_name);
				}
				
				$data['data'][] = $dataRow;
				
			}
			wp_reset_postdata();
		}
		
		return $data;
	}

	function getEquipmentNotifications($startDate, $endDate, $currUser, $is_admin, $data){
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
		
		// GET DATA FOR EXPIRED EQUIPMENT
		if($query->have_posts()){
			while($query->have_posts()){
				$query->the_post();
				
				$dataRow = [];
				$companyID = wp_get_post_parent_ID(get_the_ID());
				$company = get_post($companyID);
				
				$companyInspector  = get_post_meta($company->ID, 'kik_company_inspector', true);
				$companySalesAgent = get_post_meta($company->ID, 'kik_company_sales_agent', true);
				$dataEchipament	   = get_post_meta(get_the_ID(), 'dataExpirare', true);
				$equipmentTermId   = get_post_meta(get_the_ID(), 'idEchipament', true);
				$equipmentTerm	   = get_term($equipmentTermId, 'kik_echipamente');
				
				if($currUser->ID != $companyInspector && !$currUser->ID != $companySalesAgent && !$is_admin){
					continue;
				}
				
				if($currUser->ID != get_post_meta($companyID, 'kik_company_inspector', true) && !$is_admin){
					continue;
				}
				
				$dataExpEchipament	= DateTime::createFromFormat('Y/m/d', $dataEchipament);
				
				$dataRow[] = $company->post_title;
				$dataRow[] = 'Expirare echipament';
				$dataRow[] = '<span class="hide">'.$dataExpEchipament->getTimestamp().'</span>'. $dataExpEchipament->format('d/m/Y');
				$dataRow[] = $equipmentTerm->name;
				// add Inspector name to table send to users
				if(!(defined( 'DOING_AJAX' ) && DOING_AJAX) && $is_admin){
					$dataRow[] = ucfirst($currUser->first_name) . ' ' . ucfirst($currUser->last_name);
				}
				
				$data['data'][] = $dataRow;
			}
			wp_reset_postdata();
		} 
		
		$args = [
			'post_type' => 'kik_equipment',
			'meta_query' => [
				'relation' => 'AND',
				'startDate' => [
					'key' => 'dataExpIscir',
					'value' => $startDate,
					'compare' => '>='
				],
				'endDate' => [
					'key' => 'dataExpIscir',
					'value' => $endDate,
					'compare' => '<='
				],
				
			]
		];
		
		$query = new WP_Query($args);

		//GET DATA FOR EXPIRED ISCIR
		if($query->have_posts()){
			while($query->have_posts()){
				$query->the_post();
				
				$dataRow = [];
				$companyID = wp_get_post_parent_id(get_the_ID());
				$company = get_post($companyID);
				
				$companyInspector  = get_post_meta($company->ID, 'kik_company_inspector', true);
				$companySalesAgent = get_post_meta($company->ID, 'kik_company_sales_agent', true);
				$dataIscir		   = get_post_meta(get_the_ID(), 'dataExpIscir', true);
				$equipmentTermId   = get_post_meta(get_the_ID(), 'idEchipament', true);
				$equipmentTerm	   = get_term($equipmentTermId, 'kik_echipamente');				
				
				if($currUser->ID != $companyInspector && $currUser->ID != $companySalesAgent && !$is_admin){
					continue;
				}
				if($currUser->ID != get_post_meta($companyID, 'kik_company_inspector', true) && !$is_admin){
					continue;
				}
				
				$dataExpIscir		= DateTime::createFromFormat('Y/m/d', $dataIscir);
				
				$dataRow[] = $company->post_title;
				$dataRow[] = 'Expirare ISCIR echipament';
				$dataRow[] = '<span class="hide">'.$dataExpIscir->getTimestamp().'</span>'. $dataExpIscir->format('d/m/Y');
				$dataRow[] = $equipmentTerm->name;
				if(!(defined( 'DOING_AJAX' ) && DOING_AJAX) && $is_admin){
					$dataRow[] = ucfirst($currUser->first_name) . ' ' . ucfirst($currUser->last_name);
				}
				
				$data['data'][] = $dataRow;
			}
			wp_reset_postdata();
		} 

		return $data;
	}

	function getInstructajNotifications($startDate, $endDate, $currUser, $is_admin, $data){
		$args = [
			'post_type' => 'kik_instructaj',
			'meta_query' => [
				'relation' => 'AND',
				'startDate' => [
					'key' => 'dataInstructajului',
					'value' => $startDate,
					'compare' => '>='
				],
				'endDate' => [
					'key' => 'dataInstructajului',
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
				$companyID = wp_get_post_parent_ID(get_the_ID());
				$company = get_post($companyID);
				
				$companyInspector   = get_post_meta($company->ID, 'kik_company_inspector', true);
				$companySalesAgent  = get_post_meta($company->ID, 'kik_company_sales_agent', true);
				$dataInstructajului = get_post_meta(get_the_ID(), 'dataInstructajului', true);
				$oDataInstructaj	= DateTime::createFromFormat('Y/m/d', $dataInstructajului);
				$instructajSlug	    = get_post_meta(get_the_ID(), 'tipInstructaj', true);
				$instructajTerm     = get_term_by('slug', $instructajSlug, 'kik_tipuri_instructaj');
				
				if($currUser->ID != $companyInspector && !$currUser->ID != $companySalesAgent && !$is_admin){
					continue;
				}
				
				if($currUser->ID != get_post_meta($companyID, 'kik_company_inspector', true) && !$is_admin){
					continue;
				}
				
				$dataRow[] = $company->post_title;
				$dataRow[] = 'Programare instructaj';
				$dataRow[] = '<span class="hide">'.$oDataInstructaj->getTimestamp().'</span>'. $oDataInstructaj->format('d/m/Y');
				$dataRow[] = $instructajTerm->name;
				if(!(defined( 'DOING_AJAX' ) && DOING_AJAX) && $is_admin){
					$dataRow[] = ucfirst($currUser->first_name) . ' ' . ucfirst($currUser->last_name);
				}
				
				$data['data'][] = $dataRow;
			}
			wp_reset_postdata();
		}
		
		return $data;
	}
?>