<?php


#####------------------------------------
##### kik_notifications
#####------------------------------------


function kik_setari_companie_FUNC($atts = [], $content = null) 
{
	ob_start(); ?>	
	<input type="hidden" id="company-settings-nonce" value="<?php echo wp_create_nonce('save-company-settings'); ?>" />
	<div class="row">
		<div class="col-sm-12">
			<h2>Setări companie</h2>
			<hr>
		</div>
	</div>
	<form class="form-horizontal" name="kik_company" action="" method="post">
		<div class="row no-margin">
			<div class="form-group">
				<label class="control-label col-sm-2" for="kik_company_name">Numele companiei: </label>
				<div class="col-sm-10">
					<input type="text" 
						class="form-control" 
						id="kik_company_name" 
						placeholder="Nume companie" 
						name="kik_company_name"
						value="<?php echo get_option('kikCompanyName'); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="kik_registered_office">Adresă sediu social: </label>
				<div class="col-sm-10">
					<input type="text" 
						class="form-control" 
						id="kik_registered_office" 
						placeholder="Adresă sediu social" 
						name="kik_registered_office"
						value="<?php echo get_option('kikRegisteredOffice'); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="kik_phone">Telefon: </label>
				<div class="col-sm-10">
					<input type="text" 
						class="form-control" 
						id="kik_phone" 
						placeholder="Adresă sediu social" 
						name="kik_phone"
						value="<?php echo get_option('kikPhone'); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="kik_city">Oraș: </label>
				<div class="col-sm-10">
					<input type="text" 
						class="form-control" 
						id="kik_city" 
						placeholder="Oraș" 
						name="kik_city"
						value="<?php echo get_option('kikCity'); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="kik_county">Județ: </label>
				<div class="col-sm-10">
					<input type="text" 
						class="form-control" 
						id="kik_county" 
						placeholder="Județ" 
						name="kik_county"
						value="<?php echo get_option('kikCounty'); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="kik_postal_code">Cod poștal: </label>
				<div class="col-sm-10">
					<input type="text" 
						class="form-control" 
						id="kik_postal_code" 
						placeholder="Cod poștal" 
						name="kik_postal_code"
						value="<?php echo get_option('kikPostalCode'); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="kik_company_cui">CUI: </label>
				<div class="col-sm-10">
					<input type="text" 
						class="form-control" 
						id="kik_company_cui" 
						placeholder="Cod unic de înregistrare" 
						name="kik_company_cui"
						value="<?php echo get_option('kikCompanyCui'); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="kik_company_recom">Număr Registrul Comerțului: </label>
				<div class="col-sm-10">
					<input type="text" 
						class="form-control" 
						id="kik_company_recom" 
						placeholder="Număr RECOM" 
						name="kik_company_recom"
						value="<?php echo get_option('kikCompanyRecom'); ?>"/>
				</div>
			</div>
		</div>	
	</form>
	<div class="kik_save_area">
		<a class="btn btn-primary save-company-settings" href="javascript:;">
			Salvează
		</a>
	</div>
	<?php

	return ob_get_clean();
}
?>