	<?php 	

	// ========================================-->
	// ISTORIC FACTURI -->
	// ======================================== -->
	
    
    
	if($post_slug != 'firma-noua'){ ?>
		<div class="row no-margin">
			<div class="col-sm-12">
				<h3 class="tab-title"><i>Istoric facturi (<?php echo $kik_bills_size; ?>)</i></h3>
			</div>
		</div>	
		
		<!-- TABEL FACTURI -->
			<table class="table table-bordered table-hover" id='billing-table' style="width: 100%">
				<thead class="thead-dark">
					<tr>
						<th>Nr. factură</th>
						<th>Data facturii</th>
						<th>Data scadenței</th>
						<th>Valoare</th>
						<th>Rest de plată</th>
						<th>Plăți parțiale</th>
						<th>Depășit?</th>
						<th>Acțiuni</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			
		<!-- MODALS -->
		
		<!-- ============== MODAL ADAUGA FACTURA ================= -->
		<div id="new-bill-modal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Adaugă o factură nouă</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="form-group no-margin">
								<label class="control-label col-sm-3" for="kik_new_bill_number">Numărul facturii: </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="kik_new_bill_number" placeholder="Numărul facturii" name="kik_new_bill_number"/>
								</div>
							</div>
							<div class="form-group no-margin">
								<label class="control-label col-sm-3" for="kik_new_bill_date">Data facturii: </label>
								<div class="col-sm-9">
									<input type="text" class="form-control new new-bill-datepicker" id="kik_new_bill_date" placeholder="Data facturii" name="kik_new_bill_date"/>
								</div>
							</div>
							<div class="form-group no-margin">
								<label class="control-label col-sm-3" for="kik_new_bill_amount">Valoarea facturii: </label>
								<div class="col-sm-9">
									<input type="text" 
										   class="form-control" 
										   id="kik_new_bill_amount" 
										   placeholder="Suma" 
										   name="kik_new_bill_amount"/>
								</div>
							</div>
							<!-- PERIOADA DE FACTURARE -->	
							<div class="form-group  no-margin">
								<label class="control-label col-sm-3" for="kik_new_bill_deadline">Termen de plată: </label>
								<div class="col-sm-9">
									<input 	type="text" 
											class="form-control" 
											id="kik_new_bill_deadline" 
											name="kik_new_bill_deadline"
											placeholder="Termen de plată (zile)" />
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
						<button type="button" class="btn btn-primary" id="add-new-bill">Salvează factura</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
			
			
		<!-- ============== MODAL ADAUGA PLATA PARTIALA ================= -->
		<div id="new-partial-payment" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Adaugă plată parțială</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<!-- DATA PLATII PARTIALE -->
							<div class="form-group no-margin">
								<label class="control-label col-sm-3" for="kik_data_factura_partiala">Data plății: </label>
								<div class="col-sm-9">
									<input type="text" 
										class="form-control new-plata-partiala-datepicker" 
										id="kik_data_factura_partiala" 
										placeholder="Data plății parțiale" 
										name="kik_data_factura_partiala"/>
								</div>
							</div>
							
							<!-- SUMA -->
							<div class="form-group no-margin">
								<label class="control-label col-sm-3" for="kik_suma_plata_partiala">Suma plății parțiale: </label>
								<div class="col-sm-9">
									<input 	type="text" class="form-control" 
												id="kik_suma_plata_partiala" 
												placeholder="Suma plată parțială" 
												name="kik_suma_plata_partiala"/>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
						<button type="button" class="btn btn-primary" id="add-new-partial-payment">Salvează plata parțială</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal --> <?php
	} ?>