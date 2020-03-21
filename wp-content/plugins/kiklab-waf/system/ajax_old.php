<?php

##### SAVE NEW BILL
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_Bill.php');
##### SAVE NEW CSSM MEETING
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_CSSM_Meeting.php');
##### SAVE NEW EQUIPMENT
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_Equipment.php');
##### SAVE NEW EMPLOYEE
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_Employee.php');
##### SAVE NEW FILE
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_File.php');
##### SAVE NEW PDF
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_New_Pdf.php');
##### SAVE NEW PARTIAL PAYMENT
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Save_Partial_Payment.php');


##### DELETE POSTS
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_Delete_Posts.php');

#####------------------------------------
##### PROCESS AJAX REQUESTS
#####------------------------------------

###################################################
# DATATABLES AJAX
###################################################
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_facturi.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_cssm.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_echipamente.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_angajati.php');
include(KIK_PLUGIN_ABSPATH . 'system/ajax/ajax_datatables/ajax_datatables_accident_file.php');



##### EDIT POST: Add bill
add_action('wp_ajax_KIK_ACTION_Bill_Add', 'KIK_ACTION_Bill_Add_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Bill_Add', 'KIK_ACTION_Bill_Add_FUNC');
function KIK_ACTION_Bill_Add_FUNC() {
	
	global $wpdb;
	
	$row_id = rand(1000000, 9999999);
	
	?>
	<tr id="new_<?php echo $row_id; ?>">
		<td colspan="7">
			<input type="hidden" name="kik_company_billing_history[<?php echo $row_id; ?>]['unique_id']" value="<?php echo KIK_ASSIGN_UNIQUE_ID(); ?>"/>
			<table class="table_type_row">
				<tr>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new datetimepicker_input align-center" style="color:#cccccc; font-style:italic;" id="kik_company_billing_history_<?php echo $row_id; ?>_bill_date" name="kik_company_billing_history[<?php echo $row_id; ?>][bill_date]" value="Data factura" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Data factura" />
						</div>
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new align-right" style="color:#cccccc; font-style:italic;" id="kik_company_billing_history_<?php echo $row_id; ?>_bill_nr" name="kik_company_billing_history[<?php echo $row_id; ?>][bill_nr]" value="Nr. factura" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Nr. factura" />
						</div>
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new align-right" style="color:#cccccc; font-style:italic;" id="kik_company_billing_history_<?php echo $row_id; ?>_bill_val" name="kik_company_billing_history[<?php echo $row_id; ?>][bill_val]" value="Valoare" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Valoare" />
						</div>
					</td>
					<td style="width:100px;">
						<input type="checkbox" class="new" id="kik_company_billing_history_<?php echo $row_id; ?>_bill_bool" name="kik_company_billing_history[<?php echo $row_id; ?>][bill_bool]" />
					</td>
					<td style="width:100px;">
						&nbsp;
					</td>
					<td style="width:34%;">
						<div class="box_H_margin">
							&nbsp;
						</div>
					</td>
					<td style="width:100px;">
						<div class="box_H_margin">
							<a class="kik_company_billing_history_delete" href="javascript:;">Sterge</a>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
	
	wp_die();
}


##### EDIT POST: Add workpoint
add_action('wp_ajax_KIK_ACTION_Workpoint_Add', 'KIK_ACTION_Workpoint_Add_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Workpoint_Add', 'KIK_ACTION_Workpoint_Add_FUNC');
function KIK_ACTION_Workpoint_Add_FUNC() {
	
	global $wpdb;
	
	$row_id = rand(1000000, 9999999);
	
	?>
	<tr id="new_<?php echo $row_id; ?>">
		<td>
			<label for="kik_company_workpoint_<?php echo $row_id; ?>">Punct de lucru</label>
		</td>
		<td>
			<input type="text" class="size_xl new" id="kik_company_workpoint_<?php echo $row_id; ?>" name="kik_company_workpoints[<?php echo $row_id; ?>]['address']" value="Punct de lucru" style="color:#cccccc; font-style:italic;" data-autohint="true" title="Punct de lucru" /> <a class="kik_company_workpoint_delete" href="javascript:;">Sterge</a>
		</td>
	</tr>
	<?php
	
	wp_die();
}


