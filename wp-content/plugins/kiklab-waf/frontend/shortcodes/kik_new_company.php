<?php


#####------------------------------------
##### kik_new_company
#####------------------------------------


function kik_new_company_FUNC($atts, $content = null) {
	ob_start();
	$kik_ID = 0; ?>
	<div class="row">
		<div class="col-sm-12">
			<h2>Firmă nouă</h2>
			<a class="btn btn-primary kik-add-company" href="javascript:;">
				<i class="fa fa-fw fa-save"></i> 
				Adaugă firma
			</a>
			<hr>
		</div>
	</div>
	
	<form class="form-horizontal" name="kik_company" action="" method="post">	
		<input type="hidden" id="kik_company_id" name="kik_company_id" value="<?php echo $kik_ID; ?>" />
		<input type="hidden" id="kik_action" name="kik_action" value="add" />
		
		<!-- Date societate -->
		<div id="tab-1" class="tab-pane active">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_date_societate.php'); ?>
		</div>

		<!-- OVERLAY -->
		<div id="kik_company_tabs_overlay"></div>
		
		<div class="kik_company_fields_footer"></div>
		
		<div class="kik_save_area">
			<a class="btn btn-primary kik-add-company" href="javascript:;">
				<i class="fa fa-fw fa-save"></i> 
				Adaugă firma
			</a>
		</div>
	</form>
	
	<!-- WORKPOINT SKELETON -->
	<div class="form-group workpoint workpoint-skeleton">
		<label class="control-label col-sm-2" for=""></label>
		<div class="col-sm-9">
			<input type="text" 
				   class="form-control" 
				   id="kik_workpoint" 
				   placeholder="Adresă punct de lucru" 
				   name="kik_workpoints[]" 
				   placeholder="Adresă punct de lucru" value="" />
			
		</div>
		<div class="col-sm-1">
			<button id="b1" class="btn btn-danger remove-workpoint" type="button">Șterge</button>
		</div>
	</div>
		
	<!-- SKELETON INSTRUCTAJ -->
	<div class="form-group instructaj instructaj-skeleton">
		<label class="control-label col-sm-2" for="kik_company_service_frequency"> </label>
		<!--id="kik_company_title"-->
		<div class="col-sm-5"><?php
			$kik_walker = new KIK_WALKER();
			wp_dropdown_categories(array(
				'walker'             => $kik_walker,
				'orderby'            => 'NAME', 
				'hide_empty'         => 0, 
				'selected'           => '',
				'hierarchical'       => 1, 
				'name'               => 'kik_company_training_type[]',
				'id'                 => '',
				'class'              => 'form-control kik_company_training_type',
				'taxonomy'           => 'kik_tipuri_instructaj',
				'style'				=> '',
				'value_field'  => 'term_id')
			);?>
		</div>
		<div class="col-sm-5"><?php
			$kik_walker = new KIK_WALKER();
			wp_dropdown_categories(array(
				'walker'             => $kik_walker,
				'orderby'            => 'NAME', 
				'hide_empty'         => 0, 
				'selected'           => '',
				'hierarchical'       => 1, 
				'name'               => 'kik_company_service_frequency[]',
				'id'                 => '',
				'class'              => 'form-control kik_company_service_frequency',
				'taxonomy'           => 'kik_periodicitate_instructaj',
				'style'				=> '',
				'value_field'  => 'term_id')
			);?>
			<button id="b1" class="btn btn-danger remove-instructaj" type="button">-</button>
		</div>
	</div><?php 
	return ob_get_clean();
}
?>