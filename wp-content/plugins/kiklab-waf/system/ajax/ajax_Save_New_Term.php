<?php
	add_action('wp_ajax_KIK_ACTION_Save_New_Term', 'KIK_ACTION_Save_New_Term_FUNC');
	add_action('wp_ajax_nopriv_KIK_ACTION_Save_New_Term', 'KIK_ACTION_Save_New_Term_FUNC');
	function KIK_ACTION_Save_New_Term_FUNC() {
		global $wpdb;
		
		$taxonomy = $_POST['taxonomy'];
		$term	  = $_POST['categ'];	
		$descr	  = $_POST['descr'];
		
		if(term_exists($term, $taxonomy)){
			returnError('Eroare! Categoria ' . $categ . ' exista deja!');
		} else {
			$newTerm = wp_insert_term(
				$term,
				$taxonomy,
				array('description' => $descr)
			);
			
			if(is_wp_error($newTerm)){
				returnError('Eroare! Categoria nu a putut fi salvata!' . $newTerm->get_error_message());
			} else {
				$response = ['success' => true];
			}
		}
		
		echo json_encode($response);
		
		wp_die();
	}
?>