##### EDIT POST: Add echipament
add_action('wp_ajax_KIK_ACTION_Echipament_Add', 'KIK_ACTION_Echipament_Add_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Echipament_Add', 'KIK_ACTION_Echipament_Add_FUNC');
function KIK_ACTION_Echipament_Add_FUNC() {
	
	global $wpdb;
	
	$row_id = rand(1000000, 9999999);
	
	?>
	<tr id="new_<?php echo $row_id; ?>">
		<td colspan="6">
			<input type="hidden" name="kik_company_echipamente[<?php echo $row_id; ?>][unique_id]" value="<?php echo KIK_ASSIGN_UNIQUE_ID(); ?>"/>
			<table class="table_type_row">
				<tr>
					<td style="width:46%;">
						<div class="box_H_margin">
							<?php
							wp_dropdown_categories(array(
								'show_option_all'    => '',
								'show_option_none'   => '',
								'orderby'            => 'NAME', 
								'order'              => 'ASC',
								'show_count'         => 0,
								'hide_empty'         => 0, 
								'child_of'           => 0,
								'exclude'            => '',
								'echo'               => 1,
								'selected'           => '',
								'hierarchical'       => 1, 
								'name'               => 'kik_company_echipamente[' . $row_id . '][id]',
								'id'                 => 'kik_company_echipament_add_' . $row_id . '_id',
								'class'              => 'new size_full_W new',
								'depth'              => 0,
								'tab_index'          => 0,
								'taxonomy'           => 'kik_echipamente',
								'hide_if_empty'      => false,
							));
							?>
						</div>
					</td>
					<td style="width:10%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new align-right" style="color:#333333; font-style:normal;" id="kik_company_echipament_add_<?php echo $row_id; ?>_id" name="kik_company_echipamente[<?php echo $row_id; ?>][buc]" value="1" data-autohint="true" title="Buc" />
						</div>
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new align-center datetimepicker_input" style="color:#cccccc; font-style:italic;" id="kik_company_echipament_add_<?php echo $row_id; ?>_exp" name="kik_company_echipamente[<?php echo $row_id; ?>][exp]" value="Data expirarii" data-autohint="true" title="Data expirarii" />
						</div>
					</td>
					<td style="width:50px;" class="align-right">
						<input type="checkbox" class="KIK_iscir new" id="kik_company_echipament_<?php echo $row_id; ?>_iscir_bool" name="kik_company_echipamente[<?php echo $row_id; ?>][iscir_bool]" />
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new align-center datetimepicker_input" style="color:#cccccc; font-style:italic; display:none;" id="kik_company_echipament_add_<?php echo $row_id; ?>_iscir" name="kik_company_echipamente[<?php echo $row_id; ?>][iscir]" value="Data expirarii ISCIR" data-autohint="true" title="Data expirarii ISCIR" />
							<div class="size_full_W_full_H align-center" style="display:block;">--</div>
						</div>
					</td>
					<td style="width:100px;">
						<div class="box_H_margin">
							<a class="kik_company_echipament_delete" href="#">Sterge</a>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
	
	wp_die();
}


