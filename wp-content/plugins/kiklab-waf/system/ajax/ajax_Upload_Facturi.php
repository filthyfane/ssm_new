<?php


##### UPLOAD: Facturi
add_action('wp_ajax_KIK_ACTION_Upload_Facturi', 'KIK_ACTION_Upload_Facturi_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Upload_Facturi', 'KIK_ACTION_Upload_Facturi_FUNC');
function KIK_ACTION_Upload_Facturi_FUNC() {
	
	global $wpdb;
	
	if ($_FILES) {
		
		$aUploadDir  = wp_upload_dir();
		//$path = $aUploadDir['basedir'].'/uploadCsvFacturi/';
		$row = 1;
		$errors = array();
		
		/* if(!is_dir($path)){
			mkdir($path);
		}  */
		
		$handler = fopen($_FILES['file']['tmp_name'], 'r');
		
		if($handler !== false){
			while (($data = fgetcsv($handler, 1000, ",")) !== FALSE) {
				
				$checkedRow = checkRow($data);
				if(isset($checkedRow['errors'])){
					$errors[$row] = $checkedRow['errors'];
					continue;
				}
				
				$postID 	  = $checkedRow['oPost']->ID;
				$nrFacturii   = $checkedRow['nrFacturii'];
				$dataFacturii = $checkedRow['oDataFacturii']->format('Y/m/d');
				$factura 	  = $checkedRow['facturaExists'];
				$valFacturii  = $checkedRow['valFacturii'];
				$billing_term = get_post_meta($postID, 'kik_company_billing_deadline', true);
				
				if(!$factura){
					$billingID = wp_insert_post(
						array(
							'post_title'=>'Factura nr. '.$nrFacturii.'/'.$dataFacturii,
							'post_type'=>'kik_billing',
							'post_parent'=>$postID,
							'post_status'=>'publish',
						)
					); 
				} else {
					$billingID = $factura->ID;
				}
				
				update_post_meta($billingID, 'nrFactura', $nrFacturii);
				update_post_meta($billingID, 'dataFacturii', $dataFacturii);
				update_post_meta($billingID, 'sumaFactura', $valFacturii);
				update_post_meta($billingID, 'termenPlata', $billing_term);
				
				$row++;
			}
		}

		foreach($errors as $row=>$rowErrors){ ?>
			<div>
				<span>Erori rând <?php echo $row; ?></span>
				<ul><?php 
					foreach($rowErrors as $error){
						echo '<li>'.$error.'</li>';
					}?>
				</ul>
			</div><?php
		}
		fclose($handler);
	}
	
	wp_die();
}

function checkRow($data){
	$response = array();
	
	//check if the company exists
	$args = array(
		'post_type' => 'kik_company',
		'meta_key' => 'kik_company_cif',
		'meta_value' => $data[0]
	);
	
	$post = get_posts($args);
	
	
	if(sizeof($post) == 0){
		$response['errors'][] = 'Codul unic de înregistrare '.$data[0].' nu corespunde nici unei companii existente';
	}
	
	//check date format
	$dataFacturii = DateTime::createFromFormat('d/m/Y', $data[1]);
	if(!$dataFacturii){
		$response['errors'][] = 'Data facturii nu este in formatul zz/ll/aaaa';
	}
	
	//check billing value
	if(!is_numeric($data[3])){
		$response['errors'][] = 'Valoarea facturii '.$data[3].' nu este numerică';
	} 
	
	if(isset($response['errors'])){
		return $response;
	}
		
	//check if the invoice already exists
	$args = array(
		'post_type' => 'kik_billing',
		'meta_key' => 'nrFactura',
		'meta_value' => $data[2]
	);
	$factura = get_posts($args);
	
	
	$response = array(
		'oPost' => $post[0],
		'nrFacturii' => $data[2],
		'oDataFacturii' => $dataFacturii,
		'valFacturii' => $data[3]
	);
	
	if(sizeof($factura) == 0){
		$response['facturaExists'] = false;
	} else {
		$response['facturaExists'] = $factura[0];
	}
	
	return $response;
	
} 
?>