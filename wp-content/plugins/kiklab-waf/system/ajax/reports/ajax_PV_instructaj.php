<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_PV_instructaj', 'KIK_ACTION_PV_instructaj_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_PV_instructaj', 'KIK_ACTION_PV_instructaj_FUNC');
function KIK_ACTION_PV_instructaj_FUNC() {
	
	global $wpdb;
	
	$kik_firma = get_post($_POST['kik_report_pv_instructaj_firma'])->post_title;
	$kik_departament = get_post($_POST['kik_report_pv_instructaj_departament'])->post_title;
	$kik_data = explode('-', $_POST['kik_report_pv_instructaj_data']);
	$kik_nr = $_POST['kik_report_pv_instructaj_nr'];
	$kik_inspector = $_POST['kik_report_pv_instructaj_reprezentant_ssm'];
	$kik_reprezentant = $_POST['kik_report_pv_instructaj_reprezentant_firma'];
	$kik_angajati = $_POST['kik_report_pv_instructaj_angajati'];
	$kik_material = $_POST['kik_report_pv_instructaj_material'];
	
	?>
		
		<p><b>SC WORK PROTECTION BUSINESS SRL</b></p>
		<p></p>
		<p></p>
		<p class="align-center"><b>PROCES VERBAL DE INSTRUIRE</b></p>
		<p class="align-center"><b>privind securitatea și sănătatea în muncă / situații de urgență</b></p>
		<p class="align-center"><b>Nr. <span class="report_field">&emsp;<?php echo $kik_nr; ?>&emsp;</span> / <span class="report_field">&emsp;<?php echo implode('.', array_reverse($kik_data)); ?>&emsp;</span></b></p>
		<p></p>
		<p></p>
		<p>&emsp;&emsp;&emsp;&emsp;Subsemnatul <span class="report_field">&emsp;<?php echo $kik_inspector; ?>&emsp;</span>, reprezentant al Serviciului Extern de Prevenire si Protectie, am predat domnului/doamnei
		<span class="report_field">&emsp;<?php echo $kik_reprezentant; ?>&emsp;</span>, in calitate de conducator al locului de munca, materialul pentru instructajul periodic privind SSM/SU, al salariatilor din cadrul departamentului/sectia/filiala
		<span class="report_field">&emsp;<?php echo $kik_departament; ?>&emsp;</span></p>.
		<p></p>
		<p></p>
		<p>&emsp;&emsp;&emsp;&emsp;In cadrul instruirii s-a prelucrat urmatorul material specific: </p>
		<p></p>
		<div class="report_box"><?php echo $kik_material; ?></div>
		<p></p>
		<p></p>
		<p><div style="width:50%; float:left; text-align:center;">Reprez. SEPP:</div><div style="width:50%; float:right; text-align:center;">Conducator loc de munca</div></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<p></p>
		<?php if ($kik_angajati) { ?>
		<p>&emsp;&emsp;&emsp;&emsp;Urmatorii cursanti au participat si si-au insusit materialele prezentate:</p>
		<p></p>
		<p></p>
		<table class="report_list">
			<thead>
				<tr>
					<th>#</th>
					<th>Angajat</th>
					<th>Functia</th>
					<th>Semnatura</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 0;
					$angajati = get_post_meta($_POST['kik_report_pv_instructaj_firma'], 'kik_company_angajati', true);
					if ($angajati) foreach ($angajati as $angajat) {
						$i++;
						echo '
							<tr>
								<td>' . $i . '</td>
								<td>' . $angajat['prenume'] . ' ' . $angajat['nume'] . '</td>
								<td>' . $angajat['functie'] . '</td>
								<td>&nbsp;</td>
							</tr>
						';
					}
				?>
			</tbody>
		</table>
		<?php } ?>
		
	<?php
	
	//echo ' {--DONE--} ';
	
	wp_die();
}










/**/

?>