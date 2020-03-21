					
					<div class="kik_company_fields_title">PV instructaj</div>
					
						<form name="kik_report_pv_instructaj" action="" method="post">
							
							<table class="kik_company_fields table_type_main reports" data-tab="PV instructaj">
								
								<!-- PV predare documente -->
								
								<!-- Labels -->
								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
								</tr>
								
								<!-- Existing rows -->
								<tr>
									<td colspan="2">
										<table class="table_type_row">
											
											<!-- Nr -->
											<tr>
												<td>
													<label for="kik_report_pv_instructaj_nr">Nr:</label>
												</td>
												<td>
													<input type="text" class="size_xs" id="kik_report_pv_instructaj_nr" name="kik_report_pv_instructaj_nr" value="" />
												</td>
											</tr>
											<!-- Data -->
											<tr>
												<td>
													<label for="kik_report_pv_instructaj_data">Data:</label>
												</td>
												<td>
													<input type="text" class="size_xs datetimepicker_input" id="kik_report_pv_instructaj_data" name="kik_report_pv_instructaj_data" value="" />
												</td>
											</tr>
											<!-- Reprezentant SSM -->
											<tr>
												<td>
													<label for="kik_report_pv_instructaj_reprezentant_ssm">Reprezentant SSM:</label>
												</td>
												<td>
													<input type="text" class="size_m" id="kik_report_pv_instructaj_reprezentant_ssm" name="kik_report_pv_instructaj_reprezentant_ssm" value="" />
												</td>
											</tr>
											<!-- Reprezentant firma -->
											<tr>
												<td>
													<label for="kik_report_pv_instructaj_reprezentant_firma">Reprezentant firmă:</label>
												</td>
												<td>
													<input type="text" class="size_m" id="kik_report_pv_instructaj_reprezentant_firma" name="kik_report_pv_instructaj_reprezentant_firma" value="" />
												</td>
											</tr>
											<!-- Firma -->
											<tr>
												<td>
													<label for="kik_report_pv_instructaj_firma">Firmă:</label>
												</td>
												<td>
													<?php echo KIK_DROPDOWN_POSTS('kik_report_pv_instructaj_firma', 'kik_report_pv_instructaj_firma', 'kik_company', '', 'size_xl', '-- alege --'); ?>
												</td>
											</tr>
											<!-- Departament -->
											<tr>
												<td>
													<label for="kik_report_pv_instructaj_departament">Departament/secție/filială:</label>
												</td>
												<td>
													<input type="text" class="size_m" id="kik_report_pv_instructaj_departament" name="kik_report_pv_instructaj_departament" value="" />
												</td>
											</tr>
											<!-- Lista angajati -->
											<tr>
												<td>
													<label for="kik_report_pv_instructaj_angajati">Lista angajati?</label>
												</td>
												<td>
													<input type="checkbox" id="kik_report_pv_instructaj_angajati" name="kik_report_pv_instructaj_angajati" />
												</td>
											</tr>
											<!-- Material -->
											<tr>
												<td>
													<label for="kik_report_pv_instructaj_material">Material:</label>
												</td>
												<td>
													<textarea id="kik_report_pv_instructaj_material" name="kik_report_pv_instructaj_material" class="size_xxl size_2_rows"></textarea>
												</td>
											</tr>
											
										</table>
									</td>
								</tr>
								
							</table>
							
							&nbsp;<br />
							
							<div class="kik_save_area"><a class="kik_save_btn edit" href="javascript:;"><i class="fa fa-fw fa-save"></i> Generează</a><div class="kik_save_btn_response"></div><a class="kik_save_btn print" style="float:right;" href="javascript:;"><i class="fa fa-fw fa-print"></i> Printează</a></div>
							
							<div class="report_container">
								<div class="report_sheet pv_instructaj">
									
									
									
								</div>
							</div>
							
						</form>