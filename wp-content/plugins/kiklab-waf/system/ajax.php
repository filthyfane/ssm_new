<?php

include(KIK_PLUGIN_ABSPATH . 'system/mypdf.php');

#####=========================
##### CRUD OPERATIONS
#####=========================
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Manage_Instructaj.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Manage_CSSM.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Manage_Equipment.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Manage_Bill.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Manage_Users.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Manage_Employee.php');
//include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_Bill.php');
//include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_Equipment.php');
//include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_Employee.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_File.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_Pdf.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_Partial_Payment.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_Relation_User_Companies.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_Company_Settings.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Delete_Posts.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Delete_User.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Update_Taxonomy_Terms.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Update_Author.php');

#####------------------------------------
##### PROCESS AJAX REQUESTS
#####------------------------------------
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Get_User_Data_Modal.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Get_Employee_Data_Modal.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Get_Instructaje_Data_Modal.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Get_CSSM_Data_Modal.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Get_User_Company_Relations.php');

#####------------------------------------
# DATATABLES AJAX
#####------------------------------------
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_facturi.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_cssm.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_echipamente.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_angajati.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_accident_file.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_toate_rapoartele.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_instructaje.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_categs.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_users.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_companies.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_notifications.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_warnings.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_alerts.php');

#####------------------------------------
##### REPORTS
#####------------------------------------
//include(KIK_PLUGIN_ABSPATH . 'system/ajax/reports/ajax_PV_predare_documente.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/reports/ajax_PV_instructaj.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/reports/ajax_Raport_semestrial_de_activitate.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/reports/ajax_Instructaj.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/reports/ajax_Echipamente.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/reports/ajax_Debite_neincasate.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/reports/ajax_Facturi.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/reports/ajax_Accidente.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/reports/ajax_Activitati_nerealizate.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/reports/ajax_Angajati_noi.php');


#####------------------------------------------
##### GLOBAL FUNCTION FOR RETURNING AJAX ERROR
#####------------------------------------------
function returnError($msg, $extraParams = []){
	$response = [
		'success' => false,
		'errMsg'  => $msg
	];

	if (count($extraParams) > 0) {
		$response = array_merge($response, $extraParams);
	}
	
	echo json_encode($response);
	exit;
}

#####------------------------------------------
##### GLOBAL FUNCTION FOR CHECKING THE POST_ID
#####------------------------------------------
function validatePostId($postId, $postType)
{
	if (!isset($postId)) {
		returnError('[ErrCode: 001] Această acțiune nu poate fi finalizată! Vă rugăm să contactați administratorul aplicației!');
	}
	
	$oPost = get_post($postId);
	if(is_null($oPost)){
		returnError('[ErrCode: 002] Această acțiune nu poate fi finalizată! Vă rugăm să contactați administratorul aplicației!');
	} elseif($oPost->post_type != $postType){
		returnError('[ErrCode: 003] Această acțiune nu poate fi finalizată! Vă rugăm să contactați administratorul aplicației!');	
	}
}

#####------------------------------------------
##### GLOBAL FUNCTION FOR CHECKING THE PASSWORD
#####------------------------------------------
function passwordValidator($pass, $confirmPass)
{	
	if($pass !== $confirmPass){
		returnError('Câmpurile Parolă și Confirmă parola nu sunt identice');
	} elseif(strlen($pass) < 8){
		returnError('Parola setată trebuie să aibă minimum 8 caractere și trebuie să conțină litere, cifre și caractere speciale');
	} elseif(!preg_match("/[a-zA-Z]/", $pass)){
		returnError('Parola setată trebuie să conțină litere');
	} elseif(!preg_match("/\d/", $pass)){
		returnError('Parola setată trebuie să conțină cel puțin o cifră');
	} elseif(!preg_match("/[^a-zA-Z\d]/", $pass)){
		returnError('Parola setată nu conține caractere speciale');
	}
}

