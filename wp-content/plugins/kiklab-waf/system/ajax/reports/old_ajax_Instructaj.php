<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_Instructaj', 'KIK_ACTION_Instructaj_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Instructaj', 'KIK_ACTION_Instructaj_FUNC');
function KIK_ACTION_Instructaj_FUNC() {
	
	global $wpdb;
	
	//echo DrawObject($_POST);
	
	$kik_company_data_inceput = $_POST['kik_report_instructaj_data_inceput'];
	$kik_company_data_sfarsit = $_POST['kik_report_instructaj_data_sfarsit'];
	$kik_company_inspector = $_POST['kik_report_instructaj_inspector'];
	
	?>
		
		<p class="align-center"><b>Firme care au instructaj in perioada <span class="report_field">&emsp;<?php echo implode('.', array_reverse(explode('-', $kik_company_data_inceput))); ?>&emsp;</span> - <span class="report_field">&emsp;<?php echo implode('.', array_reverse(explode('-', $kik_company_data_sfarsit))); ?>&emsp;</span></b></p>
		<p></p>
		<p></p>
		<table class="report_list">
			<thead>
				<tr>
					<th>#</th>
					<th>Firma</th>
					<th>Data instructaj</th>
					<th>Inspector SSM</th>
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
				
				# get the years of service
				$years = get_post_meta($post->ID, 'kik_company_service_frequency_history', true);
				//echo DrawObject($years);
				
				if ($years) foreach ($years as $year => $months) {
					//echo '[[' . $year . ']]== ' . DrawObject($months);
					
					$j = 0;
					if ($months) foreach ($months as $j => $vals) {
						if ($vals['day']) {
							$formatted_date = $year . '-' . sprintf("%02d", $j) . '-' . sprintf("%02d", $vals['day']);
							//echo $post->post_title . ' === ' . $formatted_date . ' [' . $vals['bool_serv'] . ']<br />';
							if (!($kik_company_inspector && get_post_meta($post->ID, 'kik_company_inspector', true) != $kik_company_inspector) && $_POST['kik_report_instructaj_data_inceput'] <= $formatted_date && $formatted_date <= $_POST['kik_report_instructaj_data_sfarsit']) {
								$i++;
								echo '
									<tr>
										<td>' . $i . '</td>
										<td>' . $post->post_title . '</td>
										<td>' . $formatted_date . '</td>
										<td>' . get_userdata(get_post_meta($post->ID, 'kik_company_inspector', true))->display_name . '</td>
									</tr>
								';
							}
						}
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