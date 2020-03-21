					
					<div class="kik_company_fields_title">Instructaj</div>
					
						<form name="kik_report_instructaj" action="" method="post">
							
							<table class="kik_company_fields table_type_main reports" data-tab="Instructaj">
								
								<!-- PV predare documente -->
								
								<!-- Labels -->
								<tr>
									<th>
										&nbsp;
									</th>
									<th>
										&nbsp;
									</th>
								</tr>
								
								<!-- Existing rows -->
								<tr>
									<td colspan="2">
										<table class="table_type_row">
											
											<!-- Data inceput -->
											<tr>
												<td>
													<label for="kik_report_instructaj_data_inceput">Data inceput:</label>
												</td>
												<td>
													<input type="text" class="size_xs datetimepicker_input" id="kik_report_instructaj_data_inceput" name="kik_report_instructaj_data_inceput" value="" />
												</td>
											</tr>
											<!-- Data sfarsit -->
											<tr>
												<td>
													<label for="kik_report_instructaj_data_sfarsit">Data sfarsit:</label>
												</td>
												<td>
													<input type="text" class="size_xs datetimepicker_input" id="kik_report_instructaj_data_sfarsit" name="kik_report_instructaj_data_sfarsit" value="" />
												</td>
											</tr>
											<!-- Inspector SSM -->
											<tr>
												<td>
													<label for="kik_report_instructaj_inspector">Inspector SSM:</label>
												</td>
												<td>
													<?php echo KIK_DROPDOWN_USERS('kik_report_instructaj_inspector', 'kik_report_instructaj_inspector', 'Inspector SSM', '', true); ?>
												</td>
											</tr>
											
										</table>
									</td>
								</tr>
								
							</table>
							
							&nbsp;<br />
							
							<div class="kik_save_area"><a class="kik_save_btn edit" href="javascript:;"><i class="fa fa-fw fa-save"></i> Generează</a><div class="kik_save_btn_response"></div><a class="kik_save_btn print" style="float:right;" href="javascript:;"><i class="fa fa-fw fa-print"></i> Printează</a></div>
							
							<div class="report_container">
								<div class="report_sheet instructaj">
									
									
									
								</div>
							</div>
							
						</form>