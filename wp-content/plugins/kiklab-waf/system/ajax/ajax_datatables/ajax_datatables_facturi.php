<?php

	add_action('wp_ajax_ajax_datatable_facturi', 'ajax_datatable_facturi');
	add_action('wp_ajax_nopriv_ajax_datatable_facturi', 'ajax_datatable_facturi');
	
	function ajax_datatable_facturi(){
		
		$kik_ID = $_POST['kik_company_id'];
		
		$kik_company_billing_frequency = wp_get_object_terms($kik_ID, 'kik_perioada_de_facturare')[0];
		
		$args = array(
			'post_parent' => $kik_ID,
			'post_type'   => 'kik_billing', 
		);
		$kik_bills = get_children($args);
		$data_bills = array();
		
		if (sizeof($kik_bills) > 0){
			foreach($kik_bills as $bill){ 
			
				$platiPartiale = unserialize(get_post_meta($bill->ID, 'platiPartiale', true));
				$totalPlatiPartiale = 0;
				$incasat = get_post_meta($bill->ID, 'incasat', true);
				$sumaFactura = get_post_meta($bill->ID, 'sumaFactura', true);
				$termenPlata = get_post_meta($bill->ID, 'termenPlata', true) ? get_post_meta($bill->ID, 'termenPlata', true) : 0;
				$dataScadentei = DateTime::createFromFormat('Y/m/d', get_post_meta($bill->ID, 'dataFacturii', true))->add(new DateInterval('P'.$termenPlata.'D'));
				$dataFacturii = DateTime::createFromFormat('Y/m/d', get_post_meta($bill->ID, 'dataFacturii', true));
				$currDate = new DateTime();
				
				if(is_array($platiPartiale) && !empty($platiPartiale)){
					$aPlati = array();
					foreach($platiPartiale as $plata){
						$totalPlatiPartiale += $plata['suma'];
						$aPlati[] = $plata['suma'].' lei din '.$plata['data'];
					}
					$sPlati = implode('<br>', $aPlati);
				} else {
					$sPlati = '-';
				}
				$restPlata = $sumaFactura - $totalPlatiPartiale;
				
				
				$overdue='';
				$overdueChecked = '';
				
				if($currDate>$dataScadentei && $restPlata>0){
					$overdue = 'overdue';
					$overdueChecked = 'checked';
				}
				
				$btnDisabled = '';
				$disableAddPayment = 'data-toggle="modal" data-target="#new-partial-payment"';
				if($sumaFactura == $totalPlatiPartiale){
					$btnDisabled = 'disabled';
					$disableAddPayment = '';
				}
				
				$depasit = '<div class="col-sm-9 '.$overdue.'">
								<div class="checkbox">
									<label class="checkbox-label">
										<input disabled type="checkbox"' . $overdueChecked . ' id="factura-depasit">
										<span class="cr">
											<i class="cr-icon glyphicon glyphicon-ok"></i>
										</span>
									</label>
								</div>
							</div>';
		
				$actiuni = '<div alt="f133" 
							data-bill-id="'. $bill->ID .'"
							class="dashicons dashicons-welcome-add-page dashicon-blue cursor-pointer '. $btnDisabled .'"
							title="Adaugă plată parțială" '. $disableAddPayment . '
							></div>';
				
				
				
				
				$data_bills['data'][] = array(
					get_post_meta($bill->ID, 'nrFactura', true),
					$dataFacturii->format('d/m/Y'),
					$dataScadentei->format('d/m/Y'),
					$sumaFactura,
					$restPlata,
					$sPlati,
					$depasit,
					$actiuni
				);
			}
		} else {
			$data_bills['data'] = array();
		}
		
		echo json_encode($data_bills);

		
		wp_die();
		
	}
?>