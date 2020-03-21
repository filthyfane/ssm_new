<?php


#####------------------------------------
##### kik_companies
#####------------------------------------


function kik_companies_FUNC($atts, $content = null) {
	// extract params
	$a = shortcode_atts(array(
	), $atts);
	// do stuff
	?>
			
			<?php
			
			$current_user_id = wp_get_current_user()->ID;
			$current_user_roles = get_user_meta($current_user_id, 'kik_user_roles', true);
			$bool = (($current_user_id == 1) || (is_array($current_user_roles) && in_array('Administrator', $current_user_roles)));
			?>
			
			<div class="kik_company_title">
				<div class="kik_company_title_tag">Centralizator firme</div>
			</div>
			
			<div class="kik_company_fields_title">Listă firme</div>
			
			<table class="kik_table companies table_type_main">
				
				<!-- Labels -->
				<tr>
					<th>&nbsp;</th>
					<th>Firmă</th>
					<th>Instructaj</th>
					<th>Contact</th>
					<th>Inspector / Agent de vânzări</th>
					<th>Status</th>
					<th>&nbsp;</th>
				</tr>
				
				<!-- Existing rows -->
				<?php
				$args = array(
					'post_type' => 'kik_company',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order' => 'ASC',
				);
				$companies = get_posts($args);
				foreach ($companies as $company) {
				?>
				
				<tr data-company-id="<?php echo $company->ID; ?>">
					<td colspan="7">
						<table class="table_type_row">
							<tbody>
								<tr>
									
									<td>
										<?php
											$kik_alerts = get_option('kik_alerts') ? CountObjectDeepestChildren(get_option('kik_alerts')['by_id'][$company->ID]) : 0;
											$kik_notifications = get_option('kik_notifications') ? CountObjectDeepestChildren(get_option('kik_notifications')['by_id'][$company->ID]) : 0;
											$kik_alerts_bills = get_option('kik_alerts_bills') ? CountObjectDeepestChildren(get_option('kik_alerts_bills')['by_id'][$company->ID]) : 0;
											if ($kik_alerts) echo '<div class="kik_alerts" title="' . $kik_alerts . ' alerte">' . $kik_alerts . '</div>';
											if ($kik_notifications) echo '<div class="kik_notifications" title="' . $kik_notifications . ' atenționări">' . $kik_notifications . '</div>';
											if ($kik_alerts_bills) echo '<div class="kik_alerts_bills" title="' . $kik_alerts_bills . ' facturi neîncasate">' . $kik_alerts_bills . '</div>';
										?>
									</td>
									
									<td>
										<a class="kik_company_post_listing_title" href="<?php echo get_permalink($company->ID); ?>"><?php echo $company->post_title; ?></a></br >
										<div class="kik_company_post_listing_cif_reg">
											<?php
											$cif = get_post_meta($company->ID, 'kik_company_cif', true);
											$reg = get_post_meta($company->ID, 'kik_company_reg', true);
											echo $cif . ($cif && $reg ? ', ' : '') . $reg;
											?>
										</div>
									</td>
									
									<td>
										<i class="fa fa-clock-o"></i> <?php echo ($try = wp_get_object_terms($company->ID, 'kik_periodicitate_instructaj')) ? $try[0]->name : ''; ?>
									</td>
									
									<td>
										<i class="fa fa-fw fa-user"></i> <b><?php echo get_post_meta($company->ID, 'kik_company_contact_person_name', true); ?></b><br />
										<i class="fa fa-fw fa-phone"></i> <?php echo get_post_meta($company->ID, 'kik_company_contact_person_phone', true); ?><br />
										<i class="fa fa-fw fa-envelope"></i> <?php echo get_post_meta($company->ID, 'kik_company_contact_person_email', true); ?>
									</td>
									
									<td>
										<div class="kik_company_post_listing_select_row color-blue">
											<div class="kik_company_post_listing_select_row_edit">
												<i class="fa fa-user"></i>
												<?php 
													if ($bool) echo KIK_DROPDOWN_USERS('kik_company_inspector-' . $company->ID, 'kik_company_inspector-' . $company->ID, 'Inspector SSM', get_userdata(get_post_meta($company->ID, 'kik_company_inspector', true))->ID, true, 'size_full');
													else echo get_userdata(get_post_meta($company->ID, 'kik_company_inspector', true))->display_name;
												?>
											</div>
										</div>
										<div class="kik_company_post_listing_select_row color-orange">
											<div class="kik_company_post_listing_select_row_edit">
												<i class="fa fa-user"></i>
												<?php
													if ($bool) echo KIK_DROPDOWN_USERS('kik_company_sales_agent-' . $company->ID, 'kik_company_sales_agent-' . $company->ID, 'Agent de vânzări', get_userdata(get_post_meta($company->ID, 'kik_company_sales_agent', true))->ID, true, 'size_full');
													else echo get_userdata(get_post_meta($company->ID, 'kik_company_sales_agent', true))->display_name;
												?>
											</div>
										</div>
									</td>
									
									<td>
										<div class="kik_company_post_listing_select_row color-<?php echo (($try = wp_get_object_terms($company->ID, 'kik_status')) && $try[0]->name == 'Activ' ? 'green' : 'red'); ?>">
											<div class="kik_company_post_listing_select_row_edit">
												<i class="fa fa-circle"></i>
												<?php
													if ($bool) echo KIK_DROPDOWN_TERMS('kik_company_status-' . $company->ID, 'kik_company_status-' . $company->ID, 'kik_status', (($try = wp_get_object_terms($company->ID, 'kik_status')) ? $try[0]->term_id : 0), 'kik_company_post_listing_status size_full');
													else echo ($try = wp_get_object_terms($company->ID, 'kik_status')) ? $try[0]->name : '';
												?>
											</div>
										</div>
									</td>
									
									<td>
										<?php if ($bool) { ?>
										<div class="kik_company_post_listing_btn_update" data-company-id="<?php echo $company->ID; ?>">Update</div>
										<div class="kik_company_post_listing_btn_update_message"></div>
										<?php } else echo '&nbsp;'; ?>
									</td>
									
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
					
				<? } ?>
				
			</table>
			
			<div class="kik_company_fields_footer"></div>
			
	<?php
}










/**/

?>