##### EDIT POST: Add angajat
add_action('wp_ajax_KIK_ACTION_Angajat_Add', 'KIK_ACTION_Angajat_Add_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Angajat_Add', 'KIK_ACTION_Angajat_Add_FUNC');
function KIK_ACTION_Angajat_Add_FUNC() {
	
	global $wpdb;
	
	$row_id = rand(1000000, 9999999);
	
	?>
	<tr id="new_<?php echo $row_id; ?>">
		<td colspan="4">
			<table class="table_type_row">
				<tr>
					<td style="width:18%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new" style="color:#cccccc; font-style:italic;" id="kik_company_angajat_<?php echo $row_id; ?>_nume" name="kik_company_angajati[<?php echo $row_id; ?>][nume]" value="Nume" data-autohint="true" title="Nume" />
						</div>
					</td>
					<td style="width:18%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new" style="color:#cccccc; font-style:italic;" id="kik_company_angajat_<?php echo $row_id; ?>_prenume" name="kik_company_angajati[<?php echo $row_id; ?>][prenume]" value="Prenume" data-autohint="true" title="Prenume" />
						</div>
					</td>
					<td style="width:42%;" colspan="2">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new" style="color:#cccccc; font-style:italic;" id="kik_company_angajat_<?php echo $row_id; ?>_functie" name="kik_company_angajati[<?php echo $row_id; ?>][functie]" value="Functie" data-autohint="true" title="Functie" />
						</div>
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new" style="color:#cccccc; font-style:italic;" id="kik_company_angajat_<?php echo $row_id; ?>_cnp" name="kik_company_angajati[<?php echo $row_id; ?>][cnp]" value="CNP" data-autohint="true" title="CNP" />
						</div>
					</td>
					<td style="width:100px;">
						<div class="box_H_margin">
							<a class="kik_company_angajat_delete" href="javascript:;">Sterge</a>
						</div>
					</td>
				</tr>
				<tr>
					<td style="width:36%;" colspan="2">&nbsp;</div>
					<td style="width:64%;" colspan="3">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new" style="color:#cccccc; font-style:italic;" id="kik_company_angajat_<?php echo $row_id; ?>_adresa" name="kik_company_angajati[<?php echo $row_id; ?>][adresa]" value="Adresa" data-autohint="true" title="Adresa" />
						</div>
					</td>
				</tr>
				<tr>
					<td style="width:36%;" colspan="2">&nbsp;</div>
					<td style="width:20%;">
						<div class="box_H_margin align-right">
							<label for="kik_company_angajat_<?php echo $row_id; ?>_contract_type">Norma de lucru</label>
							<?php
							wp_dropdown_categories(array(
								'show_option_all'    => '',
								'show_option_none'   => '-- Alege --',
								'orderby'            => 'NAME', 
								'order'              => 'ASC',
								'show_count'         => 0,
								'hide_empty'         => 0,
								'child_of'           => 0,
								'exclude'            => '',
								'echo'               => 1,
								'selected'           => '',
								'hierarchical'       => 1, 
								'name'               => 'kik_company_angajati[' . $row_id . '][contract_type]',
								'id'                 => 'kik_company_angajat_' . $row_id . '_contract_type',
								'class'              => 'new',
								'depth'              => 0,
								'tab_index'          => 0,
								'taxonomy'           => 'kik_norme_lucru',
								'hide_if_empty'      => false,
							));
							?>
						</div>
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W datetimepicker_input align-center new" style="color:#cccccc; font-style:italic;" id="kik_company_angajat_<?php echo $row_id; ?>_contract_start" name="kik_company_angajati[<?php echo $row_id; ?>][contract_start]" value="Data incepere contract" data-autohint="true" title="Data incepere contract" />
						</div>
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W datetimepicker_input align-center new" style="color:#cccccc; font-style:italic;" id="kik_company_angajat_<?php echo $row_id; ?>_contract_end" name="kik_company_angajati[<?php echo $row_id; ?>][contract_end]" value="Data incetare contract" data-autohint="true" title="Data incetare contract" />
						</div>
					</td>
				</tr>
				<tr>
					<td style="width:36%;" colspan="2">&nbsp;</div>
					<td style="width:20%;">
						<div class="box_H_margin align-right">
							<label for="kik_company_angajat_<?php echo $row_id; ?>_boss_bool">Conducator loc de munca</label>
							<input type="checkbox" class="KIK_angajat_boss new" style="color:#cccccc; font-style:italic;" id="kik_company_angajat_<?php echo $row_id; ?>_boss_bool" name="kik_company_angajati[<?php echo $row_id; ?>][boss_bool]" />
						</div>
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new" style="color:#cccccc; font-style:italic; display:none;" id="kik_company_angajat_<?php echo $row_id; ?>_boss_phone" name="kik_company_angajati[<?php echo $row_id; ?>][boss_phone]" value="Telefon" data-autohint="true" title="Telefon" />
							<div class="size_full_W_full_H align-center" style="display:block;">--</div>
						</div>
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new" style="color:#cccccc; font-style:italic; display:none;" id="kik_company_angajat_<?php echo $row_id; ?>_boss_email" name="kik_company_angajati[<?php echo $row_id; ?>][boss_email]" value="Email" data-autohint="true" title="Email" />
							<div class="size_full_W_full_H align-center" style="display:block;">--</div>
						</div>
					</td>
				</tr>
				<tr>
					<td style="width:36%;" colspan="2">&nbsp;</div>
					<td style="width:20%;">
						<div class="box_H_margin align-right">
							<label for="kik_company_angajat_<?php echo $row_id; ?>_auth_bool">Autorizatie speciala</label>
							<input type="checkbox" class="KIK_angajat_auth new" style="color:#cccccc; font-style:italic;" id="kik_company_angajat_<?php echo $row_id; ?>_auth_bool" name="kik_company_angajati[<?php echo $row_id; ?>][auth_bool]" />
						</div>
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new" style="color:#cccccc; font-style:italic; display:none;" id="kik_company_angajat_<?php echo $row_id; ?>_auth_type" name="kik_company_angajati[<?php echo $row_id; ?>][auth_type]" value="Tip autorizatie" data-autohint="true" title="Tip autorizatie" />
							<div class="size_full_W_full_H align-center" style="display:block;">--</div>
						</div>
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W datetimepicker_input align-center new" style="color:#cccccc; font-style:italic; display:none;" id="kik_company_angajat_<?php echo $row_id; ?>_auth_exp" name="kik_company_angajati[<?php echo $row_id; ?>][auth_exp]" value="Data expirarii autorizatiei" data-autohint="true" title="Data expirarii autorizatiei" />
							<div class="size_full_W_full_H align-center" style="display:block;">--</div>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
	
	wp_die();
}


