<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_Raport_semestrial_de_activitate', 'KIK_ACTION_Raport_semestrial_de_activitate_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Raport_semestrial_de_activitate', 'KIK_ACTION_Raport_semestrial_de_activitate_FUNC');
function KIK_ACTION_Raport_semestrial_de_activitate_FUNC() {
	
	global $wpdb;
	
	$kik_company_data_inceput = explode('-', $_POST['kik_report_raport_semestrial_data_inceput']);
	$kik_company_data_sfarsit = explode('-', $_POST['kik_report_raport_semestrial_data_sfarsit']);
	
	?>
		
		<p>Denumirea: <b>SC WORK PROTECTION BUSINESS SRL</b></p>
		<p>Sediu: Bucuresti, Aleea Arinis Nr. 1, Bl. OD1, Ap. 90, Sector 1</p>
		<p>Cod Postal: 062031, Tel: 0745134989</p>
		<p>Cod unic de inregistrare: 26783100</p>
		<p>Numar de inregistrare in Registrul Comertului: J40/3943/2010</p>
		<p>Adeverinta de abilitare nr.: 0089/PS/30.09.2010</p>
		<p></p>
		<p></p>
		<p class="align-center"><b>RAPORT DE ACTIVITATE SEMESTRIAL</b></p>
		<p class="align-center"><b>de la <span class="report_field">&emsp;<?php echo implode('.', array_reverse($kik_company_data_inceput)); ?>&emsp;</span> pana la <span class="report_field">&emsp;<?php echo implode('.', array_reverse($kik_company_data_sfarsit)); ?>&emsp;</span></b></p>
		<p></p>
		<p></p>
		<table class="report_body">
			<tbody>
				<tr>
					<th rowspan="3">Nr. Crt.</th>
					<th rowspan="3">Activitate desfasurata</th>
					<th rowspan="3">Beneficiar</th>
					<th colspan="11">Date referitoare la beneficiar</th>
					<th colspan="2">Date referitoare la furnizor</th>
					<th rowspan="3">Informatii referitoare la controale ale inspectorilor de munca</th>
					<th rowspan="3">Observatii</th>
				</tr>
				<tr>
					<th rowspan="2">A</th>
					<th rowspan="2">B</th>
					<th rowspan="2">C</th>
					<th colspan="2">Daca s-au inregistrat evenimente</th>
					<th colspan="6">Tipul evenimentelor</th>
					<th rowspan="2">Persoana care a efectuat activitatea</th>
					<th rowspan="2">Timp alocat</th>
				</tr>
				<tr>
					<th>DA</th>
					<th>NU</th>
					<th>Accidente usoare</th>
					<th>Accidente de munca</th>
					<th>Accidente de traseu sau de circulatie</th>
					<th>Incidente periculoase</th>
					<th>Imbolnaviri personale</th>
					<th>Cauza evenimentului</th>
				</tr>
				<tr>
					<th>0</th>
					<th>1</th>
					<th>2</th>
					<th>3</th>
					<th>4</th>
					<th>5</th>
					<th>6</th>
					<th>7</th>
					<th>8</th>
					<th>9</th>
					<th>10</th>
					<th>11</th>
					<th>12</th>
					<th>13</th>
					<th>14</th>
					<th>15</th>
					<th>16</th>
					<th>17</th>
				</tr>
				<?php
				$i = 0;
				$posts = get_posts(array(
					'posts_per_page' => -1,
					'post_type' => 'kik_company',
					'order'=> 'ASC',
					'orderby' => 'title',
				));
				foreach ($posts as $post) { 
					$i++;
					$cod_caen = (($try = wp_get_object_terms($post->ID, 'kik_cod_caen')) ? $try[0] : 0);
					$accidente = NULL;
					$has_term_1 = false;
					$has_term_2 = false;
					$has_term_3 = false;
					$has_term_4 = false;
					$has_term_5 = false;
					if ($accidente = get_post_meta($post->ID, 'kik_company_accidente', true)) foreach ($accidente as $accident) {
						if ($accident[tip] == get_term_by('name', 'Accidente usoare', 'kik_tipuri_evenimente')->term_id) $has_term_1 = true;
						if ($accident[tip] == get_term_by('name', 'Accidente de munca', 'kik_tipuri_evenimente')->term_id) $has_term_2 = true;
						if ($accident[tip] == get_term_by('name', 'Accidente de traseu sau de circulatie', 'kik_tipuri_evenimente')->term_id) $has_term_3 = true;
						if ($accident[tip] == get_term_by('name', 'Incidente periculoase', 'kik_tipuri_evenimente')->term_id) $has_term_4 = true;
						if ($accident[tip] == get_term_by('name', 'Imbolnaviri personale', 'kik_tipuri_evenimente')->term_id) $has_term_5 = true;
					}
					echo '
						<tr>
							<td>' . $i . '</td>
							<td class="align_left">Consultanta si instructaj de SSM,conform art.15,legea 319/2006<br /><textarea class="print_no_border" type="text" style="width:70px;"></textarea></td>
							<td>' . $post->post_title . '</td>
							<td>' . (($cod_caen) ? $cod_caen->name . ' - ' . $cod_caen->description : '-') . '</td>
							<td>' . get_post_meta($post->ID, 'kik_company_employees', true) . '</td>
							<td>' . get_post_meta($post->ID, 'kik_company_employees', true) . '</td>
							<td style="color:#ff0000;">' . (get_post_meta($post->ID, 'kik_company_accidente', true) ? 'X' : '') . '</td>
							<td>' . (get_post_meta($post->ID, 'kik_company_accidente', true) ? '' : 'X') . '</td>
							<td>' . ($has_term_1 ? 'X' : '') . '</td>
							<td>' . ($has_term_2 ? 'X' : '') . '</td>
							<td>' . ($has_term_3 ? 'X' : '') . '</td>
							<td>' . ($has_term_4 ? 'X' : '') . '</td>
							<td>' . ($has_term_5 ? 'X' : '') . '</td>
							<td><textarea class="print_no_border" type="text" style="width:40px;"></textarea></td>
							<td>' . get_userdata(get_post_meta($post->ID, 'kik_company_inspector', true))->display_name . '</td>
							<td><textarea class="print_no_border" type="text" style="width:40px;"></textarea></td>
							<td><textarea class="print_no_border" type="text" style="width:40px;"></textarea></td>
							<td><textarea class="print_no_border" type="text" style="width:40px;"></textarea></td>
						</tr>
					';
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