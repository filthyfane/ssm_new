<?php


#####------------------------------------
##### LOAD SCRIPTS AND STYLES
#####------------------------------------

add_action( 'wp_enqueue_scripts', 'kik_add_scripts' );
function kik_add_scripts() {
	###################################################################
	# 			ENQUEUE COMMON STYLES
	###################################################################
	//wp_enqueue_style('kik_font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
	wp_enqueue_style('bootstrap-3.3.7', plugins_url('plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css' , dirname(__FILE__)));
	wp_enqueue_style('datatables-css', plugins_url('plugins/DataTables/datatables.min.css' , dirname(__FILE__)));
	wp_enqueue_style('datatables-buttons-css', plugins_url('plugins/DataTables/Buttons-1.4.2/css/buttons.dataTables.min.css' , dirname(__FILE__)));
	wp_enqueue_style('datetimepicker-css', plugins_url('plugins/bootstrap-datetimepicker-4.17.47/build/css/bootstrap-datetimepicker.min.css' , dirname(__FILE__)));
	wp_enqueue_style('kik_style', plugins_url('style/style.css' , dirname(__FILE__)));
	
	
	###################################################################
	# 			ENQUEUE COMMON SCRIPTS
	###################################################################
	
	wp_enqueue_script('kik_datetimepicker', plugins_url('scripts/datetimepicker/datetimepicker.js' , dirname(__FILE__)), array('jquery'));
	wp_enqueue_script('kik_moment', plugins_url('plugins/moment.js', dirname(__FILE__)), array('jquery'));
	wp_enqueue_script('kik_bootstrap_collapse', plugins_url('plugins/bootstrap-3.3.7-dist/js/collapse.js', dirname(__FILE__)), array('jquery'));
	wp_enqueue_script('kik_bootstrap_transition', plugins_url('plugins/bootstrap-3.3.7-dist/js/transition.js', dirname(__FILE__)), array('jquery'));
	wp_enqueue_script('datatables-js', plugins_url('plugins/DataTables/datatables.min.js' , dirname(__FILE__)), array('jquery'));
	wp_enqueue_script('datatables-buttons-js', plugins_url('plugins/DataTables/Buttons-1.4.2/js/dataTables.buttons.min.js' , dirname(__FILE__)), array('jquery'));
	wp_enqueue_script('bootstrap-js-3.3.7', plugins_url('plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js' , dirname(__FILE__)), array('jquery'), false, true);
	wp_enqueue_script('kik_bootstrap_datepicker', plugins_url('plugins/bootstrap-datetimepicker-4.17.47/build/js/bootstrap-datetimepicker.min.js', dirname(__FILE__)), array('jquery', 'kik_moment'));	
	wp_enqueue_script('kik_scripts', plugins_url('scripts/scripts.js' , dirname(__FILE__)), array('jquery'));		
	
	###################################################################
	#           ENQUEUE CUSTOM STYLES/SCRIPTS
	###################################################################
	
	if(is_page('categorii-de-date')){
		wp_enqueue_script('kik_categorii_date_script', plugins_url('scripts/script_page_categorii_date.js' , dirname(__FILE__)), array('jquery', 'kik_scripts'));
	}
	
	if(is_page('administrare-utilizatori')){
		wp_enqueue_script('kik_users_script', plugins_url('scripts/script_page_manage_users.js', dirname(__FILE__)), array('jquery', 'kik_scripts'));
		wp_enqueue_script('lou-multi-select', plugins_url('plugins/lou-multi-select/js/jquery.multi-select.js', dirname(__FILE__)), array('jquery', 'kik_scripts'));
		wp_enqueue_style('lou-multi-select-style', plugins_url('plugins/lou-multi-select/css/multi-select.css', dirname(__FILE__)));
	}
	
	if(is_page('rapoarte')){
		wp_enqueue_script('kik_reports', plugins_url('scripts/script_reports.js', dirname(__FILE__)), array('jquery', 'kik_scripts'));
	}
	
	if(is_singular('kik_company')){
		wp_enqueue_script('kik-post-type-company-script', plugins_url('scripts/script_manage_company.js', dirname(__FILE__)), array('jquery', 'kik_scripts'));
		wp_enqueue_script('select2', plugins_url('plugins/select2/js/select2.min.js', dirname(__FILE__)), array('jquery', 'kik_scripts'));
		wp_enqueue_style('css-select2', plugins_url('plugins/select2/css/select2.min.css', dirname(__FILE__)));
	}
	
	if(is_page('firma-noua')){
		wp_enqueue_script('kik-post-type-company-script', plugins_url('scripts/script_add_company.js', dirname(__FILE__)), array('jquery', 'kik_scripts'));
		wp_enqueue_script('select2', plugins_url('plugins/select2/js/select2.min.js', dirname(__FILE__)), array('jquery', 'kik_scripts'));
		wp_enqueue_style('css-select2', plugins_url('plugins/select2/css/select2.min.css', dirname(__FILE__)));
	}
	
	if(is_front_page()){
		wp_enqueue_script('kik-all-companies-script', plugins_url('scripts/script_all_companies.js', dirname(__FILE__)), array('jquery', 'kik_scripts'));
	}
	
	if(is_page('alerte-si-atentionari')){
		wp_enqueue_script('kik-notifications', plugins_url('scripts/script_notifications.js', dirname(__FILE__)), array('jquery', 'kik_scripts'));
	}
	
	if (is_page('login-to-ssm')) {
		//var_dump(wp_hash_password('stefan'));
		wp_enqueue_style('login-to-ssm', plugins_url('style/login-to-ssm.css', dirname(__FILE__)));
		wp_enqueue_script('script-login-to-ssm', plugins_url('scripts/script_login_to_ssm.js', dirname(__FILE__)), array('jquery'));
	}
	
	if (is_author()) {
		wp_enqueue_script('script-author', plugins_url('scripts/script_author.js', dirname(__FILE__)), array('jquery'));
	}


	if (is_page('setari-companie')) {
		wp_enqueue_script('script-save-company-settings', plugins_url('scripts/script_company_settings.js', dirname(__FILE__)), array('jquery'));
	}
	
	# pass various WP params to scripts
	$WP_PARAMS = array(
		'URL_WP' => get_site_url(),
		'URL_AJAX' => admin_url('admin-ajax.php'),
		'URL_DATETIMEPICKER' => plugins_url('scripts/datetimepicker/' , dirname(__FILE__)),
	);
	wp_localize_script('kik_datetimepicker', 'WP_PARAMS', $WP_PARAMS);
	wp_localize_script('kik_scripts', 'WP_PARAMS', $WP_PARAMS);
	
}

