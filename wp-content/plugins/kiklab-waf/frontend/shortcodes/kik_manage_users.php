<?php


#####------------------------------------
##### kik_manage_users
#####------------------------------------

function kik_manage_users_FUNC($atts, $content = null) 
{
	global $wp_roles;
	ob_start(); ?>
	<form name="kik_terms" action="" method="post">
		<div class="row">
			<div class="col-sm-12">
				<h2>Administrare utilizatori</h2>
				<hr>
			</div>
		</div>
		
		<!-- TABLE USERS -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-hover" id='kik_users' style="width: 100%";>
						<thead class='thead-dark'>
							<tr>
								<th>Nume</th>
								<th>Utilizator</th>
								<th>Email</th>
								<th>Roluri</th>
								<th>Acțiuni</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>	
				</div>
			</div>
		</div>
		<div class="kik_company_fields_footer"></div>	
	</form>

	<!-- Modal for editing categories terms -->
	<div id="edit-user-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-horizontal">
						<div class="row no-margin">
							<div class="col-sm-12 text-center">
								<h3>Editare utilizator:</br></br></h3>
							</div>
						</div>
						<!-- Formular editare utilizator -->
						<div class="form-group user-details">
							<label class="control-label col-sm-2" for="kik_user_login">Utilizator: </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="kik_user_login" placeholder="Nume utilizator" value="">
							</div>
						</div>
						<div class="form-group user-details">
							<label class="control-label col-sm-2" for="kik_user_last_name">Nume: </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="kik_user_last_name" placeholder="Prenume utilizator" value="">
							</div>
						</div>
						<div class="form-group user-details">
							<label class="control-label col-sm-2" for="kik_user_first_name">Prenume: </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="kik_user_first_name" placeholder="Nume utilizator" value="">
							</div>
						</div>
						<div class="form-group user-details">
							<label class="control-label col-sm-2" for="kik_user_mail">Email: </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="kik_user_mail" placeholder="Email" value="">
							</div>
						</div>
						<div class="form-group user-details">
							<label class="control-label col-sm-2">Drepturi: </label>
							<div class="col-sm-10"><?php 
								foreach($wp_roles->roles as $role => $roleDetails){?>
									<div class="col-sm-5 col-md-4">
										<input type="checkbox" 
											name="kik_roles[]" 
											id="<?php echo $role;?>"
											value="<?php echo $role;?>"> 
											<label for="<?php echo $role;?>"><?php echo $roleDetails['name'];?></label>
									</div><?php
								}?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Anulează</button>
					<button type="button" class="btn btn-success" id="btn-save-record">Salvează</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->		

	<!-- Modal for deleting user -->	
	<div id="confirm-delete-user-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="row no-margin">
						<div class="col-sm-12 text-center">
							<h3>Sunteți sigur că doriți să ștergeți acest utilizator?</h3>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Anulează</button>
					<button type="button" class="btn btn-success" id="btn-delete-user">Șterge</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->		

	<!-- MODAL FOR ADDING COMPANIES TO USER -->
	<div id="add-company-user-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="row no-margin">
						<div class="col-sm-12 text-center">
							<h3>Asociază companii și utilizatori</h3>
						</div>
					</div>
					<div class="row no-margin multiselect-companies"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Anulează</button>
					<button type="button" class="btn btn-success" id="btn-company-user">Salvează</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal --><?php

	return ob_get_clean();
}
?>