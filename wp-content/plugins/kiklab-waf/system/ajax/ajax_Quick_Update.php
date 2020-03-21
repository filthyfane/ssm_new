<?php


#####------------------------------------
##### FRONT END: SAVE POST
#####------------------------------------


##### Save custom post
add_action('wp_ajax_KIK_ACTION_Quick_Update_Company', 'KIK_ACTION_Quick_Update_Company_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Quick_Update_Company', 'KIK_ACTION_Quick_Update_Company_FUNC');
function KIK_ACTION_Quick_Update_Company_FUNC() {
	
	global $wpdb;
	
	if(isset($_POST['inspectorId'])){
		update_post_meta($_POST['postId'], 'kik_company_inspector', $_POST['inspectorId']);
	} 
	if(isset($_POST['salesAgentId'])){
		update_post_meta($_POST['postId'], 'kik_company_sales_agent', $_POST['salesAgentId']);
	}
	if(isset($_POST['companyStatus'])){
		wp_set_object_terms($_POST['postId'], $_POST['companyStatus'], 'kik_status', false);
	}
	
	$response = [
		'success' => true,
		'dataTableId' => 'kik_all_companies'
	];
	
	echo json_encode($response);
	wp_die();
}










/**/

?>