##### EDIT POST: Add accident
add_action('wp_ajax_KIK_ACTION_Accident_Add', 'KIK_ACTION_Accident_Add_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Accident_Add', 'KIK_ACTION_Accident_Add_FUNC');
function KIK_ACTION_Accident_Add_FUNC() {
	
	global $wpdb;
	
	$row_id = rand(1000000, 9999999);
	
	?>
	<tr id="new_<?php echo $row_id; ?>">
		<td colspan="5">
			<table class="table_type_row">
				<tr>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new datetimepicker_input align-center" style="color:#cccccc; font-style:italic;" id="kik_company_accident_<?php echo $row_id; ?>_cercetare" name="kik_company_accidente[<?php echo $row_id; ?>][cercetare]" value="Data cercetarii" data-autohint="true" title="Data cercetarii" />
						</div>
					</td>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new datetimepicker_input align-center" style="color:#cccccc; font-style:italic;" id="kik_company_accident_<?php echo $row_id; ?>_producere" name="kik_company_accidente[<?php echo $row_id; ?>][producere]" value="Data producerii" data-autohint="true" title="Data producerii" />
						</div>
					</td>
					<td style="width:36%;" class="align-left">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new align-left" style="color:#cccccc; font-style:italic;" id="kik_company_accident_<?php echo $row_id; ?>_angajat" name="kik_company_accidente[<?php echo $row_id; ?>][angajat]" value="Numele angajatului implicat" data-autohint="true" title="Numele angajatului implicat" />
						</div>
					</td>
					<td style="width:20%;">&nbsp;</td>
					<td style="width:100px;">
						<div class="box_H_margin">
							<a class="kik_company_accident_delete" href="javascript:;">Sterge</a>
						</div>
					</td>
				</tr>
				<tr>
					<td style="width:100%;" class="align-left" colspan="4">
						<textarea class="size_full_W_2_rows new align-left" style="color:#cccccc; font-style:italic;" id="kik_company_accident_<?php echo $row_id; ?>_descriere" name="kik_company_accidente[<?php echo $row_id; ?>][descriere]" data-autohint="true" title="Scurta descriere a cauzelor accidentului">Scurta descriere a cauzelor accidentului</textarea>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
	
	wp_die();
}


