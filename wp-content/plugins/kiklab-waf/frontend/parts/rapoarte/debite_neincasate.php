<div class="row">
	<div class="col-sm-12">
		<h3 class="tab-title no-margin-top reports-title"><i>Debite neîncasate</i></h3>
	</div>
</div>

<form name="kik_report_debite_neincasate" action="" method="post" data-report-type="Debite-neincasate" data-file-name="Debite_neincasate">
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
				<th class="col-md-2"></th>
				<th class="col-md-10"></th>
			</tr>
		</thead>
		<tbody>
			<!-- DATA INCEPUT -->
			<tr>
				<td><label for="kik_report_debite_neincasate_data_inceput">Data început:</label></td>
				<td>
					<div class="col-md-12">
						<input 	type="text" 
							class="form-control debite-neincasate-start-datepicker" 
							id="kik_report_debite_neincasate_data_inceput" 
							name="kik_report_debite_neincasate_data_inceput" 
							value="" />
					</div>
				</td>
			</tr>
			<!-- DATA SFARSIT -->
			<tr>
				<td><label for="kik_report_debite_neincasate_data_sfarsit">Data sfârșit:</label></td>
				<td>
					<div class="col-md-12">
						<input 	type="text" 
									class="form-control debite-neincasate-end-datepicker" 
									id="kik_report_debite_neincasate_data_sfarsit" 
									name="kik_report_debite_neincasate_data_sfarsit" 
									value="" />
					</div>
				</td>
			</tr>
			<!-- INSPECTOR SSM -->
			<tr>
				<td>
					<label for="kik_report_debite_neincasate_inspector">Inspector SSM:</label>
				</td>
				<td>
					<div class="col-md-12"><?php 
						echo KIK_DROPDOWN_USERS(
							'kik_report_debite_neincasate_inspector', 
							'kik_report_debite_neincasate_inspector', 
							'kik_ssm', '', true); ?>
					</div>
				</td>
			</tr>
			<!-- AGENT VANZARI -->
			<tr>
				<td>
					<label for="kik_report_debite_neincasate_sales_agent">Agent:</label>
				</td>
				<td>
					<div class="col-md-12"><?php
						echo KIK_DROPDOWN_USERS(
						'kik_report_debite_neincasate_sales_agent', 
						'kik_report_debite_neincasate_sales_agent', 
						'kik_inspector_ssm', '', true); ?>
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
	
	<!-- <div class="report_container">
		<div class="report_sheet" data-report-type="Debite-neîncasate" data-file-name="Debite_neîncasate">
			<table cellspacing='0' cellpadding='0' style='width: 700px;'>
				<tr>
					<td colspan='3' height="50"></td>
				</tr>
				<tr align='center'>
					<td colspan="3" width='650'>
						<b>FIRME CARE AU DEBITE NEÎNCASATE ÎN PERIOADA</b>
					</td>
				</tr>
				<tr align='center'>
					<td colspan="3" width='650'>
						<b>
							<span class="report_field debite-neincasate-data-inceput">&emsp;&emsp;</span> - 
							<span class="report_field debite-neincasate-data-sfarsit">&emsp;&emsp;</span>
						</b>
					</td>
				</tr>
				<tr>
					<td colspan="3" height="30"></td>
				</tr>
			</table>
			
			 DATA TABLE 
			<table border="1" cellspacing='0' cellpadding='0' style='width: 700px;' class='rap-debite-neincasate'>
				
				<thead>
					<tr>
						<th width="20" align="center">#</th>
						<th width="200" align="center"> Firmă </th>
						<th width="60" align="center"> Data </th>
						<th width="60" align="center"> Nr. </th>
						<th width="60" align="center"> Valoare </th>
						<th width="100" align="center"> Inspector SSM</th>
						<th width="100" align="center"> Agent de vânzări</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div> -->
</form>

