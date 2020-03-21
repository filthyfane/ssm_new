<?php


#####------------------------------------
##### kik_manage_categories
#####------------------------------------


function kik_manage_categories_FUNC($atts, $content = null) 
{
	ob_start();
	
	$current_user_id = wp_get_current_user()->ID;
	$current_user_roles = get_user_meta($current_user_id, 'kik_user_roles', true);
	
	if (($current_user_id == 14) || (is_array($current_user_roles) && in_array('Administrator', $current_user_roles))) { 
		$allTaxonomies = get_taxonomies(); 
		$kikTaxonomies = array();
		
		foreach($allTaxonomies as $taxonomy){
			if(substr($taxonomy, 0, 4) == "kik_"){
				$kikTaxonomies[] = $taxonomy;
			}
		} ?>
			
		<form name="kik_terms" action="" method="post">
			<div class="row">
				<div class="col-sm-12">
					<h2>Categorii de date</h2>
					<hr>
				</div>
			</div>
				
			<div class="kik_save_area">
				<a class="btn btn-primary save-categs" href="javascript:;">
					<i class="fa fa-fw fa-save kik_save_btn edit"></i> Salvează toate categoriile
				</a>
			</div>
			

			<!-- VERTICAL TABS -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2">
						<ul class="nav nav-pills nav-stacked"><?php 
							foreach($kikTaxonomies as $k => $taxonomy){
								$currTaxonomy = get_taxonomy($taxonomy); ?>
								<li class="<?php echo $k == 0 ? "active" : "" ?>">
									<a href="#tab-<?php echo $k; ?>" data-toggle="tab">
										<?php echo $currTaxonomy->labels->name; ?> (<?php echo wp_count_terms($taxonomy, array('hide_empty' => false)); ?>)
									</a>
								</li> <?php
							} ?>
						</ul>	
					</div>
					<div class="col-md-10">
						<div class="tab-content"><?php 
							//POPULATE EACH TAB CONTENT
							foreach ($kikTaxonomies as $tax_idx => $taxonomy_name) {
								$taxonomy = get_taxonomy($taxonomy_name); ?>
									
								<div 	id="tab-<?php echo $tax_idx; ?>"
										class="tab-pane <?php if ($taxonomy->name == 'kik_cod_caen') echo "active"; ?>">
									
									<div class="kik_company_fields_title"><?php echo $taxonomy->label; ?> (<?php echo wp_count_terms($taxonomy->name, array('hide_empty' => false)); ?>)</div>
									
									<table class="table table-bordered table-hover" id='<?php echo $taxonomy_name; ?>' style="width: 100%";>
										<thead class='thead-dark'>
											<tr>
												<th>Categorie</th>
												<th>Descriere</th>
												<th>Acțiuni</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>	
								</div><?php
							} ?>
								
							<!-- OVERLAY -->
							<div id="kik_company_tabs_overlay"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="kik_company_fields_footer"></div>
			<div class="kik_save_area">
				<a class="kik_save_btn edit" href="javascript:;">
					<i class="fa fa-fw fa-save"></i> 
					Salvează toate categoriile
				</a>
				<div class="kik_save_btn_response"></div>
			</div>		
		</form>
		
		<!-- Modal for editing categories terms -->
		<div id="edit-categ-modal" class="modal fade" tabindex="-1" role="dialog">
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
									<h3>Formular editare categorii:</br></br></h3>
								</div>
							</div>
							<!-- Formular editare categ term -->
							<div class="form-group">
								<label class="control-label col-sm-2" for="kik_term_categorie">Categorie: </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="kik_term_categorie" placeholder="Categorie" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="kik_term_descriere">Descriere: </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="kik_term_descriere" placeholder="Descriere" value="">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
						<button type="button" class="btn btn-success" id="btn-save-record">Salvează</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	
		
		<!-- Modal for adding new categories terms -->
		<div id="new-term-modal" class="modal fade" tabindex="-1" role="dialog">
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
									<h3 class="term-modal-title"></h3>
									</br>
								</div>
							</div>
							<!-- Formular adaugare categorie -->
							<div class="form-group">
								<label class="control-label col-sm-2" for="kik_term_category">Categorie: </label>
								<div class="col-sm-10">
									<input type="text" class="form-control kik_term_category" name="kik_term_category" placeholder="" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="kik_term_description">Descriere: </label>
								<div class="col-sm-10">
									<input type="text" class="form-control kik_term_description" name="kik_term_description" placeholder="" value="">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
						<button type="button" class="btn btn-success" id="btn-add-term">Salvează</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	
		<?php 
	}

	return ob_get_clean();
}
?>