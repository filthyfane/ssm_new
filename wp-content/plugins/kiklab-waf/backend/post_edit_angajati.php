
	<!-- @param kik_employees_size frontend\post_body.php -->
	
	<div class="row no-margin">
		<div class="col-sm-12">
			<h3 class="tab-title"><i>Angajați (<span class="count-posts"><?php echo $kik_employees_size; ?></span>)</i></h3>
		</div>
	</div>				
	
	<!-- TABEL ANGAJATI -->

	<table class="table table-bordered table-hover" id="employees-table" style='width: 100%;'>
		<thead class="thead-dark">
			<tr>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Funcție</th>
				<th>Date angajat</th>
				<th>Acțiuni</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>

	<!-- ADD NEW EMPLOYEE MODAL -->
	<div id="new-employee-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Adaugă angajat</h4>
				</div>
				<div class="modal-body">
					<!-- FIELD: NUME -->
					<div class="form-horizontal">
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_angajat_lastname">Nume angajat: </label>
							<div class="col-sm-9">
								<input type="text" 
										  class="form-control" 
										  id="kik_angajat_lastname" 
										  placeholder="Nume angajat" name="kik_angajat_lastname"/>
							</div>
						</div>
						<!-- FIELD: PRENUME -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_angajat_firstname">Prenume angajat: </label>
							<div class="col-sm-9">
								<input type="text" 
										  class="form-control" 
										  id="kik_angajat_firstname" placeholder="Prenume angajat" 
										  name="kik_angajat_firstname"/>
							</div>
						</div>
						<!-- FIELD: FUNCTIE -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_angajat_functie">Funcție angajat: </label>
							<div class="col-sm-9">
								<input type="text" 
										  class="form-control" 
										  id="kik_angajat_functie" placeholder="Funcție" 
										  name="kik_angajat_functie"/>
							</div>
						</div>
						<!-- FIELD: ADRESA -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_angajat_adresa">Adresă angajat: </label>
							<div class="col-sm-9">
								<input type="text" 
										  class="form-control" 
										  id="kik_angajat_adresa" placeholder="Adresă angajat" 
										  name="kik_angajat_adresa"/>
							</div>
						</div>
						<!-- FIELD: CNP ANGAJAT -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_angajat_cnp">CNP angajat: </label>
							<div class="col-sm-9">
								<input type="text" size=13 maxlength=13
										  class="form-control" 
										  id="kik_angajat_cnp" placeholder="Cod numeric personal" 
										  name="kik_angajat_cnp"/>
							</div>
						</div>
						<!-- FIELD: NORMA DE LUCRU -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_angajat_norma">Norma de lucru: </label>
							<div class="col-sm-9"><?php
									wp_dropdown_categories(array(
										'show_option_none'   => '-- Alege --',
										'orderby'            => 'NAME', 
										'hide_empty'         => 0,
										'echo'               => 1,
										'selected'           => isset($kik_company_angajat['contract_type'])?$kik_company_angajat['contract_type'] : '',
										'name'               => 'kik_angajat_norma',
										'id'                 => 'kik_angajat_norma',
										'class'              => 'form-control',
										'taxonomy'           => 'kik_norme_lucru',
										'hide_if_empty'      => false,
									)); ?>
							</div>
						</div>
						<!-- FIELD: DATA INCEPERE CONTRACT -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_angajat_contract_start">Data de început a contractului: </label>
							<div class="col-sm-9">
								<input 	type="text" 
									class="form-control new new-data-exp-datepicker" 
									id="kik_angajat_contract_start" 
									placeholder="Dată început" 
									name="kik_angajat_contract_start" />
							</div>
						</div>
						<!-- FIELD: DATA SFARSIT CONTRACT -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_angajat_contract_end">Data de sfârșit a contractului: </label>
							<div class="col-sm-9">
								<input 	type="text" 
									class="form-control new new-data-exp-datepicker" 
									id="kik_angajat_contract_end" 
									placeholder="Dată sfârșit" 
									name="kik_angajat_contract_end" />
							</div>
						</div>
						<!-- FIELD: CONDUCATOR LOC DE MUNCA -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_angajat_conducator">Conducător loc de muncă: </label>
							<div class="col-sm-9">
								<div class="checkbox">
									<label class='checkbox-label'>
										<input 	type="checkbox"
													id="kik_angajat_conducator" 
													name="kik_angajat_conducator" />
										<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
									</label>
								</div>
							</div>
						</div>
						<!-- FIELD: TELEFON -->
						<div class="form-group no-margin" style="display:none">
							<label class="control-label col-sm-3" for="kik_angajat_telefon">Telefon: </label>
							<div class="col-sm-9">
								<input type="text"
										  class="form-control" 
										  id="kik_angajat_telefon" placeholder="Telefon" 
										  name="kik_angajat_telefon"/>
							</div>
						</div>
						<!-- FIELD: EMAIL -->
						<div class="form-group no-margin" style="display:none">
							<label class="control-label col-sm-3" for="kik_angajat_email">Email: </label>
							<div class="col-sm-9">
								<input type="text"
										  class="form-control" 
										  id="kik_angajat_email" placeholder="Email" 
										  name="kik_angajat_email"/>
							</div>
						</div>
						<!-- FIELD: AUTORIZATIE SPECIALA -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_angajat_autorizatie">Autorizație specială: </label>
							<div class="col-sm-9">
								<div class="checkbox">
									<label class='checkbox-label'>
										<input 	type="checkbox"
													id="kik_angajat_autorizatie" 
													name="kik_angajat_autorizatie" />
										<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
									</label>
								</div>
							</div>
						</div>
						<!-- FIELD: TIP AUTORIZATIE -->
						<div class="form-group no-margin" style="display:none">
							<label class="control-label col-sm-3" for="kik_angajat_tip_autorizatie">Tip autorizație: </label>
							<div class="col-sm-9">
								<input type="text"
										  class="form-control" 
										  id="kik_angajat_tip_autorizatie" placeholder="Tip autorizație" 
										  name="kik_angajat_tip_autorizatie"/>
							</div>
						</div>
						<!-- FIELD: DATA EXPIRARE AUTORIZATIE -->
						<div class="form-group no-margin" style="display:none">
							<label class="control-label col-sm-3" for="kik_angajat_autorizatie_end">Data de sfârșit a autorizației: </label>
							<div class="col-sm-9">
								<input 	type="text" 
									class="form-control new new-data-exp-datepicker" 
									id="kik_angajat_autorizatie_end" 
									placeholder="Data expirării autorizației" 
									name="kik_angajat_autorizatie_end" />
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
					<button type="button" class="btn btn-primary" id="add-new-employee" action-type="add-ne">Salvează angajatul</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	

	<!-- EDIT EMPLOYEE -->
	<div id="edit-employee-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Editează anajat</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
					<button type="button" class="btn btn-primary" id="update-employee" action-type="update">Actualizează angajatul</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>