##### EDIT POST: Add CSSM
add_action('wp_ajax_KIK_ACTION_CSSM_Add', 'KIK_ACTION_CSSM_Add_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_CSSM_Add', 'KIK_ACTION_CSSM_Add_FUNC');
function KIK_ACTION_CSSM_Add_FUNC() {
	
	global $wpdb;
	
	$row_id = rand(1000000, 9999999);
	
	?>
	<tr id="new_<?php echo $row_id; ?>">
		<td colspan="4">
			<input type="hidden" name="kik_company_cssm[<?php echo $row_id; ?>][unique_id]" value="<?php echo KIK_ASSIGN_UNIQUE_ID(); ?>"/>
			<table class="table_type_row">
				<tr>
					<td style="width:22%;">
						<div class="box_H_margin">
							<input type="text" class="size_full_W new datetimepicker_input align-center" style="color:#cccccc; font-style:italic;" id="kik_company_cssm_<?php echo $row_id; ?>_data" name="kik_company_cssm[<?php echo $row_id; ?>][cssm_data]" value="Data sedintei CSSM" data-autohint="true" title="Data sedintei CSSM" />
						</div>
					</td>
					<td style="width:60px;">
						<div class="box_H_margin">
							<input type="checkbox" class="new" id="kik_company_cssm_<?php echo $row_id; ?>_cssm_bool" name="kik_company_cssm[<?php echo $row_id; ?>][cssm_bool]" />
						</div>
					</td>
					<td style="width:78%;">&nbsp;</td>
					<td style="width:100px;">
						<div class="box_H_margin">
							<a class="kik_company_cssm_delete" href="javascript:;">Sterge</a>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
	
	wp_die();
}


##### EDIT POST: Select CAEN
add_action('wp_ajax_KIK_ACTION_CAEN_Select', 'KIK_ACTION_CAEN_Select_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_CAEN_Select', 'KIK_ACTION_CAEN_Select_FUNC');
function KIK_ACTION_CAEN_Select_FUNC() {
	
	global $wpdb;
	
	echo '<span>' . get_term_by('slug', $_POST['kik_company_caen'], 'kik_cod_caen')->description . '</span>';
	
	wp_die();
}


