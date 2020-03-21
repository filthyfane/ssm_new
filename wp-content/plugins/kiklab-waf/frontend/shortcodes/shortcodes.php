<?php


#####------------------------------------
##### REGISTER SHORTCODES
#####------------------------------------

add_action('init', 'register_shortcodes');

function register_shortcodes(){
	// Wordpress 5.3 Shortcode functions should return the text that is to be used to replace the shortcode.
	add_shortcode('kik_companies', 'kik_companies_FUNC');
	add_shortcode('kik_new_company', 'kik_new_company_FUNC');
	add_shortcode('kik_import_data', 'kik_import_data_FUNC');
	add_shortcode('kik_manage_categories', 'kik_manage_categories_FUNC');
	add_shortcode('kik_manage_users', 'kik_manage_users_FUNC');
	add_shortcode('kik_new_user', 'kik_new_user_FUNC');
	add_shortcode('kik_reports', 'kik_reports_FUNC');
	add_shortcode('kik_notifications', 'kik_notifications_FUNC');
	add_shortcode('kik_setari_companie', 'kik_setari_companie_FUNC');
}

include(KIK_PLUGIN_ABSPATH . 'frontend/shortcodes/kik_companies.php');
include(KIK_PLUGIN_ABSPATH . 'frontend/shortcodes/kik_new_company.php');
include(KIK_PLUGIN_ABSPATH . 'frontend/shortcodes/kik_import_data.php');
include(KIK_PLUGIN_ABSPATH . 'frontend/shortcodes/kik_manage_categories.php');
include(KIK_PLUGIN_ABSPATH . 'frontend/shortcodes/kik_manage_users.php');
include(KIK_PLUGIN_ABSPATH . 'frontend/shortcodes/kik_new_user.php');
include(KIK_PLUGIN_ABSPATH . 'frontend/shortcodes/kik_reports.php');
include(KIK_PLUGIN_ABSPATH . 'frontend/shortcodes/kik_notifications.php');
include(KIK_PLUGIN_ABSPATH . 'frontend/shortcodes/kik_setari_companie.php');

?>