<?php
/*
Plugin Name: Kiklab WAF
Plugin URI: http://www.kiklab.com/
Description: Wordpress Application Framework.
Version: 1.0
Author: Kiklab
Author URI: http://www.kiklab.com/
*/



#####------------------------------------
##### GLOBAL VARS
#####------------------------------------

define('KIK_PLUGIN_FOLDER', basename(dirname(__FILE__)));
define('KIK_PLUGIN_ABSPATH', trailingslashit(str_replace('\\', '/', WP_PLUGIN_DIR . '/' . KIK_PLUGIN_FOLDER)));
define('KIK_PLUGIN_URLPATH', trailingslashit(plugins_url(KIK_PLUGIN_FOLDER)));
define('KIK_DOING_CRON', false);

update_option('kik_user_roles', array(
	'Administrator',
	'Agent de vânzări',
	'Inspector SSM',
));



#####------------------------------------
##### REQUIRED FILES
#####------------------------------------


//require_once(ABSPATH . 'wp-includes/pluggable.php');
//require_once(KIK_PLUGIN_ABSPATH . 'system/on_install.php');
//require_once(KIK_PLUGIN_ABSPATH . 'system/on_uninstall.php');
require_once(KIK_PLUGIN_ABSPATH . 'system/setup.php');
require_once(KIK_PLUGIN_ABSPATH . 'system/functions.php');
require_once(KIK_PLUGIN_ABSPATH . 'system/ajax.php');
require_once(KIK_PLUGIN_ABSPATH . 'system/register_taxonomies.php');
require_once(KIK_PLUGIN_ABSPATH . 'system/register_post_types.php');
//require_once(KIK_PLUGIN_ABSPATH . 'backend/user_edit.php');
require_once(KIK_PLUGIN_ABSPATH . 'backend/post_edit.php');
//require_once(KIK_PLUGIN_ABSPATH . 'backend/post_listing.php');
require_once(KIK_PLUGIN_ABSPATH . 'frontend/shortcodes/shortcodes.php');
require_once(KIK_PLUGIN_ABSPATH . 'frontend/shortcodes/kik_new_company.php');
require_once(KIK_PLUGIN_ABSPATH . 'plugins/fpdf/fpdf.php');
require_once(KIK_PLUGIN_ABSPATH . 'plugins/fpdf_table_extension/fpdf_table_extension.php');
require_once(KIK_PLUGIN_ABSPATH . 'plugins/tcpdf/tcpdf.php');

register_activation_hook( __FILE__ , function(){
	
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
	
});



add_filter( 'login_redirect', function( $url, $query, $user ) {
	return home_url();
}, 10, 3 );




/**/

?>