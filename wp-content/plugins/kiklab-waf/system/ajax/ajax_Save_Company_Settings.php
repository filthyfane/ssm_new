<?php


#####------------------------------------
##### FRONT END: SAVE POST
#####------------------------------------


##### Save custom post
add_action('wp_ajax_KIK_ACTION_Save_Company_Settings', 'KIK_ACTION_Save_Company_Settings');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_Company_Settings', 'KIK_ACTION_Save_Company_Settings');
function KIK_ACTION_Save_Company_Settings() {
	
	global $wpdb;
	
	validateCompanySettingsPostData($_POST);
	
	update_option('kikCompanyName', $_POST['kikCompanyName']);
	update_option('kikRegisteredOffice', $_POST['kikRegisteredOffice']);
	update_option('kikPhone', $_POST['kikPhone']);
	update_option('kikCity', $_POST['kikCity']);
	update_option('kikCounty', $_POST['kikCounty']);
	update_option('kikPostalCode', $_POST['kikPostalCode']);
	update_option('kikCompanyCui', $_POST['kikCompanyCui']);
	update_option('kikCompanyRecom', $_POST['kikCompanyRecom']);
	
	echo json_encode(['success' => true]);
	wp_die();
}

function validateCompanySettingsPostData($post) {
	$fields = [
		'kikCompanyName' => 'Numele companiei',
		'kikRegisteredOffice' => 'Adresa sediului social',
		'kikPhone' => 'Telefonul',
		'kikCity' => 'Orașul',
		'kikCounty' => 'Județul',
		'kikPostalCode' => 'Codul poștal',
		'kikCompanyCui' => 'Codul unic de înregistrare',
		'kikCompanyRecom' => 'Numărul RECOM'
	];
	
	foreach($fields as $field => $text){
		if(strlen(trim($post[$field])) == 0){
			returnError($text . ' nu este completat!');
		}
	}
}
?>