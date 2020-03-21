
	<div class="row">
		<div class="col-sm-12">
			<h3 class="tab-title no-margin-top reports-title"><i>Proces-verbal instructaj</i></h3>
		</div>
	</div>
					
					
	<form name="kik_report_pv_instructaj" action="" method="post" data-report-type="Proces-verbal" data-file-name="PV_instructaj">
		<table class="table table-hover">
			<thead class="thead-dark">
				<tr>
					<th class="col-md-2"></th>
					<th class="col-md-10"></th>
				</tr>
			</thead>
			<tbody>
				<!-- NUMAR PV -->
				<tr>
					<td><label for="kik_report_pv_instructaj_nr">Număr proces-verbal:</label></td>
					<td>
						<div class="col-md-12">
							<input 	type="text" 
										class="form-control" 
										id="kik_report_pv_instructaj_nr" 
										name="kik_report_pv_instructaj_nr" 
										value="" />
						</div>
					</td>
				</tr>
				<!-- DATA INTOCMIRII -->
				<tr>
					<td><label for="kik_report_pv_instructaj_data">Data:</label></td>
					<td>
						<div class="col-md-12">
							<input 	type="text" 
										class="form-control pv-instructaj-datepicker" 
										id="kik_report_pv_instructaj_data" 
										placeholder="Data întocmirii" 
										name="kik_report_pv_instructaj_data"/>
						</div>
					</td>
				</tr>
				<!-- REPREZENTANT SSM -->
				<tr>
					<td><label for="kik_report_pv_instructaj_reprezentant_ssm">Reprezentant SSM:</label></td>
					<td>
						<div class="col-md-12">
							<?php 
							echo KIK_DROPDOWN_USERS(
							'kik_report_pv_instructaj_reprezentant_ssm', 
							'kik_report_pv_instructaj_reprezentant_ssm', 
							'kik_ssm', '', true); ?>
						</div>
					</td>
				</tr>
				<!-- REPREZENTANT FIRMA -->
				<tr>
					<td><label for="kik_report_pv_instructaj_reprezentant_firma">Reprezentant firmă:</label></td>
					<td>
						<div class="col-md-12">
							<input 	type="text" 
										class="form-control" 
										id="kik_report_pv_instructaj_reprezentant_firma" 
										name="kik_report_pv_instructaj_reprezentant_firma" 
										value="" />
						</div>
					</td>
				</tr>
				<!-- FIRMA -->
				<tr>
					<td><label for="kik_report_pv_instructaj_firma">Numele firmei:</label></td>
					<td>
						<div class="col-md-12"><?php 
							echo KIK_DROPDOWN_POSTS(
								'kik_report_select_firma', 
								'kik_report_select_firma', 
								'kik_company', 
								'', 
								'form-control', 
								'-- alege --'); ?>
						</div>
					</td>
				</tr>
				<!-- DEPARTAMENT -->
				<tr>
					<td><label for="kik_report_pv_instructaj_departament">Departament/secție/filială:</label></td>
					<td>
						<div class="col-md-12">
							<input 	type="text" 
										class="form-control" 
										id="kik_report_pv_instructaj_departament" 
										name="kik_report_pv_instructaj_departament" 
										value="" />
						</div>
					</td>
				</tr>
				<!-- LISTA ANGAJATI -->
				<tr>
					<td><label for="kik_report_pv_instructaj_angajati">Listă angajați?</label></td>
					<td>
						<div class="col-sm-12">
							<div class="checkbox">
								<label class='checkbox-label'>
									<input 	type="checkbox"
												id="kik_report_pv_instructaj_angajati" 
												name="kik_report_pv_instructaj_angajati" />
									<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								</label>
							</div>
						</div>
					</td>
				</tr>
				<!-- MATERIAL -->
				<tr>
					<td>
						<label for="kik_report_pv_instructaj_material">Material:</label>
					</td>
					<td>
						<div class="col-md-12">
							<textarea 	id="kik_report_pv_instructaj_material" 
											name="kik_report_pv_instructaj_material" 
											class="form-control"></textarea>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<div class="kik_save_area">
			<a class="btn btn-primary populate-report" href="javascript:;">
				<i class="fa fa-fw fa-save"></i> Generează
			</a>
			<a class="btn btn-primary save-pdf-report" style="float:right;" href="javascript:;">
				<i class="fa fa-fw fa-print"></i> Printează
			</a>
		</div>
		
		<!-- ======================================== -->
		<!-- ======== PAGE PREVIEW ================== -->
		<!-- ======================================== -->
		
		<div class="report_container">
			<div class="report_sheet" data-report-type="Proces-verbal" data-file-name="PV_instructaj">
				<table cellspacing='0' cellpadding='0' style='width: 700px;'>
					<tr>
						<td colspan='3' height="50"></td>
					</tr>
					<tr align='center'>
						<td colspan="3" width='650'>
							<b>PROCES VERBAL DE PREDARE-PRIMIRE</b>
						</td>
					</tr>
					<tr align='center'>
						<td colspan="3" width='650'>
							<b>privind securitatea și sănătatea în muncă / situații de urgență</b>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center">
							<b>Nr. <span class="report_field nbr-field">&emsp;&emsp;</span> / 
							<span class="report_field pv-data-field">&emsp;&emsp;</span></b>
						</td>
					</tr>
					<tr>
						<td colspan="3" height="30"></td>
					</tr>
					<tr>
						<td colspan="3">
							<span style="color: white">____________</span>Subsemnatul 
							<span class="report_field pv-reprezentant-ssm">&emsp;&emsp;</span>
							, reprezentant al Serviciului Extern de Prevenire și Protecție, am predat domnului/doamnei
							<span class="report_field pv-repr-firma-field">&emsp;&emsp;</span>
							, în calitate de conducător al locului de muncă al companiei
							<span class='report_field pv-firma-field'>&emsp;&emsp;</span>
							, materialul pentru instructajul periodic privind SSM/SU, al salariaților din cadrul departamentului/secției/filialei
							<span class="report_field dept-field">&emsp;&emsp;</span>
						</td>
					</tr>
					<tr>
						<td colspan="3" height="30"></td>
					</tr>
					<tr>
						<td colspan="3" height="40" valign="top">
							<span style="color: white">____________</span>
							În cadrul instruirii s-a prelucrat următorul material specific:
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<div class="report_box"></div>
						</td>
					</tr>
					
				</table>
			</div>
		</div>
		
	</form>