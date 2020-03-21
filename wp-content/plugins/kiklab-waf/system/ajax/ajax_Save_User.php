<?php


#####------------------------------------
##### FRONT END: SAVE POST
#####------------------------------------


##### Save custom post
add_action('wp_ajax_KIK_ACTION_Save_User', 'KIK_ACTION_Save_User_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_User', 'KIK_ACTION_Save_User_FUNC');
function KIK_ACTION_Save_User_FUNC() {
	
	global $wpdb;
	
	//echo DrawObject($_POST);
	
	# validate name
	if ($_POST['kik_user_first_name'] == '') $repeat['first_name'] = 'empty';
	if ($_POST['kik_user_last_name'] == '') $repeat['last_name'] = 'empty';
	# validate email
	if ($_POST['kik_user_email'] == '') $repeat['email'] = 'empty';
	elseif (!filter_var($_POST['kik_user_email'], FILTER_VALIDATE_EMAIL)) $repeat['email'] = 'invalid';
	elseif (email_exists($_POST['kik_user_email']) && email_exists($_POST['kik_user_email']) != $_POST['ID']) $repeat['email'] = 'exists';
	# validate pass
	if ($_POST['kik_user_pass'] !== $_POST['kik_user_pass_confirm']) $repeat['pass_confirm'] = 'mismatch';
	elseif (($_POST['kik_action'] == 'add' && strlen($_POST['kik_user_pass']) < 6) || (strlen($_POST['kik_user_pass']) > 0 && strlen($_POST['kik_user_pass']) < 6)) $repeat['pass'] = 'short';
	
	if ($repeat) $repeat['status'] = 0;
	else {
		
		$repeat['status'] = 1;
		
		if ($_POST['kik_action'] == 'edit') {
			
			$update['ID'] = $_POST['ID'];
			$user = get_user_by('id', $update['ID']);
			
			### Datele contului
			
			# FIRST NAME
			$update['first_name'] = $_POST['kik_user_first_name'];
			# LAST NAME
			$update['last_name'] = $_POST['kik_user_last_name'];
			# LOGIN
			//$update['user_login'] = $update['first_name'] . '.' . $update['last_name'];
			# EMAIL
			$update['user_email'] = $_POST['kik_user_email'];
			# PASSWORD
			if (strlen($_POST['kik_user_pass']) > 0 && strlen($_POST['kik_user_pass_confirm']) > 0 && !$repeat['pass'] && !$repeat['pass_confirm']) wp_set_password($_POST['kik_user_pass'], $update['ID']);
			# ROLES
			update_user_meta($update['ID'], 'kik_user_roles', $_POST['kik_user_roles']);
			
			wp_update_user($update);
			
			### Firme asociate
			
			$args = array(
				'post_type' => 'kik_company',
				'posts_per_page' => -1,
			);
			$companies = get_posts($args);
			foreach ($companies as $company) {
				# Agent de vanzari
				if (is_array($_POST['kik_user_companies_sales_associated']) && in_array($company->ID, $_POST['kik_user_companies_sales_associated'])) update_post_meta($company->ID, 'kik_company_sales_agent', $update['ID']);
				else update_post_meta($company->ID, 'kik_company_sales_agent', '', $update['ID']);
				# Inspector SSM
				if (is_array($_POST['kik_user_companies_inspector_associated']) && in_array($company->ID, $_POST['kik_user_companies_inspector_associated'])) update_post_meta($company->ID, 'kik_company_inspector', $update['ID']);
				else update_post_meta($company->ID, 'kik_company_inspector', '', $update['ID']);
			}
			
		}
		else {
			
			# create new user from login, email and password
			$new_user_username = strtolower(preg_replace("/[^[:alnum:]]/ui", '', $_POST['kik_user_first_name'])) . '.' . strtolower(preg_replace("/[^[:alnum:]]/ui", '', $_POST['kik_user_last_name']));
			if (username_exists($new_user_username)) $new_user_username.= '1';
			$update['ID'] = wp_create_user($new_user_username, $_POST['kik_user_pass'], $_POST['kik_user_email']);
			
			# add first name and last name
			$update['first_name'] = $_POST['kik_user_first_name'];
			$update['last_name'] = $_POST['kik_user_last_name'];
			$update['role'] = 'kik_ssm';
			wp_update_user($update);
			
		}
		
	}
	
	echo json_encode($repeat);
	
	//echo ' {--DONE--} ';
	
	wp_die();
}










/**/

?>