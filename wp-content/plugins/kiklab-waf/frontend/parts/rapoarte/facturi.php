	<div class="row">
		<div class="col-sm-12">
			<h3 class="tab-title no-margin-top reports-title"><i>Facturi</i></h3>
		</div>
	</div>	
	
	
	<form name="kik_report_facturi" action="" method="post" data-report-type="Facturi-de-întocmit" data-file-name="Facturi_de_intocmit">
		<table class="table table-hover">
			<thead class="thead-dark">
				<tr>
					<th class="col-md-2"></th>
					<th class="col-md-10"></th>
				</tr>
			</thead>
			<tbody>
				<!-- DATA DE INCEPUT FACTURI -->
				<tr>
					<td><label for="kik_report_facturi_data_inceput">Data de început:</label></td>
					<td>
						<div class="col-md-12">
							<input 	type="text" 
										class="form-control raport-facturi-data-start" 
										id="kik_report_facturi_data_inceput" 
										placeholder="Data început" 
										name="kik_report_facturi_data_inceput"/>
						</div>
					</td>
				</tr>
				<!-- DATA DE SFÂRȘIT FACTURI -->
				<tr>
					<td><label for="kik_report_facturi_data_sfarsit">Data de sfârșit:</label></td>
					<td>
						<div class="col-md-12">
							<input 	type="text" 
										class="form-control raport-facturi-data-sfarsit" 
										id="kik_report_facturi_data_sfarsit" 
										placeholder="Data sfârșit" 
										name="kik_report_facturi_data_sfarsit"/>
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
	</form>