<?php


#####------------------------------------
##### FRONT END: SAVE TERMS
#####------------------------------------
//ajax_Update_Taxonomy_Terms.

##### Save custom post
add_action('wp_ajax_KIK_ACTION_Update_Taxonomy_Terms', 'KIK_ACTION_Update_Taxonomy_Terms');
add_action('wp_ajax_nopriv_KIK_ACTION_Update_Taxonomy_Terms', 'KIK_ACTION_Update_Taxonomy_Terms');

function KIK_ACTION_Update_Taxonomy_Terms(){
	global $wpdb;
	
	$oTerm 				   = get_term($_POST['termId'], $_POST['taxonomy']);
	$slug  				   = sanitize_title($_POST['args']['name']);
	$_POST['args']['slug'] = wp_unique_term_slug($slug, $oTerm);
	$result 			   = wp_update_term($_POST['termId'], $_POST['taxonomy'], $_POST['args']);
	
	if (is_wp_error($result)){
		returnError($result->get_error_message());
	} else {
		$response = [
			'success'  => true,
			'taxonomy' => $_POST['taxonomy']
		];
	}
	
	echo json_encode($response);
	wp_die();
}
?>