#####---------------------------------------------
##### GLOBAL FUNCTION FOR VALIDATING DATE INTERVAL
#####---------------------------------------------
function validateDateInterval($startDate, $endDate, $extraParams = [])
{
	if(!$startDate || !$endDate){
		returnError('Vă rugăm să completați data de început și data de sfârșit!', $extraParams);
    }

    $oIntervalStart = DateTime::createFromFormat('d/m/Y', $startDate);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $endDate);

    if($oIntervalStart === false){
    	returnError('Data de start nu este validă!', $extraParams);
    }

    if($oIntervalEnd === false){
    	returnError('Data de sfârșit nu este validă!', $extraParams);
    }

    if($oIntervalStart > $oIntervalEnd){
    	returnError('Data de start nu poate fi mai mare decât data de sfârșit!', $extraParams);
    }
}

##### EDIT POST: Select CAEN
add_action('wp_ajax_KIK_ACTION_CAEN_Select', 'KIK_ACTION_CAEN_Select_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_CAEN_Select', 'KIK_ACTION_CAEN_Select_FUNC');
function KIK_ACTION_CAEN_Select_FUNC() {
	global $wpdb;
	echo '<span>' . get_term_by('slug', $_POST['kik_company_caen'], 'kik_cod_caen')->description . '</span>';
	wp_die();
}


##### QUICK UPDATE
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Quick_Update.php');
##### SAVE POST
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_Post.php');
##### DELETE POST
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Delete_Post.php');
##### UPLOAD: Angajati
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Upload_Angajati.php');
##### UPLOAD: Facturi
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Upload_Facturi.php');
##### SAVE USER
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_User.php');
##### SAVE TERMS
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_Terms.php');
##### SAVE NEW TERM
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_Term.php');


##### Categorii de date: Add term
add_action('wp_ajax_KIK_ACTION_Term_Add', 'KIK_ACTION_Term_Add_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Termt_Add', 'KIK_ACTION_Term_Add_FUNC');
function KIK_ACTION_Term_Add_FUNC() {
	global $wpdb;
	
	$row_id = rand(1000000, 9999999); ?>
	
	<tr>
		<td colspan="2">
			<table class="table_type_row">
				<tr>
					<td style="width:40px;" class="align-right">
						&nbsp;
					</td>
					<td style="width:100%;">
						<input type="text" class="size_m new" id="term_<?php echo $_POST['taxonomy']; ?>_<?php echo $row_id; ?>_name" name="taxonomies[<?php echo $_POST['taxonomy']; ?>][<?php echo $row_id; ?>][name]" value="" />
						<?php if ($_POST['taxonomy'] == 'kik_cod_caen') { ?>
						<input type="text" class="size_xl new" id="term_<?php echo $_POST['taxonomy']; ?>_<?php echo $row_id; ?>_description" name="taxonomies[<?php echo $_POST['taxonomy']; ?>][<?php echo $row_id; ?>][description]" value="" />
						<?php } ?>
						<a class="kik_term_delete" data-taxonomy="<?php echo $_POST['taxonomy']; ?>" href="javascript:;">Șterge</a>
					</td>
				</tr>
			</table>
		</td>
	</tr><?php
	
	wp_die();
}


##### FUNCTION GET FREQUENCY INTERVAL
function getFrequencyInterval($frequencyName){
	switch($frequencyName){
		case 'Anual': 
		case '12 luni':
			$interval = 'P1Y';
			break;
		case 'Semestrial':
		case '6 luni':
			$interval = 'P6M';
			break;
		case 'Trimestrial':
		case '3 luni':
			$interval = 'P3M';
			break;
		case 'Lunar':
		case '1 luna':
			$interval = 'P1M';
			break;
		case '2 luni':
			$interval = 'P2M';
		default:
			$interval = '';
	}
	
	return $interval;
}


