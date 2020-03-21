<?php


#####------------------------------------
##### SUPPORT FUNCTIONS
#####------------------------------------


function DrawObject($obj, $mode='display', $depth=0) {
	if ($mode == 'file') {
		$sep = " ";
		$newline = "\n";
	}
	else {
		$sep = "&nbsp;";
		$newline = "<br />";
	}
	$s = '';
	if (is_object($obj) || is_array($obj)) {
		$s.= ' {' . $newline;
		foreach ($obj as $k => $v) {
			$s.= str_repeat($sep, (($depth + 1) * 8)) . '[' . $k . ']';
			$s.= DrawObject($v, $mode, ($depth + 1));
		}
		$s.= str_repeat($sep, ($depth * 8)) . '}';
	}
	else {
		if ($depth > 0) $s.= ' => ';
		if ($obj === NULL) $s.= 'NULL';
		else $s.= '[' . $obj . ']';
	}
	$s.= $newline;
	if ($depth == 0) $s.= $newline;
	return $s;
}

function CountObjectDeepestChildren($obj) {
	
	$count = 0;
	if (is_object($obj) || is_array($obj)) {
		foreach ($obj as $k => $v) {
			$count+= CountObjectDeepestChildren($v);
		}
	}
	elseif ($obj) {
		$count++;
	} 

	return $count;
}

function KIK_ASSIGN_UNIQUE_ID() {
	$unique_id = intval(get_option('kik_unique_id')) + 1;
	update_option('kik_unique_id', $unique_id);
	return $unique_id;
}

function KIK_DROPDOWN_USERS($id='kik_select_unnamed', $name='kik_select_unnamed', $role='', $default='', $allow_null=false) {
	$dropdown = '';
	$query = new WP_User_Query(array(
		'role' => $role,
		'orderby' => 'display_name',
	));
	$users = $query->results;
	$dropdown .= '<select id="' . $id . '" name="' . $name . '" class="form-control">';
	if ($allow_null) { 
		$dropdown .= '<option value="0"'.(0 == $default || '' == $default ? ' selected="selected"' : '').'></option>';
	}
	foreach ($users as $user) {
		$kik_user_roles = get_user_meta($user->data->ID, 'kik_user_roles', true);
		$kik_user_firstname = ucfirst(get_user_meta($user->data->ID, 'first_name', true));
		$kik_user_lastname = ucfirst(get_user_meta($user->data->ID, 'last_name', true));
		$dropdown .= '<option value="' . $user->data->ID . '"'.($user->data->ID == $default ? ' selected="selected"' : '').'>' . $kik_user_lastname . ' ' . $kik_user_firstname . '</option>';
	}
	$dropdown .= '</select>';
	return $dropdown;
}

class KIK_WALKER extends Walker_Category {
	function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
		if(isset($args['value_field'])){
			$value = $category->$args['value_field'];
		} else {
			$value = $category->slug;
		}
		
		$pad = str_repeat('-', $depth * 3) . '&nbsp;';
		$output.= '<option class="level-'.$depth.'" value="'.$value.'"';
		if ($category->term_id == $args['selected']) $output.= ' selected="selected"';
		$output.= '>';
		$output.= $pad.$category->name;
		if ($args['show_count']) {
			$output .= '&nbsp;&nbsp;('. $category->count .')';
		}
		$output.= '</option><br />';
	}
}

function KIK_DROPDOWN_TERMS($id='kik_select_unnamed', $name='kik_select_unnamed', $taxonomy='', $default='', $class='') {
	$kik_walker = new KIK_WALKER();
	//The type of value should match the 'value_field', which is term_id by default 
	return wp_dropdown_categories(array(
		'walker'             => $kik_walker,
		'show_option_all'    => '',
		'show_option_none'   => '',
		'orderby'            => 'NAME', 
		'order'              => 'ASC',
		'show_count'         => 0,
		'hide_empty'         => 0,
		'child_of'           => 0,
		'exclude'            => '',
		'echo'               => 0,
		'selected'           => $default,
		'hierarchical'       => 1, 
		'name'               => $name,
		'id'                 => $id,
		'class'              => $class." form-control",
		'depth'              => 0,
		'tab_index'          => 0,
		'taxonomy'           => $taxonomy,
		'hide_if_empty'      => false,
		'style'				 => ''
	));
}

