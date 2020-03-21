<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_Angajati_noi', 'KIK_ACTION_Angajati_noi_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Angajati_noi', 'KIK_ACTION_Angajati_noi_FUNC');
function KIK_ACTION_Angajati_noi_FUNC() {
	
	global $wpdb;
	
	//echo DrawObject($_POST);
	
	$kik_company_data_inceput = explode('-', $_POST['kik_report_angajati_noi_data_inceput']);
	$kik_company_data_sfarsit = explode('-', $_POST['kik_report_angajati_noi_data_sfarsit']);
	
	?>
		
		<p class="align-center"><b>Firme care au angajati noi in perioada <span class="report_field">&emsp;<?php echo implode('.', array_reverse($kik_company_data_inceput)); ?>&emsp;</span> - <span class="report_field">&emsp;<?php echo implode('.', array_reverse($kik_company_data_sfarsit)); ?>&emsp;</span></b></p>
		<p></p>
		<p></p>
		<table class="report_list">
			<thead>
				<tr>
					<th>#</th>
					<th>Firma</th>
					<th>Angajat</th>
					<th>Data</th>
					<th>Funcția</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			$posts = get_posts(array(
				'posts_per_page' => -1,
				'post_type' => 'kik_company',
			));
			foreach ($posts as $post) { 
				
				# compute wether to show the company
				$show = false;
				
				# get data
				$angajati = get_post_meta($post->ID, 'kik_company_angajati', true);
				
				if ($angajati) foreach ($angajati as $angajat) {
					//echo DrawObject($angajat);
					
					if ($angajat['contract_start'] && $_POST['kik_report_angajati_noi_data_inceput'] <= $angajat['contract_start'] && $angajat['contract_start'] <= $_POST['kik_report_angajati_noi_data_sfarsit']) {
						$i++;
						echo '
							<tr>
								<td>' . $i . '</td>
								<td>' . $post->post_title . '</td>
								<td>' . $angajat['prenume'] . ' ' . $angajat['nume'] . '</td>
								<td>' . $angajat['contract_start'] . '</td>
								<td>' . $angajat['functie'] . '</td>
							</tr>
						';
					}
					
				}
				
			}
			?>
			</tbody>
		</table>
		
	<?php
	
	//echo ' {--DONE--} ';
	
	wp_die();
}










/**/

?>