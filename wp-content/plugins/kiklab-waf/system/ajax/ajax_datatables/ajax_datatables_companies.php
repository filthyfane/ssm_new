<?php

	add_action('wp_ajax_ajax_datatables_companies', 'ajax_datatables_companies');
	add_action('wp_ajax_nopriv_ajax_datatables_companies', 'ajax_datatables_companies');
	
	function ajax_datatables_companies(){
		
		$currUser = wp_get_current_user();
		$currUserId = $currUser->ID;
		$currUserRoles = $currUser->roles;
		$data = [];
		
		$meta_query = [];
		if(in_array('kik_inspector_ssm', $currUserRoles)){
			$meta_query[] = array(
				'key' => 'kik_company_inspector',
				'value' => $currUsr->ID
			);
		}
		if(in_array('kik_agent_de_vanzari', $currUserRoles)){
			$meta_query[] = array(
				'key' => 'kik_company_sales_agent',
				'value' => $currUsr->ID
			);
		}
		if(sizeof($meta_query) > 1){
			$meta_query['relation'] = 'OR';
		}
		
		$args = [
			'post_type' => 'kik_company',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
		];
		$companies = get_posts($args);
		
		if (count($companies)>0){
			foreach($companies as $company){
				$data_row = [];
				
				$cif = get_post_meta($company->ID, 'kik_company_cif', true);
				$reg = get_post_meta($company->ID, 'kik_company_reg', true);
				$kik_notifications = get_option('kik_notifications') ? CountObjectDeepestChildren(get_option('kik_notifications')['by_id'][$company->ID]) : '';
				$kik_alerts_bills = get_option('kik_alerts_bills') ? CountObjectDeepestChildren(get_option('kik_alerts_bills')['by_id'][$company->ID]) : '';
				$notifications_trainings = get_post_meta($company->ID, 'notifications_trainings', true);
				$notifications_exp_equip = get_post_meta($company->ID, 'notifications_exp_equip', true);
				$alerts_exp_equip 		 = get_post_meta($company->ID, 'alerts_exp_equip', true);
				$alerts_bills			 = get_post_meta($company->ID, 'alerts_bills', true);
				
				$notif_trainings_html = !$notifications_trainings 
					? ''
					: ' <div class="kik-data-square bg-info" title="'. $notifications_trainings .' notificări instructaj!">' .
							$notifications_trainings . '
						</div>';
						
				$notif_exp_equip_html = !notifications_exp_equip
					? ''
					: ' <div class="kik-data-square bg-info" title="'. $notifications_exp_equip .' notificări echipamente!">' .
							$notifications_exp_equip .'
						</div>';
				
				$alerts_exp_equip_html = !$alerts_exp_equip
					? ''
					: ' <div class="kik-data-square bg-alert" title="'. $alerts_exp_equip .' alerte echipamente!">' .
							$alerts_exp_equip .'
						</div>';
				
				$alerts_bills_html = !alerts_bills
					? ''
					: ' <div class="kik-data-square bg-alert" title="'. $alerts_bills .' alerte facturi!">' . 
							$alerts_bills .'
						</div>';
				
				$periodicitateInstructaje = wp_get_object_terms($company->ID, 'kik_periodicitate_instructaj');
				$htmlPeriodicitateInstructaje = $periodicitateInstructaje ? $periodicitateInstructaje[0]->name : '';
				$contactPersName  = get_post_meta($company->ID, 'kik_company_contact_person_name', true);
				$contactPersPhone = get_post_meta($company->ID, 'kik_company_contact_person_phone', true);
				$contactPersMail  = get_post_meta($company->ID, 'kik_company_contact_person_email', true);
				
				if(in_array('administrator', $currUserRoles)){
					$inspectorHtml = 
						'<i class="fa fa-user pos-absolute"></i>' . 
						KIK_DROPDOWN_USERS(
							'kik_company_inspector', 
							'kik_company_inspector', 
							'kik_ssm',    //'Inspector SSM', 
							get_post_meta($company->ID, 'kik_company_inspector', true),
							true
						);
					$salesHtml = 
						'<i class="fa fa-user pos-absolute"></i>' . 
						KIK_DROPDOWN_USERS(
							'kik_company_sales_agent', 
							'kik_company_sales_agent', 
							'kik_inspector_ssm',//'Agent de vânzări', 
							get_post_meta($company->ID, 'kik_company_sales_agent', true), 
							true, 
							'size_full'
						);
					
					$companyStatus = wp_get_object_terms($company->ID, 'kik_status');
					$status = $companyStatus ? $companyStatus[0]->name : 0;
					$termsHtml = 
						'<i class="fa fa-circle pos-absolute"></i>
						<div class="form-group">' . 
							KIK_DROPDOWN_TERMS(
								'kik_company_status', 
								'kik_company_status', 
								'kik_status', 
								$companyStatus[0]->term_id, 
								'inactiv', 
								'kik_company_post_listing_status size_full'
							) . '
						</div>';
					$actionsHtml = '<a class="btn btn-primary kik_company_update" data-company-id="' . $company->ID . '">Actualizează</a>';
				} else {
					$inspectorHtml = 
						'<i class="fa fa-user pos-relative"></i> 
						<span class="text-name">' . 
							get_userdata(get_post_meta($company->ID, 'kik_company_inspector', true))->display_name . '
						</span>';
					$salesHtml = 
						'<i class="fa fa-user pos-relative"></i> 
							<span class="text-name">' . 
								get_userdata(get_post_meta($company->ID, 'kik_company_sales_agent', true))->display_name . '
						</span>';
					$termsHtml = 
						'<i class="fa fa-circle pos-relative"></i>
						<span class="text-name">' . 
							($try = wp_get_object_terms($company->ID, 'kik_status')) ? $try[0]->name : '' . '
						</span>';
					$actionsHtml = '';
				}
				
				//echo '<div class="kik_alerts" title="' . $notifications_trainings . ' alerte">' . $kik_alerts . '</div>';
				//echo '<div class="kik_notifications" title="' . $notifications_trainings . ' atenționări">' . $kik_notifications . '</div>';
				//echo '<div class="kik_alerts_bills" title="' . $notifications_trainings . ' facturi neîncasate">' . $kik_alerts_bills . '</div>'; 		
				
				$data_row[] = 
					'<span class="hide">' . $company->post_title . '</span>
					<div class="kik-row-container">
						<div class="kik-company-details">
							<a class="kik_company_post_listing_title" href="'. get_permalink($company->ID) .'">'. $company->post_title .'</a></br>
								<div class="kik_company_post_listing_cif_reg">'.
									$cif . ($cif && $reg ? ', ' : '') . $reg .'
								</div>
						</div>
						<div class="kik-alerts-container">' .
							$notif_trainings_html . 
							$notif_exp_equip_html . 
							$alerts_exp_equip_html .
							$alerts_bills_html . 
							$kik_notifications .
							$kik_alerts_bills . '
						</div>
					</div>';
				
				$data_row[] = 
					'<div class="kik-row-container">
						<i class="fa fa-clock-o"></i>' . $htmlPeriodicitateInstructaje . '
					</div>';
		
				$data_row[] = 
					'<div class="kik-row-container">
						<i class="fa fa-fw fa-user"></i> <b>' . $contactPersName . '</b><br />
						<i class="fa fa-fw fa-phone"></i> ' . $contactPersPhone . '<br />
						<i class="fa fa-fw fa-envelope"></i> ' . $contactPersMail . ' 
					</div>';
				
				$data_row[] = 	
					'<div class="kik-row-container">
						<div class="kik_company_post_listing_select_row color-blue">
							<div class="kik_company_post_listing_select_row_edit"> ' . 
								$inspectorHtml . '
							</div>
						</div>
						<div class="kik_company_post_listing_select_row color-orange">
							<div class="kik_company_post_listing_select_row_edit"> ' . 
								$salesHtml . '
							</div>
						</div>
					</div>';

				//var_dump($company->ID . ' ' . $status);
				//var_dump(($status == 'Activ' ? 'green' : 'red'));
				$data_row[] = 
					'<div class="kik-row-container">
						<div class="kik_company_post_listing_select_row kik-single-select color-' . 
							//(($try = wp_get_object_terms($company->ID, 'kik_status')) && $try[0]->name == 'Activ' ? 'green' : 'red') .'">
							($status == 'Activ' ? 'green' : 'red') .'">
							<div class="kik_company_post_listing_select_row_edit text-center">'.
								$termsHtml .'
							</div>
						</div>
					</div>';
				$data_row[] = '<div class="kik-row-container">'. $actionsHtml .'</div>';
				
				$data['data'][] = $data_row;
			}
		} else {
			$data['data'] = '';
		}
		
		echo json_encode($data);
		wp_die();
	}
?>