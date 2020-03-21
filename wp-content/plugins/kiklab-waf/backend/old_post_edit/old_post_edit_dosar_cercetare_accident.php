					
					<div class="kik_company_fields_title">Dosar cercetare accident (<?php echo count($kik_company_accidente[0]); ?>)</div>
					
					<table class="kik_company_fields table_type_main">
						
						<!-- ECHIPAMENTE -->
						
						<!-- Labels -->
						<tr>
							<th style="width:22%;">
								Data cercetarii
							</th>
							<th style="width:22%;">
								Data accidentului
							</th>
							<th style="width:28%;" class="align-left">
								Numele angajatului implicat
							</th>
							<th style="width:28%;" class="align-left">
								Tipul evenimentului
							</th>
							<th style="width:100px;">
								&nbsp;
							</th>
						</tr>
						
						<!-- Existing rows -->
						<?php
							$i = 0;
							//echo DrawObject($kik_company_accidente);
							if ($kik_company_accidente[0]) foreach ($kik_company_accidente[0] as $kik_company_accident) {
								$i++;
						?>
						<tr>
							<td colspan="5">
								<table class="table_type_row">
									<tr>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W datetimepicker_input align-center" id="kik_company_accident_<?php echo $i; ?>_cercetare" name="kik_company_accidente[<?php echo $i; ?>][cercetare]" value="<?php echo $kik_company_accident[cercetare] ? $kik_company_accident[cercetare] : 'Data cercetarii" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Data cercetarii" />
											</div>
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W datetimepicker_input align-center" id="kik_company_accident_<?php echo $i; ?>_producere" name="kik_company_accidente[<?php echo $i; ?>][producere]" value="<?php echo $kik_company_accident[producere] ? $kik_company_accident[producere] : 'Data producerii" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Data producerii" />
											</div>
										</td>
										<td style="width:28%;" class="align-left">
											<div class="box_H_margin">
												<input type="text" class="size_full_W align-left" id="kik_company_accident_<?php echo $i; ?>_angajat" name="kik_company_accidente[<?php echo $i; ?>][angajat]" value="<?php echo $kik_company_accident[angajat] ? esc_html($kik_company_accident[angajat]) : 'Numele angajatului implicat" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Numele angajatului implicat" />
											</div>
										</td>
										<td style="width:28%;" class="align-left">
											<div class="box_H_margin">
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
													'selected'           => $kik_company_accident[tip],
													'hierarchical'       => 1, 
													'name'               => 'kik_company_accidente[' . $i . '][tip]',
													'id'                 => 'kik_company_accident_' . $i . '_tip',
													'class'              => 'size_full_W',
													'depth'              => 0,
													'tab_index'          => 0,
													'taxonomy'           => 'kik_tipuri_evenimente',
													'hide_if_empty'      => false,
												));
												?>
											</div>
										</td>
										<td style="width:100px;">
											<div class="box_H_margin">
												<a class="kik_company_accident_delete" href="javascript:;">Sterge</a>
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:100%;" class="align-left" colspan="4">
											<textarea class="size_full_W_2_rows align-left" id="kik_company_accident_<?php echo $i; ?>_descriere" name="kik_company_accidente[<?php echo $i; ?>][descriere]" data-autohint="true" title="Scurta descriere a cauzelor accidentului"<?php echo $kik_company_accident[descriere] ? '>' . esc_html($kik_company_accident[descriere]) : 'style="color:#cccccc; font-style:italic;">Scurta descriere a cauzelor accidentului'; ?></textarea>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php
							}
						?>
						
						<!-- Add MORE rows -->
						<tr id="kik_company_accidente_add_tr" data-accidente="<?php echo $i; ?>" class="last">
							<td colspan="5">
								<a id="kik_company_accidente_add_a" href="#">Adauga accident</a>
							</td>
						</tr>
						
					</table>
					