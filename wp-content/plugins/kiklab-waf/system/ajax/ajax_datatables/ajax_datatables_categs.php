<?php

	add_action('wp_ajax_ajax_datatables_categs', 'ajax_datatables_categs');
	add_action('wp_ajax_nopriv_ajax_datatables_categs', 'ajax_datatables_categs');
	
	function ajax_datatables_categs(){

		$kik_cssm 	= array();
		$data_terms = array();
		$taxonomy	= $_POST['taxonomy'];
		$terms 		= get_terms($taxonomy, array('hide_empty' => 0));
		
		if(sizeof($terms)>0){
			foreach($terms as $term){ 
				$data_row	= array();
				$data_row[] = $term->name;
				$data_row[] = $term->description;
				$data_row[] = "<a class='btn btn-danger delete-record' 
								record-id='". $term->term_id . "' 
								record-type='taxonomy_term' 
								taxonomy='". $taxonomy ."'
								data-toggle='modal' 
								data-target='#confirm-delete-modal'>
								Șterge
							</a>
							<a class='btn btn-primary' 
								term-id='". $term->term_id . "' taxonomy='". $taxonomy ."' 
								data-toggle='modal' data-target='#edit-categ-modal'>
								Editează
							</a>";
				$data_terms['data'][] = $data_row;
			}
		} else {
			$data_terms['data'] = '';
		}
		
		echo json_encode($data_terms);
		wp_die();	
	}
?>