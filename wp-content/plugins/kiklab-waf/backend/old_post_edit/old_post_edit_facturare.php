					
					<div class="kik_company_fields_title">Facturare</div>
					
					<table class="kik_company_fields table_type_main">
						
						<!-- SETARI FACTURARE -->
						
						<!-- Labels -->
						<tr>
							<th style="width:22%;">
								Perioada de facturare
							</th>
							<th style="width:22%;">
								Termen de plata
							</th>
							<th style="width:56%;">
								&nbsp;
							</th>
						</tr>
						
						<!-- Existing rows -->
						<tr>
							<td colspan="3">
								<table class="table_type_row">
									<tr>
										<td style="width:22%;">
											<div class="box_H_margin">
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
													'name'               => 'kik_company_billing_frequency_dedicated',
													'id'                 => 'kik_company_billing_frequency_dedicated',
													'class'              => 'size_full_W',
													'depth'              => 0,
													'tab_index'          => 0,
													'taxonomy'           => 'kik_perioada_de_facturare',
													'hide_if_empty'      => false,
												));
												?>
											</div>
										</td>
										<td style="width:22%;">
											<input type="text" class="size_xs" id="kik_company_billing_deadline_dedicated" name="kik_company_billing_deadline_dedicated" value="<?php echo $kik_company_billing_deadline; ?>" style="text-align:right;" />
											<select id="kik_company_billing_deadline_type_dedicated" name="kik_company_billing_deadline_type_dedicated">
												<option value="zile"<?php echo $kik_company_billing_deadline_type == 'zile' ? ' selected="selected"' : '';?>>zile</option>
												<option value="luni"<?php echo $kik_company_billing_deadline_type == 'luni' ? ' selected="selected"' : '';?>>luni</option>
												<option value="ani"<?php echo $kik_company_billing_deadline_type == 'ani' ? ' selected="selected"' : '';?>>ani</option>
											</select>
										</td>
										<td style="width:56%;">
											&nbsp;
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
					</table>
					
					&nbsp;<br />
					
					<div class="kik_company_fields_title">Istoric facturi (<?php echo count($kik_company_billing_history[0]); ?>)</div>
					
					<table class="kik_company_fields table_type_main">
						
						<!-- Istoric facturi -->
						
						<!-- Labels -->
						<tr>
							<th style="width:22%;">
								Data factura
							</th>
							<th style="width:22%;">
								Nr. factura
							</th>
							<th style="width:22%;">
								Valoare
							</th>
							<th style="width:100px;" class="align-left">
								Incasat?
							</th>
							<th style="width:100px;" class="align-left">
								Depășit?
							</th>
							<th style="width:34%;">
								&nbsp;
							</th>
							<th style="width:100px;">
								&nbsp;
							</th>
						</tr>
						
						<!-- Existing rows -->
						<?php
							$i = 0;
							//echo DrawObject($kik_company_billing_history);
							if ($kik_company_billing_history[0]) foreach ($kik_company_billing_history[0] as $factura) {
								$i++;
						?>
						<tr>
							<td colspan="7">
								<input type="hidden" name="kik_company_billing_history[<?php echo $i; ?>][unique_id]" value="<?php echo $factura[unique_id] ? $factura[unique_id] : KIK_ASSIGN_UNIQUE_ID(); ?>"/>
								<table class="table_type_row">
									<tr>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W datetimepicker_input align-center" id="kik_company_billing_history_<?php echo $i; ?>_bill_date" name="kik_company_billing_history[<?php echo $i; ?>][bill_date]" value="<?php echo $factura[bill_date] ? $factura[bill_date] : 'Data factura" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Data factura" />
											</div>
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W align-right" id="kik_company_billing_history_<?php echo $i; ?>_bill_nr" name="kik_company_billing_history[<?php echo $i; ?>][bill_nr]" value="<?php echo $factura[bill_nr] ? esc_html($factura[bill_nr]) : 'Nr. factura" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Nr. factura" />
											</div>
										</td>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W align-right" id="kik_company_billing_history_<?php echo $i; ?>_bill_val" name="kik_company_billing_history[<?php echo $i; ?>][bill_val]" value="<?php echo $factura[bill_val] ? esc_html($factura[bill_val]) : 'Valoare" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Valoare" />
											</div>
										</td>
										<td style="width:100px;">
											<input type="checkbox" id="kik_company_billing_history_<?php echo $i; ?>_bill_bool" name="kik_company_billing_history[<?php echo $i; ?>][bill_bool]" <?php if ($factura[bill_bool]) echo 'checked'; ?> />
										</td>
										<?php
											$d1 = strtotime($factura[bill_date]);
											$d2 = strtotime(date('Y-m-d', time()));
											if (!$factura[bill_bool] && ($d1 < $d2)) $bill_over = floor(($d2 - $d1) / (60 * 60 * 24));
										?>
										<td style="width:100px;">
											<label class="color-red"><?php echo ($bill_over ? ($bill_over > 1 ? $bill_over . ' zile' : $bill_over . ' zi') : ''); ?></label>
										</td>
										<td style="width:34%;">
											<div class="box_H_margin">
												&nbsp;
											</div>
										</td>
										<td style="width:100px;">
											<div class="box_H_margin">
												<a class="kik_company_billing_history_delete" href="javascript:;">Sterge</a>
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
						<tr id="kik_company_billing_history_add_tr" data-bills="<?php echo $i; ?>" class="last">
							<td colspan="7">
								<a id="kik_company_billing_history_add_a" href="javascript:;">Adauga factura</a>
							</td>
						</tr>
						
					</table>
					