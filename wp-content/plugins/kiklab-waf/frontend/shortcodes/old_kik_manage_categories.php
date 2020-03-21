<?php


#####------------------------------------
##### kik_manage_categories
#####------------------------------------


function kik_manage_categories_FUNC($atts, $content = null) {
	// extract params
	$a = shortcode_atts(array(
	), $atts);
	// do stuff
	
	
	$current_user_id = wp_get_current_user()->ID;
	$current_user_roles = get_user_meta($current_user_id, 'kik_user_roles', true);
	if (($current_user_id == 1) || (is_array($current_user_roles) && in_array('Administrator', $current_user_roles))) {
				
				# Date societate
				/* $kik_company_cif = get_post_meta($kik_ID, 'kik_company_cif', true);
				$kik_company_reg = get_post_meta($kik_ID, 'kik_company_reg', true);
				$kik_company_address = get_post_meta($kik_ID, 'kik_company_address', true);
				$kik_company_workpoints = get_post_meta($kik_ID, 'kik_company_workpoints', true);
				$kik_company_bank_account = get_post_meta($kik_ID, 'kik_company_bank_account', true);
				$kik_company_bank_name = get_post_meta($kik_ID, 'kik_company_bank_name', true);
				$kik_company_legal_rep = get_post_meta($kik_ID, 'kik_company_legal_rep', true);
				$kik_company_contact_person_name = get_post_meta($kik_ID, 'kik_company_contact_person_name', true);
				$kik_company_contact_person_phone = get_post_meta($kik_ID, 'kik_company_contact_person_phone', true);
				$kik_company_contact_person_email = get_post_meta($kik_ID, 'kik_company_contact_person_email', true);
				$kik_company_caen = ($try = wp_get_object_terms($kik_ID, 'kik_cod_caen') ? $try[0] : 0);
				$kik_company_contract_number = get_post_meta($kik_ID, 'kik_company_contract_number', true);
				$kik_company_contract_date = get_post_meta($kik_ID, 'kik_company_contract_date', true);
				$kik_company_contract_type = ($try = wp_get_object_terms($kik_ID, 'kik_tip_contract') ? $try[0] : 0);
				$kik_company_contract_validity = get_post_meta($kik_ID, 'kik_company_contract_validity', true);
				$kik_company_contract_validity_type = get_post_meta($kik_ID, 'kik_company_contract_validity_type', true);
				$kik_company_service_frequency = ($try = wp_get_object_terms($kik_ID, 'kik_periodicitate_instructaj') ? $try[0] : 0);
				$kik_company_employees = get_post_meta($kik_ID, 'kik_company_employees', true);
				$kik_company_billing_frequency = ($try = wp_get_object_terms($kik_ID, 'kik_perioada_de_facturare') ? $try[0] : 0);
				$kik_company_billing_deadline = get_post_meta($kik_ID, 'kik_company_billing_deadline', true);
				$kik_company_billing_deadline_type = get_post_meta($kik_ID, 'kik_company_billing_deadline_type', true);
				$kik_company_inspector = get_post_meta($kik_ID, 'kik_company_inspector', true);
				$kik_company_sales_agent = get_post_meta($kik_ID, 'kik_company_sales_agent', true);
				$kik_company_status = ($try = wp_get_object_terms($kik_ID, 'kik_status') ? $try[0] : 0);
				
				# Facturare
				$kik_company_billing_history = get_post_meta($kik_ID, 'kik_company_billing_history', false);
				
				# Periodicitate instructaj
				$kik_company_service_frequency_history = get_post_meta($kik_ID, 'kik_company_service_frequency_history', false);
				
				# CSSM
				$kik_company_cssm = get_post_meta($kik_ID, 'kik_company_cssm', false);
				
				# Echipamente
				$kik_company_echipamente = get_post_meta($kik_ID, 'kik_company_echipamente', false);
				
				# Angajati
				$kik_company_angajati = get_post_meta($kik_ID, 'kik_company_angajati', false);
				
				# Dosar cercetare accidente
				$kik_company_accidente = get_post_meta($kik_ID, 'kik_company_accidente', false);
				*/
			?>
			
			<form name="kik_terms" action="" method="post">
				<div class="row">
					<div class="col-sm-12">
						<h2>Categorii de date</h2>
						<hr>
					</div>
				</div>
				
			<div class="kik_save_area">
				<a class="btn btn-primary save-categs" href="javascript:;">
					<i class="fa fa-fw fa-save kik_save_btn edit"></i> Salvează toate categoriile
				</a>
			</div>
			

			<!-- TABS HEADER -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2">
						<ul class="nav nav-pills nav-stacked">
							<li class="active"><a href="#tab-0" data-toggle="tab">
									Coduri CAEN (<?php echo wp_count_terms('kik_cod_caen', array('hide_empty' => false)); ?>)
								</a>
							</li>
							<li><a href="#tab-1" data-toggle="tab">
									Tipuri de contracte (<?php echo wp_count_terms('kik_tip_contract', array('hide_empty' => false)); ?>)
								</a>
							</li>
							<li><a href="#tab-2" data-toggle="tab">
									Periodicitate instructaj (<?php echo wp_count_terms('kik_periodicitate_instructaj', array('hide_empty' => false)); ?>)
								</a>
							</li>
							<li>
								<a href="#tab-3" data-toggle="tab">
									Perioade de facturare (<?php echo wp_count_terms('kik_perioada_de_facturare', array('hide_empty' => false)); ?>)
								</a>
							</li>
							<li>
								<a href="#tab-4" data-toggle="tab">
									Documente predate (<?php echo wp_count_terms('kik_documente_predate', array('hide_empty' => false)); ?>)
								</a>
							</li>
							<li>
								<a href="#tab-5" data-toggle="tab">
									Echipamente (<?php echo wp_count_terms('kik_echipamente', array('hide_empty' => false)); ?>)
								</a>
							</li>
							<li>
								<a href="#tab-6" data-toggle="tab">
									Norme de lucru (<?php echo wp_count_terms('kik_norme_lucru', array('hide_empty' => false)); ?>)
								</a>
							</li>
							<li>
								<a href="#tab-7" data-toggle="tab">
									Ani instructaj (<?php echo wp_count_terms('kik_ani_instructaj', array('hide_empty' => false)); ?>)
								</a>
							</li>
							
						</ul>	
				
				<!--<a class="kik_company_tab_title_active" href="javascript:;">
					<a href="#tab-1" data-toggle="tab"></a>
					Coduri CAEN (<?php //echo wp_count_terms('kik_cod_caen', array('hide_empty' => false)); ?>)
				</a>
				<a class="kik_company_tab_title" href="javascript:;">
					Tipuri de contracte (<?php //echo wp_count_terms('kik_tip_contract', array('hide_empty' => false)); ?>)
					</a>
				<a class="kik_company_tab_title" href="javascript:;">
					Periodicitate instructaj (<?php //echo wp_count_terms('kik_periodicitate_instructaj', array('hide_empty' => false)); ?>)
					</a>
				<a class="kik_company_tab_title" href="javascript:;">
					Perioade de facturare (<?php //echo wp_count_terms('kik_perioada_de_facturare', array('hide_empty' => false)); ?>)
				</a>
				<a class="kik_company_tab_title" href="javascript:;">
					Documente predate (<?php //echo wp_count_terms('kik_documente_predate', array('hide_empty' => false)); ?>)
				</a>
				<a class="kik_company_tab_title" href="javascript:;">
					Echipamente (<?php //echo wp_count_terms('kik_echipamente', array('hide_empty' => false)); ?>)
				</a>
				<a class="kik_company_tab_title" href="javascript:;">
					Norme de lucru (<?php //echo wp_count_terms('kik_norme_lucru', array('hide_empty' => false)); ?>)
				</a>
				<a class="kik_company_tab_title" href="javascript:;">
					Ani instructaj (<?php //echo wp_count_terms('kik_ani_instructaj', array('hide_empty' => false)); ?>)
				</a>-->
			
			
			<div class="tab-content"><?php 
				$taxonomy_names = array(
					'kik_cod_caen',
					'kik_tip_contract',
					'kik_periodicitate_instructaj',
					'kik_perioada_de_facturare',
					'kik_documente_predate',
					'kik_echipamente',
					'kik_norme_lucru',
					'kik_ani_instructaj',
				);
					
				foreach ($taxonomy_names as $tax_idx => $taxonomy_name) {
					$taxonomy = get_taxonomy($taxonomy_name); ?>
						
					<div 	id="tab-<?php echo $tax_idx; ?>"
							class="tab-pane <?php if ($taxonomy->name == 'kik_cod_caen') echo "active"; ?>">
						
						<div class="kik_company_fields_title"><?php echo $taxonomy->label; ?> (<?php echo wp_count_terms($taxonomy->name, array('hide_empty' => false)); ?>)</div>
						
						<table class="kik_company_fields table_type_main">
							
							<!-- Documente predate -->
							<!-- Labels -->
							<tr>
								<th style="width:40px;" class="align-right"></th>
								<th style="width:100%;" class="align-left">Item</th>
							</tr>
							
							<!-- Existing rows --><?php
								$i = 0;
								foreach (get_terms($taxonomy->name, array('hide_empty' => 0)) as $term) {
									$i++; ?>
									<tr>
										<td colspan="2">
											<table class="table_type_row">
												<tr>
													<td style="width:40px;" class="align-right">
														<?php if (!in_array($taxonomy->name, array('kik_echipamente', 'kik_norme_lucru', 'kik_ani_instructaj'))) { ?>
														<label title="<?php echo $term->name . ': ' . (!$term->count ? 'nicio firmă' : ($term->count == 1 ? '1 firmă' : $term->count . ' firme')); ?>">(<?php echo $term->count; ?>)</label>
														<?php } ?>
													</td>
													<td style="width:100%;">
														<input type="text" class="size_m" id="term_<?php echo $taxonomy->name; ?>_<?php echo $i; ?>_name" name="taxonomies[<?php echo $taxonomy->name; ?>][<?php echo $i; ?>][name]" value="<?php echo $term->name; ?>" />
														<?php if ($taxonomy->name == 'kik_cod_caen') { ?>
														<input type="text" class="size_xl" id="term_<?php echo $taxonomy->name; ?>_<?php echo $i; ?>_description" name="taxonomies[<?php echo $taxonomy->name; ?>][<?php echo $i; ?>][description]" value="<?php echo $term->description; ?>" />
														<?php } ?>
														<a class="kik_term_delete" data-taxonomy="<?php echo $taxonomy->name; ?>" href="javascript:;">Șterge</a>
														<input type="hidden" id="term_<?php echo $taxonomy->name; ?>_<?php echo $i; ?>_id" name="taxonomies[<?php echo $taxonomy->name; ?>][<?php echo $i; ?>][id]" value="<?php echo $term->term_id; ?>" />
													</td>
												</tr>
											</table>
										</td>
									</tr><?php
								} ?>
							<tr>
								<td colspan="2">
									<table class="table_type_row">
										<tr class="kik_term_add_tr" data-taxonomy="<?php echo $taxonomy->name; ?>" data-count="<?php echo $i; ?>">
											<td style="width:40px;" class="align-right">
												&nbsp;
											</td>
											<td style="width:100%;">
												<a class="kik_term_add_a" data-taxonomy="<?php echo $taxonomy->name; ?>" href="javascript:;">Adaugă</a>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							
						</table>
						
					</div><?php
				} ?>
					
					<!-- OVERLAY -->
					<div id="kik_company_tabs_overlay"></div>
					
			</div>
			
			<div class="kik_company_fields_footer"></div>
			
			<div class="kik_save_area"><a class="kik_save_btn edit" href="javascript:;"><i class="fa fa-fw fa-save"></i> Salvează toate categoriile</a><div class="kik_save_btn_response"></div></div>
			
		</form>
		
		<?php } 
		
		
		
			?>
				
			
			<!-- </div>
			
			
				<!--<div id="kik_company_tab_titles">
					<a class="kik_company_tab_title_active" href="javascript:;">Coduri CAEN (<?php //echo wp_count_terms('kik_cod_caen', array('hide_empty' => false)); ?>)</a>
					<a class="kik_company_tab_title" href="javascript:;">Tipuri de contracte (<?php //echo wp_count_terms('kik_tip_contract', array('hide_empty' => false)); ?>)</a>
					<a class="kik_company_tab_title" href="javascript:;">Periodicitate instructaj (<?php //echo wp_count_terms('kik_periodicitate_instructaj', array('hide_empty' => false)); ?>)</a>
					<a class="kik_company_tab_title" href="javascript:;">Perioade de facturare (<?php //echo wp_count_terms('kik_perioada_de_facturare', array('hide_empty' => false)); ?>)</a>
					<a class="kik_company_tab_title" href="javascript:;">Documente predate (<?php //echo wp_count_terms('kik_documente_predate', array('hide_empty' => false)); ?>)</a>
					<a class="kik_company_tab_title" href="javascript:;">Echipamente (<?php //echo wp_count_terms('kik_echipamente', array('hide_empty' => false)); ?>)</a>
					<a class="kik_company_tab_title" href="javascript:;">Norme de lucru (<?php //echo wp_count_terms('kik_norme_lucru', array('hide_empty' => false)); ?>)</a>
					<a class="kik_company_tab_title" href="javascript:;">Ani instructaj (<?php //echo wp_count_terms('kik_ani_instructaj', array('hide_empty' => false)); ?>)</a>
				</div> -->
				<!-- <div id="kik_company_tabs">
					
					<?php
					/* 
					$taxonomy_names = array(
						'kik_cod_caen',
						'kik_tip_contract',
						'kik_periodicitate_instructaj',
						'kik_perioada_de_facturare',
						'kik_documente_predate',
						'kik_echipamente',
						'kik_norme_lucru',
						'kik_ani_instructaj',
					);
					
					foreach ($taxonomy_names as $taxonomy_name) {
						$taxonomy = get_taxonomy($taxonomy_name); */
						?>
							
							<div class="kik_company_tab"<?php //if ($taxonomy->name == 'kik_cod_caen') echo 'style="display:block;"'; ?>
								id=>
								
								<div class="kik_company_fields_title"><?php //echo $taxonomy->label; ?> (<?php //echo wp_count_terms($taxonomy->name, array('hide_empty' => false)); ?>)</div>
								
								<table class="kik_company_fields table_type_main">
									
									<!-- Documente predate -->
									
									<!-- Labels -->
									<!--<tr>
										<th style="width:40px;" class="align-right"></th>
										<th style="width:100%;" class="align-left">Item</th>
									</tr>
									
									<!-- Existing rows -->
									<?php
										/* $i = 0;
										foreach (get_terms($taxonomy->name, array('hide_empty' => 0)) as $term) {
											$i++; */
									?>
									<!--<tr>
										<td colspan="2">
											<table class="table_type_row">
												<tr>
													<td style="width:40px;" class="align-right">
														<?php //if (!in_array($taxonomy->name, array('kik_echipamente', 'kik_norme_lucru', 'kik_ani_instructaj'))) { ?>
														<label title="<?php// echo $term->name . ': ' . (!$term->count ? 'nicio firmă' : ($term->count == 1 ? '1 firmă' : $term->count . ' firme')); ?>">(<?php //echo $term->count; ?>)</label>
														<?php //} ?>
													</td>
													<td style="width:100%;">
														<input type="text" class="size_m" id="term_<?php// echo $taxonomy->name; ?>_<?php //echo $i; ?>_name" name="taxonomies[<?php //echo $taxonomy->name; ?>][<?php //echo $i; ?>][name]" value="<?php //echo $term->name; ?>" />
														<?php //if ($taxonomy->name == 'kik_cod_caen') { ?>
														<input type="text" class="size_xl" id="term_<?php //echo $taxonomy->name; ?>_<?php //echo $i; ?>_description" name="taxonomies[<?php //echo $taxonomy->name; ?>][<?php //echo $i; ?>][description]" value="<?php //echo $term->description; ?>" />
														<?php //} ?>
														<a class="kik_term_delete" data-taxonomy="<?php //echo $taxonomy->name; ?>" href="javascript:;">Șterge</a>
														<input type="hidden" id="term_<?php //echo $taxonomy->name; ?>_<?php //echo $i; ?>_id" name="taxonomies[<?php//echo $taxonomy->name; ?>][<?php// echo $i; ?>][id]" value="<?php //echo $term->term_id; ?>" />
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<?php
										//}
									?>
									<tr>
										<td colspan="2">
											<table class="table_type_row">
												<tr class="kik_term_add_tr" data-taxonomy="<?php //echo $taxonomy->name; ?>" data-count="<?php //echo $i; ?>">
													<td style="width:40px;" class="align-right">
														&nbsp;
													</td>
													<td style="width:100%;">
														<a class="kik_term_add_a" data-taxonomy="<?php //echo $taxonomy->name; ?>" href="javascript:;">Adaugă</a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									
								</table>
								
							</div>
								
							<?php
						//}
						
						?>
						
						<!-- OVERLAY -->
						<!--<div id="kik_company_tabs_overlay"></div>
						
					</div>
				
				<div class="kik_company_fields_footer"></div>
				
				<div class="kik_save_area"><a class="kik_save_btn edit" href="javascript:;"><i class="fa fa-fw fa-save"></i> Salvează toate categoriile</a><div class="kik_save_btn_response"></div></div>
				
			</form>-->
			
			<?php //} ?>
			
	<?php
}










/**/

?>