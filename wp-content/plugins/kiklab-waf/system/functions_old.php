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
	$query = new WP_User_Query(array(
		'role' => $role,
		'orderby' => 'display_name',
	));
	$users = $query->results;
		
	echo '<select id="' . $id . '" name="' . $name . '" class="form-control">';
	if ($allow_null) echo '<option value="0"'.(0 == $default || '' == $default ? ' selected="selected"' : '').'></option>';
	foreach ($users as $user) {
		$kik_user_roles = get_user_meta($user->data->ID, 'kik_user_roles', true);
		$kik_user_firstname = ucfirst(get_user_meta($user->data->ID, 'first_name', true));
		$kik_user_lastname = ucfirst(get_user_meta($user->data->ID, 'last_name', true));
		//if (is_array($kik_user_roles) && in_array($role, $kik_user_roles)) {
			echo '<option value="' . $user->data->ID . '"'.($user->data->ID == $default ? ' selected="selected"' : '').'>' . $kik_user_lastname . ' ' . $kik_user_firstname . '</option>';
		//}
	}
	echo '</select>';
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
	wp_dropdown_categories(array(
		'walker'             => $kik_walker,
		'show_option_all'    => '',
		'show_option_none'   => '',
		'orderby'            => 'NAME', 
		'order'              => 'ASC',
		'show_count'         => 0,
		'hide_empty'         => 0,
		'child_of'           => 0,
		'exclude'            => '',
		'echo'               => 1,
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
	
	# prepare headers
	$headers = 'Content-type:text/html;charset=UTF-8' . "\r\n";
	$headers.= 'From: SSM <ssm@instruire-protectiamuncii.ro>';
	
	# get previously sent emails
	$kik_mails = get_option('kik_mails');
	
	//echo DrawObject($kik_messages, 'file');
	
	# for each topic
	foreach ($kik_messages as $topic => $actions) {
		
		# loop through all actions of current topic
		$message = '';
		$ids = array();
		$new_actions = 0;
		foreach ($actions as $i => $action) {
			
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
			
		}
		
		# set subject
		$subject = $topic . ' (' . ($new_actions) . ') - ' . count($ids) . (count($ids) == 1 ? ' firma' : ' firme');
		
		# send mail for this topic
		wp_mail(KIK_ADMINS_EMAILS(), $subject, $message, $headers);
	}
	
	//wp_mail('tib@kiklab.com', 'test 66', '<a href="http://www.google.com/">link</a>', 'From: SSM <ssm@100x.ro>');
	
}










/**/

?>