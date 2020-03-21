<?php


#####------------------------------------
##### kik_import_data
#####------------------------------------


function kik_import_data_FUNC($atts, $content = null)
 {
	ob_start();
	// extract params
	$a = shortcode_atts(array(
	), $atts);
	// do stuff
	?>
			<div class="kik_company_title">
				<div class="kik_company_title_tag">Import de date</div>
			</div>
			<div id="kik_company_tab_titles">
				<a class="kik_company_tab_title_active" href="javascript:;">Facturi</a>
				<a class="kik_company_tab_title" href="javascript:;">Angajati</a>
			</div>
			<div id="kik_company_tabs">
				
				<!-- Date societate -->
				<div class="kik_company_tab" style="display:block;">
					<?php include(KIK_PLUGIN_ABSPATH . 'frontend/page_import_facturi.php'); ?>
				</div>
				
				<!-- Facturare -->
				<div class="kik_company_tab">
					<?php include(KIK_PLUGIN_ABSPATH . 'frontend/page_import_angajati.php'); ?>
				</div>
				
			</div>
			
	<?php

	return ob_get_clean();
}










/**/

?>