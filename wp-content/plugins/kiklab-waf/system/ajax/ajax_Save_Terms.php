<?php


#####------------------------------------
##### FRONT END: SAVE TERMS
#####------------------------------------


##### Save custom post
add_action('wp_ajax_KIK_ACTION_Save_Terms', 'KIK_ACTION_Save_Terms_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_Terms', 'KIK_ACTION_Save_Terms_FUNC');
function KIK_ACTION_Save_Terms_FUNC() {
		$params = array();
		parse_str($_POST['big_value'], $taxonomies);
		foreach($taxonomies['taxonomies'] as $taxonomy=> $terms) {
			echo $taxonomy."</br>";
		}
	
	
	global $wpdb;
	
	//echo DrawObject($_POST);
	
	# begin array for kept terms
	//$old_terms_kept = [];
	
	# for each taxonomy received
	//if ($_POST['taxonomies']) foreach ($_POST['taxonomies'] as $taxonomy => $terms) {
	if ($taxonomies['taxonomies']) foreach ($taxonomies['taxonomies'] as $taxonomy => $terms) {
		# for each term in the received taxonomy
		foreach ($terms as $i => $term) {
			# if term exists
			if ($term['id']) {
				# update it
				wp_update_term($term['id'], $taxonomy, array('name' => $term['name'], 'description' => $term['description']));
				# add it to the kept terms array
				$old_terms_kept[] = $term['id'];
			}
			# else insert it
			else {
				$result = KIK_WP_INSERT_TERM($term['name'], $taxonomy, array('description' => $term['description']));
				# add it to the kept terms array
				if (!is_wp_error($result) && $result['term_id']) $old_terms_kept[] = $result['term_id'];
			}
		}
		# remove unkept terms from taxonomy
		foreach (get_terms($taxonomy, array('hide_empty' => false, 'exclude' => $old_terms_kept)) as $term) wp_delete_term($term->term_id, $taxonomy);
	}
	
	//echo json_encode($repeat);
	
	//echo ' {--DONE--} ';
	
	wp_die();
}










/**/

?>