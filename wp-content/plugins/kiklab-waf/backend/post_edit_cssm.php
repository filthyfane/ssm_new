
	<div class="row no-margin">
		<div class="col-sm-12">
			<h3 class="tab-title"><i>CSSM (<?php echo $kik_cssm_size;  ?>)</i></h3>
		</div>
	</div>		

	
	<!-- TABEL CSSM -->
	<table class="table table-bordered table-hover" id='cssm-table' style="width: 100%";>
		<thead class='thead-dark'>
			<tr>
				<th>Data ședință CSSM</th>
				<th>Data realizării</th>
				<th>Acțiuni</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	
	<!-- MODAL ADD NEW CSSM -->
	<div id="new-cssm-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Adaugă ședință CSSM</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_new_cssm_date">Data ședinței: </label>
							<div class="col-sm-9">
								<input type="text" 
									class="form-control new new-cssm-datepicker" 
									id="kik_new_cssm_date" 
									placeholder="Data ședinței" 
									name="kik_new_cssm_date"/>
							</div>
						</div>
						<div class="form-group no-margin">
							<label class="control-label col-sm-3" for="kik_cssm_fulfill_date">Data ședinței: </label>
							<div class="col-sm-9">
								<input type="text" 
									class="form-control new fulfill-cssm-datepicker" 
									id="kik_cssm_fulfill_date" 
									placeholder="Data realizării" 
									name="kik_cssm_fulfill_date"/>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
					<button type="button" class="btn btn-primary" id="add-new-cssm" action-type="add-new">Salvează ședința</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	

	<!-- ============================= EDIT SEDINTA CSSM======================================== -->
	<div id="edit-cssm-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Editează ședință CSSM</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
					<button type="button" class="btn btn-primary" id="update-cssm" action-type="update">Actualizează ședința CSSM</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>