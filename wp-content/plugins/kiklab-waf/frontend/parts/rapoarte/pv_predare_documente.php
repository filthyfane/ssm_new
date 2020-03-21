
	<div class="row">
		<div class="col-sm-12">
			<h3 class="tab-title no-margin-top reports-title"><i>Proces-verbal predare documente</i></h3>
		</div>
	</div>	

	<!-- PV predare documente -->
	<form name="kik_report_pv_predare_documente" action="" method="post" data-report-type="Proces-verbal" data-file-name="PV_predare_documente">
		<table class="table table-hover">
			<thead class="thead-dark">
				<tr>
					<th class="col-md-2"></th>
					<th class="col-md-10"></th>
				</tr>
			</thead>
			<tbody>
				<!-- DATA INTOCMIRII -->
				<tr>
					<td><label for="kik_report_pv_predare_documente_data">Data:</label></td>
					<td>
						<div class="col-md-12">
							<input 	type="text" 
										class="form-control new pv-predare-doc-datepicker" 
										id="kik_report_pv_predare_documente_data" 
										placeholder="Data întocmirii" 
										name="kik_report_pv_predare_documente_data"/>
						</div>
					</td>
				</tr>
				<!-- REPREZENTANT SSM -->
				<tr>
					<td><label for="kik_report_pv_predare_documente_reprezentant_ssm">Reprezentant SSM:</label></td>
					<td>
						<div class="col-md-12"><?php
						echo KIK_DROPDOWN_USERS(
							'kik_report_pv_predare_documente_reprezentant_ssm', 
							'kik_report_pv_predare_documente_reprezentant_ssm', 
							'kik_ssm', '', true); ?>
							
							<!-- <input 	type="text" 
										class="form-control" 
										id="kik_report_pv_predare_documente_reprezentant_ssm" 
										name="kik_report_pv_predare_documente_reprezentant_ssm" 
										value="" /> -->
						</div>
					</td>
				</tr>
				<!-- FIRMA -->
				<tr>
					<td><label for="kik_company_contract_type">Firma:</label></td>
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
				<!-- REPREZENTANT FIRMA -->
				<tr>
					<td><label for="kik_report_pv_predare_documente_reprezentant_firma">Reprezentant firmă:</label></td>
					<td>
						<div class="col-md-12">
							<input 	type="text" 
										class="form-control" 
										id="kik_report_pv_predare_documente_reprezentant_firma" 
										name="kik_report_pv_predare_documente_reprezentant_firma" 
										value="" />
						</div>
					</td>
				</tr>
			</tbody>
		</table>

	
		<div class="kik_save_area">
		<!--  kik_save_btn edit -->
			<a class="btn btn-primary populate-report" href="javascript:;">
				<i class="fa fa-fw fa-save"></i> Generează
			</a>
			<!-- <div class="kik_save_btn_response"></div> -->
			<a class="btn btn-primary save-pdf-report" style="float:right;" href="javascript:;">
				<i class="fa fa-fw fa-print"></i> Printează
			</a>
		</div>
		
		<!-- ======================================== -->
		<!-- ======== PAGE PREVIEW ================== -->
		<!-- ======================================== -->
		
		<div class="report_container">
			<div class="report_sheet" data-report-type="Proces-verbal" data-file-name="PV_predare_documente">
				<table cellspacing='0' cellpadding='0' style='width: 700px;'>
					<tr>
						<td colspan='3' height="50"></td>
					</tr>
					<tr align='center'>
						<td colspan="3" width='650'>
							<b>PROCES VERBAL DE PREDARE-PRIMIRE</b>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center">
							<b>din <span class="report_field pv-data-field">&emsp;&emsp;</span></b>
						</td>
					</tr>
					<tr>
						<td colspan="3" height="30"></td>
					</tr>
					<tr>
						<td colspan="3">
							<span style="color: white">____________</span>Subsemnatul 
							<span class="report_field pv-reprezentant-ssm">&emsp;&emsp;</span>, 
							reprezentant al SC Work Protection Business SRL, am predat domnului/doamnei 
							<span class="report_field pv-repr-firma-field">&emsp;&emsp;</span>, reprezentant al 
							<span class="report_field pv-firma-field">&emsp;&emsp;
							</span>, următoarele documente:
						</td>
					</tr>
					<tr>
						<td colspan="3" height="20"></td>
					</tr>
					<tr>
						<td width="20"></td>
						<td colspan="2" width="630"><?php
							foreach (get_terms('kik_documente_predate', array('hide_empty' => false)) as $term) {
								echo '<p><input type="checkbox" data-document="'.$term->name.'"> ' . $term->name . '</p>';
							} ?>
						</td>
					</tr>
					<tr><td height="70" colspan="3"></td></tr>
					<tr>
						<td width="20"> </td>
						<td width="315">Am predat,</td>
						<td width="315">Am primit,</td>
					</tr>
					<tr>
						<td colspan="3" height="20"></td>
					</tr>
					<tr>
						<td width="20"></td>
						<td width="315">__________________</td>
						<td width="315">__________________</td>
					</tr>
				</table>
			</div>
		</div>
	</form>

	