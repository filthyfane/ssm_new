<?php


#####------------------------------------
##### POST BODY
#####------------------------------------

include(KIK_PLUGIN_ABSPATH . 'frontend/post_get_data.php');

global $post;

$kik_employees_size   = sizeof($kik_employees);
$kik_echipamente_size = sizeof($kik_equipments);
$kik_bills_size 	  = sizeof($kik_bills);
$kik_files_size 	  = sizeof($kik_files);
?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1" data-toggle="tab">Date societate</a></li>
		<li><a href="#tab-2" data-toggle="tab">Facturare (<?php echo $kik_bills_size; ?>)</a></li>
		<li><a href="#tab-3" data-toggle="tab">Instructaje realizate (<?php echo $kik_instructaje_size; ?>)</a></li>
		<li><a href="#tab-4" data-toggle="tab">CSSM (<?php echo $kik_cssm_size; ?>)</a></li>
		<li><a href="#tab-5" data-toggle="tab">Documente predate (<?php echo count(wp_get_post_terms($kik_ID, 'kik_documente_predate')); ?>)</a></li>
		<li><a href="#tab-6" data-toggle="tab">Echipamente (<?php echo $kik_echipamente_size; ?>)</a></li>
		<li><a href="#tab-7" data-toggle="tab">Angajați (<span class="count-posts"><?php echo $kik_employees_size; ?></span>)</a></li>
		<li><a href="#tab-8" data-toggle="tab">Dosar cercetare accident (<?php echo $kik_files_size; ?>)</a></li>
		<li><a href="#tab-9" data-toggle="tab">Rapoarte</a></li>
	</ul>
		
	<div class="tab-content">
		
		<!-- Date societate -->
		<div id="tab-1" class="tab-pane active">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_date_societate.php'); ?>
		</div>
		
		<!-- Facturare -->
		<div id="tab-2" class="tab-pane">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_facturare.php'); ?>
		</div>
		
		<!-- Periodicitate instructaj -->
		<div id="tab-3" class="tab-pane">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_periodicitate_instructaj.php'); ?>
		</div>
		
		<!-- CSSM -->
		<div id="tab-4" class="tab-pane">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_cssm.php'); ?>
		</div>
		
		<!-- Documente predate -->
		<div id="tab-5" class="tab-pane">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_documente_predate.php'); ?>
		</div>
		
		<!-- Echipamente -->
		<div id="tab-6" class="tab-pane">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_echipamente.php'); ?>
		</div>
		
		<!-- Angajati -->
		<div id="tab-7" class="tab-pane">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_angajati.php'); ?>
		</div>
		
		<!-- Dosar cercetare accident -->
		<div id="tab-8" class="tab-pane">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_dosar_cercetare_accident.php'); ?>
		</div>
		
		<!-- Rapoarte -->
		<div id="tab-9" class="tab-pane">
			<?php include(KIK_PLUGIN_ABSPATH . 'backend/post_edit_rapoarte.php'); ?>
		</div>
			
		<!-- OVERLAY -->
		<div id="kik_company_tabs_overlay"></div>
		
	</div>
	<input type="hidden" id="company-nonce" value="<?php echo wp_create_nonce('save-company-data'); ?>" />
	
	<div class="kik_company_fields_footer"></div>
	
	<div class="kik_save_area">
		<a class="btn btn-primary kik_save_btn edit" href="javascript:;">
			<i class="fa fa-fw fa-save"></i> 
			Salvează firma
		</a> 
		<a class="btn btn-danger delete-company" data-toggle='modal' data-target='#confirm-delete-company-modal' delete-link="<?php echo get_delete_post_link($kik_ID, '', true); ?>" href="javascript:;">
			<i class="fa fa-close"></i> 
			Șterge firma
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
	</div>
	
	<!-- GENERAL MODAL FOR CONFIRMING DELETING RECORDS -->
	<div id="confirm-delete-company-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="row no-margin">
						<div class="col-sm-12 text-center">
							<h3>Sunteți sigur că doriți să ștergeți această companie?</h3>
							<p style="color:red">Atenție! Operațiunea nu va putea fi reversată!</p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a type="button" class="btn btn-default" href="javascript:;" data-dismiss="modal">Anulează</a>
					<a type="button" class="btn btn-danger" href="javascript:;" id="btn-delete-company">Șterge</a>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	