###################################################################
# 			ADMIN ENQUEUE SCRIPT/STYLES
###################################################################
	add_action('admin_enqueue_scripts', 'register_admin_scripts');
	function register_admin_scripts(){
		wp_enqueue_style('bootstrap-3.3.7', plugins_url('plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css' , dirname(__FILE__)));
		wp_enqueue_script('kik_bootstrap_collapse', plugins_url('plugins/bootstrap-3.3.7-dist/js/collapse.js', dirname(__FILE__)), array('jquery'));
		wp_enqueue_script('kik_bootstrap_transition', plugins_url('plugins/bootstrap-3.3.7-dist/js/transition.js', dirname(__FILE__)), array('jquery'));
	}

### Delete stuff from admin menu
//add_action('admin_menu', 'hide_wp_admin_menus');
function hide_wp_admin_menus() {
    if (!in_array(wp_get_current_user()->ID, array('1'))) {
		//remove_menu_page('index.php');
		remove_submenu_page('index.php', 'update-core.php');
		remove_menu_page('edit.php');
		remove_menu_page('upload.php');
		remove_menu_page('edit.php?post_type=page');
		remove_menu_page('edit-comments.php');
		remove_menu_page('themes.php');
		remove_menu_page('plugins.php');
		remove_menu_page('tools.php');
		remove_menu_page('options-general.php');
	}
    if (!in_array(wp_get_current_user()->ID, array('1', '8', '7'))) {
		remove_menu_page('users.php');
			remove_menu_page('profile.php');
	}
}

### Add stuff to admin menu
add_action('admin_menu', 'create_custom_admin_menus');
function create_custom_admin_menus() {
   // if (1==1 || wp_get_current_user()->ID == '1') {
		//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position )
		//add_menu_page('Page title', 'Page menu title', 'read', 'page_menu_slug', 'kik_custom_admin_menu_page_Page', 'dashicons-sos', 32);
			//add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function )
			//add_submenu_page('page_menu_slug', 'Subpage title', 'Subpage menu title', 'read', 'subpage_menu_slug', 'kik_custom_admin_menu_page_Subpage');
	//}
}
/*function kik_custom_admin_menu_page_Page() {
	echo 'Page!';
}
function kik_custom_admin_menu_page_Subpage() {
	echo 'Subpage!';
}*/

### Force admin color scheme
add_filter('get_user_option_admin_color', function($color_scheme) {
	$color_scheme = 'ectoplasm';
	return $color_scheme;
}, 5 );

### Always hide wp admin bar at the top of the frontend pages
//show_admin_bar(false);

### Disable post locking
add_filter('show_post_locked_dialog', '__return_false');

### Redirect visitors to login page and logged in users out of admin area
//add_action('init', function(){
add_action('template_redirect', function(){
	if (!is_user_logged_in() 
		&& !is_page('login-to-ssm')
		//&& !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))
		&& !KIK_DOING_CRON
	){
		wp_redirect(get_site_url(null, 'login-to-ssm')); exit;
		//auth_redirect(); 
	}
	//if (is_user_logged_in() && is_admin() && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') && !in_array(wp_get_current_user()->ID, array('1'))) { wp_redirect(site_url()); }
});

/**/

?>