##### Cron Test
add_action('wp_ajax_KIK_ACTION_Cron', 'KIK_ACTION_Cron');
add_action('wp_ajax_nopriv_KIK_ACTION_Cron', 'KIK_ACTION_Cron');
function KIK_ACTION_Cron() {
	
	global $wpdb;
	
	
	$i = 0;
	$posts = get_posts(array(
		'posts_per_page' => -1,
		'post_type' => 'kik_company',
	));
	$kik_messages = array();
	
	
	foreach($posts as $post){
		
		//CHECK IF THERE ARE LESS THAN 14 DAYS TO THE TRAINING
		$kik_messages = checkTrainings($post, $kik_messages);
		
		//CHECK IF THERE ARE LESS THAN 14 DAYS TO EQUIPMENT/ISCIR EXPIRATION DATE
		//CHECK IF WE HAVE EXPIRED EQUIPMENTS/ISCIR
		$kik_messages = checkEquipments($post, $kik_messages);
		
		//CHECK IF THE BILLS ARE NOT FULLY PAID
		$kik_messages = checkBills($post, $kik_messages);
		
		
	}

	KIK_MAIL($kik_messages);
	
	if (KIK_DOING_CRON) {
		//file_put_contents('KIK_CRON_OUTPUT.txt', date('Y-m-d H:i:s', time()) . ' -- ajax.php (CRON)' . "\n", FILE_APPEND);
		//echo date('Y-m-d H:i:s', time()) . ' -- ajax.php' . "\n";
	}
	else {
		//file_put_contents('KIK_CRON_OUTPUT.txt', date('Y-m-d H:i:s', time()) . ' -- ajax.php (WP)' . "\n", FILE_APPEND);
		wp_die();
	}
}



function checkTrainings($post, $kik_messages){
	$aInstructaje = get_post_meta($post->ID, 'kik_instructaj', true);
	$notifInstr = 0;
	
	if($aInstructaje){
		foreach($aInstructaje as $id_tip_instructaj => $id_periodicitate){
			$oPeriodicitate  = get_term_by('id', $id_periodicitate, 'kik_periodicitate_instructaj');
			$oTipInstructaj  = get_term_by('id', $id_tip_instructaj, 'kik_tipuri_instructaj');
			$aInstructajName = explode(' ', $oPeriodicitate->name)[0];
			$monthsNbr 		 = $aInstructajName[0];
			$oCurrDate 		 = new DateTime();
			$oCurrDate->add(new DateInterval('P14D'));
			
			$oContractStartDate = DateTime::createFromFormat('Y/m/d', get_post_meta($post->ID, 'kik_company_contract_date', true));
			$diff = $oCurrDate->diff($oContractStartDate);
			$dayDiff = $diff->format('%d');
			$monthDiff = $diff->format('%m');
			
			//daca sunt mai putin de 14 zile pana la data instructajului si suntem in luna respectiva
			if($dayDiff <= 13 && $diff->format('%m')%$monthsNbr === 0) {
				$kik_messages['Notificări: Ședințe de instructaj'][] = 'Ședința '.$oTipInstructaj->name.' pentru compania '
					.$post->post_title.' este programată pentru data de '.$oCurrDate->format('d/m/Y'); 
				$notifInstr++;
				//create new CSSM 14 days before its due date
				/* if($dayDiff == 0){
					$cssmMeetingID =  wp_insert_post(
						array(
							'post_title'=>'Ședința din data de '.$oCurrDate->format('d/m/Y'),
							'post_type'=>'kik_cssm',
							'post_parent'=>$post->ID,
							'post_status'=>'publish',
						)
					); 
					update_post_meta($cssmMeetingID, 'dataSedintei', $oCurrDate->format('d/m/Y'));
					update_post_meta($cssmMeetingID, 'realizat', 0);
				} */
			}
			
			
		}
	}
	
	update_post_meta($post->ID, 'notifications_trainings', $notifInstr);
	return $kik_messages;
}

