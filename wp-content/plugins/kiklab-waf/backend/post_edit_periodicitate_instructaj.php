<?php 
	if($post_slug != 'firma-noua'){ ?>
		
		<div class="row no-margin">
			<div class="col-sm-12">
				<h3 class="tab-title"><i>Instructaje realizate (<?php echo $kik_instructaje_size; ?>)</i></h3>
			</div>
		</div>			
		
		<!-- TABLE INSTRUCTAJE -->
		<table class="table table-bordered table-hover" id='instructaje-table' style="width: 100%">
				<thead class="thead-dark">
					<tr>
						<th>Tip instructaj</th>
						<th>Data programării</th>
						<th>Data realizării</th>
						<!--<th>Instructaj realizat</th>-->
						<th>Acțiuni</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
		</table>
			
		
		<!-- ============== MODAL ADAUGA INSTRUCTAJ ================= -->
		<div id="new-instructaj-modal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Adaugă un nou instructaj</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<!-- TIPUL INSTRUCTAJULUI -->
							<div class="form-group no-margin">
								<label class="control-label col-sm-3" for="kik_new_type_instructaj">Tipul instructajului: </label>
								<div class="col-sm-9">
									<?php echo KIK_DROPDOWN_TERMS(
										'kik_new_type_instructaj',
										'kik_new_type_instructaj',
										'kik_tipuri_instructaj');
									?>
								</div>
							</div>
							<!-- DATA INSTRUCTAJULUI -->
							<div class="form-group no-margin">
								<label class="control-label col-sm-3" for="kik_new_instructaj_date">Data instructajului: </label>
								<div class="col-sm-9">
									<input type="text" class="form-control new new-instructaj-datepicker" 
										id="kik_new_instructaj_date" 
										placeholder="Data instructajului" 
										name="kik_new_instructaj_date"/>
								</div>
							</div>
							<!-- DATA REALIZARII INSTRUCTAJULUI -->
							<div class="form-group no-margin">
								<label class="control-label col-sm-3" for="kik_instructaj_fulfill_date">Data realizării: </label>
								<div class="col-sm-9">
									<input type="text" class="form-control new fulfill-instructaj-datepicker" 
										id="kik_instructaj_fulfill_date" 
										placeholder="Data realizării instructajului" 
										name="kik_instructaj_fulfill_date"/>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
						<button type="button" class="btn btn-primary" id="add-new-instructaj" action-type="add-new">Salvează instructajul</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		
		
		
		<!-- ============================= EDIT INSTRUCTAJ ============================================ -->
		<div id="edit-instructaj-modal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Editează instructaj</h4>
					</div>
					<div class="modal-body">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
						<button type="button" class="btn btn-primary" id="update-instructaj" action-type="update">Actualizează instructajul</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		
		<?php 
	}?>