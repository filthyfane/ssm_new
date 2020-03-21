					
					<div class="kik_company_fields_title">CSSM (<?php echo count($kik_company_cssm[0]); ?>)</div>
					
					<table class="kik_company_fields table_type_main">
						
						<!-- ECHIPAMENTE -->
						
						<!-- Labels -->
						<tr>
							<th style="width:22%;">
								Data sedinta CSSM
							</th>
							<th style="width:60px;" class="align-left">
								Realizat?
							</th>
							<th style="width:78%;">
								&nbsp;
							</th>
							<th style="width:100px;">
								&nbsp;
							</th>
						</tr>
						
						<!-- Existing rows -->
						<?php
							$i = 0;
							//echo DrawObject($kik_company_cssm);
							if ($kik_company_cssm[0]) foreach ($kik_company_cssm[0] as $sedinta) {
								$i++;
						?>
						<tr>
							<td colspan="4">
								<input type="hidden" name="kik_company_cssm[<?php echo $i; ?>][unique_id]" value="<?php echo $sedinta[unique_id] ? $sedinta[unique_id] : KIK_ASSIGN_UNIQUE_ID(); ?>"/>
								<table class="table_type_row">
									<tr>
										<td style="width:22%;">
											<div class="box_H_margin">
												<input type="text" class="size_full_W datetimepicker_input align-center" id="kik_company_cssm_<?php echo $i; ?>_data" name="kik_company_cssm[<?php echo $i; ?>][cssm_data]" value="<?php echo $sedinta[cssm_data] ? $sedinta[cssm_data] : 'Data sedintei CSSM" style="color:#cccccc; font-style:italic;'; ?>" data-autohint="true" title="Data sedintei CSSM" />
											</div>
										</td>
										<td style="width:60px;">
											<div class="box_H_margin">
												<input type="checkbox" id="kik_company_cssm_<?php echo $i; ?>_cssm_bool" name="kik_company_cssm[<?php echo $i; ?>][cssm_bool]" <?php if ($sedinta[cssm_bool]) echo 'checked'; ?> />
											</div>
										</td>
										<td style="width:78%;">&nbsp;</td>
										<td style="width:100px;">
											<div class="box_H_margin">
												<a class="kik_company_cssm_delete" href="javascript:;">Sterge</a>
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
						<tr id="kik_company_cssm_add_tr" data-ssm="<?php echo $i; ?>" class="last">
							<td colspan="4">
								<a id="kik_company_cssm_add_a" href="javascript:;">Adauga sedinta CSSM</a>
							</td>
						</tr>
						
					</table>
					