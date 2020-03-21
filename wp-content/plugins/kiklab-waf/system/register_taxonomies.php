<?php


#####------------------------------------
##### REGISTER TAXONOMIES
#####------------------------------------
## kik_cod_caen
## kik_tip_contract
## kik_periodicitate_instructaj
## kik_perioada_de_facturare
## kik_status
## kik_documente_predate
## kik_echipamente
## kik_norme_lucru
## kik_ani_instructaj
## kik_tipuri_evenimente
## kik_tipuri_instructaj


add_action('init', 'kik_create_custom_taxonomies', 0);
function kik_create_custom_taxonomies() {
	
	# Taxonomy: kik_cod_caen
	register_taxonomy('kik_cod_caen', 'kik_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => 'Coduri CAEN',
				'singular_name' => 'Cod CAEN',
			),
			'rewrite' => array(
				'slug' => 'coduri-caen',
				'with_front' => false,
			),
		)
	);
	
	# Taxonomy: kik_tip_contract
	register_taxonomy('kik_tip_contract', 'kik_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => 'Tipuri de contracte',
				'singular_name' => 'Tip de contract',
			),
			'rewrite' => array(
				'slug' => 'tipuri-de-contract',
				'with_front' => false,
			),
		)
	);
	
	# Taxonomy: kik_periodicitate_instructaj
	register_taxonomy('kik_periodicitate_instructaj', 'kik_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => 'Periodicitate instructaj',
				'singular_name' => 'Periodicitate instructaj',
			),
			'rewrite' => array(
				'slug' => 'periodicitate-instructaj',
				'with_front' => false,
			),
		)
	);
	
	# Taxonomy: kik_perioada_de_facturare
	register_taxonomy('kik_perioada_de_facturare', 'kik_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => 'Perioade de facturare',
				'singular_name' => 'Perioada de facturare',
			),
			'rewrite' => array(
				'slug' => 'perioada-de-facturare',
				'with_front' => false,
			),
		)
	);
	
	# Taxonomy: kik_status
	register_taxonomy('kik_status', 'kik_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => 'Statusuri',
				'singular_name' => 'Status',
			),
			'rewrite' => array(
				'slug' => 'status',
				'with_front' => false,
			),
			//'show_ui' => false,
			//'show_in_nav_menus' => false,
			//'show_tagcloud' => false,
		)
	);
	if (!term_exists('Activ', 'kik_status')) {
		wp_insert_term(
			'Activ',
			'kik_status',
			array(
				'description'=> 'Status: Activ',
				'slug' => 'activ',
			)
		);
	}
	if (!term_exists('Inactiv', 'kik_status')) {
		wp_insert_term(
			'Inactiv',
			'kik_status',
			array(
				'description'=> 'Status: Inactiv',
				'slug' => 'inactiv',
			)
		);
	}
	
	# Taxonomy: kik_documente_predate
	register_taxonomy('kik_documente_predate', 'kik_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => 'Documente predate',
				'singular_name' => 'Document predat',
			),
			'rewrite' => array(
				'slug' => 'documente-predate',
				'with_front' => false,
			),
		)
	);
	
	# Taxonomy: kik_echipamente
	register_taxonomy('kik_echipamente', 'kik_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => 'Echipamente',
				'singular_name' => 'Echipament',
			),
			'rewrite' => array(
				'slug' => 'echipamente',
				'with_front' => false,
			),
		)
	);
	
	# Taxonomy: kik_norme_lucru
	register_taxonomy('kik_norme_lucru', 'kik_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => 'Norme de lucru',
				'singular_name' => 'Norma de lucru',
			),
			'rewrite' => array(
				'slug' => 'norme-lucru',
				'with_front' => false,
			),
		)
	);
	
	# Taxonomy: kik_ani_instructaj
	register_taxonomy('kik_ani_instructaj', 'kik_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => 'Ani instructaj',
				'singular_name' => 'An instructaj',
			),
			'rewrite' => array(
				'slug' => 'ani-instructaj',
				'with_front' => false,
			),
		)
	);
	
	# Taxonomy: kik_tipuri_evenimente
	register_taxonomy('kik_tipuri_evenimente', 'kik_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => 'Tipuri evenimente',
				'singular_name' => 'Tip eveniment',
			),
			'rewrite' => array(
				'slug' => 'tipuri-evenimente',
				'with_front' => false,
			),
		)
	);
	if (!term_exists('Accidente usoare', 'kik_tipuri_evenimente')) wp_insert_term('Accidente usoare', 'kik_tipuri_evenimente');
	if (!term_exists('Accidente de munca', 'kik_tipuri_evenimente')) wp_insert_term('Accidente de munca', 'kik_tipuri_evenimente');
	if (!term_exists('Accidente de traseu sau de circulatie', 'kik_tipuri_evenimente')) wp_insert_term('Accidente de traseu sau de circulatie', 'kik_tipuri_evenimente');
	if (!term_exists('Incidente periculoase', 'kik_tipuri_evenimente')) wp_insert_term('Incidente periculoase', 'kik_tipuri_evenimente');
	if (!term_exists('Imbolnaviri personale', 'kik_tipuri_evenimente')) wp_insert_term('Imbolnaviri personale', 'kik_tipuri_evenimente');
	
	//=======================================================
	// TAXONOMY: TIPURI DE INSTRUCTAJ
	//=======================================================
	register_taxonomy('kik_tipuri_instructaj', 'kik_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => 'Tipuri instructaj',
				'singular_name' => 'Tip instructaj',
			),
			'rewrite' => array(
				'slug' => 'tipuri-instructaj',
				'with_front' => false,
			),
		)
	);
	
	if (!term_exists('Instructaj personal TESA', 'kik_tipuri_instructaj')) {
		wp_insert_term(
			'Instructaj personal TESA', 
			'kik_tipuri_instructaj',
			array(
				'description'=> 'Instructaj personal TESA',
				'slug' => 'instructaj-personal-tesa',
			)
		);
	}
	
	if (!term_exists('Instructaj personal productiv', 'kik_tipuri_instructaj')) {
		wp_insert_term(
			'Instructaj personal productiv', 
			'kik_tipuri_instructaj',
			array(
				'description'=> 'Instructaj personal productiv',
				'slug' => 'instructaj-personal-productiv',
			)
		);
	}
	
	if (!term_exists('Instructaj personal general', 'kik_tipuri_instructaj')) {
		wp_insert_term(
			'Instructaj personal general', 
			'kik_tipuri_instructaj',
			array(
				'description'=> 'Instructaj personal general',
				'slug' => 'instructaj-personal-general',
			)
		);
	}
	
	### Adaugare coduri CAEN
	/*
	$file = fopen('http://client.100x.ro/ssm/caen.txt', 'r');
	if ($file) {
		while (($line = fgets($file)) !== false) {
			$arr = explode('----------', $line);
			$code = $arr[0] . '';
			$description = $arr[1] . '';
			//echo 'Cod: [' . $code . ']; Descriere: [' . $description . '];<br />';
			if (!term_exists($code, 'kik_cod_caen')) {
				wp_insert_term(
					$code,
					'kik_cod_caen',
					array(
						'description'=> $description,
						'slug' => $code,
					)
				);
			}
		}
	
		fclose($file);
	} else {
		# error opening the file.
	} 
	/**/
	
	
} ?>