					
					<div class="kik_company_fields_title">Periodicitate instructaj</div>
					
					<table class="kik_company_fields table_type_main">
						
						<!-- Periodicitate instructaj -->
						
						<!-- Labels -->
						<tr>
							<th style="width:18%;">
								Periodicitate instructaj
							</th>
							<th style="width:100%;">
								&nbsp;
							</th>
						</tr>
						
						<!-- Existing rows -->
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<tr>
										<td style="width:18%;" class="align-left">
											<div class="box_H_margin">
												<?php
												$kik_walker = new KIK_WALKER();
												wp_dropdown_categories(array(
													'walker'             => $kik_walker,
													'show_option_all'    => '',
													'show_option_none'   => '',
													'orderby'            => 'NAME', 
													'order'              => 'ASC',
													'show_count'         => 0,
													'hide_empty'         => 0, 
													'child_of'           => 0,
													'exclude'            => '',
													'echo'               => 1,
													'selected'           => $kik_company_service_frequency->term_id,
													'hierarchical'       => 1, 
													'name'               => 'kik_company_service_frequency_dedicated',
													'id'                 => 'kik_company_service_frequency_dedicated',
													'class'              => 'size_full_W',
													'depth'              => 0,
													'tab_index'          => 0,
													'taxonomy'           => 'kik_periodicitate_instructaj',
													'hide_if_empty'      => false,
												));
												?>
											</div>
										</td>
										<td style="width:100%;">
											<div class="box_H_margin">
												&nbsp;
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
					</table>
					
					&nbsp;<br />
					
					<div class="kik_company_fields_title">Programare instructaj - anul:
						<?php
						$kik_walker = new KIK_WALKER();
						wp_dropdown_categories(array(
							'walker'             => $kik_walker,
							'show_option_all'    => '',
							'show_option_none'   => '',
							'orderby'            => 'NAME', 
							'order'              => 'ASC',
							'show_count'         => 0,
							'hide_empty'         => 0, 
							'child_of'           => 0,
							'exclude'            => '',
							'echo'               => 1,
							'selected'           => get_term_by('slug', date('Y'), 'kik_ani_instructaj')->term_id,
							'hierarchical'       => 1, 
							'name'               => 'kik_company_service_frequency_history_year',
							'id'                 => 'kik_company_service_frequency_history_year',
							'class'              => '',
							'depth'              => 0,
							'tab_index'          => 0,
							'taxonomy'           => 'kik_ani_instructaj',
							'hide_if_empty'      => false,
						));
						?>
					</div>
					
					<table class="kik_company_fields table_type_main" data-for="istoric_instructaj">
						
						<!-- Istoric instructaj -->
						
						<!-- Labels -->
						<tr>
							<th style="width:200px;">
								Luna
							</th>
							<th style="width:150px;" class="align-left">
								Se efectuează?
							</th>
							<th style="width:100px;">
								Data
							</th>
							<th style="width:150px;" class="align-left">
								Realizat?
							</th>
							<th style="width:150px;" class="align-left">
								Se emite factură?
							</th>
							<th style="width:200px;" class="align-left">
								Numărul facturii emise
							</th>
							<th style="width:100%;">
								&nbsp;
							</th>
						</tr>
						
						<!-- Existing rows -->
						<?php
							$months = array('Ianuarie', 'Februarie', 'Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie', 'Decembrie');
							$i = 0;
							//echo DrawObject($kik_company_service_frequency_history);
							foreach ($months as $month) {
								$i++;
						?>
						<tr>
							<td colspan="8">
								<table class="table_type_row">
									<tr>
										<td style="width:200px;">
											<div class="box_H_margin">
												<?php echo $month; ?>
												<?php foreach (get_terms('kik_ani_instructaj', array('hide_empty' => false)) as $year) { ?><input type="hidden" name="kik_company_service_frequency_history[<?php echo $year->name; ?>][<?php echo $i; ?>][unique_id]" value="<?php echo $kik_company_service_frequency_history[0][$year->name][$i][unique_id] ? $kik_company_service_frequency_history[0][$year->name][$i][unique_id] : KIK_ASSIGN_UNIQUE_ID(); ?>"/><?php } ?>
											</div>
										</td>
										<td style="width:150px;" class="align-left">
											<div class="box_H_margin">
												<?php foreach (get_terms('kik_ani_instructaj', array('hide_empty' => false)) as $year) { ?><input type="checkbox" id="kik_company_service_frequency_history_<?php echo $year->name; ?>_<?php echo $i; ?>_serv_necessary" name="kik_company_service_frequency_history[<?php echo $year->name; ?>][<?php echo $i; ?>][serv_necessary]" <?php if ($kik_company_service_frequency_history[0][$year->name][$i][serv_necessary]) echo 'checked'; ?> style="display:<?php echo $year->name == date('Y') ? 'block' : 'none'; ?>;" data-dependency="year" data-year="<?php echo $year->name; ?>" /><?php } ?>
											</div>
										</td>
										<td style="width:100px;">
											<div class="box_H_margin">
												<?php foreach (get_terms('kik_ani_instructaj', array('hide_empty' => false)) as $year) echo KIK_DROPDOWN_DATE_DAY('kik_company_service_frequency_history_' . $year->name . '_' . $i . '_day', 'kik_company_service_frequency_history[' . $year->name . '][' . $i . '][day]', $year->name, $i, $kik_company_service_frequency_history[0][$year->name][$i][day], 'size_full_W align-right', ($year->name == date('Y') ? 'block' : 'none')); ?>
											</div>
										</td>
										<td style="width:150px;" class="align-left">
											<div class="box_H_margin">
												<?php foreach (get_terms('kik_ani_instructaj', array('hide_empty' => false)) as $year) { ?><input type="checkbox" id="kik_company_service_frequency_history_<?php echo $year->name; ?>_<?php echo $i; ?>_serv_bool" name="kik_company_service_frequency_history[<?php echo $year->name; ?>][<?php echo $i; ?>][serv_bool]" <?php if ($kik_company_service_frequency_history[0][$year->name][$i][serv_bool]) echo 'checked'; ?> style="display:<?php echo $year->name == date('Y') ? 'block' : 'none'; ?>;" data-dependency="year" data-year="<?php echo $year->name; ?>" /><?php } ?>
											</div>
										</td>
										<td style="width:150px;" class="align-left">
											<div class="box_H_margin">
												<?php foreach (get_terms('kik_ani_instructaj', array('hide_empty' => false)) as $year) { ?><input type="checkbox" id="kik_company_service_frequency_history_<?php echo $year->name; ?>_<?php echo $i; ?>_serv_billed" name="kik_company_service_frequency_history[<?php echo $year->name; ?>][<?php echo $i; ?>][serv_billed]" <?php if ($kik_company_service_frequency_history[0][$year->name][$i][serv_billed]) echo 'checked'; ?> style="display:<?php echo $year->name == date('Y') ? 'block' : 'none'; ?>;" data-dependency="year" data-year="<?php echo $year->name; ?>" /><?php } ?>
											</div>
										</td>
										<td style="width:200px;" class="align-left">
											<div class="box_H_margin">
												<?php foreach (get_terms('kik_ani_instructaj', array('hide_empty' => false)) as $year) { ?><input type="text" id="kik_company_service_frequency_history_<?php echo $year->name; ?>_<?php echo $i; ?>_serv_cashed" name="kik_company_service_frequency_history[<?php echo $year->name; ?>][<?php echo $i; ?>][serv_cashed]" value="<?php echo $kik_company_service_frequency_history[0][$year->name][$i][serv_cashed]; ?>" style="display:<?php echo $year->name == date('Y') ? 'block' : 'none'; ?>;" data-dependency="year" data-year="<?php echo $year->name; ?>" /><?php } ?>
											</div>
										</td>
										<td style="width:100%;">
											<div class="box_H_margin">
												&nbsp;
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php
							}
						?>
						
					</table>
					