function checkEquipments($post, $kik_messages){
	
	$equipments 	= getEquipments($post->ID);
	$oCurrDate 		= new DateTime();
	$notifExpEquip 	= 0;
	$alertsExpEquip = 0;
	
	foreach($equipments as $oEquipment){
		$oExpiryDate = get_post_meta($oEquipment->ID, 'dataExpirare', true);
		$iscir = get_post_meta($oEquipment->ID, 'iscir', true);
		$equipmentTerm = get_term(get_post_meta($oEquipment->ID, 'idEchipament', true), 'kik_echipamente');
		
		if($oExpiryDate){
			$oExpiryDate = DateTime::createFromFormat('Y/m/d', $oExpiryDate);
			$diff = $oExpiryDate->diff($oCurrDate);
			$daysDiff = $diff->format('%r%a');
			
			if($daysDiff >= 0 && $daysDiff < 14){
				$kik_messages['Notificări: Expirare echipamente'][] = 'Echipamentul '
					.$equipmentTerm->name.' pentru compania '.$post->post_title.' va expira în curând!';
				$notifExpEquip++;
			} else {
				$kik_messages['Alerte: Expirare echipamente'][] = 'Echipamentul '
					.$equipmentTerm->name.' pentru compania '.$post->post_title.' a expirat in data de '
					.$oExpiryDate->format('d/m/Y');
				$alertsExpEquip++;
			}
		}
		
		if($iscir === 'true'){
			$oIscirExp = get_post_meta($oEquipment->ID, 'dataExpIscir', true);
			if($oIscirExp){
				$oIscirExp = DateTime::createFromFormat('Y/m/d', $oIscirExp);
				$diff = $oIscirExp->diff($oCurrDate);
				$daysDiff = $diff->format('%r%a');
				
				if($daysDiff >= 0 && $daysDiff < 14){
					$kik_messages['Notificări: Expirare ISCIR'][] = 'ISCIR pentru echipmentul '
						.$equipmentTerm->name.' pentru compania '.$post->post_title.' va expira în curând!';
					$notifExpEquip++;
				} else {
					$kik_messages['Alerte: Expirare ISCIR'][] = 'ISCIR pentru echipamentul '
						.$equipmentTerm->name.' pentru compania '.$post->post_title.' a expirat in data de '
						.$oIscirExp->format('d/m/Y');
					$alertsExpEquip++;
				}
				
			}
		}
	}
	
	update_post_meta($post->ID, 'notifications_exp_equip', $notifExpEquip);
	update_post_meta($post->ID, 'alerts_exp_equip', $alertsExpEquip);
	
	return $kik_messages;
	
}

function checkBills($post, $kik_messages){
	
	$paymentDays = get_post_meta($post->ID, 'kik_company_billing_deadline', true);
	$oCurrDate = new DateTime();
	$alertsBill = 0;
	
	if($paymentDays){
		$bills = getBills($post->ID);
		foreach($bills as $oBill){
			$billDate = get_post_meta($oBill->ID, 'dataFacturii', true);
			$billNbr = get_post_meta($oBill->ID, 'nrFactura', true);
			$billAmount = get_post_meta($oBill->ID, 'sumaFactura', true);
			
			if($billDate){
				$partialPayments = get_post_meta($oBill->ID, 'platiPartiale', true);
				$billExpDate = DateTime::createFromFormat('Y/m/d', $billDate);
				
				$billExpDate = $billExpDate->add(new DateInterval('P'.$paymentDays.'D'));
				$diff = $billExpDate->diff($oCurrDate)->format('%r%a');
				
				$sum = 0;
				if($partialPayments){
					foreach(unserialize($partialPayments) as $partPayment){
						$sum += $partPayment['suma'];
					}
				}
				
				if($sum < $billAmount && $diff > 0){
					$kik_messages['Alerte: Facturi neîncasate'][] = 'Scadența facturii cu nr.'.$billNbr.'/'
						.$billDate.' aferentă companiei '. $post->post_title .' a fost depășită!';
					$alertsBill++;
				}
			}
		}
	}
	
	update_post_meta($post->ID, 'alerts_bills', $alertsBill);
	return $kik_messages;
}





/**/

?>