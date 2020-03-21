<?php


#####------------------------------------
##### ACTIONS ON INSTALL
#####------------------------------------


register_activation_hook(KIK_PLUGIN_ABSPATH, 'KIK_PLUGIN_INSTALL');
function KIK_PLUGIN_INSTALL() {
	
	# DO STUFF ON INSTALL
	
	# Add role: kik_inspector_ssm
	add_role('kik_inspector_ssm', 'Inspector SSM', array(
		'delete_posts' => true,
		'delete_published_posts' => true,
		'edit_posts' => true,
		'edit_published_posts' => true,
		'publish_posts' => true,
		'read' => true,
		'upload_files' => true,
	));
	# Add role: kik_agent_de_vanzari
	add_role('kik_agent_de_vanzari', 'Agent de vanzari', array(
		'delete_posts' => true,
		'delete_published_posts' => true,
		'edit_posts' => true,
		'edit_published_posts' => true,
		'publish_posts' => true,
		'read' => true,
		'upload_files' => true,
	));
}

?>