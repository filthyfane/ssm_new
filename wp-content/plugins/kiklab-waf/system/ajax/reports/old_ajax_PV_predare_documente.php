<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_PV_predare_documente', 'KIK_ACTION_PV_predare_documente_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_PV_predare_documente', 'KIK_ACTION_PV_predare_documente_FUNC');
function KIK_ACTION_PV_predare_documente_FUNC() {
	
	global $wpdb;
	
	//echo DrawObject($_POST);
	
	$kik_company_name = get_post($_POST['kik_report_pv_predare_documente_firma'])->post_title;
	$kik_company_data = explode('-', $_POST['kik_report_pv_predare_documente_data']);
		
	?>
	
		<table cellspacing='0' cellpadding='0' style='width: 700px;'>
			<tr>
				<td colspan='3' height="50"></td>
			</tr>
			<tr align='center'>
				<td colspan="3" width='650'>
					<b>PROCES VERBAL DE PREDARE-PRIMIRE</b>
				</td>
			</tr>
			<tr>
				<td colspan="3" align="center">
					<b>din <span class="report_field">&emsp;<?php echo implode('.', array_reverse($kik_company_data)); ?>&emsp;</span></b>
				</td>
			</tr>
			<tr>
				<td colspan="3" height="30"></td>
			</tr>
			<tr>
				<td colspan="3">
					<span style="color: white">____________</span>Subsemnatul <span class="report_field">&emsp;<?php echo $_POST['kik_report_pv_predare_documente_reprezentant_ssm']; ?>&emsp;</span>, reprezentant al SC Work Protection Business SRL, am 
					predat domnului/doamnei <span class="report_field">&emsp;<?php echo $_POST['kik_report_pv_predare_documente_reprezentant_firma']; ?>&emsp;</span>, reprezentant al 
					<span class="report_field">&emsp;<?php echo $kik_company_name; ?>&emsp;</span>, urmatoarele documente:
				</td>
			</tr>
			<tr>
				<td colspan="3" height="20"></td>
			</tr>
			
			<tr>
				<td width="20"></td>
				<td colspan="2" width="630"><?php
					foreach (get_terms('kik_documente_predate', array('hide_empty' => false)) as $term) {
						echo '<p><input type="checkbox" data-document="'.$term->name.'"> ' . $term->name . '</p>';
					} ?>
				</td>
			</tr>
			
			<tr><td height="70" colspan="3"></td></tr>
			
			<tr>
				<td width="20"> </td>
				<td width="315">Am predat,</td>
				<td width="315">Am primit,</td>
			</tr>
			
			<tr>
				<td colspan="3" height="20"></td>
			</tr>
			
			<tr>
				<td width="20"></td>
				<td width="315">__________________</td>
				<td width="315">__________________</td>
			</tr>
			
		</table>

	<?php
	
	wp_die();
}










/**/

?>