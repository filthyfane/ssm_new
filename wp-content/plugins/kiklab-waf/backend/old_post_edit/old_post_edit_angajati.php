					
					<div class="kik_company_fields_title">Angajati (<?php echo count($kik_company_angajati[0]); ?>)</div>
					
					<table class="kik_company_fields table_type_main">
						
						<!-- Angajati -->
						
						<!-- Labels -->
						<tr>
							<th style="width:18%;" class="align-left">
								Nume
							</th>
							<th style="width:18%;" class="align-left">
								Prenume
							</th>
							<th style="width:64%;" class="align-left">
								Date angajat
							</th>
							<th style="width:100px;">
								&nbsp;
							</th>
						</tr>
						
						<!-- Existing rows -->
						<?php
							$i = 0;
							//echo DrawObject($kik_company_angajati);
							if ($kik_company_angajati[0]) foreach ($kik_company_angajati[0] as $kik_company_angajat) {
								$i++;
						?>
						<tr>
							<td colspan="4">
								<table class="table_type_row">
									<tr>
										<td style="width:18%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W" id="kik_company_angajat_<?php echo $i; ?>_nume" name="kik_company_angajati[<?php echo $i; ?>][nume]" value="<?php echo $kik_company_angajat[nume] ? esc_html($kik_company_angajat[nume]) . '"' : 'Nume" style="color:#cccccc; font-style:italic;"'; ?> data-autohint="true" title="Nume" />
											</div>
										</td>
										<td style="width:18%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W" id="kik_company_angajat_<?php echo $i; ?>_prenume" name="kik_company_angajati[<?php echo $i; ?>][prenume]" value="<?php echo $kik_company_angajat[prenume] ? esc_html($kik_company_angajat[prenume]) . '"' : 'Prenume" style="color:#cccccc; font-style:italic;"'; ?> data-autohint="true" title="Prenume" />
											</div>
										</td>
										<td style="width:42%;" colspan="2">
											<div class="box_H_margin">
												<input type="text" class="size_full_W" id="kik_company_angajat_<?php echo $i; ?>_functie" name="kik_company_angajati[<?php echo $i; ?>][functie]" value="<?php echo $kik_company_angajat[functie] ? esc_html($kik_company_angajat[functie]) . '"' : 'Functie" style="color:#cccccc; font-style:italic;"'; ?> data-autohint="true" title="Functie" />
											</div>
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W" id="kik_company_angajat_<?php echo $i; ?>_cnp" name="kik_company_angajati[<?php echo $i; ?>][cnp]" value="<?php echo $kik_company_angajat[cnp] ? esc_html($kik_company_angajat[cnp]) . '"' : 'CNP" style="color:#cccccc; font-style:italic;"'; ?> data-autohint="true" title="CNP" />
											</div>
										</td>
										<td style="width:100px;">
											<div class="box_H_margin">
												<a class="kik_company_angajat_delete" href="javascript:;">Sterge</a>
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:36%;" colspan="2">&nbsp;</div>
										<td style="width:64%;" colspan="3">
											<div class="box_H_margin">
												<input type="text" class="size_full_W" id="kik_company_angajat_<?php echo $i; ?>_adresa" name="kik_company_angajati[<?php echo $i; ?>][adresa]" value="<?php echo $kik_company_angajat[adresa] ? str_replace("\r", ' ', esc_html($kik_company_angajat[adresa])) . '"' : 'Adresa" style="color:#cccccc; font-style:italic;"'; ?> data-autohint="true" title="Adresa" />
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:36%;" colspan="2">&nbsp;</div>
										<td style="width:20%;">
											<div class="box_H_margin align-right">
												<label for="kik_company_angajat_<?php echo $row_id; ?>_contract_type">Norma de lucru</label>
												<?php
												wp_dropdown_categories(array(
													'show_option_all'    => '',
													'show_option_none'   => '-- Alege --',
													'orderby'            => 'NAME', 
													'order'              => 'ASC',
													'show_count'         => 0,
													'hide_empty'         => 0,
													'child_of'           => 0,
													'exclude'            => '',
													'echo'               => 1,
													'selected'           => $kik_company_angajat[contract_type],
													'hierarchical'       => 1, 
													'name'               => 'kik_company_angajati[' . $i . '][contract_type]',
													'id'                 => 'kik_company_angajat_' . $i . '_contract_type',
													'class'              => '',
													'depth'              => 0,
													'tab_index'          => 0,
													'taxonomy'           => 'kik_norme_lucru',
													'hide_if_empty'      => false,
												));
												?>
											</div>
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W datetimepicker_input align-center" id="kik_company_angajat_<?php echo $i; ?>_contract_start" name="kik_company_angajati[<?php echo $i; ?>][contract_start]" value="<?php echo $kik_company_angajat[contract_start] ? $kik_company_angajat[contract_start] . '"' : 'Data incepere contract" style="color:#cccccc; font-style:italic;"'; ?> data-autohint="true" title="Data incepere contract" />
											</div>
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W datetimepicker_input align-center" id="kik_company_angajat_<?php echo $i; ?>_contract_end" name="kik_company_angajati[<?php echo $i; ?>][contract_end]" value="<?php echo $kik_company_angajat[contract_end] ? $kik_company_angajat[contract_end] . '"' : 'Data incetare contract" style="color:#cccccc; font-style:italic;"'; ?> data-autohint="true" title="Data incetare contract" />
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:36%;" colspan="2">&nbsp;</div>
										<td style="width:20%;">
											<div class="box_H_margin align-right">
												<label for="kik_company_angajat_<?php echo $row_id; ?>_boss_bool">Conducator loc de munca</label>
												<input type="checkbox" class="KIK_angajat_boss" id="kik_company_angajat_<?php echo $i; ?>_boss_bool" name="kik_company_angajati[<?php echo $i; ?>][boss_bool]" <?php if ($kik_company_angajat[boss_bool]) echo 'checked'; ?> />
											</div>
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W" id="kik_company_angajat_<?php echo $i; ?>_boss_phone" name="kik_company_angajati[<?php echo $i; ?>][boss_phone]" value="<?php echo $kik_company_angajat[boss_phone] ? esc_html($kik_company_angajat[boss_phone]) . '"' : 'Telefon" style="color:#cccccc; font-style:italic; display:' . ($kik_company_angajat[boss_bool] ? 'block' : 'none') . ';"'; ?> data-autohint="true" title="Telefon" />
												<div class="size_full_W_full_H align-center" style="display:<?php echo $kik_company_angajat[boss_bool] ? 'none' : 'block'; ?>;">--</div>
											</div>
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W" id="kik_company_angajat_<?php echo $i; ?>_boss_email" name="kik_company_angajati[<?php echo $i; ?>][boss_email]" value="<?php echo $kik_company_angajat[boss_email] ? esc_html($kik_company_angajat[boss_email]) . '"' : 'Email" style="color:#cccccc; font-style:italic; display:' . ($kik_company_angajat[boss_bool] ? 'block' : 'none') . ';"'; ?> data-autohint="true" title="Email" />
												<div class="size_full_W_full_H align-center" style="display:<?php echo $kik_company_angajat[boss_bool] ? 'none' : 'block'; ?>;">--</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:36%;" colspan="2">&nbsp;</div>
										<td style="width:20%;">
											<div class="box_H_margin align-right">
												<label for="kik_company_angajat_<?php echo $row_id; ?>_auth_bool">Autorizatie speciala</label>
												<input type="checkbox" class="KIK_angajat_auth" id="kik_company_angajat_<?php echo $i; ?>_auth_bool" name="kik_company_angajati[<?php echo $i; ?>][auth_bool]" <?php if ($kik_company_angajat[auth_bool]) echo 'checked'; ?> />
											</div>
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W" id="kik_company_angajat_<?php echo $i; ?>_auth_type" name="kik_company_angajati[<?php echo $i; ?>][auth_type]" value="<?php echo $kik_company_angajat[auth_type] ? esc_html($kik_company_angajat[auth_type]) . '"' : 'Tip autorizatie" style="color:#cccccc; font-style:italic; display:' . ($kik_company_angajat[auth_bool] ? 'block' : 'none') . ';"'; ?> data-autohint="true" title="Tip autorizatie" />
												<div class="size_full_W_full_H align-center" style="display:<?php echo $kik_company_angajat[auth_bool] ? 'none' : 'block'; ?>;">--</div>
											</div>
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W datetimepicker_input align-center" id="kik_company_angajat_<?php echo $i; ?>_auth_exp" name="kik_company_angajati[<?php echo $i; ?>][auth_exp]" value="<?php echo $kik_company_angajat[auth_exp] ? $kik_company_angajat[auth_exp] . '"' : 'Data expirarii autorizatiei" style="color:#cccccc; font-style:italic; display:' . ($kik_company_angajat[auth_bool] ? 'block' : 'none') . ';"'; ?> data-autohint="true" title="Data expirarii autorizatiei" />
												<div class="size_full_W_full_H align-center" style="display:<?php echo $kik_company_angajat[auth_bool] ? 'none' : 'block'; ?>;">--</div>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php
							}
						?>
						
						<!-- Add MORE rows -->
						<tr id="kik_company_angajati_add_tr" data-angajati="<?php echo $i; ?>" class="last">
							<td colspan="6">
								<a id="kik_company_angajati_add_a" href="javascript:;">Adauga angajat</a>
							</td>
						</tr>
						
					</table>
					