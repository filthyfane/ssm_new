<?php

	add_action('wp_ajax_KIK_ACTION_Get_User_Company_Relations', 'KIK_ACTION_Get_User_Company_Relations');
	add_action('wp_ajax_nopriv_KIK_ACTION_Get_User_Company_Relations', 'KIK_ACTION_Get_User_Company_Relations');
	
	function KIK_ACTION_Get_User_Company_Relations(){
		global $wp_roles;
		
		$html 		 = [];
		$multiselect = [];
		$user 		 = get_user_by('id', $_POST['userId']);
		
		if ($user) {
			foreach ($user->roles as $role){
				switch($role){
					case 'kik_ssm':
					case 'administrator':
						break;
					case 'kik_inspector_ssm':
						$multiselect[] = 'kik_company_inspector';
						$html[] = showSelectUserCompanies('Companii asociate ca inspector', 'kik_company_inspector', $user);
						break;
					case 'kik_agent_de_vanzari':
						$multiselect[] = 'kik_company_sales_agent';
						$html[] = showSelectUserCompanies('Companii asociate asociate ca agent de vânzări', 'kik_company_sales_agent', $user);
						break;
					default:
						returnError('Acestui utilizator nu i se pot asocia companii!');
				}
			}
			
			$response = [
				'success' 		=> true,
				'html'	  		=> implode('<hr class="full-width">', $html),
				'multiselect'	=> $multiselect
			];
		} else {
			returnError('Utilizatorul selectat nu există!');
		}
		
		echo json_encode($response);
		die();
	}

	function showSelectUserCompanies($title, $metaKey, $user){
		$html = '<div class="col-sm-12">
			<h4>'.$title.'</h4>
			<select id="'.$metaKey.'" name="'.$metaKey.'[]" multiple>';
		$args = array(
			'post_type' => 'kik_company',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC'
		);
		$posts = get_posts($args);
		
		foreach($posts as $post){
			$associatedUser = get_post_meta($post->ID, $metaKey, true);
			$selected = '';
			if($associatedUser == $user->ID){
				$selected = 'selected';
			}
			
			$html .= '<option value="'.$post->ID.'" '.$selected.'>'.$post->post_title.'</option>';
		}
		
		$html .= '</select></div>';
		return $html;
	}
?>