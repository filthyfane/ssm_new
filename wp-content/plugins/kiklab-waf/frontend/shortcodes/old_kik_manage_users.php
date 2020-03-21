<?php


#####------------------------------------
##### kik_manage_users
#####------------------------------------


function kik_manage_users_FUNC($atts, $content = null) {
	// extract params
	$a = shortcode_atts(array(
	), $atts);
	// do stuff
	?>
			
			<?php
			$current_user_id = wp_get_current_user()->ID;
			$current_user_roles = get_user_meta($current_user_id, 'kik_user_roles', true);
			if (($current_user_id == 1) || (is_array($current_user_roles) && in_array('Administrator', $current_user_roles))) {
			?>
			
			<div class="kik_company_title">
				<div class="kik_company_title_tag">Administrare utilizatori</div>
			</div>
			
			<div class="kik_company_fields_title">Listă utilizatori</div>
			
			<table class="kik_table users table_type_main">
				
				<!-- Labels -->
				<tr>
					<th>&nbsp;</th>
					<th>Nume</th>
					<th>Utilizator</th>
					<th>Email</th>
					<th>Roluri</th>
				</tr>
				
				<!-- Existing rows -->
				<?php
				$args = array(
					'blog_id'      => $GLOBALS['blog_id'],
					'role'         => '',
					'meta_key'     => '',
					'meta_value'   => '',
					'meta_compare' => '',
					'meta_query'   => array(),
					'include'      => array(),
					'exclude'      => array(),
					'orderby'      => 'login',
					'order'        => 'ASC',
					'offset'       => '',
					'search'       => '',
					'number'       => '',
					'count_total'  => false,
					'fields'       => 'all',
					'who'          => ''
				);
				$users = get_users($args);
				foreach ($users as $user) { ?>
				
				<tr data-user-id="<?php echo $user->ID; ?>">
					<td colspan="7">
						<table class="table_type_row">
							<tbody>
								<tr>
									
									<td>
										&nbsp;
									</td>
									
									<td>
										<?php echo '<a href="' . get_author_posts_url($user->ID) . '">' . $user->first_name . ' ' . $user->last_name . '</a>'; ?>
									</td>
									
									<td>
										<?php echo $user->user_login; ?>
									</td>
									
									<td>
										<?php echo $user->user_email; ?>
									</td>
									
									<td>
										<?php
											$kik_user_roles = get_user_meta($user->ID, 'kik_user_roles', true);
											if (is_array($kik_user_roles)) {
												$i = 0;
												foreach (get_option('kik_user_roles') as $role) {
													if (in_array($role, $kik_user_roles)) {
														$i++;
														echo ($i > 1 ? ', ' : '') . $role;
													}
												}
											}
											else echo '--';
										?>
									</td>
									
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
					
				<? } ?>
				
			</table>
			
			<div class="kik_company_fields_footer"></div>
			
			<?php } ?>
			
	<?php
}










/**/

?>