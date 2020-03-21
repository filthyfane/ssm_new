<?php


#####------------------------------------
##### REGISTER POST TYPES
#####------------------------------------
##### Companii: 	 	kik_company
##### Facturi:  	 	kik_billing
##### Sedinte CSSM:  	kik_cssm
##### Echipamente:   	kik_equipment
##### Angajati:  	 	kik_employee
##### Instructaj:  	 	kik_instructaj
##### Dosare accident:  kik_accident
##### Angajati:  	 	kik_employee
#####------------------------------------


add_action('init', 'kik_create_custom_post_types');
function kik_create_custom_post_types() {
	global $wp_rewrite;
	# Events
	register_post_type('kik_company',
		array(
			'labels' => array(
				'name' => 'Companii',
				'singular_name' => 'Companie',
				'add_new' => 'Adaugă',
				'add_new_item' => 'Adaugă companie',
				'edit_item' => 'Editează companie',
				'new_item' => 'Companie nouă',
				'view_item' => 'Vezi compania',
				'search_items' => 'Caută companie',
				'not_found' => 'Nu s-a găsit nicio companie',
				'not_found_in_trash' => 'Nu s-a găsit nicio companie la Gunoi',
			),
			'description' => '',  # to do
			'public' => true,
			'menu_position' => 31,
			'menu_icon' => 'dashicons-admin-generic',
			'capability_type' => 'post',  # array('company', 'companies'),
			'hierarchical' => false,
			'map_meta_cap' => 'true',
			'supports' => array(
				'title',  # wp absolutely requires either title or editor
			),
			'register_meta_box_cb' => '',  # to do
			'rewrite' => array(
				'slug' => 'companies'
			),
		)
	);
	
	register_post_type('kik_billing',
		array(
			'labels' => array(
				'name' => 'Facturi',
				'singular_name' => 'Factură',
				'add_new' => 'Adaugă',
				'add_new_item' => 'Adaugă factură',
				'edit_item' => 'Editează factură',
				'new_item' => 'Factură nouă',
				'view_item' => 'Vezi factura',
				'search_items' => 'Caută factură',
				'not_found' => 'Nu s-a găsit nicio factură',
				'not_found_in_trash' => 'Nu s-a găsit nicio factură la Gunoi',
			),
			'description' => '',  # to do
			'public' => true,
			'menu_position' => 32,
			'menu_icon' => 'dashicons-admin-generic',
			'capability_type' => 'post',  # array('company', 'companies'),
			'hierarchical' => true,
			'map_meta_cap' => 'true',
			'supports' => array(
				'page-attributes',
				'title',  # wp absolutely requires either title or editor
			),
			'register_meta_box_cb' => '',  # to do
			'rewrite' => array(
				'slug' => 'bill'
			),
		)
	);
	
	//======================================================
	//============= CSSM ===================================
	//======================================================
	
	register_post_type('kik_cssm',
		array(
			'labels' => array(
				'name' => 'Ședințe CSSM',
				'singular_name' => 'Ședință CSSM',
				'add_new' => 'Adaugă',
				'add_new_item' => 'Adaugă ședință',
				'edit_item' => 'Editează ședința',
				'new_item' => 'Ședință nouă',
				'view_item' => 'Vezi ședința',
				'search_items' => 'Caută ședința',
				'not_found' => 'Nu s-a găsit nici o ședință',
				'not_found_in_trash' => 'Nu s-a găsit nici o ședință la Gunoi',
			),
			'description' => '',  # to do
			'public' => true,
			'menu_position' => 33,
			'menu_icon' => 'dashicons-admin-generic',
			'capability_type' => 'post',  # array('company', 'companies'),
			'hierarchical' => true,
			'map_meta_cap' => 'true',
			'supports' => array(
				'page-attributes',
				'title',  # wp absolutely requires either title or editor
			),
			'register_meta_box_cb' => '',  # to do
			'rewrite' => array(
				'slug' => 'sedinta-cssm'
			),
		)
	);
	
	//======================================================
	//============= ECHIPAMENTE =============================
	//======================================================
	
	register_post_type('kik_equipment',
		array(
			'labels' => array(
				'name' => 'Echipamente',
				'singular_name' => 'Echipament',
				'add_new' => 'Adaugă',
				'add_new_item' => 'Adaugă echipament',
				'edit_item' => 'Editează echipament',
				'new_item' => 'Echipament nou',
				'view_item' => 'Vezi echipament',
				'search_items' => 'Caută echipament',
				'not_found' => 'Nu s-a găsit nici un echipament',
				'not_found_in_trash' => 'Nu s-a găsit nici un echipament la Gunoi',
			),
			'description' => '',  # to do
			'public' => true,
			'menu_position' => 34,
			'menu_icon' => 'dashicons-admin-generic',
			'capability_type' => 'post',  # array('company', 'companies'),
			'hierarchical' => true,
			'map_meta_cap' => 'true',
			'supports' => array(
				'page-attributes',
				'title',  # wp absolutely requires either title or editor
			),
			'register_meta_box_cb' => '',  # to do
			'rewrite' => array(
				'slug' => 'echipament'
			),
		)
	);
	
	//======================================================
	//============= ANGAJATI ================================
	//======================================================
	
	register_post_type('kik_employee',
		array(
			'labels' => array(
				'name' => 'Angajați',
				'singular_name' => 'Angajat',
				'add_new' => 'Adaugă',
				'add_new_item' => 'Adaugă angajat',
				'edit_item' => 'Editează angajat',
				'new_item' => 'Angajat nou',
				'view_item' => 'Vezi angajat',
				'search_items' => 'Caută angajat',
				'not_found' => 'Nu s-a găsit nici un angajat',
				'not_found_in_trash' => 'Nu s-a găsit nici un angajat la Gunoi',
			),
			'description' => '',  # to do
			'public' => true,
			'menu_position' => 34,
			'menu_icon' => 'dashicons-admin-generic',
			'capability_type' => 'post',  # array('company', 'companies'),
			'hierarchical' => true,
			'map_meta_cap' => 'true',
			'supports' => array(
				'page-attributes',
				'title',  # wp absolutely requires either title or editor
			),
			'register_meta_box_cb' => '',  # to do
			'rewrite' => array(
				'slug' => 'angajat'
			),
		)
	);
	
	//======================================================
	//============= DOSAR CERCETARE ACCIDENT ===============
	//======================================================
	
		register_post_type('kik_accident',
		array(
			'labels' => array(
				'name' => 'Dosare cercetare accident',
				'singular_name' => 'Dosar cercetare accident',
				'add_new' => 'Adaugă',
				'add_new_item' => 'Adaugă dosar',
				'edit_item' => 'Editează dosar',
				'new_item' => 'Dosar nou',
				'view_item' => 'Vezi dosar',
				'search_items' => 'Caută dosar',
				'not_found' => 'Nu s-a găsit nici un dosar',
				'not_found_in_trash' => 'Nu s-a găsit nici un dosar la Gunoi',
			),
			'description' => '',  # to do
			'public' => true,
			'menu_position' => 34,
			'menu_icon' => 'dashicons-admin-generic',
			'capability_type' => 'post',  # array('company', 'companies'),
			'hierarchical' => true,
			'map_meta_cap' => 'true',
			'supports' => array(
				'page-attributes',
				'title',  # wp absolutely requires either title or editor
			),
			'register_meta_box_cb' => '',  # to do
			'rewrite' => array(
				'slug' => 'dosar'
			),
		)
	);
	
	
	//======================================================
	//============= INSTRUCTAJ ===================================
	//======================================================
	
	register_post_type('kik_instructaj',
		array(
			'labels' => array(
				'name' => 'Instructaje',
				'singular_name' => 'Instructaj',
				'add_new' => 'Adaugă',
				'add_new_item' => 'Adaugă instructaj',
				'edit_item' => 'Editează instructaj',
				'new_item' => 'Instructaj nouă',
				'view_item' => 'Vezi instructajul',
				'search_items' => 'Caută instructaj',
				'not_found' => 'Nu s-a găsit nici un instructaj',
				'not_found_in_trash' => 'Nu s-a găsit nici un instructaj la Gunoi',
			),
			'description' => '',  # to do
			'public' => true,
			'menu_position' => 35,
			'menu_icon' => 'dashicons-admin-generic',
			'capability_type' => 'post',  # array('company', 'companies'),
			'hierarchical' => true,
			'map_meta_cap' => 'true',
			'supports' => array(
				'page-attributes',
				'title',  # wp absolutely requires either title or editor
			),
			'register_meta_box_cb' => '',  # to do
			'rewrite' => array(
				'slug' => 'instructaj'
			),
		)
	);	
	
	$wp_rewrite->flush_rules( true );

}



?>