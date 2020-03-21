					
					<div class="kik_company_fields_title">Date societate</div>
					
					<table class="kik_company_fields table_type_main" data-tab="Date societate">
						
						<!-- Date societate -->
						
						<!-- Labels -->
						<tr>
							<th>
								Camp
							</th>
							<th>
								Valoare
							</th>
						</tr>
						
						<!-- Existing rows -->
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- NAME -->
									<tr>
										<td>
											<label for="kik_company_title">Nume</label>
										</td>
										<td>
											<input type="text" class="size_xl" id="kik_company_title" name="kik_company_title" value="<?php the_title(); ?>" />
										</td>
									</tr>
									<!-- CIF -->
									<tr>
										<td>
											<label for="kik_company_cif">CUI (CIF)</label>
										</td>
										<td>
											<input type="text" class="size_s" id="kik_company_cif" name="kik_company_cif" value="<?php echo esc_html($kik_company_cif); ?>" />
										</td>
									</tr>
									<!-- REG -->
									<tr>
										<td>
											<label for="kik_company_reg">Nr. Reg. Com.</label>
										</td>
										<td>
											<input type="text" class="size_s" id="kik_company_reg" name="kik_company_reg" value="<?php echo esc_html($kik_company_reg); ?>" />
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- ADDRESS -->
									<tr>
										<td>
											<label for="kik_company_address">Sediu social</label>
										</td>
										<td>
											<input type="text" class="size_xl" id="kik_company_address" name="kik_company_address" value="<?php echo esc_html($kik_company_address); ?>" />
										</td>
									</tr>
									<!-- WORKPOINTS -->
									<?php
										$i = 0;
										//echo DrawObject($kik_company_workpoints);
										if ($kik_company_workpoints) foreach ($kik_company_workpoints as $kik_company_workpoint) {
											$i++;
									?>
									<tr>
										<td>
											<label for="kik_company_workpoint_<?php echo $i; ?>">Punct de lucru</label>
										</td>
										<td>
											<input type="text" class="size_xl" id="kik_company_workpoint_<?php echo $i; ?>" name="kik_company_workpoints[<?php echo $i; ?>][address]" value="<?php echo $kik_company_workpoint[address] ? esc_html($kik_company_workpoint[address]) : 'Punct de lucru" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Punct de lucru" /> <a class="kik_company_workpoint_delete" href="javascript:;">Sterge</a>
										</td>
									</tr>
									<?php
										}
									?>
									<tr id="kik_company_workpoints_add_tr" data-workpoints="<?php echo $i; ?>">
										<td>
										</td>
										<td>
											<a id="kik_company_workpoints_add_a" href="javascript:;">Adauga punct de lucru</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- BANK ACCOUNT -->
									<tr>
										<td>
											<label for="kik_company_bank_account">Cont bancar</label>
										</td>
										<td>
											<input type="text" class="size_m" id="kik_company_bank_account" name="kik_company_bank_account" value="<?php echo esc_html($kik_company_bank_account); ?>" />
										</td>
									</tr>
									<!-- BANK NAME -->
									<tr>
										<td>
											<label for="kik_company_bank_name">Banca</label>
										</td>
										<td>
											<input type="text" class="size_m" id="kik_company_bank_name" name="kik_company_bank_name" value="<?php echo esc_html($kik_company_bank_name); ?>" />
										</td>
									</tr>
									<!-- LEGAL REP -->
									<tr>
										<td>
											<label for="kik_company_legal_rep">Reprezentant legal</label>
										</td>
										<td>
											<input type="text" class="size_m" id="kik_company_legal_rep" name="kik_company_legal_rep" value="<?php echo esc_html($kik_company_legal_rep); ?>" />
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- CONTACT PERSON NAME -->
									<tr>
										<td>
											<label for="kik_company_contact_person_name">Persoana de contact</label>
										</td>
										<td>
											<input type="text" class="size_m" id="kik_company_contact_person_name" name="kik_company_contact_person_name" value="<?php echo esc_html($kik_company_contact_person_name); ?>" />
										</td>
									</tr>
									<!-- CONTACT PERSON PHONE -->
									<tr>
										<td>
											<label for="kik_company_contact_person_phone">Telefon</label>
										</td>
										<td>
											<input type="text" class="size_s" id="kik_company_contact_person_phone" name="kik_company_contact_person_phone" value="<?php echo esc_html($kik_company_contact_person_phone); ?>" />
										</td>
									</tr>
									<!-- CONTACT PERSON EMAIL -->
									<tr>
										<td>
											<label for="kik_company_contact_person_email">Email</label>
										</td>
										<td>
											<input type="text" class="size_l" id="kik_company_contact_person_email" name="kik_company_contact_person_email" value="<?php echo esc_html($kik_company_contact_person_email); ?>" />
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- CAEN -->
									<tr>
										<td>
											<label for="kik_company_caen">Cod CAEN</label>
										</td>
										<td>
											<?php
											$kik_walker = new KIK_WALKER();
											wp_dropdown_categories(array(
												'walker'             => $kik_walker,
												'show_option_all'    => '',
												'show_option_none'   => '-- alege --',
												'orderby'            => 'NAME', 
												'order'              => 'ASC',
												'show_count'         => 0,
												'hide_empty'         => 0, 
												'child_of'           => 0,
												'exclude'            => '',
												'echo'               => 1,
												'selected'           => $kik_company_caen->term_id,
												'hierarchical'       => 1, 
												'name'               => 'kik_company_caen',
												'id'                 => 'kik_company_caen',
												'class'              => 'size_s',
												'depth'              => 0,
												'tab_index'          => 0,
												'taxonomy'           => 'kik_cod_caen',
												'hide_if_empty'      => false,
											));
											?>
											<span id="kik_company_caen_description"><?php echo $kik_company_caen->description; ?></span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- CONTRACT NUMBER -->
									<tr>
										<td>
											<label for="kik_company_contract_number">Numar contract</label>
										</td>
										<td>
											<input type="text" class="size_xs" id="kik_company_contract_number" name="kik_company_contract_number" value="<?php echo esc_html($kik_company_contract_number); ?>" />
										</td>
									</tr>
									<!-- CONTRACT DATE -->
									<tr>
										<td>
											<label for="kik_company_contract_date">Data contract</label>
										</td>
										<td>
											<input type="text" class="size_s datetimepicker_input" id="kik_company_contract_date" name="kik_company_contract_date" value="<?php echo esc_html($kik_company_contract_date); ?>" />
										</td>
									</tr>
									<!-- CONTRACT TYPE -->
									<tr>
										<td>
											<label for="kik_company_contract_type">Tip contract</label>
										</td>
										<td>
											<?php
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
												'selected'           => $kik_company_contract_type->term_id,
												'hierarchical'       => 1, 
												'name'               => 'kik_company_contract_type',
												'id'                 => 'kik_company_contract_type',
												'class'              => 'size_s',
												'depth'              => 0,
												'tab_index'          => 0,
												'taxonomy'           => 'kik_tip_contract',
												'hide_if_empty'      => false,
											));
											?>
												</td>
									</tr>
									<!-- CONTRACT VALIDITY -->
									<tr>
										<td>
											<label for="kik_company_contract_validity">Valabilitate contract</label>
										</td>
										<td>
											<input type="text" class="size_xs" id="kik_company_contract_validity" name="kik_company_contract_validity" value="<?php echo esc_html($kik_company_contract_validity); ?>" style="text-align:right;" />
											<select id="kik_company_contract_validity_type" name="kik_company_contract_validity_type">
												<option value="zile"<?php echo (($kik_company_contract_validity_type) == 'zile' ? ' selected="selected"' : '');?>>zile</option>
												<option value="luni"<?php echo (($kik_company_contract_validity_type) == 'luni' ? ' selected="selected"' : '');?>>luni</option>
												<option value="ani"<?php echo (($kik_company_contract_validity_type) == 'ani' ? ' selected="selected"' : '');?>>ani</option>
											</select>
										</td>
									</tr>
									<!-- SERVICE FREQUENCY -->
									<tr>
										<td>
											<label for="kik_company_service_frequency">Periodicitate instructaj</label>
										</td>
										<td>
											<?php
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
												'selected'           => $kik_company_service_frequency->term_id,
												'hierarchical'       => 1, 
												'name'               => 'kik_company_service_frequency',
												'id'                 => 'kik_company_service_frequency',
												'class'              => 'size_s',
												'depth'              => 0,
												'tab_index'          => 0,
												'taxonomy'           => 'kik_periodicitate_instructaj',
												'hide_if_empty'      => false,
											));
											?>
										</td>
									</tr>
									<!-- EMPLOYEES -->
									<tr>
										<td>
											<label for="kik_company_employees">Nr. salariati</label>
										</td>
										<td>
											<input type="text" class="size_xs" id="kik_company_employees" name="kik_company_employees" value="<?php echo esc_html($kik_company_employees); ?>" />
										</td>
									</tr>
									<!-- BILLING FREQUENCY -->
									<tr>
										<td>
											<label for="kik_company_billing_frequency">Perioada de facturare</label>
										</td>
										<td>
											<?php
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
												'selected'           => $kik_company_billing_frequency->term_id,
												'hierarchical'       => 1, 
												'name'               => 'kik_company_billing_frequency',
												'id'                 => 'kik_company_billing_frequency',
												'class'              => 'size_s',
												'depth'              => 0,
												'tab_index'          => 0,
												'taxonomy'           => 'kik_perioada_de_facturare',
												'hide_if_empty'      => false,
											));
											?>
										</td>
									</tr>
									<!-- BILLING DEADLINE -->
									<tr>
										<td>
											<label for="kik_company_billing_deadline">Termen de plata</label>
										</td>
										<td>
											<input type="text" class="size_xs" id="kik_company_billing_deadline" name="kik_company_billing_deadline" value="<?php echo esc_html($kik_company_billing_deadline); ?>" style="text-align:right;" />
											<select id="kik_company_billing_deadline_type" name="kik_company_billing_deadline_type">
												<option value="zile"<?php echo (($kik_company_billing_deadline_type) == 'zile' ? ' selected="selected"' : '');?>>zile</option>
												<option value="luni"<?php echo (($kik_company_billing_deadline_type) == 'luni' ? ' selected="selected"' : '');?>>luni</option>
												<option value="ani"<?php echo (($kik_company_billing_deadline_type) == 'ani' ? ' selected="selected"' : '');?>>ani</option>
											</select>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php
						$current_user_id = wp_get_current_user()->ID;
						$current_user_roles = get_user_meta($current_user_id, 'kik_user_roles', true);
						if (($current_user_id == 1) || (is_array($current_user_roles) && in_array('Administrator', $current_user_roles))) {
						?>
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- INSPECTOR -->
									<tr>
										<td>
											<label for="kik_company_inspector">Inspector SSM</label>
										</td>
										<td>
											<?php KIK_DROPDOWN_USERS('kik_company_inspector', 'kik_company_inspector', 'Inspector SSM', $kik_company_inspector, true, 'size_m'); ?>
										</td>
									</tr>
									<!-- SALES AGENT -->
									<tr>
										<td>
											<label for="kik_company_sales_agent">Agent de vanzari</label>
										</td>
										<td>
											<?php KIK_DROPDOWN_USERS('kik_company_sales_agent', 'kik_company_sales_agent', 'Agent de vânzări', $kik_company_sales_agent, true, 'size_m'); ?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php } ?>
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- STATUS -->
									<tr>
										<td>
											<label for="kik_company_status">Status</label>
										</td>
										<td>
											<?php
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
												'selected'           => $kik_company_status->term_id,
												'hierarchical'       => 1,
												'name'               => 'kik_company_status',
												'id'                 => 'kik_company_status',
												'class'              => 'size_s',
												'depth'              => 0,
												'tab_index'          => 0,
												'taxonomy'           => 'kik_status',
												'hide_if_empty'      => false,
											));
											?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					