<?php


#####------------------------------------
##### kik_reports
#####------------------------------------

function kik_reports_FUNC($atts, $content = null) 
{ 
	ob_start(); ?>
	<div class="row">
		<div class="col-sm-12">
			<h2>Rapoarte</h2>
			<hr>
		</div>
	</div>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="#tab-11" data-toggle="tab">Toate rapoartele</a></li>
					<li><a href="#tab-1" data-toggle="tab">PV predare documente</a></li>
					<li><a href="#tab-2" data-toggle="tab">PV instructaj</a></li>
					<li><a href="#tab-3" data-toggle="tab">Raport semestrial de activitate</a></li>
					<li><a href="#tab-4" data-toggle="tab">Instructaj</a></li>
					<li><a href="#tab-5" data-toggle="tab">Echipamente</a></li>
					<li><a href="#tab-6" data-toggle="tab">Debite neîncasate</a></li>
					<li><a href="#tab-7" data-toggle="tab">Facturi</a></li>
					<li><a href="#tab-8" data-toggle="tab">Accidente</a></li>
					<li><a href="#tab-9" data-toggle="tab">Activități nerealizate</a></li>
					<li class="active"><a href="#tab-10" data-toggle="tab">Angajați noi</a></li>
				</ul>
			</div>
			<div class="col-md-10">
				<div class="tab-content">
					<div id="tab-11" class="tab-pane"><?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/rapoarte/toate_rapoartele.php'); ?></div>
					<div id="tab-1" class="tab-pane"><?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/rapoarte/pv_predare_documente.php'); ?></div>
					<div id="tab-2" class="tab-pane"><?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/rapoarte/pv_instructaj.php'); ?></div>
					<div id="tab-3" class="tab-pane"><?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/rapoarte/raport_semestrial_de_activitate.php'); ?></div>
					<div id="tab-4" class="tab-pane"><?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/rapoarte/instructaj.php'); ?></div>
					<div id="tab-5" class="tab-pane"><?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/rapoarte/echipamente.php'); ?></div>
					<div id="tab-6" class="tab-pane"><?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/rapoarte/debite_neincasate.php'); ?></div>
					<div id="tab-7" class="tab-pane"><?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/rapoarte/facturi.php'); ?></div>
					<div id="tab-8" class="tab-pane"><?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/rapoarte/accidente.php'); ?></div>
					<div id="tab-9" class="tab-pane"><?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/rapoarte/activitati_nerealizate.php'); ?></div>
					<div id="tab-10" class="tab-pane active"><?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/rapoarte/angajati_noi.php'); ?></div>
				</div>
			</div>
		</div>
	</div>
	<div id="kik_company_tabs">
		<div id="kik_company_tabs_overlay"></div>
	</div>
	<div class="kik_company_fields_footer"></div><?php

	return ob_get_clean();
}

?>