<?php


#####------------------------------------
##### ACTIONS ON UNINSTALL
#####------------------------------------


register_deactivation_hook(KIK_PLUGIN_ABSPATH, 'KIK_PLUGIN_UNINSTALL');
function KIK_PLUGIN_UNINSTALL() {

	# DO STUFF ON UNINSTALL
	
	# Remove role: kik_inspector_ssm
	$query = new WP_User_Query(array('role' => 'kik_inspector_ssm'));
	$users = $query->results;
	foreach ($users as $user) {
		wp_update_user(array(
			'ID' => $user->data->ID,
			'role' => 'Subscriber',
		));
	}
	# Remove role: kik_agent_de_vanzari
	$query = new WP_User_Query(array('role' => 'kik_agent_de_vanzari'));
	$users = $query->results;
	foreach ($users as $user) {
		wp_update_user(array(
			'ID' => $user->data->ID,
			'role' => 'Subscriber',
		));
	}

}










/**/

?>