function KIK_DROPDOWN_POSTS($id='kik_select_unnamed', $name='kik_select_unnamed', $post_type='post', $default='', $class='', $none='') {
	$s = '<select id="' . $id . '" name="' . $name . '" class="' . $class . '">';
	$s.= ($none ? '<option value="-1">' . $none . '</option>' : '');
	global $wpdb;
	$posts = get_posts(array('posts_per_page' => -1, 'post_type' => $post_type, 'post_status' => 'publish', 'order'=> 'ASC', 'orderby' => 'title'));
	foreach ($posts as $post) {
		$s.= '<option value="' . $post->ID . '"' . ($post->ID == $default ? ' selected' : '') . '>' . $post->post_title . '</option>';
	}
	$s.= '</select>';
	return $s;
}

function KIK_DROPDOWN_TERMS_custom($id='kik_select_unnamed', $name='kik_select_unnamed', $taxonomy='', $default='', $class='', $explicit=false) {
	$s = '<select id="' . $id . '" name="' . $name . '" class="' . $class . '">';
	global $wpdb;
	$terms = get_terms('kik_status');
	$s.= ($explicit ? '<option value=""' . (!$default || $default == '' || $default == 0 ? ' selected' : '') . '>' . get_taxonomy($taxonomy)->labels->singular_name . '</option>' : '');
	foreach ($terms as $term) {
		$s.= '<option value="' . $term->slug . '"' . ($term->slug == $default ? ' selected' : '') . '>' . ($explicit ? get_taxonomy($term->taxonomy)->labels->singular_name . ': ' : '') . $term->name . '</option>';
	}
	$s.= '</select>';
	return $s;
}

function KIK_DROPDOWN_DATE_DAY($id='kik_select_unnamed', $name='kik_select_unnamed', $year=2014, $month=1, $default=0, $class='', $display='block') {
	$s = '<select id="' . $id . '" name="' . $name . '" class="' . $class . '" style="display:' . $display . ';" data-dependency="year" data-year="' . $year . '">';
	$s.= '	<option value="0"' . (!$default || $default == '' || $default == 0 ? ' selected' : '') . '></option>';
	for ($day=1; $day<=cal_days_in_month(CAL_GREGORIAN, $month, $year); $day++) {
		$s.= '<option value="' . $day . '"' . ($day == $default ? ' selected' : '') . '>' . $day . '</option>';
	}
	$s.= '</select>';
	return $s;
}

function KIK_WP_INSERT_TERM($term_name, $taxonomy, $args=array()) {
	while (term_exists($term_name, $taxonomy)) $term_name.= '1';
	return wp_insert_term($term_name, $taxonomy, $args);
}

function KIK_SORT_BILLING_HISTORY_BY_DATE_OF_LAST_CASHED_BILL($a, $b) {
	return strcmp($b['bill_date'], $a['bill_date']);
}

function KIK_ADMINS_EMAILS() {
	$users = get_users();
	if ($users) foreach ($users as $user) {
		$kik_user_roles = get_user_meta($user->ID, 'kik_user_roles', true);
		if (is_array($kik_user_roles) && in_array('Administrator', $kik_user_roles)) {
			$emails[] = $user->user_email;
		}
	}
	return $emails;
}

