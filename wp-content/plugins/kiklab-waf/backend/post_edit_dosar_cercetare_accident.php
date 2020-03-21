
	<div class="row no-margin">
		<div class="col-sm-12">
			<h3 class="tab-title"><i>Dosare cercetare accidente (<?php echo $kik_files_size;  ?>)</i></h3>
		</div>
	</div>	

	<table class="table table-bordered table-hover" id="accident-file-table" style="width: 100%">
		<thead class="thead-dark">
			<tr>
				<th>Data cercetării</th>
				<th>Data accidentului</th>
				<th>Numele angajatului implicat</th>
				<th>Descriere accident</th>
				<th>Acțiuni</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>


	<!-- MODAL NEW ACCIDENT FILE -->
	<div id="new-accident-file-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Adaugă dosar</h4>
				</div>
				<div class="modal-body">
					<!-- FIELD: DATA CERCETARII -->
					<div class="form-group no-margin">
						<label class="control-label col-sm-3" for="kik_data_cercetarii">Data cercetării: </label>
						<div class="col-sm-9">
							<input 	type="text" 
								class="form-control new new-data-cercetare-datepicker" 
								id="kik_data_cercetarii" 
								placeholder="Data cercetării" 
								name="kik_data_cercetarii" />
						</div>
					</div>		
					
					<!-- FIELD: DATA ACCIDENTULUI -->
					<div class="form-group no-margin">
						<label class="control-label col-sm-3" for="kik_data_accidentului">Data accidentului: </label>
						<div class="col-sm-9">
							<input 	type="text" 
								class="form-control new new-data-accident-datepicker" 
								id="kik_data_accidentului" 
								placeholder="Data accidentului" 
								name="kik_data_accidentului" />
						</div>
					</div>
					
					<!-- FIELD: NUMELE ANGAJATULUI -->
					<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_accident_angajat">Numele angajatului: </label>
							<div class="col-sm-9"><?php
								if($kik_employees_size > 0) { ?>
									<select class="form-control" id="kik_accident_angajat" name="kik_accident_angajat">
										<option value='-1'>- Alege -</option><?php 
											foreach ($kik_employees as $employee) { ?>
												<option value="<?php echo $employee->ID; ?>"><?php
													echo get_post_meta($employee->ID, 'numeAngajat', true).' '.
															get_post_meta($employee->ID, 'prenumeAngajat', true); ?>
												</option><?php 
											} ?>
									</select><?php 
								}  else {
									echo "<span class='form-control'>Nu există nici un angajat pentru această companie</span>";
								} ?>
							</div>
					</div> 	
						
					<!-- FIELD: DESCRIERE ACCIDENT -->
					<div class="form-group no-margin">
						<label class="control-label col-sm-3" for="kik_accident_descriere">Descriere accident:</label>
						<div class="col-sm-9">
							<textarea class="form-control" rows="5" id="kik_accident_descriere" name="kik_accident_descriere" placeholder="Scurtă descriere a accidentului"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
					<button type="button" class="btn btn-primary" id="add-new-file">Salvează dosar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	

