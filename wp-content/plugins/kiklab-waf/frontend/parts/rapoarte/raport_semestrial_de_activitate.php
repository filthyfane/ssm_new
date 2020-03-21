					
	<div class="row">
		<div class="col-sm-12">
			<h3 class="tab-title no-margin-top reports-title"><i>Raport semestrial de activitate</i></h3>
		</div>
	</div>
	
	<form name="kik_report_raport_semestrial" action="" method="post" data-report-type="Raport-semestrial" data-file-name="Raport_semestrial">	
		<input type="hidden" id="curr-post-id" value="<?php echo get_the_ID(); ?>" />
		<table class="table table-hover">
			<thead class="thead-dark">
				<tr>
					<th class="col-md-2"></th>
					<th class="col-md-10"></th>
				</tr>
			</thead>
			<tbody>
				<!-- DATA DE INCEPUT -->
				<tr>
					<td><label for="kik_rap_sem_start_date">Data de început:</label></td>
					<td>
						<div class="col-md-12">
							<input	type="text"
										class="form-control rap-sem-start-date-datepicker"
										id="kik_rap_sem_start_date"
										placeholder="Data de început"
										name="kik_rap_sem_start_date"/>
						</div>
					</td>
				</tr>
				<!-- DATA DE SFARSIT -->
				<tr>
					<td><label for="kik_rap_sem_end_date">Data de sfârșit:</label></td>
					<td>
						<div class="col-md-12">
							<input 	type="text"
										class="form-control rap-sem-end-date-datepicker"
										id="kik_rap_sem_end_date"
										placeholder="Data de sfârșit"
										name="kik_rap_sem_end_date"/>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	
		<div class="kik_save_area">
			<a class="btn btn-primary populate-report" href="javascript:;">
				<i class="fa fa-fw fa-save"></i> Generează
			</a>
			<a class="btn btn-primary save-pdf-report" style="float:right;" href="javascript:;">
				<i class="fa fa-fw fa-print"></i> Printează
			</a>
		</div>
	
		<div class="report_container">
			<div class="report_sheet landscape" data-report-type="Raport-semestrial" data-file-name="Raport_semestrial">
				<table cellspacing='0' cellpadding='0' style='width: 950px;'>
					<tr colspan="18">
						<td colspan='3' height="50"></td>
					</tr>
					<tr align="center">
						<td colspan="18"><b>RAPORT DE ACTIVITATE SEMESTRIAL</b></td>
					</tr>
					<tr align="center">
						<td colspan="18">
							<b>
								de la 
								<span class="report_field rap_sem_start_date">&emsp;&emsp;</span>
								până la
								<span class="report_field rap_sem_end_date">&emsp;&emsp;</span>
							</b>
						</td>
					</tr>
					<tr>
						<td colspan="18" height="50"></td>
					</tr>
				</table>
					
				<!-- DATA TABLE -->
				<table border="1" cellspacing='0' cellpadding='0' style='width: 950px;' class='rap-sem-table'>
					<!-- TABLE HEAD -->
					<thead>
						<tr align="center">
							<th rowspan="3" width="20" align="center" valign="middle" style="vertical-align: middle;">Nr. crt. </th>
							<th rowspan="3" width="80" align="center" valign="middle"> Activitate desfășurată </th>
							<th rowspan="3" width="70"align="center" valign="middle"> Beneficiar </th>
							<th colspan="11" width="510" align="center" valign="middle"> Date referitoare la beneficiar </th>
							<th colspan="2" width="120" align="center" valign="middle">Date referitoare la furnizor</th>
							<th rowspan="3" width="90" align="center" valign="middle">Informații referitoare la controale ale inspectorilor de muncă</th>
							<th rowspan="3" width="60" align="center" valign="middle">Observații</th>
						</tr>
						<tr align="center">
							<th rowspan="2" width="25" align="center" valign="middle">A</th>
							<th rowspan="2" width="10" align="center" valign="middle">B</th>
							<th rowspan="2" width="10" align="center" valign="middle">C</th>
							<th colspan="2" width="60" align="center" valign="middle">Dacă s-au înregistrat evenimente</th>
							<th colspan="6" width="405" align="center" valign="middle">Tipul evenimentelor</th>
							<th rowspan="2" width="60" align="center" valign="middle">Persoana care a efectuat activitatea</th>
							<th rowspan="2" width="60" align="center" valign="middle">Timp alocat</th>
						</tr>
						<tr align="center">
							<th width="30" align="center" valign="middle">DA</th>
							<th width="30" align="center" valign="middle">NU</th>
							<th width="65" align="center" valign="middle">Accidente ușoare</th>
							<th width="65" align="center" valign="middle">Accidente de muncă</th>
							<th width="65" align="center" valign="middle">Accidente de traseu sau de circulație</th>
							<th width="70" align="center" valign="middle">Incidente periculoase</th>
							<th width="65" align="center" valign="middle">Îmbolnăviri personale</th>
							<th width="75" align="center" valign="middle">Cauza evenimentului</th>
						</tr>
						<tr>
							<th align="center">0</th>
							<th align="center">1</th>
							<th align="center">2</th>
							<th align="center">3</th>
							<th align="center">4</th>
							<th align="center">5</th>
							<th align="center">6</th>
							<th align="center">7</th>
							<th align="center">8</th>
							<th align="center">9</th>
							<th align="center">10</th>
							<th align="center">11</th>
							<th align="center">12</th>
							<th align="center">13</th>
							<th align="center">14</th>
							<th align="center">15</th>
							<th align="center">16</th>
							<th align="center">17</th>
						</tr>
					</thead>
					<tbody><?php
					
						// ROWS
						
						$posts = get_posts(array(
							'posts_per_page' => -1,
							'post_type' => 'kik_company',
							'order'=> 'ASC',
							'orderby' => 'title',
						));
						$i = 0;
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
							
							// (($cod_caen) ? $cod_caen->name . ' - ' . $cod_caen->description : '-') 
							$caen = is_object($cod_caen)? $cod_caen->name : '-';
							$inspectorId = get_post_meta($post->ID, 'kik_company_inspector', true);
							$fullNameInspector = '-';
							if($inspectorId){
								$userData = get_userdata($inspectorId);
								$fullNameInspector = $userData->last_name.' '.$userData->first_name;
							}
							
							echo '
								<tr nobr="true">
									<td width="20" align="center">' . $i . '</td>
									<td width="80" class="align_left">
										Consultanță și instructaj de SSM, conform art.15, legea 319/2006<br />
										<span>
											<textarea class="print_no_border" type="text" style="width:70px;"></textarea>
										</span>
									</td>
									<td width="70" align="center">' . $post->post_title . '</td>
									<td width="25" align="center">' . $caen . '</td>
									<td width="10" align="center">' . get_post_meta($post->ID, 'kik_company_employees', true) . '</td>
									<td width="10" align="center">' . get_post_meta($post->ID, 'kik_company_employees', true) . '</td>
									<td width="30" align="center" style="color:#ff0000;">' . (get_post_meta($post->ID, 'kik_company_accidente', true) ? 'X' : '') . '</td>
									<td width="30" align="center">' . (get_post_meta($post->ID, 'kik_company_accidente', true) ? '' : 'X') . '</td>
									<td width="65" align="center">' . ($has_term_1 ? 'X' : '') . '</td>
									<td width="65" align="center">' . ($has_term_2 ? 'X' : '') . '</td>
									<td width="65" align="center">' . ($has_term_3 ? 'X' : '') . '</td>
									<td width="70" align="center">' . ($has_term_4 ? 'X' : '') . '</td>
									<td width="65" align="center">' . ($has_term_5 ? 'X' : '') . '</td>
									<td width="75" align="center">
										<span>
											<textarea class="print_no_border" type="text" style="width:40px;"></textarea>
										</span>
									</td>
									<td width="60" align="center">' . $fullNameInspector . '</td>
									<td width="60" align="center">
										<span>
											<textarea class="print_no_border" type="text" style="width:40px;"></textarea>
										</span>
									</td>
									<td width="90" align="center">
										<span>
											<textarea class="print_no_border" type="text" style="width:40px;"></textarea>
										</span>
									</td>
									<td width="60" align="center">
										<span>
											<textarea class="print_no_border" type="text" style="width:40px;"></textarea>
										</span>
									</td>
								</tr>
							';
						} ?>
					
					</tbody>
					
				</table>
									
									
									
			</div>
		</div>
	
		
	
	
	
	
	
	</form>
	
	
	
					
					
					
					
					
					
					<!---- OLD SHIT --->
					
					
						