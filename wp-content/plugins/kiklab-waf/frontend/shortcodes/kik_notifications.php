<?php


#####------------------------------------
##### kik_notifications
#####------------------------------------


function kik_notifications_FUNC($atts, $content = null) {

	ob_start();
	
	$kik_alerts = get_option('kik_alerts') ? CountObjectDeepestChildren(get_option('kik_alerts')['by_id']) : 0;
	$kik_notifications = get_option('kik_notifications') ? CountObjectDeepestChildren(get_option('kik_notifications')['by_id']) : 0;
	$kik_alerts_bills = get_option('kik_alerts_bills') ? CountObjectDeepestChildren(get_option('kik_alerts_bills')['by_id']) : 0;
	?>
	
	
	<div class="row">
		<div class="col-sm-12">
			<h2>Alerte și atenționări</h2>
		</div>
	</div>
	
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1" data-toggle="tab">Notificări</a></li>
		<li><a href="#tab-2" data-toggle="tab">Atenționări</a></li>
		<li><a href="#tab-3" data-toggle="tab">Facturi neîncasate</a></li>
	</ul>
	
	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">
			<?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/alerte_si_atentionari/alerte.php'); ?>
		</div>
		
		<div id="tab-2" class="tab-pane">
			<?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/alerte_si_atentionari/atentionari.php'); ?>
		</div>
		
		<div id="tab-3" class="tab-pane">
			<?php include(KIK_PLUGIN_ABSPATH . 'frontend/parts/alerte_si_atentionari/facturi_neincasate.php'); ?>
		</div>
	</div> <?php

	return ob_get_clean();
}
?>