

	<!-- @param kik_echipamente_size frontend\post_body.php -->

	<div class="row no-margin">
		<div class="col-sm-12">
			<h3 class="tab-title"><i>Echipamente (<?php echo $kik_echipamente_size;  ?>)</i></h3>
		</div>
	</div>						
		
	<table class="table table-bordered table-hover" id='echipamente-table' style="width: 100%";>
		<thead class='thead-dark'>
			<tr>
				<th>Echipament</th>
				<th>Bucăți</th>
				<th>Data de expirare</th>
				<th>ISCIR</th>
				<th>Data de expirare ISCIR</th>
				<th>Acțiuni</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>				

	<!-- MODALS -->
	<div id="new-echipament-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Adaugă echipament</h4>
				</div>
				<div class="modal-body">
					<!-- FORM ECHIPAMENTE -->
					<div class="row">
						<!-- FIELD: DENUMIRE ECHIPAMENT -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_echipament">Denumire echipament: </label>
							<div class="col-sm-9"><?php
								wp_dropdown_categories(array(
									'orderby'            => 'NAME', 
									'hide_empty'         => 0,
									'name'               => 'kik_echipament',
									'id'                 => 'kik_echipament',
									'class'              => 'form-control',
									'taxonomy'           => 'kik_echipamente',
								)); ?>
							</div>
						</div>
						<!-- FIELD: NR. BUCATI -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_echipament_bucati">Bucăți: </label>
							<div class="col-sm-9">
								<input 	type="number" 
											class="form-control" 
											id="kik_echipament_bucati" 
											name="kik_echipament_bucati" 
											data-autohint="true" 
											title="Număr bucăți" />
							</div>
						</div>
						<!-- FIELD: DATA EXPIRARE ECHIPAMENT -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_echipament_data_exp">Data expirării: </label>
							<div class="col-sm-9">
								<input 	type="text" 
											class="form-control new new-data-exp-datepicker" 
											id="kik_echipament_data_exp" 
											placeholder="Data expirării" 
											name="kik_echipament_data_exp" />
							</div>
						</div>
						<!-- FIELD: ISCIR -->
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_echipament_iscir">ISCIR: </label>
							<div class="col-sm-9">
								<div class="checkbox">
									<label class='checkbox-label'>
										<input 	type="checkbox"
													id="kik_echipament_iscir" 
													name="kik_echipament_iscir" />
										<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
									</label>
								</div>
							</div>
						</div>
						<!-- FIELD: DATA EXPIRARE ISCIR -->
						<div class="form-group no-margin" style="display: none;">
							<label class="control-label col-sm-3" for="kik_echipament_iscir_exp">Data expirării: </label>
							<div class="col-sm-9">
								<input 	type="text" 
											class="form-control new new-exp-iscir-datepicker" 
											id="kik_echipament_iscir_exp" 
											placeholder="Data expirării ISCIR" 
											name="kik_echipament_iscir_exp" />
							</div>
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
					<button type="button" class="btn btn-primary" id="add-new-equipment">Salvează echipamentul</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	
