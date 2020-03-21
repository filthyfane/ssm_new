<?php


#####------------------------------------
##### CREATE FILTERS FOR CUSTOM FIELDS
#####------------------------------------


add_action('restrict_manage_posts', 'kik_admin_posts_generate_custom_filters');
function kik_admin_posts_generate_custom_filters() {
	# Check post type
	$post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
	
	# COMPANY
	if ($post_type == 'kik_company') {
		
		# STATUS
		
		echo KIK_DROPDOWN_TERMS_custom('KIK_FILTER_STATUS', 'KIK_FILTER_STATUS', 'kik_status', (isset($_GET['KIK_FILTER_STATUS']) ? $_GET['KIK_FILTER_STATUS'] : ''), '', true);
		
	}
}



#####------------------------------------
##### THE FILTERING ACTION
#####------------------------------------


add_filter('parse_query', 'kik_admin_posts_filter_action');
function kik_admin_posts_filter_action($query){
	global $pagenow;
	$post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
	if (is_admin() && $pagenow == 'edit.php') {
		
		# COMPANY
		if ($post_type == 'kik_company') {
			# Pass custom taxonomy query to wp_query object
			if (isset($_GET['KIK_FILTER_STATUS']) && $_GET['KIK_FILTER_STATUS'] != '') $query->query_vars['kik_status'] = $_GET['KIK_FILTER_STATUS'];
		}
		
		$query->query_vars['orderby'] = 'title';
		$query->query_vars['order'] = 'ASC';
		
		//echo DrawObject($query);
	}
}



#####------------------------------------
##### POSTS LIST: CUSTOM COLUMNS
#####------------------------------------


### COMPANY
add_filter('manage_kik_company_posts_columns', 'kik_company_posts_listing_table_head');
function kik_company_posts_listing_table_head($defaults) {
	$new['cb'] = $defaults['cb'];
	$new['kik_company_flags'] = '';
	//$new['title'] = 'Companie';
	$new['kik_company_title'] = 'Companie';
	$new['kik_company_service_frequency'] = 'Periodicitate instructaj';
	$new['kik_company_contact_person'] = 'Persoana de contact';
	$new['kik_company_assignees'] = 'Inspector / Agent de vanzari';
	//$new['author'] = 'Created by';
	//$new['date'] = 'Created on';
	$new['kik_company_status'] = 'Status';
	$new['kik_company_actions'] = '';
	return $new;
}
add_action('manage_kik_company_posts_custom_column', 'kik_company_posts_listing_table_content', 10, 2 );
function kik_company_posts_listing_table_content($column_name, $post_id) {
	
	echo '<div class="valwrap';
	
	# TITLE
	
	if ($column_name == 'kik_company_title') {
		$cif = get_post_meta($post_id, 'kik_company_cif', true);
		$reg = get_post_meta($post_id, 'kik_company_reg', true);
		$angajati = get_post_meta($post_id, 'kik_company_angajati', true);
		$facturi = get_post_meta($post_id, 'kik_company_billing_history', true);
		$val = '<a class="row-title" href="' . get_edit_post_link($post_id) . '">' . get_the_title($post_id) . '</a>';
		$val.= '<br />' . $cif . ($cif && $reg ? ', ' : '') . $reg;
		//$val.= '<br />' . ($angajati ? count($angajati) : '0') . ' angaja' . ($angajati && count($angajati) == 1 ? 't' : 'ți');
		//$val.= '<br />' . ($facturi ? count($facturi) : '0') . ' factur' . ($facturi && count($facturi) == 1 ? 'ă' : 'i');
		echo '">';
		echo $val;
	}
	
	# FLAGS
	
	if ($column_name == 'kik_company_flags') {
		echo '">';
		/*
		echo '<div style="position:relative; width:100%; height:100%;">';
		if (rand(1,5) <= 2) echo '<div style="position:absolute; right:0; width:18px; height:18px; border-radius:50%; background:orange; color:white; font-weight:bold; text-align:center; padding:3px;">'.rand(1,15).'</div>';
		if (rand(1,5) <= 2) echo '<div style="position:absolute; right:28px; width:18px; height:18px; border-radius:50%; background:red; color:white; font-weight:bold; text-align:center; padding:3px;">'.rand(1,15).'</div>';
		echo '</div>';
		*/
	}
	
	# SERVICE FREQUENCY
	
	elseif ($column_name == 'kik_company_service_frequency') {
		echo '">';
		echo '<span style="font-weight:bold;"><i class="fa fa-clock-o"></i> ' . ($try = wp_get_object_terms($post_id, 'kik_periodicitate_instructaj') ? $try[0]->name : '--') . '</span>';
	}
	
	# LEGAL REP
	
	elseif ($column_name == 'kik_company_contact_person') {
		echo '">';
		echo '<i class="fa fa-user"></i> <b>' . get_post_meta($post_id, 'kik_company_contact_person_name', true) . '</b><br /><i class="fa fa-phone"></i> ' . get_post_meta($post_id, 'kik_company_contact_person_phone', true) . '<br /><i class="fa fa-envelope"></i> ' . get_post_meta($post_id, 'kik_company_contact_person_email', true);
	}
	
	# INSPECTOR / SALES AGENT
	
	elseif ($column_name == 'kik_company_assignees') {
		echo '">';
		echo '<div class="kik_company_post_listing_select_row color-blue">';
		echo '	<div class="kik_company_post_listing_select_row_edit">';
		echo '		<i class="fa fa-user"></i>';
		echo 		KIK_DROPDOWN_USERS('kik_company_inspector-'.$post_id, 'kik_company_inspector-'.$post_id, 'kik_inspector_ssm', get_userdata(get_post_meta($post_id, 'kik_company_inspector', true))->ID, false, 'size_full');
		echo '	</div>';
		echo '</div>';
		echo '<div class="kik_company_post_listing_select_row color-orange">';
		echo '	<div class="kik_company_post_listing_select_row_edit">';
		echo '		<i class="fa fa-user"></i>';
		echo 		KIK_DROPDOWN_USERS('kik_company_sales_agent-'.$post_id, 'kik_company_sales_agent-'.$post_id, 'kik_agent_de_vanzari', get_userdata(get_post_meta($post_id, 'kik_company_sales_agent', true))->ID, false, 'size_full');
		echo '	</div>';
		echo '</div>';
	}
	
	# STATUS
	
	elseif ($column_name == 'kik_company_status') {
		echo '">';
		echo '<div class="kik_company_post_listing_select_row color-'.(($try = wp_get_object_terms($post_id, 'kik_status')) && ($try[0]->name == 'Activ') ? 'green' : 'red').'">';
		echo '	<div class="kik_company_post_listing_select_row_edit">';
		echo '		<i class="fa fa-circle"></i>';
		echo 
			KIK_DROPDOWN_TERMS(
				'kik_company_status-'.$post_id,
				'kik_company_status-'.$post_id,
				'kik_status',
				(($try = wp_get_object_terms($post_id, 'kik_status')) ? $try[0]->term_id : 0),
				'size_full',
				''
			);
		echo '	</div>';
		echo '</div>';
	}
	
	# ACTIONS
	
	elseif ($column_name == 'kik_company_actions') {
		echo '">';
		echo '<div class="button button-primary button-large">Update</div>';
		echo '<div class="kik_message"></div>';
	}
	
	# AUTOR
	/*
	elseif ($column_name == 'kik_company_autor') {
		echo '">';
		echo the_author_meta('display_name', get_post_field('post_author', $post_id));
	}
	*/
	
	echo '</div>';
}










/**/

?>