function KIK_MAIL($kik_messages) {
	
	$headers = 'Content-type:text/html;charset=UTF-8' . "\r\n";
	$headers.= 'From: SSM <ssm@instruire-protectiamuncii.ro>';
	
	foreach ($kik_messages as $subject => $aMessages){
		$body = "<h3>".$subject."</h3>";
		$body .= "<ul>";
		foreach($aMessages as $msg){
			$body .= "<li>".$msg."</li>";
		}
		$body .= "</ul>";
		
		wp_mail('stanescu_n_stefan@yahoo.com', $subject, $body, $headers);
		
	}
	# for each topic
	/* foreach ($kik_messages as $topic => $actions) {
		
		# loop through all actions of current topic
		$message = '';
		$ids = array();
		$new_actions = 0;
		
		/* foreach ($actions as $i => $action) {
			
			# if we havent sent mail for this action, include it in the message
			if (!$kik_mails[$action['unique_id']]) {
				$timestamp = time();
				$kik_mails[$action['unique_id']]['timestamp'] = $timestamp;
				$kik_mails[$action['unique_id']]['situation'] = $action['situation'];
				update_option('kik_mails', $kik_mails);
				if (is_array($ids) && !in_array($action['post_id'], $ids)) {
					$message.= '<a href="' . get_permalink($action['post_id']) . '">' . get_post($action['post_id'])->post_title . '</a><br />';
					$ids[] = $action['post_id'];
				}
				$new_actions++;
			}
		} */
		
		# set subject
		//$subject = $topic . ' (' . ($new_actions) . ') - ' . count($ids) . (count($ids) == 1 ? ' firma' : ' firme');
		
		# send mail for this topic
		//wp_mail(KIK_ADMINS_EMAILS(), $subject, $message, $headers);
		
		
		
	//}
	
	//wp_mail('tib@kiklab.com', 'test 66', '<a href="http://www.google.com/">link</a>', 'From: SSM <ssm@100x.ro>');
	
}

//debug wp_mail errors
add_action( 'wp_mail_failed', 'onMailError', 10, 1 );
function onMailError( $wp_error ) {
    echo "<pre>";
    print_r($wp_error);
    echo "</pre>";
}    

#===========================
# GET EQUIPMENTS BY POST ID
#===========================
function getEquipments($postId){
	$args = array(
		'posts_per_page' => -1,
		'post_parent' => $postId,
		'post_type' => 'kik_equipment'
	);
	return get_children($args);
}

#===========================
# GET BILLS BY POST ID
#===========================
function getBills($postId){
	$args = array(
		'post_parent' => $postId,
		'post_type'   => 'kik_billing', 
	);
	return get_children($args);
}

#===========================
# GET COMPANIES BY INSPECTOR
#===========================
function getCompaniesByInspector($inspID){
	$args = array(
		'posts_per_page' => -1,
		'post_type' 	 => 'kik_company',
		'meta_key' 		 => 'kik_company_inspector',
		'meta_value' 	 => $inspID
	);
	return get_posts($args);
}

#=========================================================
# GET BILLS BY DATE INTERVAL, INSPECTOR AND/OR SALES AGENT
#=========================================================
function getBillsByDateInterval($oInspector, $oSalesAgent, $oIntervalStart, $oIntervalEnd){
	
	global $wpdb;
	$query = "SELECT posts1.ID as FacturaId, 
					 posts2.ID as PostId,
					 postmeta2.meta_value as InspectorId,
					 postmeta3.meta_value as SalesAgentId
			FROM wp_posts AS posts1 
			INNER JOIN wp_posts AS posts2 on posts1.post_parent = posts2.ID
			INNER JOIN wp_postmeta AS postmeta1 on posts1.ID = postmeta1.post_id
			INNER JOIN wp_postmeta AS postmeta2 on posts2.ID = postmeta2.post_id
			INNER JOIN wp_postmeta AS postmeta3 on posts2.ID = postmeta3.post_id
			WHERE posts1.post_type = 'kik_billing' AND 
				  (postmeta1.meta_key = 'dataFacturii' AND
				   postmeta1.meta_value > '".$oIntervalStart->format('Y/m/d')."' AND
				   postmeta1.meta_value < '".$oIntervalEnd->format('Y/m/d')."') AND 
				  postmeta2.meta_key = 'kik_company_inspector' AND
				  postmeta3.meta_key = 'kik_company_sales_agent'
	";
	
	if(!is_null($oInspector)){
		$query .= " AND postmeta2.meta_value = ".$oInspector->ID;
	}
	
	if(!is_null($oSalesAgent)){
		$query .= " AND postmeta3.meta_value = ".$oSalesAgent->ID;
	}
	
	return $wpdb->get_results($query, ARRAY_A);
}

