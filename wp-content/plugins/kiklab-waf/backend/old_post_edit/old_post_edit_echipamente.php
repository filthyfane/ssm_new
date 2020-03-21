					
					<div class="kik_company_fields_title">Echipamente (<?php echo count($kik_company_echipamente[0]); ?>)</div>
					
					<table class="kik_company_fields table_type_main">
						
						<!-- ECHIPAMENTE -->
						
						<!-- Labels -->
						<tr>
							<th style="width:46%;">
								Echipament
							</th>
							<th style="width:10%;">
								Bucati
							</th>
							<th style="width:22%;">
								Data expirare
							</th>
							<th style="width:50px;" class="align-right">
								ISCIR?
							</th>
							<th style="width:22%;">
								Data expirare ISCIR
							</th>
							<th style="width:100px;">
								&nbsp;
							</th>
						</tr>
						
						<!-- Existing rows -->
						<?php
							$i = 0;
							//echo DrawObject($kik_company_echipamente);
							if ($kik_company_echipamente[0]) foreach ($kik_company_echipamente[0] as $kik_company_echipament) {
								$i++;
						?>
						<tr>
							<td colspan="6">
								<input type="hidden" name="kik_company_echipamente[<?php echo $i; ?>][unique_id]" value="<?php echo $kik_company_echipament[unique_id] ? $kik_company_echipament[unique_id] : KIK_ASSIGN_UNIQUE_ID(); ?>"/>
								<table class="table_type_row">
									<tr>
										<td style="width:46%;">
											<div class="box_H_margin">
												<?php
												wp_dropdown_categories(array(
													'show_option_all'    => '',
													'show_option_none'   => '',
													'orderby'            => 'NAME', 
													'order'              => 'ASC',
													'show_count'         => 0,
													'hide_empty'         => 0,
													'child_of'           => 0,
													'exclude'            => '',
													'echo'               => 1,
													'selected'           => $kik_company_echipament[id],
													'hierarchical'       => 1, 
													'name'               => 'kik_company_echipamente[' . $i . '][id]',
													'id'                 => 'kik_company_echipament_' . $i . '_id',
													'class'              => 'size_full_W',
													'depth'              => 0,
													'tab_index'          => 0,
													'taxonomy'           => 'kik_echipamente',
													'hide_if_empty'      => false,
												));
												?>
											</div>
										</td>
										<td style="width:10%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W align-right" id="kik_company_echipament_<?php echo $i; ?>_buc" name="kik_company_echipamente[<?php echo $i; ?>][buc]" value="<?php echo $kik_company_echipament[buc] ? esc_html($kik_company_echipament[buc]) : 'Buc" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Buc" />
											</div>
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W datetimepicker_input align-center" id="kik_company_echipament_<?php echo $i; ?>_exp" name="kik_company_echipamente[<?php echo $i; ?>][exp]" value="<?php echo $kik_company_echipament[exp] ? $kik_company_echipament[exp] : 'Data expirarii" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Data expirarii" />
											</div>
										</td>
										<td style="width:50px;" class="align-right">
											<input type="checkbox" class="KIK_iscir" id="kik_company_echipament_<?php echo $i; ?>_iscir_bool" name="kik_company_echipamente[<?php echo $i; ?>][iscir_bool]" <?php if ($kik_company_echipament[iscir_bool]) echo 'checked'; ?> />
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W datetimepicker_input align-center" id="kik_company_echipament_<?php echo $i; ?>_iscir" name="kik_company_echipamente[<?php echo $i; ?>][iscir]" value="<?php echo $kik_company_echipament[iscir] ? $kik_company_echipament[iscir] : 'Data expirarii ISCIR" style="color:#cccccc; font-style:italic; display:' . ($kik_company_echipament[iscir_bool] ? 'block' : 'none') . ';'; ?>" data-autohint="true" title="Data expirarii ISCIR" />
												<div class="size_full_W_full_H align-center" style="display:<?php echo $kik_company_echipament[iscir_bool] ? 'none' : 'block'; ?>;">--</div>
											</div>
										</td>
										<td style="width:100px;">
											<div class="box_H_margin">
												<a class="kik_company_echipament_delete" href="javascript:;">Sterge</a>
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
						<tr id="kik_company_echipamente_add_tr" data-echipamente="<?php echo $i; ?>" class="last">
							<td colspan="6">
								<a id="kik_company_echipamente_add_a" href="javascript:;">Adauga echipament</a>
							</td>
						</tr>
						
					</table>
					