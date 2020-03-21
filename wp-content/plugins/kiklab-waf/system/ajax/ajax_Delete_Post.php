<?php


#####------------------------------------
##### FRONT END: DELETE POST
#####------------------------------------


##### Delete custom post
add_action('wp_ajax_KIK_ACTION_Delete_Post', 'KIK_ACTION_Delete_Post_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Delete_Post', 'KIK_ACTION_Delete_Post_FUNC');
function KIK_ACTION_Delete_Post_FUNC() {
	
	global $wpdb;
	
	//echo DrawObject($_POST);
	
	$kik_ID = $_POST['ID'];
	
	# delete wp post
	wp_delete_post($kik_ID, true);  # true = force delete (bypass trash)
	
	# delete kik data
	KIK_ACTION_Cron_Test_FUNC();
	
	//echo ' {--DONE--} ';
	
	wp_die();
}










/**/

?>