#=====================================
# GET ALL COMPANIES
#=====================================
function getAllCompanies(){
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'kik_company',
		'orderby'	=> 'title',
		'order'		=> 'ASC'
	);
	return get_posts($args);
}

#=====================================
# GET ACCIDENT FILES BY COMPANY ID
#=====================================
function getAccidentsByCoId($coId){
	$args = array(
		'post_parent' => $coId,
		'post_type' => 'kik_accident',
	);
	return get_children($args);
}

#====================================
# GET ACCIDENTS BY INTERVAL
#====================================
function getAccidentsByInterval($oStartDate, $oEndDate){
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'kik_accident',
		'orderby' => 'meta_value',
		'order' => 'DESC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' 	  => 'dataAccidentului',
				'value'   => $oStartDate->format('Y/m/d'),
				'compare' => '>='
			),
			array(
				'key'	=> 'dataAccidentului',
				'value' => $oEndDate->format('Y/m/d'),
				'compare' => '<='
			)
		)
	);
	
	return get_posts($args);
}

#======================================
# GET ALL CSSM BY POST ID
#======================================
function getAllCssm($post_id){
	$args = array(
		'post_parent' => $post_id,
		'post_type'   => 'kik_cssm', 
	);
	
	return get_children($args);
}

#======================================
# GET ALL INSTRUCTAJE BY POST ID
#======================================
function getAllInstructajeByPostId($post_id){
	$args = array(
		'post_parent' => $post_id,
		'post_type'   => 'kik_instructaj', 
	);
	return get_children($args);
}

#======================================
# GET ALL INSTRUCTAJE BY DATE INTERVAL
#======================================
function getInstructajeNerealizate($oStartDate, $oEndDate){
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'kik_instructaj',
		'orderby' => 'meta_value',
		'order' => 'DESC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' 	  => 'dataInstructajului',
				'value'   => $oStartDate->format('Y/m/d'),
				'compare' => '>='
			),
			array(
				'key'	  => 'dataInstructajului',
				'value'   => $oEndDate->format('Y/m/d'),
				'compare' => '<='
			),
			array(
				'key'	  => 'realizat',
				'value'   => '0',
				'compare' => '==' 
 			)
		)
	);
	
	return get_posts($args);
}

#======================================
# GET ALL ANGAJATI BY DATE INTERVAL
#======================================
function getAngajatiNoi($oStartDate, $oEndDate){
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'kik_employee',
		'orderby' => 'parent',
		'order' => 'DESC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' 	  => 'contractAngajatStart',
				'value'   => $oStartDate->format('Y/m/d'),
				'compare' => '>='
			),
			array(
				'key'	  => 'contractAngajatStart',
				'value'   => $oEndDate->format('Y/m/d'),
				'compare' => '<='
			),
			array(
				'key'	  => 'contractAngajatSfarsit',
				'value'	  => '',
				'compare' => '='
			)
		)
	);
	
	return get_posts($args);
}

function checkIfCurrUserIsAdmin($user = null){
	
	if(is_null($user)){
		$user = wp_get_current_user();
	}

	$is_admin = false;
	foreach($user->roles as $role){
		if($role == 'administrator'){
			$is_admin = true;
			break;
		}
	}

	return $is_admin;
}

function checkIfUserIsInspector($user = null){
	if(is_null($user)){
		$user = wp_get_current_user();
	}
	
	$is_inspector = false;
	
	foreach($user->roles as $role){
		if($role == 'kik_agent_de_vanzari'){
			$is_inspector = true;
			break;
		}
	}
	
	return $is_inspector;
}

?>