##### SAVE POST: Validate data
add_action('wp_ajax_KIK_ACTION_validate_post_data', 'KIK_ACTION_validate_post_data_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_validate_post_data', 'KIK_ACTION_validate_post_data_FUNC');
function KIK_ACTION_validate_post_data_FUNC() {
//simple Security check
//check_ajax_referer('kik_validate_post_data', 'security');
//convert the string of data received to an array




//echo DrawObject($_POST['form_data']);
//parse_str($_POST['form_data'], $vars);
//echo DrawObject($vars);




/*
//check that are actually trying to publish a post
if ($vars['post_status'] == 'publish' || (isset($vars['original_publish']) && in_array($vars['original_publish'], array('Publish', 'Schedule', 'Update')))) {
    if (empty($vars['_start_date']) || empty($vars['_end_date'])) {
        _e('Both Start and End date need to be filled');
        die();
    }
    //make sure start < end
    elseif ($vars['_start_date'] > $vars['_end_date'])  {
        _e('Start date cannot be after End date');
        die();
    }
    //check time is also inputted in case of a non-all-day event
    elseif (!isset($vars['_all_day'])) {
        if (empty($vars['_start_time']) || empty($vars['_end_time'])) {
            _e('Both Start time and End time need to be specified if the event is not an all-day event');
            die();              
        }
        elseif (strtotime($vars['_start_date']. ' ' .$vars['_start_time']) > strtotime($vars['_end_date']. ' ' .$vars['_end_time'])) {
            _e('Start date/time cannot be after End date/time');
            die();
        }
    }
}
/**/

# everything ok, allow submission
echo 'false'; 
die();

/**/



//_e('Both Start and End date need to be filled');
//echo 'ZZZ';
//die();



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





##### Categorii de date: Add term
add_action('wp_ajax_KIK_ACTION_Term_Add', 'KIK_ACTION_Term_Add_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Termt_Add', 'KIK_ACTION_Term_Add_FUNC');
function KIK_ACTION_Term_Add_FUNC() {
	
	global $wpdb;
	
	$row_id = rand(1000000, 9999999);
	
	?>
	
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
	</tr>
	
	<?php
	
	wp_die();
}




##### REPORTS
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




##### FUNCTION GET FREQUENCY INTERVAL
function getFrequencyInterval($frequencyName){
	switch($frequencyName){
		case 'Anual': 
		case '12 luni'
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
add_action('wp_ajax_KIK_ACTION_Cron_Test', 'KIK_ACTION_Cron_Test_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Cron_Test', 'KIK_ACTION_Cron_Test_FUNC');
function KIK_ACTION_Cron_Test_FUNC() {
	
	global $wpdb;
	
	//echo DrawObject($_POST);
	
	$i = 0;
	$posts = get_posts(array(
		'posts_per_page' => -1,
		'post_type' => 'kik_company',
	));
	foreach ($posts as $post) {
		
		# Periodicitate instructaj
		$years = get_post_meta($post->ID, 'kik_company_service_frequency_history', true);
		if ($years) foreach ($years as $year => $months) {
			
			# for each month of the year
			$j = 0;
			if ($months) foreach ($months as $month => $vals) {
				
				$formatted_date_to_day = $year . '-' . sprintf("%02d", $month) . '-' . sprintf("%02d", $vals['day']);
				$formatted_date_to_month = $year . '-' . sprintf("%02d", $month) . '-' . '01';
				
				# if there is no day set in the meta var,
				# and this month is or is after the now() month,
				# then generate alert (instructaj_no_date_set)
				if ($vals['serv_necessary'] && !$vals['day'] && date('Y-m-d', time()) >= $formatted_date_to_month) {
					$kik_alerts['by_type']['instructaj_no_date_set'][$post->ID][$year][$month] = $vals['unique_id'];
					$kik_alerts['by_id'][$post->ID]['instructaj_no_date_set'][$year][$month] = $vals['unique_id'];
					$kik_messages['SSM: Alerta - Data instructajului nu este setata'][] = array('post_id' => $post->ID, 'unique_id' => $vals['unique_id'], 'situation' => 'instructaj_no_date_set');
				}
				
				# if day is set,
				# bool is not true,
				# and there are less than 14 days until this day,
				# then generate notification (instructaj_coming_up)
				if ($vals['serv_necessary'] && $vals['day'] && !$vals['serv_bool'] && date('Y-m-d', time()) < $formatted_date_to_day && date('Y-m-d', time() + (60 * 60 * 24 * 14)) >= $formatted_date_to_day) {
					$kik_notifications['by_type']['instructaj_coming_up'][$post->ID][$year][$month] = serialize(array('unique_id' => $vals['unique_id'], 'day' => $vals['day']));
					$kik_notifications['by_id'][$post->ID]['instructaj_coming_up'][$year][$month] = serialize(array('unique_id' => $vals['unique_id'], 'day' => $vals['day']));
					$kik_messages['SSM: Atentionare - Urmeaza sedinta de instructaj'][] = array('post_id' => $post->ID, 'unique_id' => $vals['unique_id'], 'situation' => 'instructaj_coming_up');
				}
				
				# if day is set,
				# bool is not true,
				# and this day has passed,
				# then generate alert (instructaj_not_done)
				if ($vals['serv_necessary'] && $vals['day'] && !$vals['serv_bool'] && date('Y-m-d', time()) > $formatted_date_to_day) {
					$kik_alerts['by_type']['instructaj_not_done'][$post->ID][$year][$month] = serialize(array('unique_id' => $vals['unique_id'], 'day' => $vals['day']));
					$kik_alerts['by_id'][$post->ID]['instructaj_not_done'][$year][$month] = serialize(array('unique_id' => $vals['unique_id'], 'day' => $vals['day']));
					$kik_messages['SSM: Alerta - Nu s-a realizat sedinta de instructaj'][] = array('post_id' => $post->ID, 'unique_id' => $vals['unique_id'], 'situation' => 'instructaj_not_done');
				}
				
			}
			
		}
		
		# CSSM
		$cssm = get_post_meta($post->ID, 'kik_company_cssm', true);
		if ($cssm) foreach ($cssm as $i => $vals) {
			
			# if day is set,
			# and there are less than 10 days until this day,
			# then generate notification (cssm_coming_up)
			if ($vals['cssm_data'] && date('Y-m-d', time()) < $vals['cssm_data'] && date('Y-m-d', time() + (60 * 60 * 24 * 10)) >= $vals['cssm_data']) {
				$kik_notifications['by_type']['cssm_coming_up'][$post->ID][] = serialize(array('unique_id' => $vals['unique_id'], 'data' => $vals['cssm_data']));
				$kik_notifications['by_id'][$post->ID]['cssm_coming_up'][] = serialize(array('unique_id' => $vals['unique_id'], 'data' => $vals['cssm_data']));
				$kik_messages['SSM: Atentionare - Urmeaza sedinta CSSM'][] = array('post_id' => $post->ID, 'unique_id' => $vals['unique_id'], 'situation' => 'cssm_coming_up');
			}
			
			# if day is set,
			# and this day has passed by 5 days,
			# then generate notification (cssm_over)
			if ($vals['cssm_data'] && $vals['cssm_bool'] && date('Y-m-d', time()) > $vals['cssm_data'] && date('Y-m-d', time() - (60 * 60 * 24 * 5)) < $vals['cssm_data']) {
				$kik_notifications['by_type']['cssm_over'][$post->ID][] = serialize(array('unique_id' => $vals['unique_id'], 'data' => $vals['cssm_data']));
				$kik_notifications['by_id'][$post->ID]['cssm_over'][] = serialize(array('unique_id' => $vals['unique_id'], 'data' => $vals['cssm_data']));
				$kik_messages['SSM: Atentionare - S-a realizat sedinta CSSM'][] = array('post_id' => $post->ID, 'unique_id' => $vals['unique_id'], 'situation' => 'cssm_over');
			}
			
		}
		
		# Echipamente
		$echipamente = get_post_meta($post->ID, 'kik_company_echipamente', true);
		if ($echipamente) foreach ($echipamente as $i => $echipament) {
			
			# if exp day is set,
			# and there are less than 14 days until this day,
			# then generate notification (echipamente_exp_coming)
			if ($echipament['exp'] && date('Y-m-d', time()) < $echipament['exp'] && date('Y-m-d', time() + (60 * 60 * 24 * 14)) >= $echipament['exp']) {
				$kik_notifications['by_type']['echipamente_exp_coming'][$post->ID][] = serialize(array('unique_id' => $echipament['unique_id'], 'id' => $echipament['id'], 'buc' => $echipament['buc'], 'exp' => $echipament['exp']));
				$kik_notifications['by_id'][$post->ID]['echipamente_exp_coming'][] = serialize(array('unique_id' => $echipament['unique_id'], 'id' => $echipament['id'], 'buc' => $echipament['buc'], 'exp' => $echipament['exp']));
				$kik_messages['SSM: Atentionare - Urmeaza sa expire echipamente'][] = array('post_id' => $post->ID, 'unique_id' => $echipament['unique_id'], 'situation' => 'echipamente_exp_coming');
			}
			
			# if iscir day is set,
			# and there are less than 14 days until this day,
			# then generate notification (echipamente_iscir_coming)
			if ($echipament['iscir_bool'] && $echipament['iscir'] && date('Y-m-d', time()) < $echipament['iscir'] && date('Y-m-d', time() + (60 * 60 * 24 * 14)) >= $echipament['iscir']) {
				$kik_notifications['by_type']['echipamente_iscir_coming'][$post->ID][] = serialize(array('unique_id' => $echipament['unique_id'], 'id' => $echipament['id'], 'buc' => $echipament['buc'], 'iscir' => $echipament['iscir']));
				$kik_notifications['by_id'][$post->ID]['echipamente_iscir_coming'][] = serialize(array('unique_id' => $echipament['unique_id'], 'id' => $echipament['id'], 'buc' => $echipament['buc'], 'iscir' => $echipament['iscir']));
				$kik_messages['SSM: Atentionare - Urmeaza sa expire autorizatii ISCIR pentru echipamente'][] = array('post_id' => $post->ID, 'unique_id' => $echipament['unique_id'], 'situation' => 'echipamente_iscir_coming');
			}
			
			# if exp day is set,
			# and this day has passed,
			# then generate alert (echipamente_exp_passed)
			if ($echipament['exp'] && date('Y-m-d', time()) > $echipament['exp']) {
				$kik_alerts['by_type']['echipamente_exp_passed'][$post->ID][] = serialize(array('unique_id' => $echipament['unique_id'], 'id' => $echipament['id'], 'buc' => $echipament['buc'], 'exp' => $echipament['exp']));
				$kik_alerts['by_id'][$post->ID]['echipamente_exp_passed'][] = serialize(array('unique_id' => $echipament['unique_id'], 'id' => $echipament['id'], 'buc' => $echipament['buc'], 'exp' => $echipament['exp']));
				$kik_messages['SSM: Alerta - Au expirat echipamente'][] = array('post_id' => $post->ID, 'unique_id' => $echipament['unique_id'], 'situation' => 'echipamente_exp_passed');
			}
			
			# if iscir day is set,
			# and this day has passed,
			# then generate alert (echipamente_iscir_passed)
			if ($echipament['iscir_bool'] && $echipament['iscir'] && date('Y-m-d', time()) > $echipament['iscir']) {
				$kik_alerts['by_type']['echipamente_iscir_passed'][$post->ID][] = serialize(array('unique_id' => $echipament['unique_id'], 'id' => $echipament['id'], 'buc' => $echipament['buc'], 'exp' => $echipament['iscir']));
				$kik_alerts['by_id'][$post->ID]['echipamente_iscir_passed'][] = serialize(array('unique_id' => $echipament['unique_id'], 'id' => $echipament['id'], 'buc' => $echipament['buc'], 'exp' => $echipament['iscir']));
				$kik_messages['SSM: Alerta - Au expirat autorizatii ISCIR pentru echipamente'][] = array('post_id' => $post->ID, 'unique_id' => $echipament['unique_id'], 'situation' => 'echipamente_iscir_passed');
			}
			
		}
		
		# Facturi neincasate
		$kik_company_billing_deadline = get_post_meta($post->ID, 'kik_company_billing_deadline', true);
		$kik_company_billing_deadline_type = get_post_meta($post->ID, 'kik_company_billing_deadline_type', true);
		$kik_company_billing_history = get_post_meta($post->ID, 'kik_company_billing_history', true);
		if ($kik_company_billing_history) foreach ($kik_company_billing_history as $i => $factura) {
			
			# if bill is not cashed,
			# and bill date is set,
			# and the payment deadline has been exceeded,
			# then generate alert (facturi_not_payed)
			if (!$factura['bill_bool'] && $factura['bill_date'] && date('Y-m-d', time()) > $factura['bill_date']) {
				$kik_alerts_bills['by_type']['facturi_not_payed'][$post->ID][] = serialize(array('unique_id' => $factura['unique_id'], 'nr' => $factura['bill_nr'], 'val' => $factura['bill_val']));
				$kik_alerts_bills['by_id'][$post->ID]['facturi_not_payed'][] = serialize(array('unique_id' => $factura['unique_id'], 'nr' => $factura['bill_nr'], 'val' => $factura['bill_val']));
				$kik_messages['SSM: Alerta - S-a depasit termenul de plata pentru facturi'][] = array('post_id' => $post->ID, 'unique_id' => $factura['unique_id'], 'situation' => 'facturi_not_payed');
			}
			
		}
		
	}
	
	//file_put_contents('KIK_CRON_OUTPUT.txt', 'kik_alerts [[[' . CountObjectDeepestChildren($kik_alerts['by_type']) . ']]] --- ' . DrawObject($kik_alerts['by_type'], 'file'), FILE_APPEND);
	//file_put_contents('KIK_CRON_OUTPUT.txt', 'kik_notifications [[[' . CountObjectDeepestChildren($kik_notifications['by_type']) . ']]] --- ' . DrawObject($kik_notifications['by_type'], 'file'), FILE_APPEND);
	//file_put_contents('KIK_CRON_OUTPUT.txt', 'kik_alerts_bills [[[' . CountObjectDeepestChildren($kik_alerts_bills['by_type']) . ']]] --- ' . DrawObject($kik_alerts_bills['by_type'], 'file'), FILE_APPEND);
	
	update_option('kik_notifications', $kik_notifications);
	update_option('kik_alerts', $kik_alerts);
	update_option('kik_alerts_bills', $kik_alerts_bills);
	
	# call mail function
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









/**/

?>